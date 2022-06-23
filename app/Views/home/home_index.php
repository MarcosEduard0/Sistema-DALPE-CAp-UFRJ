<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function gerar_cor() {
        return '#' + parseInt((Math.random() * 0xFFFFFF))
            .toString(16)
            .padStart(6, '0');
    }

    function drawChart() {
        var i;
        var data = google.visualization.arrayToDataTable([
            ['Licenciandos por setor', 'Percentage'],
            <?php foreach ($quantSetores as $setores) : ?>['<?= $setores['nome'] ?>', <?= $setores['quantidade'] ?>],
            <?php endforeach ?>
        ]);

        var options = {
            title: ''
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);

        data = google.visualization.arrayToDataTable([
            ["Element", "Density", {
                role: "style"
            }],
            <?php foreach ($quantUniversidades as $universidades) : ?>['<?= $universidades['sigla'] ?>', <?= $universidades['quantidade'] ?>, gerar_cor()],
            <?php endforeach ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2
        ]);

        options = {
            // title: "Density of Precious Metals, in g/cm^3",
            // width: 600,
            // height: 400,
            bar: {
                groupWidth: "95%"
            },
            legend: {
                position: "none"
            },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
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
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-refresh"></i>
                        Atualizado agora
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
                                <p class="card-title">11
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-calendar-o"></i>
                        Um dia atrás
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
                                <p class="card-title">23
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-clock-o"></i>
                        Na última hora
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
                                <p class="card-title">1
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-refresh"></i>
                        Atualizado agora
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="graficoHome">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Licenciandos por setores</h5>
                    </div>
                    <div class="card-body ">
                        <div id="piechart" class="graficoSetor"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="graficoHome">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-title">Licenciando por instituição</h5>
                    </div>
                    <div class="card-body">
                        <div id="columnchart_values" style=" height: auto;"></div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Users Behavior</h5>
                    <p class="card-category">24 Hours performance</p>
                </div>
                <div class="card-body ">
                    <canvas id=chartHours width="400" height="100"></canvas>
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
    <!-- <div id="piechart" style="width: 1500px; height: 450px;"></div> -->

    <!-- <div class="row">
        <div class="col-md-12">

            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Licenciandos por setores</h5>
                    <p class="card-category">Quantidade de licenciandos por sertor</p>
                </div>
                <div class="card-body ">
                    <div id="piechart" style="width: 1500px; height: 450px;"></div>
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