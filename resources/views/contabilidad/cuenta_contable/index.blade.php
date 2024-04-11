<x-app-layout>

    <x-slot:title>
        Cuentas contables
    </x-slot>

    <x-slot:subtitle>
        {{--Periodo {!! Help::periodoContable()?->codigo!!}  --}}
    </x-slot>
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Catalogo de cuentas contables</li>
            </ol>
          </nav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mt-2 mb-2">
        <!-- Button trigger modal -->
        <a style="color: white" type="button" class="btn btn-primary" href="{{ route('contabilidad.cuentas-contables.create') }}" >
            <i class="fas fa-save"></i>
        </a>

        <a style="color: white"  class="btn btn-primary" href="{{ route('contabilidad.importarCuentasExcelView') }}" >
           Importar via Excel
        </a>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Catalogo de cuentas contables</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Cuenta</th>
                            <th scope="col">Clasificación</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Padre</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th width="50" class="text-center" scope="col">Estado</th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cuentas as $key => $item)
                            <tr class="  @if ($item->activo == false) table-danger @endif">

                                <th scope="row">{{ $key + 1 }}</th>

                                <td>{{ $item->codigo }} </td>
                                <td>{{ $item->nombre_cuenta }} </td>
                                <td>{{ $item->clasificacion->clasificacion }} </td>
                                <td>{{ $item->nivel->nivel }} </td>
                                <td>{{ $item->padre?->codigo}} </td>
                                <td> <a class="btn btn-warning" href="{{ route('contabilidad.cuentas-contables.edit', $item->id) }}"><i class="fas fa-edit"></i></a> </td>
                                <td>
                                    <form id="form{{ $item->id }}p"
                                        action="{{ route('contabilidad.cuentas-contables.update', $item->id) }}"
                                        method="post">
                                        <input type="hidden" value="1" name="solo_activo">
                                        @method('PUT')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}p','¿Desea modificar el estado de la cuenta contable seleccionada?')"
                                            class="btn @if ($item->activo) btn-success @else btn-danger @endif "
                                            type="button">
                                            @if ($item->activo)
                                                <i class="fas fa-check-circle"></i>
                                            @else
                                                <i class="fas fa-times"></i>
                                            @endif
                                        </button>
                                    </form>
                                </td>

                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('contabilidad.cuentas-contables.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar la cuenta contable seleccionada?')"
                                            class="btn @if ($item->activo) btn-success @else btn-danger @endif "
                                            type="button"><i class="fas fa-trash"></i></button>
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
