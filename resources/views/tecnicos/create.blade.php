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
                <h3 class="block-title">Calculistas ( Novo )</h3>

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
                    <input type="text" class="form-control" name="nome" autofocus="autofocus" required />
                </div>

                <div class="col-lg-4 mt-2">
                    <label class="form-control-label">Telefone:</label>
                    <input type="text" class="form-control" name="telefone" data-mask="(00) 0000-0000" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Banco:</label>
                    <input type="text" class="form-control" name="banco" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Agencia</label>
                    <input type="text" class="form-control" name="agencia" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Conta Corrente</label>
                    <input type="text" class="form-control" name="conta_corrente" />
                </div>

                <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Chave PIX</label>
                    <input type="text" class="form-control" name="chave_pix" />
                </div>


                <div class="col-lg-8 mt-2">
                    <label class="form-control-label">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{old('email')}}" required />
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
            $("#form-tecnico").on("submit", function (e) {
                console.log("teste")
                e.preventDefault(); // evita o envio normal do form
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let form = $(this);
                let actionUrl = '/equipe/store';
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
                                window.location.href = "/equipe";
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
    </script>

@endsection