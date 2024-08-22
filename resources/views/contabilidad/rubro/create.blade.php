<x-app-layout>
    <x-slot:title>
        Agregar Rubro
        </x-slot>
        <x-slot:subtitle>
            </x-slot>

            <div class="container mt-4">
                <form action="{{ route('contabilidad.rubros.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="rubro" class="form-label">Rubro</label>
                        <input type="text" class="form-control" id="rubro" name="rubro" required>
                    </div>
                    <div class="mb-3">
                        <label for="signo" class="form-label">Signo</label>
                        <select class="form-control" id="signo" name="signo" required>
                            <option value="+">+</option>
                            <option value="-">-</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
</x-app-layout>