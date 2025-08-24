<x-app-layout>
    <x-slot:title>
        Detalle de Usuario
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('GestionUsuarios.index') }}">Gestión de usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalle</li>
        </ol>
    </div>

    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <h5>Información del Usuario</h5>
                <p><b>Nombre:</b> {{ $usuario->nombre_completo }}</p>
                <p><b>Usuario:</b> {{ $usuario->usuario_login }}</p>
                <p><b>Correo:</b> {{ $usuario->correo }}</p>
                <p><b>Rol:</b> {{ $usuario->rol->nombre_rol ?? '—' }}</p>
                <p><b>Empresa:</b> {{ $usuario->empresa->nombre_empresa ?? '—' }}</p>
                <p><b>Estado:</b> {!! $usuario->estado ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>' !!}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>Bitácora de Accesos</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>IP</th>
                            <th>Módulo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bitacora as $log)
                            <tr>
                                <td>{{ $log->fecha_acceso }}</td>
                                <td>{{ $log->ip }}</td>
                                <td>{{ $log->modulo }}</td>
                                <td>{{ $log->accion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
