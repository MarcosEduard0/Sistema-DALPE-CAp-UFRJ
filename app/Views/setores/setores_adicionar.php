<?php if (isset($setor)) $baseUrl = 'editar/' . $setor['setor_id'];
else $baseUrl = 'adicionar'; ?>

<form class="needs-validation" novalidate action="<?= base_url('/setores/' . $baseUrl) ?>" method="post">
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
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" value="<?= isset($setor['nome']) ? $setor['nome'] : set_value('nome') ?>" required>
                                <div class="invalid-feedback">
                                    Nome é obrigatório.
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="descricao">Coordenador</label>
                                <input type="text" class="form-control" name="descricao" value="<?= isset($setor['descricao']) ? $setor['descricao'] : set_value('descricao') ?>">
                            </div>
                        </div>
                        <input type="hidden" name="setor_id" value="<?= isset($setor['setor_id']) ? $setor['setor_id'] : set_value('setor_id') ?>">
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <input type="submit" name="submit" class="btn btn-primary btn-round" value="<?= isset($setor) ? 'Atualizar' : 'Adicionar' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>