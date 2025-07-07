<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\FacturaCompletaRequest;
use App\Http\Requests\ConsolidarFacturaRequest;
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

    public function facturar(FacturaCompletaRequest $request)
    {
        $factura = $this->facturaService->procesarFacturaCompleta($request->validated());
        return response()->json($factura, 201);
    }

    public function marcarComoPagada($id)
    {
    $factura = $this->facturaService->marcarPagada($id);

    return response()->json([
        'message' => 'Factura marcada como pagada correctamente.',
        'factura' => $factura
    ]);
    }

    public function facturasPorCliente($clienteId)
    {
    $facturas = $this->facturaService->obtenerPorCliente($clienteId);

    return response()->json([
        'facturas' => $facturas
    ]);
    }

    public function consolidarFactura(ConsolidarFacturaRequest $request)
    {
    $data = $request->validated();
    $factura = $this->facturaService->crearFacturaConsolidada($data);

    return response()->json([
        'message' => 'Factura consolidada creada exitosamente',
        'factura' => $factura,
    ], 201);
    }

    public function store(StoreFacturaRequest $request)
    {
        $data = $request->validated();

        $factura = $this->service->crearFacturaConReservas($data);

        return response()->json($factura, 201);
    }

}
