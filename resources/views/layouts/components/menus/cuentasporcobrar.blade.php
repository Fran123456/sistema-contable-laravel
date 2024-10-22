<li class="nav-item has-submenu">
    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-Listar"
        aria-expanded="true" aria-controls="submenu-1">
        <span class="nav-icon">
            <i class="fa-solid fa-users"></i>

        </span>
        <span class="nav-link-text">Cuentas por cobrar</span>
        <span class="submenu-arrow">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                </path>
            </svg>
        </span>
        <!--//submenu-arrow-->
    </a>
    <!--//nav-link-->
    <div id="submenu-Listar" class="submenu submenu-1 collapse " data-bs-parent="#menu-accordion" style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('CuentasPorcobrar.listar-cuentas') }}">Lista Cuentas por cobrar</a></li>
            
        </ul>
    </div>
</li>