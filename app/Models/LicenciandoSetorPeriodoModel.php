<?php

namespace App\Models;

use CodeIgniter\Model;

class LicenciandoSetorPeriodoModel extends Model
{

    //Atributos de config
    protected $table = 'licenciando_setor_periodo';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'licenciando_setor_id', 'periodo'
    ];

    //metodo GET
    public function getPeriodosByIdLicenSetor($id = false)
    {
        return $this->select('periodo')->where(['licenciando_setor_id' => $id])->get()->getResultArray();
    }

    //metodo Delete by ID Licenciando Setor
    public function updatePeriodosByIdLicenSetor($id = false)
    {
        $this->delete(['licenciando_setor_id' => $id]);
    }

    public function getPeriodCount($id = false)
    {
        return $this->select('periodo, COUNT(periodo) as quantidade')->where('periodo !=', '')->groupBy('periodo')->get()->getResultArray();
    }
}
