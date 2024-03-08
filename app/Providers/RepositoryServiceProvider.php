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

use App\Interfaces\Admin\Category\CategoryRepositoryInterface;
use App\Interfaces\Admin\Category\CategoryServiceInterface;
use App\Repositories\Admin\Category\CategoryRepository;
use App\Repositories\Admin\Category\CategoryService;

use App\Interfaces\Admin\Product\AdminProductRepositoryInterface;
use App\Repositories\Admin\Product\AdminProductRepository;

use App\Interfaces\Admin\Order\AdminOrderRepositoryInterface;
use App\Repositories\Admin\Order\AdminOrderRepository;

use App\Interfaces\Admin\EmailAndPdf\AdminPdfRepositoryInterface;
use App\Interfaces\Admin\EmailAndPdf\AdminEmailRepositoryInterface;
use App\Repositories\Admin\EmailAndPdf\AdminPdfRepository;
use App\Repositories\Admin\EmailAndPdf\AdminEmailRepository;



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

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);

        $this->app->bind(AdminProductRepositoryInterface::class, AdminProductRepository::class);

        $this->app->bind(AdminOrderRepositoryInterface::class, AdminOrderRepository::class);

        $this->app->bind(AdminPdfRepositoryInterface::class, AdminPdfRepository::class);
        $this->app->bind(AdminEmailRepositoryInterface::class, AdminEmailRepository::class);

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
