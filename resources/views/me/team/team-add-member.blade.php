<style>
    .text-bg-primary {
    color: #fcf7f7 !important;
    background-color: RGBA(21, 163, 98, var(--bs-bg-opacity, 1)) !important;
}
</style>

<div class="row g-4 settings-section">
    <div class="col-12 col-md-3">
        <h3 class="section-title">Agrega un miembro a mi equipo</h3>
        <div class="section-intro">
           Agregar un miembro al equipo , además podemos darle el permiso adecuado.
        </div>
    </div>
   
    <div class="col-12 col-md-9">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <form class="settings-form" method="get" action="{{ route('teamMe', $team->id) }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Correo del usuario<span
                                class="ms-2" data-container="body"></label>
                        <input type="text" required class="form-control" name="invitation"
                            required  value=""/>
                    </div>

                     <div class=" text-end">
                        <button type="submit" class="btn app-btn-primary">
                            <i class="fas fa-save"></i>
                        </button>
                     </div>
                </form>
                @include('me.team.team-users-invitation-search')
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>