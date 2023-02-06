<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Help\HttpClient;


class BlogController extends Controller
{
    
    
       
    public function dashboard(Request $request){

        $tipos =HttpClient::post('api/tipos/tipo-posts');
       
        $blogs = HttpClient::get('api/post/ultimos/9');
        return view('blog.dashboard', compact('tipos', 'blogs'));

    }

    
}
