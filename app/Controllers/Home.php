<?php

namespace App\Controllers;

use App\Models\LicenciandosModel;
use App\Models\LicenciandoSetorModel;

// require_once "dompdf/autoload.inc.php";

class Home extends BaseController
{

    protected $licenciandosModel;

    public function __construct()
    {
        $this->licenciandosModel = new LicenciandosModel();
        $this->licenciandoSetorModel = new LicenciandoSetorModel();
    }

    /**
     * Pagina inicial
     *
     */
    public function index()
    {

        $this->data = [
            'titulo' =>  'Inicio',
            'quantLicenciando' => $this->licenciandosModel->getTotalLicenciando()['quantidade'],
            'quantSetores' => $this->licenciandosModel->getTotalSetoresPorLicenciando(),
            'quantUniversidades' => $this->licenciandosModel->getTotalUniversidadePorLicenciando(),
        ];
        $sessionData['posicao'] = 'Home';
        session()->set($sessionData);


        $this->data['body'] = view('home/home_index', $this->data);
        return $this->render();
    }

    public function teste()
    {
        $teste = $this->request->getVar('teste');
        print_r($this->licenciandoSetorModel->getLicenciandosSetores(51));
        // print_r($teste);
    }
}
