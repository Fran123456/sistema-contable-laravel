@extends('metronic.base')


@section('titulo')
    Productos - proveedor
@endsection

@section('extracss')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('extrajs')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select[name="producto"').select2();
            document.querySelector('select[name="producto"').parentElement.querySelector('span.select2-container')
                .style.width = "100%"
        });

        $(document).ready(function() {
            $('select[name="proveedor"').select2();
            document.querySelector('select[name="producto"').parentElement.querySelector('span.select2-container')
                .style.width = "100%"
        });
    </script>

    <script>
        function producto() {
            let producto = $('#producto').val();
            let proveedor = $('#proveedor').val();
            // Función que envía y recibe respuesta con AJAX
            $.ajax({
                type: 'GET', // Envío con método GET
                url: "{{ route('producto.obtenerProductoVenta') }}", // Fichero destino (el PHP que trata los datos)
                data: {
                    producto: producto,
                    proveedor: proveedor
                } // Datos que se envían
            }).done(function(msg) { // Función que se ejecuta si todo ha ido bien
                console.log(msg);
                if(msg.producto.imagen == null || msg.producto.imagen == "")msg.producto.imagen='default.png';
                $("#img").attr("src","/productos/" + msg.producto.imagen);
                let texto = `<p>
                                  <strong>Producto: </strong> ${msg.producto.producto} <br>
                                 <strong>Codigo Producto: </strong> ${msg.producto.codigo} <br>
                                 <strong>Proveedor: </strong> ${msg.proveedor?.nombreProveedor??'No disponible'} <br>
                                 <strong>Codigo Proveedor: </strong> ${msg.proveedor?.codProveedor ?? 'No disponible'} <br>
                                 <strong>NRC: </strong> ${msg.proveedor?.nrc ?? 'No disponible'} <br>

                             </p>`;
                $('#texto').html(texto);

            }).fail(function(jqXHR, textStatus, errorThrown) { // Función que se ejecuta si algo ha ido mal
                // Mostramos en consola el mensaje con el error que se ha producido
                $("#consola").html("The following error occured: " + textStatus + " " + errorThrown);
            });
        }

        $(document).ready(function() {
            $("select[name=producto]").change(function() {
                if($('#proveedor').val()==null){

                }else{
                    producto();
                }
                //$('input[name=periodo]').val($(this).val());
            });
        });

        $(document).ready(function() {
            $("select[name=proveedor]").change(function() {
                if($('#producto').val()==null){

                }else{
                    producto();
                }
            });
        });
    </script>
@endsection

@section('content')


    @include('sessions')
    <h3 style="text-align: center">Agregar producto y proveedor </h3>

    <div class="alert alert-info" role="alert">
        LOS PRODUCTOS SE ASOCIAN A UN PROVEEDOR, EN ESTE MENU PODRA REALIZAR DICHA OPERACIÓN, ASOCIAR PRODUCTOS INTERNOS O DE VENTA
        Y ASOCIAR LOS PRECIOS QUE DICHOS PROVEEDORES LE PROPORCIONEN.
       </div>


    <div class="container-fluid">
        <form action="{{ route('productoproductos-proveedor.store') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="row">
                <div class="form-group col-sm-6 mt-2 mb-2">
                    <label for="" class="control-label">Producto: </label>
                    <select required name="producto" id="producto" class="form-control">
                        <option selected value="" disabled>Seleccione...</option>
                        @foreach ($productos as $pro)
                            <option value="{{ $pro->id }}">{{ $pro->producto }} ( {{ $pro->codigo }} ) </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6 mt-2 mb-2">
                    <label for="" class="control-label">Proveedor: </label>
                    <select required name="proveedor" id="proveedor" class="form-control">
                        <option selected value="" disabled>Seleccione...</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->codProveedor }}
                                {{ $proveedor->nombreProveedor }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-2 col-md-3">
                    <label for="">Precio unitario</label>
                    <input type="number" name="precio" min="0.00" step="0.01" class="form-control" required>
                </div>

                <div class="mt-2 col-md-3">
                    <label for="">Codigo</label>
                    <input type="text" name="codigo"  class="form-control" required>
                </div>

                <div class="mt-2 col-md-6">
                    <label for="">Nombre del producto dado por el proveedor</label>
                    <input type="text" required name="producto_proveedor" class="form-control" required>
                </div>


                <div class="col-md-4 mt-2 mb-2">
                    <img class="img-fluid" id="img" src="/productos/default.png" alt="">
                </div>
                <div class="col-md-8 mt-2 mb-2">
                    <div id="texto"></div>
                </div>
                <div class="col-md-12 mt-2">
                    <hr>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection