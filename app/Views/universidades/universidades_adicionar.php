<?php if (isset($universidade)) $baseUrl = 'editar/' . $universidade['universidade_id'];
else $baseUrl = 'adicionar'; ?>

<form class="needs-validation" novalidate action="<?= base_url('/universidades/' . $baseUrl) ?>" method="post">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <!-- <div class="card-header ">
                    Google Maps
                </div> -->
                    <div class="card-body ">
                        <div style="padding-top: 2%;">
                            <?= session()->getFlashdata('msg') ?>
                            <?php if (isset($validation)) echo $validation->listErrors(); ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="sigla">Sigla</label>
                                <input type="text" class="form-control" name="sigla" value="<?= isset($universidade['sigla']) ? $universidade['sigla'] : set_value('sigla') ?>" required>
                                <div class="invalid-feedback">
                                    Sigla é obrigatório.
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" value="<?= isset($universidade['nome']) ? $universidade['nome'] : set_value('nome') ?>" required>
                                <div class="invalid-feedback">
                                    Nome é obrigatório.
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="universidade_id" value="<?= isset($universidade['universidade_id']) ? $universidade['universidade_id'] : set_value('universidade_id') ?>">
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <input type="submit" name="submit" class="btn btn-primary btn-round" value="<?= isset($universidade) ? 'Atualizar' : 'Adicionar' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>