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

    Route::middleware(['admin'])
        ->prefix('admin/users')
        ->name('admin.users.')
        ->controller(RegisteredUserController::class)
        ->group(function () {
            Route::get('/', 'index')
                ->name('index');

            Route::get('/create', 'create')
                ->name('create');

            Route::post('/', 'store')
                ->name('store');

            Route::get('/{user}/edit', 'edit')
                ->name('edit');

            Route::put('/{user}', 'update')
                ->name('update');

            Route::delete('/{user}', 'destroy')
                ->name('destroy');
        });
});


Route::middleware(['auth'])
    ->prefix('admin/pages')
    ->name('admin.pages.')
    ->controller(PageController::class)
    ->group(function () {
        Route::get('/', 'index')
            ->name('index');

        Route::get('/create', 'create')
            ->name('create');

        Route::post('/', 'store')
            ->name('store');

        Route::get('/{id}', 'show')
            ->name('show');

        Route::get('/{id}/edit', 'edit')
            ->name('edit');

        Route::put('/{id}', 'update')
            ->name('update');

        Route::delete('/{id}', 'destroy')
            ->name('destroy');
    });


Route::middleware(['auth'])
    ->prefix('admin/categories')
    ->name('admin.categories.')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('/', 'index')
            ->name('index');

        Route::get('/create', 'create')
            ->name('create');

        Route::post('/', 'store')
            ->name('store');

        Route::get('/{id}', 'show')
            ->name('show');

        Route::get('/{id}/edit', 'edit')
            ->name('edit');

        Route::put('/{id}', 'update')
            ->name('update');

        Route::delete('/{id}', 'destroy')
            ->name('destroy');
    });


Route::middleware(['auth'])
    ->prefix('admin/products')
    ->name('admin.products.')
    ->controller(ProductController::class)
    ->group(function () {
        Route::get('/', 'index')
            ->name('index');

        Route::get('/create', 'create')
            ->name('create');

        Route::post('/', 'store')
            ->name('store');

        Route::get('/{id}', 'show')
            ->name('show');

        Route::get('/{id}/edit', 'edit')
            ->name('edit');

        Route::put('/{id}', 'update')
            ->name('update');

        Route::delete('/{id}', 'destroy')
            ->name('destroy');
    });



require __DIR__.'/auth.php';
