<x-app-layout>

    <div class="container">
      <div class="row">

        <div class="col-md-12 col-xs-12 col-sm-12 mt-3">
            <x-commonnav ></x-commonnav>
        </div>

        <div class="col-md-12 col-xs-12 col-sm-12 mt-3">
          <div class="row">
            <div class="col-md-6 col-xs-8 col-sm-8">
              <form class="" action="index.html" method="post">
                <label>Filtrar por tipo de producto</label>
                <select class="form-select" aria-label="Default select example">
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>

              </form>
            </div>
            <div class="col-md-6 col-xs-4 col-sm-4 " style="text-align: right;">

              <x-carrito numero="4"></x-carrito>
              <x-favoritos numero="4"></x-favoritos>

            </div>
          </div>
        </div>


        @for ($i=0; $i < count($productos); $i++)
          <div class="col-md-4 col-xs-6 col-sm-4 mt-3 ">
                <div class="card" >
                    <img height="300" width="200" src="{{$productos[$i]['imagen']}}" class="card-img-top" alt="...">
                    <div class="card-body " style="margin-top: -30px;">
                      <h5 >  <strong>{{$productos[$i]['producto']}}</strong> </h5>
                      <a href="{{route('beneficios-tienda-producto', $productos[$i]['id'])}}" class="btn btn-primary card-link">Consultar</a>
                     <a class="btn btn-danger" href="#"> <i  class=" far fa-heart" style=""></i></a>
                    </div>
                </div>
          </div>
        @endfor

      </div>
    </div>

  </x-app-layout>
