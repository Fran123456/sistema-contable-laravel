<x-app-layout>

    <div class="container">
      <div class="row">
  
        <div class="col-md-12">
            <x-commonnav page="Tienda" ></x-commonnav>
          
        </div>

        <div class="col-md-4 col-xs-6 col-sm-4 mt-3 ">

            <div class="card" >
                <img height="300" width="200" src="https://img.freepik.com/vector-gratis/carro-tienda-edificio-tienda-dibujos-animados_138676-2085.jpg?w=2000" class="card-img-top" alt="...">
                <div class="card-body " style="margin-top: -50px;">
                  <h5 >  <strong>Azucar Blanca</strong> </h5>

                  <a href="{{route('beneficios-tienda-producto', 1)}}" class="btn btn-primary card-link">Consultar</a>
                </div>
                
          
              </div>
            
        </div>



      </div>
    </div>
  
  </x-app-layout>
  