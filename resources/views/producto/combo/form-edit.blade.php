<form action="{{ route('productocombos.update', $data->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-sm-3">
            <label for="" class="control-label">Código: </label>
            <input @if ($validate)
            disabled
        @endif type="text" name="codigo" readonly value="{{ $data?->codigo }}" class="form-control"
                placeholder="Ingrese el codigo" required autofocus
                 />
        </div>
        <div class="form-group col-sm-6">
            <label for="" class="control-label">Nombre del combo: </label>
            <input @if ($validate)
            disabled
        @endif type="text" name="nombre" value="{{ $data?->combo }}" class="form-control"
                placeholder="Ingrese el nombre del combo" required autofocus
                />
        </div>
        <div class="form-group col-sm-3">
            <label for="" class="control-label">Estado: </label>
            <select @if ($validate)
            disabled
        @endif name="estado" class="form-control" id="">
                @if ($data?->estado==1)
                <option value="1" selected>SI</option>
                <option value="0">NO</option>
                @else 
                <option value="1" >SI</option>
                <option value="0" selected>NO</option>
                @endif

            </select>
        </div>
        <!--<div class="form-group col-sm-2">
            <label for="" class="control-label">Precio asignado: </label>
            <input  @if ($data?->combo != null) disabled @endif  required name="valor_asignado" id="miinput" 
            value="{{ $data?->precio }}" type="number" class="form-control">
        </div>-->
        <div class="col-md-12">
            <button  type="submit" @if ($validate)
                disabled
            @endif  class="btn btn-primary mt-2">
                Editar</button>
        </div>
        
     
    </div>
</form>