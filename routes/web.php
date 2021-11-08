<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LogsController;
use App\Http\Controllers\Backend\BeaconController;
use App\Http\Controllers\Backend\DeviceController;
use App\Http\Controllers\Backend\TriggerController;
use App\Http\Controllers\Backend\NotificationController;

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
    return redirect('/login');
});
Route::get('/register', function () {
    return abort(404);
});
Route::get('/forgot-password', function () {
    return abort(404);
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/send-notification', [\App\Http\Controllers\Backend\NotificationController::class, 'sendNotification'])->name('send.notification');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function () {
    Route::get('dashboard', [\App\Http\Controllers\Backend\HomeController::class, 'index'])->name('dashboard');
    Route::resource('beacon', App\Http\Controllers\Backend\BeaconController::class);
    Route::resource('trigger', App\Http\Controllers\Backend\TriggerController::class); 
    Route::resource('logs', App\Http\Controllers\Backend\LogsController::class); 
    Route::resource('device', App\Http\Controllers\Backend\DeviceController::class);
});


