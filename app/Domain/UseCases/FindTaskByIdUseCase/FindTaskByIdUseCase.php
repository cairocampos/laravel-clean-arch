<?php

namespace App\Domain\UseCases\FindTaskByIdUseCase;

use App\Domain\Errors\Either;
use App\Domain\Errors\NotFoundError;
use App\Repositories\FindTaskByIdRepository;

class FindTaskByIdUseCase {
    public function __construct(
        private readonly FindTaskByIdRepository $findTaskByIdRepository
    ){}

    public function execute(int $task_id)
    {
        $either = new Either();
        $task = $this->findTaskByIdRepository->find($task_id);
        if(!$task) {
            $either->addError(new NotFoundError('task', $task_id));
            return $either;
        }
        $either->setData($task);
        return $either;
    }
}
