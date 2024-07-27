<!-- resources/views/facturacion/index.blade.php -->

<x-app-layout>
    <x-slot:title>
        Lista de Facturaciones
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Facturación</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Facturación</h5>

                <table class="table table-sm"  id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Orden</th>
                            <th scope="col">Fecha de Facturación</th>
                            <th scope="col">Monto a Facturar</th>
                            <th scope="col">Monto Facturado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facturaciones as $facturacion)
                            <tr>
                                <td>{{ $facturacion->codigo }}</td>
                                <td>{{ $facturacion->fecha_facturacion }}</td>
                                <td>{{ $facturacion->monto_facturar }}</td>
                                <td>{{ $facturacion->monto_facturado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

           
            </div>
        </div>
    </div>
</x-app-layout>
