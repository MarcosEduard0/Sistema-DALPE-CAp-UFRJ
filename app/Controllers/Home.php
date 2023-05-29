<?php

namespace App\Controllers;

use App\Models\LicenciandosModel;
use App\Models\LicenciandoSetorModel;
use App\Models\DocumentosModel;
use App\Models\SetoresModel;
use App\Models\UniversidadesModel;

class Home extends BaseController
{

    protected $licenciandosModel;
    protected $licenciandoSetorModel;
    protected $licenciandodocumentosModelsModel;
    protected $documentosModel;
    protected $universidadesModel;
    protected $setoresModel;

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
        $totalSetores = $this->licenciandosModel->getTotalSetoresPorLicenciando();
        $licenciando_setor = [['Licenciandos por Setor', 'Quantidade']];
        foreach ($totalSetores as $setor) {
            array_push($licenciando_setor, [$setor['nome'], intval($setor['quantidade'])]);
        }
        $licenciando_setor = json_encode($licenciando_setor);

        $totalUniversidades = $this->licenciandosModel->getTotalUniversidadePorLicenciando();
        $licenciando_universidade = [['', 'Quantidade']];
        foreach ($totalUniversidades as $universidade) {
            array_push($licenciando_universidade, [$universidade['sigla'], intval($universidade['quantidade'])]);
        }

        $licenciando_universidade = json_encode($licenciando_universidade);

        $this->data = [
            'titulo' =>  'Inicio',
            'quantLicenciando' => $this->licenciandosModel->getTotalLicenciando()['quantidade'],
            'quantSetoresLicendiando' => $licenciando_setor,
            'quantUniversidadeLicenciando' => $licenciando_universidade,
            'quantSetores' => count($this->setoresModel->getSetores()),
            'quantUniversidades' => count($this->universidadesModel->find()),
            'quantDocumentos' => count($this->documentosModel->find()),
            'quantPeriodos' => $this->licenciandoSetorModel->getPeriodCount(),
        ];

        $sessionData['posicao'] = 'Home';
        session()->set($sessionData);


        $this->data['body'] = view('home/home_index', $this->data);
        return $this->render();
    }
}
