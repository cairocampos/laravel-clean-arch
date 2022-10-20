<?php

namespace App\Infra\Repositories\ORM;

use App\Models\Task;
use App\Repositories\FindTaskByIdRepository;

class FindTaskByIdOrmRepository implements FindTaskByIdRepository
{
    public function find(int $task_id): ?array
    {
        return Task::find($task_id)->toArray();
    }
}
