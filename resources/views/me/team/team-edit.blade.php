<style>
    .text-bg-primary {
    color: #fcf7f7 !important;
    background-color: RGBA(21, 163, 98, var(--bs-bg-opacity, 1)) !important;
}
</style>

<div class="row g-4 settings-section">
    <div class="col-12 col-md-3">
        <h3 class="section-title">Mi equipo</h3>
        <div class="section-intro">
           Edita la información del equipo
        </div>
    </div>
   
    <div class="col-12 col-md-9">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <form class="settings-form" method="post" action="{{ route('teamMe', $team->id) }}">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre del equipo<span
                                class="ms-2" data-container="body"></label>
                        <input type="text" required class="form-control" name="name"
                            required  value="{{ $team->name }}"/>
                    </div>
                  
                    <div class="mb-3">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                             <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}"
                              alt="{{ Auth::user()->name }}" />
                        @else
                            <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}"
                             alt="{{ Auth::user()->name }}" />
                        @endif
                        <label  > <strong>Propietario:</strong> {{  Auth::user()->name }}</label> <br>
                       

                    </div>
                     <div class=" text-end">
                        <button type="submit" class="btn app-btn-primary">
                            <i class="fas fa-save"></i>
                        </button>
                     </div>
                </form>
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>