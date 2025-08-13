<x-app-layout>
    <x-slot:title>
        Gestión de empresas
      </x-slot>

      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configuración</li>
            <li class="breadcrumb-item active" aria-current="page">Gestión de empresas</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <div class="col-md-12 mt-3 text-end">
        <a class="btn btn-primary mb-2" style="color:white;" href="{{route('configuracion.gestionempresas.create')}}"> <i class="fas fa-save"></i>
        </a>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Empresas</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">ID</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">NIT</th>
                            <!--<th scope="col">NRC</th>-->
                            <!-- <th scope="col">Dirección</th>-->
                            <th scope="col">Email</th>
                            <th scope="col">Telefono Empresa</th>
                            <th scope="col">Representante Legal</th>
                            <th scope="col">Telefono del representante</th>
                            <th scope="col">Responsable de contrato</th>
                            <th scope="col">Fecha Contrato</th>
                            <th scope="col">Estado</th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($empresas as $empresa)
                            <td>{{$empresa->id}}</td>
                            <td>{{$empresa->nombre_empresa}}</td>
                            <td>{{$empresa->nit}}</td>
                            <!--<td>{{$empresa->nrc}}</td>-->
                            <!--<td>{{$empresa->direccion}}</td>-->
                            <td>{{$empresa->email}}</td>
                            <td>{{$empresa->telefono_empresa}}</td>
                            <td>{{$empresa->representante_legal}}</td>
                            <td>{{$empresa->telefono_repre_legal}}</td>
                            <td>{{$empresa->responsable_contrato}}</td>
                            <td>{{$empresa->fecha_contrato}}</td>
                            <td>@if($empresa->estado_id == 1)
                                    Activa
                                @elseif($empresa->estado_id == 2)
                                    Inactiva
                                @else
                                    Estado desconocido
                                @endif
                            </td>

                            
                            <td><a href="{{ route('configuracion.gestionempresas.edit', $empresa->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <form id="form{{ $empresa->id }}" 
                                    action="{{ route('configuracion.gestionempresas.destroy', $empresa->id) }}" 
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            class="btn btn-danger"
                                            onclick="confirm('form{{$empresa->id}}','¿Desea eliminar la empresa?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                        
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
