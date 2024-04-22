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

    Route::get('/{slug}-{id}', 'show')->where([
        'id' => '[0-9]*',
        'slug' => '[a-z0-9\-]*'
    ])
    ->name('show');
});
