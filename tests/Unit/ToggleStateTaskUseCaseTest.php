<?php

use App\Domain\Errors\NotFoundError;
use App\Domain\UseCases\ToggleStateTaskUseCase\ToggleStateTaskInput;
use App\Domain\UseCases\ToggleStateTaskUseCase\ToggleStateTaskUseCase;
use App\Infra\Repositories\InMemory\FindTaskByIdInMemoryRepository;
use App\Infra\Repositories\InMemory\InMemoryTasks;
use App\Infra\Repositories\InMemory\ToggleStateTaskInMemoryRespository;

it('should change the state from any existent task', function() {
    $mock = mock(FindTaskByIdInMemoryRepository::class)
        ->shouldReceive('find')
        ->andReturn(['id' => 1, 'name' => 'Task', 'done' => false])
        ->getMock();
    $useCase = new ToggleStateTaskUseCase(
        new ToggleStateTaskInMemoryRespository,
        $mock
    );

    $dto = new ToggleStateTaskInput([
        'id' => 1,
        'state' => false
    ]);
    $result = $useCase->execute($dto);
    expect($result->hasError())->toBeFalse();
});

it('should return error when not found task', function() {
    $mock = mock(FindTaskByIdInMemoryRepository::class)
        ->shouldReceive('find')
        ->andReturn(null)
        ->getMock();
    $useCase = new ToggleStateTaskUseCase(
        new ToggleStateTaskInMemoryRespository(),
        $mock
    );

    $dto = new ToggleStateTaskInput([
        'id' => 1,
        'state' => false
    ]);
    $result = $useCase->execute($dto);
    expect($result->hasError())->toBeTrue();
    expect($result->getErrors()[0])->toBeInstanceOf(NotFoundError::class);
});
