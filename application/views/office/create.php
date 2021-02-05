<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>NUEVA SUCURSAL</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="panel panel-primary">

			<form id="new_office_form" class="panel-body border-left-primary">
				<div class="row">
					<div class="form-group col-sm-12">
						<label>
							Razón Social:
						</label>
						<input type="text" name="razon_social" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							País:
						</label>
						<input type="text" name="pais" class="form-control" value="México" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Estado:
						</label>
						<input type="text" name="estado" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Municipio:
						</label>
						<input type="text" name="municipio" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-9">
						<label>
							Dirección:
						</label>
						<input type="text" name="direccion" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-3">
						<label>
							CP:
						</label>
						<input type="text" name="cp" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Teléfono:
						</label>
						<input type="tel" name="telefono" class="form-control phone" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Cuenta bancaria:
						</label>
						<input type="text" name="cuenta_bancaria" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Banco:
						</label>
						<input type="text" name="banco" class="form-control" required minlength="3">
					</div>
                    
                    <div class="form-group col-sm-6">
						<label>
							ID Calendario de Google:
						</label>
						<input type="text" name="id_calendario" class="form-control" required minlength="3">
                        <small>Consulta con el administrador</small>
					</div>
                    
                    <div class="form-group col-sm-6">
						<label>
							Codigo de Incorporación Calendario de Google:
						</label>
						<input type="text" name="calendario" class="form-control" required minlength="3">
                        <small>Consulta con el administrador</small>
					</div>

				</div>
				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
			</form>
		</div>
		
	</div>

</div>