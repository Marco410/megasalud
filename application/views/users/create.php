<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>NUEVO USUARIO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="col-">

			<form id="new_user_form" class="panel-body no-padding">
				<div class="panel mb-0 panel-primary panel-flat border-left-primary">
					<div class="panel-heading ">
						<span class="ms-subtitle">GENERAL</span>
					</div>

					<div class="panel-body">
						<div class="col-sm-6">
							<div class="form-group">
								<label>
									Nombre:
								</label>
								<input type="text" name="nombre" class="form-control" required minlength="3">
							</div>
							<div class="form-group">
								<label>
									Apellido P.
								</label>
								<input type="text" name="apellido_p" class="form-control" required minlength="3">
							</div>
							<div class="form-group">
								<label>
									Apellido M.
								</label>
								<input type="text" name="apellido_m" class="form-control">
							</div>
							<div class="form-group">
								<label>
									Email
								</label>
								<input id="email" type="email" name="email" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>
									Contraseña
								</label>
								<input id="password" type="password" name="password" class="form-control" required>
							</div>
							<div class="form-group">
								<label>
									Confirme contraseña
								</label>
								<input type="password" name="password2" class="form-control" required>
							</div>
							<div class="form-group">
								<label>
									Sucursal
								</label>
								<select id="sucursal" name="sucursal" class="form-control" required <?php echo $this->session->userdata('type') != 'Administrador'? 'disabled' : null; ?>>
									<option value="" >Seleccione una opción</option>
									<?php foreach ($sucursales->result() as $sucursal): ?>
									<option value="<?= $sucursal->id ?>"><?= $sucursal->razon_social ?></option>
									<?php endforeach ?>
								</select>
							</div>
                            <div class="form-group">
								<label>
									Tipo de Usuario
								</label>
								<select id="tipo_usuario" name="tipo_usuario" class="form-control" required>
									<option value="" >Seleccione una opción</option>
									<?php foreach ($roles->result() as $rol): ?>
                                    
                                    <?php if ($this->session->type != "Administrador"  ) {  ?>
                                    <?php if ($rol->name == "Administrador"){}else{ ?>
									<option value="<?= $rol->id ?>"><?= $rol->name ?></option> <?php } ?>
                                   
                                    <?php }else{ ?>
                                    
                                    <option value="<?= $rol->id ?>"><?= $rol->name ?></option>
                                    
                                    <?php } ?>
									<?php endforeach ?>
								</select>
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
								Municipio
							</label>
							<input type="text" name="municipio" class="form-control" required>
						</div>
						<div class="form-group col-sm-6">
							<label>
								Calle
							</label>
							<input required type="text" name="calle" class="form-control">
						</div>
						<div class="form-group col-sm-6">
							<label>
								Colonia
							</label>
							<input required type="text" name="municipio" class="form-control">
						</div>
						<div class="form-group col-sm-2">
							<label>
								Código Postal
							</label>
							<input type="text" name="cp" class="form-control">
						</div>
						<div class="form-group col-sm-5">
							<label>
								Telefono principal
							</label>
							<input required type="text" name="telefono_a" class="form-control">
						</div>
						<div class="form-group col-sm-5">
							<label>
								Telefono secundario
							</label>
							<input type="text" name="telefono_b" class="form-control">
						</div>
					</div>
				</div>

				<div class="panel mb-0 panel-brown panel-flat border-left-brown">
					<div class="panel-heading">
						<span class="ms-subtitle">IDENTIFICACIÓN</span>
					</div>

					<div class="panel-body">
						<div class="form-group col-sm-4">
							<label>
								CURP
							</label>
							<input type="text" name="curp" class="form-control">
						</div>
						<div class="form-group col-sm-3">
							<label>
								RFC
							</label>
							<input type="text" name="rfc" class="form-control">
						</div>
						<div class="form-group col-sm-3">
							<label>
								Nacimiento
							</label>
							<input required type="date" name="fecha_nacimiento" class="form-control">
						</div>
						<div class="form-group col-sm-2">
							<div class="radio">
								<label>
									<input type="radio" name="sexo" value="Masculino" checked>
									<b>Masculino</b>
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="sexo" value="Femenino">
									<b>Femenino</b>
								</label>
							</div>
						</div>
					</div>
				</div>


				<div class="panel mb-0 panel-brown panel-flat border-left-brown">
					<div class="panel-heading">
						<span class="ms-subtitle">OTROS</span>
					</div>

					<div class="panel-body">
						<div class="form-group col-sm-6">
							<label>
								Especialidad
							</label>
							<input type="text" name="especialidad" class="form-control">
						</div>
						<div class="form-group col-sm-6">
							<label>
								Cédula
							</label>
							<input type="text" name="cedula" class="form-control">
						</div>
						<div class="form-group col-sm-6">
							<label>
								Cuenta Bancaria
							</label>
							<input type="text" name="cuenta_bancaria" class="form-control">
						</div>
						<div class="form-group col-sm-6">
							<label>
								Banco
							</label>
							<input type="text" name="banco" class="form-control">
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
			</form>
		</div>
	</div>
	
</div>
