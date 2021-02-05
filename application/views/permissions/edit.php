<?php 
	$permiso = $permiso->row();
?>
<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>EDITAR PERMISO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="panel panel-warning">
	
			<form id="edit_permission_form" class="panel-body border-left-warning">
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="id" value="<?= $permiso->id ?>" id="permission_id">
				
				<div class="row">

					<div class="form-group col-sm-4">
						<label>
							Nombre:
						</label>
						<input type="text" name="name" class="form-control" value="<?= $permiso->name ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-8">
						<label>
							Nombre a mostrar:
						</label>
						<input type="text" name="display_name" class="form-control" value="<?= $permiso->display_name ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-12">
						<label>
							Detalles:
						</label>
						<textarea type="text" name="description" class="form-control" rows="5"><?= $permiso->description ?></textarea>
					</div>

				</div>
				
				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i><br>Guardar</button>
			</form>
		</div>
	</div>

</div>

