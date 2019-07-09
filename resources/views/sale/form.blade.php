<?php 
use App\Customer;
use App\Product;
?>
<div id="ventaModal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <label>Fecha:</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" v-model="row.fecha" placeholder="Fecha" required>
                                <input type="hidden" v-model="row.id" id="producto_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 ">
                            <div class="form-group ">                                                       
                                <label>Cliente:</label>
                                <?php 
                                $items = Customer::pluck('nombres', 'id');
                                ?>                               
                                {!! Form::select('customer_id', $items, null, ['class' => 'form-control',' v-model'=>'row.customer_id']) !!}
                            </div>
                        </div>
                    </div>
                    <b>Agregar Productos</b>
                    <div class="row">

                        <div class="col-sm-4 ">
                                <?php 
                                $items_product = Product::pluck('nombre', 'id');
                                ?>                               
                                {!! Form::select('product_id', $items_product, null, ['class' => 'form-control',' v-model'=>'add.product_id']) !!}
                        </div>
                        <div class="col-sm-2 ">
                            <input type="number" name="cantidad" id="add_cantidad" class="form-control" v-model="add.cantidad" placeholder="Cantidad" >
                        </div>
                        <div class="col-sm-2 ">
                            <input type="number" name="valor_unitario" id="add_valor_unitario" class="form-control" v-model="add.valor_unitario" placeholder="Valor"    >
                        </div>
                        <div class="col-sm-2 ">
                            <input type="text" name="total" id="add_total" class="form-control" v-model="add.total" readonly    >
                        </div>
                        <div class="col-sm-2 text-right ">
                            <button type="button" class="btn btn-primary" v-on:click="detalleAdd()">ADD</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class=" col-sm-12 ">
                            <b>Detalles de la Venta</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-sm-12 ">
                        <table class="table">
                            <thead>
                                <tr>                               
                                <th scope="col">Producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Valor Unitario</th>
                                <th scope="col">Total</th>
                                <th scope="col">-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in row.detalles">
                                    <th scope="row">@{{ item.product_id }}</th>
                                    <td>@{{ item.cantidad }}</td>
                                    <td>@{{ item.valor_unitario }}</td>
                                    <td>@{{ item.total }}</td>
                                    <td class="text-right"><button type="button" class="btn btn-info" v-on:click="detalleEliminar(item)">X</button></td>
                                </tr>
                                
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-sm-12 text-right">
                            <h3>TOTAL: @{{ row.total }}</h3>
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