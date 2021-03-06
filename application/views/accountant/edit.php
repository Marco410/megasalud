<?php 
	$rol = $rol->row();
?>
<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>EDITAR ROL</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="panel panel-warning">
	
			<form id="edit_role_form" class="panel-body border-left-warning">
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="id" value="<?= $rol->id ?>" id="role_id">

				<div class="row">

					<div class="form-group col-sm-4">
						<label for="name">
							Nombre:
						</label>
						<input type="text" name="name" class="form-control" required minlength="1" id="name" value="<?= $rol->name ?>">
					</div>
					<div class="form-group col-sm-8">
						<label for="display_name">
							Nombre a mostrar:
						</label>
						<input type="text" name="display_name" class="form-control" required minlength="3" id="display_name" value="<?= $rol->display_name ?>">
					</div>
					<div class="form-group col-sm-12">
						<label for="description">
							Detalles:
						</label>
						<textarea type="text" name="description" class="form-control" rows="5" id="description"><?= $rol->description ?>
						</textarea>
					</div>
					<div class="col-xs-12">
						<h4 class="ms-heading ms-subtitle mb-30">
							<b>Permisos asociados</b>
							<button type="button" id="btn-select-all" class="btn btn-default pull-right">Seleccionar todos</button>
							<div class="col-sm-3 pull-right">
								<select id="role-preset" class="form-control">
									<option>Seleccionar de:</option>
									<?php foreach ($roles->result() as $row): ?>
									<option value="<?= $row->id ?>"><?= $row->name ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</h4>
					</div>
					<div class="form-group col-sm-12">					
						<?php foreach ($permisos->result() as $permiso): ?>
							<div class="col-sm-3">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="permisos[<?= $permiso->id ?>]" class="check-permisos" value="1" data-id="<?= $permiso->id ?>" 
										<?php 
											echo in_array( $permiso->id, $permisos_rol )?'checked':null; 
										?>
										/><?= $permiso->display_name ?>
									</label>
								</div>
							</div>						
						<?php endforeach ?>
					</div>

				</div>
				
				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
			</form>
		</div>
	</div>

</div>
