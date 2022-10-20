<?php

namespace App\Domain\UseCases\CreateTaskUseCase;

use Spatie\DataTransferObject\DataTransferObject;

class CreateTaskOutput extends DataTransferObject {
    public readonly int $id;
    public readonly string $name;
    public readonly bool $done;
}
