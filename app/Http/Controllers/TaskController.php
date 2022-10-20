<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\CreateTaskUseCase\CreateTaskInput;
use App\Domain\UseCases\CreateTaskUseCase\CreateTaskUseCase;
use App\Domain\UseCases\FindTaskByIdUseCase\FindTaskByIdUseCase;
use App\Domain\UseCases\GetTasksUseCase\GetTasksUseCase;
use App\Domain\UseCases\ToggleStateTaskUseCase\ToggleStateTaskInput;
use App\Domain\UseCases\ToggleStateTaskUseCase\ToggleStateTaskUseCase;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\ToggleStateTaskRequest;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function __construct(
        private CreateTaskUseCase $createTaskUseCase,
        private GetTasksUseCase $getTasksUseCase,
        private FindTaskByIdUseCase $findTaskByIdUseCase,
        private ToggleStateTaskUseCase $toggleStateTaskUseCase,
    ){}

    public function index()
    {
        return $this->getTasksUseCase->execute();
    }

    public function show($id)
    {
        $data = $this->findTaskByIdUseCase->execute($id);
        return response()->json($data, Response::HTTP_OK);
    }

    public function store(CreateTaskRequest $request)
    {
        $inputData = new CreateTaskInput($request->all());
        $data = $this->createTaskUseCase->execute($inputData);
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function toggleState(ToggleStateTaskRequest $request, $task_id)
    {
        $inputData = new ToggleStateTaskInput([
            'id' => $task_id,
            'state' => $request->state
        ]);
        $data = $this->toggleStateTaskUseCase->execute($inputData);
        return response()->json($data, Response::HTTP_OK);
    }
}
