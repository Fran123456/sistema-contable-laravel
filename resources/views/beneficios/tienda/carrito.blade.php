<x-app-layout>

    <div class="container">
      <div class="row">

        <div class="col-md-12 col-xs-12 col-sm-12">
            <x-commonnav page="Tienda" ></x-commonnav>
        </div>

        <div class="col-md-12 col-xs-12 col-sm-12">
           <div class="card">
              <div class="card-header">Productos seleccionados</div>
              <div class="card-body">
                  <table class="table table-primary">
                      <thead class="table-dark">
                        <tr>
                          <th width="100" scope="col">#</th>
                          <th scope="col">Producto</th>
                          <th width="200" scope="col">imagen</th>
                          <th width="150" scope="col">Precio</th>
                          <th width="150" scope="col">Cantidad</th>
                          <th width="150" scope="col">Subtotal</th>
                          <th width="100" scope="col">Borrar</th>
                        </tr>
                      </thead>
                      <tbody class="table-group-divider">
                        <tr>
                          <th scope="row">1</th>
                          <td>Azucar blanca del cañal<br> 2500 gr (5 lb) </td>
                          <td> <img width="100" height="100" src="https://walmartsv.vtexassets.com/arquivos/ids/179779/Azucar-Blanca-Dulce-Canaveral-500Gr-1-8342.jpg?v=637642832254330000" alt=""> </td>
                          <td>$ 2.90</td>
                          <td>1</td>
                          <td>$ 2.90</td>
                          <td> <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a> </td>
                        </tr>


                        <tr class="table-warning">
                          <th  scope="row"></th>
                          <td> </td>
                          <td>  </td>
                          <td></td>
                          <td class="text-end"> <strong>Total</strong> </td>
                          <td> <strong>$ 2.90</strong> </td>
                          <td></td>
                        </tr>


                      </tbody>
                    </table>

                <a href="#" class="btn btn-primary">Realizar pedido</a>
              </div>
            </div>
        </div>

      </div>
    </div>
  </x-app-layout>
