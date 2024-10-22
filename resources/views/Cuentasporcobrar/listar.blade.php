<x-app-layout>
    <x-slot:title>
        lista Cuentas Por Cobrar
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cuentas Por Cobrar</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    

            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <h5>Lista Cuentas Por Cobrar</h5>
                        <table class="table table-sm" id="datatable-responsive">
                            <thead>
                                <tr>

                                    <th scope="col">documento_id</th>
                                    <th scope="col">monto</th>
                                    <th scope="col">fecha</th>
                            
                                </tr>
                            </thead>
                            <tbody> 
                               @foreach ($cuentas as $cuenta)
                               <tr>

                                <td>{{$cuentas->documento_id}}</td>
                                <td>{{$cuentas->monto}}</td>
                                <td>{{$cuentas->fecha}}</td>
                                
                               </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

</x-app-layout>
