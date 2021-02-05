<?php 
	$order = $order->row();
?>
<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>EDITAR PEDIDO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="panel panel-warning">
			<!-- <div class="panel-heading">
				<span class="ms-subtitle">Generales</span>
			</div> -->
			<form id="edit_order_form" class="panel-body border-left-warning">
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="id" value="<?= $order->id ?>">
				<div class="row">

					<div class="form-group col-sm-8">
						<label>
							Pedido No.
						</label>
                        <p>P-<?= $order->id ?></p>
                        
					</div>
                    <div class="form-group col-sm-4">
						<label>
							Fecha de Realización:
						</label>
                        <p><?= $order->fecha_pedido ?></p>
					</div>
					<div class="form-group col-sm-4">
						<label>
							Total:
						</label>
                        <p>$ <?= $order->total ?></p>
					</div>
                    <div class="form-group col-sm-4">
						<label>
							Restante:
						</label>
                        <p>$ <?= $order->restante ?></p>
					</div>
                    <div class="form-group col-sm-4">
						<label>
							Pagado:
						</label>
                        <p>$ <?= $order->pagado ?></p>
					</div>
					
					<div class="form-group col-sm-9">
						<label>
							Referencia Pago:
						</label>
                        <p><?= $order->referencia_pago ?></p>
                         
					</div>
					<div class="form-group col-sm-3">
						<label>
							Fecha Pago:
						</label>
                        
                        <?php if ($order->status == 'Pendiente'){
                        ?><br>
                        <b>Sin pagar</b>
                        <?php } else { ?>
                        <p><?= $order->fecha_pago ?></p>
                        <?php }   ?>
                        
					</div>
					<div class="form-group col-sm-4">
						<label>
							Método:
						</label>
                         <?php if ($order->status == 'Pendiente'){
                        ?>
                        <p><?= $order->metodo ?></p>
                        
                        <?php } else { ?>
						<p><?= $order->metodo ?></p>
                         <?php }   ?>
                        
					</div>
					<div class="form-group col-sm-4">
						<label>
							Estatus:
						</label>
                         <?php if ($order->status == 'Entregado' or $order->status == 'Cancelado'){
                        ?>
                        <p><?= $order->status ?></p>
                        
				        <input type="hidden" name="status" value="<?= $order->status ?>">
                        <?php } else if ($order->status == 'Pagado') { ?>
                        <p><?= $order->status ?></p>
                        
                          <select required class="form-control" name="status"   >
                            <option value="" >Seleccione nuevo estatus</option>
                            <option value="Enviado" >Enviado</option>
                            <option value="Entregado" >Entregado</option>
                        </select>
                        
                         <?php } else {   ?>
                        <p><?= $order->status ?></p>
                        <?php   } ?>
                        
					</div>
					<div class="form-group col-sm-4">
						<label>
							Notas:
						</label><br>
                        <textarea name="detalle" class="form-control" ><?= $order->detalle ?></textarea>
					</div>
                    
                    <div class="form-group col-sm-12 text-center" >
                    <a  href="<?= base_url().'pedidos/mostrar/'.$order->id ?>  " class="btn btn-teal"><i class="fa fa-eye"></i> <br>Mostrar Pedido</a>
                    </div>

				</div>
				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
				
			</form>
		</div>
		
		
	</div>

</div>