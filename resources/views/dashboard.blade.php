@extends('layouts.codebase.index-page')

@section('title') - Processos
@endsection

@section('css_after')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/datatable/datatable.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/css/datatable/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/css/datatable/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/css/datatable/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/css/sweetalert2/sweetalert2.min.css') }}" />
@endsection

@section('content')

    <div class="row">
        <!-- Gráfico de barras -->
        <div class="col-xl-7 ml-2 d-flex">
            <div class="block flex-fill mt-3">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Quantitativo de erro por mês</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle"
                            data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <canvas class="js-chartjs-bars"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabela lateral -->
        <div class="col-xl-4 d-flex">
            <div class="block flex-fill mt-3">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Processos com prazo a vencer</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>próximos 5 dias</code>
                        </div>
                    </div>
                </div>
                <div class="block-content h-100 d-flex flex-column">
                    <table id="focus" class="table table-bordered table-striped table-vcenter js-dataTable-full"
                        style="width:100%">
                        <thead class="bg-earth-lighter">
                            <tr>
                                <th class="font-w600 text-center" width="40%">Processo</th>
                                <th class="font-w600 text-center" width="25%">Calculista</th>
                                <th class="font-w600 text-center" width="25%">Prazo</th>
                                <th class="font-w600 text-center" width="10%">Dias a Vencer</th>
                            </tr>
                        </thead>
                        <tbody id="list-due">

                        </tbody>
                    </table>
                    <!-- espaço extra para ocupar a altura do gráfico -->
                    <div class="flex-grow-1"></div>
                </div>
            </div>
        </div>

        <!-- Bloco inferior alinhado -->
        <div class="col-xl-11 ml-2">
            <div class="block mt-3">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Erros Geral por Responsável %</h3>
                    <div class="block-options">
                        <button type="button" class="js-pie-randomize btn-block-option" data-toggle="tooltip"
                            title="Randomize">
                            <i class="fa fa-random"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row items-push-2x text-center invisible" data-toggle="appear" id="pie"></div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js_after')

    <script src="{{ asset('plugins/js/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/js/datatable/dataTables.min.js')}}"></script>
    <script src="{{ asset('plugins/js/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('plugins/js/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('plugins/js/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/flot/jquery.flot.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/flot/jquery.flot.pie.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/flot/jquery.flot.stack.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/flot/jquery.flot.resize.min.js')}}"></script>

    <!-- Page JS Code -->

    <!-- Page JS Helpers (Easy Pie Chart Plugin)-->
    <script>jQuery(function () { Codebase.helpers('easy-pie-chart'); });</script>


    <script>

        // Função para inicializar gráficos Easy Pie Chart
        function initEasyPieCharts(selector = ".pie-chart") {
            jQuery(selector).each(function () {
                var $el = jQuery(this);
                if (!$el.data("easyPieChart")) {
                    $el.easyPieChart({
                        scaleColor: false,
                        trackColor: "#e9e9e9",
                        lineWidth: $el.data("line-width") || 5,
                        size: $el.data("size") || 100,
                        animate: 1000,
                        barColor: $el.data("bar-color") || "#42a5f5"
                    });
                }
            });
        }

        // Função que randomiza os valores dos gráficos Easy Pie Chart
        function initRandomEasyPieChart() {
            jQuery(".js-pie-randomize").on("click", function (event) {
                jQuery(event.currentTarget)
                    .parents(".block")
                    .find(".pie-chart")
                    .each(function (index, element) {
                        jQuery(element).data("easyPieChart").update(Math.floor(Math.random() * 100 + 1));
                    });
            });
        }

        jQuery(document).ready(function () {
            initRandomEasyPieChart();

            // AJAX para buscar dados
            $.ajax({
                url: '/equipe/report' + location.search,
                type: 'GET',
                success: function (response) {
                    var $pieContainer = $('#pie');
                    $pieContainer.empty();

                    response.dados.forEach(function (dado) {
                        var pieChart = `
                                                    <div class="col-6 col-md-4">
                                                        <div class="js-pie-chart pie-chart" data-percent="${dado.percert_erros}" data-line-width="2" data-size="100"
                                                                    data-bar-color="#ef5350" data-track-color="#e9e9e9" data-scale-color="#d9d9d9">
                                                            <span>${dado.nome}<br><small class="text-muted">${dado.percert_erros}%</small></span>
                                                        </div>
                                                    </div>`
                        $pieContainer.append(pieChart);
                    });

                    // Inicializa os Easy Pie Charts depois de adicionados ao DOM
                    initEasyPieCharts();

                    // Chart.js
                    var nomes = response.dados.map(d => d.nome);
                    var qtd_erro = response.dados.map(d => d.qtd_erros);
                    var qtd_processos = response.dados.map(d => d.qtd_processos);

                    initChartsChartJS(response.periodo, nomes, qtd_erro, qtd_processos);
                },
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'OPS!',
                        text: `${error.message}`
                    });
                }
            });


            // Inicialização dos gráficos Chart.js
            function initChartsChartJS(periodo, nomes, qtd_erro, qtd_processos) {
                // Configurações globais
                Chart.defaults.global.defaultFontColor = "#555555";
                Chart.defaults.scale.gridLines.color = "rgba(0,0,0,.04)";
                Chart.defaults.scale.gridLines.zeroLineColor = "rgba(0,0,0,.1)";
                Chart.defaults.scale.ticks.beginAtZero = true;

                Chart.defaults.global.elements.line.borderWidth = 2;
                Chart.defaults.global.elements.point.radius = 5;
                Chart.defaults.global.elements.point.hoverRadius = 7;

                Chart.defaults.global.tooltips.cornerRadius = 3;
                Chart.defaults.global.legend.labels.boxWidth = 12;

                // Seletores dos gráficostio
                var chartLines = jQuery(".js-chartjs-lines");
                var chartBars = jQuery(".js-chartjs-bars");
                var chartRadar = jQuery(".js-chartjs-radar");
                var chartPolar = jQuery(".js-chartjs-polar");
                var chartPie = jQuery(".js-chartjs-pie");
                var chartDonut = jQuery(".js-chartjs-donut");

                // Dados para Line, Bar, Radar

                var dataLines = {
                    labels: nomes,
                    datasets: [
                        {
                            label: "Quantidade de Erros",
                            fill: true,
                            backgroundColor: "rgba(66,165,245,.75)",
                            borderColor: "rgba(66,165,245,1)",
                            pointBackgroundColor: "rgba(66,165,245,1)",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(66,165,245,1)",
                            data: qtd_erro
                        },
                        {
                            label: "Quantidade de Processos",
                            fill: true,
                            backgroundColor: "rgba(66,165,245,.25)",
                            borderColor: "rgba(66,165,245,1)",
                            pointBackgroundColor: "rgba(66,165,245,1)",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(66,165,245,1)",
                            data: qtd_processos
                        }

                    ]
                };

                // Dados para Pie / Donut / Polar
                var dataPie = {
                    labels: ["Earnings", "Sales", "Tickets"],
                    datasets: [
                        {
                            data: [50, 30, 25],
                            backgroundColor: [
                                "rgba(156,204,101,1)",  // verde
                                "rgba(255,202,40,1)",   // amarelo
                                "rgba(239,83,80,1)"     // vermelho
                            ],
                            hoverBackgroundColor: [
                                "rgba(156,204,101,.5)",
                                "rgba(255,202,40,.5)",
                                "rgba(239,83,80,.5)"
                            ]
                        }
                    ]
                };

                // Inicializando os gráficos se existirem no DOM
                if (chartLines.length) {
                    new Chart(chartLines, { type: "line", data: dataLines });
                }
                if (chartBars.length) {
                    new Chart(chartBars, { type: "bar", data: dataLines });
                }
                if (chartRadar.length) {
                    new Chart(chartRadar, { type: "radar", data: dataLines });
                }
                if (chartPolar.length) {
                    new Chart(chartPolar, { type: "polarArea", data: dataPie });
                }
                if (chartPie.length) {
                    new Chart(chartPie, { type: "pie", data: dataPie });
                }
                if (chartDonut.length) {
                    new Chart(chartDonut, { type: "doughnut", data: dataPie });
                }
            }

            // Executa quando o DOM estiver pronto
            jQuery(function () {
                initChartsChartJS();
            });



        })
        $('#focus').DataTable({
    responsive: true,
    pageLength: 5,
    lengthChange: false,
    searching: false,
    destroy: true, // garante reinicialização limpa
    ajax: {
        url: '/processo/getByDue' + location.search,
        dataSrc: '' // porque o retorno já é um array
    },
    columns: [
        {
            data: 'id',
            render: function (data, type, row) {
                return `<a href="/processo/show/${row.id}" class="btn btn-link">${row.numero_processo}</a>`;
            }
        },
        { data: 'calculista' },
        { data: 'prazo' },
        {
            data: 'dias',
            render: function (dias) {
                if (dias == 5) return `<span class="btn btn-alt-primary mr-5 mb-5">${dias} dias</span>`;
                if (dias == 4) return `<span class="btn btn-alt-info mr-5 mb-5">${dias} dias</span>`;
                if (dias == 3) return `<span class="btn btn-alt-warning mr-5 mb-5">${dias} dias</span>`;
                if (dias == 2) return `<span class="btn btn-alt-danger mr-5 mb-5">${dias} dias</span>`;
                if (dias == 1) return `<span class="btn btn-alt-secondary mr-5 mb-5">${dias} dias</span>`;
                if (dias == 0) return `<span class="btn btn-danger mr-5 mb-5">Hoje</span>`;
            }
        }
    ],
    language: {
        url: "{{ asset('plugins/js/datatable/pt-BR.json') }}"
    }
});



    </script>
@endsection