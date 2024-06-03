<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

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
    return view('index', ['menu' => 'home']);
})->name('login');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/setwebhook', function () {
    $response = Telegram::setWebhook(['url' => env('APP_URL') . '/' . env('TELEGRAM_TOKEN') . '/webhook']);
    dd($response);
});
Route::post(env('TELEGRAM_TOKEN') . '/webhook', [AntrianController::class, 'webhook']);
