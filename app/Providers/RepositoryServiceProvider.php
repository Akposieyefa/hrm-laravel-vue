<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //auth repository binding
        $this->app->bind(
            \App\Repositories\Contracts\AuthRepositoryInterface::class,
            \App\Repositories\AuthRepository::class
        );
        //department repository binding
        $this->app->bind(
            \App\Repositories\Contracts\DepartmentRepositoryInterface::class,
            \App\Repositories\DepartmentRepository::class
        );
        //organization repository binding
        $this->app->bind(
            \App\Repositories\Contracts\OrganizationRepositoryInterface::class,
            \App\Repositories\OrganizationRepository::class
        );
        //level repository binding
        $this->app->bind(
            \App\Repositories\Contracts\LevelRepositoryInterface::class,
            \App\Repositories\LevelRepository::class
        );
        //employee repository binding
        $this->app->bind(
            \App\Repositories\Contracts\EmployeeRepositoryInterface::class,
            \App\Repositories\EmployeeRepository::class
        );
        //project repository binding
        $this->app->bind(
            \App\Repositories\Contracts\ProjectRepositoryInterface::class,
            \App\Repositories\ProjectRepository::class
        );
        //task repository binding
        $this->app->bind(
            \App\Repositories\Contracts\TaskRepositoryInterface::class,
            \App\Repositories\TaskRepository::class
        );
        //leave repository binding
        $this->app->bind(
            \App\Repositories\Contracts\LeaveRepositoryInterface::class,
            \App\Repositories\LeaveRepository::class
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
