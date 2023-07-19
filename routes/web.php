<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PageNotFoundController;

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

//* Registro de usuario
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

//* Login de usuario
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

//* Logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//* CRUD de publicaciones
Route::get('/{user:path}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:path}/posts/{post:id}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/{user:path}/posts/{post:id}', [PostController::class, 'destroy'])->name('posts.destroy');

//* Crear comentarios
Route::post('/{user:path}/posts/{post:id}', [CommentController::class, 'store'])->name('comments.store');

//* Añadir imagenes
Route::post('/images/{kind}', [ImageController::class, 'store'])->name('images.store');

//* Dar likes a las publicaciones y comentarios
Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/likes', [LikeController::class, 'destroy'])->name('likes.destroy');

//* Edicion de perfil
Route::get('{user:path}/edit', [ProfileController::class, 'index'])->name('profile.index');
Route::post('{user:path}/edit', [ProfileController::class, 'store'])->name('profile.store');

//* Follows a usuarios
Route::post('/{followed:path}/follow', [FollowerController::class, 'store'])->name('follower.store');
Route::delete('/{followed:path}/follow', [FollowerController::class, 'destroy'])->name('follower.destroy');

//* Devuelve cualquier vista que no coincida a login o a dashboard dependiendo si está autenticado o no
// Route::get('/{any}', [PageNotFoundController::class, 'redirectAuth'])->where('any', '.*')->name('root');
Route::fallback([PageNotFoundController::class, 'redirectAuth'])->name('root');
