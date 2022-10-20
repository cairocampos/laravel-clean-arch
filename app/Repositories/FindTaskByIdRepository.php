<?php

namespace App\Repositories;

interface FindTaskByIdRepository
{
    public function find(int $task_id): ?array;
}
