<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class ApiResource implements Arrayable, JsonSerializable
{
    public function __construct(
        public bool $success,
        public int $code,
        public string $message,
        public mixed $data = null,
        public array $meta = []
    ) {}

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'code'    => $this->code,
            'message' => $this->message,
            'data'    => $this->data,
            'meta'    => $this->meta,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
