<div class="container">

	<div class="col-xs-12">
		<h3 class="ms-title"><b>PERMISOS</b></h3>
	</div>	
	
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">

				<table id="main-table" class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Display</th>
							<th>Descripcion</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $query->result() as $permiso ): ?>
							<tr>
								<td></td>
								<td><?= $permiso->id ?></td>
								<td><?= $permiso->name ?></td>
								<td><?= $permiso->display_name ?></td>
								<td><?= $permiso->description ?></td>
								<td class="text-center btn-group">
									<a href="<?= base_url().'permisos/editar/'.$permiso->id ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
									<button class="btn btn-sm btn-info" data-id="<?= $permiso->id  ?>"><i class="fa fa-file-text-o"></i></button>
									<button class="btn btn-sm btn-danger btn-delete" data-id="<?= $permiso->id  ?>"><i class="fa fa-trash"></i></button>
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
			
			<div class="modal-head panel panel-primary text-center no-border">
				<div class="panel-heading">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					DETALLES DEL PERMISO
				</div>
				<div class="modal-body panel-body">
					<b>Nombre:</b>
					<p id="permission-name"></p>
					<b>Nombre a mostrar:</b>
					<p id="permission-display"></p>
					<b>Descripción:</b>
					<p><pre id="permission-description" class="pre-from-textarea"></pre></p>
				</div>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->