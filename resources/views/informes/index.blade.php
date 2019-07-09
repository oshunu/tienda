@extends('layouts.tienda')
@section('title','Informes')


@section('content')

    <div class="row">
        <div class="col-6">                        
            <h4> INFORMES</h4>
        </div>
        <div class="col-6 text-right">
           
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">                        
            @include('informes/clientes') 
        </div>
        <div class="col-md-6">
            @include('informes/productos') 
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">                        
            @include('informes/compras') 
        </div>
       
    </div>
   
@endsection
@section('scripts')
<script>

</script>
@endsection

