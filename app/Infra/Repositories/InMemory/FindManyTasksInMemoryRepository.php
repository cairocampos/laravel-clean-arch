<?php

namespace App\Infra\Repositories\InMemory;
use App\Repositories\FindManyTasksRespository;

class FindManyTasksInMemoryRepository extends InMemoryTasks implements FindManyTasksRespository
{
    public function find(): array
    {
        return $this->tasks;
    }
}
