<?php

namespace App\Domain\UseCases\ToggleStateTaskUseCase;

use App\Domain\Errors\Either;
use App\Domain\Errors\NotFoundError;
use App\Repositories\FindTaskByIdRepository;
use App\Repositories\ToggleStateTaskRespository;

class ToggleStateTaskUseCase
{
    public function __construct(
        private readonly ToggleStateTaskRespository $toggleStateTaskRespository,
        private readonly FindTaskByIdRepository $findTaskByIdRepository,
    ){}

    public function execute(ToggleStateTaskInput $dto): Either
    {
        $either = new Either();
        $task = $this->findTaskByIdRepository->find($dto->id);
        if(!$task) {
            $either->addError(new NotFoundError('task', $dto->id));
            return $either;
        }
        $this->toggleStateTaskRespository->toggleState($dto->id, $dto->state);
        $task = $this->findTaskByIdRepository->find($dto->id);
        $either->setData($task);
        return $either;
    }
}
