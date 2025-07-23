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

Route::apiResource('servicios-extra', ServicioExtraController::class);

use App\Http\Controllers\Api\ReservaController;

Route::apiResource('reservas', ReservaController::class);

use App\Http\Controllers\Api\DetalleReservaController;

// Route::apiResource('detalle-reserva', DetalleReservaController::class);

use App\Http\Controllers\Api\FacturaController;

// Route::apiResource('facturas', FacturaController::class);

use App\Http\Controllers\Api\DetalleFacturaController;

// Route::apiResource('detalle-factura', DetalleFacturaController::class);

use App\Http\Controllers\Api\ParticipacionController;

Route::apiResource('participaciones', ParticipacionController::class);

use App\Http\Middleware\RolMiddleware;


use App\Http\Controllers\Api\AuthController;
Route::post('/login', [AuthController::class, 'login']);

// // Route::middleware('auth:sanctum')->group(function () {
// //     Route::post('/logout', [AuthController::class, 'logout']);

// //     Route::apiResource('clientes', ClienteController::class);
// //     Route::apiResource('usuarios', UsuarioController::class);
// //     Route::apiResource('habitaciones', HabitacionController::class);
// // });


// // Solo Administradores
// Route::middleware([
//     'auth:sanctum',
//     RolMiddleware::class . ':Administrador' // Directamente la clase y el parámetro con dos puntos
// ])->group(function () {
//     Route::apiResource('usuarios', UsuarioController::class);
//     Route::apiResource('roles', RolController::class);
// });

// Admin y Recepcionistas
Route::middleware([
    'auth:sanctum',
    RolMiddleware::class . ':Administrador,Usuario' // Directamente la clase y los parámetros
])->group(function () {
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('reservas', ReservaController::class);
    Route::get('clientes/{id}/reservas', [ReservaController::class, 'reservasPorCliente']);
    Route::post('reservas/{id}/participaciones', [ReservaController::class, 'asociarParticipantes']);
    Route::post('reservas/{id}/cancelar', [ReservaController::class, 'cancelar'])->middleware('auth:sanctum');
    Route::get('reservas/{reservaId}/servicios', [DetalleReservaController::class, 'index']);
    Route::post('reservas/{reservaId}/servicios', [DetalleReservaController::class, 'store']);
});

// 3|eZLq4MawYNyPTT14Tj7tJJRmRcG41x9wUehtibNt65d2c503

// 4|y06UgPemR6T6KgrpNFHQp21PDa2yQCsWW3vpyGRo2c8bd55f


// Route::middleware('auth:sanctum')->post('/facturar', [FacturaController::class, 'facturar']);

use App\Http\Controllers\Api\DisponibilidadController;

// Route::get('disponibilidad', [DisponibilidadController::class, 'consultar']);

// Route::put('reservas/{id}/cancelar', [ReservaController::class, 'cancelar']);



// Route::middleware(['auth:sanctum'])->patch('facturas/{id}/pagar', [FacturaController::class, 'marcarComoPagada']);

// Route::middleware('auth:sanctum')->get('clientes/{id}/facturas', [FacturaController::class, 'facturasPorCliente']);

// Route::middleware('auth:sanctum')->post('facturas/consolidar', [FacturaController::class, 'consolidarFactura']);
// //1|fKRCu1WceC52iawScl5i3Ct9HWNreDSx0rU07R745c92873d


// Route::post('/facturas/completa', [FacturaController::class, 'facturar']);
