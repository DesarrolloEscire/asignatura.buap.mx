<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CreaECO') }}</title>

    <!-- Favicons -->
    <link rel="mask-icon" href="{{ asset('img/ico/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{ asset('img/ico/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <style>
        .blue-text {
            color: #003b5c;
        }

        .header-section {
            width: 100%;
            padding: 5px !important;
            margin: 0px;
        }

        .logotipo-container,
        .text-container,
        .options-container {
            display: flex;
        }

        .text-container>h3 {
            margin: auto;
        }

        .logotipo-container>img {
            height: 80px;
            width: auto;
            margin: auto;
            margin-left: 0px;
        }

        .topbar {
            height: auto !important;
        }

        #dropdown-profile-image {
            min-width: 22rem !important;

        }

        .dropdown-menu-header-inner {
            background: #16aaff !important;
        }

    </style>

    <style>
        .btn-focus {
            color: #fff;
            background-color: #444054;
            border-color: #444054;
        }

        .btn-pill {
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
            border-top-right-radius: 50px;
            border-bottom-right-radius: 50px;
        }

    </style>

    @livewireStyles


    <script src="{{ asset('/js/manifest.js') }}"></script>
    <script src="{{ asset('/js/vendor.js') }}" defer></script>
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}" defer></script>
</head>

