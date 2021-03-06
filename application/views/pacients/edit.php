<?php 
	$paciente = $paciente->row();
?>
<div class="container">
<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>EDITAR PACIENTE</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
		<div class="col-">

			<form id="edit_pacient_form" name="edit_pacient_form" class="panel-body no-padding" method="post">
				<input type="hidden" name="id_paciente" value="<?= $paciente->id ?>">
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
								<input  type="text" name="nombre" class="form-control" value="<?= $paciente->nombre  ?>" required minlength="3">
								<input type="hidden" name="id_paciente" value="<?= $paciente->id  ?>">
							</div>
							<div class="form-group">
								<label>
									Apellido P.
								</label>
								<input  type="text" name="apellido_p" class="form-control" value="<?= $paciente->apellido_p  ?>" required minlength="3">
							</div>
							<div class="form-group">
								<label>
									Apellido M.
								</label>
								<input  type="text" name="apellido_m" class="form-control" value="<?= $paciente->apellido_m  ?>">
							</div>
							<div class="form-group">
								<label>
									Email
								</label>
								<input id="email" type="email" name="email" class="form-control" value="<?= $paciente->email  ?>"  required>
                                <input id="method" name="method" type="hidden" value="PUT" />
                                <small>Si no tiene correo poner "na@na.com"</small>   
							</div>
                            
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>
								Municipio de Nacimiento
							</label>
							<input type="text" name="municipio_origen" value="<?= $paciente->municipio_origen  ?>" class="form-control">
							</div>
							
							<div class="form-group">
								<label>
								Estado de Nacimiento
							</label>
							<input type="text" name="estado_origen" class="form-control"  value="<?= $paciente->estado_origen  ?>" >
							</div>
                            <div class="form-group">
								<label>
								Pais de Nacimiento
							</label>
							<input type="text" name="pais_origen" class="form-control"  value="<?= $paciente->pais_origen  ?>">
							</div>
                            
                             <div class="form-group">
								<label>
									Estado Civil
								</label>
                                 <input id="estado_civil" name="estado_civil" class="form-control" value="<?= $paciente->estado_civil  ?>" />
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
							<input type="text" name="pais" class="form-control" required value="<?= $paciente->pais  ?>" >
						</div>
						<div class="form-group col-sm-4">
							<label>
								Estado
							</label>
							<input type="text" name="estado" class="form-control" required value="<?= $paciente->estado  ?>" >
						</div>
						<div class="form-group col-sm-4">
							<label>
								Municipio
							</label>
							<input type="text" name="municipio" class="form-control" required value="<?= $paciente->municipio  ?>" >
						</div>
						<div class="form-group col-sm-6">
							<label>
								Calle
							</label>
							<input type="text" name="calle" class="form-control" required value="<?= $paciente->calle  ?>" >
						</div>
						<div class="form-group col-sm-6">
							<label>
								Colonia
							</label>
							<input type="text" name="colonia" class="form-control" required value="<?= $paciente->colonia  ?>" >
						</div>
						<div class="form-group col-sm-2">
							<label>
								Código Postal
							</label>
							<input type="text" name="cp" class="form-control" required  value="<?= $paciente->cp  ?>" >
						</div>
						<div class="form-group col-sm-5">
							<label>
								Telefono principal
							</label>
							<input type="text" name="telefono_a" class="form-control" required value="<?= $paciente->telefono_a  ?>" >
						</div>
						<div class="form-group col-sm-5">
							<label>
								Telefono secundario
							</label>
							<input type="text" name="telefono_b" class="form-control" value="<?= $paciente->telefono_b  ?>">
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
							<input type="text" name="curp" class="form-control"  value="<?= $paciente->curp  ?>">
						</div>
						<div class="form-group col-sm-3">
							<label>
								RFC
							</label>
							<input type="text" name="rfc" class="form-control"  value="<?= $paciente->rfc  ?>">
						</div>
						<div class="form-group col-sm-3">
							<label>
								Nacimiento
							</label>
							<input type="date" name="fecha_nacimiento" class="form-control" required value="<?= $paciente->fecha_nacimiento  ?>" >
						</div>
						<div class="form-group col-sm-2">
                            <label>
								Sexo
							</label>
                            <select class="form-control" name="sexo" >
                                <?php if ( $paciente->sexo == "Masculino"){ ?>
                                <option value="Masculino"  selected>Masculino</option>
                                <option value="Femenino" >Femenino</option>
                                <?php }else{ ?>
                                <option value="Femenino" selected >Femenino</option>
                                <option value="Masculino" >Masculino</option>
                                <?php } ?>
                            </select>
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
							<input type="text" name="ocupacion" class="form-control" value="<?= $paciente->ocupacion  ?>">
						</div>
                        <div class="form-group col-sm-4">
							<label>
								Religión
							</label>
							<input type="text" name="religion" class="form-control" value="<?= $paciente->religion  ?>">
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-teal btn-save"><i class="glyphicon glyphicon-repeat fa-2x"></i> <br>Actualizar</button>
			</form>
		</div>
	</div>
	
</div>
