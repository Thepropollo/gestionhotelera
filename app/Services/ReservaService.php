<?php

namespace App\Services;

use App\Repositories\ReservaRepository;
use Illuminate\Validation\ValidationException;
use App\Models\Participacion;
use Illuminate\Http\Request;




class ReservaService
{
    protected $reservaRepo;

    public function __construct(ReservaRepository $reservaRepo)
    {
        $this->reservaRepo = $reservaRepo;
    }

    public function validarDisponibilidad(string $tipo, int $id_objeto, $inicio, $fin)
    {
        $existe = $this->reservaRepo->existeReservaEnRango($tipo, $id_objeto, $inicio, $fin);

        if ($existe) {
            throw ValidationException::withMessages([
                'disponibilidad' => 'El recurso ya está reservado en ese rango de fechas.'
            ]);
        }
    }

    public function obtenerTodas()
    {
        return $this->reservaRepo->all();
    }

    public function obtenerPorId($id)
    {
        return $this->reservaRepo->find($id);
    }

    public function crear(array $data)
{
    return $this->reservaRepo->create($data);
}


    public function actualizar($id, array $data)
    {
        return $this->reservaRepo->update($id, $data);
    }

    public function eliminar($id)
    {
        return $this->reservaRepo->delete($id);
    }

    public function cancelar($id)
    {
    $reserva = $this->reservaRepo->find($id);

    if ($reserva->estado === 'cancelada') {
        return ['message' => 'La reserva ya está cancelada.'];
    }

    return $this->reservaRepo->update($id, ['estado' => 'cancelada']);
    }

    public function obtenerPorCliente($clienteId)
    {
    return $this->reservaRepo->reservasPorCliente($clienteId);
    }

    public function asociarParticipaciones($reservaId, array $usuarios)
    {
    $participaciones = [];

    foreach ($usuarios as $data) {
        $participaciones[] = Participacion::create([
            'reserva_id'      => $reservaId,
            'usuario_id'      => $data['usuario_id'],
            'rol_en_reserva'  => $data['rol_en_reserva'],
            'observaciones'   => $data['observaciones'] ?? null,
        ]);
    }

    return $participaciones;
    }

    public function cancelarReserva($id)
    {
    $reserva = $this->reservaRepo->find($id);

    if ($reserva->estado === 'cancelada') {
        throw ValidationException::withMessages([
            'estado' => 'La reserva ya está cancelada.'
        ]);
    }

    $reserva->estado = 'cancelada';
    $reserva->save();

    return $reserva;
    }



}
