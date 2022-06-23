<?php if (isset($licenciando)) $baseUrl = 'editar/' . $licenciando['licenciando_id'];
else $baseUrl = 'adicionar'; ?>

<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <img src="<?= base_url("public/assets/img/header.jpg") ?>" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <label class=newbtn>
                            <img id="imgLicen" class="avatar border-gray" src="<?= base_url("public/assets/img/avatar.png") ?>" alt="...">
                            <input type="file" id="filImage" name="filImage" accept="image/*">
                        </label>

                        <h5 class="title" style="color: #51cbce;"><?= isset($licenciando['nome_completo']) ? $licenciando['nome_completo'] : set_value('nome_completo') ?></h5>
                        <p class="description">
                            <strong><?= isset($licenciando['dre']) ? $licenciando['dre'] : set_value('dre') ?></strong>
                        </p>
                    </div>
                    <p class="description text-center">
                        <?= isset($licenciando['observacao']) ? $licenciando['observacao'] : '' ?>
                    </p>
                </div>
                <?php if (isset($licenciando)) : ?>
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-6 ml-auto">

                                    <h5><?= $licenciando['horas_estagio'] ?><br><small>Horas</small></h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5><?= $licenciando['universidade_sigla'] ?><br><small>Instituição</small></h5>
                                </div>
                                <div class="col-lg-3 mr-auto">
                                    <h5><?= (strtotime($licenciando['data_termino']) <= strtotime(date('Y-m-j'))) ? "NÃO" :  "SIM" ?><br><small>Concluinte</small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <?php if (isset($licenciando)) : ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Documentos</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled team-members">
                            <?php foreach ($documentos as $documento) : ?>
                                <li>
                                    <div class="row">
                                        <div class="col-md-1 col-2">
                                            <div class="avatar-documento">
                                                <i class="fa fa-file-alt fa-2x "></i>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-10">
                                            <?= $documento['nome'] ?>
                                        </div>
                                        <div class="col-md-3 col-3 text-right">
                                            <a id="<?= $documento['documento_id'] ?>" type="button" data-toggle="modal" data-detalhes='<?= json_encode($documento) ?>' data-target="#documentoModal" onclick="documentoModel(<?= $licenciando['licenciando_id'] ?>,this.id, '<?= base_url() ?>')">
                                                <btn class="btn btn-sm btn-outline-info btn-round btn-icon">
                                                    <i class="fa fa-download"></i>
                                                </btn>
                                            </a>

                                        </div>
                                    </div>
                                </li>
                                <br>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <div class="col-md-8">
            <div class="card card-user">
                <div class="card-header">
                    <?= (isset($validation)) ? $validation->listErrors() : '' ?>
                    <?= session()->getFlashdata('msg') ?>
                    <!-- <h5 class="card-title"></h5> -->
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate action="<?= base_url('/licenciandos/' . $baseUrl) ?>" method="post">
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="nome_completo">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome_completo" value="<?= isset($licenciando['nome_completo']) ? $licenciando['nome_completo'] : set_value('nome_completo') ?>" required>
                                    <div class="invalid-feedback">
                                        Nome Completo é obrigatório
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="nome_social">Nome Social</label>
                                    <input type="text" class="form-control" name="nome_social" value="<?= isset($licenciando['nome_social']) ? $licenciando['nome_social'] : set_value('nome_social') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['email']) ? $licenciando['email'] : set_value('email') ?>" name="email">
                                </div>
                            </div>
                            <div class="col-md-2 px-1">
                                <div class="form-group">
                                    <label for="dre">DRE</label>
                                    <input type="text" class="form-control" name="dre" value="<?= isset($licenciando['dre']) ? $licenciando['dre'] : set_value('dre') ?>" required>
                                    <div class="invalid-feedback">
                                        DRE é obrigatório
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="universidade_id">Universidade</label>
                                    <?php
                                    $universidade_options = array('' => '(Nenhuma)');
                                    foreach ($universidades as $universidade) {
                                        $universidade_options[$universidade['universidade_id']] = $universidade['sigla'];
                                    }
                                    $field = 'universidade_id';
                                    $value = set_value($field, isset($licenciando) ? $licenciando['universidade_id'] : '', FALSE);
                                    echo form_dropdown('universidade_id', $universidade_options, $value, 'tabindex="-1" class="custom-select mr-sm-2" required');
                                    ?>
                                    <div class="invalid-feedback">
                                        Universidade é obrigatório
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="telefone1">Telefone 1</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['telefone1']) ? $licenciando['telefone1'] : set_value('telefone1') ?>" name="telefone1" onkeypress="$(this).mask('(00) 0000-00000')">
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label for="telefone2">Telefone 2</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['telefone2']) ? $licenciando['telefone2'] : set_value('telefone2') ?>" name="telefone2" onkeypress="$(this).mask('(00) 0000-00000')">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['endereco']) ? $licenciando['endereco'] : set_value('endereco') ?>" name="endereco">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 pr-1">
                                <div class="form-group">
                                    <label for="numero">Número</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['numero']) ? $licenciando['numero'] : set_value('numero') ?>" name="numero">
                                </div>
                            </div>
                            <div class="col-md-2 px-1">
                                <div class="form-group">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['complemento']) ? $licenciando['complemento'] : set_value('complemento') ?>" name="complemento">
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['bairro']) ? $licenciando['bairro'] : set_value('bairro') ?>" name="bairro">
                                </div>
                            </div>
                            <div class="col-md-2 px-1">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['cep']) ? $licenciando['cep'] : set_value('cep') ?>" name="cep">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['cidade']) ? $licenciando['cidade'] : set_value('cidade') ?>" name="cidade">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-2 pr-1">
                                <div class="form-group">
                                    <label for="horas_estagio">Horas de estagio:</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['horas_estagio']) ? $licenciando['horas_estagio'] : set_value('horas_estagio') ?>" name="horas_estagio">
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label for="data_cadastro">Data de cadastro:</label>
                                    <input type="date" class="form-control" value="<?= isset($licenciando['data_cadastro']) ? $licenciando['data_cadastro'] : date('Y-m-d') ?>" name="data_cadastro">
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label for="data_termino">Data Conclusão:</label>
                                    <input type="date" class="form-control" value="<?= isset($licenciando['data_termino']) ? $licenciando['data_termino'] : set_value('data_termino') ?>" name="data_termino">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="professor">Professor(a) de Prática</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['professor']) ? $licenciando['professor'] : set_value('professor') ?>" name="professor">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="setor_id">Setor Curricular</label>
                                    <?php
                                    $setores_options = array();
                                    foreach ($setores as $setor) {
                                        $setores_options[$setor['setor_id']] = $setor['nome'];
                                    }
                                    if (isset($licenciando)) {
                                        $department_options = array();
                                        foreach ($licenciandoSetores as $licenciandoSetor) {
                                            $department_options[$licenciandoSetor['setor_id']] = $licenciandoSetor['setor_id'];
                                        }
                                    }
                                    $field = 'setor_id';
                                    $value = set_value($field, isset($licenciando) ? $department_options : '', FALSE);
                                    echo form_dropdown('setor_id[]', $setores_options, $value, 'id="choices-multiple-remove-button" multiple required placeholder="Digite para pesquisar..."');
                                    ?>
                                    <div class="invalid-feedback">
                                        Setor Curricular é obrigatório
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Observação</label>
                                    <textarea class="form-control textarea" style="height:150px;" name="observacao" placeholder="Escreva algo aqui..."><?= isset($licenciando['observacao']) ? $licenciando['observacao'] : set_value('observacao') ?></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="licenciando_id" value="<?= isset($licenciando['licenciando_id']) ? $licenciando['licenciando_id'] : set_value('licenciando_id') ?>">
                        <input type="hidden" name="endereco_id" value="<?= isset($licenciando['endereco_id']) ? $licenciando['endereco_id'] : set_value('endereco_id') ?>">
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <input type="submit" name="submit" class="btn btn-primary btn-round" value="<?= isset($licenciando) ? 'Atualizar' : 'Adicionar' ?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($licenciando)) : ?>
    <div class="modal fade" id="documentoModal" tabindex="-1" role="dialog" aria-labelledby="documentoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: medium;">
                        <strong id="nomeDocumento">
                            #
                        </strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="document_action" class="needs-validation" novalidate action="#" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Selecione o setor</label>
                            <?php
                            $setores_options = array('' => 'Nenhum');
                            foreach ($licenciandoSetores as $licenciandoSetor) {
                                $setores_options[$licenciandoSetor['nome']] = $licenciandoSetor['nome'];
                            }
                            $field = 'documentoSetor';
                            $value = set_value($field, null, FALSE);
                            echo form_dropdown('documentoSetor', $setores_options, $value, 'tabindex="-1" class="custom-select mr-sm-2" required');
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">Confirmar</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
<?php endif ?>