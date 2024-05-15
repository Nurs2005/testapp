<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\Api\PostController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts/{category_id?}', [App\Http\Controllers\PostController::class, 'post_list']);
Route::get('categories', [App\Http\Controllers\PostController::class, 'get_categories']);
Route::post('post', [App\Http\Controllers\PostController::class, 'post_save_api']);
Route::get('comments/{post_id}', [App\Http\Controllers\CommentController::class, 'getPostCommentsByPostId']);
Route::post('comment_save', [App\Http\Controllers\CommentController::class, 'saveComment']);
Route::post('comment_delete', [App\Http\Controllers\CommentController::class, 'comment_delete']);
