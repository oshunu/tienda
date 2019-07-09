<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformesController extends Controller
{
    public function index(Request $request)
    {
        
        return view('informes.index');
    }

    public function buscar(Request $request)
    {
        
        return view('informes.resultado');
    }
}
