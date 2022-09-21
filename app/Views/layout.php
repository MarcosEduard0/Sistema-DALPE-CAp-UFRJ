<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url("public/assets/img/apple-icon.png") ?>">
    <link rel="icon" type="image/png" href="<?= base_url("public/assets/img/favicon.png") ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        <?= $titulo ?>
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/bootstrap.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/paper-dashboard.css?v=2.0.1") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/style.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/my-login.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/dataTables.bootstrap4.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/fontawesome-5.15.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/choices.min.css") ?>">

    <!-- <body onload="demo.showNotification('top','center')"> -->

<body onload="<?= session()->getFlashdata('msg') ?>">
    <?php if (session()->get('logged_in')) : ?>
        <div class="wrapper ">
            <div class="sidebar" data-color="white" data-active-color="danger">
                <div class="logo" style="text-align: -webkit-center;">
                    <!-- <a href="#" class="simple-text logo-mini">
                        <div class="logo-image-small">
                            <img src="<?= base_url("public/assets/img/cap.png") ?>">
                        </div>
                        <p>CT</p>
                    </a> -->
                    <a href="#" class="simple-text logo-normal">
                        DALPE CAp UFRJ
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="<?= (session()->get('posicao') == 'Home') ? 'active' : '' ?>">
                            <a href="<?= base_url('/home') ?>">
                                <i class="fa fa-home fa-4x"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="<?= (session()->get('posicao') == 'Licenciandos') ? 'active' : '' ?>">
                            <a href="<?= base_url('/licenciandos') ?>">
                                <i class="fa fa-graduation-cap fa-4x"></i>
                                <p>Licenciandos</p>
                            </a>
                        </li>
                        <li class="<?= (session()->get('posicao') == 'Setores') ? 'active' : '' ?>">
                            <a href="<?= base_url('/setores') ?>">
                                <i class="fa fa-pencil-ruler fa-4x"></i>
                                <p>Setores</p>
                            </a>
                        </li>
                        <li class="<?= (session()->get('posicao') == 'Universidade') ? 'active' : '' ?>">
                            <a href="<?= base_url('/universidades') ?>">
                                <i class="fa fa-university fa-4x"></i>
                                <p>Universidade</p>
                            </a>
                        </li>
                        <li class="<?= (session()->get('posicao') == 'Documentos') ? 'active' : '' ?>">
                            <a href="<?= base_url('/documentos') ?>">
                                <i class="fa fa-file-pdf fa-4x"></i>
                                <p>Documentos</p>
                            </a>
                        </li>
                        <li class="<?= (session()->get('posicao') == 'relatorios') ? 'active' : '' ?>">
                            <a href="<?= base_url('/relatorios') ?>">
                                <i class="fa fa-file-alt fa-4x"></i>
                                <p>Relatórios</p>
                            </a>
                        </li>
                        <li class="<?= (session()->get('posicao') == 'Usuarios') ? 'active' : '' ?>">
                            <a href="<?= base_url('/usuarios') ?>">
                                <i class="fa fa-users fa-4x"></i>
                                <p>Usuários</p>
                            </a>
                        </li>
                        <!-- <li class="active-pro">
            <a href="#">
              <i class="nc-icon nc-spaceship"></i>
              <p>Config</p>
            </a>
          </li> -->
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                    <div class="container-fluid">
                        <!-- Barra lateral -->
                        <div id="wrapper">
                            <div class="overlay"></div>
                            <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
                                <ul class="nav sidebar-nav">
                                    <div class="sidebar-header">
                                        <div class="sidebar-brand">
                                            <strong style="color: white;">DALPE CAp UFRJ</strong>
                                        </div>
                                    </div>
                                    <li><a href="<?= base_url('/home') ?>"> <i class="fa fa-home fa-1x"></i> Início</a></li>
                                    <li><a href="<?= base_url('/licenciandos') ?>"><i class="fa fa-graduation-cap fa-1x"></i> Licenciandos</a></li>
                                    <li><a href="<?= base_url('/setores') ?>"><i class="fa fa-pencil-ruler fa-1x"></i> Setores</a></li>
                                    <li><a href="<?= base_url('/universidades') ?>"><i class="fa fa-university fa-1x"></i> Universidade</a></li>
                                    <li><a href="<?= base_url('/documentos') ?>"><i class="fa fa-file-alt fa-1x"></i> Documentos</a></li>
                                    <li><a href="<?= base_url('/documentos') ?>"><i class="fa fa-file-alt fa-1x"></i> Relatorios</a></li>
                                    <li><a href="<?= base_url('/usuarios') ?>"><i class="fa fa-users fa-1x"></i> Usuários</a></li>

                                </ul>
                            </nav>
                            <div id="page-content-wrapper">

                                <div class="navbar-wrapper">
                                    <div class="navbar-toggle">
                                        <button type="button" class="navbar-toggler" data-toggle="offcanvas">
                                            <span class="navbar-toggler-bar bar1"></span>
                                            <span class="navbar-toggler-bar bar2"></span>
                                            <span class="navbar-toggler-bar bar3"></span>
                                        </button>
                                    </div>
                                    <a class="navbar-brand"><?= $titulo ?></a>
                                </div>
                            </div>
                        </div>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navigation">
                            <ul class="navbar-nav">
                                <li class="nav-item btn-rotate dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?= (strlen(session()->get('usuario')['nome_social']) < 1) ? session()->get('usuario')['nome_completo'] : session()->get('usuario')['nome_social'] ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="<?= base_url('/usuarios/logout') ?>">Sair</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="content">
                    <div class="row" style="place-content: center;">
                        <?php if (isset($body)) echo $body; ?>

                    </div>
                </div>
                <footer class="footer footer-black  footer-white ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="credits ml-auto">
                                <span class="copyright">
                                    Por <t data-toggle="tooltip" data-placement="top" title="marcos.eduardo22@gmail.com">
                                        Marcos Eduardo de Souza
                                    </t> &nbsp;&bull;&nbsp; Versão <?= VERSAO ?>.&copy; <?= date('Y') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    <?php else :
        echo $body;
    endif ?>
</body>

<script type='text/javascript' src="<?= base_url("public/assets/js/jquery-3.5.1.js") ?>"></script>
<script type='text/javascript' src="<?= base_url("public/assets/js/dataTables.min.js") ?>"></script>
<script type='text/javascript' src="<?= base_url("public/assets/js/choices.min.js") ?>"></script>
<script type='text/javascript' src="<?= base_url("public/assets/js/dataTables.bootstrap4.min.js") ?>"></script>
<script type='text/javascript' src="<?= base_url("public/assets/js/main.js") ?>"></script>
<script type='text/javascript' src="<?= base_url("public/assets/js/functions.js") ?>"></script>
<script type='text/javascript' src="<?= base_url("public/assets/js/popper.min.js") ?>"></script>
<script type='text/javascript' src="<?= base_url("public/assets/js/bootstrap.js") ?>"></script>
<script type='text/javascript' src="<?= base_url("public/assets/js/plugins/bootstrap-notify.js") ?>"></script>

</html>