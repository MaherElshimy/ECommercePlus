<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\EmailAndPdf\EmailAndPdfController;
use App\Http\Controllers\Admin\Order\OrderAdminController;
use App\Http\Controllers\Admin\Product\ProductAdminController;




Route::get('/view_catagory', [CategoryController::class, 'viewCategory']);
Route::post('/add_catagory', [CategoryController::class, 'addCategory']);
Route::get('/delete_catagory/{id}', [CategoryController::class, 'deleteCategory']);

Route::get('/view_product', [ProductAdminController::class, 'viewProduct']);
Route::post('/add_product', [ProductAdminController::class, 'addProduct']);
Route::get('/show_product', [ProductAdminController::class, 'showProducts']);
Route::get('/delete_product/{id}', [ProductAdminController::class, 'deleteProduct']);
Route::get('/update_product/{id}', [ProductAdminController::class, 'updateProduct']);
Route::post('/update_product_confirm/{id}', [ProductAdminController::class, 'updateProductConfirm']);


Route::get('/order', [OrderAdminController::class, 'order']);
Route::get('/delivered/{id}', [OrderAdminController::class, 'delivered']);
Route::get('/search', [OrderAdminController::class, 'searchData']);

Route::get('/print_pdf/{id}', [EmailAndPdfController::class, 'printPDF']);
Route::get('/send_email/{id}', [EmailAndPdfController::class, 'sendEmail']);
Route::post('/send_user_email/{id}', [EmailAndPdfController::class, 'sendUserEmail']);



?>
