<x-app-layout>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="/settings">Configuraciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">General</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12 mb-3">
        <h5>
            <x-badge titulo="Configuraciones generales" icono="fas fa-user-cog "></x-badge>
        </h5>
    </div>


    <div class="col-md-12m mb-3">
        <form enctype="multipart/form-data" class="settings-form" method="post"
        action="{{ route('settings.changeLogo', $logo->id) }}">
            @csrf
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-5">
                    <div class="section-intro">
                        <label for="floatingInputValue"><strong>{{ $logo->title }}</strong></label>:
                        {{ $logo->description }}
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">

                                @csrf
                                <div class="">
                                    <div class="input-group ">
                                        <input type="file" name="image" required accept="image/*">
                                        <button class="btn btn-success" type="submit"> <i
                                                class="fas fa-save"></i></button>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>





</x-app-layout>
