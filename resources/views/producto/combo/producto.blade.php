@if ($producto)
<strong>Codigo:</strong>  {{ $producto->codigo }} <br>
<strong>Producto:</strong> {{ $producto->producto }}
<br>

<ul class="list-group list-group-horizontal">

    @if (count($producto->categorias)>0)
    <strong>categorias:&nbsp; </strong>
    @foreach ($producto->categorias as $item)
    <span class="badge bg-secondary" style="color: white">{{ $item->categoria }}</span>&nbsp;&nbsp;
    @endforeach
    @else
    <div class="alert alert-danger mt-2">
        <strong>¡Opps! Parece que no tienes ninguna categoria registrada.</strong>
    </div>
    @endif
</ul>

@if ($producto?->tiposPrecios)
@if (count($producto->tiposPrecios) > 0)
<strong class="mt-2">Lista de precios del producto: </strong>

<select   name="precio" id="precios">
    <option disabled selected value="">Seleccione un valor</option>
    @foreach ($producto->tiposPrecios as $key => $item)
        <option value="{{ $item->pivot->id }} {{ $item->pivot->precio }}">{{ $item->tipo }} {{ number_format($item->pivot->precio, 2) }}</option>
    @endforeach
</select>
<div class="mt-2">
    <label for=""><strong>Asignar nuevo precio:</strong></label>
<input type="number" step="0.01"  name="nuevo_precio" id="nuevo_precio">
</div>

<div class="mt-2">
    <label for=""><strong>Cantidad:</strong></label>
<input type="hidden" min="1"  value="1" step="1"  name="cantidad" id="cantidad">
</div>
<!--<table class="table table-bordered table-sm mt-1">
    <thead class="thead-dark">
        <tr>
            <th scope="col" width="40">#</th>
            <th scope="col">Tipo</th>
            <th scope="col" width="120">Precio</th>
            <th scope="col" width="80">Estado</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($producto->tiposPrecios as $key => $item)
            <td> {{ $key + 1 }} </td>
            <td>{{ $item->tipo }}</td>
            <td>{{ number_format($item->pivot->precio, 2) }}</td>
            <td>
                @if ($item->pivot->estado == true)
                Activo
                @else
                Desactivo
                @endif

            </td>
            </tr>
        @endforeach
    </tbody>
</table>-->
@else
<div class="alert alert-danger mt-2">
    <strong>¡Opps! Parece que no tienes ningun precio registrado.</strong>
</div>
@endif
@endif

@php
    $url = 'default.png';
    if ($producto?->imagen != null) {
        $url = $producto?->imagen;
    }
    if ($url == null) {
        $url = 'default.png';
    }
@endphp

<img width="200" height="270" class="img-thumbnail"
    src="{{ asset('productos/' . $url) }}" alt="">


@endif
<script>
    var select = document.getElementById('precios');
    select.addEventListener('change',
    function(){
        var selectedOption = this.options[select.selectedIndex];
        var input = document.getElementById('nuevo_precio');
        var miString = selectedOption.value;
        var miArray = miString.split(" ");


        input.value = miArray[1];
        document.getElementById('precio_f').value = miArray[1];//precio en dolar
        document.getElementById('precio_t').value =  miArray[0];//tipo
        document.getElementById('valor_real').value =  miArray[1];//tipo

        document.getElementById('btn_f').disabled = false;
    });


    var input = document.getElementById('nuevo_precio');
    var input2 = document.getElementById('cantidad');
    input.addEventListener('change',
    function(){
        document.getElementById('precio_f').value = "";
        document.getElementById('precio_f').value = input.value;
        document.getElementById('cantidad_f').value = input2.input;
        document.getElementById('btn_f').disabled = false;
    });

    input2.addEventListener('change',
    function(){
        console.log(document.getElementById('cantidad').value);
        document.getElementById('cantidad_f').value = document.getElementById('cantidad').value;
        document.getElementById('cantidad_f').value = "";

        //document.getElementById('cantidad_f').value = input2.input;

    });

</script>
