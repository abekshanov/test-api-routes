<?php

namespace App\Http\Resources;

class DataResult
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function result (): array
    {
        return [
            'data' => $this->data,
            'errors' => false
        ];
    }
}