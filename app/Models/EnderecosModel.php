<?php

namespace App\Models;

use CodeIgniter\Model;

class EnderecosModel extends Model
{

    //Atributos de config
    protected $table = 'enderecos';
    protected $primaryKey = 'endereco_id';
    protected $allowedFields = ['endereco', 'numero', 'complemento', 'bairro', 'cidade', 'cep'];

    //metodo GET
    public function getEnderecos($id = false)
    {
        if ($id === false)
            return $this->findAll();
        else {
            return $this->asArray()
                ->where(['endereco_id' => $id])
                ->first();
        }
    }

    public function getLastEnderecoSalvo()
    {
        return $this->select('MAX(endereco_id) as endereco_id')->first()['endereco_id'];
    }
}
