<x-app-layout>

    <div class="container">
      <div class="row">
  
        <div class="col-md-12">
            <x-commonnav page="Tienda" ></x-commonnav>
          
        </div>

        <div class="col-md-5 col-xs-6 col-sm-5 mt-3 ">

            <div class="card" >
                <img height="300" width="200" src="https://img.freepik.com/vector-gratis/carro-tienda-edificio-tienda-dibujos-animados_138676-2085.jpg?w=2000" class="card-img-top" alt="...">
                <div class="card-body " style="margin-top: -50px;">
                  <h5 >  <strong>Azucar Blanca</strong> </h5>

                  <hr>

                  <ul class="list-group list-group-light">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="col-md-6">
                        <div class="fw-bold">Azucar Blanca 2500gr (5 lb)  </div>
                        <div class="text-muted">5 unidades disponibles</div>
                        <div  class="badge bg-primary" >$2.90</div> 
                      </div>
                      <div class="col-md-6 " style="text-align: right">
                        <form action="">
                            <input type="number" class="form-control">
                            <div class="text-left mt-2">
                                <button type="submit" class="btn btn-primary text-right"><i class="fas fa-shopping-cart"></i></button>
                            </div>
                          </form>
                      </div>
                      
                    </li>
                   
                   

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                          <div class="fw-bold">Azucar Blanca 2100gr (4 lb)  </div>
                          <div class="text-muted">0 unidades disponibles</div>
                          <div  class="badge bg-primary" >$2.90</div> 
                        </div>
                        <div class="col-md-6 " style="text-align: right">
                            <span class="badge rounded-pill badge-warning">No disponible</span>
                        </div>
                        
                      </li>
                  </ul>
                  <hr>
                  <a href="#" class="btn btn-primary card-link">Consultar</a>
                </div>
                
          
              </div>
            
        </div>



      </div>
    </div>
  
  </x-app-layout>
  