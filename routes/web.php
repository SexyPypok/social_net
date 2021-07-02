<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibAccessController;
use App\Http\Controllers\LibAccessNonAuthController;

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

Route::get('/profile/all', [UserController::class, 'users_list']);

Route::get('profile/{id?}', [UserController::class, 'show_profile'])->where('id', '[0-9]+')->name('home');

Route::post('profile/{profile_id}/answer/{comment_id}', [CommentController::class, 'answer_comment'])
->where('id', '[0-9]+')->middleware('auth');

Route::post('/profile/{id}/add_comment', [CommentController::class, 'add_comment'])
    ->where('id', '[0-9]+')->middleware('auth');

Route::post('/profile/{id}/del_comment', [CommentController::class, 'del_comment'])
    ->where('id', '[0-9]+')->middleware('auth');

Route::get('/profile/{id}/all_comments', [CommentController::class, 'show_all_comments'])->where('id', '[0-9]+');

Route::get('show_full_profile/{id?}', [UserController::class, 'show_full_profile'])->where('id', '[0-9]+');

Route::get('share_library/{id?}', [LibAccessController::class, 'share_library'])->where('id', '[0-9]+')
    ->middleware('auth');

Route::get('hide_library/{id?}', [LibAccessController::class, 'hide_library'])->where('id', '[0-9]+')
    ->middleware('auth');

Route::get('/profile/library', [UserController::class, 'redirect_to_library'])->middleware('auth');

Route::get('/profile/library/{id}', [UserController::class, 'show_library'])->where('id', '[0-9]+')
    ->middleware('auth')->middleware('lib');

Route::get('/profile/library/{id}/read/{book_id}', [BookController::class, 'show_book'])
    ->where(['user_id' => '[0-9]+', 'book_id' => '[0-9]+'])->middleware('auth')->middleware('lib');

Route::get('/profile/library/{user_id}/add_book_form', [BookController::class, 'add_book_form'])
    ->where(['user_id' => '[0-9]+'])->middleware('auth');

Route::post('/profile/library/{user_id}/add_book', [BookController::class, 'add_book'])
    ->where(['user_id' => '[0-9]+'])->middleware('auth');

Route::get('/profile/library/{user_id}/edit/{book_id}', [BookController::class, 'edit_book_form'])
    ->where(['user_id' => '[0-9]+', 'book_id' => '[0-9]+'])->middleware('auth')->middleware('author');

Route::post('/profile/library/{user_id}/save_book/{book_id}', [BookController::class, 'save_book'])
    ->where(['user_id' => '[0-9]+', 'book_id' => '[0-9]+'])->middleware('auth')->middleware('author');

Route::get('/profile/library/{user_id}/delete/{book_id}', [BookController::class, 'delete_book'])
    ->where(['user_id' => '[0-9]+', 'book_id' => '[0-9]+'])->middleware('auth')->middleware('author');

Route::get('/profile/library/{user_id}/share_by_link/{book_id}', [LibAccessNonAuthController::class, 'share_by_link'])
    ->where(['user_id' => '[0-9]+', 'book_id' => '[0-9]+'])->middleware('auth')->middleware('author');

Route::get('/profile/library/{user_id}/hide_by_link/{book_id}', [LibAccessNonAuthController::class, 'hide_by_link'])
    ->where(['user_id' => '[0-9]+', 'book_id' => '[0-9]+'])->middleware('auth')->middleware('author');

Route::get('/read/{book_id}', [BookController::class, 'show_book_unreg'])
    ->where(['book_id' => '[0-9]+'])->middleware('book');   


?>