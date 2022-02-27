<?php

use App\Http\Controllers\CalendarController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CalendarController::class)->group(function () {
    Route::resource('calendar', CalendarController::class)->only(['index','edit','store']);
    Route::get('getevents','getEvents')->name('calendar.getevents');
    Route::put('update/events','updateEvents')->name('calendar.updateevents');
});

