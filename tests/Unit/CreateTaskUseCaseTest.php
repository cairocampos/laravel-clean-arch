<?php

use App\Domain\UseCases\CreateTaskUseCase\CreateTaskInput;
use App\Domain\UseCases\CreateTaskUseCase\CreateTaskUseCase;
use App\Infra\Repositories\InMemory\CreateTaskInMemoryRepository;

it('should create a task', function() {
    $useCase = new CreateTaskUseCase(new CreateTaskInMemoryRepository);

    $dto = new CreateTaskInput([
        'name' => 'My Task'
    ]);
    $result = $useCase->execute($dto);
    expect($result->hasError())->toBeFalse();
});
