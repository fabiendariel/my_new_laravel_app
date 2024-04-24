<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () 
{
    return view('welcome');
});

Route::prefix('/blog')->controller(BlogController::class)->name('blog.')->group(function()
{

    Route::get('/', 'index')->name('index');

    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store')->name('store');

    Route::get('/{post}/edit', 'edit')->name('edit');
    Route::patch('/{post}/edit', 'update')->name('update');

    Route::get('/{slug}-{post}', 'show')->where([
        'post' => '[0-9]*',
        'slug' => '[a-z0-9\-]*'
    ])
    ->name('show');
});
