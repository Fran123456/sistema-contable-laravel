<x-app-layout>

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <form method="post" action="{{ route('rrhh.empresa.store') }}">
        <div class="row">
            <div class="col-md-6   mt-2 mb-21">
                <label for="">Empresa</label>
                @csrf
                <input name="empresa" required type="text" class="form-control">
            </div>

            <div class="col-md-12 mb-3 mt-3">
                <button class="btn btn-primary mb-2" style="color:white;" type="submit"> <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
      
      
    </form>

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
                                            class="btn @if ($item->activo) btn-success @else btn-danger @endif "
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