<div class="login">
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <img src="public/assets/img/cap.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <p class="login-card-description">Login</p>
                            <form action="usuarios/login" method="post" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="usuario" class="sr-only">Usuário</label>
                                    <input type="text" name="usuario" class="form-control" placeholder="Usuário" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="senha" class="sr-only">Senha</label>
                                    <input type="password" name="senha" class="form-control" placeholder="***********" required>
                                </div>
                                <?= csrf_field(); ?>
                                <input class="btn btn-block login-btn mb-4" type="submit" value="Entrar">
                            </form>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<div class="developer">Por <t data-toggle="tooltip" data-placement="top" title="marcos.eduardo22@gmail.com">
        Marcos Eduardo de Souza
    </t> &nbsp;&bull;&nbsp; Versão <?= VERSAO ?>.&copy; <?= date('Y') ?></div>