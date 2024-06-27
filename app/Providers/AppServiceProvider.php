<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\Client\OrderRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Client\OrderRepositoryImplementator;
use App\Repositories\Interfaces\Admin\AdminRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Admin\AdminRepositoryImplementator;
use App\Repositories\Interfaces\Admin\PostRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Admin\PostRepositoryImplementator;
use App\Repositories\Interfaces\Admin\ProductRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Admin\ProductRepositoryImplementator;
use App\Repositories\Interfaces\Client\UserRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Client\UserRepositoryImplementator;
use App\Repositories\Interfaces\Staff\CourierRepositoryInterface;
use App\Repositories\Implementators\Eloquent\Staff\CourierRepositoryImplementator;
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
        $this->app->bind(AdminRepositoryInterface::class, AdminRepositoryImplementator::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepositoryImplementator::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepositoryImplementator::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryImplementator::class);
        $this->app->bind(CourierRepositoryInterface::class, CourierRepositoryImplementator::class);
        $this->app->bind(DeliveryRepositoryInterface::class, DeliveryRepositoryImplementator::class);
        
    }
}
