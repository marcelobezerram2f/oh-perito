@extends('layouts.codebase.index-page')

@section('title') - Calculistas
@endsection
@section('css_after')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/sweetalert2/sweetalert2.min.css') }}" />
@endsection

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Calculistas ( Edição )</h3>

            </div>
            <div class="block-content pb-6 ">

                <form class="form-horizontal " id="form-tecnico" autocomplete="off">
                    {{ csrf_field() }}
            </div>
            <div class="form-group row pl-4 pr-4">
                <div class="row col-lg-8">

                </div>
                <div class="col-lg-8 mt-2">
                    <label class="form-control-label">Nome:</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" name="nome" autofocus="autofocus" id="nome" required />
                </div>

                <div class="col-lg-4 mt-2">
                    <label class="form-control-label">Telefone:</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" data-mask="(00) 0000-0000" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Banco:</label>
                    <input type="text" class="form-control" name="banco" id="banco" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Agencia</label>
                    <input type="text" class="form-control" name="agencia" id="agencia" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Conta Corrente</label>
                    <input type="text" class="form-control" name="conta_corrente" id="conta_corrente" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Chave PIX</label>
                    <input type="text" class="form-control" name="chave_pix" id="chave_pix" />
                </div>

                <div class="col-lg-8 mt-2">
                    <label class="form-control-label">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" required />
                </div>

                <div class="col-lg-4 mt-2">
                    <label class="form-control-label">Situação:</label>
                    <select class="form-control" name="ativo" id="ativo" required>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function () {


            // Pega a URL atual
            var url = window.location.href
            // Divide a URL pelos '/' e pega o último elemento
            var parse = url.split('/')
            var id = parse.pop() || parse.pop() // Remove elementos vazios no final, se houver
            console.log(id)
            $.ajax({
                url: `/equipe/getById/${id}` + location.search,
                type: 'GET',
                success: function (response) {
                    //response.forEach(membro) {
                    $('#id').val(response.id)
                    $('#nome').val(response.nome)
                    $('#telefone').val(response.telefone)
                    $('#banco').val(response.banco)
                    $('#agencia').val(response.agencia)
                    $('#conta_corrente').val(response.conta_corrente)
                    $('#chave_pix').val(response.chave_pix)
                    $('#email').val(response.email)
                    $('#ativo').val(response.ativo)
                    $('#ativo').trigger('change')
                    //}
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


            $("#form-tecnico").on("submit", function (e) {
                e.preventDefault(); // evita o envio normal do form
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let form = $(this);
                let actionUrl = '/equipe/update'
                let formData = form.serialize();

                $.ajax({
                    url: actionUrl,
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: 'OK!',
                            confirmButtonText: 'ok!',
                            text: `${response.message.toLocaleUpperCase()}`,
                            icon: 'success',
                            customClass: {
                                confirmButton: "btn btn-info"
                            },
                            confirmButtonText: "OK"
                        })
                    },
                    error: function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'OPS!',
                            text: `${error.responseJSON.message.toUpperCase()}`,
                            customClass: {
                                confirmButton: "btn btn-danger"
                            },
                            confirmButtonText: "OK"
                        })

                    }
                });
            });
        });
    </script>

@endsection