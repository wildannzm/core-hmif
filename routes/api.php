<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AttendanceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::domain('{account}.example.com')->group(function () {
    Route::post('/attendance/tap', [AttendanceController::class, 'storeTap'])
        ->middleware('api.token');
});
