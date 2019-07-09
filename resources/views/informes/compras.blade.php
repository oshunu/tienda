<br /><br />
    <h5>INFORME PRODUCTO X RANGO</h5>
    <div class="row" id="informeApp">
        <div class="col-3">                        
            <div class="form-group ">                                                       
                <label>Fecha Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" v-model="fecha_inicio" >
                
            </div>
        </div>
        <div class="col-3">
            <div class="form-group ">                                                       
                <label>Fecha Final:</label>
                <input type="date" name="fecha_final" id="fecha_final" class="form-control" v-model="fecha_final" >
                
            </div>
        </div>
        <div class="col-2"><br />
            <button type="button" class="btn btn-primary" v-on:click="btnBuscar()" >Buscar</button>
        </div>
        
    </div>
    <div id="resultado"></div>
    
    <script>
    

    const informeApp = new Vue({
            el: "#informeApp",
            created: function(){
             
            },
            data: {       
                fecha_inicio:'',
                fecha_final:''          
            },
            methods: {
               
                btnBuscar: function(){     
                    if(this.fecha_inicio == ''){
                        alert('Seleccione una fecha de inicio');
                        return false;
                    }       
                    if(this.fecha_final == ''){
                        alert('Seleccione una fecha de final');
                        return false;
                    }            
                    var url = "{{ url('informes/buscar') }}"+'?fecha_inicio='+this.fecha_inicio+'&fecha_final='+this.fecha_final;
                    axios.get(url).then(response => {                       
                       // console.log(response.data);
                        $('#resultado').html(response.data);
                    });            
                }
            }
        });
</script>
    <br /><br /><br /><br />
          