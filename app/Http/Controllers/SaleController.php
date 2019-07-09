<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Sale;
use App\SaleDetail;
use App\Product;

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
                ->addColumn('customer_id', function ($sale) {
                    return $sale->cliente->nombres;
                })               
               
                ->rawColumns(['btn','customer_id'])
                ->toJson();
        }
       
        return view('sale.index');
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
            'fecha' => 'required',
            'customer_id' => 'required'
        ]);
        $input = $request->all();
        
        $sale = Sale::create($input);
        if( $input['detalles']){
            foreach($input['detalles'] as $deta){
                $detalle = [
                    'sale_id' => $sale->id,
                    'product_id' => $deta['product_id'],
                    'cantidad' => $deta['cantidad'],
                    'valor_unitario' => $deta['valor_unitario'],
                    'total' => $deta['total'],
                    
                ];
                $res = SaleDetail::create($detalle);
            }
        }
        return response()->json($sale);
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
        $detalles = $user = DB::table('sale_details')->where('sale_id', $id)->get();
        foreach($detalles as $i => $data){
            $producto = Product::findOrFail($data->product_id);
            
            $detalles[$i]->product_nombre = $producto->nombre;
        }
        $producto['detalles']=  $detalles;
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
       
        $sale = Sale::find($id);
        $sale->update($input);
        DB::table('sale_details')->where('sale_id', $id)->delete();
        if( $input['detalles']){
            foreach($input['detalles'] as $deta){
                $detalle = [
                    'sale_id' => $sale->id,
                    'product_id' => $deta['product_id'],
                    'cantidad' => $deta['cantidad'],
                    'valor_unitario' => $deta['valor_unitario'],
                    'total' => $deta['total'],
                    
                ];
                $res = SaleDetail::create($detalle);
            }
        }
        
        return response()->json($sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       

        DB::table('sale_details')->where('sale_id', $id)->delete();

        $sale = Sale::findOrFail($id);
        $sale->delete();

    }
}
