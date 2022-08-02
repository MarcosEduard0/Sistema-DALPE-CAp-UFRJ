<?php

namespace App\Controllers;

use App\Models\SetoresModel;

class Setores extends BaseController
{

    protected $setorModel;

    public function __construct()
    {
        $this->setorModel = new SetoresModel();
    }

    /**
     * Pagina inicial
     *
     */
    public function index()
    {
        $this->data = [
            'titulo' => 'Setores',
            'setores' => $this->setorModel->getSetores(),
        ];
        $sessionData['posicao'] = 'Setores';
        session()->set($sessionData);

        $this->data['body'] = view('setores/setores_index', $this->data);
        return $this->render();
    }

    /**
     * Adiciona um setor
     *
     */
    public function adicionar()
    {
        $this->data['titulo'] = 'Adicionar';

        if ($this->request->getMethod() == 'post') {
            $this->salvar();
            if (!isset($this->data['validation'])) {
                session()->setFlashdata('msg', msgbox('success', 'O setor foi adicionado.'));
                return redirect('setores');
            }
        }
        $this->data['body'] = view('setores/setores_adicionar', $this->data);
        return $this->render();
    }

    /**
     * Edita um setor
     *
     */
    public function editar($id = null)
    {
        $this->data = [
            'titulo' => 'Detalhes',
            'setor' => $this->setorModel->getSetores($id),
        ];

        if (empty($this->data['setor'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        if ($this->request->getMethod() == 'post') {
            $this->salvar();
            if (!isset($this->data['validation'])) {
                session()->setFlashdata('msg', msgbox('success', 'O setor foi atualizado.'));
                return redirect()->to('setores/editar/' . $id);
            }
        }
        $this->data['body'] = view('setores/setores_adicionar',  $this->data);
        return $this->render();
    }

    /**
     * Salva as informações do setor
     *
     */
    public function salvar()
    {
        $this->validation->setRule('nome', 'Nome', 'required|min_length[3]|max_length[50]');
        $data = [
            'setor_id' => $this->request->getVar('setor_id'),
            'nome' => $this->request->getVar('nome'),
            'descricao' => $this->request->getVar('descricao'),
        ];

        if ($this->validation->withRequest($this->request)->run()) {
            $this->setorModel->save($data);
        } else {
            $this->data['validation'] = $this->validation;
        }
    }

    /**
     * Deleta um setor
     *
     */
    public function excluir($id = null)
    {
        $this->setorModel->delete($id);
        session()->setFlashdata('msg', msgbox('success', 'O setor foi deletado.'));
        return redirect('setores');
    }
}
