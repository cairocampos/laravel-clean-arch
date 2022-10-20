<?php

namespace App\Repositories;

interface ToggleStateTaskRespository
{
    public function toggleState(int $task_id, bool $newState): int;
}
