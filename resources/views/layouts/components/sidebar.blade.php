<style>
    .app-nav .nav-link {
    display: block;
    padding: 0.475rem 0.5rem;
    color: #252930;
    position: relative;
    display: block;
    padding-left: 3rem;
    border-left: 3px solid rgba(0,0,0,0);
}
</style>

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
            <a class="nav-link" href="{{ route('roles.index') }}">
                <span class="nav-icon">
                    <i class="fas fa-user-shield"></i>
                </span>
                <span class="nav-link-text">Roles</span>
            </a>
            <!--//nav-link-->
        </li>
        <!--//nav-item-->
    </ul>
    <!--//app-menu-->
</nav>