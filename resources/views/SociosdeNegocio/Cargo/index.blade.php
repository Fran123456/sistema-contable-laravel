<x-app-layout>
    <x-slot:title>
        Lista de cargos
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cargos</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    
    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="" title="Crear"> <i class="fas fa-save"></i> </a>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> Cargos </h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cargos as $key => $item)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->cargo}}</td>
                                <td>{{$item->descripcion}}</td>
                                <td> 
                                    <a href="" class="btn btn-warning" title="Editar"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <button
                                        onclick="confirm('form','¿Desea eliminar el departamento?')"
                                        class="btn btn-danger"
                                        type="button" title="Eliminar"><i class="fas fa-trash"></i></button>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>