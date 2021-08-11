<?php

use App\Http\Controllers\API\V1\BorrowRoomApiController;
use App\Http\Controllers\HomeController;
use Illuminate\Routing\Router;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rooms', [HomeController::class, 'rooms'])->name('rooms');

Route::group([
    'prefix'    => 'api/v1',
    'as'        => 'api.v1.'
], function (Router $router) {
    $router->post('borrow-room-with-college-student', [BorrowRoomApiController::class, 'storeBorrowRoomWithCollegeStudent'])->name('borrow-room-with-college-student');
});
