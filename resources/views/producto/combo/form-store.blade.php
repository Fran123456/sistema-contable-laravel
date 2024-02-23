<form action="{{ route('productocombos.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-sm-4">
            <label for="" class="control-label">Código: </label>
            <input type="text" name="codigo" value="{{ $data?->codigo }}" class="form-control"
                placeholder="Ingrese el codigo" required autofocus
                @if ($data?->codigo != null) readonly @endif />
        </div>
        <div class="form-group col-sm-5">
            <label for="" class="control-label">Nombre del combo: </label>
            <input type="text" name="nombre" value="{{ $data?->combo }}" class="form-control"
                placeholder="Ingrese el nombre del combo" required autofocus
                @if ($data?->combo != null) readonly @endif />
        </div>
        <div class="form-group col-sm-3">
            <label for="" class="control-label">Estado: </label>
            <select @if ($data?->combo != null) disabled @endif name="estado" class="form-select" id="">
                <option value="1">Habilitado</option>
                <option value="0">Deshabilitado</option>
            </select>
        </div>

        <!--<div class="form-group col-sm-5">
            <label for="" class="control-label">Calcular precio en base a los precios de productos?: </label>
            <select id="estado" onchange="carg(this);" @if ($data?->combo != null) disabled @endif name="calculo" class="form-control" >
                <option value="0">NO</option>
                <option value="1">SI</option>
                
            </select>
        </div>-->

        <!--<div class="form-group col-sm-3">
            <label for="" class="control-label">Precio asignado: </label>
            <input  @if ($data?->combo != null) disabled @endif  required name="valor_asignado" id="miinput" 
            value="{{ $data?->precio }}" type="number" class="form-control">
        </div>-->
        <div class="col-md-12">
            <button @if ($data?->combo != null) disabled @endif type="submit" class="btn btn-primary mt-2">
                <i class='fas fa-check-circle'></i> Guardar</button>
        </div>
        
     
    </div>
</form>

<script>
  /* var input = document.getElementById('miinput');

    function carg(elemento) {
    d = elemento.value;
    
    if(d == "1"){
        input.disabled = true;
        input.value = "";
        input.required = false;
    }else{
        input.disabled = false;
        input.required = true;
    }
    }*/
</script>