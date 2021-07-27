<div class="container">
	<div class="row">
		<div class="col-sm-2">
			<img  width="100px" height="100px" src="<?= base_url('assets/archivos_repre'). '/'.$agent->id .'/Foto-' .  $agent->id  ?>.png" class="img-responsive img-circle center-block" style="padding:10px" alt="estudio">
		</div>
		<div class="col-sm-10">
		
			<h3 class="ms-title"><b>Solicitud - <?= $agent->nombre . " " . $agent->apellido_p . " " . $agent->apellido_m ?></b> <button  class="btn btn-primary btn-m btn-aprobar"><i class="fa fa-check"></i> <span>Aprobar</span></button>  <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a> </h3>
			<input type="hidden" id="id_agent" value="<?= $agent->id ?>" />
		</div>	
	</div>
	<div class="col-sm-3">
		<div class="panel panel-primary panel-flat border-left-primary">
			<div class="panel-heading">
				General
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12 text-center">
						<b>Correo Electrónico:</b>
						<p><?= $agent->email  ?></p><br>
						<b>Fecha Nacimiento:</b>
						<p><?= $agent->fecha_nacimiento  ?></p><br>
						<b>Estado Civil:</b>
						<p><?= $agent->estado_civil  ?></p><br>
						<b>Teléfono:</b>
						<p><?= $agent->telefono_a  ?></p><br>
						<b>Sexo:</b>
						<p><?= $agent->sexo  ?></p><br>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="panel panel-olive panel-flat border-left-olive">
			<div class="panel-heading">
				Dirección
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12 text-center">
						<b>Calle:</b>
						<p><?= $agent->calle  ?></p><br>
						<b>Colonia:</b>
						<p><?= $agent->colonia  ?></p><br>
						<b>Código Postal:</b>
						<p><?= $agent->cp  ?></p><br>
						<b>Pais:</b>
						<p><?= $agent->pais  ?></p><br>
						<b>Estado:</b>
						<p><?= $agent->estado  ?></p><br>
						<b>Municipio:</b>
						<p><?= $agent->municipio  ?></p>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-3">
		<div class="panel panel-brown panel-flat border-left-brown">
			<div class="panel-heading">
				Fiscales
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12 text-center">
						<b>RFC:</b>
						<p><?= $agent->rfc  ?></p><br>
						<b>CURP:</b>
						<p><?= $agent->curp  ?></p><br>
						<b>Banco:</b>
						<p><?= $agent->banco  ?></p><br>
						<b>No Cuenta:</b>
						<p><?= $agent->no_cuenta  ?></p><br>
						<b>Sucursal Banco:</b>
						<p><?= $agent->sucursal_banco  ?></p><br>
						<b>Clabe:</b>
						<p><?= $agent->clabe  ?></p><br>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-12">
		<div class="panel panel-primary panel-flat border-left-brown">
			<div class="panel-body">
				<?php if ($agent->documentos == "1"){ ?>
				
				<div class="row">
					<div class="col-sm-4 text-center">
						<label >Comprobante de Domicilio</label>
						<img  width="160px" height="160px" src="<?= base_url('assets/archivos_repre'). '/'.$agent->id .'/Dom-' .  $agent->id  ?>.png" class="img-responsive img-rounded center-block" alt="estudio">
					</div>	
					
					<div class="col-sm-4 text-center">
						<label >Constancia de Situación Fiscal</label>
						<img  width="160px" height="160px" src="<?= base_url('assets/archivos_repre'). '/'.$agent->id .'/Fiscal-' .  $agent->id  ?>.png" class="img-responsive img-rounded center-block" alt="estudio">
					</div>
					
					<div class="col-sm-4 text-center">
						<label >CURP</label>
						<img  width="160px" height="160px" src="<?= base_url('assets/archivos_repre'). '/'.$agent->id .'/CURP-' .  $agent->id  ?>.png" class="img-responsive img-rounded center-block" alt="estudio">
					</div>
				
				</div><br>	
				<div class="row">
					<div class="col-sm-6 text-center">
						<label >INE Delantera</label>
						<img  width="160px" height="160px" src="<?= base_url('assets/archivos_repre'). '/'.$agent->id .'/INE-f-' .  $agent->id  ?>.png" class="img-responsive img-rounded center-block" alt="estudio">
					</div>
					<div class="col-sm-6 text-center">
						<label >INE Trasera</label>
						<img  width="160px" height="160px" src="<?= base_url('assets/archivos_repre'). '/'.$agent->id .'/INE-b-' .  $agent->id  ?>.png" class="img-responsive img-rounded center-block" alt="estudio">
					</div>		
				</div>
				

				<?php } else { ?>

					<div class="row">
						<div class="col-sm-12">
							<h4>No subio los documentos</h4>
						</div>
					</div>

				<?php  } ?>
            </div>
		</div>
	</div>

</div>

    