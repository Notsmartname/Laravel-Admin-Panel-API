<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return redirect()->route(
        Auth::check() ? 'dashboard' : 'login'
    );
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'admin/users', 'controller' => RegisteredUserController::class, 'middleware' => ['admin']], function () {
        Route::get('/', 'index')->name('admin.users.index');
        Route::get('/create', 'create')->name('admin.users.create');
        Route::post('/', 'store')->name('admin.users.store');
        Route::get('/{user}/edit', 'edit')->name('admin.users.edit');
        Route::put('/{user}', 'update')->name('admin.users.update');
        Route::delete('/{user}', 'destroy')->name('admin.users.destroy');
    });

    Route::group(['prefix' => 'admin/pages', 'controller' => PageController::class], function () {
        Route::get('/', 'index')->name('admin.pages.index');
        Route::get('/create', 'create')->name('admin.pages.create');
        Route::post('/', 'store')->name('admin.pages.store');
        Route::get('/{id}', 'show')->name('admin.pages.show');
        Route::get('/{id}/edit', 'edit')->name('admin.pages.edit');
        Route::put('/{id}', 'update')->name('admin.pages.update');
        Route::delete('/{id}', 'destroy')->name('admin.pages.destroy');
    });

    Route::group(['prefix' => 'admin/categories', 'controller' => CategoryController::class], function () {
        Route::get('/', 'index')->name('admin.categories.index');
        Route::get('/create', 'create')->name('admin.categories.create');
        Route::post('/', 'store')->name('admin.categories.store');
        Route::get('/{id}', 'show')->name('admin.categories.show');
        Route::get('/{id}/edit', 'edit')->name('admin.categories.edit');
        Route::put('/{id}', 'update')->name('admin.categories.update');
        Route::delete('/{id}', 'destroy')->name('admin.categories.destroy');
    });

    Route::group(['prefix' => 'admin/products', 'controller' => ProductController::class], function () {
        Route::get('/', 'index')->name('admin.products.index');
        Route::get('/create', 'create')->name('admin.products.create');
        Route::post('/', 'store')->name('admin.products.store');
        Route::get('/{id}', 'show')->name('admin.products.show');
        Route::get('/{id}/edit', 'edit')->name('admin.products.edit');
        Route::put('/{id}', 'update')->name('admin.products.update');
        Route::delete('/{id}', 'destroy')->name('admin.products.destroy');
    });
});



require __DIR__.'/auth.php';
