<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

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

Route::get('/test', [Controller::class, 'get_comm']);

Route::get('/profile/all', [UserController::class, 'users_list']);

Route::get('profile/{id?}', [UserController::class, 'show_profile'])->where('id', '[0-9]+');

Route::post('/profile/{id}/add_comment', [CommentController::class, 'add_comment'])->where('id', '[0-9]+');

Route::post('/profile/{id}/del_comment', [CommentController::class, 'del_comment'])->where('id', '[0-9]+');

Route::get('/profile/{id}/all_comments', [CommentController::class, 'show_all_comments'])->where('id', '[0-9]+');

Route::get('/profile/{id}/show_full_profile', [UserController::class, 'show_full_profile']);
?>