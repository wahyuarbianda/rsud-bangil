<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ManipulatedData
{
    public function camelToSnake(array $data): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            $snakeKey = Str::snake($key);
            $result[$snakeKey] = is_array($value) ? $this->camelToSnake($value) : $value;
        }

        return $result;
    }
}
