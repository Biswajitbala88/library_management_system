<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\RazorpayPaymentController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    

    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/edit/{book}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/book/update/{book}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{book}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/book/show/{book}', [BookController::class, 'show'])->name('book.show');
    
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/create/{book}', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store/{book}', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/edit/{order}', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('/order/update/{order}', [OrderController::class, 'update'])->name('order.update');
    Route::post('/order/{order}', [OrderController::class, 'cancelOrder'])->name('order.cancelOrder');

    Route::get('/invoice/show/{order}', [InvoiceController::class, 'show'])->name('invoice.show');



    
    Route::name('razorpay.')
    ->controller(RazorpayController::class)
    ->prefix('razorpay')
    ->group(function () {
        Route::view('payment', 'razorpay.index')->name('create.payment');
        Route::post('handle-payment', 'handlePayment')->name('make.payment');
    });


    Route::get('razorpay-payment/{order}', [RazorpayPaymentController::class, 'index'])->name('razorpay.index');
    Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');
    

});


Route::get('/admin_register', [RegisteredUserController::class, 'index']);

require __DIR__.'/auth.php';
