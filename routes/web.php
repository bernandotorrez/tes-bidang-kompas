<?php

use App\Http\Controllers\PostArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublishingArticleController;
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
        // Reporter/Post-Article
        Route::group(['prefix' => 'post-article'], function () {
            Route::get('/', [PostArticleController::class, 'index'])->name('post-article.index');
            Route::post('/insert', [PostArticleController::class, 'insert'])->name('post-article.insert');
            Route::get('/get/{id?}', [PostArticleController::class, 'get'])->name('post-article.get');
            Route::post('/update', [PostArticleController::class, 'update'])->name('post-article.update');
            Route::post('/delete', [PostArticleController::class, 'delete'])->name('post-article.delete');
            Route::get('/datatable', [PostArticleController::class, 'datatable'])->name('post-article.datatable');
        });
    });

    // Editor Page
    Route::group(['prefix' => 'editor', 'middleware' => ['auth.editor']], function() {
        // Reporter/Publishing-Article
        Route::group(['prefix' => 'publish-article'], function () {
            Route::get('/', [PublishingArticleController::class, 'index'])->name('publish-article.index');
            Route::get('/get/{id?}', [PublishingArticleController::class, 'get'])->name('publish-article.get');
            Route::post('/update', [PublishingArticleController::class, 'update'])->name('publish-article.update');
            Route::get('/datatable', [PublishingArticleController::class, 'datatable'])->name('publish-article.datatable');
        });
    });
});
