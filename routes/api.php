<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\AirportController;
use App\Http\Controllers\Api\FlightTicketController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Aeroportos */
Route::get('/airports', [AirportController::class, 'index']);
Route::get('/airports/{id}', [AirportController::class, 'show']);

/* Vôos */
Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/{id}', [FlightController::class, 'show']);
Route::post('/flights', [FlightController::class, 'store']);

/* Passagens */
Route::get('/tickets', [FlightTicketController::class, 'index']);
Route::get('/tickets/{ticket}', [FlightTicketController::class, 'show']);
Route::get('/tickets/{ticket}/voucher', [FlightTicketController::class, 'voucher']);
Route::put('/tickets/{ticket}/buy', [FlightTicketController::class, 'buy']);
Route::put('/tickets/{ticket}/cancel', [FlightTicketController::class, 'cancel']);