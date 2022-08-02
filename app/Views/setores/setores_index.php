<div class="col-md-10">
    <div class="credits ml-auto" role="toolbar" aria-label="Toolbar with button groups">
        <a class="btn btn-primary" href="<?= base_url('/setores/adicionar') ?>" role="button">Adicionar</a>
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
                            <th>Nome</th>
                            <th>Coordenador</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php if (!empty($setores) && is_array($setores)) : ?>

                            <?php foreach ($setores as $setor) : ?>
                                <tr>
                                    <td><?= $setor['nome'] ?></td>
                                    <td><?= $setor['descricao'] ?></td>
                                    <td class="text-center">
                                        <div class="actions">
                                            <a href="<?= base_url('/setores/editar/' . $setor['setor_id']) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a id="<?= $setor['setor_id'] ?>" type="button" data-toggle="modal" data-target="#exampleModal" onclick="deleteModal(this.id)" data-detalhes='<?= json_encode($setor) ?>'><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Deletar Setor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <p> Você tem certeza que deseja deletar o setor <br><strong id="nome"></strong>?</p>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                <a type="button" href="#" id="confirmDelete" class="btn btn-danger">Deletar</a>
            </div>
        </div>
    </div>
</div>