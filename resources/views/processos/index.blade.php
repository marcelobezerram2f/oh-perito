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

                <form class="form-horizontal" id="form-search-all" autocomplete="off">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="col-sm-2">
                            <label class="control-label">Processo</label>
                            <input type="text" class="form-control" name="numero_processo" id="numero_processo"
                                data-mask="9999999-99.9999.9.99.9999" />
                        </div>

                        <div class="col-sm-2">
                            <label class="control-label">Reclamante/ Reclamado</label>
                            <input type="text" class="form-control" name="reclamante_reclamado" id="reclamante-reclamado">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label">Prazo</label>
                            <input type="date" class="form-control" name="prazo" id="prazo">
                        </div>

                        <div class="col-sm-2">
                            <label class="control-label">Técnico Calculista</label>
                            <select class="form-control" name="equipe_id" id="equipe_id"></select>
                        </div>
                        <div class="col-sm-3 d-flex gap-2">
                            <button class="btn btn-primary btn-outline ml-3" type="submit">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <button class="btn btn-success btn-outline ml-3" id="btn-search-all-reset" type="button">
                                <i class="fa fa-refresh"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>

                <table id="focus" class="table table-bordered table-striped table-vcenter js-dataTable-full" width="100%">
                    <thead class="bg-earth-lighter">
                        <tr>
                            <td class="font-w600 text-center" width="1%"></td>
                            <td class="font-w600 text-center" width="5%"></td>
                            <td class="font-w600 text-center" width="100px">Mês/Ano</td>
                            <td class="font-w600 text-center" width="80px">Pasta</td>
                            <td class="font-w600 text-center" width="250px">Processo</td>
                            <td class="font-w600 text-center" width="150px">Vara</td>
                            <td class="font-w600 text-center">Reclamante</td>
                            <td class="font-w600 text-center">Reclamada</td>
                            <td class="font-w600 text-center">Carga</td>
                            <td class="font-w600 text-center" width="150px">Prazo</td>
                            <td class="font-w600 text-center">Calculista</td>
                            <td class="font-w600 text-center">Status</td>
                            <td class="text-center no-sort" style="width: 10px"><i class="si si-settings"></i></td>
                        </tr>
                    </thead>
                    <tbody id="list-all"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('plugins/js/datatable/dataTables.min.js')}}"></script>
    <script src="{{ asset('plugins/js/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('plugins/js/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('plugins/js/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('js/plugins/masked-inputs/jquery.maskedinput.min.js')}}"></script>

    <script>
        $(document).ready(function () {


            // Máscara do campo processo
            $('[data-mask]').mask('9999999-99.9999.9.99.9999');


            // Carregar técnicos
            $.ajax({
                url: '/equipe/getAll',
                type: 'GET',
                success: function (response) {
                    var selectMembros = $('#equipe_id');
                    selectMembros.append('<option value="">Selecione...</option>');
                    response.forEach(function (membro) {
                        selectMembros.append(`<option value="${membro.id}">${membro.nome.toUpperCase()}</option>`);
                    });
                }
            });

            // DataTable
            var tabela = $('#focus').DataTable({
                ajax: {
                    url: '/processos/getAll',
                    type: 'GET',
                    data: function (d) {
                        d.numero_processo = $('#numero_processo').val();
                        d.prazo = $('#prazo').val();
                        d.equipe_id = $('#equipe_id').val();
                        d.reclamante_reclamado = $('#reclamante-reclamado').val();
                    },
                    dataSrc: ''
                },
                columns: [
                    { data: 'vencer', render: function () { return '' } },
                    {

                        data: 'id',
                        className: 'text-center',
                        render: function (data) {
                            return `<button class="btn btn-link text-center" type="button" onClick="showProcesso(${data})">
                                            <i class="fa fa-folder-open-o"></i>
                                        </button>`;
                        }
                    },
                    { data: 'mes_ano', render: data => formatarData(data) },
                    { data: 'pasta' },
                    { data: 'numero_processo' },
                    { data: 'vara' },
                    { data: 'reclamante' },
                    { data: 'reclamada' },
                    { data: 'carga', render: data => formatarData(data) },
                    { data: 'prazo', render: data => formatarData(data) },
                    {
                        data: 'equipe',
                        render: function (data, type, row) {
                            // verifica se o campo existe e não é vazio
                            if (!data || !data.nome || data.nome.trim() === '') {
                                return '-';
                            }
                            return data.nome;
                        }
                    },
                    {
                        data: 'status',
                        render: function (data) {
                            if (data === 'andamento')
                                return `<span class="badge bg-primary text-white">${data.toUpperCase()}</span>`;
                            if (data === 'entregue')
                                return `<span class="badge bg-success text-white">${data.toUpperCase()}</span>`;
                            if (data === 'suspenso')
                                return `<span class="badge bg-warning text-white">${data.toUpperCase()}</span>`;
                            if (data === 'cancelado')
                                return `<span class="badge bg-danger text-white">${data.toUpperCase()}</span>`;
                            if (data === 'assistência')
                                return `<span class="badge bg-info text-white">${data.toUpperCase()}</span>`;
                            return data;
                        }
                    },
                    {
                        data: 'id',
                        className: 'text-center',
                        render: function (data, type, row) {
                            return `<i class="fa fa-trash text-danger delete-processo"
                                            data-nomeprocesso="${row.reclamante}"
                                            data-idprocesso="${row.id}"
                                            title="Excluir"></i>`;
                        }
                    }
                ],
                responsive: true,
                pageLength: 10,
                lengthChange: true,
                searching: false,
                language: { url: "{{ asset('plugins/js/datatable/pt-BR.json') }}" },

                // 🔥 Aqui está a nova lógica
                createdRow: function (row, data) {
                    var vencer = parseInt(data.vencer);
                    // linha com prazo vencido e em andamento
                    var $primeiraColuna = $('td', row).eq(0);
                    if (vencer < 0 && data.status === 'andamento') {
                        $(row).css('background-color', '#FFEEBF');
                        $primeiraColuna.html(`
                                <i class="fa fa-circle text-danger"></i>
                                `);
                    }
                    else if (vencer > 0 && vencer < 6 && data.status === 'andamento') {
                        $primeiraColuna.html(`
                                <i class="fa fa-circle text-warning"></i>
                                `);
                    } else {
                        $primeiraColuna.html(`
                                <i class="fa fa-circle text-success"></i>
                                `);
                    }

                }

            });


            // Delegação de evento para exclusão
            $(document).on('click', '.delete-processo', function () {
                var processo_id = $(this).data('idprocesso');
                var reclamante = $(this).data('nomeprocesso');

                Swal.fire({
                    icon: "question",
                    title: "Alerta!",
                    text: `Deseja excluir o processo do reclamante ${reclamante}?`,
                    showDenyButton: true,
                    confirmButtonText: "Sim, excluir!",
                    denyButtonText: "Não",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/processo/delete/${processo_id}`,
                            type: 'GET',
                            success: function (response) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Sucesso!",
                                    text: "Processo excluído com sucesso."
                                });
                                tabela.ajax.reload(); // Atualiza a tabela
                            },
                            error: function () {
                                Swal.fire({
                                    icon: "error",
                                    title: "Erro!",
                                    text: "Não foi possível excluir o processo."
                                });
                            }
                        });
                    }
                });
            });


            // Filtro: desabilitar campos conforme regra
            $('#numero_processo').on('input', function () {
                if ($(this).val()) {
                    $('#prazo, #equipe_id, #reclamante-reclamado ').prop('disabled', true).val('');
                } else {
                    $('#prazo, #equipe_id, #reclamante-reclamado').prop('disabled', false);
                }
            });

            $('#prazo, #equipe_id, #reclamante-reclamado').on('change input', function () {
                if ($('#prazo').val() || $('#equipe_id').val()) {
                    $('#numero_processo').prop('disabled', true).val('');
                } else {
                    $('#numero_processo').prop('disabled', false);
                }
            });

            // Submit do filtro
            $('#form-search-all').on('submit', function (e) {
                e.preventDefault();
                tabela.ajax.reload();
            });

            // Reset filtro
            $('#btn-search-all-reset').on('click', function () {
                $('#form-search-all')[0].reset();
                $('#numero_processo, #prazo, #equipe_id', '#reclamante-reclamado').prop('disabled', false);
                tabela.ajax.reload();
            });
        });

        // Funções auxiliares
        function showProcesso(id) {
            window.location.href = `/processo/show/${id}`;
        }
        function formatarData(input) {
            if (!input) return "";
            const meses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
            if (/^\d{4}-\d{2}-\d{2}$/.test(input)) {
                const [ano, mes, dia] = input.split("-");
                return `${dia}/${mes}/${ano}`;
            }
            if (/^\d{4}-\d{2}$/.test(input)) {
                const [ano, mes] = input.split("-");
                return `${meses[parseInt(mes, 10) - 1]}/${ano}`;
            }
            return input;
        }
    </script>
@endsection