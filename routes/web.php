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

Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login_request', [LoginController::class, 'authenticate']);
Route::post('/register', [LoginController::class, 'register']);




Route::get('/', [PageViewCountLinkCreationController::class, 'view'])->name('tracker.list');
Route::get('/new_tracker_form', [PageViewCountLinkCreationController::class, 'index'])->name('tracker.create');
Route::post('/new_tracker', [PageViewCountLinkCreationController::class, 'store'])->name('tracker.save');
Route::get('/tracker/view', [PageViewCountLinkCreationController::class, 'index'])->middleware('auth')->name('tracker.view');
Route::get('/customer/delete/{id}', [PageViewCountLinkCreationController::class, 'destroy'])->name('tracker.delete');
Route::get('/customer/edit/{id}', [PageViewCountLinkCreationController::class, 'edit'])->name('tracker.edit');
// Route::post('/customer/update/{id}',[CustomerController::class,'update'])->name('customer.update');


// Main link for performing all logic 
Route::get('/track/{number}/{optional?}', [PageViewCountLogController::class, 'log'])->name('track.log');

// Single Tracker Log view 
Route::get('/tracker/logs/{number}/{optional?}', [PageViewCountLogController::class, 'logView'])->name('tracker.logs');


Route::get('/date', function (Request $request) {
    $now = new DateTime();
    $str_now = str_replace("-", "", $now->format('Y-m-d'));
    echo ($str_now);
});
