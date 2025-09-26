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
    <div class="content">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Pagamentos</h3>
            </div>
            <div class="block-content pb-4">
                <div class="row">
                    <!-- Tabela de pagamentos -->
                    <div class="col-6">
                        <label class="form-control-label d-block mb-1">Mês de pagamento:</label>
                        <div class="input-group mb-2">
                            <input type="month" class="form-control" name="mes_ano" id="mes-ano">
                            <button type="submit" class="btn btn-alt-success ml-2" id="busca-pagamentos">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                        </div>

                        <table id="focus" class="table table-bordered table-striped table-vcenter js-dataTable-full"
                            width="100%">
                            <thead class="bg-earth-lighter">
                                <tr>
                                    <td class="font-w600 text-center" width="5%"></td>
                                    <td class="font-w600 text-center">Calculista</td>
                                    <td class="font-w600 text-center">Valor Pago</td>
                                </tr>
                            </thead>
                            <tbody id="pagamentos"></tbody>
                        </table>
                    </div>
<!-- Divisor -->
<div class="col-lg-1 d-flex justify-content-center">
                <div style="border-left: 2px solid #ccc; height: 100%;"></div>
            </div>
                    <!-- Tabela de processos -->
                    <div class="col-5 mt-5" >
                    <p class="p-10 bg-primary-darker font-w600" style="color:#fff">Processos Relacionados</p>
                        <table id="processos" class="table table-hover table-vcenter"
                            width="100%">
                            <thead class="bg-earth-lighter">
                                <tr>
                                    <td class="font-w600 text-center"></td>
                                    <td class="font-w600 text-center">Número do Processo</td>
                                    <td class="font-w600 text-center">Reclamante</td>
                                    <td class="font-w600 text-center">Honorário</td>
                                    <td class="font-w600 text-center">Cáculo Conf. Erro</td>

                                </tr>
                            </thead>
                            <tbody id="processos-body"></tbody>
                        </table>
                    </div>
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
    <script>
        $(document).ready(function () {
            // Inicializa DataTable de pagamentos
            var tablePagamentos = $('#focus').DataTable({
                ajax: {
                    url: `/pagamentos/getMonth`,
                    method: 'GET',
                    dataSrc: function (json) {
                        if (json.length > 0 && json[0].mes) {
                            let [year, month] = json[0].mes.split('-');
                            let meses = ["janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"];
                            $('#focus caption').remove();
                            $('#focus').prepend(`<caption style="caption-side: top; text-align: center; font-weight: bold; font-size: 1.2em;">${meses[parseInt(month) - 1]} ${year}</caption>`);
                        }
                        return json;
                    }
                },
                columns: [
                    {
                        data: 'processos_ids',
                        className: 'text-center',
                        render: function (data) {
                            return `<button class="btn btn-link btn-processos" type="button" data-process='${JSON.stringify(data)}'>
                                    <i class="fa fa-folder-open-o"></i>
                                </button>`;
                        }
                    },
                    { data: 'nome' },
                    {
                        data: 'valor',
                        render: function (valor) {
                            return valor ? `R$ ${parseFloat(valor).toFixed(2)}` : '-';
                        }
                    }
                ],
                responsive: true,
                pageLength: 10,
                lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "Todos"]],
                language: {
                    url: "{{ asset('plugins/js/datatable/pt-BR.json') }}"
                }
            });

            // Busca pagamentos
            $('#busca-pagamentos').on('click', function () {
                let mesAno = $('#mes-ano').val();
                let url = mesAno ? `/pagamentos/getMonth/${mesAno}` : `/pagamentos/getMonth`;
                tablePagamentos.ajax.url(url).load();
            });


            // Evento clique no botão de processos
            $('#focus').on('click', '.btn-processos', function () {
                let processosIds = $(this).data('process'); // array
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: '/processos/inIds',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ ids: processosIds }),
                    success: function (response) {
                        var processoTable=''
                        response.forEach(function(processo) {
                            console.log(processo)
                            processoTable = `
                            <tr>
                                <td><button class="btn btn-link btn-processos" type="button" onclick="showProcesso(${processo.id})">
                                    <i class="fa fa-folder-open-o"></i>
                                </button></td>
                                <td>${processo.numero_processo}</td>
                                <td>${processo.reclamante}</td>
                                <td class="text-right">${processo.honorario}</td>
                                <td class="text-right">${processo.calculo_conforme_erro}</td>

                            </tr>
                           `
                           console.log(processoTable)
                            $('#processos-body').append(processoTable)
                        })
                    },
                    error: function () {
                        Swal.fire('Erro', 'Não foi possível carregar os processos.', 'error');
                    }
                });
            });
        });

        function showProcesso(id) {
            window.location.href = `/processo/show/${id}`
        }
    </script>
@endsection