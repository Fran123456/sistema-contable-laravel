<form action="{{ route('contabilidad.utilidades.store') }}" method="POST">
    @csrf
    <h3>Crear utilidad</h3>
    <div class="form-group">
        <label for="utilidad">Utilidad</label>
        <input type="text" class="form-control" id="utilidad" name="utilidad" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2 text-white">Guardar</button>
</form>