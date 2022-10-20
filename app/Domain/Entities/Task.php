<?php

namespace App\Domain\Entities;

use App\Domain\Errors\Either;
use App\Domain\Errors\RequiredParametersError;

class Task {
    public function __construct(
        public string $name,
        public bool $done,
    ){}

    public static function create(array $values)
    {
        return new self(
            $values['name'],
            false
        );
    }

    public function validate(Either $either)
    {
        if(!$this->name || !trim($this->name)) {
            $either->addError(new RequiredParametersError('name'));
        }
    }
}
