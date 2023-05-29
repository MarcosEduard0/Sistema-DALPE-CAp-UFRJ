<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['table']
    });
    google.charts.setOnLoadCallback(drawTable);

    function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Email');
        data.addColumn('string', 'Nome');
        data.addColumn('string', 'Nome Social');
        data.addColumn('string', 'Dre');
        data.addColumn('string', 'Instituição(sigla)');
        data.addColumn('string', 'Prof.ª Prática');
        data.addColumn('string', 'Setor Curricular');
        data.addColumn('string', 'Endereço');
        data.addColumn('string', 'Bairro');
        data.addColumn('string', 'Cep');
        data.addColumn('string', 'Cidade');
        data.addColumn('string', 'Telefone 1');
        data.addColumn('string', 'Telefone 2');
        data.addRows([
            ['exemplo@gmail.com', 'Maria Clara', '', '1234567', 'UFRJ', 'Renata, Bruno Gomes', 'Matemática, Geografia', 'Rua clementina', 'Tijuca', '21022-404', 'Rio de Janeiro', '219940524', '']
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {
            showRowNumber: false,
            width: '100%',
            height: '100%'
        });
    }
</script>
<div class="content">
    <div class="row" style="place-content: center;">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-body ">
                    <?= (isset($validation)) ? $validation->listErrors() : '' ?>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <strong><label for="nome">Formato CSV</label></strong>
                            <p>Seu arquivo CSV deve estar nesta ordem:</p>
                            <div class="card">
                                <div id="table_div">
                                </div>
                            </div>
                            <p>Nota: Se os campos <strong>Setor Curricular</strong> e <strong>Prof.ª Prática</strong> tiverem mais de um valor,
                                esses valores devem ser separados por vírgulas.
                                <br>Se esses valores forem provenientes de cadastros diferentes, a importação irá comparar o setor atual
                                com o setor que está sendo cadastrado.
                            </p>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="<?= base_url('/licenciandos/importar') ?>" method="post" enctype="multipart/form-data">
                        <p class="input-group">
                            <label for="userfile" class="required">Arquivo CSV</label></br>
                            <?php
                            echo form_upload(array(
                                'name' => 'userfile',
                                'id' => 'userfile',
                                'size' => '40',
                                'maxlength' => '255',
                                'value' => '',
                                'class' => 'form-control-file',
                            ));
                            ?>
                            <small class="text-muted">
                                Tamanho máximo do arquivo <strong>10MB</strong>.
                            </small>
                        <div class="form-group" style="width: max-content;">
                            <label for="periodo">Período da importação:</label>
                            <?php
                            $field = 'periodo';
                            $value = set_value($field, reset($periodos['Atual']), FALSE);
                            echo form_dropdown($field, $periodos, $value, 'tabindex="-1" class="custom-select mr-sm-2" required');
                            ?>
                            <div class="invalid-feedback">
                                Período é obrigatório
                            </div>
                        </div>
                        </p>
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <input type="submit" name="submit" class="btn btn-primary btn-round" value="Importar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>