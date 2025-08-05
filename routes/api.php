<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Api\ClienteController;

Route::apiResource('clientes', ClienteController::class);

use App\Http\Controllers\Api\UsuarioController;

Route::apiResource('usuarios', UsuarioController::class);

use App\Http\Controllers\Api\RolController;

Route::apiResource('roles', RolController::class);

use App\Http\Controllers\Api\HabitacionController;

Route::apiResource('habitaciones', HabitacionController::class);

use App\Http\Controllers\Api\MesaController;

Route::apiResource('mesas', MesaController::class);

use App\Http\Controllers\Api\SalonController;

Route::apiResource('salones', SalonController::class);

use App\Http\Controllers\Api\ServicioController;

Route::apiResource('servicios', ServicioController::class);

use App\Http\Controllers\Api\ServicioExtraController;
use App\Http\Controllers\Api\ReservaController;

Route::apiResource('reservas', ReservaController::class);

use App\Http\Controllers\Api\DetalleReservaController;

Route::apiResource('detalle-reserva', DetalleReservaController::class);

use App\Http\Controllers\Api\FacturaController;

// Route::apiResource('facturas', FacturaController::class);

// use App\Http\Controllers\Api\DetalleFacturaController;

// Route::apiResource('detalle-factura', DetalleFacturaController::class);

use App\Http\Controllers\Api\ParticipacionController;

use App\Http\Middleware\RolMiddleware;

use App\Http\Controllers\Api\AuthController;
Route::post('/login', [AuthController::class, 'login']);

use App\Http\Controllers\Api\DisponibilidadController;

Route::get('disponibilidad', [DisponibilidadController::class, 'consultar']);


// Admin
Route::middleware([
    'auth:sanctum',
    RolMiddleware::class . ':Administrador' // Directamente la clase y los parámetros
])->group(function () {
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('habitaciones', HabitacionController::class);
    Route::apiResource('mesas', MesaController::class);
    Route::apiResource('salones', SalonController::class);
    Route::apiResource('reservas', ReservaController::class);
    Route::apiResource('participaciones', ParticipacionController::class);
    Route::apiResource('servicios-extra', ServicioExtraController::class);

    Route::get('clientes/{id}/reservas', [ReservaController::class, 'reservasPorCliente']);
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

// Recepcionostas
Route::middleware([
    'auth:sanctum',
    RolMiddleware::class . ':Usuario' // Directamente la clase y los parámetros
])->group(function () {
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('reservas', ReservaController::class);
    Route::apiResource('participaciones', ParticipacionController::class);
    Route::apiResource('servicios-extra', ServicioExtraController::class);

    Route::get('clientes/{id}/reservas', [ReservaController::class, 'reservasPorCliente']);
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


Route::middleware([
    'auth:sanctum',
    RolMiddleware::class . ':Propietario' // Directamente la clase y los parámetros
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
