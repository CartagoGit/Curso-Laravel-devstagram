<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PageNotFoundController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/{user:path}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:path}/posts/{post:id}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/{user:path}/posts/{post:id}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:path}/posts/{post:id}', [CommentController::class, 'store'])->name('comments.store');

Route::post('/images', [ImageController::class, 'store'])->name('images.store');
Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');

//* Devuelve cualquier vista que no coincida a login o a dashboard dependiendo si está autenticado o no
// Route::get('/{any}', [PageNotFoundController::class, 'redirectAuth'])->where('any', '.*')->name('root');
Route::fallback([PageNotFoundController::class, 'redirectAuth'])->name('root');
