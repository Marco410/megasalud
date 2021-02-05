<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>NUEVO PROVEEDOR</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="col-">

			<form id="new_pro_form" class="panel-body no-padding" method="post" >
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
								<input type="text" name="empresa" class="form-control" required minlength="3">
							</div>
							<div class="form-group">
								<label>
									Nombre Contacto:
								</label>
								<input type="text" name="nombre_contacto" class="form-control" required minlength="3">
							</div>
							
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
								<label>
									Cargo Contacto:
								</label>
								<input type="text" required name="cargo_contacto" class="form-control">
							</div>
							<div class="form-group">
								<label>
									Giro de la Empresa:
								</label>
								<input type="text" name="giro" class="form-control" required>
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
							<input value="México" required type="text" name="pais" class="form-control">
						</div>
						<div class="form-group col-sm-4">
							<label>
								Estado
							</label>
							<select name="estado" id="estado" class="form-control" required >
                                <option value="">Seleccione</option>
                                  <option value="Aguascalientes">Aguascalientes</option>
                                  <option value="Baja California">Baja California</option>
                                  <option value="Baja California Sur">Baja California Sur</option>
                                  <option value="Campeche">Campeche</option>
                                  <option value="Chiapas">Chiapas</option>
                                  <option value="Chihuahua">Chihuahua</option>
                                  <option value="Coahuila">Coahuila</option>
                                  <option value="Colima">Colima</option>
                                  <option value="Distrito Federal">Distrito Federal</option>
                                  <option value="Durango">Durango</option>
                                  <option value="Guanajuato">Guanajuato</option>
                                  <option value="Guerrero">Guerrero</option>
                                  <option value="Hidalgo">Hidalgo</option>
                                  <option value="Jalisco">Jalisco</option>
                                  <option value="Mexico">México</option>
                                  <option value="Michoacan">Michoacán</option>
                                  <option value="Morelos">Morelos</option>
                                  <option value="Nayarit">Nayarit</option>
                                  <option value="Nuevo Leon">Nuevo León</option>
                                  <option value="Oaxaca">Oaxaca</option>
                                  <option value="Puebla">Puebla</option>
                                  <option value="Queretaro">Querétaro</option>
                                  <option value="Quintana Roo">Quintana Roo</option>
                                  <option value="San Luis Potosi">San Luis Potosí</option>
                                  <option value="Sinaloa">Sinaloa</option>
                                  <option value="Sonora">Sonora</option>
                                  <option value="Tabasco">Tabasco</option>
                                  <option value="Tamaulipas">Tamaulipas</option>
                                  <option value="Tlaxcala">Tlaxcala</option>
                                  <option value="Veracruz">Veracruz</option>
                                  <option value="Yucatan">Yucatán</option>
                                  <option value="Zacatecas">Zacatecas</option>
                              </select>
						</div>
						<div class="form-group col-sm-4">
							<label>
								Municipio:
							</label>
							<input type="text" name="municipio" class="form-control" required>
						</div>
						<div class="form-group col-sm-6">
							<label>
								Calle:
							</label>
							<input required type="text" name="calle" class="form-control">
						</div>
						<div class="form-group col-sm-6">
							<label>
								Colonia:
							</label>
							<input required type="text" name="colonia" class="form-control">
						</div>
						<div class="form-group col-sm-2">
							<label>
								Código Postal:
							</label>
							<input type="text" name="cp" required class="form-control">
						</div>
						<div class="form-group col-sm-4">
							<label>
								Teléfono principal
							</label>
							<input required type="text" name="telefono" class="form-control">
						</div>
                        <div class="form-group col-sm-6">
							<label>
								Correo Electrónico
							</label>
							<input required type="email" name="email" class="form-control">
						</div>
					</div>
				</div>

				<div class="panel mb-0 panel-brown panel-flat border-left-brown">
					<div class="panel-heading">
						<span class="ms-subtitle">OTROS</span>
					</div>

					<div class="panel-body">
						<div class="form-group col-sm-12">
							<label>
								Notas:
							</label>
                            <textarea name="notas" class="form-control" ></textarea>
						</div>
						
					</div>
				</div>

				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
			</form>
		</div>
	</div>
	
</div>
