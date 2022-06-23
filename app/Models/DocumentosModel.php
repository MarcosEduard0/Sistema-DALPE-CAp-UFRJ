<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentosModel extends Model
{

    //Atributos de config
    protected $table = 'documentos';
    protected $primaryKey = 'documento_id';
    protected $allowedFields = ['nome', 'conteudo'];

    //metodo get
    public function getDocumentos($id = false)
    {
        if ($id === false)
            return $this->findAll();
        else {
            return $this->asArray()
                ->where(['documento_id' => $id])
                ->first();
        }
    }
}
