<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;



use App\Repositories\Interfaces\Client\OrderRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Client\OrderRepositoryImplementator;

use App\Repositories\Interfaces\Client\PostRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Client\PostRepositoryImplementator;

use App\Repositories\Interfaces\Client\ProductRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Client\ProductRepositoryImplementator;

use App\Repositories\Interfaces\Client\UserRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Client\UserRepositoryImplementator;

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
        $this->app->bind(PostRepositoryInterface::class, PostRepositoryImplementator::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepositoryImplementator::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryImplementator::class);
        $this->app->bind(DeliveryRepositoryInterface::class, DeliveryRepositoryImplementator::class);
        
    }
}
