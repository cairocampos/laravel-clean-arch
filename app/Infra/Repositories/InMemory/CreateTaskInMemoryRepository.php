<?php

namespace App\Infra\Repositories\InMemory;

use App\Domain\Entities\Task;
use App\Repositories\CreateTaskRepository;

class CreateTaskInMemoryRepository extends InMemoryTasks implements CreateTaskRepository
{
    public function create(Task $task): array
    {
        $this->increment++;
        $newTask = [
            'id'   => $this->increment,
            'name' => $task->name,
            'done' => $task->done
        ];
        $this->tasks[] = $newTask;

        return $newTask;
    }
}
