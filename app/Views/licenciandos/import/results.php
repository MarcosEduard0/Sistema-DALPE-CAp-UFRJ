<?php
function import_status($key)
{
    $labels = array(
        'setor_invalido' => 'Setor inexistente',
        'universidade_invalida' => 'Universidade inexistente',
        'licenciando_existente' => 'Licenciando existe',
        'sucesso' => 'Sucesso',
        'bd_erro' => 'Erro',
        'invalid' => 'Falha na validação',
    );

    if (array_key_exists($key, $labels)) {
        return $labels[$key];
    }
    return 'Desconhecido';
}
?>

<?= (isset($validation)) ? $validation->listErrors() : '' ?>
<?= session()->getFlashdata('msg') ?>

<div class="col-md-10">

    <div class="card">
        <!-- <div class="card-header">
            <h4 class="card-title"><?= $titulo ?></h4>
        </div> -->
        <div class="card-body">
            <div class="">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <td>Linha</td>
                            <td>Licenciando</td>
                            <td>Importado</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $row) {
                            switch ($row->status) {
                                case 'sucesso':
                                    $colour = 'badge badge-success';
                                    break;
                                case 'setor_invalido':
                                case 'universidade_invalida':
                                    $colour = 'badge badge-warning';
                                    break;
                                case 'licenciando_existente':
                                    $colour = 'badge badge-info';
                                    break;
                                default:
                                    $colour = 'badge badge-danger';
                                    break;
                            };

                            echo '<tr>';
                            echo "<td>#{$row->line}</td>";
                            echo '<td style="width: 50%">' . $row->licenciando . '</td>';
                            echo '<td>' . ($row->status == 'sucesso' ? 'Sim' : 'Não') . '</td>';
                            echo "<td><span class='{$colour}'>" . import_status($row->status) . "</span>";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="update ml-auto mr-auto" role="toolbar" aria-label="Toolbar with button groups">
                        <a class="btn btn-primary" href="<?= base_url('/licenciandos') ?>" role="button">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>