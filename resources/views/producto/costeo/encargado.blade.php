<div class="card">
    <div class="card-header">
        <h3 class="card-title">      Generalidades</h3>
        <div class="card-toolbar">

        </div>
    </div>

    <div class="card-body">
       <form action="">
        <div class="row">
            <div class="col-md-6">
                <label for="">Encargado</label>
                <select name="" id="" class="form-control">
                    @foreach ($usuarios as $u)
                        <option  @if ($completa->operativo==$u->id)
                            selected
                        @endif value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <p>Cotización: {{ $inicial->codigo_cotizacion  }}
                    <br>Tipo de cotización: {{ $completa->servicio->nombre_servicio }} <br>
                   Cliente: {{ $completa->cliente->nombre_cliente }}</p>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
        </div>
       </form>
    </div>
</div>
