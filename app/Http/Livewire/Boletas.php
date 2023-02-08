<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Help\HttpClient;
use App\Help\Help;

class Boletas extends Component
{

    public $year, $tipo,  $data, $dui, $mensaje, $text;

    public function mount(){
        $this->year = Help::year();
        $this->tipo ='sueldo';
        $this->dui = auth()->user()->dui;
        $this->mensaje = "No hay boletas de pago para el año solicitado: ".$this->year;
        $this->obtenerboletas();
    }

    public function render()
    {
        return view('livewire.boletas');
    }

   

    public function obtenerboletas(){
        if($this->tipo=='sueldo')
        {
            $this->data = HttpClient::get('api/boleta-pago/boletas/'.$this->dui.'/'.$this->year);
        }
        else {
            $this->mensaje = "No hay boletas para el tipo solicitado";
            $this->data = HttpClient::get('api/diciembre/all/'.$this->dui.'/'.$this->tipo);
        }
            
    }
}
