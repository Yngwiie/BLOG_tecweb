<?php

use Illuminate\Support\Facades\Route;
use App\http\LiveWire\Posts;
use App\Models\Post;
use App\Http\Controllers\PostController;
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
    $posts = Post::orderBy('id','DESC')->paginate(10);
    return view('welcome',['posts'=>$posts]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',Posts::class)->name('dashboard');


Route::get('/noticias',[PostController::class, 'index'])->name('noticias.index');
Route::get('/noticas/{id}',[PostController::class,'show'])->name('noticia.show');