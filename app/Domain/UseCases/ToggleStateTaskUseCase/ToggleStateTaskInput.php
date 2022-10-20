<?php

namespace App\Domain\UseCases\ToggleStateTaskUseCase;

use Spatie\DataTransferObject\DataTransferObject;

class ToggleStateTaskInput extends DataTransferObject
{
    public readonly int $id;
    public readonly bool $state;
}
