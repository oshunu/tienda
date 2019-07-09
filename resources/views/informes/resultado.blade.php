<?php 
use Illuminate\Support\Facades\DB;
$list = DB::table('sales as sa')
    ->join('sale_details as de', 'sa.id', '=', 'de.sale_id')
    ->join('products as pr', 'de.product_id', '=', 'pr.id')
    ->join('customers as cu', 'sa.customer_id', '=', 'cu.id')
    ->select('pr.nombre', 'cu.nombres', DB::raw('SUM(de.total) as total_sales'))
    ->where('sa.fecha', '>=', $_GET['fecha_inicio'])
    ->where('sa.fecha', '<=', $_GET['fecha_final'])
    ->groupBy('de.product_id')
    ->groupBy('sa.customer_id')
    ->orderBy('total_sales','desc')
    ->take(5)
    ->get();
?>
    
<h5>5 PRODUCTOS MAS VENDIDOS</h5>
<table class="table">
    <thead>
        <tr>                  
        <th scope="col">#</th>             
        <th scope="col">Cliente</th>
        <th scope="col">Producto</th>
        <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            <tr>
                <td>1</td>
                <th scope="row">{{ $item->nombres}}</th>
                <th scope="row">{{ $item->nombre}}</th>
                <td class="text-right">{{ number_format($item->total_sales, 0, ',', '.') }}</td>
                
            </tr>
        @endforeach
    </tbody>
    </table>
            