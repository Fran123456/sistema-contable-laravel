<x-app-layout>

    <div class="row">

        <div class="col-md-12">
            <x-commonnav></x-commonnav>
        </div>

        <x-alert></x-alert>

        <div class="col-md-12">

            <div class="card mt-2">
                <div class="card-header">
                    Mis solicitudes 
                </div>
                <div class="card-body">
                    @if (count($invitations)>0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Equipo</th>
                                <th scope="col">Creador</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Fecha recibido</th>
                                <th width="20" scope="col"></th>
                                <th width="20" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            @foreach ($invitations  as $key => $item )
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{  $item->team->name  }}</td>
                                <td> 
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                
                                    @else
                                        <img class="rounded-circle" width="32" height="32" src="{{  $item->team->user->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }}" />
                                    @endif
          
                                    
                                    {{ $item->team->user->name }}
                                </td>

                                <td>{{ $item->role }}</td>
                                <td>{{ Help::hour($item->created_at) }}</td>
                                <td>
                                    <a href="{{ route('aceptingInvitation', $item->id) }}" class="btn btn-success"><i class="fas fa-check"></i></a>
                                </td>

                                <td>
                                    <a href="" class="btn btn-danger"><i class="fas fa-times-circle"></i></a>
                                </td>
                              
                            </tr>
                            @endforeach
                            
                           
                        </tbody>
                    </table>
                     @else 
                        <x-message color="warning" message="No tiene ninguna solicitud por el momento"></x-message>
                    @endif

                </div>
            </div>

        </div>

    </div>

</x-app-layout>
