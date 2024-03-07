<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\Home\Cart\CartRepositoryInterface;
use App\Interfaces\Home\Order\OrderRepositoryInterface;
use App\Repositories\Home\Cart\CartRepository;
use App\Repositories\Home\Order\OrderRepository;

use App\Interfaces\Home\Comment\CommentRepositoryInterface;
use App\Interfaces\Home\Comment\ReplyRepositoryInterface;
use App\Repositories\Home\Comment\CommentRepository;
use App\Repositories\Home\Comment\ReplyRepository;

use App\Interfaces\Home\Payments\PaymentRepositoryInterface;
use App\Repositories\Home\Payments\PaymentRepository;

use App\Interfaces\Home\Product\ProductRepositoryInterface;
use App\Repositories\Home\Product\ProductRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(ReplyRepositoryInterface::class, ReplyRepository::class);

        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

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


?>
