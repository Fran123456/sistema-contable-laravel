<style>
    .app-nav .nav-link {
        display: block;
        padding: 0.475rem 0.5rem;
        color: #252930;
        position: relative;
        display: block;
        padding-left: 3rem;
        border-left: 3px solid rgba(0, 0, 0, 0);
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
                <!-- <a class="nav-link" href="{{ route('users.index') }}">
                    <span class="nav-icon">
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="nav-link-text">Usuarios</span>
                </a>-->






        <li class="nav-item has-submenu">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                data-bs-target="#submenu-seguridad" aria-expanded="true" aria-controls="submenu-seguridad">
                <span class="nav-icon">
                    <i class="fas fa-user-shield"></i>

                </span>
                <span class="nav-link-text">Seguridad</span>
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
            <div id="submenu-seguridad" class="submenu submenu-seguridad collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link" href="{{ route('roles.index') }}">Roles y
                            permisos</a></li>
                    <li class="submenu-item"><a class="submenu-link" href="{{ route('users.index') }}">Usuarios</a>
                    </li>
                    <li class="submenu-item"><a class="submenu-link" href="{{ route('logs.index') }}">Logs</a>
                    </li>

                </ul>
            </div>
        </li>




        <li class="nav-item has-submenu">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-rrhh"
                aria-expanded="true" aria-controls="submenu-rrhh">
                <span class="nav-icon">
                    <i class="fas fa-user-shield"></i>

                </span>
                <span class="nav-link-text">RRHH</span>
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
            <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link"
                            href="{{ route('rrhh.empresa.index') }}">Empresas</a></li>
                </ul>
            </div>
            <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link" href="{{ route('rrhh.area.index') }}">Areas</a>
                    </li>
                </ul>
            </div>
            <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link"
                            href="{{ route('rrhh.departamento.index') }}">Departamentos</a>
                    </li>
                </ul>
            </div>

            <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link"
                            href="{{ route('rrhh.empleado.index') }}">Empleados</a>
                    </li>
                </ul>
            </div>

            <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link"
                            href="{{ route('rrhh.periodoPlanilla.index') }}">Periodos Planillas</a></li>
                </ul>
            </div>
            <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion" style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link" href="{{ route('rrhh.obtenerIncapacidades') }}">Incapacidades</a></li>
                </ul>
            </div>
            <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion" style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link" href="{{ route('rrhh.permisos.index') }}">Permisos</a></li>
                </ul>
            </div>


            <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link"
                            href="{{ route('rrhh.puesto.index') }}">Puestos</a></li>
                </ul>
            </div>

            <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item"><a class="submenu-link"
                            href="{{ route('rrhh.afp.index') }}">AFP</a></li>
                </ul>
            </div>
        </li>


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
                </ul>
            </div>
        </li>

        <li class="nav-item has-submenu">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                data-bs-target="#submenu-socios" aria-expanded="true" aria-controls="submenu-socios">
                <span class="nav-icon">
                    <i class="fa-solid fa-users"></i>
                </span>
                <span class="nav-link-text">Socios de negocio</span>
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
            <div id="submenu-socios" class="submenu submenu-socios collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item">
                        <a class="submenu-link" href="{{ route('socios.contacto.index') }}">Contactos</a>
                    </li>
                </ul>
            </div>
            <div id="submenu-socios" class="submenu submenu-socios collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item">
                        <a class="submenu-link" href="{{ route('socios.cargo.index') }}">Cargos</a>
                    </li>
                </ul>
            </div>
            <div id="submenu-socios" class="submenu submenu-socios collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item">
                        <a class="submenu-link" href="{{ route('socios.proveedores.index') }}">Proveedores</a>
                    </li>
                </ul>
            </div>
            <div id="submenu-socios" class="submenu submenu-socios collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item">
                        <a class="submenu-link" href="{{ route('socios.clasificacion.index') }}">Clasificacion de clientes</a>
                    </li>
                </ul>
            </div>
            <div id="submenu-socios" class="submenu submenu-socios collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item">
                        <a class="submenu-link" href="{{ route('socios.cliente.index') }}">Clientes</a>
                    </li>
                </ul>
            </div>
        </li>



        <li class="nav-item has-submenu">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                data-bs-target="#submenu-productos" aria-expanded="true" aria-controls="submenu-productos">
                <span class="nav-icon">
                    <i class="fa-solid fa-users"></i>
                </span>
                <span class="nav-link-text">Productos</span>
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
            <div id="submenu-productos" class="submenu submenu-socios collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item">
                        <a class="submenu-link" href="{{ route('producto.categoria.index') }}">Categorias</a>
                    </li>
                </ul>
            </div>
            <div id="submenu-productos" class="submenu submenu-productos collapse " data-bs-parent="#menu-accordion"
                style="">
                <ul class="submenu-list list-unstyled">
                    <li class="submenu-item">
                        <a class="submenu-link" href="{{ route('producto.producto.index') }}">Productos</a>
                    </li>
                </ul>
            </div>

        </li>
        @endif


        <!--//nav-link-->
        </li>
        <!--//nav-item-->
    </ul>
    <!--//app-menu-->
</nav>
