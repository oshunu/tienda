@extends('layouts.tienda')
@section('title','Clientes')


@section('content')
<div id="appCustomer">
    <div class="row">
        <div class="col-6">                        
            <h5> <h3>Clientes</h3></h5>
        </div>
        <div class="col-6 text-right">
            <a href="#" v-on:click="btnNuevo()" class="btn btn-success btn-sm ">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Cliente 
            </a>
        </div>
    </div>
    <table id="clientes-table" class="table table-stripe table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Documento</th>
                <th>Nombres</th>                
                <th> - </th>
            </tr>
        </thead>
    </table>         
    <form method="POST" id="customerForm" v-on:submit.prevent="guardar">
        @include('customer/form') 
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
       
        urlIndex = "{{ route('customer.index') }}";
        dataTabla = $('#clientes-table').DataTable({                
            "serverSide": true,
            "ajax": urlIndex,
            "columns":[
                {data:'id'},
                {data:'documento'},
                {data:'nombres'},               
                {data:'btn', width: "120px", className: 'text-center'},
            ],
            "bLengthChange": false,
            language: {
                paginate: {
                    previous: 'Ant.',
                    next: 'Sig.'
                },
                "info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
                "search": "Buscar:",
            }
        });      

        formulario = $('#customerForm').validate({
                rules: {
                    
                },
                messages: {                   
                  
                }
            });
            
        
    });

    const appCustomer = new Vue({
            el: "#appCustomer",
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
                        documento: "", 
                        nombres: ""
                    };
                },
                btnNuevo: function(){                        
                    this.accion = 'create';
                    this.formReset();       
                    $('#customerModal').modal('show');                    
                },
                btnEditar: function(id){         
                    this.accion = 'edit';   
                    
                    this.formReset();                            
                    var url = urlIndex +  '/' + id + '/edit';
                    axios.get(url).then(response => {                       
                        this.row = response.data;
                    });    
                    $('#customerModal').modal('show');
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
                            $('#customerModal').modal('hide');
                        }).catch(error =>{
                        }); 
                    }else if(!this.row.id && this.accion == 'create'){
                        axios.post(url, this.row).then(response => {
                            dataTabla.ajax.reload();                                                    
                            this.formReset();     
                            $('#customerModal').modal('hide');
                        }).catch(error =>{            
                        });   
                    }else{
                        $('#customerModal').modal('hide');
                    }
                }
            }
        });
</script>
@endsection

