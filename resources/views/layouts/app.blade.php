<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @toastr_css

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">
        <!-- Datatable CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

        <style>
            p.label-error>strong{color: tomato;}
            .loader {
                border: 16px solid #f3f3f3; /* Light grey */
                border-top: 16px solid #3498db; /* Blue */
                border-radius: 50%;
                width: 120px;
                height: 120px;
                animation: spin 2s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            select[readonly] {
                background: #eee;
                pointer-events: none;
                touch-action: none;
            }

            .custom-file-input:lang(en) ~ .custom-file-label::after {
                content: "Buscar";
            }
        </style>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ mix('js/dashboard.js') }}" defer></script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed font-sans antialiased">
        <div class="wrapper">

            @livewire('navigation-menu')

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-warning elevation-2">
                <!-- Brand Logo -->
                <a href="/" class="brand-link">
                    <x-jet-application-mark width="36" class="brand-image img-circle elevation-1" style="opacity: .8" />
                    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="image">
                                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-1" alt="{{ Auth::user()->name }}">
                            </div>
                        @endif
                        <div class="info">
                            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                            @if (Auth::user()->hasRole("admin"))
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-cog green"></i>
                                    {{ __('Administração') }} <i class="right fa fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('users') }}" class="nav-link"><i class="nav-icon fa fa-users fa-fw" aria-hidden="true"></i> {{ __('Usuários') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('roles') }}" class="nav-link"><i class="nav-icon fa fa-user fa-fw" aria-hidden="true"></i> {{ __('Tipos de Usuários') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('permissions') }}" class="nav-link"><i class="nav-icon fa fa-lock fa-fw" aria-hidden="true"></i> {{ __('Permissões') }}</a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            <!-- Other Routes -->
                            <li class="nav-item">
                                <a href="{{ route('lost-dogs') }}" class="nav-link"><i class="nav-icon fa fa-dog fa-fw"></i> {{ __('Cachorros Perdidos') }}</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('found-dogs') }}" class="nav-link"><i class="nav-icon fa fa-check fa-fw"></i> {{ __('Meus Encontrados') }}</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('my-dogs') }}" class="nav-link"><i class="nav-icon fa fa-dog fa-fw"></i> {{ __('Meus Cachorros') }}</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->

            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col">
                                <h1>{{ $header }}</h1>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                {{ $slot }}
                            </div>

                            @if (isset($aside))
                                <div class="col-lg-3">
                                    {{ $aside }}
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b><a href="https://jetstream.laravel.com">Jetstream</a></b>
                </div>
                <strong>Powered by</strong> <a href="https://adminlte.io">AdminLTE</a>
            </footer>
        </div>

        @jquery
        @toastr_js
        @toastr_render
        @stack('modals')
        @livewireScripts
        @stack('scripts')

        <script async type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
        <script async src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js" integrity="sha512-VpQwrlvKqJHKtIvpL8Zv6819FkTJyE1DoVNH0L2RLn8hUPjRjkS/bCYurZs0DX9Ybwu9oHRHdBZR9fESaq8Z8A==" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
                $('.carousel').carousel();
                $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
                $(".money").inputmask('decimal', {
                    'alias': 'numeric',
                    'groupSeparator': '',
                    'autoGroup': true,
                    'digits': 2,
                    'radixPoint': ",",
                    'digitsOptional': false,
                    'allowMinus': false,
                    'prefix': 'R$ ',
                    'placeholder': ''
                });
                $(".money").css("text-align", "left");
            });
        </script>
    </body>
</html>
