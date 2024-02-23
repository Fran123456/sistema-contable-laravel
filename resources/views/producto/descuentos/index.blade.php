@extends('metronic.base')
@section('extracss')
@endsection
@section('extrajs')
@endsection

@section('titulo')
   Descuentos
@endsection

@section('content')


    @include('sessions')
    {{-- <h3 style="text-align: center">Tipo de precios</h3> --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <a href="{{ route('descuentos.create') }}" class="btn btn-primary mb-2">Crear Nuevo Descuento</a>


            @if (count($descuentos) > 0)
            <table class="table mt-3 table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Porcentaje</th>
                        <th>Efectivo</th>
                        <th>Activo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Asignar <br> cliente</th>
                        <th>Asignar <br> Producto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($descuentos as $key=> $descuento)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $descuento->nombre }}</td>
                            <td>{{ $descuento->porcentaje != null ?  number_format($descuento->porcentaje,2) : "SIN ASIGNAR" }}</td>
                            <td>{{ number_format($descuento->dinero,2) }}</td>
                            <td>{{ $descuento->activo ? 'Sí' : 'No' }}</td>
                            <td>{{ $descuento->fechai }}</td>
                            <td>{{ $descuento->fechaf }}</td>
                            <th>
                                <a href="{{ route('descuentos.edit', $descuento->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </th>
                            <td>


                                <form action="{{ route('descuentos.destroy', $descuento->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                            <td>
                                 <a href="{{ route('descuento.asignarCliente', $descuento->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-people-arrows"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('descuento.asignarProducto', $descuento->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-box-open"></i></a>
                           </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-danger">
                    <strong>¡Opps! Parece que no tienes ningun precio registrado.</strong>
                </div>
            @endif
        </div>
    </div>
@endsection
