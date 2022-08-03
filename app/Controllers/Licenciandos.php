<?php

namespace App\Controllers;

use App\Models\LicenciandosModel;
use App\Models\SetoresModel;
use App\Models\DocumentosModel;
use App\Models\UniversidadesModel;
use App\Models\EnderecosModel;
use App\Models\LicenciandoSetorModel;

class Licenciandos extends BaseController
{

    protected $licenciandosModel;
    protected $setoresModal;
    protected $universidadesModel;
    protected $documentoModel;
    protected $enderecoModel;

    public function __construct()
    {
        $this->licenciandosModel = new LicenciandosModel();
        $this->setoresModal = new SetoresModel();
        $this->universidadesModel = new UniversidadesModel();
        $this->documentosModel = new DocumentosModel();
        $this->enderecoModel = new EnderecosModel();
        $this->licenciandoSetorModel = new LicenciandoSetorModel();
    }

    public function index()
    {
        $this->data['titulo'] = 'Licenciandos';
        $this->data['licenciandos'] = $this->licenciandosModel->getLicenciandosCompleto();
        $this->data['setores'] = array();
        $i = 0;
        foreach ($this->data['licenciandos'] as $licenciando) {
            $this->data['setores'][$i] = $this->licenciandoSetorModel->getLicenciandosSetores($licenciando['licenciando_id']);

            if (empty($this->data['setores'][$i])) {
                $this->data['setores'][$i] = array(
                    'id'  => 0,
                    'setor' => "Nenhum(a)"
                );
                $this->data['licenciandos'][$i]['setores'] = "Nenhum(a)";
                $this->data['licenciandos'][$i]['setores_id'] = 0;
            } else {
                $nomeSetor = array();
                $j = 0;

                foreach ($this->data['setores'][$i] as $setor) {
                    $nomeSetor[$j] = $setor['nome'];
                    $j++;
                }
                $nomeSetor = implode(", ", $nomeSetor);

                $this->data['licenciandos'][$i]['setores'] =  $nomeSetor;
                $this->data['licenciandos'][$i]['setores_id'] = $this->data['setores'][$i][0]['id'];
            }

            $i++;
        }

        $this->data['body'] = view('licenciandos/licenciandos_index', $this->data);
        $sessionData['posicao'] = 'Licenciandos';
        session()->set($sessionData);
        return $this->render();
    }
    public function setor_select($licenciando_id)
    {
        $licenciando_setor = $this->request->getVar('licenciando_setor');
        return redirect()->to('licenciandos/editar/' . $licenciando_id . '/' . $licenciando_setor);
    }
    public function adicionar()
    {
        $this->data['universidades'] = $this->universidadesModel->getUniversidades();
        $this->data['titulo'] = 'Adicionar Licenciando';
        $this->data['setores'] = $this->setoresModal->getSetores();

        if ($this->request->getMethod() == 'post') {
            $this->salvar();
            if (!isset($this->data['validation'])) {
                session()->setFlashdata('msg', msgbox('success', 'O licenciando foi salvo.'));
                return redirect()->to('licenciandos');
            }
        }

        $this->data['body'] = view('licenciandos/licenciandos_adicionar', $this->data);
        return $this->render();
    }

