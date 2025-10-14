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
                <h3 class="block-title">Processos ( Novo )</h3>

            </div>
            <div class="block-content pb-6 ">

                <form class="form-horizontal " id="form-processo" autocomplete="off">
                    {{ csrf_field() }}
            </div>
            <div class="form-group row pl-4 pr-4">

                <div class="col-lg-6 mt-2">
                    <label class="form-control-label">Numero Processos:</label>
                    <input type="text" class="form-control" name="numero_processo" autofocus="autofocus"
                        data-mask="9999999-99.9999.9.99.9999" />
                </div>

                <div class="col-lg-2 mt-2">
                    <label class="form-control-label">Vara:</label>
                    <input type="text" class="form-control" name="vara" />
                </div>

                <div class="col-lg-2 mt-2">
                    <label class="form-control-label">Mês/Ano:</label>
                    <input type="month" class="form-control" name="mes_ano">
                </div>
                <div class="col-lg-3 mt-2" id="reclamante_div">
                    <label class="form-control-label" id="reclamante_div">Reclamante:</label>
                    <input type="text" class="form-control" name="reclamante" id="reclamante" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Documento Reclamante :</label>
                    <input type="text" class="form-control" name="doc_reclamante" id="doc-reclamante" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label" id="reclamada_div">Reclamado :</label>
                    <input type="text" class="form-control" name="reclamada" id="reclamada" />
                </div>
                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Documento Reclamado :</label>
                    <input type="text" class="form-control" name="doc_reclamada" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label" id="carga_div">Carga :</label>
                    <input type="date" class="form-control" name="carga" id="carga" placeholder="dd-mm-yyyy" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label" id="prazo_div">Prazo:</label>
                    <input type="date" class="form-control" name="prazo" id="prazo" placeholder="dd-mm-yyyy" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label" id="laudo-judicial_div">Entrega Laudo Judicial:</label>
                    <input type="date" class="form-control" id="laudo-judicial" name="laudo_judicial"
                        placeholder="dd-mm-yyyy" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label" id="select-membros_div">Calculista:</label>
                    <Select class="form-control" name="equipe_id" id="select-membros">
                    </Select>
                </div>
                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Honorário:</label>
                    <input type="text" name="honorario" id="honorario" class="form-control" placeholder="0,00"
                        oninput="mascaraMoeda(this)">
                </div>
                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Pago:</label>
                    <Select class="form-control" name="status_pagamento" id="status-pagamento">
                        <option value="0"> Não </option>
                        <option value="1"> Sim </option>
                    </Select>
                </div>
                <div class="col-lg-8 mt-2">
                    <label class="form-control-label">Observações:</label>
                    <textarea type="" class="form-control" name="obervacoes"> </textarea>
                </div>
            </div>
            <hr>
            <hr />

            <div class="form-group row pl-4 pb-4">
                <div class="col">
                    <button type="button" class="btn btn-alt-warning btn150" onclick="location.href='/processos'"><i
                            class="fa fa-chevron-left"></i>
                        Voltar</button>
                    <button type="reset" class="btn btn-alt-info"><i class="fa fa-broom"></i>
                        Limpar</button>
                    <button type="submit" class="btn btn-alt-success" value="Gravar">
                        <span><i class="fa fa-check"></i> Gravar</span>
                    </button>

                </div>
            </div>
            </form>

        </div>
    </div>
@endsection
@section('js_after')
    <!--form validation Custom js-->
    <script src="{{asset('assets/js/codebase.app.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/plugins/masked-inputs/jquery.maskedinput.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
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
            var selectMembros = $('#select-membros');
            selectMembros.append('<option value = "">Selecione...</option>}');

            data.forEach(function (membro) {
                var row = `<option value = ${membro.id}>${membro.nome.toUpperCase()}</option>`;
                selectMembros.append(row);
            });
        }

        $(document).ready(function () {

            $('[data-mask]').each(function () {
                var mask = $(this).attr('data-mask');
                $(this).mask(mask);
            });
        });



        $(document).ready(function () {


            function validarCampos() {

                const reclamante = $('#reclamante').val()
                const reclamada = $('#reclamada').val()
                const carga = $('#carga').val()
                const prazo = $('#prazo').val()


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


            $("#form-processo").on("submit", function (e) {
                e.preventDefault();

                try {
                    const $form = $(this);
                    // --- Proteção extra: console de debug para ver se DataTables quebra algo antes ---
                    // (caso seu arquivo create.js tenha trechos usando DataTables, substitua por safeIsDataTable)

                    // Validação — se falhar, interrompe o envio
                    var validade = validarCampos()
                    if (validade == false) {
                        Swal.fire(
                            `OPS !!!`,
                            'PREENCHA OS CAMPOS OBRIGATÓRIO!',
                            'error'
                        )
                        return false;
                    }

                    // Se chegou aqui, validou — prepara envio
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    const actionUrl = '/processo/store';
                    const formData = $form.serialize();

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
                                confirmButtonText: "Novo processo",
                                denyButtonText: "Voltar para lista",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#form-processo")[0].reset();
                                } else if (result.isDenied) {
                                    window.location.href = "/processos";
                                }
                            });
                        },
                        error: function (xhr) {
                            let msg = "Ocorreu um erro ao processar a requisição.";
                            if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                            Swal.fire({ icon: "error", title: "Erro!", text: msg, confirmButtonText: "Fechar" });
                        }
                    });

                } catch (err) {
                    // captura qualquer erro e impede que o fluxo seja interrompido silenciosamente
                    console.error("Erro no submit handler:", err);
                    Swal.fire({
                        icon: "error",
                        title: "Erro interno",
                        text: `Ocorreu um erro: ${err.message}. Veja o console para detalhes.`
                    });
                    return false;
                }
            });
        })


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

        function aplicarMascara(input) {
            input.addEventListener('input', function () {
                let valor = input.value.replace(/\D/g, ''); // remove tudo que não for número

                // CPF: 11 dígitos
                if (valor.length <= 11) {
                    valor = valor
                        .replace(/^(\d{3})(\d)/, '$1.$2')
                        .replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3')
                        .replace(/\.(\d{3})(\d{1,2})$/, '.$1-$2');
                }
                // Segundo formato: 14 dígitos
                else if (valor.length <= 14) {
                    valor = valor
                        .replace(/^(\d{2})(\d)/, '$1.$2')
                        .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
                        .replace(/^(\d{2})\.(\d{3})\.(\d{2})(\d)/, '$1.$2.$3/$4')
                        .replace(/(\d{4})(\d{2})$/, '$1-$2');
                }
                // Formato desconhecido → sem máscara
                else {
                    valor = input.value.replace(/[^\w\s]/g, '');
                }

                input.value = valor;
            });
        }

    </script>
@endsection