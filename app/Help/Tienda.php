<?php
namespace App\Help;
use Illuminate\Support\Facades\Http;

class Tienda
{

    public static function  productos(){

      $data = array(
              array(
                'id'=> 1,
                'producto'=>'Azucar Blanca Cañal',
                'tipo_producto_id'=>1,
                'imagen'=>'https://walmartsv.vtexassets.com/arquivos/ids/179779/Azucar-Blanca-Dulce-Canaveral-500Gr-1-8342.jpg?v=637642832254330000',
                'distribuciones'=> array(
                                      array(
                                          'id'=>1,
                                          'nombre'=> 'Azucar blanca del cañal',
                                          'presentacion'=>'2500 gr (5 lb)',
                                          'precio'=>2.90,
                                          'clave'=>453
                                      ),
                                      array(
                                        'id'=>2,
                                        'nombre'=> 'Azucar blanca del cañal',
                                        'presentacion'=>'1 Kg (2 lb)',
                                        'precio'=>2.15,
                                        'clave'=>958
                                    ),
                )
              ),

              array(
                'id'=> 2,
                'producto'=>'Arroz y frijol',
                'tipo_producto_id'=>1,
                'imagen'=>'https://santaanacorp.com/wp-content/uploads/2021/06/Mesa-de-trabajo-27sntaana1.png',
                'distribuciones'=> array(
                                      array(
                                          'id'=>3,
                                          'nombre'=> 'Arroz blanco OMOA',
                                          'presentacion'=>'4 lb',
                                          'precio'=>0.64,
                                          'clave'=>962
                                      ),
                ),
              ),

      );

      return $data;

    }

    public static function producto($id){
      $pro = Tienda::productos();
      for ($i=0; $i < count($pro); $i++) {
        if($pro[$i]['id']== $id) return $pro[$i];
      }
    }





}
