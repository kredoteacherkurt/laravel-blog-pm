<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Auth::routes();


// route controls users from going to homepage without logging in
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Route::group(["as"=> "post.", "prefix"=>"post"], function () {
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
    });
});
