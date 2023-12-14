<x-slot name="head">
    <link rel="stylesheet" href="{{ asset('libs/swiper/swiper-bundle.min.css') }}">
</x-slot>
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- topnav - hamburger -->

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->

            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" @if( isset(Auth::user()->profile_photo_path) && Auth::user()->profile_photo_path != 'cover.jpg') src="{{ asset('storage/user/covers') }}/{{ Auth::user()->profile_photo_path }}" @else src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" @endif
                                alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->name}}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ Auth::user()->roles->pluck('name')[0] ?? '' }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Bienvenido</h6>
                        <a class="dropdown-item" href="{{route('profile.show')}}"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Perfil</span></a>
                         <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                        @csrf
                                    </form>
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" data-key="t-logout">Cerrar sesión</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">

                <a href="{{ url('dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('images/ICATEBCS_logo.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('images/ICATEBCS.png')}}" alt="" height="44">
                    </span>
                </a>

                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span>Inicio</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Route::is('dashboard') ? 'active' : ''}}"  style="background: {{ Route::is('dashboard') ? '#4c66ba' : ''}};" href="/" role="button" >
                                <i class="ri-dashboard-2-fill"></i> <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->

                        @can('Consultar estudiantes')
                            <li class="menu-title"><span>Capacitandos</span></li>

                            <li class="nav-item">
                                <a href="{{ url('student') }}" class="nav-link menu-link {{ Route::is('student.*') ? 'active' : ''}}"  role="button"  style="background: {{ Route::is('student.*') ? '#4c66ba' : ''}};">
                                    <i class="ri-folder-user-fill"></i> <span>Capacitandos</span>
                                </a>
                            </li>
                        @endcan

                        @if(auth()->user()->can('Consultar permisos') || auth()->user()->can('Consultar usuarios'))
                            <li class="menu-title"><i class="ri-more-fill"></i> <span >Roles y usuarios</span></li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#collapseUsersAndRoles" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Route::is('profile.*')||Route::is('user.*')) ? 'true' : 'false'}}" aria-controls="sidebarLayouts">
                                    <i class="mdi mdi-view-carousel-outline"></i> <span data-key="t-layouts">Roles y usuarios</span>
                                </a>
                                <div class="menu-dropdown collapse {{ (Route::is('profile.*')||Route::is('user.*')) ? 'show' : ''}}" id="collapseUsersAndRoles">
                                    <ul class="nav nav-sm flex-column">
                                        @can('Consultar permisos')
                                        <li class="nav-item">
                                            <a href="{{ url('profile') }}" class="nav-link menu-link {{ Route::is('profile.*') ? 'active' : ''}}"  role="button"  style="background: {{ Route::is('profile.*') ? '#4c66ba' : ''}};">
                                                <i class="ri-account-circle-fill"></i> Perfiles
                                            </a>
                                        </li>
                                        @endcan
                                        @can('Consultar usuarios')
                                        <li class="nav-item">
                                            <a href="{{ url('user') }}" class="nav-link menu-link {{ Route::is('user.*') ? 'active' : ''}}" role="button" style="background: {{ Route::is('user.*') ? '#4c66ba' : ''}};">
                                                <i class=" ri-user-fill"></i> Usuarios
                                            </a>
                                        </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if(auth()->user()->can('Consultar centros') || auth()->user()->can('Consultar lugares'))
                            <li class="menu-title"><i class="ri-more-fill"></i> <span>Centros de trabajo</span></li>
                        @endif

                        @can('Consultar centros')
                            <li class="nav-item">
                                <a href="{{ url('center') }}" class="nav-link menu-link {{ Route::is('center.*') ? 'active' : ''}}" role="button" style="background: {{ Route::is('center.*') ? '#4c66ba' : ''}};">
                                    <i class="ri-government-fill"></i> <span>Centros</span>
                                </a>
                            </li>
                        @endcan

                        @can('Consultar lugares')
                            <li class="nav-item">
                                <a href="{{ url('place') }}" class="nav-link menu-link {{ Route::is('place.*') ? 'active' : ''}}" role="button" style="background: {{ Route::is('place.*') ? '#4c66ba' : ''}};">
                                    <i class="ri-map-pin-fill"></i> <span>Lugares</span>
                                </a>
                            </li>
                        @endcan

                        @if(auth()->user()->can('Consultar instructores') || auth()->user()->can('Consultar cursos') || auth()->user()->can('Consultar campos de formación'))
                            <li class="menu-title"><i class="ri-more-fill"></i> <span>Académico</span></li>
                        @endif

                        @can('Consultar instructores')
                            <li class="nav-item">
                                <a href="{{ url('instructor') }}" class="nav-link menu-link {{ Route::is('instructor.*') ? 'active' : ''}}" role="button" style="background: {{ Route::is('instructor.*') ? '#4c66ba' : ''}};">
                                    <i class=" ri-user-2-fill"></i> <span>Instructores</span>
                                </a>
                            </li>
                        @endcan

                        @can('Consultar cursos')
                            <li class="nav-item"> <!-- implementar ruta dashboard cuando este disponible -->
                                <a href="{{ route('course.index') }}" class="nav-link menu-link {{ Route::is('course.*') ? 'active' : ''}}" role="button" style="background: {{ Route::is('course.*') ? '#4c66ba' : ''}};">
                                    <i class="ri-book-2-fill"></i> <span>Cursos</span>
                                </a>
                            </li>
                        @endcan

                        @can('Consultar grupos')
                            <li class="nav-item">
                                <a href="{{ route('group.index') }}" class="nav-link menu-link {{ Route::is('group.*') ? 'active' : ''}}"  role="button"  style="background: {{ Route::is('group.*') ? '#4c66ba' : ''}};">
                                    <i class="ri-group-2-fill"></i> <span>Grupos</span>
                                </a>
                            </li>
                        @endcan

                        @can('Consultar campos de formación')
                            <li class="nav-item">
                                <a href="{{ url('training-field') }}" class="nav-link menu-link {{ Route::is('training-field.*') ? 'active' : ''}}" role="button" style="background: {{ Route::is('training-field.*') ? '#4c66ba' : ''}};">
                                    <i class="ri-briefcase-4-fill"></i> <span>Campos de formación profesional</span>
                                </a>
                            </li>
                        @endcan

                        <li class="menu-title"><i class="ri-more-fill"></i><span>Reportes</span></li>
                        <li class="nav-item">
                            <a href="{{ url('reports/download') }}" class="nav-link menu-link {{ Route::is('reports.*') ? 'active' : ''}}" role="button" style="background: {{ Route::is('reports.*') ? '#4c66ba' : ''}};">
                                <i class="ri-file-download-fill"></i> <span>Descargar reportes</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <div class="vertical-overlay"></div>
        <x-slot name="scripts">
            <!-- App js -->
        </x-slot>



