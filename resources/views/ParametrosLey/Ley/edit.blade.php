<x-app-layout>
    <x-slot:title>
        Editar Parametro de Ley
    </x-slot>

    <x-slot:subtitle>
        Modificar los datos del parametro seleccionado
    </x-slot>

    <form action="{{ route('ParametrosLey.Ley.update', $parametro->$id_parametro) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Valor</label>
            <input type="number" step="0.0001" name="valor" class="form-control" value="{{ $parametro->valor }}">
        </div>

        <div class="mb-3">
            <label>Fecha inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ $parametro->fecha_inicio }}">
        </div>

        <div class="mb-3">
            <label>Fecha fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="{{ $parametro->fecha_fin }}">
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="from-control">
                <option value="vigente" {{ $parametro->estado == 'vigente' ? 'selected' : '' }}>Vigente</option>
                <option value="vencido" {{ $parametro->estado == 'vencido' ? 'selected' : '' }}>Vencido</option>
            </select>
        </div>

        <button class="btn btn-primaty">Actualizar</button>
        <a href="{{ route ('ParametrosLey.Ley.index') }}" class="bt btn-secondary">Cancelar</a>
    </form>
        
</x-app-layout>