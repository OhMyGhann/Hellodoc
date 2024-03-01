<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\SpecializationController;
use App\Http\Controllers\API\DoctorSpecializationController;
use App\Http\Controllers\API\QualificationController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\Client_AccountController;
use App\Http\Controllers\API\AppBookingChannelController;
use App\Http\Controllers\API\AppointmentController;
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

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::resource('doctor', DoctorController::class);
    Route::resource('appointment', AppointmentController::class);
    Route::resource('client', ClientController::class);
    Route::resource('client_account', Client_AccountController::class);

    Route::resource('app_booking_channel', AppBookingChannelController::class);
});
        
Route::middleware('auth:sanctum')->group( function () {
    
    //Route Api Managing Doctors’ Data
  
    Route::resource('specialization', SpecializationController::class);
    Route::resource('doctorspecialization', DoctorSpecializationController::class);
    Route::resource('qualification',  QualificationController::class);
   
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
