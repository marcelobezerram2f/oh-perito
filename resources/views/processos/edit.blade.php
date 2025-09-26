@extends('layouts.codebase.index-page')

@section('title') - Processos
@endsection
@section('css_after')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/sweetalert2/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/flatpickr/flatpickr.min.css')}}">
@endsection

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Processos (Edição)</h3>
            </div>

            <div class="block-content pb-6">
                <form class="form-horizontal" id="form-processo" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="form-group row pl-4 pr-4">
                        <!-- Coluna Esquerda -->
                        <div class="col-lg-6 mt-2">
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <input type="hidden" id="id" name="id">
                                    <label class="form-control-label">Número Processos:</label>
                                    <input type="text" class="form-control" name="numero_processo"
                                        data-mask="9999999-99.9999.9.99.9999" required id="numero-processo" />
                                </div>

                                <div class="col-lg-2 mt-2">
                                    <label class="form-control-label">Vara:</label>
                                    <input type="text" class="form-control" name="vara" id="vara" />
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Mês/Ano:</label>
                                    <input type="month" class="form-control" name="mes_ano" id="mes-ano">
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Reclamante:</label>
                                    <input type="text" class="form-control" name="reclamante" id="reclamante" />
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Documento Reclamante:</label>
                                    <input type="text" class="form-control" name="doc_reclamante" id="doc-reclamante"
                                        data-mask="999.999.999-99" />
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Reclamado:</label>
                                    <input type="text" class="form-control" name="reclamada" id="reclamada" />
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Documento Reclamado:</label>
                                    <input type="text" class="form-control" name="doc_reclamada" id="doc-reclamada"
                                        data-mask="99.999.999/9999-99" />
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Carga:</label>
                                    <input type="date" class="form-control" name="carga" id="carga" />
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Prazo:</label>
                                    <input type="date" class="form-control" name="prazo" id="prazo" />
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Entrega Laudo Judicial:</label>
                                    <input type="date" class="form-control" name="laudo_judicial" id="laudo-judicial" />
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Calculista:</label>
                                    <select class="form-control" name="equipe_id" id="equipe"></select>
                                </div>

                                <div class="col-lg-3 mt-2">
                                    <label class="form-control-label">Honorário:</label>
                                    <input type="text" id="honorario" class="form-control" name='honorario' placeholder="0,00"
                                        oninput="mascaraMoeda(this)">
                                </div>

                                <div class="col-lg-3 mt-2">
                                    <label class="form-control-label">Calculo Erro:</label>
                                    <input type="text" id="calculo-conforme-erro" name="calculo_conforme_erro" class="form-control" placeholder="0,00"
                                        readonly>
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Pago:</label>
                                    <select class="form-control" name="liquidado" id="liquidado">
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="">Selecione...</option>
                                        <option value="andamento">Andamento</option>
                                        <option value="entregue">Entregue</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 mt-2">
                                    <label class="form-control-label">Observações:</label>
                                    <textarea class="form-control" name="observacoes" id="observacoes"></textarea>

                                </div>
                                <div class="col-lg-12 mt-2" id="inputs-hidden">


                                </div>

                            </div>
                            <div class="form-group row pl-4 pb-4 mt-4">
                                <div class="col">
                                    <button type="button" class="btn btn-alt-warning" onclick="location.href='/processos'">
                                        <i class="fa fa-chevron-left"></i> Voltar
                                    </button>
                                    <button type="reset" class="btn btn-alt-info">
                                        <i class="fa fa-broom"></i> Limpar
                                    </button>
                                    <button type="submit" class="btn btn-alt-success">
                                        <i class="fa fa-check"></i> Gravar
                                    </button>
                                </div>
                            </div>
                </form>
            </div>

            <!-- Divisor -->
            <div class="col-lg-1 d-flex justify-content-center">
                <div style="border-left: 2px solid #ccc; height: 100%;"></div>
            </div>

            <!-- Coluna Direita -->
            <div class="col-lg-5 mt-2">
                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#btabs-alt-static-control">Controle</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-alt-static-esclarecimento">Esclarecimentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-alt-static-pagamento">Pagamentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-alt-static-fail">Erros de Execução</a>
                        </li>
                    </ul>

                    <div class="block-content tab-content">
                        <!-- Controle -->
                        <div class="tab-pane active" id="btabs-alt-static-control" role="tabpanel">
                            <table class="table table-bordered table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="4" style="background-color:#E6E6FA;">
                                            Esclarecimentos</th>
                                    </tr>
                                    <tr>
                                        <th style="width:30%;">Carga</th>
                                        <th class="text-center" style="width:30%;">Entrega Judicial</th>
                                        <th style="width:40%;">Advogado</th>
                                    </tr>
                                </thead>
                                <tbody id="control-esclarecimentos"></tbody>
                            </table>
                            <table class="table table-bordered table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="4" style="background-color:#E6E6FA; ">
                                            Pagamentos</th>
                                    </tr>
                                    <tr>
                                        <th style="width:20%;">Valor R$</th>
                                        <th class="text-center" style="width:20%;">Data</th>
                                        <th style="width:60%;">Observação</th>
                                    </tr>
                                </thead>
                                <tbody id="control-pagamentos"></tbody>
                            </table>
                            <table class="table table-bordered table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="4" style="background-color:#E6E6FA;">
                                            Erros de Execução</th>
                                    </tr>
                                    <tr>
                                        <th style="width:25%;">Tipo</th>
                                        <th class="text-center" style="width:25%;">Data</th>
                                        <th style="width:25%;">Custo de Apoio</th>
                                        <th style="width:25%;">valor do Apoio</th>
                                    </tr>
                                </thead>
                                <tbody id="control-erro"></tbody>
                            </table>

                        </div>

                        <!-- Esclarecimentos -->
                        <div class="tab-pane " id="btabs-alt-static-esclarecimento" role="tabpanel">
                            <p class="p-10 bg-info text-white">Esclarecimento</p>
                            <form id="form-esclareciemntos">
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Carga:</label>
                                        <input type="date" class="form-control" id="carga-esclarecimento" />
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Entrega Judicial:</label>
                                        <input type="date" class="form-control" id="entrega-judicial-esclarecimento" />
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label class="form-control-label">Advogado:</label>
                                        <input type="text" class="form-control" id="advogado" />
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <button type="submit" class="btn btn-alt-success" id="salvar-esclarecimento">
                                            <i class="fa fa-check"></i> Incluir
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Pagamentos -->
                        <div class="tab-pane" id="btabs-alt-static-pagamento" role="tabpanel">
                            <p class="p-10 bg-info text-white">Pagamento</p>
                            <form id="form-pagamentos">

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Valor:</label>
                                        <input type="text" class="form-control" id="valor-pagamento"
                                            oninput="mascaraMoeda(this)" />
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Data de Pagamento:</label>
                                        <input type="date" class="form-control" id="data-pagamento" />
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label class="form-control-label">Observações:</label>
                                        <textarea class="form-control" id="observacao-pagamento"></textarea>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <button type="submit" class="btn btn-alt-success" id="salvar-pagamento">
                                            <i class="fa fa-check"></i> Incluir
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Erros de Execução -->
                        <div class="tab-pane" id="btabs-alt-static-fail" role="tabpanel">
                            <p class="p-10 bg-info text-white">Erros de Execução</p>
                            <form id="form-erros">
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Tipo Erro:</label>
                                        <input type="text" class="form-control" id="tipo-erro" />
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Data:</label>
                                        <input type="date" class="form-control" id="data-erro" />
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Gerou Custo de Apoio:</label>
                                        <select class="form-control" id="custo-apoio">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label class="form-control-label">Observação:</label>
                                        <input type="text" class="form-control" id="observacao-erro" />
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <button type="submit" class="btn btn-alt-success" id="salvar-erro">
                                            <i class="fa fa-check"></i> Incluir
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Tabelas dinâmicas -->
        <div class="col-lg-12 mt-2" id="esclarecimentos-table" style="display:none">
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" colspan="5" style="background-color:#FFA500; color:#fff;">Esclarecimentos
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center" style="width:50px;">#</th>
                        <th class="text-center" style="width:10%;">Carga</th>
                        <th class="text-center" style="width:15%;">Entrega Judicial</th>
                        <th class="text-center" style="width:180px;">Advogado</th>
                        <th class="text-center" style="width:100px;">Ações</th>
                    </tr>
                </thead>
                <tbody id="body-esclarecimentos"></tbody>
            </table>
        </div>

        <div class="col-lg-12 mt-2" id="pagamentos-table" style="display:none">
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" colspan="5" style="background-color:#3CB371; color:#fff;">Pagamentos</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="width:50px;">#</th>
                        <th style="width:10%;">Valor R$</th>
                        <th class="text-center" style="width:15%;">Data</th>
                        <th style="width:180px;">Observação</th>
                        <th class="text-center" style="width:100px;">Ações</th>
                    </tr>
                </thead>
                <tbody id="body-pagamentos"></tbody>
            </table>
        </div>

        <div class="col-lg-12 mt-2" id="erros-table" style="display:none">
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" colspan="6" style="background-color:#B22222; color:#fff;">Erros de Execução
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center" style="width:50px;">#</th>
                        <th style="width:10%;">Tipo</th>
                        <th class="text-center" style="width:15%;">Data</th>
                        <th class="text-center" style="width:50px;">Custo Apoio</th>
                        <th style="width:100px;">Observação</th>
                        <th class="text-center" style="width:100px;">Ações</th>
                    </tr>
                </thead>
                <tbody id="body-error"></tbody>
            </table>
        </div>

        <hr>

        <!-- Botões -->

    </div>
    </div>
    </div>

