    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="padding-left: 20px;">Documentos</h4>
        </div>
        <div class="card-body">
            <ul class="list-unstyled team-members">
                <li>
                    <div class="row">
                        <div class="col-md-1 pl-5">
                            <div class="avatar-documento">
                                <i class='bx bx-id-card nav_icon'></i>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <a target="_blank" href="<?= base_url('/documentos/cracha/' . $licenciando['licenciando_id'] . '/' . $licenciandoSetor_id) ?>"> CRACHÁ</a>
                        </div>
                    </div>
                </li>
                <br>
                <?php foreach ($documentos as $documento) : ?>
                    <li>
                        <div class="row">
                            <div class="col-md-1 pl-5">
                                <div class="avatar-documento">
                                    <i class='bx bx-file nav_icon'></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <a target="_blank" href="<?= base_url('/documentos/emitir/' . $licenciando['licenciando_id']  . '/' . $licenciandoSetor_id . '/' . $documento['documento_id']) ?>">
                                    <?= strtoupper($documento['nome']) ?>
                                </a>

                            </div>
                        </div>
                    </li>
                    <br>
                <?php endforeach ?>
            </ul>
        </div>
    </div>