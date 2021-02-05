<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>ROLES</b></h3>
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
							<th>Permisos</th>
							<th style="width: 110px">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $roles->result() as $rol ): ?>
							<tr>
								<td></td>
								<td><?= $rol->id ?></td>
								<td><?= $rol->name ?></td>
								<td><?= $rol->display_name ?></td>
								<td>
									<?php 
										if(isset($roles_permisos[$rol->id])){
											$str = implode(' | ', $roles_permisos[$rol->id]);
											if(strlen($str) < 50 ){
												echo $str;
											}else{
												echo substr($str, 0, 50).'...';										
											}
										}
									?>
								</td>
								<td class="text-center btn-group" role="group">
									<a href="<?= base_url().'roles/editar/'.$rol->id ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
									<button class="btn btn-info btn-sm" data-id="<?= $rol->id  ?>"><i class="fa fa-file-text-o"></i></button>
									<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
					DETALLES DEL ROL
				</div>
				<div class="modal-body panel-body">
					<b>Nombre:</b>
					<p id="role-name"></p>
					<b>Nombre a mostrar:</b>
					<p id="role-display"></p>
					<b>Descripción:</b>
					<p><pre id="role-description" class="pre-from-textarea"></pre></p>
					<b>Permisos:</b>
					<p id="role-permission"></p>
				</div>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->