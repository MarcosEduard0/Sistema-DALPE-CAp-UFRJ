<?php

namespace App\Controllers;

use App\Models\LicenciandosModel;
use App\Models\LicenciandoSetorModel;
use App\Models\DocumentosModel;
use App\Models\SetoresModel;
use App\Models\UniversidadesModel;

class Relatorios extends BaseController
{

    protected $licenciandosModel;

    public function __construct()
    {
        $this->licenciandosModel = new LicenciandosModel();
        $this->licenciandoSetorModel = new LicenciandoSetorModel();
        $this->documentosModel = new DocumentosModel();
        $this->universidadesModel = new UniversidadesModel();
        $this->setoresModel = new SetoresModel();
    }

    /**
     * Pagina inicial
     *
     */
    public function index()
    {

        $this->data = [
            'titulo' =>  'Relatórios',
        ];
        $sessionData['posicao'] = 'relatorios';
        session()->set($sessionData);


        $this->data['body'] = view('relatorios/relatorios_index', $this->data);
        return $this->render();
    }
}
