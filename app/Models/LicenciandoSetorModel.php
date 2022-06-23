<?php

namespace App\Models;

use CodeIgniter\Model;

class LicenciandoSetorModel extends Model
{

    //Atributos de config
    protected $table = 'licenciandosetor';
    protected $allowedFields = ['licenciando_id', 'setor_id'];

    //metodo GET
    public function getLicenciandosSetores($id = false)
    {
        if ($id === false)
            // return $this->findAll();
            return $this->join('setores', 'setores.setor_id = licenciandosetor.setor_id')
                ->getResultArray();
        else {
            return $this->join('setores', 'setores.setor_id = licenciandosetor.setor_id')
                ->getwhere(['licenciando_id' => $id])
                ->getResultArray();
        }
    }
}
