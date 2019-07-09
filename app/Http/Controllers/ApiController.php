<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ApiController extends Controller
{
    public function index()
    {
        //$productos = Product::where('stock', '>', 0)->get();
        $productos = Product::get();
        return $productos;
    }

    public function product($id)
    {
        
        $producto = Product::findOrFail($id);
        return $producto;
        
    }

   
}
