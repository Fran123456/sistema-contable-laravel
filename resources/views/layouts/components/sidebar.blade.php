<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
        <li class="nav-item">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="nav-icon">
                    <i class="fas fa-home"></i>
                </span>
                <span class="nav-link-text">Dashboard</span>
            </a>
            <!--//nav-link-->
        </li>
        <!--//nav-item-->

        <!--//nav-item-->
        <li class="nav-item">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <a class="nav-link" href="{{ route('users.index') }}">
                <span class="nav-icon">
                    <i class="fas fa-users"></i>
                </span>
                <span class="nav-link-text">Usuarios</span>
            </a>
            <!--//nav-link-->
        </li>
        <!--//nav-item-->
    </ul>
    <!--//app-menu-->
</nav>