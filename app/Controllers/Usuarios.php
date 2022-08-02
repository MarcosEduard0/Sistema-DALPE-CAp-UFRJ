<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Usuarios extends BaseController
{

    protected $usuariosModel;

    public function __construct()
    {
        $this->usuariosModel = new UsuariosModel();
    }

    /**
     * Pagina inicial
     *
     */
    public function index()
    {
        $this->data = [
            'titulo' => 'Usuários',
            'usuarios' => $this->usuariosModel->getUsuarios(),
        ];
        $sessionData['posicao'] = 'Usuarios';
        session()->set($sessionData);
        $this->data['body'] = view('usuarios/usuarios_index', $this->data);
        return $this->render();
    }

    /**
     * Editar conta de usuário
     *
     */
    public function editar($id = null)
    {
        $this->data = [
            'titulo' => 'Detalhes',
            'usuario' => $this->usuariosModel->getUsuarios($id),
        ];

        if (empty($this->data['usuario'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        if ($this->request->getMethod() == 'post') {
            $this->salvar();
            if (!isset($this->data['validation'])) {
                session()->setFlashdata('msg', msgbox('success', 'O usuário foi atualizado.'));
                return redirect()->to('usuarios/editar/' . $id);
            }
        }
        $this->data['body'] = view('usuarios/usuarios_adicionar',  $this->data);
        return $this->render();
    }

    /**
     * Adicionar um usuario
     *
     */
    public function adicionar()
    {
        $this->data['titulo'] = 'Adicionar';

        if ($this->request->getMethod() == 'post') {
            $this->salvar();
            if (!isset($this->data['validation'])) {
                session()->setFlashdata('msg', msgbox('success', 'O usuário foi salvo.'));
                return redirect()->to('usuarios');
            }
        }
        $this->data['body'] = view('usuarios/usuarios_adicionar', $this->data);
        return $this->render();
    }

    /**
     * página de login
     *
     */
    public function login_index()
    {
        if (session()->logged_in) {
            return redirect()->to('licenciandos');
        }
        $this->data['titulo'] = 'Login';
        $this->data['body'] = view('login/login_index', $this->data);
        return $this->render();
    }

    /**
     * Salva os dados do usuario
     *
     */
    public function salvar()
    {
        $usuarioId = $this->request->getVar('usuario_id');
        $assinatura = $this->request->getFile('assinatura');
        $usuarioNovo = $this->request->getVar('usuario');
        $siapeNovo = $this->request->getVar('siape');
        $cargoNovo = $this->request->getVar('cargo');


        $this->validation->setRule('usuario', 'Usuário', 'required|min_length[3]|max_length[50]|is_unique[usuarios.usuario]');
        $this->validation->setRule('siape', 'Siape', 'min_length[3]|max_length[8]|is_unique[usuarios.siape]');
        $this->validation->setRule('nome_completo', 'Nome Completo', 'required|min_length[3]|max_length[50]');
        $this->validation->setRule('cargo', 'Cargo', 'min_length[3]|max_length[50]');

        if (empty($usuarioId)) {
            $this->validation->setRule('senha1', 'Senha', 'trim|required|min_length[3]|matches[senha2]');
            $this->validation->setRule('senha2', 'Senha (novamente)', 'trim|min_length[3]');
        } else {
            $usuario = $this->usuariosModel->getUsuarios($usuarioId);
            $usuarioAntigo = $usuario['usuario'];
            $siapeAntigo = $usuario['siape'];

            if (!strcmp($usuarioAntigo, $usuarioNovo)) {
                $this->validation->setRule('usuario', 'Usuário', 'required|max_length[32]|regex_match[/^[A-Za-z0-9-_.@]+$/]');
            }
            if (!strcmp($siapeAntigo, $siapeNovo)) {
                $this->validation->setRule('siape', 'Siape', 'min_length[3]|max_length[8]');
            }
            if ($this->request->getVar('senha1')) {
                $this->validation->setRule('senha1', 'Senha', 'trim|required|min_length[3]|matches[senha2]');
                $this->validation->setRule('senha2', 'Senha (novamente)', 'trim|min_length[3]');
            }
        }

        $dataUser = [
            'usuario_id' =>  $usuarioId,
            'usuario' => $usuarioNovo,
            'nome_completo' => $this->request->getVar('nome_completo'),
            'nome_social' => $this->request->getVar('nome_social'),
            'siape' => $siapeNovo,
            'cargo' => $cargoNovo,
            'email' => $this->request->getVar('email'),
            'telefone' => $this->request->getVar('telefone'),
        ];

        if ($this->request->getVar('senha1') && $this->request->getVar('senha2')) {
            $dataUser['senha'] = password_hash($this->request->getVar('senha1'), PASSWORD_DEFAULT);
        }


        //Verificando se o usuario deseja deletar a assinatura atual
        if ($this->request->getVar('deleteAssinatura')) {
            $this->apagarAssinatura($usuario['assinatura']);
            $dataUser['assinatura'] = null;
            $this->usuariosModel->save($dataUser);
        } else {
            //caso contrario, verifique se carregou algum arquivo
            if (empty($assinatura)) {
                $this->validate([
                    'assinatura' => 'uploaded[assinatura]|max_size[assinatura, 4096]|ext_in[assinatura,jpg,png]',
                ]);
            }
            if (!$this->validation->withRequest($this->request)->run()) {
                $this->data['validation'] = $this->validation;
            } else {

                if ($file = $this->request->getFile('assinatura')) {
                    if ($file->isValid()) {
                        //se o usuario ja possuir assinatura, remova a antiga e coloque a nova
                        if (!empty($usuario['assinatura'])) {
                            $this->apagarAssinatura($usuario['assinatura']);
                            $dataUser['assinatura'] = null;
                        }
                        $novoNome = $assinatura->getRandomName();
                        $file->move('public/assets/uploads/', $novoNome);
                        $dataUser['assinatura'] = $novoNome;
                    }
                    $this->usuariosModel->save($dataUser);

                    //Atualizando dados da sessão
                    if (!strcmp(session()->get('usuario')['usuario_id'], $usuarioId)) {
                        $usuario = $this->usuariosModel->getUsuarios($usuarioId);
                        session()->set('usuario', $usuario);
                    }
                } else {
                    // $this->data['validation'] = $this->validation;
                    session()->setFlashdata('msg', msgbox('danger', 'A assinatura não pode ser carregada.'));
                }
            }
        }
    }

    /**
     * Remove o arquivo da assinatura antiga do servidor
     *
     */
    private function apagarAssinatura($name)
    {
        if (file_exists("public/assets/uploads/" . $name))
            unlink("public/assets/uploads/" . $name);
    }

    /**
     * Delete o usuario
     *
     */
    public function excluir($id = null)
    {
        $this->usuariosModel->delete($id);
        session()->setFlashdata('msg', msgbox('success', 'O usuário foi deletado.'));
        return redirect('usuarios');
    }


    /**
     * Autenticação de usuario
     *
     */
    public function login()
    {
        $user = $this->request->getVar('usuario');
        $senha = $this->request->getVar('senha');
        $this->data['usuario'] = $this->usuariosModel->getUsuarioByUser($user);
        session()->markAsFlashdata('msg');

        if (!empty($this->data['usuario'])) {
            if (password_verify($senha, $this->data['usuario']['senha'])) {
                $sessionData = [
                    'usuario' =>   $this->data['usuario'],
                    'logged_in' => TRUE,
                ];
                session()->set($sessionData);

                $this->usuariosModel->update($this->data['usuario']['usuario_id'], ['ultimo_login'  => utf8_encode(strftime('%Y-%m-%d %H:%M:%S'))]);

                return redirect('home');
            }
        }
        session()->setFlashdata('msg', msgbox('danger', 'login'));
        return redirect()->to('login');
    }

    /**
     * Logout de usuario
     *
     */
    public function logout()
    {
        session()->destroy();
        return redirect('login');
    }
}
