<?php

namespace App\Repositories;

use App\Domain\Entities\Task;

interface CreateTaskRepository
{
    public function create(Task $task): array;
}
