
<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>PEDIDOS</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="panel panel-warning">
            
            <div class="panel panel-default">
			<div class="panel-body">
            <div class="panel-heading " >
                <h3><label>Tus Pedidos</label></h3>
           </div> 
                <?php if (empty($pedidos->result())){ ?>
                
                <h3>Aún no tienes pedidos</h3>
                
                <?php }else{ ?>        
				<table id="main-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>No.</th>
							<th>Total</th>
							<th>Restante</th>
							<th>Pagado</th>
							<th>Estatus</th>
							<th>Fecha</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
                       
						<?php  foreach ( $pedidos->result() as $pedido ): ?>
                            <tr>
								<td></td>
								<td>P-<?= $pedido->id ?></td>
								<td><?= $pedido->total ?></td>
								<td><?= $pedido->restante  ?></td>
								<td><?= $pedido->pagado  ?></td>
								<td>
                                    <?php
										switch ($pedido->status) {
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
                                
								</td>
								<td><?= $pedido->fecha_pedido  ?></td>
								<td class="text-center btn-group">
									<a href="<?= base_url().'paciente/pedido/mostrar/'.$pedido->id ?>" class="btn btn-sm btn-info"><i class="fa fa-file-text-o"></i></a>
									<?php if ($pedido->status == "Pendiente"){ ?>
                                    <a href="<?= base_url().'paciente/pedido/pagar/'.$pedido->id ?>" class="btn btn-sm btn-warning" title="Pagar"><i class="fa fa-money"></i></a>
                                    <?php } ?>
								</td>
                               
							</tr>
						<?php endforeach   ?>
					</tbody>
				</table>
                
                <?php } ?>
                
                <div class="col-sm-12 text-center" >
                    <p>Si tienes alguna duda o un dato esta incorrecto favor de comunicarte con un administrador <a  href="mailto:desarrollo_software@megasalud.com.mx" >desarrollo_software@megasalud.com.mx</a> </p>
                
                </div>
                
			</div>
		</div>
	
		</div>
	</div>

</div>
