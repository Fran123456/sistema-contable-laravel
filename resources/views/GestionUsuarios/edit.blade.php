<x-app-layout>
    <x-slot:title>
        Editar Usuario
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('GestionUsuarios.index') }}">Gestión de usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </div>

    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Editar Usuario</h5>

                <form action="{{ route('GestionUsuarios.update', $usuario->id_usuario) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Nombre completo</label>
                            <input type="text" name="nombre_completo" value="{{ $usuario->nombre_completo }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Correo</label>
                            <input type="email" name="correo" value="{{ $usuario->correo }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Usuario</label>
                            <input type="text" name="usuario_login" value="{{ $usuario->usuario_login }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Nueva Contraseña (opcional)</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>Rol</label>
                            <select name="rol_id" class="form-control" required>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id_rol }}" {{ $usuario->rol_id == $rol->id_rol ? 'selected' : '' }}>
                                        {{ $rol->nombre_rol }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Empresa</label>
                            <select name="empresa_id" class="form-control" required>
                                @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->id }}" {{ $usuario->empresa_id == $empresa->id ? 'selected' : '' }}>
                                        {{ $empresa->nombre_empresa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Estado</label>
                            <select name="estado" class="form-control">
                                <option value="1" {{ $usuario->estado ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ !$usuario->estado ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <a href="{{ route('GestionUsuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
