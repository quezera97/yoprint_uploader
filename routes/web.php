<?php

use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UploadFileController::class, 'index'])->name('home');
