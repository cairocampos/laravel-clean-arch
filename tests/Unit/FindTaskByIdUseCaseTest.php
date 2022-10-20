<?php

use App\Domain\Errors\RequiredParametersError;
use App\Domain\UseCases\CreateTaskUseCase\CreateTaskInput;
use App\Domain\UseCases\CreateTaskUseCase\CreateTaskOutput;
use App\Domain\UseCases\CreateTaskUseCase\CreateTaskUseCase;
use App\Infra\Repositories\InMemory\CreateTaskInMemoryRepository;

test('should not return error if data are passed correctly', function() {
    $repo = new CreateTaskInMemoryRepository();
    $createTaskUseCase = new CreateTaskUseCase($repo);
    $dto = new CreateTaskInput([
        'name' => 'task 01'
    ]);

    $result = $createTaskUseCase->execute($dto);
    $this->assertFalse($result->hasError());
});


test('should return error if name is empty', function() {
    $repo = new CreateTaskInMemoryRepository();
    $createTaskUseCase = new CreateTaskUseCase($repo);
    $dto = new CreateTaskInput([
        'name' => ''
    ]);

    $result = $createTaskUseCase->execute($dto);
    $this->assertTrue($result->hasError());
    $this->assertInstanceOf(RequiredParametersError::class, $result->getErrors()[0]);
    $this->assertEquals('Field name is required', $result->getErrors()[0]->getMessage());
});

test('should call CreateTaskRepository if data is valid', function() {
    $mock = mock(CreateTaskInMemoryRepository::class)
        ->shouldReceive('create')
        ->andReturn([
            'id' => 1,
            'name' => 'name',
            'done' => false
        ])->getMock();
    $createTaskUseCase = new CreateTaskUseCase($mock);
    $dto = new CreateTaskInput([
        'name' => 'My task'
    ]);

    $createTaskUseCase->execute($dto);
    $mock->shouldHaveReceived('create')->once();
});
