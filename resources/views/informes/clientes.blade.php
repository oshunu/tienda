<?php 
use Illuminate\Support\Facades\DB;
$list = DB::table('sales as sa')
    ->join('customers as cu', 'sa.customer_id', '=', 'cu.id')
    ->select('cu.nombres', 'cu.documento', DB::raw('SUM(sa.total) as total_sales'))
    ->groupBy('sa.customer_id')
    ->orderBy('total_sales','desc')
    ->take(5)
    ->get();
?>
   
    <h5>5 PRIMEROS CLIENTES CON MAS COMPRAS</h5>
    
    <table class="table">
        <thead>
            <tr>                  
            <th scope="col">#</th>             
            <th scope="col">Cliente</th>
            <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>1</td>
                    <th scope="row">{{ $item->nombres}}</th>
                    <td class="text-right">{{ number_format($item->total_sales, 0, ',', '.') }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
          