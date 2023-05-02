<x-app-layout>
    <div class="col-md-12">
        <x-commonnav  ></x-commonnav>
    </div>
    <div class="col-md-12 text-end mb-4">
      <a class="btn btn-success"  href="{{route('roles.roles') }}"> <i class="fas fa-user-plus"></i> </a>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <table class="table" id="datatable-responsive">
                    <thead>
                      <tr>
                        <th width="40" scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th  width="40" class="text-center" scope="col">Editar</th>
                        <th  width="40" class="text-center" scope="col">Deshabilitar</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($roles as $key => $item)
                      <tr class="  @if($item->disabled) table-danger  @endif">
                        <th scope="row">{{ $key+1 }}</th>
                        <td></td>
                        <td></td>
                        <td> <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a> </td>
                        <td> <a href="{{ route('users.disableUser', $item->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a> </td>
                      </tr>
                      @endforeach
                  
                     
                    </tbody>
                  </table>
            </div>
          </div>
       
    </div>

</x-app-layout>
