<?php 
    $img_path = base_url('assets/images/icons').'/';
	$pacient = $pacient->row();
?>
<div class="container">
    
    <h3 class="ms-title"><b>CARRITO - PACIENTE | <?= $pacient->nombre ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
    
    <div class="panel panel-primary" >
        
        <div class="panel-body">
            <h7 class="pull-right" >Articulos en el carrito | (<label id="count_carrito" ><?= $count_carrito ?></label>)</h7><br><br>
            
				<table id="carrito-table" class="table table-striped" style="width:100%">
                    <thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Subtotal</th>
							<th>Acción</th>
						</tr>
					</thead>
					<tbody>
                        <form id="carrito" >
                            
						<?php foreach ( $carritos->result() as $carrito ): ?>
							<tr id="fila<?= $carrito->id ?>" >
                                
                                <input type="hidden" id="precio_pro<?= $carrito->id ?>" value="<?= $carrito->precio ?>" />
                                
                                <input type="hidden" name="id_paciente"  id="id_paciente" value="<?= $carrito->id_paciente ?>" />
                                <input type="hidden" name="id_pro<?= $carrito->id ?>"  id="id_pro<?= $carrito->id ?>" value="<?= $carrito->id_pro ?>" />
                                
                                <input id="cantidad_ante<?= $carrito->id ?>" type="hidden" class="form-control" value="<?= $carrito->cantidad ?>" />
                                
								<td></td>
                                <td id=""><?= $carrito->id ?></td>
								<td><?= $carrito->producto ?></td>
								<td><input id="cantidad_pro<?= $carrito->id ?>" type="number" class="form-control input-update" value="<?= $carrito->cantidad ?>" /></td>
								<td><?= $carrito->precio ?></td>
								<td id="subtotal<?= $carrito->id ?>" ><?= $carrito->subtotal ?></td>
								<td><button type="submit" class="btn btn-warning btn-actualizar"><i class="glyphicon glyphicon-refresh"></i><br></button>
                                    
                                <button type="submit" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i><br></button>
                                </td>
									
                                                                   
							</tr>
						<?php endforeach ?>
                            </form> 
					</tbody>
                    
                </table><br>
            
            <div class="col-sm-6" >
                <input type="hidden" value="<?= $total_carrito ?>" id="total_carrito"  />
                
                <h4 class="pull-right" >Total:  $ <label id="total"><?= $total_carrito ?></label></h4>
                
            </div>        
            
            <div class="col-sm-6" >
                
                <div class="col-sm-6" >
                 <button class="btn btn-primary "  data-toggle="modal" data-target="#pedidoModal" >Hacer Pedido</button>
                </div>
                
                <div class="col-sm-6" >
                 <button class="btn btn-teal "  data-toggle="modal" data-target="#recetaModal" >Hacer una Receta</button>
                </div>
             
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pedidoModal" tabindex="-1" role="dialog" aria-labelledby="pedidoModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pedidoModal">Generar Pedido</h5>
        <button type="button" id="close" name="close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="col-sm-12" >
             <form id="buscar" name="buscar" method="post" >
                    <input type="hidden" name="seleccion"  id="seleccion" value="<?= $pacient->id ?>" />
                    <button class="pull-right btn btn-primary">Ver Datos de Envio</button><br>
              </form>			   
          </div>
           
            <div class="row">
                
                <div class="form-group"  >   
                <form id="new_order" name="new_order" method="post">
                
                    <div class="form-group col-sm-4">
						<label>
							Nombre:
						</label>
						<input type="text" name="nombre" id="nombre" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Apellido Paterno:
						</label>
						<input type="text" name="apellido_p" id="apellido_p" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-4">
						<label>
							Apellido Materno:
						</label>
						<input type="text" name="apellido_m" id="apellido_m" class="form-control" minlength="3">
					</div>
                    <div class="form-group col-sm-3">
						<label>
							Calle:
						</label>
						<input type="text" name="calle" id="calle" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-9">
						<label>
							Colonia:
						</label>
						<input type="text" name="colonia" id="colonia" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-6">
						<label>
							Municipio:
						</label>
						<input type="text" name="municipio" id="municipio" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-6">
						<label>
							Estado:
						</label>
						<input type="text" name="estado" id="estado" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-3">
						<label>
							Codigo Postal:
						</label>
						<input type="text" name="cp" id="cp" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-6">
						<label>
							Telefono(s):
						</label>
						<input type="text" name="tels" id="tels" class="form-control" required minlength="3">
					</div>  
                    <div class="form-group col-sm-3">
						<label>
							RFC:
						</label>
						<input type="text" name="rfc" id="rfc" class="form-control" minlength="3">
					</div>
                
                <div class="form-group col-sm-12">
                    <label>
                        Detalles:
                    </label>
                    
                   <table id="carrito-table" class="table table-striped" style="width:100%">
                    <thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th><th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $carritos->result() as $carrito ): ?>
							<tr id="filaM<?= $carrito->id ?>">
                                
								<td></td>
                                <td><?= $carrito->id ?></td>
								<td><?= $carrito->producto ?></td>
								<td><label id="cantidad_new<?= $carrito->id ?>" ><?= $carrito->cantidad ?></label></td>
								<td></td>
								<td  ></td>
								<td>
                                </td>                                 
							</tr>
						<?php endforeach ?>
                           
					</tbody>
                </table>
                     
                </div>
                
            
                
                <h3 class="text-center" >Total del Pedido: $ <label id="total_final"><?= $total_carrito ?></label></h3>
                     
                <input type="hidden" name="id_paciente_pedido"  id="id_paciente_pedido" value="<?= $pacient->id ?>" />
                <input type="hidden" name="seguim"  id="seguim" value="<?= $pacient->seguim ?>" />
                
                <input type="hidden" name="id_user_pedido"  id="id_user_pedido" value="<?= $this->session->id ?>" />
                
                <input type="hidden" name="total_bd"  id="total_bd" value="<?= $total_carrito ?>" />
                     
                <div class="form-group col-sm-6" >
                    <label>
                        Datos de Pago:
                    </label>
                    <select required id="metodo" name="metodo" class="form-control"  >
                        <option>Elige método de pago</option>
                        <option value="Tarjeta" >Tarjeta</option>
                        <option value="Efectivo" >Efectivo</option>
                        <option value="Credito" >Crédito</option>
                        <option value="Transferencia" >Transferencia</option>
                    </select>
                </div>
                <div class="form-group col-sm-6" >
                    <label>
                        Concepto:
                    </label>
                    <input placeholder="Agrega concepto de pago" required class="form-control" name="referencia_pago" id="referencia_pago"   />
                </div>
                <div class="col-sm-12" hidden id="panel-pago" >
                    <input type="text" id="folio" name="folio" placeholder="No. de Pago" class="form-control" />    
                </div>
                <div class="col-sm-6 text-center" >
                    <label><input type="checkbox" name="pagar-parte" id="pagar-parte" />Solo pagar una parte del pedido</label>
                    
                </div>
                <div class="col-sm-6 text-center" id="pagar-parte-input" ></div>
                <div class="form-group col-sm-12 " >
                    <label>
                        Nota:
                    </label>
                    <textarea id="detalle" name="detalle" placeholder="Agregue aquí cualquier aclaración o comentario sobre el pedido" class="form-control" ></textarea>
                </div>
                <div class="col-sm-12 text-center" >
                <button type="submit" class="btn btn-primary" id="btn-hacer-pedido"><i class="fa fa-file"></i><br>Hacer Pedido</button>
                </div>
            </form>

    </div>  
                
                
    </div>
