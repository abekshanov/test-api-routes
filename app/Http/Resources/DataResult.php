<?php

namespace App\Http\Resources;

class DataResult
{
    private $data;
    private bool $errors;

    public function __construct($data, bool $errors = false)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function result (): array
    {
        return [
            'data' => $this->data,
            'errors' => $this->errors
        ];
    }
}