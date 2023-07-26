<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ url('/dashboard') }}">
                    <img class="img-fluid brand-logo" alt="Responsive image"
                        src="{{ asset('app-assets/images/logo/logo.png') }}" width="45px" height="30px">
                    <h2 class="brand-text">Jasa Medika</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ $menu == 'user' ? 'active' : '' }}"><a class="d-flex align-items-center"
                href="{{ url('/user') }}"><i data-feather="user"></i><span class="menu-title text-truncate"
                    data-i18n="Dashboard">User</span></a>
            </li>
            <li class="navigation-header"><span data-i18n="Data Master User">Data Pegawai</span><i
                    data-feather="more-horizontal"></i>
            </li>
            {{-- <li class="nav-item {{ $menu == 'pegawai' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ url('/pegawai') }}"><i data-feather='user'></i><span class="menu-title text-truncate"
                        data-i18n="Data Unit">Pegawai</span></a>
            </li> --}}

        </ul>
    </div>
</div>
