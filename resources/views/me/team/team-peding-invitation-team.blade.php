<style>
    .btn-success {
    --bs-btn-color: #fff;}
</style>
<div class="row g-4 settings-section">
    <div class="col-12 col-md-3">
        <h3 class="section-title">Solicitudes enviadas</h3>
        <div class="section-intro">
           Se lista y se puede eliminar las solicitudes enviadas para pertenecer al equipo
        </div>
    </div>
   
    <div class="col-12 col-md-9">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">

                @if (count($usersPedingInvitation)>0)
                <table class="table">
                    
                    <tbody class="">
                    @foreach ($usersPedingInvitation as $key=> $item)
                    <tr>
                        <td>{{ $item->email }}</td>
                        <td> {{ Help::hour($item->created_at )}}</td>
                        <td class="text-end"> <a href="{{ route('cancelInvitation', ['id'=>$team->id,'id_user_invitation'=>$item->id]) }}" class="btn btn-success"><i class="fas fa-window-close"></i></a> </td>
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