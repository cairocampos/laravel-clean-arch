<?php

namespace App\Domain\UseCases\CreateTaskUseCase;

use App\Domain\Entities\Task;
use App\Domain\Errors\Either;
use App\Repositories\CreateTaskRepository;

class CreateTaskUseCase {
    public function __construct(
        private readonly CreateTaskRepository $createTaskRespository
    ){}

    public function execute(CreateTaskInput $data): Either
    {
        $either = new Either();
        $task = Task::create(['name' => $data->name, 'done' => false]);
        $task->validate($either);
        $data = $this->createTaskRespository->create($task);
        $either->setData(new CreateTaskOutput($data));
        return $either;
    }
}
