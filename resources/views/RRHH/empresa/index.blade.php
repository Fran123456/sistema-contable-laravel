<x-app-layout>
    <x-slot:title>
        Lista de empresas
      </x-slot>

      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Empresas</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <div class="col-md-12 mt-3 text-end">
        <a class="btn btn-primary mb-2" style="color:white;" href="{{route('rrhh.empresa.create')}}"> <i class="fas fa-save"></i>
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
                            <th scope="col">Empresa</th>
                            <th scope="col">¿Actualizada?</th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $key => $item)
                            <tr class="  @if ($item->actualizada==false) table-danger @endif">

                                <th scope="row">{{ $key + 1 }}</th>

                                <td>{{ $item->empresa }} </td>
                                <td>
                                    @if ($item->actualizada)
                                        Actualizada
                                    @else
                                        No Actualizada
                                    @endif
                                </td>
                                <td><a href="{{ route('rrhh.empresa.edit', $item->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>

                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('rrhh.empresa.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar la empresa?')"
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
