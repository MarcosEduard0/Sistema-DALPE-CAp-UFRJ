<?php if (isset($licenciando)) $baseUrl = 'editar/' . $licenciando['licenciando_id'] . '/' . $licenciandoSetor_id;
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

                    <div class="row" style="justify-content: center; text-align-last: center;">
                        <div class="col-md-6 px-1">
                            <?php if (isset($licenciando)) : ?>
                                <form class="needs-validation" novalidate action="<?= base_url('/licenciandos/setor_select/' . $licenciando['licenciando_id']) ?>" method="post">
                                    <?php
                                    // $setores_options = array(0 => 'Nenhum');
                                    $setores_options = array();
                                    foreach ($licenciandoSetores as $licenciandoSetor) {
                                        $setores_options[$licenciandoSetor['id']] = $licenciandoSetor['nome'];
                                    }
                                    $field = 'licenciando_setor';
                                    $value = set_value($field, null, FALSE);

                                    echo form_dropdown(
                                        $field,
                                        $setores_options,
                                        $licenciandoSetor_id,
                                        'onchange="this.form.submit()" onmouseup="this.form.submit" class="form-control"',
                                    );
                                    ?>
                                </form>
                            <?php endif ?>
                        </div>
                    </div>
                    <p class="description text-center"><br>
                        <?= isset($licenciando['observacao']) ? $licenciando['observacao'] : '' ?>
                    </p>
                </div>
                <?php if (isset($licenciando)) : ?>
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-6 ml-auto">

                                    <h5><?= $setor_data['horas_estagio'] ?><br><small>Horas</small></h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5><?= $licenciando['universidade_sigla'] ?><br><small>Instituição</small></h5>
                                </div>
                                <div class="col-lg-3 mr-auto">
                                    <h5><?= (strtotime($setor_data['data_termino']) <= strtotime(date('Y-m-j')) && $setor_data['data_termino'] != '0000-00-00') ? "SIM" :  "NÃO" ?><br><small>Concluinte</small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <?php if (isset($licenciando)) : ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="padding-left: 30px;">Documentos</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled team-members">
                            <li>
                                <div class="row">
                                    <div class="col-md-2 pl-5">
                                        <div class="avatar-documento">
                                            <i class="fa fa-file-pdf fa-2x "></i>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <a target="_blank" href="<?= base_url('/documentos/cracha/' . $licenciando['licenciando_id'] . '/' . $licenciandoSetor_id) ?>">CRACHÁ</a>
                                    </div>
                                </div>
                            </li>
                            <br>
                            <?php foreach ($documentos as $documento) : ?>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2 pl-5">
                                            <div class="avatar-documento">
                                                <i class="fa fa-file-pdf fa-2x "></i>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <a target="_blank" href="<?= base_url('/documentos/emitir/' . $licenciando['licenciando_id']  . '/' . $licenciandoSetor_id . '/' . $documento['documento_id']) ?>">
                                                <?= $documento['nome'] ?>
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
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['bairro']) ? $licenciando['bairro'] : set_value('bairro') ?>" name="bairro">
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['cep']) ? $licenciando['cep'] : set_value('cep') ?>" name="cep">
                                </div>
                            </div>
                            <div class="col-md-5 pl-1">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" value="<?= isset($licenciando['cidade']) ? $licenciando['cidade'] : set_value('cidade') ?>" name="cidade">
                                </div>
                            </div>
                        </div>
                        <?php if (!isset($licenciando)) : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="quantSetor">Quant. Setores</label>
                                        <input id="numeros" class="form-control" type="number" min="1" max="20" value="1" />
                                    </div>
                                </div>
                            </div>
                            <div id="divSetor">
                                <div class="row" name="novoSetor">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label for="setores">Setores</label>
                                            <?php
                                            $setores_options = array();
                                            foreach ($setores as $setor) {
                                                $setores_options[$setor['setor_id']] = $setor['nome'];
                                            }
                                            $field = 'setor_id';
                                            $value = set_value($field, isset($licenciando) ? $setores_options : '', FALSE);
                                            echo form_dropdown(
                                                'setor_id[]',
                                                $setores_options,
                                                $value,
                                                'tabindex="-1" class="custom-select mr-sm-2" required'
                                            );
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label for="horas_estagio">Horas de estagio:</label>
                                            <input type="text" class="form-control" name="horas_estagio[]">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label for="data_inicio">Data de início:</label>
                                            <input type="date" class="form-control" name="data_inicio[]">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label for="data_termino">Data Conclusão:</label>
                                            <input type="date" class="form-control" name="data_termino[]">
                                        </div>
                                    </div>
                                    <div class="col-md-8 pl-1">
                                        <div class="form-group">
                                            <label for="professor">Professor(a) de Prática</label>
                                            <input type="text" class="form-control" id="professor" name="professor[]">
                                        </div>
                                    </div>

                                </div>

                            </div>
                        <?php endif;  ?>
                        <?php if (isset($licenciando)) : ?>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label for="data_cadastro">Data de cadastro:</label>
                                        <input type="date" class="form-control" value="<?= isset($setor_data['data_cadastro']) ? $setor_data['data_cadastro'] : set_value('data_cadastro') ?>" name="data_cadastro" disabled="">
                                    </div>
                                </div>
                                <div class=" col-md-4 px-1">
                                    <div class="form-group">
                                        <label for="data_inicio">Data de início:</label>
                                        <input type="date" class="form-control" value="<?= isset($setor_data['data_inicio']) ? $setor_data['data_inicio'] : set_value('data_inicio') ?>" name="data_inicio">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label for="data_termino">Data Conclusão:</label>
                                        <input type="date" class="form-control" value="<?= isset($setor_data['data_termino']) ? $setor_data['data_termino'] : set_value('data_termino') ?>" name="data_termino">
                                    </div>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label for="horas_estagio">Horas de estagio:</label>
                                        <input type="text" class="form-control" value="<?= isset($setor_data['horas_estagio']) ? $setor_data['horas_estagio'] : set_value('horas_estagio') ?>" name="horas_estagio">
                                    </div>
                                </div>
                                <div class="col-md-8 pl-1">
                                    <div class="form-group">
                                        <label for="professor">Professor(a) de Prática</label>
                                        <input type="text" class="form-control" value="<?= isset($setor_data['professor']) ? $setor_data['professor'] : set_value('professor') ?>" name="professor">
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
                                        echo form_dropdown(
                                            'setor_id[]',
                                            $setores_options,
                                            $value,
                                            'id="choices-multiple-remove-button" multiple required placeholder="Digite para pesquisar..."'
                                        );
                                        ?>
                                        <div class="invalid-feedback">
                                            Setor Curricular é obrigatório
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
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
                        <input type="hidden" name="licenciandoSetor_id" value="<?= isset($licenciandoSetor_id) ? $licenciandoSetor_id : set_value('licenciandoSetor_id') ?>">
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