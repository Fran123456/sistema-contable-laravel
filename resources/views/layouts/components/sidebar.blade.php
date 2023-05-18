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
            @if (Help::usuario()->empresa_id != null)
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

            <a class="nav-link" href="{{ route('contabilidad.periodos.index') }}">
                <span class="nav-icon">
                    <i class="fas fa-user-shield"></i>
                </span>
                <span class="nav-link-text">Periodo Contable</span>
            </a>

            <a class="nav-link" href="{{ route('contabilidad.tipos-de-partida.index') }}">
                <span class="nav-icon">
                    <i class="fas fa-user-shield"></i>
                </span>
                <span class="nav-link-text">Tipos de partida</span>
            </a>

             <a class="nav-link" href="{{ route('contabilidad.cuentas-contables.index') }}">
                <span class="nav-icon">
                    <i class="fas fa-user-shield"></i>
                </span>
                <span class="nav-link-text">Cuentas contables</span>
            </a>

            <a class="nav-link" href="{{ route('rrhh.empresa.index') }}">
                <span class="nav-icon">
                    <i class="fas fa-user-shield"></i>
                </span>
                <span class="nav-link-text">Empresas</span>
            </a>

            <a class="nav-link" href="{{ route('contabilidad.copiar-data') }}">
                <span class="nav-icon">
                    <i class="fas fa-user-shield"></i>
                </span>
                <span class="nav-link-text">Data</span>
            </a>
            @endif

            
            <!--//nav-link-->
        </li>
        <!--//nav-item-->
    </ul>
    <!--//app-menu-->
</nav>