<?php

namespace App\Infra\Repositories\InMemory;

class InMemoryTasks
{
    public $increment = 2;
    public array $tasks = [
        [
            'id' => 1,
            'name' => 'Task 01',
            'done' => false
        ],
        [
            'id' => 2,
            'name' => 'Task 02',
            'done' => false
        ],
        [
            'id' => 2,
            'name' => 'Task 03',
            'done' => true
        ]
    ];
}
