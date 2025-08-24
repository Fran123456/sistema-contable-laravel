<x-app-layout>
    <x-slot:title>
        Nuevo Usuario
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configuración</li>
            <li class="breadcrumb-item"><a href="{{ route('GestionUsuarios.index') }}">Gestión de usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
        </ol>
    </div>

    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Registrar Usuario</h5>

                <form action="{{ route('GestionUsuarios.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Nombre completo</label>
                            <input type="text" name="nombre_completo" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Correo</label>
                            <input type="email" name="correo" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Usuario</label>
                            <input type="text" name="usuario_login" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                            <small class="text-muted">Mínimo 6 caracteres</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        
                        <div class="col-md-3">
                            <label>Rol</label>
                            <select name="rol_id" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id_rol }}">{{ $rol->nombre_rol }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Empresa</label>
                            <select name="empresa_id" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre_empresa }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <a href="{{ route('GestionUsuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
