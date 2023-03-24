<style>
    .btn-success {
    --bs-btn-color: #fff;}
    .not-active {
            pointer-events: none;
            cursor: default;
        }
</style>
<div class="row g-4 settings-section">
    <div class="col-12 col-md-3">
        <h3 class="section-title">Miembros del equipo</h3>
        <div class="section-intro">
           Se lista los miembros que pertecen al equipo además opciones de administración de usuarios de equipo
        </div>
    </div>

    <div class="col-12 col-md-9">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">

                @if (count($team->users)>0)
                <table class="table">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                    <tbody class="table-group-divider">
                    @foreach ($team->users as $key=> $item)
                    <tr>
                        <td>
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                            @else
                                <img class="rounded-circle" width="32" height="32" src="{{  $item->profile_photo_url }}"
                                alt="{{ $item->profile_photo_url }}" />
                            @endif


                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>

                        <td>{{  $item->membership->role }}</td>
                        <td class="text-end">

                           <a   href="{{ route('removeUser', ['id'=>$team->id,'user_id'=>$item->id]) }}" class="btn btn-success @if ($item->id == Auth::user()->id) not-active  @endif  "><i class="fas fa-window-close"></i></a>



                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                @endif

            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
