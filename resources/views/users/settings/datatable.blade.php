<x-app-layout>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('settings.settings') }}">Configuraciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tabla de datos</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12 mb-3">
        <h5>
            <x-badge titulo="Configuraciones de datatable" icono="fas fa-user-cog "></x-badge>
        </h5>
    </div>

    @foreach ($data as $item)
        <div class="col-md-12m mb-3">
            <form action="{{ route('settings.updateSetting', $item->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-5">
                        <div class="section-intro">
                            <label for="floatingInputValue"><strong>{{ $item->title }}</strong></label>:
                            {{ $item->description }}

                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="app-card-body">
                                <form class="settings-form" method="post" action="">
                                    @method('put')
                                    @csrf
                                    <div class="">

                                        <div class="input-group ">
                                            <select class="form-select form-select-sm" name="select"
                                                id="inputGroupSelect04" aria-label="Example select with button addon">
                                                @if ($item->value == '1')
                                                    <option selected value="1">Si</option>
                                                    <option value="0">No</option>
                                                @else
                                                    <option value="1">Si</option>
                                                    <option selected value="0">No</option>
                                                @endif



                                            </select>
                                            <button class="btn btn-success" type="submit"> <i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach




</x-app-layout>
