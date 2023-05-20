<?php

namespace App\Imports;

use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaNivelCuenta;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use PhpParser\Node\Stmt\Return_;


class ContaCuentaContableImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $numeroFila=0;
    private $ingresados=0;
    private $errores=array();
    private $empresa=null;

    public function mapping(): array
    {
        return [
            'codigo'  => 'A1',
            'nombre_cuenta' => 'A2',
            'codigo_padre' => 'A3',
            'nivel' => 'A4',
            'clasificacion' => 'A5',
            'saldo' => 'A6',
        ];
    }

    public function  __construct( $empresa)
    {
        $this->empresa = $empresa;
    }

    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            ++$this->numeroFila;

            //obtener las filas 
            $codigo = $row['codigo'];
            $nombreCuenta = $row['nombre_cuenta'];
            $codigoPadre = $row['codigo_padre'];
            $nivel = $row['nivel'];
            $clasificacion = $row['clasificacion'];
            $saldo = $row['saldo'];
            $obj = array('codigo'=>$codigo, 'nombre_cuenta'=>$nombreCuenta ,'codigo_padre'=>$codigoPadre,
            'nivel'=>$nivel, 'clasificacion'=> $clasificacion,'saldo'=>$saldo );

            $error = false;
            $nivelDB = ContaNivelCuenta::where('empresa_id', $this->empresa)->where('digitos',$nivel)->first();
            if($nivelDB==null){
                array_push($this->errores, array( $obj, "Error, No se ha encontrado el nivel en la base de datos"  ) );
                $error = true;
            }

            $clasificacionDB = ContaClasificacionCuenta::where('empresa_id', $this->empresa)->where('clasificacion',$clasificacion)->first();
            if($clasificacionDB==null){
                array_push($this->errores, array( $obj, "Error, No se ha encontrado la clasificación en la base de datos"  ) );
                $error = true;
            }

            $padreDB = ContaCuentaContable::where('empresa_id', $this->empresa)->where('codigo',$codigoPadre)->first();
            if($padreDB==null && $codigoPadre!=null){
                array_push($this->errores, array( $obj, "Error, No se ha encontrado el padre de la cuenta en la base de datos"  ) );
                $error = true;
            }

            if($error==false){

                ContaCuentaContable::create([
                    'codigo'=>$codigo , 'nombre_cuenta'=> $nombreCuenta, 'padre_id'=>$padreDB->id??null ,
                    'hijos'=> 0, 'nivel_id'=> $nivelDB->id, 'clasificacion_id'=> $clasificacionDB->id,
                    'saldo'=>$saldo,'activo'=> true,'empresa_id'=> $this->empresa
                ]);
                if (isset($padreDB->id)) {
                    $padreDB->hijos = $padreDB->hijos +1;
                    $padreDB->save();
                }
                ++$this->ingresados;
            }
           
        }
    }

    public function getNumeroFilas()
    {
       return $this->numeroFila;
    }

    public function getErrores()
    {
       return $this->errores;
    }

    public function getIngresados(){
        return $this->ingresados;
    }
}
