<x-app-layout>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configuraciones</li>
          </ol>
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
                <a href="{{ route('settings.generalSettings') }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-home fa-4x"></i> <br>
                            Configuraciones generales
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a href="{{ route('settings.accountingSettings') }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-file-invoice-dollar fa-4x"></i> <br>
                            Contabilidad
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a href="{{ route('settings.electronicInvoiceSettings') }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-receipt fa-4x"></i> <br>
                            Facturación electrónica
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>


</x-app-layout>
