<?= $this->extend('layout') ?>
<?= $this->section('body') ?>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="<?= base_url("public/assets/img/logo.jpg") ?>" alt="logo">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <?= session()->getFlashdata('msg') ?>
                            <h4 class="card-title"><?= $titulo ?></h4>
                            <form action="usuarios/login" method="post" class="my-login-validation" novalidate="">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input id="usuario" type="text" class="form-control" name="usuario" value="" required autofocus>
                                    <div class="invalid-feedback">
                                        Usuário obrigatório
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="senha">Senha
                                    </label>
                                    <input id="senha" type="password" class="form-control" name="senha" required data-eye>
                                    <div class="invalid-feedback">
                                        Senha obrigatória
                                    </div>
                                </div>
                                <?= csrf_field(); ?>
                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Entrar
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="footer">Desenvolvido por <t data-toggle="tooltip" title="marcos.eduardo22@gmail.com">Marcos Eduardo de Souza</t>.
                        <br />Versão 1.0.0 &copy; <?= date('Y') ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?= $this->endSection() ?>