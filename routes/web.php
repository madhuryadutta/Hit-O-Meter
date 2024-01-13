<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageViewCountLinkCreationController;
use App\Http\Controllers\PageViewCountLogController;
use App\Http\Controllers\LoginController;

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

Route::get('/', function () {
    return view('homepage');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'loginView')->name('login');
    Route::post('/login_request', 'authenticate');
    Route::post('/register', 'registerView');
    Route::post('/register_request', 'register');
    Route::get('/logout', 'logout');
});



Route::middleware(['auth'])->group(function () {
    Route::controller(PageViewCountLinkCreationController::class)->group(function () {
        Route::get('/dashboard', 'view')->name('tracker.list');
        Route::get('/tracker/view',  'index')->name('tracker.view');
        Route::get('/tracker/delete/{id}', 'destroy')->name('tracker.delete');
        // Route::get('/customer/edit/{id}', 'edit')->name('tracker.edit');
        // Route::post('/customer/update/{id}',[CustomerController::class,'update'])->name('customer.update');
    });
});

Route::controller(PageViewCountLinkCreationController::class)->group(function () {
    Route::get('/new_tracker_form',  'index')->name('tracker.create');
    Route::post('/new_tracker', 'store')->name('tracker.save');
    Route::get('/tracker/view',  'index')->name('tracker.view');
});

// for testing
Route::controller(PageViewCountLogController::class)->group(function () {
    Route::get('/logtest',  'logtest')->name('logtest.1');
    Route::get('/logtest2',  'logtest2')->name('logtest.2');
    Route::get('/logtest3',  'logtest3')->name('logtest.3');
    Route::get('/logtest4',  'logtest4')->name('logtest.4');
});
// for testing

// Main link for performing all logic 
Route::get('/track/{number}/{optional?}', [PageViewCountLogController::class, 'log'])->name('track.log');

// Single Tracker Log view 
Route::get('/tracker/logs/{number}/{optional?}', [PageViewCountLogController::class, 'logView'])->name('tracker.logs');


Route::get('/date', function (Request $request) {
    $now = new DateTime();
    $str_now = str_replace("-", "", $now->format('Y-m-d'));
    echo ($str_now);
});
