<?php 
	$sucursal = $sucursal->row();
?>
<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>EDITAR SUCURSAL</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="panel panel-warning">
			<!-- <div class="panel-heading">
				<span class="ms-subtitle">Generales</span>
			</div> -->
			<form id="edit_office_form" class="panel-body border-left-warning">
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="id" value="<?= $sucursal->id ?>">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>
							Nombre:
						</label>
						<input type="text" name="razon_social" class="form-control" value="<?= $sucursal->razon_social ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							País:
						</label>
						<input type="text" name="pais" class="form-control" value="<?= $sucursal->pais ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Estado:
						</label>
						<input type="text" name="estado" class="form-control" value="<?= $sucursal->estado ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Municipio:
						</label>
						<input type="text" name="municipio" class="form-control" value="<?= $sucursal->municipio ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-9">
						<label>
							Dirección:
						</label>
						<input type="text" name="direccion" class="form-control" value="<?= $sucursal->direccion ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-3">
						<label>
							CP:
						</label>
						<input type="text" name="cp" class="form-control" value="<?= $sucursal->cp ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Teléfono:
						</label>
						<input type="tel" name="telefono" class="form-control phone" value="<?= $sucursal->telefono ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Cuenta bancaria:
						</label>
						<input type="text" name="cuenta_bancaria" class="form-control" value="<?= $sucursal->cuenta_bancaria ?>" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Banco:
						</label>
						<input type="text" name="banco" class="form-control" value="<?= $sucursal->banco ?>" required minlength="3">
					</div>
                    
                    <div class="form-group col-sm-6">
						<label>
							ID Calendario de Google:
						</label>
						<input type="text"  name="id_calendario" value="<?= $sucursal->id_calendario ?>" class="form-control" required disabled minlength="3">
                        <small>Consulta con el administrador</small>
					</div>
                    
                    <div class="form-group col-sm-6">
						<label>
							Codigo de Incorporación Calendario de Google:
						</label>
						<input  disabled type="text" name="calendario" value="<?= $sucursal->calendario ?>" class="form-control" required minlength="3">
                        <small>Consulta con el administrador</small>
					</div>

				</div>
				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
			</form>
		</div>
		
		
	</div>

</div>