<?php if (isset($usuario)) $baseUrl = 'editar/' . $usuario['usuario_id'];
else $baseUrl = 'adicionar'; ?>

<form class="needs-validation" novalidate action="<?= base_url('/usuarios/' . $baseUrl) ?>" method="post" enctype="multipart/form-data">

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <?= (isset($validation)) ? $validation->listErrors() : '' ?>
                        <!-- <h5 class="card-title"></h5> -->
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="usuario">Usuário</label>
                                    <input type="text" class="form-control" value="<?= isset($usuario['usuario']) ? $usuario['usuario'] : set_value('usuario') ?>" name="usuario" required>
                                    <div class="invalid-feedback">
                                        Usuário é obrigatório
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label for="senha1">Senha</label>
                                    <?php (!isset($usuario['usuario_id']) ? $required = 'required' : $required = '') ?>
                                    <input type="password" class="form-control" value="" name="senha1" <?= $required ?>>
                                    <div class="invalid-feedback">
                                        Senha é obrigatório
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="senha2">Senha (novamente)</label>
                                    <input type="password" class="form-control" value="" name="senha2" <?= $required ?>>
                                    <div class="invalid-feedback">
                                        Confirmar senha é obrigatório
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="nome_completo">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome_completo" value="<?= isset($usuario['nome_completo']) ? $usuario['nome_completo'] : set_value('nome_completo') ?>" required>
                                    <div class="invalid-feedback">
                                        Nome Completo é obrigatório
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="nome_social">Nome Social</label>
                                    <input type="text" class="form-control" name="nome_social" value="<?= isset($usuario['nome_social']) ? $usuario['nome_social'] : set_value('nome_social') ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2 pr-1">
                                <div class="form-group">
                                    <label for="siape">Siape</label>
                                    <input type="text" class="form-control" value="<?= isset($usuario['siape']) ? $usuario['siape'] : set_value('siape') ?>" name="siape" required>
                                    <div class="invalid-feedback">
                                        Siape é obrigatório
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label for="cargo">Cargo</label>
                                    <input type="text" class="form-control" value="<?= isset($usuario['cargo']) ? $usuario['cargo'] : set_value('cargo') ?>" name="cargo" required>
                                    <div class="invalid-feedback">
                                        Cargo é obrigatório
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" value="<?= isset($usuario['email']) ? $usuario['email'] : set_value('email') ?>" name="email">
                                </div>
                            </div>
                            <div class="col-md-2 pl-1">
                                <div class="form-group">
                                    <label for="telefone">Telefone </label>
                                    <input type="text" class="form-control" value="<?= isset($usuario['telefone']) ? $usuario['telefone'] : set_value('telefone') ?>" name="telefone" onkeypress="$(this).mask('(00) 0000-00000')">
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="usuario_id" value="<?= isset($usuario['usuario_id']) ? $usuario['usuario_id'] : set_value('usuario_id') ?>">
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <input type="submit" name="submit" class="btn btn-primary btn-round" value="<?= isset($usuario) ? 'Atualizar' : 'Adicionar' ?>">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-user">
                    <!-- <div class="image">
                    <img src="<?= base_url("public/assets/img/header.jpg") ?>" alt="...">
                    </div> -->
                    <div class="card-body">
                        <div class="text-center">
                            <label class=newbtn>
                                <img id="imgLicen" src="<?= isset($usuario['assinatura']) ? base_url("public/assets/uploads/" . $usuario['assinatura']) : base_url("public/assets/img/no-img.jpg") ?>" style=" width: 350px; height: auto">
                                <input type="file" id="filImage" name="assinatura" accept="image/*">
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row" style="justify-content: center;">
                                <?php if (isset($usuario)) : ?>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="deleteAssinatura" id="deleteAssinatura">
                                        <label class="custom-control-label" for="deleteAssinatura">Deletar Assinatura Atual</label>
                                    </div>
                                <?php else : ?>
                                    <strong><label>Usuário sem assinatura</label></strong>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>