<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\Client\OrderRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Client\OrderRepositoryImplementator;

use App\Repositories\Interfaces\Staff\DistributionRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Staff\DistributionRepositoryImplementator;

use App\Repositories\Interfaces\Staff\DeliveryRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Staff\DeliveryRepositoryImplementator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepositoryImplementator::class);
        $this->app->bind(DistributionRepositoryInterface::class, DistributionRepositoryImplementator::class);
        $this->app->bind(DeliveryRepositoryInterface::class, DeliveryRepositoryImplementator::class);
    }
}
