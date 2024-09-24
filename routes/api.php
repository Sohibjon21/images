<?php

use App\Http\Controllers\Integration\ImagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('infos',[ImagesController::class,'getInfo']);
Route::get('info',[ImagesController::class,'getInfoById']);