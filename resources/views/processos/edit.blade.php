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
                                        data-mask="9999999-99.9999.9.99.9999" id="numero-processo" />
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
                                    <label class="form-control-label" id="reclamante_div">Reclamante:</label>
                                    <input type="text" class="form-control" name="reclamante" id="reclamante" />
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Documento Reclamante:</label>
                                    <input type="text" class="form-control" name="doc_reclamante" id="doc-reclamante"
                                        data-mask="999.999.999-99" />
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label" id="reclamada_div">Reclamado:</label>
                                    <input type="text" class="form-control" name="reclamada" id="reclamada" />
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Documento Reclamado:</label>
                                    <input type="text" class="form-control" name="doc_reclamada" id="doc-reclamada"
                                        data-mask="99.999.999/9999-99" />
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label" id="carga_div">Carga:</label>
                                    <input type="date" class="form-control" name="carga" id="carga" />
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label" id="prazo_div">Prazo:</label>
                                    <input type="date" class="form-control" name="prazo" id="prazo" />
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label" id="laudo-judicial_div">Entrega Laudo
                                        Judicial:</label>
                                    <input type="date" class="form-control" name="laudo_judicial" id="laudo-judicial" />
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label" id="equipe_div">Calculista:</label>
                                    <select class="form-control" name="equipe_id" id="equipe"></select>
                                </div>

                                <div class="col-lg-3 mt-2">
                                    <label class="form-control-label">Honorário:</label>
                                    <input type="text" id="honorario" class="form-control" name='honorario'
                                        placeholder="0,00" oninput="mascaraMoeda(this)">
                                </div>

                                <div class="col-lg-3 mt-2">
                                    <label class="form-control-label">Calculo Erro:</label>
                                    <input type="text" id="calculo-conforme-erro" name="calculo_conforme_erro"
                                        class="form-control" placeholder="0,00" readonly>
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
                                        <th class="text-center" colspan="5" style="background-color:#E6E6FA;">
                                            Esclarecimentos</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th style="width:30%;">Carga</th>
                                        <th class="text-center" style="width:30%;">Entrega Judicial</th>
                                        <th style="width:30%;">Prazo</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody id="control-esclarecimentos"></tbody>
                            </table>
                            <table class="table table-bordered table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="6" style="background-color:#E6E6FA; ">
                                            Pagamentos</th>
                                    </tr>
                                    <tr>
                                        <th style="width:5%;"></th>
                                        <th style="width:20%;">Valor R$</th>
                                        <th class="text-center" style="width:10%;">Data</th>
                                        <th class="text-center" style="width:20%;">Recibo</th>
                                        <th style="width:40%;">Observação</th>
                                        <th style="width:5%;"></th>

                                    </tr>
                                </thead>
                                <tbody id="control-pagamentos"></tbody>
                            </table>
                            <table class="table table-bordered table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="5" style="background-color:#E6E6FA;">
                                            Erros de Execução</th>
                                    </tr>
                                    <tr>
                                        <th style="width:5%;"></th>
                                        <th class="text-center" style="width:40%;">Tipo Erro</th>
                                        <th style="width:25%;">Data</th>
                                        <th style="width:25%;">Custo de Apoio</th>
                                        <th style="width:5%;"></th>

                                    </tr>
                                </thead>
                                <tbody id="control-erro"></tbody>
                            </table>

                        </div>

                        <!-- Esclarecimentos -->
                        <div class="tab-pane " id="btabs-alt-static-esclarecimento" role="tabpanel">
                            <p class="p-10 bg-info text-white">Esclarecimento</p>

                            <form id="form-esclarecimento">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" name="id" id="id-esclarecimento" />
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Carga:</label>
                                        <input type="date" class="form-control" name="carga_esclarecimento"
                                            id="carga-esclarecimento" />
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Entrega Judicial:</label>
                                        <input type="date" class="form-control" name="entrega_judicial_esclarecimento"
                                            id="entrega-judicial-esclarecimento" />
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Prazo:</label>
                                        <input type="date" class="form-control" name="prazo_esclarecimento"
                                            id="prazo-esclarecimento" />
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label class="form-control-label">Observação:</label>
                                        <input type="text" class="form-control" name="observacao_esclarecimento"
                                            id="observacao-esclarecimento" />
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <button type="submit" class="btn btn-alt-success" id="salvar-esclarecimento">
                                            <i class="fa fa-check"></i> Salvar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Pagamentos -->
                        <div class="tab-pane" id="btabs-alt-static-pagamento" role="tabpanel">
                            <p class="p-10 bg-info text-white">Pagamento</p>
                            <form id="form-pagamentos" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" name="id" id="id-pagamento" />
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Valor:</label>
                                        <input type="text" class="form-control" name="valor_pagamento" id="valor-pagamento"
                                            oninput="mascaraMoeda(this)" />
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Data de Pagamento:</label>
                                        <input type="date" class="form-control" name="data_pagamento" id="data-pagamento" />
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label class="form-control-label">Recibo:</label>
                                        <input type="file" class="form-control" id="recibo" name="recibo[]" multiple>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label class="form-control-label">Observações:</label>
                                        <textarea class="form-control" name="observacao_pagamento"
                                            id="observacao-pagamento"></textarea>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <button type="submit" class="btn btn-alt-success" id="salvar-pagamento">
                                            <i class="fa fa-check"></i> Salvar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Erros de Execução -->
                        <div class="tab-pane" id="btabs-alt-static-fail" role="tabpanel">
                            <p class="p-10 bg-info text-white">Erros de Execução</p>
                            <form id="form-erro">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" name="id" id="id-erro" />

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Tipo Erro:</label>
                                        <input type="text" class="form-control" name="tipo_erro" id="tipo-erro" />
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Data:</label>
                                        <input type="date" class="form-control" name="data_erro" id="data-erro" />
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="form-control-label">Gerou Custo de Apoio:</label>
                                        <select class="form-control" name="custo_apoio" id="custo-apoio">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label class="form-control-label">Observação:</label>
                                        <input type="text" class="form-control" name="observacao" id="observacao-erro" />
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

        <hr>
        <div id="preview" style="margin-top:20px;"></div>

        <!-- Botões -->

    </div>
    </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="modal-message"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout modal-xl" role="document"> <!-- modal maior para PDFs -->
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title" id="modal-title"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content text-center" id="modal-body" style="max-height: 80vh; overflow:auto;">
                        <!-- Conteúdo dinâmico entra aqui -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Message Modal -->

