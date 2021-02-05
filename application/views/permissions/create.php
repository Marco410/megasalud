<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>NUEVO PERMISO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="panel panel-primary">
	
			<form id="new_permission_form" class="panel-body border-left-primary">

				<div class="row">

					<div class="form-group col-sm-4">
						<label>
							Nombre:
						</label>
						<input type="text" name="name" class="form-control" required minlength="1">
					</div>
					<div class="form-group col-sm-8">
						<label>
							Nombre a mostrar:
						</label>
						<input type="text" name="display_name" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-12">
						<label>
							Detalles:
						</label>
						<textarea type="text" name="description" class="form-control" rows="5"></textarea>
					</div>

				</div>
				
				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
			</form>
		</div>
	</div>

</div>
