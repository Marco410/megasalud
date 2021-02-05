<div class="container">
<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>NUEVO PACIENTE</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
		<div class="col-">

			<form id="new_pacient_form" class="panel-body no-padding">
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
								<input type="text" name="nombre" id="nombre" class="form-control" required minlength="3">
							</div>
							<div class="form-group">
								<label>
									Apellido Paterno
								</label>
								<input type="text" name="apellido_p" id="apellido_p" class="form-control titleCalendar" required minlength="3">
							</div>
							<div class="form-group">
								<label>
									Apellido Materno
								</label>
								<input  type="text" name="apellido_m" class="form-control" >
							</div>
							<div class="form-group">
								<label>
									Correo Electrónico
								</label>
								<input id="email" type="email" name="email" class="form-control" required>
                                <small>Si no tiene correo escriba "na@na.com"</small>
							</div>
                            <div class="form-group">
				            <label>
								Motivo de la Consulta 
							</label>
                            <select class="form-control" required id="motivo_consulta" name="motivo_consulta" >
                            <option value="">Seleccione: </option>    
                            <option value="Diabetes">Diabetes</option>    
                            <option value="Cáncer">Cáncer</option>    
                            <option value="Lupus">Lupus</option>    
                            <option value="Otra">Otra</option>    
                            </select>
							</div>
                            
                          
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>
								Municipio de Nacimiento <small>(Opcional)</small>
							</label>
							<input type="text" name="municipio_origen" class="form-control">
							</div>
							
							<div class="form-group">
								<label>
								Estado de Nacimiento <small>(Opcional)</small>
							</label>
							<input type="text" name="estado_origen" class="form-control">
							</div>
                            <div class="form-group">
								<label>
								Pais de Nacimiento <small>(Opcional)</small>
							</label>
							<input type="text" name="pais_origen" value="México" class="form-control" >
							</div> 
                              <div class="form-group">
								<label>
									Estado Civil
								</label>
								
                                <select id="estado_civil" name="estado_civil" class="form-control" required >
                                <option value="">Seleccione:</option>
                                <option value="Soltero/a" >Soltero/a</option>
                                <option value="Casado/a" >Casado/a</option>
                                <option value="Union Libre" >Union Libre</option>
                                <option value="Separado/a" >Separado/a</option>
                                <option value="Divorciado/a" >Divorciado/a</option>
                                <option value="Viudo/a" >Viudo/a</option>
                                <option value="Comprometido/a" >Comprometido/a</option>
                                </select>
							</div>
                            
                            	<div class="form-group">
								<label>
									Sucursal
								</label>
                                   
								<select id="sucursal" name="sucursal" class="form-control" required >
                                    
                                    
									<option value="" >Seleccione una opción</option>
									<?php foreach ($sucursales->result() as $sucursal): ?>
									<option value="<?= $sucursal->id ?>"><?= $sucursal->razon_social ?></option>
									<?php endforeach ?>
                                     
                                    
								</select>
                                   
							</div>
						</div>
					</div>
				</div>

				<div class="panel mb-0 panel-olive panel-flat border-left-olive">
					<div class="panel-heading">
						<span class="ms-subtitle">DIRECCIÓN DE CONTACTO</span>
					</div>

					<div class="panel-body">
						<div class="form-group col-sm-4">
							<label>
								País
							</label>
							<input type="text" name="pais" class="form-control" required value="México" >
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
							<input type="text" name="calle" class="form-control" required >
						</div>
						<div class="form-group col-sm-6">
							<label>
								Colonia
							</label>
							<input type="text" name="colonia" class="form-control" required >
						</div>
						<div class="form-group col-sm-2">
							<label>
								Código Postal
							</label>
							<input type="text" name="cp" class="form-control" required >
						</div>
						<div class="form-group col-sm-5">
							<label>
								Telefono principal
							</label>
							<input type="text" name="telefono_a" class="form-control" required >
						</div>
						<div class="form-group col-sm-5">
							<label>
								Telefono secundario <small>(Opcional)</small>
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
								CURP (Opcional)
							</label>
							<input type="text" name="curp" class="form-control" >
						</div>
						<div class="form-group col-sm-3">
							<label>
								RFC (Opcional)
							</label>
							<input type="text" name="rfc" class="form-control"  >
						</div>
						<div class="form-group col-sm-3">
							<label>
								Nacimiento
							</label>
							<input type="date" name="fecha_nacimiento" class="form-control" required >
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
						<div class="form-group col-sm-4">
							<label>
								Ocupación
							</label>
							<input type="text" name="ocupacion" class="form-control" required>
						</div>
                        <div class="form-group col-sm-4">
							<label>
								Horario para Llamarle
							</label>
							<select name="hr_llamarle" id="hr_llamarle" class="form-control" required >
                                <option value="" >Seleccione: </option>
                                <option value="De 9:00 - 11:00">De 9:00 - 11:00</option>
                                <option value="De 11:00 - 13:00">De 11:00 - 13:00</option>
                                <option value="De 13:00 - 15:00">De 13:00 - 15:00</option>
                                <option value="De 15:00 - 17:00">De 15:00 - 17:00</option>
                                <option value="De 17:00 - 20:00">De 17:00 - 20:00</option>
                                <option value="Cualquier hora">Cualquier hora</option>
                            </select>
						</div>
                        <div class="form-group col-sm-4">
							<label>
								Religión <small>(Opcional)</small>
							</label>
							<input type="text" name="religion" class="form-control">
						</div>
					</div>
				</div>
                <div class="panel mb-0 panel-brown panel-flat border-left-brown">
                <div class="panel-heading">
						<span class="ms-subtitle">RECOMENDADO POR:</span>
					</div>
                    
                    <div class="panel-body" >
                        
                        <div class="form-group col-sm-6">
                            <label>
								Referencia:
							</label>
                        
                            <select  name="referido" id="referido" class="form-control" required >
                                <?php if($this->session->type != "Representante"){ ?>
                                <option value="<?= $this->session->id ?>" ><?= $this->session->type ?></option>
                                
                                <?php } else { ?>
                                <option value="<?= $this->session->id ?>" >Representante</option>
                                
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-sm-6">
							<label>
								Nombre
							</label>
							<input required placeholder="Especifique" type="text" name="nombre_referido" class="form-control" value="<?= $this->session->name ?>">
						</div>
                    
                    </div>
                </div>
                <div class="panel mb-0 panel-primary panel-flat border-left-primary">
                <div class="panel-heading">
						<span class="ms-subtitle">GENERAR CITA:</span>
					</div>
                    
                    <div class="panel-body" >
                        <div class="form-group col-sm-4">
								<label>
									Sucursal
								</label>
                                   
								<select id="id_calendario" name="id_calendario" class="form-control" required >
                                    
                                   
									<option value="" >Seleccione una opción</option>
									<?php foreach ($sucursales->result() as $sucursal): ?>
									<option value="<?= $sucursal->id_calendario ?>"><?= $sucursal->razon_social ?></option>
									<?php endforeach ?>
                                    
                                    
								</select>
                                   
							</div>
                        
                        <div class="form-group col-sm-4">
                            <label>
								Cita Para:
							</label>
                        
                            <input class="form-control" id="title_cita" name="title_cita" />
                        </div>
                        
                        <div class="form-group col-sm-4">
							<label>
								Fecha: (dia - hora)
							</label>
							<input required type="datetime-local" name="fecha_cita" id="fecha_cita" min="<?php echo  date('Y-m-d\TH:i'); ?>"  value="<?php echo date("Y-m-d\TH:i");?>" class="form-control" >
						</div>
                    
                    </div>
                </div>

				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
                
                
			</form>
		</div>
	</div>
	
</div>