<body style="position: relative;" onload="<?= session()->getFlashdata('msg') ?>">
    <div class="login-form">
        <div class="image-container">
            <figure>
                <img width="180" src="public/assets/img/documentos/brasao_75_anos.jpg" alt="Logo">
            </figure>
        </div>

        <form action="usuarios/login" method="post" class="needs-validation" novalidate>
            <div class="form-group ">
                <input type="text" class="form-control" placeholder="Usuário" name="usuario" required>
                <div class="invalid-feedback">
                    Usuário é obrigatório.
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="********" name="senha" required>
                <div class="invalid-feedback">
                    Senha é obrigatório.
                </div>
            </div>
            <input class="log-btn" type="submit" value="Entrar">
        </form>
    </div>
    <div class="developer">Por <t data-toggle="tooltip" data-placement="top" title="marcos.eduardo22@gmail.com">
            Marcos Eduardo de Souza
        </t> &nbsp;&bull;&nbsp; Versão <?= VERSAO ?>.&copy; <?= date('Y') ?></div>
</body>