    public function editar($id = null, $licenciandoSetor_id = null)
    {

        $this->data['titulo'] = 'Editar Licenciando';
        $this->data['licenciando'] = $this->licenciandosModel->joinLicenciandoEndereco($id);

        if (!is_null($licenciandoSetor_id) && !is_null($id)) {
            $resultLicenSetor = $this->licenciandoSetorModel->find($licenciandoSetor_id);
            $this->data['licenciandoSetores'] = $this->licenciandoSetorModel->getLicenciandosSetores($id);
            $this->data['setor_data'] = $this->licenciandoSetorModel->find($licenciandoSetor_id);
        }

        if (empty($this->data['licenciando']) || empty($resultLicenSetor)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $this->data['licenciandoSetor_id'] = $licenciandoSetor_id;
        $this->data['licenciando']['universidade_sigla'] = $this->universidadesModel->getUniversidades($this->data['licenciando']['universidade_id'])['sigla'];
        $this->data['universidades'] = $this->universidadesModel->getUniversidades();
        $this->data['documentos'] = $this->documentosModel->getDocumentos();
        $this->data['setores'] = $this->setoresModal->getSetores();
        $this->data['licenciando']['licenciando_setor'] = array();

        if ($this->request->getMethod() == 'post') {
            $this->salvar($licenciandoSetor_id);
            if (!isset($this->data['validation'])) {
                session()->setFlashdata('msg', msgbox('success', 'O licenciando foi atualizado.'));
                return redirect()->to('licenciandos/editar/' . $id . '/' . $licenciandoSetor_id);
            }
        }
        $this->data['body'] = view('licenciandos/licenciandos_adicionar',  $this->data);
        return $this->render();
    }

    public function excluir($id = null)
    {
        $endereco_id = $this->licenciandosModel->find($id)['endereco_id'];
        $this->enderecoModel->delete($endereco_id);
        $this->licenciandosModel->delete($id);
        session()->setFlashdata('msg', msgbox('success', 'O licenciando foi deletado.'));
        return redirect('licenciandos');
    }

    public function salvar($licenciandoSetor_id = null)
    {
        $dreNovo = $this->request->getVar('dre');
        $licenciandoId = $this->request->getVar('licenciando_id');
        $enderecoId = $this->request->getVar('endereco_id');

        $this->validation->setRule('nome_completo', 'Nome Completo', 'required|min_length[3]|max_length[100]');
        $this->validation->setRule('dre', 'DRE', 'required|max_length[32]|is_unique[licenciandos.dre]');
        $this->validation->setRule('setor_id', 'Setor Curricular', 'required');
        $this->validation->setRule('universidade_id', 'Universidade', 'required');

        if (!empty($licenciandoId)) {
            $licenciando = $this->licenciandosModel->getLicenciandos($licenciandoId);
            $dreAntigo = $licenciando['dre'];

            if (!strcmp($dreAntigo, $dreNovo))
                $this->validation->setRule('dre', 'DRE', 'required|max_length[32]');
        }

        $dataLicenciando = [
            'licenciando_id' =>  $licenciandoId,
            'dre' => $dreNovo,
            'nome_completo' => $this->request->getVar('nome_completo'),
            'nome_social' => $this->request->getVar('nome_social'),
            'email' => $this->request->getVar('email'),
            'telefone1' => $this->request->getVar('telefone1'),
            'telefone2' => $this->request->getVar('telefone2'),
            'endereco_id' => $enderecoId,
            'universidade_id' => $this->request->getVar('universidade_id'),
            'setores_id' => $this->request->getVar('setor_id'),
            'observacao' => $this->request->getVar('observacao')

        ];

        $dataSetor = [
            'setor_id' =>  $dataLicenciando['setores_id'],
            'data_cadastro' => $this->request->getVar('data_cadastro'),
            'horas_estagio' => $this->request->getVar('horas_estagio'),
            'data_termino' => $this->request->getVar('data_termino'),
            'professor' => $this->request->getVar('professor'),
        ];

        $dataAdress = [
            'endereco_id' => $enderecoId,
            'endereco' => $this->request->getVar('endereco'),
            'bairro' => $this->request->getVar('bairro'),
            'cep' => $this->request->getVar('cep'),
            'cidade' => $this->request->getVar('cidade'),
        ];


        if ($this->validation->withRequest($this->request)->run()) {

            // Atualizando informações do setor do licenciando
            if (!is_null($licenciandoSetor_id)) {
                $result = $this->licenciandoSetorModel->find($licenciandoSetor_id);
                $dataSetor['setor_id'] = $result['setor_id'];
                $dataSetor['id'] =  $result['id'];
                $this->licenciandoSetorModel->save($dataSetor);
            }

            // Atualizando/Salvando informações do endereço do licenciando
            $this->enderecoModel->save($dataAdress);

            // Caso estaja adicionando um licenciando, pegue o id do ultimo licenciando salvo
            if (empty($enderecoId)) {
                $dataLicenciando['endereco_id'] = $this->enderecoModel->getLastEnderecoSalvo();
            }

            // Salvando as informações do licenciando
            $this->licenciandosModel->save($dataLicenciando);

            // Adicionando as informaçãoes dos setores do licenciando
            if (empty($licenciandoId)) {
                $save = $dataSetor;
                $save['licenciando_id'] =  $this->licenciandosModel->getLastLicenciandoSave();

                for ($i = 0; $i < count($dataSetor['setor_id']); $i++) {
                    $save['setor_id'] = $dataSetor['setor_id'][$i];
                    $save['data_cadastro'] = $dataSetor['data_cadastro'][$i];
                    $save['horas_estagio'] = $dataSetor['horas_estagio'][$i];
                    $save['data_termino'] = $dataSetor['data_termino'][$i];
                    $save['professor'] = $dataSetor['professor'][$i];

                    $this->licenciandoSetorModel->save($save);
                }
            }

            if (!is_null($licenciandoSetor_id)) {
                $dataLicenciandoSetor = $this->licenciandoSetorModel->getLicenciandosSetores($licenciandoId);
                $newSetoresId = array();
                $oldSetoresId = $dataLicenciando['setores_id'];

                foreach ($dataLicenciandoSetor as $licenciando_setor) {
                    array_push($newSetoresId, $licenciando_setor['setor_id']);
                }


                $adicionar = array_diff($oldSetoresId, $newSetoresId);
                $remover = array_diff($newSetoresId, $oldSetoresId);


                $dataSetorSave['licenciando_id'] = $licenciandoId;
                if (count($adicionar) > 0) {
                    foreach ($adicionar as $id) {
                        $dataSetorSave['setor_id'] = $id;
                        $this->licenciandoSetorModel->save($dataSetorSave);
                    }
                }
                if (count($remover) > 0) {
                    foreach ($remover as $id) {
                        $dataSetorSave['setor_id'] = $id;
                        $this->licenciandoSetorModel->where([
                            'licenciando_id' => $dataSetorSave['licenciando_id'],
                            'setor_id' => $dataSetorSave['setor_id']
                        ])->delete();
                    }
                }
            }
        } else {
            $this->data['validation'] = $this->validation;
        }
    }

    /**
     * Primeira página de importação.
     * Se GET, mostra o formulário. Se for POST, lidar com upload e importação de CSV.
     *
     */
    public function importar()
    {
        $this->data['titulo'] = 'Importar licenciandos';




        if ($this->request->getMethod() == 'post') {
            $this->process_import();
            if (!isset($this->data['validation'])) {
                return redirect()->to('licenciandos/import_results');
            }
        }

        $this->cleanup_import();

        $this->data['body'] = view('licenciandos/import/index', $this->data);
        return $this->render();
    }

    /**
     * Quando o formulário CSV é enviado, este é chamado para lidar com o arquivo
     * e processar as linhas.
     *
     */
    private function process_import()
    {

        $input = $this->validate([
            'Arquivo CSV' => 'uploaded[userfile]|max_size[userfile,2048]|ext_in[userfile,csv],'
        ]);
        if (!$input) {
            $this->data['validation'] = $this->validation;
        } else {
            if ($file = $this->request->getFile('userfile')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('public/assets/csvfile/', $newName);
                    $file = fopen("public/assets/csvfile/" . $newName, "r");
                    $i = 0;
                    $numberOfFields = 13;
                    $csvArr = array();

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);

                        if ($i > 0 && $num == $numberOfFields) {
                            $csvArr[$i]['email'] = $filedata[0];
                            $csvArr[$i]['nome_completo'] = $filedata[1];
                            $csvArr[$i]['nome_social'] = $filedata[2];
                            $csvArr[$i]['dre'] = $filedata[3];
                            $csvArr[$i]['universidade_id'] = $filedata[4];
                            $csvArr[$i]['professor'] = $filedata[5];
                            $csvArr[$i]['setor_id'] = $filedata[6];
                            $csvArr[$i]['endereco'] = $filedata[7];
                            $csvArr[$i]['bairro'] = $filedata[8];
                            $csvArr[$i]['cep'] = $filedata[9];
                            $csvArr[$i]['cidade'] = $filedata[10];
                            $csvArr[$i]['telefone1'] = $filedata[11];
                            $csvArr[$i]['telefone2'] = $filedata[12];
                            $csvArr[$i]['horas_estagio'] = 0;
                            $csvArr[$i]['data_cadastro'] = date('Y-m-d');
                        }
                        $i++;
                    }
                    fclose($file);
                    unlink("public/assets/csvfile/" . $newName);
                    $line = 0;

                    foreach ($csvArr as $userdata) {
                        $line++;
                        $status = $this->add_licenciando($userdata);
                        $results[] = array(
                            'line' => $line,
                            'status' => $status,
                            'licenciando' => $userdata['nome_completo'],
                        );
                    }
                    //possui um numero de colunas diferente da necessaria para importação
                    if (empty($results))
                        return;

                    // Grave os resultados no arquivo temporário
                    $data = json_encode($results);
                    $res_filename = "." . random_string('alnum', 25);

                    $dataFile = fopen("public/assets/local/{$res_filename}", "w");
                    fwrite($dataFile, $data);
                    fclose($dataFile);

                    write_file("public/assets/local/{$res_filename}", $data); //PROBLEMA NA HORA DE ESCREVER O ARQUIVO TIME OUT
                    session()->setFlashdata('import_results', $res_filename);
                } else {
                    session()->setFlashdata('msg', msgbox('danger', 'O arquivo CSV não pode ser importado.'));
                }
            } else {
                session()->setFlashdata('msg', msgbox('danger', 'O arquivo CSV não pdoe ser importado.'));
            }
        }
    }

    /**
     * Adicionar uma linha de usuário do arquivo CSV importado
     *
     * @return  string		Descrição do status de adição de determinado usuário
     *
     */
    private function add_licenciando($data = array())
    {

        if (!$this->validateEmail($data['email']))
            return 'invalid';

        $setores = explode(',', $data['setor_id']);
        $professores = explode(',', $data['professor']);

        // se o atributo for multivalorado
        if (count($setores) > 1 || count($professores) > 1) {

            for ($i = 0; $i < count($setores); $i++) {
                if ($setores[$i][0] == ' ') {
                    $setores[$i] = substr($setores[$i], 1);
                }
                if ($professores[$i][0] == ' ') {
                    $professores[$i] = substr($professores[$i], 1);
                }
            }

            // Verificando os setores e professores
            $i = 0;
            $data['setor_id'] = array();
            $data['professor'] = array();
            foreach ($setores as $setor) {
                $setorResult = $this->setoresModal->getIdByName($setor);
                if (is_null($setorResult))
                    return 'setor_invalido';

                $data['setor_id'][$i] = $setorResult['setor_id'];
                $data['professor'][$i] = $professores[$i];
                $i++;
            }
            // Verificando as universidades
            $data['universidade_id'] = $this->universidadesModel->getIdBySigla($data['universidade_id']);
            if (is_null($data['universidade_id']))
                return 'universidade_invalida';
            else
                $data['universidade_id'] = $data['universidade_id']['universidade_id'];

            // Verificando se o licenciando ja existe
            $findRecord = $this->licenciandosModel->where([
                'dre' => $data['dre']
            ])->countAllResults();

            if ($findRecord > 0)
                return 'licenciando_existente';
            else
                $res = $this->licenciandosModel->insert($data);

            if ($res) {
                $data['licenciando_id'] = $this->licenciandosModel->getLastLicenciandoSave();
                //salvando os setores
                $setoresId = $data['setor_id'];
                $professores = $data['professor'];
                $i = 0;
                foreach ($setoresId as $id) {
                    $data['setor_id'] = $id;
                    $data['professor'] = $professores[$i];
                    $res = $this->licenciandoSetorModel->insert($data);
                    if (!$res)
                        return 'bd_erro';
                    $i++;
                }

                $res = $this->enderecoModel->insert($data);
                if ($res) {
                    //Pega o ultimo endereço salvo e atualiza o licenciando com o id do endereço
                    $data['endereco_id'] = $this->enderecoModel->getLastEnderecoSalvo();
                    $this->licenciandosModel->save($data);
                    return 'sucesso';
                }
            }
            return 'bd_erro';

            //Caso seja cadastros separados
        } else {

            $data['universidade_id'] = $this->universidadesModel->getIdBySigla($data['universidade_id']);
            if (is_null($data['universidade_id']))
                return 'universidade_invalida';

            $res = $this->setoresModal->getIdByName($data['setor_id']);
            if (!$res)
                return 'setor_invalido';

            $data['universidade_id'] = $data['universidade_id']['universidade_id'];

            $findRecord = $this->licenciandosModel->where([
                'dre' => $data['dre']
            ])->first();
            // Caso ja seja cadastrado
            if ($findRecord) {
                // Pegue o seu ID e verifique quais sao os setores desse licenciando
                $data['licenciando_id'] = $findRecord['licenciando_id'];
                $result = $this->licenciandoSetorModel->select('nome')->join('setores', 'setores.setor_id = licenciandosetor.setor_id')->where(['licenciando_id' => $findRecord['licenciando_id']])->findAll();

                $setores = array();
                foreach ($result as $setor)
                    array_push($setores, strtoupper($setor['nome']));

                // Procura no array de setores se o setor que deseja se cadastrar ja é cadastrado
                if (in_array(strtoupper($data['setor_id']), $setores))
                    return 'licenciando_existente';

                // Pega o id do setor
                $result = $this->setoresModal->getIdByName($data['setor_id']);
                if (is_null($result))
                    return 'bd_erro';

                $data['setor_id'] = $result['setor_id'];

                //Salva o novo setor no banco
                $res = $this->licenciandoSetorModel->save($data);
                if (!$res)
                    return 'bd_erro';

                return 'sucesso';
            } else {
                // Salva o licenciando
                $res = $this->licenciandosModel->save($data);

                if ($res) {
                    //Verifica se o setor é valido
                    $data['setor_id'] = $this->setoresModal->getIdByName($data['setor_id']);
                    if (!$data['setor_id'])
                        return 'setor_invalido';

                    $data['setor_id'] = $data['setor_id']['setor_id'];
                    $data['licenciando_id'] = $this->licenciandosModel->getLastLicenciandoSave();

                    //salvando o setor
                    $this->licenciandoSetorModel->insert($data);

                    //Salva endereço
                    $res = $this->enderecoModel->save($data);
                    if ($res) {
                        $data['endereco_id'] = $this->enderecoModel->getLastEnderecoSalvo();
                        $res = $this->licenciandosModel->save($data);
                        if ($res)
                            return 'sucesso';
                    }
                }
            }
            return 'bd_erro';
        }
    }

    /**
     * Mostra os resultados da importação.
     *
     * Os resultados são armazenados em um arquivo "temporário", o nome do arquivo
     * do qual é armazenado na sessão.
     *
     */
    public function import_results()
    {

        if (!array_key_exists('import_results', $_SESSION)) {
            $flashmsg = msgbox('danger', "Nenhum dado de importação encontrado. Verifique a quantidade de colunas.");
            session()->setFlashdata('msg', $flashmsg);
            return redirect()->to('licenciandos/importar');
        }

        $filename = session()->getFlashdata('import_results');
        if (!is_file("public/assets/local/{$filename}")) {
            $flashmsg = msgbox('danger', "Arquivo de resultados de importação não encontrado.");
            session()->setFlashdata('msg', $flashmsg);
            return redirect()->to('licenciandos/importar');
        }

        $raw = @file_get_contents("public/assets/local/{$filename}");
        $result = json_decode($raw);


        $this->data['result'] = $result;

        $this->data['titulo'] = 'Importar Licenciandos';
        @unlink("public/assets/local/{$filename}"); //Apaga o arquivo dataFile.

        $this->data['body'] = view('licenciandos/import/results', $this->data);
        return $this->render();
    }

    /**
     * Se houver um arquivo de resultados na sessão, remova-o e remova a chave.
     *
     */
    private function cleanup_import()
    {
        if (array_key_exists('import_results', $_SESSION)) {
            $file = $_SESSION['import_results'];
            @unlink("public/assets/local/{$file}");
            unset($_SESSION['import_results']);
        }
    }
    /**
     * Valida o endereço de email.
     *
     */
    private function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 1;
        } else {
            return 0;
        }
    }
}
