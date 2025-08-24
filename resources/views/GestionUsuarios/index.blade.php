<x-app-layout>
    <x-slot:title>
        Gestión de usuarios
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configuración</li>
            <li class="breadcrumb-item active" aria-current="page">Gestión de usuarios</li>
        </ol>
    </div>

    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 mt-3 text-end">
        <a class="btn btn-primary mb-2" style="color:white;" href="{{ route('GestionUsuarios.create') }}">
            <i class="fas fa-user-plus"></i> Nuevo Usuario
        </a>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Usuarios</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Empresa</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Intentos</th>
                            <th>Bloqueado hasta</th>
                            <th class="text-center"><i class="fas fa-eye"></i></th>
                            <th class="text-center"><i class="fas fa-edit"></i></th>
                            <th class="text-center"><i class="fas fa-ban"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id_usuario }}</td>
                                <td>{{ $usuario->usuario_login }}</td>
                                <td>{{ $usuario->correo }}</td>
                                <td>{{ $usuario->empresa->nombre_empresa ?? '—' }}</td>
                                <td>{{ $usuario->rol->nombre_rol ?? '—' }}</td>
                                <td>
                                    @if($usuario->estado)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td>{{ $usuario->intentos_fallidos }}</td>
                                <td>{{ $usuario->bloqueado_hasta ?? '—' }}</td>

                                <!-- Ver detalle (bitácora) -->
                                <td class="text-center">
                                    <a href="{{ route('GestionUsuarios.show', $usuario->id_usuario) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>

                                <!-- Editar datos -->
                                <td class="text-center">
                                    <a href="{{ route('GestionUsuarios.edit', $usuario->id_usuario) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>

                                <!-- Activar/Desactivar -->
                                <td class="text-center">
                                    <form action="{{ route('GestionUsuarios.toggleEstado', $usuario->id_usuario) }}" method="GET">
                                        @if($usuario->estado)
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desactivar usuario?')">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('¿Activar usuario?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
