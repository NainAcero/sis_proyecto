<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title') </title>

        <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" />
        <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('assets/js/loader.js') }}"></script>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{ asset('fonts/line-awesome/css/line-awesome.min.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.css') }}">
        <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/elements/infobox.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/flatpickr/material_dark.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/elements/color_library.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <!-- SECCIÓN PARA INCLUÍR ESTILOS PERSONALIZADOS EN LOS MÓDULOS DEL SISTEMA -->
        @yield('styles')

        <!-- NECESARIO PARA EL FUNCIONAMIENTO DE LIVEWIRE -->
        @livewireStyles

    </head>

    <body class="alt-menu sidebar-noneoverflow">
        <audio class="my_audio" preload="none">
            <source src="{{ asset('audio/notification.mp3') }}" type="audio/mpeg">
        </audio>
        <!-- BEGIN LOADER -->
        <div id="load_screen">
            <div class="loader">
                <div class="loader-content">
                    <div class="spinner-grow align-self-center"></div>
                </div>
            </div>
        </div>
        <!-- END LOADER -->

        <!-- BEGIN NAVBAR -->
        <div class="header-container">
            <header class="header navbar navbar-expand-sm">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-menu">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </a>

                <div class="nav-logo align-self-center">
                    <a class="navbar-brand" href="">
                        <span class="navbar-brand-name">SIS_REGISTRO</span>
                    </a>
                </div>

                <ul class="navbar-item flex-row mr-auto">
                    <li class="nav-item align-self-center search-animated">
                        <form class="form-inline search-full form-inline search" role="search">
                            <div class="search-bar">
                                <input type="text" class="form-control search-form-control  ml-lg-auto"
                                    placeholder="Buscar...">
                            </div>
                        </form>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-search toggle-search">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </li>
                </ul>
            </header>
        </div>
        <!-- END NAVBAR -->

        <!-- BEGIN MAIN CONTAINER -->
        <div class="main-container" id="container">
            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!-- BEGIN TOPBAR -->
            <div class="topbar-nav header navbar" role="banner">
                <nav id="topbar">
                    <ul class="navbar-nav theme-brand flex-row  text-center">
                        <li class="nav-item theme-logo">
                            <a href="index.html">
                                <img src="assets/img/90x90.jpg" class="navbar-logo" alt="logo">
                            </a>
                        </li>
                    </ul>

                    <ul class="list-unstyled menu-categories" id="topAccordion">
                        <li class="menu single-menu">
                            <a href="{{ url('/') }}" >
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    <span>GARANTIA</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu single-menu">
                            <a href="{{ url('proforma') }}" >
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    <span>PROFORMA</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- END TOPBAR -->

            <!-- BEGIN CONTENT PART -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">
                    @yield('content')
                </div>

                <div class="ml-3 mr-3">
                    @include('footer.footer')
                </div>
            </div>
            <!-- END CONTENT PART -->
        </div>
        <!-- END MAIN CONTAINER -->

        <!-- SCRIPTS GENERALES -->
        <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <script>
            $(document).ready(function() {
                App.init();

                $(".flatpickr").flatpickr({
                    enableTime: false,
                    dateFormat: "d-m-Y",
                    'locale': 'es'
                });
            });

            $(".my_audio").trigger('load');

            function play_audio(task) {
                if(task == 'play'){
                    $(".my_audio").trigger('play');
                }
                if(task == 'stop'){
                    $(".my_audio").trigger('pause');
                    $(".my_audio").prop("currentTime",0);
                }
            }

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('ade16b6321e09e989e2c', {
                cluster: 'us2',
                forceTLS: true
            });

            var channel = pusher.subscribe('new-channel');

            channel.bind('new-event', function(data) {
                console.log(data.mensaje)
                if(data.mensaje =="new-registro") {
                    window.location.reload();
                } else if(data.mensaje == "notification") {
                    toastr.success('info', 'Salio Producto...')
                    setTimeout(function(){ play_audio("play"); }, 100);
                    setTimeout(function(){ window.location.reload(); }, 1000);
                }
            });
        </script>

        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr_es.js') }}"></script>

        <!-- SECCIÓN PARA INCLUÍR SCRIPTS PERSONALIZADOS EN LOS MÓDULOS DEL SISTEMA -->
        @yield('scripts')

        <!-- SCRIPTS PARA LOS MENSAJES Y NOTIFICACIONES -->
        <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

        <!-- VALIDACIONES GLOBALES DEL SISTEMA -->


        <!-- NECESARIO PARA EL FUNCIONAMIENTO DE LIVEWIRE -->
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="{{ asset('js/toast.js') }}"> </script>


        <script>
            window.livewire.on('msgok', msgOK => {
                toastr.success(msgOK, "info");
            });

            window.livewire.on('msg-error', msgError => {
                toastr.error(msgError, "error");
            });

            window.livewire.on('msg-ops', msgOK => {
                toastr.warning(msgOK, "info");
            });
        </script>
    </body>
</html>
