@extends('layouts.tienda')
@section('title','Ventas')


@section('content')
<div id="appSales">
    <div class="row">
        <div class="col-6">                        
            <h5> <h3>Ventas</h3></h5>
        </div>
        <div class="col-6 text-right">
            <a href="#" v-on:click="btnNuevo()" class="btn btn-success btn-sm ">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Nueva Venta 
            </a>
        </div>
    </div>
    <table id="venta-table" class="table table-stripe table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th > - </th>
            </tr>
        </thead>
    </table>         
    <form method="POST" id="ventaForm" v-on:submit.prevent="guardar">
        @include('sale/form') 
    </form>
    <form id="form_destroy" action="#" method="POST">
        @method('DELETE')
        @csrf                        
    </form>    
</div>
@endsection
@section('scripts')
<script>
    var formulario = '';
    var urlIndex = '';
    var dataTabla = '';
    $(document).ready(function() {
       
        urlIndex = "{{ route('sale.index') }}";
        dataTabla = $('#venta-table').DataTable({                
            "serverSide": true,
            "ajax": urlIndex,
            "columns":[
                {data:'id'},
                {data:'fecha'},
                {data:'customer_id'},
                {data:'total'},    
                {data:'btn', width: "120px", className: 'text-right'},
            ],
            "bLengthChange": false,
            language: {
                paginate: {
                    previous: 'Ant.',
                    next: 'Sig.'
                },
                "info": "Mostrando _START_ a _END_ de _TOTAL_ ventas",
                "search": "Buscar:",
            }
        });      

        formulario = $('#ventaForm').validate({
                rules: {
                    
                },
                messages: {                   
                 
                }
            });
            
        $( "#add_cantidad, #add_valor_unitario" ).keyup(function() {
            var cantidad = $('#add_cantidad').val();
            var valor_unitario = $('#add_valor_unitario').val();
            
            $('#add_total').val(eval(cantidad) * eval(valor_unitario));
        });
    });

    const appSales = new Vue({
            el: "#appSales",
            created: function(){
              //  this.deleteCliente();
            },
            data: {       
                add:{
                    product_id:'',
                    valor_unitario:'',
                    cantidad:'',
                    total:'',
                    
                } ,       
                row:{
                    detalles:[]
                },
                accion:'',               
            },
            methods: {
                formReset: function(){
                    this.row = { 
                        id: "", 
                        fecha: "", 
                        customer_id: "",                        
                        total: 0,
                        detalles:[]
                    };
                },
                btnNuevo: function(){                        
                    this.accion = 'create';
                    this.formReset();       
                    $('#ventaModal').modal('show');                    
                },
                btnEditar: function(id){         
                    this.accion = 'edit';   
                    
                    this.formReset();                            
                    var url = urlIndex +  '/' + id + '/edit';
                    axios.get(url).then(response => {                       
                        this.row = response.data;
                        this.detalleCalcular();
                    });    
                    $('#ventaModal').modal('show');
                },
                btnEliminar: function(id){
                    if(confirm('Esta seguro que desea eliminar este registro?')){
                        var url = urlIndex + '/'+id;
                        axios.delete(url).then(response => {
                            dataTabla.ajax.reload();
                        });                    
                    }
                },
                guardar: function(){          
                    console.log(this.accion)
                    formulario.form();
                    if (!formulario.valid()) {      
                        return false;
                    }   
                    var url = urlIndex ;
                    if(this.row.id && this.accion == 'edit'){
                        axios.put(url+'/'+this.row.id, this.row).then(response => {
                            dataTabla.ajax.reload();                        
                            this.formReset();     
                            $('#ventaModal').modal('hide');
                        }).catch(error =>{
                        }); 
                    }else if(!this.row.id && this.accion == 'create'){
                        axios.post(url, this.row).then(response => {
                            dataTabla.ajax.reload();                                                    
                            this.formReset();     
                            $('#ventaModal').modal('hide');
                        }).catch(error =>{            
                        });   
                    }else{
                        $('#ventaModal').modal('hide');
                    }
                },
                detalleAdd: function(){ 
                    
                    if(this.add.product_id == ''){
                        alert('seleccione un producto');
                        return false;
                    }
                    if(this.add.cantidad == ''){
                        alert('digite una cantidad');
                        return false;
                    }
                    if(this.add.valor_unitario == ''){
                        alert('digite un valor unitario');
                        return false;
                    }
                    this.add.product_nombre  =  $( "#add_producto_id option:selected" ).text();
                    

                    this.add.total = eval(this.add.cantidad) * eval(this.add.valor_unitario);
                    this.row.detalles.push(this.add);
                    this.detalleCalcular();
                    if( this.row.detalles.length > 5){
                        alert('se aplica descuento')
                        var descuento  = eval(this.row.total)* eval(0.1);
                        alert(descuento)
                    }
                    this.add = [];

                },
                detalleEliminar: function(index){                    
                    this.row.detalles.splice(index, 1);
                    this.detalleCalcular()
                },
                detalleCalcular: function(){
                    var total2 =0;
                    $.each(this.row.detalles, function(key, value) {
                        total2 = eval(total2) + eval(value.total);
                    });
                    this.row.total = total2;
                }
            }
        });
</script>
@endsection

