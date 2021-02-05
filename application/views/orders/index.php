<div class="container">

	<div class="col-xs-12">
		<h3 class="ms-title"><b>PEDIDOS - <?= $this->session->sucursal_name ?></b></h3>
	</div>
	
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="main-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Paciente</th>
							<th>Usuario</th>
							<th>Importe</th>
							<th>Impuesto</th>
							<th>Total</th>
							<th>Fecha de Pedido</th>
							<th>Fecha de Pago</th>
							<th>Metodo</th>
							<th>Estatus</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $data as $order ): ?>
							<tr>
								<td></td>
								<td>P-<?= $order->id ?></td>
								<td><?= $order->nombrep  ?></td>
								<td><?= $order->nombre  ?></td>
								<td><?= $order->importe ?></td>
								<td><?= $order->impuesto ?></td>
								<td><?= $order->total ?></td>
								<td><p><?php echo date("j M, Y h:i a", strtotime($order->created_at))  ?></p></td>
								<td><?= $order->fecha_pago ?></td>
								<td><?= $order->metodo ?></td>
								<td>
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
                                
								</td>
								<td class="text-center btn-group">
                                    
                                    <a href="<?= base_url().'pedidos/editar/'.$order->id ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    
                                    <a href="<?= base_url().'pedidos/mostrar/'.$order->id ?>" class="btn btn-sm btn-info"><i class="fa fa-file-text-o"></i></a>
                                    
									<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
								</td>					
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
    
    <div class="col-sm-12">
		<h3 class="ms-title"><b>ABONOS </b> </h3>

	</div>
    
    <div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="abonos-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>No. Pedido</th>
							<th>Usuario</th>
							<th>Paciente</th>
							<th>Abono</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
    
    
    
    
    <?php if($this->session->type == "Administrador" || $this->session->type == "Contador"){ ?>
    <div class="col-sm-12">
		<h3 class="ms-title"><b>VER SUCURSALES </b> </h3>
        <div class="text-center" ><h3><div id="suc_select" ></div> </h3></div>
	</div>
    
  
    
    <div class="col-sm-12" >
        <div class="panel panel-olive" >
            <div class="panel-body border-left-olive" >
                <div class="col-sm-6" >
                <form id="find_suc">
                <label>
                    Sucursal
                </label>

                <select id="sucursal_s" name="sucursal_s" class="form-control" required >
                     <?php if($this->session->type == "Administrador" || $this->session->type == "Contador"){ ?>
                    <option value="" selected >Seleccione una opción</option>
                    <?php foreach ($sucursales->result() as $sucursal): ?>
                    <option value="<?= $sucursal->id ?>"><?= $sucursal->razon_social ?></option>
                    <?php endforeach ?>
                     <?php }else{ ?>
                    <option value="<?= $this->session->sucursal ?>" >Tu sucursal</option>
                    <?php } ?>
                </select>
                    </form>
             </div><br>
                <div class="col-sm-12" >
                <table id="sucursales-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Paciente</th>
							<th>Usuario</th>
							<th>Importe</th>
							<th>Impuesto</th>
							<th>Total</th>
							<th>Fecha de Pedido</th>
							<th>Estatus</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody id="abonos-table">
					</tbody>
				</table>
                </div>
            </div>
        </div>
        
        
    </div>
    
    
    
    <?php } ?>
    
    
    
</div>
