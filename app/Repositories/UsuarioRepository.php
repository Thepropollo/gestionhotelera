<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    public function all()
    {
        return Usuario::all();
    }

    public function find($id)
    {
        return Usuario::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return Usuario::create($data);
    }

    public function update($id, array $data)
    {
        $usuario = Usuario::findOrFail($id);
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $usuario->update($data);
        return $usuario;
    }

    public function delete($id)
    {
        return Usuario::findOrFail($id)->delete();
    }
}
