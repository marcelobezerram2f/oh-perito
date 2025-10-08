<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>OH - Perito Contábil Judicial @yield('title')</title>

    <meta name="robots" content="nofollow, noindex" />
    <meta name="author" content="M2F Soluções Web ">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts and Styles -->
    @yield('css_before')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/codebase.css') }}">


    @yield('css_after')

</head>

<body class="bg-gray">
    <div id="page-container"
        class="sidebar-o enable-page-overlay side-scroll page-header-modern page-header-fixed enable-cookies">
        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Header -->
            <div class="content-header content-header-fullrow">
                <div class="content-header-section align-parent">
                    <!-- Close Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout"
                        data-action="side_overlay_close">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                    <!-- END Close Side Overlay -->

                    <!-- User Info -->
                    <div class="content-header-item">
                        <a class="img-link mr-5" href="javascript:void(0)">
                            @if (is_null(Auth::user()->avatar))
                                <img class="img-avatar img-avatar32" src="{{asset('media\avatars\avatar15.jpg')}}" alt="">
                            @else
                                <img class="img-avatar img-avatar64" src="{{ asset(Auth::user()->avatar) }}" alt="Avatar">
                            @endif
                        </a>



                        <a class="align-middle link-effect text-primary-dark font-w600" href="javascript:void(0)"></a>
                    </div>
                    <!-- END User Info -->
                </div>
            </div>
            <!-- END Side Header -->


        </aside>
        <!-- END Side Overlay -->

        <!-- Sidebar -->
        <!--
                Helper classes

                Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

                Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
                Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
                    - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
            -->
        <nav id="sidebar">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow px-15">
                    <!-- Mini Mode -->
                    <div class="content-header-section sidebar-mini-visible-b">
                        <!-- Logo -->
                        <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                            <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                        </span>
                        <!-- END Logo -->
                    </div>
                    <!-- END Mini Mode -->

                    <!-- Normal Mode -->
                    <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r"
                            data-toggle="layout" data-action="sidebar_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Sidebar -->

                        <!-- Logo -->
                        <a class="link-effect font-w700" href="index.php">
                            <img src="{{ asset('images/oh_logo.png') }}" width="80px" alt="">
                        </a>
                        <!-- END Logo -->
                    </div>
                    <!-- END Normal Mode -->
                </div>
                <!-- END Side Header -->

                <!-- Side User -->
                <div class="content-side content-side-full content-side-user px-10 align-parent mt-20">
                    <!-- Visible only in mini mode -->
                    <div class="sidebar-mini-visible-b align-v animated fadeIn">
                        <img data-target="#novaFoto" data-toggle="modal" class="img-avatar img-avatar64" src="" alt="">
                    </div>
                    <!-- END Visible only in mini mode -->

                    <!-- Visible only in normal mode -->
                    <div class="sidebar-mini-hidden-b text-center">
                        <a class="img-link" href="/profile">
                            @if (is_null(Auth::user()->avatar))
                                <img class="img-avatar img-avatar64" src="{{asset('media\avatars\avatar0.jpg')}}" alt="">
                            @else
                                <img class="img-avatar img-avatar64" src="{{ asset(Auth::user()->avatar) }}" alt="Avatar">
                            @endif


                        </a>

                        <ul class="list-inline mt-10">
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark font-size-xs font-w600"
                                    href="#">{{Auth::user()->name}}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Visible only in normal mode -->
                </div>
                <!-- END Side User -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li>
                            <a href="/">
                                <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="/processos">
                                <i class="si si-folder-alt"></i><span class="sidebar-mini-hide">Processos</span>
                            </a>
                        </li>
                        <li>
                            <a href="/pagamentos">
                                <i class="si si-wallet"></i><span class="sidebar-mini-hide">Pagamentos</span>
                            </a>
                        </li>

                        <li>
                            <a href="/equipe">
                                <i class="si si-users"></i><span class="sidebar-mini-hide">Equipe</span>
                            </a>
                        </li>




                        <li>
                            <a class="{{ request()->is('sair') ? ' active' : '' }}" href="{{ route('logout') }}">
                                <i class="si si-logout"></i><span class="sidebar-mini-hide">Sair</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- END Side Navigation -->



            </div>
            <!-- Sidebar Content -->

        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="content-header-section">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                    <!-- END Toggle Sidebar -->

                    <!-- Open Search Section -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->

                    <!-- END Open Search Section -->

                    <!-- Layout Options (used just for demonstration) -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-circle btn-dual-secondary"
                            id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu min-width-300" aria-labelledby="page-header-options-dropdown">
                            <h5 class="h6 text-center py-10 mb-10 border-b text-uppercase">Configurações</h5>
                            <h6 class="dropdown-header">Cor de Fundo</h6>
                            <div class="row no-gutters text-center mb-5">
                                <div class="col-2 mb-5">
                                    <a class="text-gray" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-black" data-toggle="theme" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-warning" data-toggle="theme" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-pulse" data-toggle="theme" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-flat" data-toggle="theme" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-corporate" data-toggle="theme" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-earth" data-toggle="theme" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END Layout Options -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="content-header-section">
                    <!-- Notifications -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-flag"></i>
                            <span class="badge badge-danger badge-pill" id="qtd_due"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-300"
                            aria-labelledby="page-header-notifications">
                            <h5 class="h6 text-center py-10 mb-0 border-b text-uppercase">Notificações</h5>
                            <ul class="list-unstyled my-20" id="notify-due">


                            </ul>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-center mb-0" href="/processos">
                                <i class="fa fa-flag mr-5"></i> Ver todas
                            </a>
                        </div>
                    </div>
                    <!-- END Notifications -->

                    <!-- Toggle Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->

                    <!-- END Toggle Side Overlay -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header">
                <div class="content-header content-header-fullrow">
                    <form action="/dashboard" method="POST">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <!-- Close Search Section -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <button type="button" class="btn btn-secondary" data-toggle="layout"
                                    data-action="header_search_off">
                                    <i class="fa fa-times"></i>
                                </button>
                                <!-- END Close Search Section -->
                            </div>
                            <input type="text" class="form-control" placeholder="Search or hit ESC.."
                                id="page-header-search-input" name="page-header-search-input">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="content-header content-header-fullrow text-center">
                    <div class="content-header-item">
                        <i class="fa fa-sun-o fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container" class="">
            @yield('content')
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="opacity-0">
            <div class="content py-20 font-size-xs clearfix">

                <div class="float-left">
                    <a class="font-w600" href="#" target="_blank">M2F Soluçoes</a> &copy;
                    <span class="js-year-copy"></span>
                </div>
            </div>
        </footer>
        <!-- END Footer -->


    </div>
    <!-- END Page Container -->

    <!-- Codebase Core JS -->
    <script src="{{ asset('js/codebase.app.js') }}"></script>

    <!-- Laravel Scaffolding JS -->
    <script src="{{ asset('js/laravel.app.js') }}"></script>

    <script>
        // ACIONANDO E INCORPORANDO O ARQUIVO DE HELP


    </script>

    @yield('js_after')
