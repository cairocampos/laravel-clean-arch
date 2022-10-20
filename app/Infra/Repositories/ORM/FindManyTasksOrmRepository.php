<?php

namespace App\Infra\Repositories\ORM;

use App\Models\Task;
use App\Repositories\FindManyTasksRespository;

class FindManyTasksOrmRepository implements FindManyTasksRespository
{
    public function find(): array
    {
        return Task::all()->toArray();
    }
}
