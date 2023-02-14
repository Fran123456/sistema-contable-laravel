<x-app-layout>

    <div class="container">
      <div class="row">

        <div class="col-md-12">
            <x-commonnav current="{{$producto['producto']}}" ></x-commonnav>

        </div>

        <div class="col-md-5 col-xs-6 col-sm-5 mt-3 ">

            <div class="card" >
                <img height="300" width="200" src="{{$producto['imagen']}}" class="card-img-top" alt="...">
                <div class="card-body " style="margin-top: -30px;">
                  <h5 >  <strong>{{$producto['producto']}}</strong> </h5>

                  <hr>

                  <ul class="list-group list-group-light">


                    @for ($i=0; $i < count($producto['distribuciones']); $i++)

                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                          <div class="fw-bold">{{$producto['distribuciones'][$i]['nombre']}}  </div>
                          <div class="text-muted">{{$producto['distribuciones'][$i]['presentacion']}}</div>
                          <div class="text-muted">5 unidades disponibles</div>
                          <div  class="badge bg-primary" >$ {{$producto['distribuciones'][$i]['precio']}}</div>
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

                    @endfor



                    <!--<li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                          <div class="fw-bold">Azucar Blanca 2100gr (4 lb)  </div>
                          <div class="text-muted">0 unidades disponibles</div>
                          <div  class="badge bg-primary" >$2.90</div>
                        </div>
                        <div class="col-md-6 " style="text-align: right">
                            <span class="badge rounded-pill badge-warning">No disponible</span>
                        </div>

                      </li>-->
                  </ul>
                  <hr>
                  <a href="{!! route('beneficios-tienda') !!}" class="btn btn-primary card-link">Regresar</a>
                </div>


              </div>

        </div>



      </div>
    </div>

  </x-app-layout>
