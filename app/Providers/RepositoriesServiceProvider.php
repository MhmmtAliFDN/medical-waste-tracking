<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\DataAccess\Contracts\DoctorRepositoryInterface',
            'App\DataAccess\Repositories\DoctorRepository',
        );
        $this->app->bind(
            'App\Business\Contracts\DoctorServiceInterface',
            'App\Business\Services\DoctorService',
        );

        $this->app->bind(
            'App\DataAccess\Contracts\UserRepositoryInterface',
            'App\DataAccess\Repositories\UserRepository',
        );
        $this->app->bind(
            'App\Business\Contracts\UserServiceInterface',
            'App\Business\Services\UserService',
        );

        $this->app->bind(
            'App\DataAccess\Contracts\NurseRepositoryInterface',
            'App\DataAccess\Repositories\NurseRepository',
        );
        $this->app->bind(
            'App\Business\Contracts\NurseServiceInterface',
            'App\Business\Services\NurseService',
        );

        $this->app->bind(
            'App\DataAccess\Contracts\ManagerRepositoryInterface',
            'App\DataAccess\Repositories\ManagerRepository',
        );
        $this->app->bind(
            'App\Business\Contracts\ManagerServiceInterface',
            'App\Business\Services\ManagerService',
        );

        $this->app->bind(
            'App\DataAccess\Contracts\AuthorizedOfficerRepositoryInterface',
            'App\DataAccess\Repositories\AuthorizedOfficerRepository',
        );
        $this->app->bind(
            'App\Business\Contracts\AuthorizedOfficerServiceInterface',
            'App\Business\Services\AuthorizedOfficerService',
        );

        $this->app->bind(
            'App\DataAccess\Contracts\WasteCollectionStaffRepositoryInterface',
            'App\DataAccess\Repositories\WasteCollectionStaffRepository',
        );
        $this->app->bind(
            'App\Business\Contracts\WasteCollectionStaffServiceInterface',
            'App\Business\Services\WasteCollectionStaffService',
        );

        $this->app->bind(
            'App\DataAccess\Contracts\MedicalWasteRepositoryInterface',
            'App\DataAccess\Repositories\MedicalWasteRepository',
        );
        $this->app->bind(
            'App\Business\Contracts\MedicalWasteServiceInterface',
            'App\Business\Services\MedicalWasteService',
        );

        $this->app->bind(
            'App\DataAccess\Contracts\ReportRepositoryInterface',
            'App\DataAccess\Repositories\ReportRepository',
        );
        $this->app->bind(
            'App\Business\Contracts\ReportServiceInterface',
            'App\Business\Services\ReportService',
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
