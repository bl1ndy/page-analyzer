<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UrlCheckController;

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
Route::resources([
    'urls' => UrlController::class,
    'urls.checks' => UrlCheckController::class
]);

Route::get(
    '/',
    function (): Illuminate\View\View {
        return view('url.create');
    }
)->name('home');

Route::post('/', [UrlController::class, 'store']);

Route::post('/urls/{id}/checks', [UrlCheckController::class, 'store']);
