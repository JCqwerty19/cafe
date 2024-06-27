<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\Client\OrderRepository;
use App\Repositories\Implementators\Eloquent\Client\OrderRepositoryImplementator;
use App\Repositories\Interfaces\Admin\AdminRepository;
use App\Repositories\Implementators\Eloquent\Admin\AdminRepositoryImplementator;
use App\Repositories\Interfaces\Admin\PostRepository;
use App\Repositories\Implementators\Eloquent\Admin\PostRepositoryImplementator;
use App\Repositories\Interfaces\Admin\ProductRepository;
use App\Repositories\Implementators\Eloquent\Admin\ProductRepositoryImplementator;
use App\Repositories\Interfaces\Client\UserRepository;
use App\Repositories\Implementators\Eloquent\Client\UserRepositoryImplementator;
use App\Repositories\Interfaces\Staff\CourierRepository;
use App\Repositories\Implementators\Eloquent\Staff\CourierRepositoryImplementator;
use App\Repositories\Interfaces\Staff\DeliveryRepository;
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
        $this->app->bind(OrderRepository::class, OrderRepositoryImplementator::class);
        $this->app->bind(AdminRepository::class, AdminRepositoryImplementator::class);
        $this->app->bind(PostRepository::class, PostRepositoryImplementator::class);
        $this->app->bind(ProductRepository::class, ProductRepositoryImplementator::class);
        $this->app->bind(UserRepository::class, UserRepositoryImplementator::class);
        $this->app->bind(CourierRepository::class, CourierRepositoryImplementator::class);
        $this->app->bind(DeliveryRepository::class, DeliveryRepositoryImplementator::class);
        
    }
}
