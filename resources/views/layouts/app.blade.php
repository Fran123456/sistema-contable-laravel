<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $title ?? 'Sistema contable' }}</title>
    <div>{{ $subtitle ?? 'Sistema contable' }}</div>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.ico">
    @vite(['resources/sass/app.scss'])
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/others.css') }}">
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css"
        referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/js/all.min.js" referrerpolicy="no-referrer">
    </script>

    @include('layouts.components.datatable')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>

</head>

<body class="app">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto">
                            <strong> {{ Help::usuario()->empresa->empresa ?? 'No hay empresa asignada' }}</strong>
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>

                        <!--//app-search-box-->

                        <div class="app-utilities col-auto">

                            <!--//teams-->
                            @include('layouts.components.teams')
                            <!--//teams-->

                            <!--//Notificaciones-->
                            @include('layouts.components.notify')
                            <!--//Notificaciones-->


                            <!--//app-utility-item-->
                            @include('layouts.components.settings')
                            <!--//app-utility-item-->

                            <!--//account-->
                            @include('layouts.components.account')
                            <!--//account-->

                        </div>
                        <!--//app-utilities-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-header-inner-->
        <style>
            .app-branding .logo-icon {
                width: 136px;
                height: 136px;
            }
        </style>
        <div id="app-sidepanel" class="app-sidepanel sidepanel-hidden">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding" style="text-align:center">
                    
                    
                    <a class="app-logo" href="{{ route('dashboard') }}"><img style="width: 60px; height: 60px;text-align:center" class="logo-icon me-2"
                        src="{{ asset(Help::getConfigByKey('general', 'logo')?->value) }}" alt="logo"></a>
                    
                    
                    

                </div>
                <!--//app-nav-->
                @include('layouts.components.sidebar')
                <!--//app-nav-->


                <!--//app-sidepanel-footer-->
                @include('layouts.components.sidepanel')
                <!--//app-sidepanel-footer-->
            </div>
            <!--//sidepanel-inner-->
        </div>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="">
                {{ $slot }}
            </div>
        </div>
        <!--//app-content-->
        @include('layouts.components.footer')
    </div>
    <!--//app-wrapper-->
    <!-- Javascript -->
    <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Page Specific JS -->

    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('modals')
    @livewireScripts

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   
</body>

</html>
