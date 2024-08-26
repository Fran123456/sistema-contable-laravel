<li class="nav-item has-submenu">
    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1"
        aria-expanded="true" aria-controls="submenu-1">
        <span class="nav-icon">
            <i class="fas fa-user-shield"></i>

        </span>
        <span class="nav-link-text">Contabilidad</span>
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
    <div id="submenu-1" class="submenu submenu-1 collapse " data-bs-parent="#menu-accordion" style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('contabilidad.periodos.index') }}">Periodos contables</a></li>
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('contabilidad.tipos-de-partida.index') }}">Tipos de partida</a></li>
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('contabilidad.cuentas-contables.index') }}">Catalogo de cuentas</a></li>
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('contabilidad.partidas.index') }}">Partidas contables</a></li>
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('contabilidad.copiar-data') }}">Copiar información</a></li>
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('contabilidad.reportes') }}">Reportes</a></li>
            <li class="submenu-item">
                <a class="submenu-link" href="{{ route('contabilidad.configuracion') }}"> Configuración de contabilidad </a>
            </li>
            <li class="submenu-item">
                <a class="submenu-link" href="{{ route('contabilidad.utilidades.index') }}"> Configuración Estado de resultado</a>
            </li>
            <li class="submenu-item">
                <a class="submenu-link" href="{{ route('contabilidad.rubros.index') }}"> Configuración Balance General</a>
        </ul>
    </div>
</li>