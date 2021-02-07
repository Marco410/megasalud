<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

$css_path = base_url('assets/css').'/';
$js_path = base_url('assets/js').'/';
?>
<head>
    
    <link rel="stylesheet" href="<?php echo $css_path; ?>bootstrap3.3.7/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo $css_path; ?>site.css" />
    <link rel="stylesheet" href="<?php echo $css_path; ?>iziToast.min.css" />
    <script type="text/javascript" data-pace-options='{ "ajax": false }' src="<?php echo $js_path; ?>pace.min.js"></script>
</head>	
<div class="container">
        
    <div class="col-xs-10 col-xs-offset-1">	
        <h3 class="ms-title"><b>NUEVO REPRESENTANTE </b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
        
		<div class="col-xs-12">

			<form id="new_agent_form" name="new_agent_form" class="panel-body no-padding">
				<div class="panel mb-0 panel-primary panel-flat border-left-primary">
					<div class="panel-heading ">
						<span class="ms-subtitle">GENERAL</span>
					</div>

					<div class="panel-body">
						<div class="col-sm-12">
							<div class="form-group col-sm-4">
								<label>
									Nombre(s):
								</label>
								<input type="text" name="nombre" class="form-control" required minlength="3">
							</div>
							<div class="form-group col-sm-4">
								<label>
									Apellido Paterno
								</label>
								<input type="text" name="apellido_p" class="form-control" required minlength="3">
							</div>
							<div class="form-group col-sm-4">
								<label>
									Apellido Materno
								</label>
								<input type="text" name="apellido_m" class="form-control" >
							</div>
                            <div class="form-group col-sm-6">
								<label>
									Contraseña
								</label>
								<input id="password" type="password" name="password" class="form-control" required>
							</div>
							<div class="form-group col-sm-6">
								<label>
									Confirme contraseña
								</label>
								<input type="password" name="password2" class="form-control" required>
							</div>
							<div class="form-group col-sm-6">
								<label>
									Correo Electrónico
								</label>
								<input id="email" type="email" name="email" class="form-control" required>
							</div>
                            <div class="form-group col-sm-6">
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
                                <option value="">Seleccione: </option>
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
						<span class="ms-subtitle">DATOS DE PAGO</span>
					</div>

					<div class="panel-body">
						<div class="form-group col-sm-4">
							<label>
								No TARJETA
							</label>
							<input type="text" required name="no_tarjeta" class="form-control" maxlength="16" >
						</div>
						<div class="form-group col-sm-3">
							<label>
								BANCO
							</label>
                            <select required class="form-control" name="banco" >
                            <option  value="" >Seleccione:</option>
                            <option  value="BBVA" >BBVA</option>
                            <option  value="CitiBanamex" >CitiBanamex</option>
                            <option  value="Santander" >Santander</option>
                            <option  value="Banorte" >Banorte</option>
                            <option  value="Inbursa" >Inbursa</option>
                            <option  value="HSBC" >HSBC</option>
                            <option  value="American Express" >American Express</option>
                            <option  value="BanCoppel" >BanCoppel</option>
                            <option  value="Scotiabank" >Scotiabank</option>
                            <option  value="BanBajio" >BanBajio</option>
                            <option  value="Interacciones" >Interacciones</option>
                            <option  value="Mifel" >Mifel</option>
                            <option  value="Afirme" >Afirme</option>
                            <option  value="Regional de Monterrey" >Regional de Monterrey</option>
                            <option  value="Invex" >Invex</option>
                            <option  value="CiBanco" >CiBanco</option>
                            <option  value="Famsa" >Famsa</option>
                            <option  value="ABC Capital" >ABC Capital</option>
                            <option  value="Actinver" >Actinver</option>
                            <option  value="Compartamos" >Compartamos</option>
                            <option  value="Otro" >Otro</option>
                            </select>
						</div>
					</div>
				</div>


				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
                
                
			</form>
		</div>
	</div>
	
</div>

<script src="<?php echo $js_path; ?>jquery-3.2.1.js"></script>
  <script src="<?php echo $js_path; ?>jquery.validate.js"></script>
  <script src="<?php echo $js_path; ?>bootstrap.js"></script>
<script src="<?php echo $js_path; ?>iziToast.min.js"></script>
    <script type="text/javascript" src="<?php echo $js_path.'view_controllers/'.$view_controller; ?>"></script>