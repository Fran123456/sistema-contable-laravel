<?php

namespace App\Imports;

use App\Help\Help;
use App\Models\EntidadTerritorial\EntPais;
use App\Models\SociosdeNegocio\SociosCliente;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClienteImport implements ToCollection, WithHeadingRow
{
    private $errores = [];
    private $ingresados = 0;
    private $numeroFila=0;

    public function mapping(): array
    {
        return [
            'nombre' => 'A1',             
            'apellido' => 'B1',           
            'dui' => 'C1',                
            'nit' => 'D1',                
            'nrc' => 'E1',                
            'tipo_cliente' => 'F1',       
            'magnitud_cliente' => 'G1',    
            'correo' => 'H1',            
            'direccion' => 'I1',       
            'pais' => 'K1',              
            'telefono' => 'L1',         
            'celular' => 'M1',           
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // validar que se encuentren datos
            if (!isset($row['nombre'], $row['apellido'], $row['dui'], $row['nit'], $row['nrc'])) {
                continue;
            }
            // agragar fila recorrida
            ++$this->numeroFila;
            // obteniendo los datos de dui, nit y ncr para validacion de datos unicos
            $dui = $row['dui'] ;
            $nit = $row['nit'];
            $nrc = $row['nrc']; 

            // Validar unicidad
            if (SociosCliente::where('dui', $dui)->exists() || SociosCliente::where('nit', $nit)->exists() || SociosCliente::where('nrc', $nrc)->exists()) {
                array_push($this->errores, "Error: Dui, Nit o NRC ya existe.");
                continue; // Saltar esta iteración si ya existe
            }
            //obteniendo el pais para validar 
            $paisNombre = strtolower($row['pais']);
            //validar si el pais esta en la tabla de la base de datos de antPais
            $pais = entPais::whereRaw('LOWER(pais) = ?', [$paisNombre])->first(); 
            //si no se encentra el pais se agrega como error 
            if (!$pais) {
                $fila = $this->numeroFila + 1;
                array_push($this->errores, "Error: País '{$row['pais']}' no encontrado en la fila {$fila}.");
                continue;
            }

            // Crear nuevo cliente
            SociosCliente::create([
                'nombre' => $row['nombre'],
                'apellido' => $row['apellido'],
                'dui' => $dui,
                'nit' => $nit,
                'nrc' => $nrc,
                'tipo_cliente' => $row['tipo_cliente'],
                'magnitud_cliente' => $row['magnitud_cliente'],
                'usuario_creo_id' => 1,
                'correo' => $row['correo'],
                'direccion' => $row["direccion"],
                'activo' => 1,
                'giro_negocio' => $row['giro_negocio'],
                'pais_id' => $pais->id,
                'telefono' => $row['telefono'],
                'celular' => $row['celular'],
                'empresa_id' => Help::empresa(),
            ]);
            
            $this->ingresados++;
        }
    }

    public function getErrores()
    {
        return $this->errores;
    }

    public function getIngresados()
    {
        return $this->ingresados;
    }

    public function getNumeroFilas()
    {
       return $this->numeroFila;
    }
}