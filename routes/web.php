<?php

use App\Http\Controllers\apiDocuController;
use App\Http\Controllers\galleryController;
use App\Http\Controllers\screenshotController;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [screenshotController::class, 'index']);
Route::get('/screenshooter', [screenshotController::class, 'index']);
Route::post('/screenshooter/create', [screenshotController::class, 'createScreenshot']);

Route::get('/gallery', [galleryController::class, 'index']);
Route::get('/api-documentation', [apiDocuController::class, 'index']);

Route::post('/download-image', [galleryController::class, 'downloadImage']);
Route::post('/delete-image', [galleryController::class, 'deleteImage']);
Route::post('/convert-to-ascii', [galleryController::class, 'imageToAscii']);