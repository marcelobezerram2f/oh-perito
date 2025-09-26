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
                <h3 class="block-title">Processos</h3>
            </div>
            <div class="block-content pb-4">
                <a class="btn btn-alt-success mb-4" href="/processo/create">
                    <i class="fa fa-plus"></i> Novo Processo
                </a>

                <table id="focus" class="table table-bordered table-striped table-vcenter js-dataTable-full" width="100%">
                    <thead class="bg-earth-lighter">
                        <tr>
                            <td class="font-w600 text-center" width="5%"></td>
                            <td class="font-w600 text-center">Mês/Ano</td>
                            <td class="font-w600 text-center">Pasta</td>
                            <td class="font-w600 text-center">Processo</td>
                            <td class="font-w600 text-center">Reclamante</td>
                            <td class="font-w600 text-center">Reclamada</td>
                            <td class="font-w600 text-center">Carga</td>
                            <td class="font-w600 text-center">Prazo</td>
                            <td class="font-w600 text-center">Calculista</td>
                            <td class="font-w600 text-center">Status</td>
                            <td class="text-center no-sort" style="width: 10px"><i class="si si-settings"></i></td>
                        </tr>
                    </thead>
                    <tbody id="list-all">
                    </tbody>
                </table>

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
       $('#focus').DataTable({
    ajax: {
        url: '/processos/getAll' + location.search,
        type: 'GET',
        dataSrc: '' // porque a resposta já vem como array
    },
    columns: [
        {
            data: 'id',
            className: 'text-center',
            render: function (data, type, row) {
                return `<button class="btn btn-link text-center" type="button"
                            data-membro="${data}"
                            onClick="showProcesso(${data})">
                            <i class="fa fa-folder-open-o"></i>
                        </button>`;
            }
        },
        { data: 'mes_ano', render: data => formatarData(data) },
        { data: 'pasta' },
        { data: 'numero_processo' },
        { data: 'reclamante' },
        { data: 'reclamada' },
        { data: 'carga', render: data => formatarData(data) },
        { data: 'prazo', render: data => formatarData(data) },
        { data: 'equipe.nome' },
        {
            data: 'status',
            render: function (data) {
                if (data === 'andamento') {
                    return `<span class="badge bg-badge bg-primary" style="color:#fff">${data.toUpperCase()}</span>`;
                }
                if (data === 'entregue') {
                    return `<span class="badge bg-badge bg-success" style="color:#fff">${data.toUpperCase()}</span>`;
                }
                return data;
            }
        },
        {
            data: 'id',
            className: 'text-center',
            render: function (data, type, row) {
                return `<i class="fa fa-trash text-danger"
                            onClick="deleteprocesso(${data}, '${row.nome}')"
                            data-nomeprocesso="${row.numero_processo}"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Excluir">
                        </i>`;
            }
        }
    ],
    responsive: true,
    pageLength: 10,
    lengthChange: true,
    searching: true,
    language: {
        url: "{{ asset('plugins/js/datatable/pt-BR.json') }}"
    }
});

        function showProcesso(id) {
            window.location.href = `/processo/show/${id}`
        }


        function deleteMembro(membroId, nomeMembro) {

            Swal.fire({
                title: 'CUIDADO!',
                showCancelButton: true,
                confirmButtonText: 'Sim, pode excluir!',
                cancelButtonText: 'Não, cancelar',
                text: `Deseja apagar o membro ${nomeMembro}`,
                type: 'warning',
                confirmButtonColor: '#F54400',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    Swal.fire({
                        title: 'Aguarde!',
                        html: `Excluindo processo ${nomeMembro}`,// add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    }),
                        $.ajax({
                            url: `/equipe/delete/${membroId}`,
                            method: 'GET',
                            success: function () {
                                Swal.fire(
                                    'Sucesso!',
                                    `Membro excluido com sucesso!.`,
                                    'success').then(function () {
                                        location.href = '/equipe'
                                    })
                            },
                            error: function () {
                                Swal.fire(
                                    'Falhou!',
                                    `Problemas ao remover o membro!. Contate o Administrador do Sistema.`,
                                    'error'
                                ).then(function () {
                                    location.href = '/equipe' + location.search
                                })
                            }
                        })
                }
            })
        }

        function formatarData(input) {
            // Meses em português
            const meses = [
                "Jan", "Fev", "Mar", "Abr", "Mai", "Jun",
                "Jul", "Ago", "Set", "Out", "Nov", "Dez"
            ];

            if (!input) return "";

            // Caso tenha dia (YYYY-MM-DD)
            if (/^\d{4}-\d{2}-\d{2}$/.test(input)) {
                const [ano, mes, dia] = input.split("-");
                return `${dia}/${mes}/${ano}`;
            }

            // Caso seja apenas mês/ano (YYYY-MM)
            if (/^\d{4}-\d{2}$/.test(input)) {
                const [ano, mes] = input.split("-");
                const nomeMes = meses[parseInt(mes, 10) - 1];
                return `${nomeMes}/${ano}`;
            }

            return input; // se não bater em nenhum formato
        }


    </script>
@endsection