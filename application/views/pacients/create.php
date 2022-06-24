<?php 
    $img_load = base_url('assets/images/loader').'/';
?>

<div class="container">
<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>NUEVO PACIENTE - <?php if($this->session->type =="Administrador" || $this->session->type =="Medico Administrador" ){ echo "TODOS"; }else{ echo $this->session->sucursal_name; } ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
		<div class="">
            
    <div id="loaderPais" class="text-center" style="display:none;position: fixed;" >
        <img loading="lazy" height="50px" width="50px"   src="<?php echo $img_load ?>loader.gif" alt="" class="img-responsive center-block"  /> 
        </div>

			<form id="new_pacient_form" class="panel-body no-padding">
				<div class="panel mb-0 panel-primary panel-flat border-left-primary">
					<div class="panel-heading ">
						<span class="ms-subtitle">GENERAL</span>
					</div>

					<div class="panel-body">
                        <div class="row" >
							<div class="col-sm-12">
								<div class="col-sm-4 text-center" id="panel_pacientes" style="display:none; position: fixed; top: 100px; right: 30px;  background-color: white;  width: auto; z-index: 10; padding: 15px;  border-radius: 10px;box-shadow: 0 5px 15px rgb(0 0 0 / 10%);">
								</div>
							</div>
                        <div class="col-sm-4" >
                            <div class="form-group">
								<label>
									Nombre:
								</label>
								<input type="text" id="nombre" name="nombre" class="form-control" required minlength="3">
							</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
								<label>
									Apellido Paterno
								</label>
								<input  type="text" id="apellido_p" name="apellido_p" class="form-control" required minlength="3">
							</div>
                        </div>
                        <div class="col-sm-4" >
                            <div class="form-group">
								<label>
									Apellido Materno
								</label>
								<input type="text" id="apellido_m" name="apellido_m" class="form-control" >
							</div>
                        </div>
                        </div>
                        <div class="row" >
                        <div class="col-sm-5" >
                            <div class="form-group">
								<label>
									Correo Electrónico
								</label>
								<input id="email" type="email" name="email" class="form-control" required>
                                <small>Si no tiene correo escriba "na@na.com"</small>
							</div>
                        </div>
                        <div class="col-sm-3" >
                            <div class="form-group">
                                <label>
                                    Motivo de la Consulta 
                                </label>
                                <select class="select2 form-control" required id="motivo_m" name="motivo" >
                                    <option value="">Seleccione: </option>

                                    <?php foreach ($motivo_consulta->result() as $motivo): ?>
                                    <option value="<?= $motivo->id ?>"><?= $motivo->enfermedad ?></option>
                                    <?php endforeach ?>    
                                    <option value="Otra">Otra</option>    
                                </select>
                                <div class="" id="panel-add-m" hidden >
                                    <br>
                                    <a href="#" class="btn btn-sm btn-info" data-id="1" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                                </div>
							</div>
                        </div>
                        <div class="col-sm-4" >
                            <div class="form-group">
								<label>
									Sucursal
								</label> 
								<select id="sucursal" name="sucursal" class="form-control" required >
                                    
                                     <?php if($this->session->type == "Administrador" || $this->session->type == "Medico Administrador"){ ?>
									<option value="" >Seleccione una opción</option>
									<?php foreach ($sucursales->result() as $sucursal): ?>
									<option value="<?= $sucursal->id ?>"><?= $sucursal->razon_social ?></option>
									<?php endforeach ?>
                                     <?php }else{ ?>
                                    <option value="<?= $this->session->sucursal ?>" >Tu sucursal</option>
                                    <?php } ?>
                                    
								</select>  
							</div>
                        </div>
                        </div>
                        <div class="row" >
						<div class="col-sm-3">
							 <div class="form-group">
								<label>
								Municipio de Nac. <small>(Opcional)</small>
							</label>
							<input type="text" name="municipio_origen" class="form-control">
							</div>
						</div>
                        <div class="col-sm-3">
							 <div class="form-group">
								<label>
								Estado de Nacimiento <small>(Opcional)</small>
							</label>
							<input type="text" name="estado_origen" class="form-control">
							</div>
						</div>
                        <div class="col-sm-3">
							 <div class="form-group">
								<label>
								Pais de Nacimiento <small>(Opcional)</small>
							</label>
							<input type="text" id="pais_origen" name="pais_origen" value="México" class="form-control" >
							</div> 
						</div>
                        <div class="col-sm-3">
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
						</div>
                        </div>
					</div>
				</div>

				<div class="panel mb-0 panel-olive panel-flat border-left-olive">
					<div class="panel-heading">
						<span class="ms-subtitle">DIRECCIÓN DE CONTACTO</span>
					</div>

					<div class="panel-body">
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
						<div class="form-group col-sm-3">
							<label>
								País
							</label>
                            <select required id="pais" name="pais" class="form-control" >
                                <option value="" >Seleccione: </option>
                                <option value="México" >México</option>
                                <option value="EEUU" >EEUU</option>
                            </select>
						</div>
						<div class="form-group col-sm-4">
							<label>
								Estado
							</label>
							<select name="estado" id="estado" class="form-control" required >
                                <option value="">Seleccione</option>
                                  
                              </select>
						</div>
						<div class="form-group col-sm-3">
							<label>
								Municipio
							</label>
							<input type="text" name="municipio" class="form-control" required>
						</div>
						
						<div class="form-group col-sm-6">
							<label>
								Telefono principal
							</label>
							<input type="text" name="telefono_a" class="form-control" required >
						</div>
						<div class="form-group col-sm-6">
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
								CURP
							</label>
							<input type="text" name="curp" class="form-control" >
						</div>
						<div class="form-group col-sm-3">
							<label>
								RFC
							</label>
							<input type="text" name="rfc" class="form-control"  >
						</div>
						<div class="form-group col-sm-3">
							<label>
								Nacimiento
							</label>
							<input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required >
						</div>
						<div class="form-group col-sm-2">
							<div class="radio">
								<label>
									<input type="radio" id="mas" name="sexo" value="Masculino" checked>
									<b>Masculino</b>
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" id="Fem" name="sexo" value="Femenino">
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
                        
                        <div class="form-group col-sm-5">
                            <label>
								Referencia:
							</label>
                            <select  name="referido" id="referido" class="form-control" required >
                                <option value="" >Seleccione uno:</option>
                                <option value="Clinica" >Taller</option>
                                <option value="Social" >Redes Sociales</option>
                                <option value="Social" >Página Web</option>
                                <option value="Paciente" >Paciente</option>
                                <option value="Representante" >Representante</option>
                                <option value="Usuario" >Usuario</option>
                                <option value="Clinica" >Su Propia Cuenta (Sucursal)</option>
                            </select>
                            
                        </div>
                        <div class="col-sm-2" >
                        <div id="loader" class="text-center" style="display:none;" >
                            <img loading="lazy" height="50px" width="50px"   src="<?php echo $img_load ?>loader.gif" alt="" class="img-responsive center-block"  /> 
                            </div>
                        </div>
                        <div class="col-sm-5" id="panel_referido" hidden >
                            <b id="titulo_ref" ></b>
                            <select required class="form-control" id="agent" name="agent" ></select>
                        </div>
                        
                        
                        <div class="col-sm-12" >
                            <div class="col-sm-12 btn-msj" id="btn-continuar">
                            </div>
                        </div>
                    
                    </div>
                </div>
                

				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
                
                
			</form>
		</div>
	</div>
	
