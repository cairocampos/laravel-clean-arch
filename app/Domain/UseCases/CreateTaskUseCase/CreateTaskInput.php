<?php

namespace App\Domain\UseCases\CreateTaskUseCase;
use Spatie\DataTransferObject\DataTransferObject;

class CreateTaskInput extends DataTransferObject {
    public string $name;
}
