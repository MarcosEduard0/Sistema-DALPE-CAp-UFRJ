<br>
<div class="col-md-12">
    <div class="credits ml-auto" role="toolbar" aria-label="Toolbar with button groups">
        <a class="btn btn-primary" href="<?= base_url('/usuarios/adicionar') ?>" role="button">Adicionar</a>
    </div>
    <div class="card">
        <!-- <div class="card-header">
            <h4 class="card-title"><?= $titulo ?></h4>
        </div> -->
        <div class="card-body">
            <div class="">
                <table id="tabela" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nome</th>
                            <th>Última Conexão</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php if (!empty($usuarios) && is_array($usuarios)) : ?>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr>
                                    <td><?= $usuario['usuario'] ?></td>
                                    <td><?= $usuario['nome_completo'] ?></td>
                                    <td><?php if ($usuario['ultimo_login'] == '0000-00-00 00:00:00' || empty($usuario['ultimo_login'])) {
                                            echo 'Nunca';
                                        } else {
                                            echo utf8_encode(strftime("%d/%m/%Y, %H:%M", strtotime($usuario['ultimo_login'])));
                                        }
                                        ?></td>
                                    <td class="text-center">
                                        <div class="actions">
                                            <a href="<?= base_url('/usuarios/editar/' . $usuario['usuario_id']) ?>"><i class='bx bxs-edit'></i></a>
                                            <a id="<?= $usuario['usuario_id'] ?>" type="button" data-toggle="modal" data-target="#exampleModal" onclick="deleteModal(this.id)" data-detalhes='<?= json_encode($usuario) ?>'><i class='bx bxs-trash-alt'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deletar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p> Você tem certeza que deseja deletar o usuário <br><strong id="nome"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                <a type="button" href="#" id="confirmDelete" class="btn btn-danger">Deletar</a>
            </div>
        </div>
    </div>
</div>