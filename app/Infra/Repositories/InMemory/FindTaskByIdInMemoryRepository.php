<?php

namespace App\Infra\Repositories\InMemory;
use App\Repositories\FindTaskByIdRepository;

class FindTaskByIdInMemoryRepository extends InMemoryTasks implements FindTaskByIdRepository
{
    public function find(int $task_id): ?array
    {
        return (array) collect($this->tasks)->firstWhere('id', $task_id);
    }
}
