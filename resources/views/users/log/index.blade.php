<x-app-layout>
    <x-slot:title>
        Logs
      </x-slot>

      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Logs</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>




    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Logs de la empresa {{ Help::usuario()->empresa->empresa }}</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">Modulo</th>
                            <th scope="col">Opción</th>
                            <th scope="col">Acción</th>
                            <th scope="col">Usuario</th>
                            <th scope="col"> Fecha</th>
                            @if (Help::usuario()->hasPermissionTo('general.log.eliminar'))
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($log as $key => $l)
                            <tr >

                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $l->modulo }}</td>
                                <td>{{ $l->opcion }}</td>
                                <td>{{ $l->accion }}</td>
                                <td>{{ $l->usuario->name }}</td>
                                <td>{{ Help::hour($l->created_at)  }}</td>
                                @if (Help::usuario()->hasPermissionTo('general.log.eliminar'))
                                <td>
                                    <form id="form{{ $l->id }}"
                                        action="{{ route('logs.destroy', $l->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $l->id }}','¿Desea eliminar el log?')"
                                            class="btn  btn-danger"
                                            type="button" ><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