</body>

<script>


    $(document).ready(function () {
        let bg = {!! Auth::user() !!}
        document.getElementById("main-container").style.backgroundColor = bg.background;
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Mapeamento das cores que você quer aplicar
        const cores = {
            "text-gray": "#e0e0e0",
            "text-black": "#000000",
            "text-warning": "#FFCA28",
            "text-pulse": "#E74C3C",
            "text-flat": "#70B29C",
            "text-corporate": "#2FACB2",
            "text-earth": "#6EAB4D"
        };

        // Seleciona todos os <a> dentro do menu de cores
        const botoesCores = document.querySelectorAll('.dropdown-menu .row a');

        botoesCores.forEach(btn => {
            btn.addEventListener("click", function () {
                // Descobre a classe usada (ex.: text-gray, text-elegance, etc.)
                const classes = this.classList;
                for (let c in cores) {
                    if (classes.contains(c)) {
                        // Aplica no elemento principal
                        document.getElementById("main-container").style.backgroundColor = cores[c];
                        saveBackgroud(cores[c])
                    }
                }
            });
        });


    });

    function saveBackgroud(cor) {
        let actionUrl = '/user/change-background';
        let formData = new FormData();
        formData.append('user_id', {{ Auth::user()->id }})
        formData.append('background', cor)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            url: actionUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json"

        })
    }


    $.ajax({
        url: `/processo/getByDue` + location.search,
        type: 'GET',
        success: function (response) {
            tableDue = ''
            $("#qtd_due").html(response.length);
            response.forEach(function (processo) {
                if (processo.dias == 4) {
                    var dias = `<span class="text-primary mr-5 mb-5 w600">${processo.dias} dias</span>`
                    var li = '<li>'
                } else if (processo.dias == 3) {
                    var dias = `<span class="text-info mr-5 mb-5">${processo.dias} dias</span>`
                    var li = '<li>'

                } else if (processo.dias == 2) {
                    var dias = `<span class=" text-warning mr-5 mb-5">${processo.dias} dias</span>`
                    var li = '<li>'

                } else if (processo.dias == 1) {
                    var dias = `<span class="text-danger mr-5 mb-5 w600">${processo.dias} dia</span>`
                    var li = '<li>'

                } else if (processo.dias == 5) {
                    var dias = `<span class="text-secondary mr-5 mb-5">${processo.dias} dias</span>`
                    var li = '<li>'

                }
                else if (processo.dias == 0) {
                    var dias = `<span class="btn btn-danger mr-5 mb-5">Hoje</span>`
                    var li = '<li>'

                } else if (processo.dias < 0) {
                    var dias = `<span class="text-danger mr-5 mb-5">${processo.dias} dias</span>`
                    var li = '<li style="background:#FFEEBF">'

                }
                tableDue = `${li}
                                    <a class="text-body-color-dark media mb-15" href="/processo/show/${processo.id}">
                                        <div class="ml-5 mr-15">
                                            <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                        </div>
                                        <div class="media-body pr-10">
                                            <p class="mb-0">Processo número <strong>${processo.numero_processo} </strong> com prazo de entrega vencendo em ${dias} (${processo.prazo}}), responsável : <strong> ${processo.calculista} <strong>  !</p>

                                        </div>
                                    </a>
                                </li>
                                `
                $('#notify-due').append(tableDue);
            });

        },
        error: function (error) {
            var errorMessage = error.responseJSON?.message || 'Erro desconhecido';
            Swal.fire({
                icon: "error",
                title: 'OPS!',
                customClass: {
                    confirmButton: "btn btn-danger"
                },
                text: errorMessage.toLocaleUpperCase(),
                confirmButtonText: "OK"
            });
        }
    });

</script>

</html>