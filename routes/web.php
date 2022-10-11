<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PageController;

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

Route::name('web.')->middleware(['html.minifier'])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/{slug}', [PageController::class, 'post'])->name('post');
    Route::get('/tag/{slug}', [PageController::class, 'tag'])->name('tag');
//    Route::get('/search', [PageController::class, 'search'])->name('search');
    Route::get('/category/{slug}', [PageController::class, 'category'])->name('category');
    Route::post('/recaptcha', [PageController::class, 'recaptcha'])->name('recaptcha');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
