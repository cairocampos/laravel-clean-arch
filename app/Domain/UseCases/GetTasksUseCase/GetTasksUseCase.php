<?php

namespace App\Domain\UseCases\GetTasksUseCase;
use App\Repositories\FindManyTasksRespository;

class GetTasksUseCase {
    public function __construct(
        private readonly FindManyTasksRespository $findManyTasksRespository
    ){}

    public function execute()
    {
        $tasks = $this->findManyTasksRespository->find();
        return $tasks;
    }
}
