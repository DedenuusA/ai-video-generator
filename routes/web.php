<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::get('/', [VideoController::class, 'index']);
Route::post('/generate-video', [VideoController::class, 'generate'])->name('generate.video');

// Route::get('/', function () {
//     return view('welcome');
// });
