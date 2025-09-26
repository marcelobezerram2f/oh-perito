@extends('layouts.codebase.index-page')

@section('title') - Equipe
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
                <h3 class="block-title">Equipe</h3>
            </div>
            <div class="block-content pb-4">
                <a class="btn btn-alt-success mb-4" href="/equipe/create">
                    <i class="fa fa-plus"></i> Novo Calculista
                </a>

                <table id="focus" class="table table-bordered table-striped table-vcenter js-dataTable-full" width="100%">
                    <thead class="bg-earth-lighter">
                        <tr>
                            <td class="font-w600 text-center" width="5%"></td>
                            <td class="font-w600 text-center">Nome</td>
                            <td class="font-w600 text-center" width="20%">Telefone</td>
                            <td class="font-w600 text-center">Email</td>
                            <td class="font-w600 text-center" width="15%">Situação</td>
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
        url: '/equipe/getAll' + location.search,
        type: 'GET',
        dataSrc: '' // a API já retorna um array simples
    },
    columns: [
        {
            data: 'id',
            className: 'text-center',
            render: function (data) {
                return `<button class="btn btn-link text-center" type="button"
                            data-membro="${data}"
                            onClick="showMembro(${data})">
                            <i class="fa fa-folder-open-o"></i>
                        </button>`;
            }
        },
        { data: 'nome', render: nome => nome.toUpperCase() },
        {
            data: 'telefone',
            render: function (telefone) {
                return telefone ? telefone : "<span class='text-danger'> - </span>";
            }
        },
        { data: 'email', render: email => email.toUpperCase() },
        {
            data: 'ativo',
            className: 'text-center',
            render: function (ativo) {
                return ativo == 1
                    ? "<span class='badge bg-success text-white'>Ativo</span>"
                    : "<span class='badge bg-danger text-white'>Inativo</span>";
            }
        },
        {
            data: 'id',
            className: 'text-center',
            render: function (data, type, row) {
                return `<i class="fa fa-trash text-danger"
                            id="deleteMembroId"
                            onClick="deleteMembro(${data}, '${row.nome}')"
                            data-nomeMembro="${row.nome.toUpperCase()}"
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
    },
    destroy: true // garante que não vai dar erro de reinit
});


        function showMembro(id) {
            window.location.href = `/equipe/show/${id}`
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


    </script>
@endsection