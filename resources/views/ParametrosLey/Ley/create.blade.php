<x-app-layout>
    <x-slot:title>
        Agregar nuevo paramtero de ley
    </x-slot>
    <x-slot:subtitle>
        Crear un nuevo parametro para la empresa activa
    </x-slot>

    <form action="{{ route('ParametrosLey.Ley.store') }}" method="POST">
        @csrf
        <input type="hidden" name="empresa_id" value="{{ Hepl::users()->empresa_id }}">
        <div class="mb-3">
            <label>Tipo</label>
            <select name="tipo" class="form-control">
                @foreach(['ISSS','AFP','ISPFA','ISSS_PENSIONES','ISR','HORAS_EXTRA','INCAPACIDADES', TOPE_INDEMIZACION] as $tipo)
                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>
        </div> 
        
        <div class="mb-3">
            <label>Fecha inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control">
                <option value="vigente">Vigente</option>
                <option value="vencido">Vencido</option>
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('ParametrosLey.Ley.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</x-app-layout>