<?php

namespace App\Infra\Repositories\ORM;

use App\Models\Task;
use App\Repositories\ToggleStateTaskRespository;

class ToggleStateTaskOrmRepository implements ToggleStateTaskRespository
{
    public function toggleState(int $task_id, bool $newState): int
    {
        return Task::where('id', $task_id)
            ->update(['done' => $newState]);
    }
}
