<div class="row g-4 settings-section">
    <div class="col-12 col-md-4">
        <h3 class="section-title">Perfil</h3>
        <div class="section-intro">
           Edita la información general de tu perfil de usuario
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <form class="settings-form">
                    <div class="mb-3">
                        <label class="form-label">Nombre<span
                                class="ms-2" data-container="body"></label>
                        <input type="text" class="form-control" id="setting-input-1"
                            required  value="{{ Auth::user()->name }}"/>
                    </div>
                  
                    <div class="mb-3">
                        <label  class="form-label">Correo electronico</label>
                        <input type="email" class="form-control" readonly 
                            value="{{ Auth::user()->email }}" />
                    </div>
                    <button type="submit" class="btn app-btn-primary">
                        <i class="fas fa-save"></i>
                    </button>
                </form>
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>