<?php

namespace App\Controllers;

use App\Models\UniversidadesModel;

class Universidades extends BaseController
{

    protected $universidadeModel;

    public function __construct()
    {
        $this->universidadeModel = new UniversidadesModel();
    }

    /**
     * Página inicial
     *
     */
    public function index()
    {
        $this->data = [
            'titulo' => 'Universidades',
            'universidades' => $this->universidadeModel->getUniversidades(),
        ];
        $sessionData['posicao'] = 'Universidade';
        session()->set($sessionData);
        $this->data['body'] = view('universidades/universidades_index', $this->data);
        return $this->render();
    }

    /**
     * Adiciona uma universidade
     *
     */
    public function adicionar()
    {
        $this->data['titulo'] = 'Adicionar';

        if ($this->request->getMethod() == 'post') {
            $this->salvar();
            if (!isset($this->data['validation'])) {
                session()->setFlashdata('msg', msgbox('success', 'A universidade foi adicionado.'));
                return redirect('universidades');
            }
        }
        $this->data['body'] = view('universidades/universidades_adicionar', $this->data);
        return $this->render();
    }

    /**
     * Edição/vizualizar uma universidade
     *
     */
    public function editar($id = null)
    {
        $this->data = [
            'titulo' => 'Detalhes',
            'universidade' => $this->universidadeModel->getUniversidades($id),
        ];

        if (empty($this->data['universidade'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Não foi possível localizar a universidade com id: " . $id);
        }

        if ($this->request->getMethod() == 'post') {
            $this->salvar();
            if (!isset($this->data['validation'])) {
                session()->setFlashdata('msg', msgbox('success', 'A universidade foi atualizado.'));
                return redirect()->to('universidades/editar/' . $id);
            }
        }
        $this->data['body'] = view('universidades/universidades_adicionar',  $this->data);
        return $this->render();
    }

    /**
     * Salva as informações da universidade
     *
     */
    public function salvar()
    {
        $this->validation->setRule('sigla', 'Sigla', 'required|min_length[3]|max_length[20]');
        $this->validation->setRule('nome', 'Nome', 'required|min_length[3]|max_length[50]');
        $data = [
            'universidade_id' => $this->request->getVar('universidade_id'),
            'sigla' => $this->request->getVar('sigla'),
            'nome' => $this->request->getVar('nome'),
        ];

        if ($this->validation->withRequest($this->request)->run()) {
            $this->universidadeModel->save($data);
        } else {
            $this->data['validation'] = $this->validation;
        }
    }

    /**
     * Deleta uma universidade
     *
     */
    public function excluir($id = null)
    {

        $this->universidadeModel->delete($id);
        session()->setFlashdata('msg', msgbox('success', 'A universidade foi deletada.'));
        return redirect('universidades');
    }
}
