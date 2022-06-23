<?php

namespace App\Models;

use CodeIgniter\Model;

class UniversidadesModel extends Model
{

    //Atributos de config
    protected $table = 'universidades';
    protected $primaryKey = 'universidade_id';
    protected $allowedFields = ['sigla', 'nome'];

    //metodo GET
    public function getUniversidades($id = false)
    {
        if ($id === false)
            return $this->findAll();
        else {
            return $this->asArray()
                ->where(['universidade_id' => $id])
                ->first();
        }
    }

    public function getIdBySigla($sigla)
    {
        return $this->asArray()
            ->where('sigla', $sigla)->first();
    }
}
