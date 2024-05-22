<?php

namespace App\Imports;

use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaNivelCuenta;
use App\Models\Contabilidad\ContaTipoPartida;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;
use App\Help\Contabilidad\PartidasContables;

class ContaPartidasContableImport implements ToCollection,WithHeadingRow
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
            'periodo'  => 'A1',
            'tipo_partida' => 'A2',
            'fecha' => 'A3',
            'concepto_general' => 'A4',
            'cuenta_contable' => 'A5',
            'debe' => 'A6',
            'haber'=> 'A7',
            'concepto_detalle'=> 'A8'
        ];
    }

    public function  __construct( $empresa)
    {
        $this->empresa = $empresa;
    }


    public function collection(Collection $rows)
    {
        $partidaId = 0;
      
        try {
            DB::beginTransaction();
            foreach ($rows as $key => $row)
            {
                ++$this->numeroFila;
    
                //obtener las filas
                $periodo = $row['periodo'];
                $tipo = $row['tipo_partida'];
                $fecha = $row['fecha'];
                $conceptoGeneral = $row['concepto_general'];
                $debe = $row['debe']??0;
                $haber = $row['haber']??0;
                $conceptoDetalle = $row['concepto_detalle'];
                $cuenta = $row['cuenta_contable'];
    
                $obj = array('periodo'=>$periodo, 'tipo'=>$tipo ,'fecha'=>$fecha,
                'conceptoGeneral'=>$conceptoGeneral, 'debe'=> $debe,'haber'=>$haber
                ,'conceptoDetalle'=>$conceptoDetalle ,'cuenta'=>$cuenta );
    
                $error = false;
                
                $objPeriodo = ContaPeriodoContable::where('empresa_id', $this->empresa)->where('codigo',$periodo)->first();
                if($objPeriodo==null){
                    array_push($this->errores, array( $obj, "Error, No se ha encontrado el periodo solicitado"  ) );
                    $error = true;
                    
                }
    
                $objCuenta = ContaCuentaContable::where('empresa_id', $this->empresa)->where('codigo',$cuenta)->first();
                if($objCuenta==null){
                    array_push($this->errores, array( $obj, "Error, No se ha encontrado la cuenta contable"  ) );
                    $error = true;
                }
    
                $objTipoPartida = ContaTipoPartida::where('empresa_id', $this->empresa)->where('tipo',$tipo)->first();
                if($objTipoPartida==null){
                    array_push($this->errores, array( $obj, "Error, No se ha encontrado el tipo de partida"  ) );
                    $error = true;
                }
    
                if($debe > 0){
                   if ($haber >0) {
                    array_push($this->errores, array( $obj, "Error, Debe y haber no pueden tener ambos una cantidad mayor a cero"  ) );
                    $error = true;
                   }
                }
    
                if($haber > 0){
                    if ($debe >0) {
                     array_push($this->errores, array( $obj, "Error, Debe y haber no pueden tener ambos una cantidad mayor a cero"  ) );
                     $error = true;
                    }
                 }
    
                if($error==false ){
                    
                    if($partidaId == 0){
                        $data = array(
                            'concepto'=> $conceptoGeneral,
                            'periodo_id'=> $objPeriodo->id,
                            'tipo_partida_id'=> $objTipoPartida->id,
                            'fecha_contable'=> $fecha
                        );
                        $partidaId = PartidasContables::cabecera($data)->id;
                    }
                    
                    $detalle = array(
                        'partida_id'=> $partidaId,
                        'periodo_id'=> $objPeriodo->id,
                        'tipo_partida_id'=>$objTipoPartida->id,
                        'cuenta_contable_id'=>$objCuenta->id,
                        'debe'=>$debe,
                        'haber'=>$haber,
                        'fecha_contable'=> $fecha,
                        'concepto'=> $conceptoDetalle
                    );
                    PartidasContables::detalle($detalle);
                  
                    ++$this->ingresados;
                }else{
                    DB::rollBack();
                    return;
                }
                
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
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
