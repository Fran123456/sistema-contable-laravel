
@if ($campo->tipo =="date")
    <div class="col-md-12 mt-2">
        <label for="">{{ $campo->label }}</label>
        <input type="{{ $campo->tipo }}" class="form-control"  name="{{ $campo->name }}">
    </div>
@endif

