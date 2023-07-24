<x-app-layout>

    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Reportes contables</li>
            </ol>
          </nav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="row">
  
    
        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Reporte de balance de saldos</h5>
                  <button style="color:white" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#balance_saldos">
                    Generar
                  </button>
                </div>
              </div>
        </div>
        @include('contabilidad.reportes.modal.modal_balance_saldos')
       
    </div>

</x-app-layout>