</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          
          </div>
       
    </div>
  </div>
</div>


<div class="modal fade" id="recetaModal" tabindex="-1" role="dialog" aria-labelledby="recetaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pedidoModal">Generar Receta</h5>
        <button type="button" id="close2" name="close2" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <div class="modal-body">
          <div class="row" >
                <form id="new_receta" name="new_receta" method="post">
                    <div class="form-group col-sm-8" >
                    <label>Médico</label>
                    <input type="text" required value="Dr. <?= $this->session->name ." ". $this->session->apellido_m  ?>" class="form-control" id="medico" name="medico" />
                    </div>
                    
                    <div class="form-group col-sm-4" >
                    <label>Cédula</label>
                    <input type="text" required value="<?= $this->session->cedula  ?>" class="form-control" id="cedula" name="cedula" />
                    </div>
                    
                    <div class="form-group col-sm-4" >
                    <label>Expediente</label>
                    <input type="text" required value="<?= $pacient->clave_bancaria  ?>" class="form-control" id="expediente" name="expediente" />
                    <input type="hidden" required value="<?= $pacient->id  ?>" class="form-control" id="paciente_id" name="paciente_id" />
                    </div>
                    
                    <div class="form-group col-sm-8" >
                    <label>Paciente</label>
                    <input type="text" required value="<?= $pacient->nombre . " ". $pacient->apellido_p ." ". $pacient->apellido_m ?>" class="form-control" id="paciente" name="paciente" />
                    </div>
                    
                    <div class="form-group col-sm-12" id="recetaCantidad" >
                    <label>Descripción</label>
                    <textarea class="form-control" rows="8" id="descripcion" name="descripcion" >Dosis: <?php foreach ( $carritos->result() as $carrito ): ?>  
-<?= $carrito->producto ?> Cantidad: <?= $carrito->cantidad ?> 
<?= $carrito->descripcion ?><?php endforeach ?></textarea>
                    
                    </div>
                        <div class="col-sm-12 text-center" >
                        <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i><br>Hacer Receta</button>
                            
                        <div id="btn_ver_receta"></div>    
                        </div>
                </form>
          </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        
        </div>    
    </div>
</div>
