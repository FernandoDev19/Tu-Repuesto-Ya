<!DOCTYPE html>
<html lang="es">

<head>
    @include('includes.admin.adminHead')
    @livewireStyles
</head>

<body id="page-top">
    @include('components.alert')

    <div style="position: sticky; top: 0; z-index: 3;">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar static-top" style="z-index: 1;">

            <a class="sidebar-brand d-flex align-items-center justify-content-center mr-3"
                href="{{ route('servicios') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/logo tu repuesto ya/icono_pagina.webp') }}" whith="40" height="40">
                </div>
            </a>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                @can('estadisticasAdmin')
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link" href="{{route('keywords')}}">
                            <i class="fas fa-key fa-fw"></i>
                        </a>
                    </li>
                @endcan


                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        @if (count(auth()->user()->unreadNotifications))
                            <span
                                class="badge badge-danger badge-counter">{{ count(auth()->user()->unreadNotifications) }}</span>
                            </span>
                        @endif
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown" style="max-height: 300px !important; overflow-y: auto;">
                        <h6 class="dropdown-header" style="position: sticky; top: 0;">
                            Notificaciones
                        </h6>
                        @if (auth()->user()->hasRole('Admin'))
                            @can('notifications.viewNotifications')
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('verProveedor', [$notification->data['Nit'], $notification->id]) }}">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                {{ $notification->created_at->diffForHumans() }}</div>
                                            <span class="font-weight-bold">Se ha registrado un nuevo
                                                proveedor!</span>
                                        </div>
                                    </a>
                                @endforeach
                            @endcan
                        @else
                            @can('notifications.viewNotifications')
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('verSolicitudNoti', [$notification->data['idNoti'], $notification->id]) }}">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                {{ $notification->created_at->diffForHumans() }}</div>
                                            <span class="font-weight-bold">Hay nuevas solicitudes de
                                                repuesto!</span>
                                        </div>
                                    </a>
                                @endforeach
                            @endcan
                        @endif
                        <a class="dropdown-item text-center small text-primary"
                            style="position: sticky; bottom: 0; background: white;"
                            href="{{ route('marcarLeidas') }}">Marcar todas como leidas</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter"><!--7--></span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Centro de mensajes
                        </h6>
                        <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                    alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me
                                    with a
                                    problem I've been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                    alt="...">
                                <div class="status-indicator"></div>
                            </div>
                            <div>
                                <div class="text-truncate">I have the photos that you ordered last
                                    month, how
                                    would you like them sent to you?</div>
                                <div class="small text-gray-500">Jae Chun · 1d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                    alt="...">
                                <div class="status-indicator bg-warning"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Last month's report looks great, I am very
                                    happy
                                    with
                                    the progress so far, keep up the good work!</div>
                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle"
                                    src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                    alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because
                                    someone
                                    told me that people say this to all dogs, even if they aren't
                                    good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read
                            More
                            Messages</a>-->
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                        <img class="img-profile rounded-circle" src='{{asset('img/undraw_profile.svg')}}' height="30"
                            width="30">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Perfil
                        </a>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Configuraciones
                        </a>
                        <a class="dropdown-item" href="{{ route('activityLog') }}">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Registro de actividades
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            Cerrar sesión
                        </a>
                    </div>
                </li>

            </ul>

        </nav>

        <hr class="sidebar-divider d-sm-block" style="margin: 0;">

        @yield('sidebar')
        <!-- End of Topbar -->
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column" style="overflow: hidden">
            <!-- Main Content -->
            <div id="content" class="mt-4">
                 @yield('content')
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Milano Rent a Car {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Seguro que deseas cerrar esta sesión?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @livewireScripts
    </div>

</body>

</html>
