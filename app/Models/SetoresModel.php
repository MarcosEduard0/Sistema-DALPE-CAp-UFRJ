<?php

namespace App\Models;

use CodeIgniter\Model;

class SetoresModel extends Model
{

    //Atributos de config
    protected $table = 'setores';
    protected $primaryKey = 'setor_id';
    protected $allowedFields = ['nome', 'descricao'];

    //metodo GET
    public function getSetores($id = false)
    {
        if ($id === false)
            return $this->findAll();
        else {
            return $this->asArray()
                ->where(['setor_id' => $id])
                ->first();
        }
    }

    public function getIdByName($name)
    {
        return $this->asArray()
            ->where('nome', $name)->first();
    }
}
