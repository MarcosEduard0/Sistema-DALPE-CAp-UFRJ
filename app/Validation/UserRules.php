<?php

namespace App\Validation;

use App\Models\UsuariosModel;

class UserRules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new UsuariosModel();
        $user = $model->where('usuario', $data['usuario'])->fist();

        if (!$user)
            return false;

        return password_verify($data['senha'], $user['senha']);
    }
}
