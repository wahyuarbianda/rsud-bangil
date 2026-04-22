<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

abstract class Controller
{
    protected function successResponse(
        mixed $data = null,
        ?string $message = null,
        int $code = 200,
        ?array $meta = []
    ): JsonResponse {
        if ($data instanceof AnonymousResourceCollection) {
            $paginator = $data->resource;

            if ($paginator instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                $meta = [
                    'current_page' => $paginator->currentPage(),
                    'last_page'    => $paginator->lastPage(),
                    'per_page'     => $paginator->perPage(),
                    'total'        => $paginator->total(),
                    'from'         => $paginator->firstItem(),
                    'to'           => $paginator->lastItem(),
                    'has_more'     => $paginator->hasMorePages(),
                ];
            }

            $data = $data->collection;
        }

        return $this->generateResponse($data, $message, $code, true, $meta ?? []);
    }

    protected function errorResponse(
        mixed $data = null,
        ?string $message = null,
        int|string $code = 400
    ): JsonResponse {
        if (!array_key_exists((int) $code, Response::$statusTexts)) {
            $code = 500;
        }

        return $this->generateResponse($data, $message, (int) $code, false);
    }

    private function generateResponse(
        mixed $data,
        ?string $message,
        int $code,
        bool $success,
        ?array $meta = []
    ): JsonResponse {
        $message = $message ?: Response::$statusTexts[$code] ?? '';

        return response()->json(
            new ApiResource($success, $code, $message, $data, $meta),
            $code
        );
    }
}
