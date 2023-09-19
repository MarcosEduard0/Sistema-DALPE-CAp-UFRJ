<?php

namespace App\Models;

use CodeIgniter\Model;

class LicenciandoSetorModel extends Model
{

    //Atributos de config
    protected $table = 'licenciandosetor';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'licenciando_id', 'setor_id', 'data_cadastro',
        'horas_estagio', 'data_inicio', 'data_termino', 'professor'
    ];

    //metodo GET
    public function getLicenciandosSetores($id = false)
    {
        if ($id === false)
            return $this->join('setores', 'setores.setor_id = licenciandosetor.setor_id')
                ->getResultArray();
        else {
            return $this->join('setores', 'setores.setor_id = licenciandosetor.setor_id')
                ->getwhere(['licenciando_id' => $id])
                ->getResultArray();
        }
    }

    public function getIdByLicenciandoId($licenciando_id)
    {
        return $this->select('id')
            ->where(['licenciando_id' => $licenciando_id])
            ->get()->getResultArray();
    }
}




// SELECT periodo, COUNT(periodo) FROM `licenciandosetor` WHERE periodo != '' GROUP BY periodo;
