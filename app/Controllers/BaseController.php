<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
include(APPPATH . 'Libraries/dompdf/autoload.inc.php');

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['MY_html_helper', 'string_helper', 'filesystem', 'form', 'url'];

    /**
     * Um array com componentes padroes para todos os controllers que extend BaseController.
     *
     * @var array
     */
    public $data = array();

    public function render($view_name = 'layout')
    {
        return view($view_name, $this->data);
    }

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->validation =  \Config\Services::validation();

        // E.g.: $this->session = \Config\Services::session();
    }
}