@endsection
@section('js_after')
    <!--form validation Custom js-->
    <script src="{{asset('assets/js/codebase.app.min.js')}}"></script>
    <script src="{{asset('assets/js/codebase.core.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/plugins/masked-inputs/jquery.maskedinput.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script>

        $(document).ready(function () {

            var esc = 0;
            var pag = 0;
            var err = 0;

            $("#salvar-esclarecimento").on("click", function (e) {
                e.preventDefault();
                esc++;
                var escInputs = ''
                var escTable = ''

                if ($('#carga-esclarecimento').val() != '') {
                    $('#esclarecimentos-table').show();
                    escTable = `
                                                                    <tr id="esclarecimento_${esc}">
                                                                        <th class="text-center" scope="row">${esc}</th>
                                                                        <td class="text-center">${dateFormat($('#carga-esclarecimento').val())}</td>
                                                                        <td class="text-center">${dateFormat($('#entrega-judicial-esclarecimento').val())}</td>
                                                                        <td class="text-center">${$('#advogado').val()}</td>
                                                                        <td class="text-center">
                                                                            <div class="btn-group">
                                                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                                                    title="Delete" onclick="removerEsclarecimento(${esc})">
                                                                                    <i class="fa fa-trash text-danger"></i>
                                                                                </button>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                `;
                    escInputs = `
                                                                        <div id="input-esclarecimentos_${esc}">
                                                                        <input type="hidden" name="carga_esclarecimento_${esc}" value="${$('#carga-esclarecimento').val()}">
                                                                        <input type="hidden" name="entrega_judicial_esclarecimento_${esc}" value="${$('#entrega-judicial-esclarecimento').val()}">
                                                                        <input type="hidden" name="advogado_${esc}" value="${$('#advogado').val()}">
                                                                        </div>`


                    $('#body-esclarecimentos').append(escTable)
                    $('#inputs-hidden').append(escInputs)
                    $("#form-esclareciemntos")[0].reset();
                }
            });

            window.removerEsclarecimento = function (id) {
                $('#esclarecimento_' + id).remove();
                $('#input-esclarecimentos_' + id).remove();
                esc--
                if (esc == 0) {
                    $('#esclarecimentos-table').hide();
                }
            };


            $("#salvar-pagamento").on('click', function (p) {
                p.preventDefault();
                var pagTable = ''
                var pagInputs = ''

                if ($('#valor-pagamento').val() != "") {
                    let pagamento = parseFloat(parseValorBR($('#valor-pagamento').val()))
                    let valorPago = parseFloat(localStorage.getItem("valor_pago"))
                    let acumulado = pagamento + valorPago
                    let honorario = parseFloat(localStorage.getItem("honorario"))
                    console.log(pagamento, valorPago, acumulado, honorario)
                    if (acumulado > honorario) {
                        Swal.fire({
                            icon: "error",
                            title: 'OPS!',
                            customClass: {
                                confirmButton: "btn btn-danger"
                            },
                            text: 'Valor de pagamento excede ao valor do honorário!'.toUpperCase(),
                            confirmButtonText: "OK"
                        })
                        return; // <-- interrompe a função aqui
                    } else if (acumulado == honorario) {
                        $('#liquidado').val(1)
                        $('#liquidado').trigger('change')
                    }


                    $('#pagamentos-table').show();
                    pag++;
                    pagTable = `
                                                                    <tr id="pagamento_${pag}">
                                                                        <td class="text-center" scope="row">${pag}</td>
                                                                        <td class="text-right">${$('#valor-pagamento').val()}</td>
                                                                        <td class="text-center">${dateFormat($('#data-pagamento').val())}</td>
                                                                        <td >${$('#observacao-pagamento').val()}</td>
                                                                        <td class="text-center">
                                                                            <div class="btn-group">
                                                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                                                    title="Delete" onclick="removerPagamento(${pag})">
                                                                                    <i class="fa fa-trash text-danger"></i>
                                                                                </button>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                `;
                    pagInputs = `<div id="input-pagamentos_${pag}">
                                                                <input type="hidden" name="valor_pagamento_${pag}" value="${$('#valor-pagamento').val()}">
                                                                <input type="hidden" name="data_pagamento_${pag}" value="${$('#data-pagamento').val()}">
                                                                <input type="hidden" name="observacao_pagamento_${pag}" value="${$('#observacao-pagamento').val()}">
                                                                </div>`
                    $('#body-pagamentos').append(pagTable);
                    $('#inputs-hidden').append(pagInputs)
                    $("#form-pagamentos")[0].reset();
                }
            });

            window.removerPagamento = function (id) {
                $('#pagamento_' + id).remove();
                $('#input-pagamentos_' + id).remove();
                pag--
                if (pag == 0) {
                    $('#pagamentos-table').hide();
                }
            };


            $("#salvar-erro").on('click', function (r) {
                r.preventDefault();
                var errTable = ''
                var errInputs = ''
                if ($('#data-erro').val() != "") {
                    $('#erros-table').show();
                    err++;

                    errTable = `
                                                                    <tr id="erro_${err}">
                                                                        <td class="text-center" scope="row">${err}</td>
                                                                        <td class="text-center">${$('#tipo-erro').val()}</td>
                                                                        <td class="text-center">${dateFormat($('#data-erro').val())}</td>
                                                                        <td class="d-none d-sm-table-cell text-center">
                                                                            <span class="${$('#erro-apoio').val() == 0 ? 'badge badge-success' : 'badge badge-danger'}">
                                                                                ${$('#erro-apoio').val() == 0 ? "Não" : "Sim"}
                                                                            </span>
                                                                        </td>
                                                                        <td class="d-none d-sm-table-cell">${$('#observacao-erro').val()}</td>
                                                                        <td class="text-center">
                                                                            <div class="btn-group">
                                                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                                                    title="Delete" onclick="removerErro(${err})">
                                                                                    <i class="fa fa-trash text-danger"></i>
                                                                                </button>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                `;
                    errInputs = `
                                                    <div id='input-erros_${err}}'>
                                                        <input type="hidden" name="tipo_erro_${err}" value="${$('#tipo-erro').val()}">
                                                        <input type="hidden" name="data_erro_${err}" value="${$('#data-erro').val()}">
                                                        <input type="hidden" name="custo_apoio_${err}" value="${$('#custo-apoio').val()}">
                                                        <input type="hidden" name="observacao_erro_${err}" value="${$('#observacao-erro').val()}">
                                                    </div>
                                                    `
                    $('#body-error').append(errTable);
                    $('#inputs-hidden').append(errInputs)
                    $("#form-erros")[0].reset();
                }
            });

            window.removerErro = function (id) {
                $('#erro_' + id).remove();
                $('#input-erros_' + id).remove();
                pag--
                if (pag == 0) {
                    $('#pagamentos-table').hide();
                }
            };


            // Pega a URL atual
            var url = window.location.href
            // Divide a URL pelos '/' e pega o último elemento
            var parse = url.split('/')
            var id = parse.pop() || parse.pop() // Remove elementos vazios no final, se houver
            $.ajax({
                url: `/processo/getById/${id}` + location.search,
                type: 'GET',
                success: function (response) {
                    var ctrlEsc = ''
                    var ctrlPag = ''
                    var ctrlErr = ''

                    response.forEach(function (processo) {
                        $("#id").val(processo.id)
                        $("#numero-processo").val(processo.numero_processo)
                        $("#vara").val(processo.vara)
                        $("#mes-ano").val(processo.mes_ano)
                        $("#reclamante").val(processo.reclamante)
                        $("#doc-reclamante").val(processo.doc_reclamante)
                        $("#reclamada").val(processo.reclamada)
                        $("#doc-reclamada").val(processo.doc_reclamada)
                        $("#carga").val(processo.carga)
                        $("#prazo").val(processo.prazo)
                        $("#status").val(processo.status)
                        $('#liquidado').trigger('change')
                        $("#laudo-judicial").val(processo.laudo_judicial)
                        $("#observacoes").val(processo.observacoes)
                        $("#honorario").val(processo.honorario.replaceAll('.',','))
                        $("#calculo-conforme-erro").val(processo.calculo_conforme_erro)
                        $("#liquidado").val(processo.liquidado)
                        $('#liquidado').trigger('change')
                        localStorage.setItem("honorario", processo.honorario);
                        getEquipe(processo.equipe_id)
                        if (processo && processo.esclarecimentos && processo.esclarecimentos.length > 0) {
                            processo.esclarecimentos.forEach(function (esclarecimento) {
                                ctrlEsc = `
                                            <tr>
                                                <td class="text-center">${dateFormat(esclarecimento.carga)}</td>
                                                <td class="text-center">${dateFormat(esclarecimento.entrega_judicial)}</td>
                                                <td class="text-center">${esclarecimento.advogado}</td>
                                            </tr>`;
                                $('#control-esclarecimentos').append(ctrlEsc);
                            });
                        } else {
                            ctrlEsc = `<tr>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                    </tr>`
                            $('#control-esclareciemntos').append(ctrlEsc)
                        }
                        if (processo && processo.pagamentos && processo.pagamentos.length > 0) {
                            processo.honorario
                            var valorPago = 0
                            processo.pagamentos.forEach(function (pagamento) {
                                let valor = parseFloat(pagamento.valor) || 0;
                                valorPago += valor;
                                ctrlPag = `
                                            <tr>
                                                <td class="text-center">${pagamento.valor}</td>
                                                <td class="text-center">${dateFormat(pagamento.data)}</td>
                                                <td >${pagamento.observacao == null ? '-' : pagamento.observacao    }</td>
                                            </tr>`;
                                $('#control-pagamentos').append(ctrlPag);
                            });
                            localStorage.setItem("valor_pago", valorPago);
                        } else {
                            ctrlPag = `<tr>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                    </tr>`
                            $('#control-pagamentos').append(ctrlPag)
                        }


                        if (processo && processo.erros_execucao && processo.erros_execucao.length > 0) {
                            processo.erros_execucao.forEach(function (erro_execucao) {
                                let ctrlErr = `
                                            <tr>
                                                <td class="text-center">${erro_execucao.tipo_erro}</td>
                                                <td class="text-center">${dateFormat(erro_execucao.data_erro)}</td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                                            <span class="$${erro_execucao.custo_apoio} == 0 ? 'badge badge-success' : 'badge badge-danger'}">
                                                                                ${erro_execucao.custo_apoio == 0 ? "Não" : "Sim"}
                                                                            </span>
                                                </td>
                                                <td class="text-center">-</td>
                                            </tr>`;
                                $('#control-erro').append(ctrlErr);
                            });
                        } else {
                            ctrlErr = `<tr>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                    </tr>`
                            $('#control-erro').append(ctrlErr)
                        }


                    })

                },
                error: function (error) {
                    var errorMessage = 'Erro desconhecido'
                    if (error.responseJSON && error.responseJSON.message) {
                        errorMessage = error.responseJSON.message
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'OPS!',
                        customClass: {
                            confirmButton: "btn btn-danger"
                        },
                        text: errorMessage.toLocaleUpperCase(),
                        confirmButtonText: "OK"
                    })
                }
            });
            function getEquipe(equipe_id) {
                $.ajax({
                    url: '/equipe/getAll' + location.search,
                    type: 'GET',
                    success: function (response) {
                        populateSelect(response)
                    },
                    error: function (error) {
                        Swal.fire({
                            type: 'error',
                            title: 'OPS!',
                            text: `${error.message}`
                        })
                    }
                });
                function populateSelect(data) {
                    var selectMembros = $('#equipe');
                    selectMembros.append('<option value = "">Selecione...</option>}');

                    data.forEach(function (membro) {
                        if (membro.id == equipe_id) {
                            var row = `<option value = ${membro.id} selected>${membro.nome.toUpperCase()}</option>`;

                        } else {
                            var row = `<option value = ${membro.id}>${membro.nome.toUpperCase()}</option>`;
                        }
                        selectMembros.append(row);
                    });
                }
            }
        })


        $(document).ready(function () {

            $('[data-mask]').each(function () {
                var mask = $(this).attr('data-mask');
                $(this).mask(mask);
            });
        });
        $(document).ready(function () {

        });
        function parseValorBR(valor) {
            if (!valor) return 0;

            // Remove pontos de milhar e troca vírgula por ponto
            valor = valor.replace(/\./g, '').replace(',', '.');

            return parseFloat(valor) || 0;
        }
        function dateFormat(data) {

            if (data && data.length == 10) {
                const partesData = data.split('-'); // Divide a data em partes separadas por "-"

                // Obtém o dia, mês e ano da data
                const dia = partesData[2];
                const mes = partesData[1];
                const ano = partesData[0];
                const dataFormatada = `${dia}/${mes}/${ano}`;
                return dataFormatada;

            } else {
                const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
                const dataFormatada = new Date(data).toLocaleDateString('pt-BR', options).replace(/[^\d\/:\sAPM]/g, '');
                return dataFormatada;
            }

        }


        function mascaraMoeda(campo) {
            // Remove tudo que não for número
            let valor = campo.value.replace(/\D/g, "");

            // Se estiver vazio, não faz nada
            if (valor === "") {
                campo.value = "";
                return;
            }

            // Converte para número em centavos
            valor = (parseInt(valor) / 100).toFixed(2) + "";

            // Troca ponto por vírgula
            valor = valor.replace(".", ",");

            // Coloca separador de milhar
            valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            campo.value = valor;
        }

        $("#form-processo").on("submit", function (e) {
            console.log("teste")
            e.preventDefault(); // evita o envio normal do form
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let form = $(this);
            let actionUrl = '/processo/update' + location.search;
            let formData = form.serialize();

            $.ajax({
                url: actionUrl,
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Sucesso!",
                        text: response.message ?? "Registro salvo com sucesso!",
                        showDenyButton: true,
                        confirmButtonText: "Continua no processo",
                        denyButtonText: "Voltar para lista",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Limpa o formulário para novo cadastro
                            window.location.href = `/processo/show/${response.id}`;
                        } else if (result.isDenied) {
                            // Redireciona para a lista de equipe
                            window.location.href = "/processos";
                        }
                    });
                },
                error: function (xhr) {
                    let msg = "Ocorreu um erro ao processar a requisição.";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: "error",
                        title: "Erro!",
                        text: msg,
                        confirmButtonText: "Fechar"
                    });
                }
            });
        });

    </script>
@endsection