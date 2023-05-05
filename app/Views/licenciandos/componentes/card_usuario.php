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