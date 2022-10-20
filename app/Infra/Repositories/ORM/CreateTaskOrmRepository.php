<?php

namespace App\Infra\Repositories\ORM;

use App\Domain\Entities\Task;
use App\Models\Task as ModelTask;
use App\Repositories\CreateTaskRepository;

class CreateTaskOrmRepository implements CreateTaskRepository
{
    public function create(Task $task): array
    {
        return ModelTask::create((array) $task)->toArray();
    }
}
