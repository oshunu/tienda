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
                <th>Nombre venta</th>
                <th>Precio Unitario</th>
                <th>Stock</th>
                <th> - </th>
            </tr>
        </thead>
    </table>         
    <form method="POST" id="ventaForm" v-on:submit.prevent="guardar">
        @include('product/form') 
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
       
        urlIndex = "{{ route('product.index') }}";
        dataTabla = $('#venta-table').DataTable({                
            "serverSide": true,
            "ajax": urlIndex,
            "columns":[
                {data:'id'},
                {data:'nombre'},
                {data:'valor_unitario'},
                {data:'stock'},    
                {data:'btn', width: "120px", className: 'text-center'},
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
            
        
    });

    const appventa = new Vue({
            el: "#appSales",
            created: function(){
              //  this.deleteCliente();
            },
            data: {                
                row:{},
                accion:'',               
            },
            methods: {
                formReset: function(){
                    this.row = { 
                        id: "", 
                        nombre: "", 
                        valor_unitario: "",                        
                        stock: "",
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
                }
            }
        });
</script>
@endsection

