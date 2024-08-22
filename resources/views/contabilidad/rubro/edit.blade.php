<x-app-layout>
    <x-slot:title>
        Editar Rubro
        </x-slot>
        <x-slot:subtitle>
            </x-slot>

            <div class="container mt-4">
                <form action="{{ route('contabilidad.rubros.update', $rubro->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="rubro" class="form-label">Rubro</label>
                        <input type="text" class="form-control" id="rubro" name="rubro" value="{{ $rubro->rubro }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="signo" class="form-label">Signo</label>
                        <select class="form-control" id="signo" name="signo" required>
                            <option value="+" {{ $rubro->signo == '+' ? 'selected' : '' }}>+</option>
                            <option value="-" {{ $rubro->signo == '-' ? 'selected' : '' }}>-</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
</x-app-layout>