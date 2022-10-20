<?php

namespace App\Infra\Repositories\InMemory;
use App\Repositories\ToggleStateTaskRespository;

class ToggleStateTaskInMemoryRespository extends InMemoryTasks implements ToggleStateTaskRespository
{
    public function toggleState(int $task_id, bool $newState): int
    {
        $this->tasks = collect($this->tasks)->map(function($task) use($task_id, $newState) {
            if($task['id'] === $task_id) {
                $task['done'] = $newState;
            }

            return $task;
        })->toArray();


        return 1;
    }
}
