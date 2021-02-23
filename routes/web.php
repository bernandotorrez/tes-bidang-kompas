<?php

use App\Http\Controllers\PostArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login/login', [LoginController::class, 'login'])->name('login.login');
Route::get('/login/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    // Reporter Page
    Route::group(['prefix' => 'reporter', 'middleware' => ['auth.reporter']], function() {
        // Pemrakarsa/Pengajuan Prosun
        Route::group(['prefix' => 'post-article'], function () {
            Route::get('/', [PostArticleController::class, 'index'])->name('post-article.index');
            Route::get('/datatable', [PostArticleController::class, 'datatable'])->name('post-article.datatable');
        });
    });
});
