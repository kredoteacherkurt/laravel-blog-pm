<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Auth::routes();


// route controls users from going to homepage without logging in
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [PostController::class, 'index'])->name('index');

    Route::group(["as"=> "post.", "prefix"=>"post"], function () {
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/show/{post}', [PostController::class, 'show'])->name('show');
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
        Route::patch('/update/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('destroy');
    });
});
