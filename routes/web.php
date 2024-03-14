<?php

use App\Http\Controllers\FileController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FileController::class, 'index'])->name('index');

Route::prefix('images')->group(function () {
    Route::get('/upload', [FileController::class, 'upload'])->name('images.upload');
    Route::get('/show', [FileController::class, 'show'])->name('images.show');
    Route::get('/download', [FileController::class, 'downloadZip'])->name('images.download');
    Route::post('/upload', [FileController::class, 'store'])->name('images.upload');
});
