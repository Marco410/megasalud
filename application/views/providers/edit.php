<?php 
	$prov = $prov->row();
?>
<div class="container">
<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>EDITAR PROVEEDOR</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
		<div class="col-">

			<form id="edit_prov_form" name="edit_user_form" class="panel-body no-padding" method="post">
				<input type="hidden" name="id_provider" value="<?= $prov->id ?>">
				<div class="panel mb-0 panel-primary panel-flat border-left-primary">
					<div class="panel-heading ">
						<span class="ms-subtitle">GENERAL</span>
					</div>

					<div class="panel-body">
						<div class="col-sm-6">
							<div class="form-group">
								<label>
									Empresa:
								</label>
								<input type="text" name="empresa" class="form-control" value="<?= $prov->empresa  ?>" required minlength="3">
							</div>
							<div class="form-group">
								<label>
									Nombre Contacto:
								</label>
								<input type="text" name="nombre_contacto" class="form-control" value="<?= $prov->nombre_contacto  ?>" required minlength="3">
							</div>
							
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
								<label>
									Cargo Contacto:
								</label>
								<input type="text" value="<?= $prov->cargo_contacto  ?>" required name="cargo_contacto" class="form-control">
							</div>
							<div class="form-group">
								<label>
									Giro de la Empresa:
								</label>
								<input type="text" value="<?= $prov->giro  ?>" name="giro" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				<div class="panel mb-0 panel-olive panel-flat border-left-olive">
					<div class="panel-heading">
						<span class="ms-subtitle">CONTACTO</span>
					</div>

					<div class="panel-body">
						<div class="form-group col-sm-4">
							<label>
								País
							</label>
							<input value="<?= $prov->pais  ?>" required type="text" name="pais" class="form-control">
						</div>
						<div class="form-group col-sm-4">
							<label>
								Estado
							</label>
							<input value="<?= $prov->estado  ?>" required type="text" name="estado" class="form-control">
						</div>
						<div class="form-group col-sm-4">
							<label>
								Municipio:
							</label>
							<input type="text" name="municipio" value="<?= $prov->municipio  ?>" class="form-control" required>
						</div>
						<div class="form-group col-sm-6">
							<label>
								Calle:
							</label>
							<input required value="<?= $prov->calle  ?>" type="text" name="calle" class="form-control">
						</div>
						<div class="form-group col-sm-6">
							<label>
								Colonia:
							</label>
							<input required type="text" value="<?= $prov->colonia  ?>" name="colonia" class="form-control">
						</div>
						<div class="form-group col-sm-2">
							<label>
								Código Postal:
							</label>
							<input type="text" value="<?= $prov->cp  ?>" name="cp" required class="form-control">
						</div>
						<div class="form-group col-sm-4">
							<label>
								Teléfono principal
							</label>
							<input required type="text" value="<?= $prov->telefono  ?>" name="telefono" class="form-control">
						</div>
                        <div class="form-group col-sm-6">
							<label>
								Correo Electrónico
							</label>
							<input required type="email" value="<?= $prov->email  ?>" name="email" class="form-control">
						</div>
                        
					</div>
				</div>

				<div class="panel mb-0 panel-brown panel-flat border-left-brown">
					<div class="panel-heading">
						<span class="ms-subtitle">OTROS</span>
					</div>
                    <div class="panel-body" >
                        <label>Notas:</label>
                      <textarea class="form-control" name="notas" ><?= $prov->notas  ?></textarea>
                    
                    </div>

					
					</div>
				</div>
				<button type="submit" class="btn btn-teal btn-save"><i class="glyphicon glyphicon-repeat fa-2x"></i> <br>Actualizar</button>
			</form>
		</div>
	</div>
	
</div>
