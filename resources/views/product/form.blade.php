<!-- Modal -->
<div id="productoModal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="">Productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-6 ">
                            <div class="form-group ">                                                       
                                <label>Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" v-model="row.nombre" placeholder="Nombre." required>
                                <input type="hidden" v-model="row.id" id="producto_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 ">
                            <div class="form-group ">                                                       
                                <label>Precio Unitario:</label>
                                <input type="text" name="valor_unitario" id="valor_unitario" class="form-control" v-model="row.valor_unitario" placeholder="Valor Unitario." required>
                               
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 ">
                            <div class="form-group ">                                                       
                                <label>Stock:</label>
                                <input type="text" name="stock" id="stock" class="form-control" v-model="row.stock" placeholder="Stock" >
                               
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>