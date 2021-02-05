<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>SUCURSALES </b><?= count($sucursales->result()) ?></h3>
	</div>	
	
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">	
                
		
			<table id="main-table" class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Razón Social</th>
						<th>Municipio</th>
						<th>Estado</th>
						<th>País</th>
						<th>Código Postal</th>
						<th>Teléfono</th>
						<th >Opc.</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $sucursales->result() as $sucursal ): ?>
						<tr>
							<td><?= $sucursal->id ?></td>
							<td><?= $sucursal->razon_social ?></td>
							<td><?= $sucursal->municipio ?></td>
							<td><?= $sucursal->estado ?></td>
							<td><?= $sucursal->pais ?></td>
							<td><?= $sucursal->cp ?></td>
							<td><?= $sucursal->telefono ?></td>
							
							<td class="text-center btn-group">
                                
								<a href="<?= base_url().'sucursales/editar/'.$sucursal->id ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                
								<button class="btn btn-sm btn-info btn-info-user" data-id="<?= $sucursal->id  ?>"><i class="fa fa-file-text-o"></i></button>
                                
								<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
							</td>					
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>

			</div>
		</div>
	</div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="modal-info">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-info bg-transparent">
			
			<div class="header-modal-info  flex-row-start">
				<button type="button" class="close white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="img-circle img-modal-info col-xs-3">
				    <img src="<?php echo IMG_PATH; ?>icon_building.png" alt="" class="img-responsive">
				</div>			
				<div class="col-xs-8">
					<h3 class="mt-0 capitalize text-shadow office-name"></h3>
					<label id="office-active" class="label label-primary label-bg"></label><label id="office-inactive" class="label label-default label-bg"></label>
				</div>
				<div class="bg-modal-info-office"></div>
			</div>

			<table class="modal-body bg-white table table-modal-info mb-0">
				<tbody>
					<tr>
						<th>País:</th>
						<td id="office-pais"></td>
					</tr>
					<tr>
						<th>Estado:</th>
						<td id="office-estado"></td>
					</tr>
					<tr>
						<th>Municipio:</th>
						<td id="office-municipio"></td>
					</tr>
					<tr>
						<th>Dirección:</th>
						<td><span id="office-direccion"></span> C.P. <span id="office-cp"></span</td>
					</tr>
					<tr>
						<th>Telefono:</th>
						<td id="office-telefono"></td>
					</tr>
					<tr>
						<th>Cuenta Bancaria:</th>
						<td id="office-cuenta_bancaria"></td>
					</tr>
				</tbody>
			</table>
			<div class="modal-footer bg-white">
                
                
				<a href="" class="btn btn-info" id="btn-modal-calendario">Calendario</a>
                
                <a href="" class="btn btn-warning" id="btn-modal-edit">Editar</a>
			</div>


		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->