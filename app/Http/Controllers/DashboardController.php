<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RRHH\RRHHEmpresa;


class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }
}
