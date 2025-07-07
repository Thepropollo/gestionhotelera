<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacturaCompletaRequest;
use App\Http\Requests\StoreFacturaCompletaRequest;
use App\Http\Requests\ConsolidarFacturaRequest;
use Illuminate\Http\JsonResponse;
use App\Services\FacturaService;

class FacturaController extends Controller
{
    protected $facturaService;

    //mostrar facturas todas
    public function index()
    {
        return response()->json($this->facturaService->obtenerTodas());
    }

    public function __construct(FacturaService $facturaService)
    {
        $this->facturaService = $facturaService;
    }


    public function facturasPorCliente($clienteId)
    {
    $facturas = $this->facturaService->obtenerPorCliente($clienteId);

    return response()->json([
        'facturas' => $facturas
    ]);
    }

    public function facturar(StoreFacturaCompletaRequest $request): JsonResponse
    {
        try {
            $factura = $this->facturaService->facturar($request->validated());
            return response()->json([
                'mensaje' => 'Factura generada exitosamente.',
                'factura' => $factura
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'mensaje' => 'Error al generar la factura.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreFacturaRequest $request)
    {
        $data = $request->validated();

        $factura = $this->service->crearFacturaConReservas($data);

        return response()->json($factura, 201);
    }

}
