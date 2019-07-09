<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sale::query();
            return datatables()->eloquent($data)
                ->addColumn('btn', function ($sale) {
                    return view('helpers.tablaBotonesVue', ['obj' => 'appSales', 'id' => $sale->id])->render();
                })               
               
                ->rawColumns(['btn'])
                ->toJson();
        }
       
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'valor_unitario' => 'required'
        ]);
        $input = $request->all();
        
        $res = Sale::create($input);
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Sale::findOrFail($id);
        return $producto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fecha' => 'required',
            'customer_id' => 'required'
        ]);
        $input = $request->all();
       
        $producto = Sale::find($id);
        $producto->update($input);
        
        return response()->json($producto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Sale::findOrFail($id);
        $producto->delete();
    }
}