</div>

<!-- Modal Add settings -->
    <div class="modal fade" id="addSet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addSet_form" name="addSet_form" method="post"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Añadir</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row" >
                        <div class="col-sm-1" > 
                        <input class="form-control "  type="text" name="input_id" id="input_id"   /></div>
                   
                    <div class="col-sm-11" >
                        <label>Añade aqui</label>
                    <input class="form-control" id="dato" name="dato"  />
                        </div>
                        
                    </div>
                    

                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                         <button class="btn btn-md btn-primary" type="submit" ><span class="fa fa-save"></span> Guardar</button>    
                    </div>
                </form>
            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal fade -->
<!-- Cierra Modal -->

<!-- Modal Add settings -->
<div class="modal fade" id="verPacientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="verPacientes_form" name="verPacientes_form" method="post"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Pacientes Registrados</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row" >
						<div class="col-sm-12">
						<table id="pacientes-table" class="table table-striped" style="width: 100%;">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nombre</th>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Fecha de Nacimiento</th>
									<th>Pais de Origen</th>
									<th>Iniciar Consulta</th>
									<th>Fecha de Alta</th>
									
								</tr>
							</thead>
							<tbody id="pacientes-table" >
							</tbody>
						</table>
						</div>
							
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </form>
            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal fade -->
<!-- Cierra Modal -->