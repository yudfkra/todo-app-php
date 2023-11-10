<?php

namespace Core\Responses;

class Json
{
    public array $extra = [];

    public function __construct(
        public $status = true,
        public $message = 'OK',
        public $data = null,
        public $statusCode = 200,
    ) {}

    public function failed()
    {
        $this->status = false;

        return $this;
    }

    public function success()
    {
        $this->status = true;

        return $this;
    }

    public function withMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    public function withData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function statusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function merge($extra = [])
    {
        $this->extra = $extra;

        return $this;
    }

    public function toArray()
    {
        $format = [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ];

        return array_merge($format, $this->extra);
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function output()
    {
        http_response_code($this->statusCode);
        
        header("Content-Type: application/json");

        echo $this->toJson();

        exit();
    }

    public function __toString()
    {
        return $this->output();
    }

    public static function make()
    {
        $output = new static;

        return $output;
    }

    public static function validation($extra = [], $message = 'Validation Error.')
    {
        $output = new static(false, $message, null, 422);

        return $output->merge($extra);
    }

    public static function notFound($message = 'Route not found.')
    {
        $output = new static(false, $message, null, 404);

        return $output;
    }

    public static function unauthorized($message = 'Unauthorized.')
    {
        $output = new static(false, $message , null, 401);

        return $output;
    }

    public static function data($data)
    {
        $output = new static(true, 'OK', $data);

        return $output;
    }
}
