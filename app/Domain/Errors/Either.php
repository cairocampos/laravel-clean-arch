<?php

namespace App\Domain\Errors;

class Either
{
    public function __construct(
        private $errors = [],
        private $data = null
    ){}

    public function setData($data)
    {
        $this->data = $data;
    }

    public function addError($error)
    {
        array_push($this->errors, $error);
    }

    public function hasError()
    {
        return !!count($this->errors);
    }

    public function result()
    {
        return $this->data;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
