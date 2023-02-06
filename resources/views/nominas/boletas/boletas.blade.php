<x-app-layout>

    <div class="container">
      <div class="row">
  
        <div class="col-md-12">
          @include('blog.nav')
          
        </div>

        <div class="col-md-12">
            <x-alert titulo="Mis boletas de pago" tipo="primary"></x-alert>
        </div>

        <div class="col-md-6">
            <br>
            <h4>  <strong>Boleta más reciente</strong> </h4>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"> [1-31]-Diciembre-2021 </h5>
                  <p class="card-text">Firmada: <i class="fa fa-check"></i> </p>
                  <button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>
                </div>
              </div>
            


        </div>

        <div class="col-md-6">
            <br>
            <h4>  <strong>Mis boletas</strong> </h4>
            <form action="">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label for="">Tipo</label>
                        <select class="form-control" name="" id="">
                            <option value="">Pago</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label for="">Año</label>
                        <input class="form-control" type="number" value="2023">
                    </div>
                </div>
            </form>
            
        </div>

        
  
  
        
        
  
      </div>
    </div>
  
  </x-app-layout>
  