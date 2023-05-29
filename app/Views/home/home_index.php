<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Carrega a biblioteca do Google Charts
    google.charts.load('current', {
        'packages': ['corechart', 'bar', 'line']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Define a função para criar o gráfico
    function drawChart() {

        // Gráfico 1
        // Gráfico Licendiando por Instituição
        var data = google.visualization.arrayToDataTable(<?= $quantUniversidadeLicenciando ?>)

        // Cria um objeto de opções do Google Charts
        var options = {
            legend: {
                position: 'none'
            },
            bars: 'horizontal',
        };

        // Cria um objeto de gráfico do Google Charts
        var chart = new google.charts.Bar(document.getElementById('barchart'));
        chart.draw(data, google.charts.Bar.convertOptions(options));

        // Gráfico 2
        // Gráfico Licendiando por Setores
        data = new google.visualization.arrayToDataTable(<?= $quantSetoresLicendiando ?>);

        // Cria um objeto para armazenar as cores utilizadas

        var options = {
            height: 'auto',
            legend: {
                position: 'none'
            },
            hAxis: {
                title: '',
            },
            bar: {
                groupWidth: "90%"
            }
        };
        var chart = new google.charts.Bar(document.getElementById('columnchart_values'));
        chart.draw(data, google.charts.Bar.convertOptions(options));

        // Gráfico 3
        // Gráfico de Linha
        data = new google.visualization.DataTable();
        data.addColumn('string', 'Períodos');
        data.addColumn('number', 'Quant.');

        <?php if (!empty($quantPeriodos)) : ?>
            // Adicionar linhas com base nos valores recebidos do backend
            <?php foreach ($quantPeriodos as $item) : ?>
                data.addRow(['<?php echo $item['periodo']; ?>', <?php echo $item['quantidade']; ?>]);
            <?php endforeach; ?>
        <?php else : ?>
            // Se o arrayData estiver vazio, adicionar uma única linha com a mensagem de aviso
            data.addRow(['Nenhum dado disponível', 0]);
        <?php endif; ?>
        var options = {
            legend: {
                position: 'none'
            },
        };

        var chart = new google.charts.Line(document.getElementById('lineYears'));
        chart.draw(data, options);
    }
</script>

<div class="content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-badge text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Licenciandos</p>
                                <p class="card-title"><?= $quantLicenciando ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-ruler-pencil text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Setores</p>
                                <p class="card-title"><?= $quantSetores ?>
                                <p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-bank text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Universidades</p>
                                <p class="card-title"><?= $quantUniversidades ?>
                                <p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-single-copy-04 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Documentos</p>
                                <p class="card-title"><?= $quantDocumentos ?>
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- <div class="graficoHome"> -->
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Licenciandos por Instituição</h5>
                </div>
                <div class="card-body ">
                    <!-- <div id="barchart" class="graficoSetor"></div> -->
                    <div id="barchart"></div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Licenciando por Período</h5>
                    <!-- <p class="card-category">24 Hours performance</p> -->
                </div>
                <div class="card-body ">
                    <div id=lineYears></div>
                </div>
                <!-- <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> Updated 3 minutes ago
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- <div class="graficoHome"> -->
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-title">Licenciando por Setor</h5>
                </div>
                <div class="card-body">
                    <div id="columnchart_values"></div>
                </div>
                <div class="card-footer">
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12">

            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Licenciandos por setores</h5>
                    <p class="card-category">Quantidade de licenciandos por sertor</p>
                </div>
                <div class="card-body ">
                    <div id="barchart" style="width: 1500px; height: 450px;"></div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> Updated 3 minutes ago
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</div>