@endsection
@section('js_after')
    <!--form validation Custom js-->
    <script src="{{asset('assets/js/codebase.core.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/plugins/masked-inputs/jquery.maskedinput.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        localStorage.setItem("calculo-conforme-erro", 0)
        localStorage.setItem("valor_pago", 0)
        localStorage.setItem("id", null)
        localStorage.setItem("tecnico", null)
        $(document).ready(function () {
            var url = window.location.href
            var parse = url.split('/')
            var id = parse.pop() || parse.pop()
            var esc = 0;
            var pag = 0;
            var err = 0;


            /** Submit do formulário de pagamento */
            $("#form-pagamentos").on("submit", function (e) {
                e.preventDefault(); // evita o envio normal do form
                let pagamento = parseFloat(parseValorBR($('#valor-pagamento').val()))
                let valorPago = parseFloat(localStorage.getItem("valor_pago"))
                let calculoConformeErro = parseFloat(localStorage.getItem("calculo-conforme-erro"))
                let acumulado = 0;

                if ($('#id-pagamento').val() == "") {
                    acumulado = pagamento + valorPago
                } else {
                    acumulado = pagamento
                }
                let saldo = calculoConformeErro - valorPago
                if (acumulado > calculoConformeErro) {
                    Swal.fire({
                        icon: "error",
                        title: 'OPS!',
                        customClass: {
                            confirmButton: "btn btn-danger"
                        },
                        text: `Valor de pagamento excede ao valor ao saldo devedor  de R$ ${parseFloat(saldo).toFixed(2).replaceAll('.', ',')}`.toUpperCase(),
                        confirmButtonText: "OK"
                    })
                    return; // <-- interrompe a função aqui
                } else if (acumulado == honorario) {
                    $('#liquidado').val(1)
                    $('#liquidado').trigger('change')
                }
                let form = $(this)[0]; // pega o form "puro"
                let formData = new FormData(form);
                formData.append('processo_id', localStorage.getItem('id'))
                formData.append('tecnico', localStorage.getItem('tecnico'))

                $.ajax({
                    url: "/processo/pagamento/create",
                    type: "POST",
                    data: formData,
                    processData: false, // impede o jQuery de converter em querystring
                    contentType: false, // impede jQuery de setar content-type errado
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Sucesso!",
                            text: response.message ?? "Pagamento incluso com sucesso!",
                            showDenyButton: true,
                            confirmButtonText: "Continua no processo",
                            denyButtonText: "Retornar",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = `/processo/show/${localStorage.getItem('id')}`;
                            } else if (result.isDenied) {
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
                })
            })

            /** Fim de submissão do pagamento  */
            //**
            // Exibição do arquivo selecionado
            //  */
            $(document).on('click', '.open-modal', function (e) {
                e.preventDefault();

                var fileUrl = $(this).data('url');
                var nomeArquivo = $(this).data('nome');
                var ext = fileUrl.split('.').pop().toLowerCase();
                var content = '';

                if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(ext)) {
                    content = `<img src="${fileUrl}" alt="${nomeArquivo}" style="max-width:100%; border:1px solid #ccc; padding:5px;">`;
                } else if (ext === 'pdf') {
                    content = `<iframe src="${fileUrl}" width="100%" height="600px" style="border:1px solid #ccc;"></iframe>`;
                } else {
                    content = `<p>Visualização não suportada. <a href="${fileUrl}" target="_blank">Baixar arquivo</a></p>`;
                }

                // Atualiza modal
                $('#modal-title').text(nomeArquivo);
                $('#btn-download').attr('href', fileUrl);
                $('#modal-body').html(content);

                // Abre modal
                $('#modal-message').modal('show');
            });


            (function () {
                // Carrega jQuery dinamicamente caso não exista
                function ensureJQuery(callback) {
                    if (typeof window.jQuery !== 'undefined') {
                        return callback();
                    }
                    var script = document.createElement('script');
                    script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
                    script.crossOrigin = 'anonymous';
                    script.onload = function () {
                        callback();
                    };
                    script.onerror = function () {
                        console.error('Falha ao carregar jQuery. Algumas funcionalidades podem não funcionar.');
                        callback();
                    };
                    document.head.appendChild(script);
                }

                ensureJQuery(function () {
                    var $ = window.jQuery; // pode ser undefined se falhar o load; cuidaremos disso abaixo

                    // Utilitário para ativar a aba de forma compatível
                    function activateTab(selector) {
                        try {
                            if ($ && $.fn && $.fn.tab) {
                                $(selector).tab('show');
                                return;
                            }
                        } catch (e) {
                            // segue para fallback
                        }
                        // Fallback manual: adiciona classe active ao nav-link e exibe o tab-pane correspondente
                        try {
                            var link = document.querySelector(selector);
                            if (!link) return;
                            // remove active de todos os nav-links do mesmo grupo
                            var nav = link.closest('.nav');
                            if (nav) {
                                nav.querySelectorAll('.nav-link').forEach(function (n) { n.classList.remove('active'); });
                            }
                            link.classList.add('active');
                            // mostra tab-pane
                            var href = link.getAttribute('href');
                            if (href && href.startsWith('#')) {
                                var panes = document.querySelectorAll('.tab-pane');
                                panes.forEach(function (p) { p.classList.remove('active'); });
                                var pane = document.querySelector(href);
                                if (pane) pane.classList.add('active');
                            }
                        } catch (e) {
                            console.error('activateTab fallback falhou', e);
                        }
                    }

                    // Inicia após DOM pronto (jQuery if available, else DOMContentLoaded)
                    function onReady(fn) {
                        if ($) {
                            $(fn);
                        } else {
                            if (document.readyState === 'complete' || document.readyState === 'interactive') {
                                setTimeout(fn, 0);
                            } else {
                                document.addEventListener('DOMContentLoaded', fn);
                            }
                        }
                    }

                    onReady(function () {
                        try {
                            // pega o id do processo - tenta várias estratégias
                            var idVar = (typeof id !== 'undefined' && id) ? id : null;
                            if (!idVar) {
                                // tenta pegar de um input escondido #id
                                var elId = document.querySelector('#id');
                                if (elId) idVar = elId.value || elId.getAttribute('value');
                            }
                            if (!idVar) {
                                // tenta extrair da URL (último segmento numérico)
                                var m = location.pathname.match(/(\d+)(?!.*\d)/);
                                if (m) idVar = m[1];
                            }

                            if (!idVar) {
                                console.warn('ID do processo não encontrado. Abortando carregamento de dados do processo.');
                                return;
                            }

                            // Faz a requisição para buscar o processo
                            (function fetchProcesso() {
                                var url = '/processo/getById/' + encodeURIComponent(idVar) + location.search;
                                // Se jQuery estiver disponível, use $.ajax, senão fallback para fetch
                                if ($) {
                                    $.ajax({
                                        url: url,
                                        type: 'GET',
                                        success: handleResponse,
                                        error: function (xhr) {
                                            var msg = 'Ocorreu um erro ao processar a requisição.';
                                            if (xhr && xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                                            if (window.Swal) {
                                                window.Swal.fire({ icon: 'error', title: 'Erro!', text: msg, confirmButtonText: 'Fechar' });
                                            } else {
                                                alert(msg);
                                            }
                                            console.error(xhr);
                                        }
                                    });
                                } else if (window.fetch) {
                                    fetch(url, { method: 'GET', credentials: 'same-origin' })
                                        .then(function (res) { if (!res.ok) throw res; return res.json(); })
                                        .then(handleResponse)
                                        .catch(function (err) { console.error(err); alert('Erro ao carregar processo (fetch). Veja console).'); });
                                } else {
                                    console.error('Nenhuma forma de fazer requisição (nem jQuery nem fetch disponíveis).');
                                }
                            })();

                            function handleResponse(response) {
                                try {
                                    var processos = Array.isArray(response) ? response : [response];
                                    // define o processo global como o primeiro registro
                                    window.processo = processos[0] || null;

                                    // limpa áreas antes de popular
                                    if ($) {
                                        $('#control-esclarecimentos').empty();
                                        $('#control-pagamentos').empty();
                                        $('#control-erro').empty();
                                    } else {
                                        var ce = document.getElementById('control-esclarecimentos'); if (ce) ce.innerHTML = '';
                                        var cp = document.getElementById('control-pagamentos'); if (cp) cp.innerHTML = '';
                                        var ce2 = document.getElementById('control-erro'); if (ce2) ce2.innerHTML = '';
                                    }

                                    processos.forEach(function (processo) {
                                        // preencher campos do formulário principal (mantive fiel ao original)
                                        function setVal(selector, value) {
                                            if ($) { $(selector).val(value); }
                                            else {
                                                var el = document.querySelector(selector);
                                                if (el) el.value = value;
                                            }
                                        }

                                        setVal('#id', processo.id);
                                        setVal('#numero-processo', processo.numero_processo);
                                        setVal('#vara', processo.vara);
                                        setVal('#mes-ano', processo.mes_ano);
                                        setVal('#reclamante', processo.reclamante);
                                        setVal('#doc-reclamante', processo.doc_reclamante);
                                        setVal('#reclamada', processo.reclamada);
                                        setVal('#doc-reclamada', processo.doc_reclamada);
                                        setVal('#carga', processo.carga);
                                        setVal('#prazo', processo.prazo);
                                        setVal('#status', processo.status);
                                        // dispara changes se existir (usa jQuery se disponível)
                                        try { if ($) { $('#liquidado').trigger('change'); } else { var liq = document.querySelector('#liquidado'); if (liq) liq.dispatchEvent(new Event('change')); } } catch (e) { }
                                        setVal('#laudo-judicial', processo.laudo_judicial);
                                        setVal('#observacoes', processo.observacoes);
                                        try { setVal('#honorario', String(processo.honorario || '').replaceAll('.', ',')); } catch (e) { setVal('#honorario', processo.honorario || ''); }
                                        setVal('#calculo-conforme-erro', processo.calculo_conforme_erro);
                                        setVal('#liquidado', processo.liquidado);
                                        try { if ($) { $('#liquidado').trigger('change'); } } catch (e) { }
                                        try { localStorage.setItem('calculo-conforme-erro', processo.calculo_conforme_erro); localStorage.setItem('id', processo.id); } catch (e) { }

                                        if (typeof getEquipe === 'function') {
                                            try { getEquipe(processo.equipe_id); } catch (e) { console.warn('getEquipe falhou', e); }
                                        }

                                        // Esclarecimentos
                                        if (processo && processo.esclarecimentos && processo.esclarecimentos.length > 0) {
                                            processo.esclarecimentos.forEach(function (esclarecimento) {
                                                var row = '<tr>' +
                                                    '<td class="text-center"><a href="#btabs-alt-static-esclarecimento" class="btn btn-link text-cente nav-link" type="button" onClick="showEsclarecimento(' + esclarecimento.id + ')">' +
                                                    '<i class="fa fa-folder-open-o"></i>' +
                                                    '</a></td>' +
                                                    '<td class="text-center">' + (typeof dateFormat === 'function' ? dateFormat(esclarecimento.carga) : (esclarecimento.carga || '')) + '</td>' +
                                                    '<td class="text-center">' + (typeof dateFormat === 'function' ? dateFormat(esclarecimento.entrega_judicial) : (esclarecimento.entrega_judicial || '')) + '</td>' +
                                                    '<td>' + (typeof dateFormat === 'function' ? dateFormat(esclarecimento.prazo) : (esclarecimento.prazo || '')) + '</td>' +
                                                    `<td class="text-center"><i class="fa fa-trash text-danger" id="deleteEsclarecimento" data-esclarecimento-id = "${esclarecimento.id}" data-esclarecimento-carga = "${dateFormat(esclarecimento.carga)}" data-toggle="tooltip" data-placement="top" title="Excluir">
                                                                                                            </i></td>`+
                                                    '</tr>';
                                                if ($) $('#control-esclarecimentos').append(row); else { var el = document.getElementById('control-esclarecimentos'); if (el) el.insertAdjacentHTML('beforeend', row); }
                                            });
                                        } else {
                                            var emptyRow = '<tr><td class="text-center">-</td><td class="text-center">-</td><td class="text-center">-</td></tr>';
                                            if ($) $('#control-esclarecimentos').append(emptyRow); else { var el = document.getElementById('control-esclarecimentos'); if (el) el.insertAdjacentHTML('beforeend', emptyRow); }
                                        }

                                        // Pagamentos
                                        if (processo && processo.pagamentos && processo.pagamentos.length > 0) {
                                            var valorPago = 0;
                                            processo.pagamentos.forEach(function (pagamento) {
                                                var valorNum = parseFloat(pagamento.valor) || 0;
                                                valorPago += valorNum;

                                                var recibosHtml = '-';
                                                if (pagamento.recibos && pagamento.recibos.length > 0) {
                                                    recibosHtml = pagamento.recibos.map(function (recibo) {
                                                        return '<a href="#" class="open-modal" data-url="' + (recibo.blob || '') + '" data-nome="' + (recibo.nome_arquivo || '') + '">' + (recibo.nome_arquivo || '') + '</a><br>';
                                                    }).join('');
                                                }

                                                var row = '<tr>' +
                                                    '<td class="text-center"><a href="#btabs-alt-static-pagamento" class="btn btn-link text-cente nav-link" type="button" onClick="showPagamento(' + pagamento.id + ')">' +
                                                    '<i class="fa fa-folder-open-o"></i>' +
                                                    '</a></td>' +
                                                    '<td class="text-center">' + (pagamento.valor || '-') + '</td>' +
                                                    '<td class="text-center">' + (typeof dateFormat === 'function' ? dateFormat(pagamento.data) : (pagamento.data || '-')) + '</td>' +
                                                    '<td class="text-center">' + recibosHtml + '</td>' +
                                                    '<td>' + (pagamento.observacao == null ? '-' : pagamento.observacao) + '</td>' +
                                                    `<td class="text-center"><i class="fa fa-trash text-danger" id="deletePagamento" data-pagamento-id = "${pagamento.id}" data-pagamento-valor = "${pagamento.valor}" data-toggle="tooltip" data-placement="top" title="Excluir">
                                                                                                            </i></td>`+
                                                    '</tr>';

                                                if ($) $('#control-pagamentos').append(row); else { var el = document.getElementById('control-pagamentos'); if (el) el.insertAdjacentHTML('beforeend', row); }
                                            });
                                            try { localStorage.setItem('valor_pago', valorPago); } catch (e) { }
                                        } else {
                                            var emptyPag = '<tr><td class="text-center">-</td><td class="text-center">-</td><td class="text-center">-</td></tr>';
                                            if ($) $('#control-pagamentos').append(emptyPag); else { var el = document.getElementById('control-pagamentos'); if (el) el.insertAdjacentHTML('beforeend', emptyPag); }
                                        }

                                        // Erros de execução
                                        if (processo && processo.erros_execucao && processo.erros_execucao.length > 0) {
                                            processo.erros_execucao.forEach(function (erro_execucao) {
                                                var row = '<tr>' +
                                                    '<td class="text-center"><a href="#btabs-alt-static-fail" class="btn btn-link text-cente nav-link" type="button" onClick="showErroExecucao(' + erro_execucao.id + ')">' +
                                                    '<i class="fa fa-folder-open-o"></i>' +
                                                    '</a></td>' +
                                                    '<td>' + (erro_execucao.tipo_erro || '') + '</td>' +
                                                    '<td class="text-center">' + (typeof dateFormat === 'function' ? dateFormat(erro_execucao.data_erro) : (erro_execucao.data_erro || '')) + '</td>' +
                                                    '<td class="text-center">' + ((erro_execucao.custo_apoio == 1) ? 'Sim' : 'Não') + '</td>' +
                                                    `<td class="text-center"><i class="fa fa-trash text-danger" id="delete-erro" data-erro-execucao-id = "${erro_execucao.id}" data-tipo-erro = "${erro_execucao.tipo_erro}" data-toggle="tooltip" data-placement="top" title="Excluir">
                                                                                                            </i></td>` +
                                                    '</tr>';
                                                if ($) $('#control-erro').append(row); else { var el = document.getElementById('control-erro'); if (el) el.insertAdjacentHTML('beforeend', row); }
                                            });
                                        } else {
                                            var emptyErr = '<tr><td class="text-center">-</td><td class="text-center">-</td><td class="text-center">-</td><td class="text-center">-</td></tr>';
                                            if ($) $('#control-erro').append(emptyErr); else { var el = document.getElementById('control-erro'); if (el) el.insertAdjacentHTML('beforeend', emptyErr); }
                                        }

                                    }); // end processos.forEach

                                } catch (e) {
                                    console.error('Erro ao manipular resposta do processo', e);
                                }
                            }

                            // Implementa showEsclarecimento globalmente (acessível por onClick)
                            window.showEsclarecimento = function (id) {

                                try {
                                    var proc = window.processo;
                                    console.log(proc)
                                    if (!proc || !proc.esclarecimentos) return;
                                    var esclarecimento = proc.esclarecimentos.find(function (e) { return String(e.id) === String(id); });
                                    if (!esclarecimento) return;
                                    if ($) $('#id-esclarecimento').val(id); else { var el = document.querySelector('#id-esclarecimento'); if (el) el.value = id; }
                                    // data
                                    function dateToInput(v) {
                                        if (!v) return '';
                                        var m = String(v).match(/(\d{4}-\d{2}-\d{2})/);
                                        if (m) return m[1];
                                        var d = new Date(v);
                                        if (!isNaN(d)) {
                                            var mm = String(d.getMonth() + 1).padStart(2, '0');
                                            var dd = String(d.getDate()).padStart(2, '0');
                                            return d.getFullYear() + '-' + mm + '-' + dd;
                                        }
                                        return '';
                                    }

                                    //Carga
                                    var cargaVal = dateToInput(esclarecimento.carga);
                                    if ($) $('#carga-esclarecimento').val(cargaVal); else { var el = document.querySelector('#carga-esclarecimento'); if (el) el.value = cargaVal; }

                                    //Entrega Judicial
                                    var entregaJudicialVal = dateToInput(esclarecimento.entrega_judicial);
                                    if ($) $('#entrega-judicial-esclarecimento').val(entregaJudicialVal); else { var el = document.querySelector('#entrega-judicial-esclarecimento'); if (el) el.value = entregaJudicialVal; }

                                    // prazo
                                    var prazoVal = dateToInput(esclarecimento.prazo);
                                    if ($) $('#prazo-esclarecimento').val(prazoVal); else { var el = document.querySelector('#prazo-esclarecimento'); if (el) el.value = prazoVal; }

                                    // observacao
                                    if ($) $('#observacao-esclarecimento').val(esclarecimento.observacao || ''); else { var el = document.querySelector('#observacao-esclarecimento'); if (el) el.value = (esclarecimento.observacao || ''); }


                                    // ativa aba de pagamentos
                                    activateTab('a[href="#btabs-alt-static-esclarecimento"]');

                                } catch (e) {
                                    console.error('showEsclarecimento falhou', e);
                                }
                            };
                            // end window.showEsclarecimento

                            // Implementa showPagamento globalmente (acessível por onClick)
                            window.showPagamento = function (id) {
                                try {
                                    var proc = window.processo;
                                    if (!proc || !proc.pagamentos) return;
                                    var pagamento = proc.pagamentos.find(function (p) { return String(p.id) === String(id); });
                                    if (!pagamento) return;

                                    // valor
                                    var valor = pagamento.valor;
                                    if (valor === null || valor === undefined) {
                                        valor = '';
                                    } else {
                                        if (typeof valor === 'number') valor = valor.toFixed(2).replace('.', ',');
                                        else {
                                            var s = String(valor).trim();
                                            if (/^\d+(\.\d+)?$/.test(s)) valor = parseFloat(s).toFixed(2).replace('.', ',');
                                            else valor = s;
                                        }
                                    }
                                    if ($) $('#id-pagamento').val(id); else { var el = document.querySelector('#id-pagamento'); if (el) el.value = id; }

                                    if ($) $('#valor-pagamento').val(valor); else { var el = document.querySelector('#valor-pagamento'); if (el) el.value = valor; }

                                    // data
                                    function dateToInput(v) {
                                        if (!v) return '';
                                        var m = String(v).match(/(\d{4}-\d{2}-\d{2})/);
                                        if (m) return m[1];
                                        var d = new Date(v);
                                        if (!isNaN(d)) {
                                            var mm = String(d.getMonth() + 1).padStart(2, '0');
                                            var dd = String(d.getDate()).padStart(2, '0');
                                            return d.getFullYear() + '-' + mm + '-' + dd;
                                        }
                                        return '';
                                    }
                                    var dataVal = dateToInput(pagamento.data);
                                    if ($) $('#data-pagamento').val(dataVal); else { var el = document.querySelector('#data-pagamento'); if (el) el.value = dataVal; }

                                    // observacao
                                    if ($) $('#observacao-pagamento').val(pagamento.observacao || ''); else { var el = document.querySelector('#observacao-pagamento'); if (el) el.value = (pagamento.observacao || ''); }

                                    // limpa input file (não é possível setar valor por JS)
                                    if ($) $('#recibo').val(''); else { var f = document.querySelector('#recibo'); if (f) try { f.value = ''; } catch (e) { } }

                                    // lista recibos anexados (somente visualização)
                                    var recibosHtml = '';
                                    if (pagamento.recibos && pagamento.recibos.length > 0) {
                                        recibosHtml = pagamento.recibos.map(function (r) {
                                            return `<tr><td><a href="#" class="open-modal font-w600" data-url=" ${r.blob || ''} " data-nome=" ${r.nome_arquivo || ''} "><strong>${r.nome_arquivo || ''}</strong></a></td>
                                                                                                                                    <td><i class="fa fa-trash text-danger" id="deleteFileId" data-recibo-id = "${r.id}" data-arquivo = "${r.nome_arquivo}" data-toggle="tooltip" data-placement="top" title="Excluir">
                                                                                                            </i></td>
                                                                                                                                    </tr>`
                                        }).join('');
                                    }

                                    if (recibosHtml) {
                                        if ($) {
                                            if ($('#recibo-list').length === 0) {
                                                var parentCol = $('#recibo').closest('.col-lg-12');
                                                if (parentCol.length) parentCol.after('<div class="col-lg-12 mt-2" id="recibo-list"></div>');
                                                else $('#form-pagamentos').append('<div id="recibo-list" class="mt-2"></div>');
                                            }
                                            $('#recibo-list').html(`<table class="table table-borderless table-vcenter">${recibosHtml}</table>`);
                                        } else {
                                            if (!document.getElementById('recibo-list')) {
                                                var parent = document.querySelector('#recibo');
                                                if (parent) {
                                                    var pcol = parent.closest('.col-lg-12');
                                                    if (pcol && pcol.parentNode) {
                                                        var div = document.createElement('div'); div.className = 'col-lg-12 mt-2'; div.id = 'recibo-list'; pcol.parentNode.insertBefore(div, pcol.nextSibling);
                                                    } else { var div2 = document.createElement('div'); div2.id = 'recibo-list'; document.getElementById('form-pagamentos').appendChild(div2); }
                                                }
                                            }
                                            var rl = document.getElementById('recibo-list'); if (rl) rl.innerHTML = recibosHtml;
                                        }
                                    } else {
                                        if ($) $('#recibo-list').remove(); else { var rl = document.getElementById('recibo-list'); if (rl) rl.parentNode.removeChild(rl); }
                                    }

                                    // ativa aba de pagamentos
                                    activateTab('a[href="#btabs-alt-static-pagamento"]');

                                } catch (e) {
                                    console.error('showPagamento falhou', e);
                                }
                            };
                            // end window.showPagamento

                            // Implementa showErroExecucao globalmente (acessível por onClick)
                            window.showErroExecucao = function (id) {

                                try {
                                    var proc = window.processo;
                                    console.log(proc)
                                    if (!proc || !proc.erros_execucao) return;
                                    var erro_execucao = proc.erros_execucao.find(function (e) { return String(e.id) === String(id); });
                                    if (!erro_execucao) return;
                                    if ($) $('#id-erro-execucao').val(id); else { var el = document.querySelector('#id-erro-execucao'); if (el) el.value = id; }
                                    // data
                                    function dateToInput(v) {
                                        if (!v) return '';
                                        var m = String(v).match(/(\d{4}-\d{2}-\d{2})/);
                                        if (m) return m[1];
                                        var d = new Date(v);
                                        if (!isNaN(d)) {
                                            var mm = String(d.getMonth() + 1).padStart(2, '0');
                                            var dd = String(d.getDate()).padStart(2, '0');
                                            return d.getFullYear() + '-' + mm + '-' + dd;
                                        }
                                        return '';
                                    }

                                    //Data_erro
                                    var dataErroVal = dateToInput(erro_execucao.data_erro);
                                    if ($) $('#data-erro').val(dataErroVal); else { var el = document.querySelector('#data-erro'); if (el) el.value = dataErroVal; }

                                    //Tipo Erro

                                    if ($) $('#tipo-erro').val(erro_execucao.tipo_erro); else { var el = document.querySelector('#tipo-erro'); if (el) el.value = erro_execucao.tipo_erro; }

                                    // observacao
                                    if ($) $('#observacao-erro').val(erro_execucao.observacao || ''); else { var el = document.querySelector('#observacao-erro'); if (el) el.value = (esclarecimento.observacao || ''); }

                                    //custo Apoio
                                    if (window.jQuery) {
                                        $('#custo-apoio').val(erro_execucao.custo_apoio).trigger('change');
                                    } else {
                                        var el = document.querySelector('#custo-apoio');
                                        if (el) el.value = erro_execucao.custo_apoio;
                                    }

                                    // ativa aba de pagamentos
                                    activateTab('a[href="#btabs-alt-static-fail"]');

                                } catch (e) {
                                    console.error('showErroExecucao falhou', e);
                                }
                            }; // end window.showErroExecucao

                        } catch (e) {
                            console.error('Erro na inicialização do script de edição do processo', e);
                        }
                    }); // end onReady

                }); // end ensureJQuery
            })();


            $(document).on('click', '#deleteFileId', function (e) {

                var fileId = $(this).data('recibo-id');
                var fileName = $(this).data('arquivo');

                Swal.fire({
                    icon: "question",
                    title: "Alerta!",
                    text: `Deseja excluir o arquivo ${fileName} ?`,
                    showDenyButton: true,
                    confirmButtonText: "Sim, excluir!",
                    denyButtonText: "Não",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/processo/pagamento/rebibo/delete/${fileId}` + location.search,
                            type: 'GET',
                            success: function (response) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Sucesso!",
                                    text: response.message ?? "Recibo exclido com sucesso!",
                                })

                                window.location.href = `/processo/show/${localStorage.getItem('id')}`;


                            },
                            error: function (error) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'OPS!',
                                    text: `${error.message}`
                                })
                            }
                        });

                    } else if (result.isDenied) {
                        // Redireciona para a lista de equipe
                    }
                });

            })
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
                            localStorage.setItem("tecnico", membro.nome)

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
        /**
         * Persistência de Esclarecimento
         *
         *
         */
        $("#form-esclarecimento").on("submit", function (e) {
            e.preventDefault(); // evita o envio normal do form
            let actionUrl = '/processo/esclarecimento/create' + location.search;
            let form = $(this)[0]; // pega o form "puro"
            let formData = new FormData(form);
            formData.append('processo_id', localStorage.getItem('id'))
            $.ajax({
                url: actionUrl,
                type: "POST",
                data: formData,
                processData: false, // impede o jQuery de converter em querystring
                contentType: false, // impede jQuery de setar content-type errado
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Sucesso!",
                        text: response.message ?? "Esclarecimento salvo com sucesso!",
                        showDenyButton: true,
                        confirmButtonText: "Continua no processo",
                        denyButtonText: "Voltar para lista",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Limpa o formulário para novo cadastro
                            window.location.href = `/processo/show/${localStorage.getItem('id')}`;
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
            })

        })


        /**
         * Persistência de Erro
         *
         *
         */

        $("#form-erro").on("submit", function (e) {
            e.preventDefault(); // evita o envio normal do form
            let actionUrl = '/processo/erro-execucao/create' + location.search;
            let form = $(this)[0]; // pega o form "puro"
            let formData = new FormData(form);
            formData.append('processo_id', localStorage.getItem('id'))
            $.ajax({
                url: actionUrl,
                type: "POST",
                data: formData,
                processData: false, // impede o jQuery de converter em querystring
                contentType: false, // impede jQuery de setar content-type errado
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
                            window.location.href = `/processo/show/${localStorage.getItem('id')}`;
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
            })

        })

        /**
         *
         * Validando formulário do processo #
         *
         *
         */

        function validarCampos() {

            const reclamante = $('#reclamante').val()
            const reclamada = $('#reclamada').val()
            const carga = $('#carga').val()
            const prazo = $('#prazo').val()
            const laudo_judicial = $('#laudo-judicial').val()
            const select_membros = $('#equipe').val()
            var c = 0


            if (reclamante === '') {
                marcarCampoInvalido('reclamante');
                c++
            } else {
                desmarcarCampoInvalido('reclamante');
            }

            if (reclamada === '') {
                marcarCampoInvalido('reclamada');
                c++
            } else {
                desmarcarCampoInvalido('reclamada');
            }

            if (carga === '') {
                marcarCampoInvalido('carga');
                c++
            } else {


                desmarcarCampoInvalido('carga');

            }

            if (prazo === '') {
                marcarCampoInvalido('prazo');
                c++
            } else {
                desmarcarCampoInvalido('prazo');

            }
            if (laudo_judicial === '') {
                marcarCampoInvalido('laudo-judicial');
                c++
            } else {
                    desmarcarCampoInvalido('laudo-judicial');
            }

            if (select_membros === '') {
                marcarCampoInvalido('equipe');
                c++
            } else {
                desmarcarCampoInvalido('equipe');
            }

            if (c > 0) {
                return false
            } else {
                return true;
            }
        }

        function marcarCampoInvalido(campoId) {
            // Adiciona uma borda vermelha ao campo com o ID fornecido
            var minhaDiv = campoId + "_div"
            $('#' + minhaDiv).addClass("text-danger");
        }

        function desmarcarCampoInvalido(campoId) {

            var minhaDiv = campoId + "_div"
            $('#' + minhaDiv).removeClass("text-danger");
        }



        /**
         * UPDATE DO PROCESSO
         *
         *
         */

        $("#form-processo").on("submit", function (e) {
            e.preventDefault() // evita o envio normal do form

            var validade = validarCampos()
            if (validade == false) {
                Swal.fire(
                    `OPS !!!`,
                    'PREENCHA OS CAMPOS OBRIGATÓRIO!',
                    'error'
                )
                return false;
            }

            let actionUrl = '/processo/update' + location.search
            let form = $(this)[0] // pega o form "puro"
            let formData = new FormData(form)



            $.ajax({
                url: actionUrl,
                type: "POST",
                data: formData,
                processData: false, // impede o jQuery de converter em querystring
                contentType: false, // impede jQuery de setar content-type errado
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
        /***
         * EXCLUSÕES
         *
         */

        //Exclusão de esclarecimento
        $(document).on('click', '#deleteEsclarecimento', function (e) {


            e.preventDefault(); // evita o envio normal do form

            var esclarecimentoId = $(this).data('esclarecimento-id');
            var carga = $(this).data('esclarecimento-carga');

            Swal.fire({
                icon: "question",
                title: "Alerta!",
                text: `Deseja excluir o esclarecimento de carga em ${carga} ?`,
                showDenyButton: true,
                confirmButtonText: "Sim, excluir!",
                denyButtonText: "Não",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/processo/esclarecimento/delete/${esclarecimentoId}` + location.search,
                        type: 'GET',
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Sucesso!",
                                text: response.message ?? "Esclarecimento excluído com sucesso!",
                            })

                            window.location.href = `/processo/show/${localStorage.getItem('id')}`;


                        },
                        error: function (error) {
                            Swal.fire({
                                type: 'error',
                                title: 'OPS!',
                                text: `${error.message}`
                            })
                        }
                    });

                } else if (result.isDenied) {
                    // Redireciona para a lista de equipe
                }
            })
        })
        //Exclusão de Pagamento
        $(document).on('click', '#deletePagamento', function (e) {

            e.preventDefault(); // evita o envio normal do form

            var pagamentoId = $(this).data('pagamento-id');
            var valor = $(this).data('pagamento-valor');

            Swal.fire({
                icon: "question",
                title: "Alerta!",
                text: `Deseja excluir o pagamento de R$ ${valor} ?`,
                showDenyButton: true,
                confirmButtonText: "Sim, excluir!",
                denyButtonText: "Não",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/processo/pagamento/delete/${pagamentoId}` + location.search,
                        type: 'GET',
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Sucesso!",
                                text: response.message ?? "Pagamento excluído com sucesso!",
                            })

                            window.location.href = `/processo/show/${localStorage.getItem('id')}`;


                        },
                        error: function (error) {
                            Swal.fire({
                                type: 'error',
                                title: 'OPS!',
                                text: `${error.message}`
                            })
                        }
                    });

                } else if (result.isDenied) {
                    // Redireciona para a lista de equipe
                }
            })
        })

        //Esclusão de Erro de Execução
        $(document).on('click', '#delete-erro', function (e) {

            e.preventDefault(); // evita o envio normal do form
            console.log("entro")
            var erroId = $(this).data('erro-execucao-id');
            var tipoErro = $(this).data('tipo-erro');

            Swal.fire({
                icon: "question",
                title: "Alerta!",
                text: `Deseja excluir o erro de execução do tipo ${tipoErro} ?`,
                showDenyButton: true,
                confirmButtonText: "Sim, excluir!",
                denyButtonText: "Não",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/processo/erro-execucao/delete/${erroId}` + location.search,
                        type: 'GET',
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Sucesso!",
                                text: response.message ?? "Erro de Execução excluído com sucesso!",
                            })
                            window.location.href = `/processo/show/${localStorage.getItem('id')}`;
                        },
                        error: function (error) {
                            Swal.fire({
                                type: 'error',
                                title: 'OPS!',
                                text: `${error.message}`
                            })
                        }
                    });

                } else if (result.isDenied) {
                    // Redireciona para a lista de equipe
                }
            })
        })



    </script>
@endsection