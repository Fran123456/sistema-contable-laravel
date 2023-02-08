<div>
    <div class="row">
    
        <div class="col-md-12">
            <x-alert titulo="Mis boletas de pago" tipo="primary"></x-alert>
        </div>
    
    
        <div class="col-md-4">

                <div class="row">
               
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="">Tipo</label>
                        <select class="form-control" name="" id="tipo" wire:model='tipo'>
                            <option value="sueldo">Sueldo</option>
                            <option value="vacaciones">Vacaciones</option>
                            <option value="gratificaciones">Gratificaciones</option>
                            <option value="aguinaldo">aguinaldo</option>
                            <option value="ordinaria">Gratificación Ordinaria</option>
                            <option value="indemnizacion">Indemnización</option>
                            <option value="extraordinaria">Gratificación Extraordinaria</option>
                        </select>
                    </div>

                    <!--<input type="text" id="text" value="" wire:model="text">-->
    
                    @if ($this->tipo=='sueldo')
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="">Año</label>
                        <input class="form-control" type="number" value="{{$this->year}}"  wire:model='year'>
                    </div>
                    @endif
    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <button wire:click='obtenerboletas' type="button" class="btn btn-primary mt-3"><i class="far fa-eye"></i></button>
                    </div>
                </div>
    
                
       
            
        </div>
    
        <div class="col-md-8">
            
            <h5 id="tboletas"></h5>
            @if(count($data)>0)
    
                @for ( $i =0 ; $i < count($data) ; $i++)
                <div class="card mb-2">
                    <div class="card-body">
                    <h6 class="card-title"> {{$data[$i]['calPeriodo']}} </h6>
                    <p class="card-text">Empresa: {{  isset($data[$i]['empresa']['empresa'] )  ? $data[$i]['empresa']['empresa'] : $data[$i]['empresa']    }}  
                      @if( $data[$i]['distribucion']==="si")
                       <span style="font-size: 26px; color: #2c58a0;"><i class="fa fa-check"></i> </span>
                      @else 
                        <span style="font-size: 26px; color: #c5444a;"><i class="fa fa-times"></i> </span>
                      @endif
                    </p>
                    <button  type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>
                    </div>
                </div>
                @endfor
    
            @else 
            <div class="mt-4">
                
                <x-alert titulo="{{$this->mensaje}}" tipo="danger"></x-alert>
            </div>
    
            @endif
    
            <div class="text-center">
                <div wire:loading wire:target="obtenerboletas">
                    <span style="font-size: 48px; color: #2c58a0;">
                        <i class="fa fa-spinner"></i>
                      </span>
                    
                </div>
            </div>
            
        </div>
    
        
    </div>
    
    <script>
       
          
      /*  document.getElementById("tipo").onchange = function() {myFunction()};

        function myFunction() {
        var x = document.getElementById("tipo");
        var text = x.options[x.selectedIndex].text;
        var t = document.getElementById("text");
        t.value=text;
      
        }*/
    </script>
</div>