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
                <h3 class="block-title">Profile ( Edição )</h3>

            </div>
            <div class="block-content pb-4 ">
                <div class="col-8">
                    <form id="form-profile" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="col-8">
                                <label for="contact1-firstname">Nome</label>
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ Auth::user()->name }}">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="contact1-email">Email</label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ Auth::user()->email}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-envelope-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="contact1-subject">Nova Senha</label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new-password" name="new_password"
                                        autocomplete="new-password">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="contact1-subject">Confirm Nova Senha</label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="re-password" name="re_password"
                                        value="">

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12" for="contact1-subject">Avatar</label>
                            <div class="col-6">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-folder-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group ml-4" id="img-avatar">
                                    @if (is_null(Auth::user()->avatar))
                                        <img class="img-avatar img-avatar128 " src="{{asset('media\avatars\avatar0.jpg')}}" alt="">
                                    @else
                                        <img class="img-avatar img-avatar128"  src="{{ Auth::user()->avatar }}"
                                            alt="">
                                    @endif
                                </div>
                                <div class="input-group mt-2 ml-4 text-center">
                                    <input type="hidden" name="delete_avatar" id="delete_avatar">
                                    <button type="button" class="btn btn-alt-info" id="del-avatar">
                                        Excluir Imagem</button>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="col">
                                    <button type="button" class="btn btn-alt-warning btn150" onclick="location.href='/'"><i
                                            class="fa fa-chevron-left"></i>
                                        Voltar</button>
                                    <button type="reset" class="btn btn-alt-info"><i class="fa fa-broom"></i>
                                        Limpar</button>
                                    <button type="submit" class="btn btn-alt-success" value="Gravar">
                                        <span><i class="fa fa-check"></i> Gravar</span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>

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

            $("#del-avatar").on("click", function (e) {
                e.preventDefault()
                var imgAvatar = `<img class="img-avatar img-avatar128 " src='media/\avatars/\avatar0.jpg' alt="">`
                $("#img-avatar").html(imgAvatar)
                $("#delete_avatar").val("X")
            })



            $(document).ready(function () {
                $("#form-profile").on("submit", function (e) {
                    e.preventDefault(); // evita o envio normal do form

                    const newPassword = document.getElementById("new-password").value.trim();
                    const rePassword = document.getElementById("re-password").value.trim();

                    if (newPassword !== "") {
                        if (newPassword !== rePassword) {
                            Swal.fire({
                                icon: "error",
                                title: "Erro!",
                                text: "As senhas digitadas não coincidem.",
                                confirmButtonText: "Fechar"
                            });
                            return; // sai da função
                        }
                    }

                    let form = $(this)[0]; // pega o form "puro"
                    let formData = new FormData(form);

                    $.ajax({
                        url: "/user/update",
                        type: "POST",
                        data: formData,
                        processData: false, // impede o jQuery de converter em querystring
                        contentType: false, // impede jQuery de setar content-type errado
                        dataType: "json",
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Sucesso!",
                                text: response.message ?? "Dados do usuário alterado com sucesso!",
                                showDenyButton: true,
                                confirmButtonText: "Manter nessa página",
                                denyButtonText: "Retornar",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "/profile";
                                } else if (result.isDenied) {
                                    window.location.href = "/";
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

            })

        </script>
    @endsection