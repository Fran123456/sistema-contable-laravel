<x-app-layout>
    <div class="col-md-12">
        <x-commonnav  ></x-commonnav>
    </div>
    <div class="col-md-12 text-end mb-4">
      <a class="btn btn-success"  href="{{route('users.create') }}"> <i class="fas fa-user-plus"></i> </a>
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
                        <th  width="40" class="text-center" scope="col">Deshabilitado</th>
                        <th  width="40" class="text-center" scope="col">Editar</th>
                        <th  width="40" class="text-center" scope="col">Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $key => $item)
                      <tr class="  @if($item->disabled) table-danger  @endif">
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="text-center"> @if($item->disabled) 
                               
                               <h4> <span class="badge bg-danger"><i class="fas fa-frown"></i></span></h4>

                              @else 
                              <h4> <span class="badge bg-success"><i class="fas fa-smile"></i></span></h4>
                              
                             @endif 
                        </td>
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