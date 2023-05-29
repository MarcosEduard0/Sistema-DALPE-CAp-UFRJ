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
        'horas_estagio', 'data_inicio', 'data_termino', 'professor', 'periodo'
    ];

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

    public function getPeriodCount($id = false)
    {

        return $this->select('periodo, COUNT(periodo) as quantidade')->where('periodo !=', '')->groupBy('periodo')->get()->getResultArray();
    }
}





// SELECT periodo, COUNT(periodo) FROM `licenciandosetor` WHERE periodo != '' GROUP BY periodo;
