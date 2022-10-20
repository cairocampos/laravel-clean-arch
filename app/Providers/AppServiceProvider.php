<?php

namespace App\Providers;

use App\Infra\Repositories\InMemory\CreateTaskInMemoryRepository;
use App\Infra\Repositories\InMemory\FindManyTasksInMemoryRepository;
use App\Infra\Repositories\InMemory\FindTaskByIdInMemoryRepository;
use App\Infra\Repositories\InMemory\ToggleStateTaskInMemoryRespository;
use App\Infra\Repositories\ORM\CreateTaskOrmRepository;
use App\Infra\Repositories\ORM\FindManyTasksOrmRepository;
use App\Infra\Repositories\ORM\FindTaskByIdOrmRepository;
use App\Infra\Repositories\ORM\ToggleStateTaskOrmRepository;
use App\Repositories\CreateTaskRepository;
use App\Repositories\FindManyTasksRespository;
use App\Repositories\FindTaskByIdRepository;
use App\Repositories\ToggleStateTaskRespository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment() === 'test') {
            $this->app->bind(CreateTaskRepository::class, CreateTaskInMemoryRepository::class);
            $this->app->bind(FindManyTasksRespository::class, FindManyTasksInMemoryRepository::class);
            $this->app->bind(FindTaskByIdRepository::class, FindTaskByIdInMemoryRepository::class);
            $this->app->bind(ToggleStateTaskRespository::class, ToggleStateTaskInMemoryRespository::class);
        } else {
            $this->app->bind(CreateTaskRepository::class, CreateTaskOrmRepository::class);
            $this->app->bind(FindManyTasksRespository::class, FindManyTasksOrmRepository::class);
            $this->app->bind(FindTaskByIdRepository::class, FindTaskByIdOrmRepository::class);
            $this->app->bind(ToggleStateTaskRespository::class, ToggleStateTaskOrmRepository::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
