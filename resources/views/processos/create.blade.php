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
                        data-mask="9999999-99.9999.9.99.9999" required />
                </div>

                <div class="col-lg-2 mt-2">
                    <label class="form-control-label">Vara:</label>
                    <input type="text" class="form-control" name="vara" />
                </div>

                <div class="col-lg-2 mt-2">
                    <label class="form-control-label">Mês/Ano:</label>
                    <input type="month" class="form-control" name="mes_ano">
                </div>
                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Reclamante:</label>
                    <input type="text" class="form-control" name="reclamante" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Documento Reclamante :</label>
                    <input type="text" class="form-control" name="doc_reclamante" data-mask="999.999.999-99" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Reclamado :</label>
                    <input type="text" class="form-control" name="reclamada" />
                </div>
                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Documento Reclamado :</label>
                    <input type="text" class="form-control" name="doc_reclamada" data-mask="999.999.999/9999-99"/>
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Carga :</label>
                    <input type="date" class="form-control" name="carga" placeholder="dd-mm-yyyy" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Prazo:</label>
                    <input type="date" class="form-control" name="prazo" placeholder="dd-mm-yyyy" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Entrega Laudo Judicial:</label>
                    <input type="date" class="form-control" name="laudo_judicial" placeholder="dd-mm-yyyy" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Calculista:</label>
                    <Select class="form-control" name="equipe_id" id="select-membros">
                    </Select>
                </div>
                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Honorário:</label>
                    <input type="text"  name="honorario" id="honorario" class="form-control" placeholder="0,00" oninput="mascaraMoeda(this)">
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
                    <button type="button" class="btn btn-alt-warning btn150" onclick="location.href='/equipe'"><i
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
            $("#form-processo").on("submit", function (e) {
                e.preventDefault(); // evita o envio normal do form
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let form = $(this);
                let actionUrl = '/processo/store';
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
                            confirmButtonText: "Novo membro",
                            denyButtonText: "Voltar para lista",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Limpa o formulário para novo cadastro
                                $("#form-tecnico")[0].reset();
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
        });


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
    </script>
@endsection