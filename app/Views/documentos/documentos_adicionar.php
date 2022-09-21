<?php if (isset($documento)) $baseUrl = 'editar/' . $documento['documento_id'];
else $baseUrl = 'adicionar'; ?>
<form class="needs-validation" novalidate action="<?= base_url('/documentos/' . $baseUrl) ?>" method="post">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">

                    </div>
                    <div class="card-body ">
                        <?= (isset($validation)) ? $validation->listErrors() : '' ?>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <strong><label for="nome">Opções</label></strong>
                                <p>Escreva o texto do documento e coloque entre colchetes o dado que você precisar:</p>
                                <div class="card">
                                    <div style="background: #f4f4f4" class="card-body">
                                        <p class="card-text">[NOME], [ENDERECO], [NUMERO], [COMPLEMENTO], [BAIRRO], [CIDADE], [CEP], [SETOR], [UNIVERSIDADE], <br> [PROFESSOR], [DATA_CADASTRO], [HORAS_ESTAGIO], [DATA_INICIO], [DATA_TERMINO], [ANO_TERMINO], [PARAGRAFO]</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" value="<?= isset($documento['nome']) ? $documento['nome'] : set_value('nome') ?>" required>
                                <div class="invalid-feedback">
                                    Nome é obrigatório.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="conteudo">Conteúdo</label>
                                <textarea type="text" class="form-control" style="height:350px;" name="conteudo" value="" required><?= isset($documento['conteudo']) ? $documento['conteudo'] : set_value('conteudo') ?></textarea>
                                <div class="invalid-feedback">
                                    Texto é obrigatório.
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="documento_id" value="<?= isset($documento['documento_id']) ? $documento['documento_id'] : set_value('documento_id') ?>">
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <input type="submit" name="submit" class="btn btn-primary btn-round" value="<?= isset($documento) ? 'Atualizar' : 'Adicionar' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>