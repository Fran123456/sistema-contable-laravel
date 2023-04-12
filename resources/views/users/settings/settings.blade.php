<x-app-layout>
    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ route('settings.settingsByKey','datatable') }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-table fa-4x"></i> <br>
                            Configuraciones de datatable
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a href="{{ route('settings.settingsByKey','general') }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-table fa-4x"></i> <br>
                            Configuraciones generales
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>


</x-app-layout>
