<x-app-layout>
    <x-slot:title>
        Lista de provisiones
      </x-slot>

      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Provisiones</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <div class="col-md-12 mt-3 text-end">
        <a class="btn btn-primary mb-2" style="color:white;" href="{{route('configuracion.provisiones.create')}}">
            <i class="fas fa-save"></i>
        </a>
        <a class="btn btn-success mb-2" style="color:white;" href="{{ route('provisiones.reporte') }}">
            <i class="fas fa-file-alt"></i> Reporte Provisiones
        </a>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Empresas</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">Tipo Provision</th>
                            <th scope="col">Procentaje</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Fecha Creacion</th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provisiones as $key => $item)
                            <tr class="  @if ($item->actualizada==false) table-danger @endif">

                                <th scope="row">{{ $key + 1 }}</th>

                                <td>{{ $item->tipo_provision }} </td>
                                <td>{{ $item->porcentaje }} </td>
                                <td>{{ $item->descripcion }} </td>
                                <td>{{ $item->fecha_creacion }} </td>
                                <td><a href="{{ route('configuracion.provisiones.edit', $item->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>

                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('configuracion.provisiones.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar la provision?')"
                                            class="btn @if ($item->activo) btn-success @else btn-danger @endif"
                                            type="button" ><i class="fas fa-trash"></i></button>
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
