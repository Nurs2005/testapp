<?php

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
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');
    Route::get('/post/{id}/{comment_id?}', [App\Http\Controllers\PostController::class, 'post_detail'])->name('post_detail');
});

Route::post('/post_save', [App\Http\Controllers\PostController::class, 'post_save'])->name('post_save');
Route::post('/comment_save', [App\Http\Controllers\PostController::class, 'comment_save'])->name('comment_save');
Route::post('/comment_delete', [App\Http\Controllers\PostController::class, 'comment_delete'])->name('comment_delete');



Auth::routes();

