<?php

namespace global;

class ResultHelper
{
    public static function getResult(Result $res): string|bool
    {
        return json_encode($res);
    }
}

class Result
{
    public bool $success;
    public string $message;

    public function __construct(bool $success, string $message)
    {
        $this->success = $success;
        $this->message = $message;
    }
}

class DataResult extends Result
{
    public mixed $data;

    public function __construct(bool $success, string $message, $data)
    {
        parent::__construct($success, $message);
        $this->data = $data;
    }
}

class SuccessResult extends Result
{
    public function __construct(string $message)
    {
        parent::__construct(true, $message);
    }
}

class ErrorResult extends Result
{
    public function __construct(string $message)
    {
        parent::__construct(false, $message);
    }
}

class SuccessDataResult extends DataResult
{
    public function __construct(string $message, $data)
    {
        parent::__construct(true, $message, $data);
    }
}

class ErrorDataResult extends DataResult
{
    public function __construct(string $message, $data)
    {
        parent::__construct(false, $message, $data);
    }
}