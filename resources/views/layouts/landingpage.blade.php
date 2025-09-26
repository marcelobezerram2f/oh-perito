<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    
    <title>Atitude Agenda</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistema para prestadores de serviços">
    <meta name="keywords" content=", agenda, serviços, cabelereiro, sistema, fisioterapeuta, Mobile, iOS, Android">
    
    <meta name="author" content="SoftWork Comércio e Serviços de Informática Ltda">
    
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ mix('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ mix('images/favicon.ico') }}" type="image/x-icon">
    
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ mix('site/icon/icofont/css/icofont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ mix('site/site.css') }}">

    @yield('style')
    
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

    <!-- Header Start -->
    <div class="container" id="top-header">
        <div class="row">
            <div class="col-sm-6 col-xs-5" style="padding: 15px">
                <a href="{{ route('home') }}" class="p-5">
                    <img src="{{asset('imagens/logoSF_horiz.png')}}" class="img-fluid">
                </a>
            </div>
            <div class="col-sm-6 col-xs-7">
                <ul class="socials-icon pull-right">
                    <li>
                        <a href="https://www.facebook.com/atitudeagenda" target="_blank">
                            <i class="icofont icofont-social-facebook"></i>
                        </a>
                    </li>
                    <li>
                        {{-- <a href="#!">
                            <i class="icofont icofont-social-instagram"></i>
                        </a> --}}
                    </li>

                    <li class="nav-item mt-4">
                        <a href="{{route('login')}}" class="badge">
                            <i class="icofont icofont-user-alt-2"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Header End -->

    @yield('content')

    <div class="copyright">
        <h5 class="text-center">SoftWork Comércio e Serviços de Informática Ltda - Copyright © 2019. Todos os direitos
            reservados.</h5>
    </div>

    <a class="waves-effect waves-light scrollup scrollup-icon"><i class="icofont icofont-arrow-up "></i></a>
    <script src="{{ mix('site/site.js')}}"></script>

    <script>
        $(window).on('load', function () {
            $('#pre-loader').fadeOut('slow');
        });

    </script>
    <script>
        $("#navigation").menumaker({
            title: "",
            format: "multitoggle"
        });

    </script>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158878751-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-158878751-1');

    </script>
    
</body>

</html>
