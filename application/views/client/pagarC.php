<?php 
    $file_path = base_url('pedidos_archivo').'/';
    $img_path = base_url('assets/images/icons').'/';
	$order = $order->row();
?>
<div class="container">

	<div class="col-sm-12">
		<h3 class="ms-title"><b>PAGAR PEDIDO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
		<div class="panel panel-warning">
			<!-- <div class="panel-heading">
				<span class="ms-subtitle">Generales</span>
			</div> -->
		
            <div class="panel-body" >
				<div class="row">

					<div class="form-group col-sm-8">
						<label>
							Pedido No.
						</label>
                        <p>P-<?= $order->id ?></p>
                        <input type="hidden" value="<?= $order->id ?>" id="id_p" />
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
                    
				</div>
	       </div>	
		</div>
		
		
	</div>
        
    <div class="col-sm-12" >
        <div class="col-sm-12 panel panel-default " id="panel-pago" >               
    <div class="panel-body" >
        
        <div class="col-sm-12" >
                          
        </div>                
                      
        <form method="post" id="payment_form" name="payment_form" action="#">
                    <input type="hidden" name="token_id" id="token_id">
                    <input type="hidden" name="use_card_points" id="use_card_points" value="false">
                    <input type="hidden" name="device_session_id" id="device_session_id" value="false">
                    <div class="col-sm-12">
                        <h2>Tarjeta de crédito o débito</h2>
                            <div class="col-sm-4">
                             <img src="<?php echo $img_path ?>cards1.png" width="100px" height="100px" alt="" class="img-responsive" />    
                            </div>
                            <div class="col-sm-8">
                            <img src="<?php echo $img_path ?>cards2.png" width="350px" height="350px" alt="" class="img-responsive" />      
                            </div>
                            <div class="col-sm-6">
                                <label>Nombre del titular</label><input type="text" placeholder="Como aparece en la tarjeta" class="form-control" autocomplete="off" data-openpay-card="holder_name"  id="holder_name" name="name" required>
                                 <label>Fecha de expiración</label>
                                <div class="col-sm-6" >
                                <input type="text" placeholder="Mes" id="expiration_month" data-openpay-card="expiration_month" required class="form-control" maxlength="2" >
                                </div>
                                <div class="col-sm-6" >
                                <input type="text" placeholder="Año" id="expiration_year" data-openpay-card="expiration_year" required class="form-control" maxlength="2">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Número de tarjeta</label><input type="text" autocomplete="off" class="form-control" id="card"  data-openpay-card="card_number" maxlength="17" placeholder="XXXX XXXX XXXX XXXX" required>
                                <label>Código de seguridad</label>
                                <div class="col-sm-6">
                                <input type="text" placeholder="3 dígitos" autocomplete="off" id="cvv2" data-openpay-card="cvv2" required class="form-control">
                                    
                                </div>
                                <div class="col-sm-6 text-center" ><label></label>
                                <img src="<?php echo $img_path ?>cvv.png" width="150px" height="150px" alt="Ejemplos cvv" class="img-responsive" /> 
                                </div>
                            </div>
                            <div class="form-group col-sm-4" >
                                <label>Cantidad: $</label>
                                <input type="number" name="amount" id="amount" value="<?= $order->restante ?>" min="<?= $order->restante ?>" class="form-control" placeholder="Cantidad" required />
                            </div>
                            <div class="form-group col-sm-8" >
                                <label>Concepto</label>
                                <input type="text" name="description" placeholder="Concepto de Pago" class="form-control" required />
                            </div>
                            <div class="form-group col-sm-7"  >
                                <label>Correo Electrónico</label>
                                <input type="email" name="email" placeholder="Correo" required class="form-control"  />
                            </div>
                            <div class="form-group col-sm-5"  >
                                <label>Número de Teléfono</label>
                                    <input type="number" name="phone_number" id="phone_number" placeholder="Teléfono" class="form-control" required /> 
                                </div>
                            <div class="form-group col-sm-6">
                                <label>
                                    Calle:
                                </label>
                                <input type="text" name="line1" id="line1" class="form-control" required minlength="3">
                            </div>
                            <div class="form-group col-sm-3">
                                <label>
                                    No. Interior
                                </label>
                                <input type="text" name="line2" id="line2" class="form-control" required minlength="3">
                            </div>
                            <div class="form-group col-sm-3">
                                <label>
                                    Codigo Postal:
                                </label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control" required minlength="3">
                            </div>
                            <div class="form-group col-sm-9">
                                <label>
                                    Colonia:
                                </label>
                                <input type="text" name="line3" id="line3" class="form-control" required minlength="3">
                            </div>
                            <div class="form-group col-sm-3">
                                <label>
                                    Codigo del Pais
                                </label>
                                <input type="text" name="country_code"  value="MX" id="country_code" class="form-control" maxlength="2" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>
                                    Municipio:
                                </label>
                                <input type="text" name="city" id="city" class="form-control" required minlength="3">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>
                                    Estado:
                                </label>
                                <input type="text" name="state" id="state" class="form-control" required minlength="3">
                            </div>
                            
                            
                            
                            <div class="col-sm-12">
                                Transacciones realizadas vía: <img src="<?php echo $img_path ?>openpay.png" width="70px" height="70px" alt="" class="img-responsive" />  
                                <div class="shield">Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
                                 
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-m btn-primary" id="pay-button" >Procesar Tarjeta <i class="fa fa-credit-card"></i></button>
                            </div>
                            <div class="col-sm-6" ><div id="btn-cargo" ></div></div>
                            

                    </div>
            </form>
            </div>
        </div>    

    </div>  
                
                
    </div>
</div>    
    </div>    

</div>