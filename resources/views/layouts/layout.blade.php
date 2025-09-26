<!DOCTYPE html>
<html lang="pt-Br">
<head>
<!-- Favicon icon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('imagens/IconeAA.ico') }}">
<link rel="icon" href="{{ asset('imagens/IconeAA.ico') }}" type="image/x-icon">

<link rel="stylesheet" type="text/css" href="{{ asset('css/meucss.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
@stack('header')
</head>
<body class="fundo">
    <div class="fixed-top" style="background-color: #252d30">
    <nav class="navbar navbar-expand-lg">
                <a href="{{ route('dashboard.index') }}" class="navbar-brand t1 text-white">
                    <img src="{{ asset('imagens/logo_AA.png') }}" alt="Atitude Agenda" data-toggle="tooltip" title="Atitude Agenda, sua agenda com muito mais atitude. Clique para voltar ao início.">
                </a>
    
                <button class="navbar-toggler navbar-dark" data-toggle="collapse" data-target="#navbarMenu">
                    <span style="color : white"><span class="navbar-toggler-icon"></span></span>
                </button>
    
                <div class="navbar-collapse collapse justify-content-end" id="navbarMenu">
    
                    <div>
    
                        <ul class="navbar-nav mr-auto">
                            
                        <li class="nav-item ml-1">
                                <a class="nav-link nav-link rounded text-white bg-padrao pl-3 pr-3"
                                    href="{{ route('dashboard.index') }}"><i class="fa fa-home icone"></i>Início</a>
                            </li>
                            <li class="nav-item ml-1">
                                <a class="nav-link nav-link rounded text-white bg-padrao pl-3 pr-3"
                                    href="{{ route('agendas.index') }}"><i class="fa fa-calendar icone"></i>Agenda</a>
                            </li>
                           
    
                            <li class="nav-item dropdown ml-1">
                                <a class="nav-link dropdown-toggle rounded text-white bg-padrao pl-3 pr-3" href="#"
                                    id="navCadastro" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-users icone"></i>Cadastros
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navCadastro">
                                    <a class="dropdown-item" href="{{ route('pessoas.index') }}"><i class="fa fa-street-view icone"></i>Clientes / Fornecedores</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('servicos.index') }}"><i class="fa fa-hand-peace-o icone"></i>Serviços</a>
                                    <a class="dropdown-item" href="{{ route('pacotes.index') }}"><i class="fa fa-gift icone"></i>Pacotes de Serviços</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown ml-1">
                                <a class="nav-link dropdown-toggle rounded text-white bg-padrao pl-3 pr-3" href="#"
                                    id="navFinanceiro" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-dollar icone"></i>Comercial
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navFinanceiro">
                                    <a class="dropdown-item" href="{{ route('pedidos.index') }}"><i class="fa fa-money icone"></i>Pedidos</a>
                                    <a class="dropdown-item" href="{{ route('contas-pagar.index') }}"><i class="fa fa-credit-card icone"></i>Contas a
                                        Pagar</a>
                                    <div class="dropdown-divider"></div>
    
                                    
                                    <div class="dropdown-divider"></div>
                                   
                                </div>
                            </li>
    
                            <li class="nav-item dropdown ml-1">
                                <a class="nav-link dropdown-toggle rounded text-white bg-padrao pl-3 pr-3" href="#"
                                    id="navFinanceiro" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-line-chart icone"></i>Financeiro
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navFinanceiro">
                                    <a class="dropdown-item" href="{{ route('contas-receber.index') }}"><i class="fa fa-money icone"></i>Contas a
                                        Receber</a>
                                    <a class="dropdown-item" href="{{ route('contas-pagar.index') }}"><i class="fa fa-credit-card icone"></i>Contas a
                                        Pagar</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route ('totalizador.index') }}"><i class="fa fa-object-group icone"></i>Consolidação de Contas</a>
    
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('categorias.index') }}"><i class="fa fa-sitemap icone"></i>Categorias e Sub
                                        Categorias</a>
    
                                </div>
                            </li>
    
                            <li class="nav-item dropdown ml-1">
                                <a class="nav-link dropdown-toggle rounded text-white bg-padrao pl-3 pr-3" href="#"
                                    id="navUsuario" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-user icone"></i><span
                                        class="text-capitalize">{{ Auth::user()->Nome }}</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navUsuario">
                                    <a class="dropdown-item" href="{{ route('parametros.index') }}"><i class="fa fa-cogs icone"></i>Configurações</a>
    
                                    <a class="dropdown-item" href="{{ route('usuarios.index') }}"><i class="fa fa-user icone"></i>Usuários</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('minhaconta.index') }}"><i class="fa fa-info-circle icone"></i>Minha
                                        Conta</a>
                                    <a class="dropdown-item" href="{{ route('tickets.index') }}"><i class="fa fa-tags icone"></i>Meus Tickets</a>
    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('faq.index')}}"><i class="fa fa-commenting-o icone"></i>FAQ e Dicas Importantes</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout')}}"><i class="fa fa-power-off icone"></i> Sair</a>
    
                                </div>
                            </li>
    
                        </ul>
    
                    </div>
                </div>
            </nav>
        <div class="container">
     
        </div>
    </div>

    @yield('content')
    
    <div class="fixed-bottom bg-dark">
        <div class="container">
            <div class="row">
                <div class="col pt-1 pb-1">
                    <span class="text-verde">SoftWork &#174;</span>
                </div>
                <div class="col-8 text-right pt-1 pb-1">
                    <a href="https://api.whatsapp.com/send?phone=5511992335132" target="_blank">
                        <span class="text-verde"><i class="fa fa-whatsapp icone"></i>(11) 9 9233 5132</a>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.js') }}"></script>
         <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    @stack('importJs')

    @stack('scriptJs')


</body>
</html>


