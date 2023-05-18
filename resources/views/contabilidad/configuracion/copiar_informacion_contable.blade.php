<x-app-layout>

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <h5>Configuración para copiar información contable</h5>
        <p>
            Apartado que nos permite copiar la información de una empresa a otra, esto incluye copiar
            catalogo de cuentas contables, tipos de cuentas, clasificación, etc.
        </p>
    </div>

    <div class="col-md-12">
        <div class="row">
            @foreach ($empresas as $item)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>{{ $item->empresa }}</h6>

                            <div class="">
                                <form method="post" id="form-tipo-{{ $item->id }}" action="{{ route('contabilidad.copiar-data-store') }}">
                                    @csrf
                                    Tipo partida:
                                    @if (count($item->contaTiposPartidas) > 0)
                                    <button  class="btn btn-success" disabled>
                                        <i style="color:aliceblue" class="fas fa-check-circle"></i>
                                    </button>
                                    @else
                                        <button onclick="submitformTipo({{ $item->id }});" type="button" class="btn btn-danger">
                                            <i style="color:aliceblue" class="fas fa-times-circle "></i>
                                        </button>
                                    @endif
                                    <input type="hidden"  name="emp_de_copiar" id="emp_de_copiar_{{ $item->id }}" >
                                    <input type="hidden" name="emp_a_pasar" value="{{ $item->id }}" id="" >
                                    <input type="hidden" name="op" value="tipo">
                                </form>
                            </div>

                         
                            <div>
                                <form method="post" id="form-clasificacion-{{ $item->id }}"  action="{{ route('contabilidad.copiar-data-store') }}">
                                    Clasificación de cuentas contables:
                                    @csrf
                                    @if (count($item->contaClasificacion) > 0)
                                        <button  class="btn btn-success" disabled>
                                            <i style="color:aliceblue" class="fas fa-check-circle"></i>
                                        </button>
                                    @else
                                    <button  onclick="submitformClasificacion({{ $item->id }});" type="button" class="btn btn-danger">
                                        <i style="color:aliceblue" class="fas fa-times-circle "></i>
                                    </button>
                                    @endif

                                    <input type="hidden"  name="emp_de_copiar" id="emp_de_copiar_cla{{ $item->id }}" >
                                    <input type="hidden" name="emp_a_pasar" value="{{ $item->id }}" id="" >
                                    <input type="hidden" name="op" value="clasificacion">
                                </form>
                            </div>

                            

                            <div>
                                <form id="form-nivel-{{ $item->id }}" method="post"  action="{{ route('contabilidad.copiar-data-store') }}">
                                    Nivel de cuentas contables:@csrf
                                    @if (count($item->contaNivel) > 0)
                                    <button  class="btn btn-success" disabled>
                                        <i style="color:aliceblue" class="fas fa-check-circle"></i>
                                    </button>
                                    @else
                                    <button onclick="submitformNivel({{ $item->id }});" type="button" class="btn btn-danger">
                                        <i style="color:aliceblue" class="fas fa-times-circle "></i>
                                    </button>
                                    @endif
                                    <input type="hidden"  name="emp_de_copiar" id="emp_de_copiar_ni{{ $item->id }}" >
                                    <input type="hidden" name="emp_a_pasar" value="{{ $item->id }}" id="" >
                                    <input type="hidden" name="op" value="nivel">
                                </form>
                            </div>

                            <label for="" class="mt-2"> <strong>Copiar de: </strong></label>
                            
                            <select name="" id="emp{{ $item->id }}" class="form-control mt-2">
                                <option disabled value="" selected>Seleccione..</option>
                                @foreach  ($empresas as $e)
                                    @if ($item->id != $e->id)
                                     <option value="{{ $e->id }}">{{ $e->empresa }}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

    <script>
         function submitformTipo(id){
          let select = $('#emp'+id).val();
          $('#emp_de_copiar_'+id).val(select);
          document.getElementById('form-tipo-'+id).submit();
          } 

          function submitformClasificacion(id){
          let select = $('#emp'+id).val();
          $('#emp_de_copiar_cla'+id).val(select);
          document.getElementById('form-clasificacion-'+id).submit();
          } 

          function submitformNivel(id){
          let select = $('#emp'+id).val();
          $('#emp_de_copiar_ni'+id).val(select);
          document.getElementById('form-nivel-'+id).submit();
          } 
    </script>
</x-app-layout>
