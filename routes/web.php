<?php

use App\Http\Controllers\Ip2geoController;
use App\Models\Ip2geo;
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

Route::get('/', [Ip2geoController::class, 'index']);

// Route::get('/ip2geo/{ip}', [Ip2geoController::class, 'show']);

