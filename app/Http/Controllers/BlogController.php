<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Help\HttpClient;


class BlogController extends Controller
{
    
    
       
    public function dashboard(Request $request){

        $tipos =HttpClient::post('api/tipos/tipo-posts');
        
    
        return view('blog.dashboard', compact('tipos'));

    }
}
