<x-app-layout>
  

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Editar la empresa: {{ $empresa->empresa }}</h5>

                <form method="post" action="{{ route('rrhh.empresa.update', $empresa->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mt-3 mb-2">
                            <label for=""><strong>Empresa</strong> </label>
                            <input type="text" name="empresa"  value="{{ $empresa->empresa }}"  required class="form-control">
                        </div>
                    </div>
                 

                    <div class="row">
                        <div class="col-md-12 mt-4 mb-1">
                            <button style="color: white" type="submit" class="btn btn-warning"> 
                                <i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                </form>



            </div>

        </div>

    </div>

    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>

</x-app-layout>