
@php
    $user = Auth::user();
    
@endphp

@if ($user->hasPermissionTo('rrhh.empresa')||$user->hasPermissionTo('rrhh.area')||$user->hasPermissionTo('rrhh.departamento')
||$user->hasPermissionTo('rrhh.periodoPlanilla')
||$user->hasPermissionTo('rrhh.incapacidades')
||$user->hasPermissionTo('rrhh.permisos')
||$user->hasPermissionTo('rrhh.cargos')
||$user->hasPermissionTo('rrhh.apf')
||$user->hasPermissionTo('rrhh.ingresos')
)
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
    
    @if ($user->hasPermissionTo('rrhh.empresa'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('rrhh.empresa.index') }}">Empresas</a></li>
        </ul>
    </div>
    @endif
    @if ($user->hasPermissionTo('rrhh.area'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link" href="{{ route('rrhh.area.index') }}">Areas</a>
            </li>
        </ul>
    </div>
    @endif
    @if ($user->hasPermissionTo('rrhh.departamento'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('rrhh.departamento.index') }}">Departamentos</a>
            </li>
        </ul>
    </div>
    @endif

    @if ($user->hasPermissionTo('rrhh.empleado'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('rrhh.empleado.index') }}">Empleados</a>
            </li>
        </ul>
    </div>
    @endif

    @if ($user->hasPermissionTo('rrhh.periodoPlanilla'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('rrhh.periodoPlanilla.index') }}">Periodos Planillas</a></li>
        </ul>
    </div>
    @endif

    @if ($user->hasPermissionTo('rrhh.incapacidades'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('rrhh.obtenerIncapacidades') }}">Incapacidades</a></li>
        </ul>
    </div>
    @endif

    @if ($user->hasPermissionTo('rrhh.permisos'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('rrhh.permisos.index') }}">Permisos</a></li>
        </ul>
    </div>
    @endif

    @if ($user->hasPermissionTo('rrhh.cargos'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('rrhh.puesto.index') }}">Puestos</a></li>
        </ul>
    </div>
@endif

@if ($user->hasPermissionTo('rrhh.apf'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link" href="{{ route('rrhh.afp.index') }}">AFP</a>
            </li>
        </ul>
    </div>
@endif

@if ($user->hasPermissionTo('rrhh.ingresos'))
    <div id="submenu-rrhh" class="submenu submenu-rrhh collapse " data-bs-parent="#menu-accordion"
        style="">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link"
                    href="{{ route('rrhh.ingreso.index') }}">Ingresos</a></li>
        </ul>
    </div>
</li>
@endif
@endif