<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ChannelMemberController;
use App\Http\Controllers\MessageController;

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


// Login/Logout routes
Route::view('/login', 'login')->middleware('returnIfAuthenticated');
Route::post('/api/account/login', [AccountController::class, 'login'])->name('login');
Route::get('/logout', [AccountController::class, 'logout']);


// Register routes
Route::view('/register', 'register')->middleware('returnIfAuthenticated');
Route::post('/api/account/register', [AccountController::class, 'register'])->name('register');


// Home Routes
Route::get('/', [AccountController::class, 'home'])->middleware('redirectIfAnonymous');


// API Endpoint
Route::middleware('verifySession')->group(function () {

    // User Endpoints
    Route::get('/api/user', [UserController::class, 'getList']);
    Route::get('/api/user/profile', [UserController::class, 'getProfileDetails']);
    Route::put('/api/user/profile', [UserController::class, 'updateProfile']);
    Route::put('/api/user/password', [UserController::class, 'updatePassword']);
    Route::post('/api/user/picture', [UserController::class, 'updatePicture']);


    // Channel Endpoints
    Route::get('/api/channel', [ChannelController::class, 'getList']);
    Route::post('/api/channel', [ChannelController::class, 'create']);
    Route::put('/api/channel', [ChannelController::class, 'update']);
    Route::delete('/api/channel', [ChannelController::class, 'delete']);


    // Channel Members Endpoints
    Route::get('/api/members/', [ChannelMemberController::class, 'getMembers']);
    Route::put('/api/members/', [ChannelMemberController::class, 'updateMembers']);

    
    // Message Endpoints
    Route::get('/api/message', [MessageController::class, 'receive']);
    Route::post('/api/message', [MessageController::class, 'send']);
    Route::post('/api/message/upload', [MessageController::class, 'upload']);
    Route::get('/api/message/download', [MessageController::class, 'download']);
});







