<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('curriculum.index');
    });

    Route::prefix('curriculo')->group(function () {
        Route::get('/', [\App\Http\Controllers\CurriculumController::class, 'index'])->name('curriculum.index');
        Route::get('/novo/{id?}', [\App\Http\Controllers\CurriculumController::class, 'create'])->name('curriculum.create');
        Route::post('/novo', [\App\Http\Controllers\CurriculumController::class, 'store'])->name('curriculum.store');
        Route::get('/{id}/editar', [\App\Http\Controllers\CurriculumController::class, 'edit'])->name('curriculum.edit');
        Route::put('/{id}', [\App\Http\Controllers\CurriculumController::class, 'update'])->name('curriculum.update');
        Route::delete('/{id}', [\App\Http\Controllers\CurriculumController::class, 'destroy'])->name('curriculum.destroy');
    });

    Route::prefix('usuarios')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/novo', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/novo', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/{id}/editar', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    });
});

Route::prefix('login')->group(function () {
    Route::get('/', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/', [\App\Http\Controllers\LoginController::class, 'login'])->name('login.do');
    Route::get('/sair', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});

Route::prefix('register')->group(function () {
    Route::get('/', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register');
    Route::post('/', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register.do');
});
