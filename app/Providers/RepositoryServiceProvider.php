<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\LineItem\LineItemRepositoryInterface;
use App\Repositories\LineItem\LineItemRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Suggest\SuggestRepository;
use App\Repositories\Suggest\SuggestRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserRepositoryInterface::class, UserRepository::class);
        App::bind(ProductRepositoryInterface::class, ProductRepository::class);
        App::bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        App::bind(OrderRepositoryInterface::class, OrderRepository::class);
        App::bind(LineItemRepositoryInterface::class, LineItemRepository::class);
        App::bind(CommentRepositoryInterface::class, CommentRepository::class);
        App::bind(SuggestRepositoryInterface::class, SuggestRepository::class);
    }
}