<body id="page-top">

    @stack('modals')

    @include('vendor.modals.opinion')
    @include('vendor.modals.user-manual')


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #26a1dc">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('') }}"
                style="margin: 30px 0px">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/logo.png?202205311031') }}" alt="" width="100px">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Mi espacio
            </div>

            <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Educación continua</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menú:</h6>
                        <a class="collapse-item text-wrap" href="{{ route('continuing-education.show') }}">Asentar acreditación Cursos Cortos Prácticos</a>
                        
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-card d-none d-lg-flex">
                <img class="img-fluid" src="{{ asset('img/logo-white.png') }}" alt="...">
            </div>

            <div class="sidebar-card d-none d-lg-flex">
                <img class="img-fluid" src="{{ asset('img/logoDES.png?2022-03-29') }}" alt="...">
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar">
                    <!-- Sidebar Toggle (Topbar) -->
                    <!-- <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button> -->

                    <!-- Topbar Navbar -->
                    <div class="row header-section bg-white">
                        <div class="col-6 col-md-2 logotipo-container">
                            <img src="{{ asset('/img/dashboard/others/dashboard-logo.png') }}" alt="">
                        </div>
                        <div class="col-md-8 d-none d-md-block text-container">
                            @if (str_contains(\Request::url(), 'dashboard'))
                                <h4 class="text-center blue-text">
                                    Bienvenida/o al Ecosistema de Aprendizaje Abierto BUAP
                                </h4>
                            @else
                                @yield('header')
                            @endif
                        </div>
                        <div class="col-6 col-md-2 options-container">
                            <ul class="navbar-nav ml-auto">
                                <div class="topbar-divider"></div>
                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="img-profile rounded-circle"
                                            src="{{ asset('img/undraw_profile.svg') }}">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div id="dropdown-profile-image"
                                        class="dropdown-menu dropdown-menu-right shadow animated--grow-in pt-0 border-0 rounded"
                                        aria-labelledby="userDropdown">
                                        <div class="dropdown-menu-header-inner py-3 px-2"
                                            style="border-radius: 6px 6px 0px 0px">
                                            <div class="text-white">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img class="img-fluid"
                                                            src="{{ asset('images/default/avatars/profile.jpg') }}"
                                                            alt="" style="border-radius: 50%;">
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="text-wrap d-flex h-100">
                                                            <div class="justify-content-center align-self-center">
                                                                <b class="text-uppercase">{{ strtoupper(Auth::user()->name) }}
                                                                </b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="text-wrap d-flex h-100">
                                                            <div class="justify-content-center align-self-center">
                                                                <a class="btn btn-sm btn-focus btn-pill shadow-sm"
                                                                    href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                    <small>Cerrar sesión</small>
                                                                </a>
                                                                <form id="logout-form" action="{{ route('logout') }}"
                                                                    method="POST" class="d-none">
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider m-0"></div>
                                        <div>
                                            <div class="p-2">
                                                <div class="p-2">
                                                    <i class="fas fa-envelope"></i>
                                                    {{ auth()->user()->email }}
                                                </div>
                                                <div for="" class="text-uppercase p-2">
                                                    <b><small>MI CUENTA</small></b>
                                                </div>
                                                <div for="" class="p-2">
                                                    <a class="text-muted"
                                                        href="{{ external_route('users.account.edit') }}"
                                                        style="text-decoration: none">
                                                        <i class="fas fa-tools"></i>
                                                        Configuración
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        {{--  --}}

                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="col-12 d-md-none text-container">
                            @if (str_contains(\Request::url(), 'dashboard'))
                                <h4 class="text-center blue-text">
                                    Bienvenida/o al Ecosistema de Aprendizaje Abierto BUAP
                                </h4>
                            @else
                                @yield('header')
                            @endif
                        </div>
                    </div>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <main class="container-fluid py-2" data-aos-duration="500">
                    {{ $slot }}
                </main>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>{{ getenv('APP_NAME', 'eScire') }} 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded">
        <i class="fas fa-angle-up"></i>
    </a>

    @stack('scripts')

    <script>
        window.onload = function() {
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })

            AOS.init()
        };

        $(window).scroll(function() {
            $('.scroll-to-top').css('display', $(this).scrollTop() >= ($(window).height() - 200) ? 'inline' :
                'none');
        });

        $(document).on('click', '.scroll-to-top', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    @include('sweetalert::alert')

    @livewireScripts

    <script type="text/javascript">
        (function(global) {
            global.$_Tawk_AccountKey = '6193e7d26885f60a50bc1574';
            global.$_Tawk_WidgetId = '1fkks33nr';
            global.$_Tawk_Unstable = false;
            global.$_Tawk = global.$_Tawk || {};
            (function(w) {
                function l() {
                    if (window.$_Tawk.init !== undefined) {
                        return;
                    }

                    window.$_Tawk.init = true;

                    var files = [
                        'https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-main.js',
                        'https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-vendor.js',
                        'https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-chunk-vendors.js',
                        'https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-chunk-common.js',
                        'https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-runtime.js',
                        'https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-app.js'
                    ];

                    if (typeof Promise === 'undefined') {
                        files.unshift('https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-promise-polyfill.js');
                    }

                    if (typeof Symbol === 'undefined' || typeof Symbol.iterator === 'undefined') {
                        files.unshift(
                        'https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-iterator-polyfill.js');
                    }

                    if (typeof Object.entries === 'undefined') {
                        files.unshift('https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-entries-polyfill.js');
                    }

                    if (!window.crypto) {
                        window.crypto = window.msCrypto;
                    }

                    if (typeof Event !== 'function') {
                        files.unshift('https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-event-polyfill.js');
                    }

                    if (!Object.values) {
                        files.unshift(
                            'https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-object-values-polyfill.js');
                    }

                    if (typeof Array.prototype.find === 'undefined') {
                        files.unshift(
                        'https://embed.tawk.to/_s/v4/app/62835fee0eb/js/twk-arr-find-polyfill.js');
                    }

                    var s0 = document.getElementsByTagName('script')[0];

                    for (var i = 0; i < files.length; i++) {
                        var s1 = document.createElement('script');
                        s1.src = files[i];
                        s1.charset = 'UTF-8';
                        s1.setAttribute('crossorigin', '*');
                        s0.parentNode.insertBefore(s1, s0);
                    }
                }
                if (document.readyState === 'complete') {
                    l();
                } else if (w.attachEvent) {
                    w.attachEvent('onload', l);
                } else {
                    w.addEventListener('load', l, false);
                }
            })(window);

        })(window);

    </script>

</body>

</html>
