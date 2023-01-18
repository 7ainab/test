<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::group(['prefix'=> 'admin','middleware'=>'auth'],function(){

//route post
    Route::get('/posts', [App\Http\Controllers\PostsController::class,'index'])->name('posts');
    Route::get('/post/create', [App\Http\Controllers\PostsController::class, 'create'])->name('post.create');
    Route::post('/post/store', [App\Http\Controllers\PostsController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{id}', [App\Http\Controllers\PostsController::class,'edit'])->name('post.edit');
    Route::post('/post/update/{id}', [App\Http\Controllers\PostsController::class,'update'])->name('post.update');
    Route::get('/post/delete/{id}', [App\Http\Controllers\PostsController::class,'destroy'])->name('post.delete'); 


//route category
    Route::get('/categories', [App\Http\Controllers\CategoriesController::class,'index'])->name('categories'); 
    Route::get('/category/create', [App\Http\Controllers\CategoriesController::class, 'create'])->name('category.create');
    Route::post('/category/store', [App\Http\Controllers\CategoriesController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoriesController::class,'edit'])->name('category.edit');
    Route::get('/category/delete/{id}', [App\Http\Controllers\CategoriesController::class,'destroy'])->name('category.delete');
    Route::post('/category/update/{id}', [App\Http\Controllers\CategoriesController::class,'update'])->name('category.update');
//});
