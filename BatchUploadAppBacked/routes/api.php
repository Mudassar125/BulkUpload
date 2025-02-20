<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\BatchRecordController;




Route::post('/upload-batch',[BatchController::class,'upload']);

Route::get('/batches', [BatchController::class, 'index']);
Route::get('/batch-records/{batch_id}', [BatchRecordController::class, 'index']);

