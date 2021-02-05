<?php 
    $file_path = base_url('pedidos_archivo').'/';
$img_path = base_url('assets/images/icons').'/';
	$order = $order->row();
?>
<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>MOSTRAR PEDIDO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
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
                    <div class="form-group col-sm-4">
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
							Referencia Pago:
						</label>
                        <p><?= $order->referencia_pago ?></p>
					</div>
					
					<div class="form-group col-sm-4">
						<label>
							Método:
						</label>
                        <p><?= $order->metodo ?></p>
                        
					</div>
					<div class="form-group col-sm-4">
						<label>
							Estatus:
						</label>
                         <?php
				        switch ($order->status) {
											case "Entregado":
                                    ?>
                                    <span class="label label-success" >
                                    Entregado
                                    </span>    
                                    <?php break;
											case "Pendiente":?>
                                    <span class="label label-warning" >
                                    Pendiente
                                    </span>    
                                    <?php    break;
                                            case "Cancelado": ?>
                                    <span class="label label-danger" >
                                    Cancelado
                                    </span>    
                                    <?php  break;
                                            case "Pagado": ?>
                                    <span class="label label-default" >
                                    Pagado
                                    </span>    
                                    <?php                                      break;
                                        case "Enviado":
                                                 ?>
                                    <span class="label label-primary" >
                                    Enviado
                                    </span>    
                                    <?php
                                         break;
										}
								?>
                     
                        
					</div>
					<div class="form-group col-sm-8">
						<label>
							Notas:
						</label><br>
                        
                        <p><?= $order->detalle ?></p>
					</div>
                    
                   
                    <?php if ($order->archivo == ""){ ?>  
                            
                    <div class="col-sm-12" >
                    
                            <p>No tiene archivos </>
                    </div>
                                
                        <?php  } else {  ?>
                        
                        
                    
                        <div style="width:100%px; height:600px;"  class="form-group col-sm-12" >
                    
                        <embed height="100%" width="100%" name="embed_content" src="<?php echo base_url($order->archivo) ?>" type="application/pdf"  />
                    
                         </div>

                       <?php } ?>
                    
                    
				</div>
			</form>
		</div>
		
		
	</div>

</div>