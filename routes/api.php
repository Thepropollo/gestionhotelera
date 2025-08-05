<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\HabitacionController;
use App\Http\Controllers\Api\MesaController;
use App\Http\Controllers\Api\SalonController;
use App\Http\Controllers\Api\ServicioController;
use App\Http\Controllers\Api\ServicioExtraController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\DetalleReservaController;
use App\Http\Controllers\Api\FacturaController;
use App\Http\Controllers\Api\ParticipacionController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DisponibilidadController;
use App\Http\Middleware\RolMiddleware;

Route::post('/login', [AuthController::class, 'login']);
Route::get('disponibilidad', [DisponibilidadController::class, 'consultar']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//  Rutas para Administrador y Propietario
Route::middleware([
    'auth:sanctum',
    RolMiddleware::class . ':Administrador,Propietario'
])->group(function () {
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('roles', RolController::class);
    Route::apiResource('habitaciones', HabitacionController::class);
    Route::apiResource('mesas', MesaController::class);
    Route::apiResource('salones', SalonController::class);
    Route::apiResource('servicios', ServicioController::class);
    Route::apiResource('reservas', ReservaController::class);

    Route::get('clientes/{id}/reservas', [ReservaController::class, 'reservasPorCliente']);
});


//  Rutas para Administrador y Usuario (Recepcionistas)
Route::middleware([
    'auth:sanctum',
    RolMiddleware::class . ':Administrador,Usuario'
])->group(function () {

    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('participaciones', ParticipacionController::class);
    Route::apiResource('servicios-extra', ServicioExtraController::class);

    Route::post('reservas/{id}/participaciones', [ReservaController::class, 'asociarParticipantes']);
    Route::put('reservas/{id}/cancelar', [ReservaController::class, 'cancelar']);
    Route::get('reservas/{reservaId}/servicios', [DetalleReservaController::class, 'index']);
    Route::post('reservas/{reservaId}/servicios', [DetalleReservaController::class, 'store']);

    Route::post('/facturar', [FacturaController::class, 'facturar']);
    Route::post('/facturas/completa', [FacturaController::class, 'facturar']);
    Route::patch('facturas/{id}/pagar', [FacturaController::class, 'marcarComoPagada']);
    Route::get('clientes/{id}/facturas', [FacturaController::class, 'facturasPorCliente']);
    Route::post('facturas/consolidar', [FacturaController::class, 'consolidarFactura']);
});
