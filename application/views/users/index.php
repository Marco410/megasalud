<div class="container">

	<div class="col-xs-12">
		<h3 class="ms-title"><b>USUARIOS - <?php if($this->session->type =="Administrador"){ echo "TODOS"; }else{ echo $this->session->sucursal_name; } ?> </b></h3>
	</div>	
    
    <div class="col-sm-12" >
    <div class="panel panel-deafult border-left-olive" >
        <div class="panel-body" >
        <div class="col-sm-12 text-center" >
            <a class="btn btn-primary" href="<?= base_url() ?>usuarios/sesiones" >Sesiones</a>
        </div>
            </div>
	</div>
    </div>
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="main-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Tipo</th>
							<th>Fecha Nacimiento</th>
							<th>Sexo</th>
							<th>Municipio</th>
							<th>Estado</th>
							<th>Pais</th>
							<th>Calle y Num.</th>
							<th>Colonia</th>
							<th>CP</th>
							<th>RFC</th>
							<th>CURP</th>
							<th>Telefono A</th>
							<th>Telefono B</th>
							<th>Clave Bancaria</th>
							<th>Cedula</th>
							<th>Especialidad</th>
							<th>Cuenta Bancaria</th>
							<th>Banco</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $data as $user ): ?>
							<tr>
								<td></td>
								<td><?= $user->id ?></td>
								<td><?= $user->nombre.' '.$user->apellido_p.' '.$user->apellido_m ?></td>
								<td><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a></td>
								<td ><?= $user->name ?>
								</td>
								<td><?= $user->fecha_nacimiento ?></td>
								<td><?= $user->sexo ?></td>
								<td><?= $user->municipio ?></td>
								<td><?= $user->estado ?></td>
								<td><?= $user->pais ?></td>
								<td><?= $user->calle ?></td>
								<td><?= $user->colonia ?></td>
								<td><?= $user->cp ?></td>
								<td><?= $user->rfc ?></td>
								<td><?= $user->curp ?></td>
								<td><a href="tel:<?= $user->telefono_a ?>"><?= $user->telefono_a ?></a></td>
								<td><?= $user->telefono_b ?></td>
								<td><?= $user->clave_bancaria ?></td>
								<td><?= $user->cedula ?></td>
								<td><?= $user->especialidad ?></td>
								<td><?= $user->cuenta_bancaria ?></td>
								<td><?= $user->banco ?></td>
								<td class="text-center btn-group">
									<button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
									<button class="btn btn-sm btn-info btn-info-user" data-id="<?= $user->id  ?>"><i class="fa fa-file-text-o"></i></button>
									<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
								</td>					
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-info">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-info bg-transparent">

			<div class="header-modal-info bg-modal-info-users flex-column-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="img-circle img-modal-info col-xs-3 mb-15">
				    <img src="<?php echo IMG_PATH; ?>user.jpg" alt="" class="img-responsive">
				</div>			
				<h2 class="text-center no-margin capitalize user-name"></h2>
				<p class="no-margin user-tipoUsuario"></p>
			</div>
			<div class="modal-body modal-body-info pt-20">
				<div class="col-sm-12">
					<!-- <h4><b>GENERAL</b></h4> -->
					<div class="col-xs-12">
						<div class="panel panel-primary text-center">
							<div class="panel-heading">
								GENERAL
							</div>
							<div class="panel-body">
								<b>Nombre:</b>
								<p class="user-name"></p>
								<b>Tipo de usuario:</b>
								<p class="user-tipoUsuario"></p>
								<b>Email:</b>
								<p id="user-email"></p>
							</div>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="panel panel-olive text-center">
							<div class="panel-heading">
								CONTACTO
							</div>
							<div class="panel-body">
								<b>País:</b>
								<p id="user-pais"></p>
								<b>Estado:</b>
								<p id="user-estado"></p>
								<b>Municipio:</b>
								<p id="user-municipio"></p>
								<b>Dirección:</b>
								<p id="user-direccion"></p>
								<b>Telefono(s):</b>
								<p id="user-telefono_a" class="no-margin"></p>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="panel panel-brown text-center">
							<div class="panel-heading">
								IDENTIFICACIÓN
							</div>
							<div class="panel-body">
								<b>CURP:</b>
								<p id="user-curp"></p>
								<b>RFC:</b>
								<p id="user-rfc"></p>
								<b>Fecha nacimiento:</b>
								<p id="user-nacimiento"></p>
								<b>Sexo:</b>
								<p id="user-sexo"></p>
							</div>
						</div>
					</div>					

					<div class="col-xs-6">
						<div class="panel panel-brown text-center">
							<div class="panel-heading">
								OTROS
							</div>
							<div class="panel-body">
								<b>Especialidad:</b>
								<p id="user-especialidad"></p>
								<b>Cedula:</b>
								<p id="user-cedula"></p>
								<b>Cuenta Bancaria:</b>
								<p id="user-cuenta_bancaria"></p>
								<b>Clave Bancaria:</b>
								<p id="user-clave_bancaria"></p>
								<b>Banco:</b>
								<p id="user-banco"></p>
							</div>
						</div>
					</div>
		
					<div class="col-xs-12" id="panel-user-sucursales">
						<div class="divider"></div>
						<h4 class="ms-heading text-center mt-30 mb-30"><b>SUCURSALES</b></h4>
						<div class="panel-group" id="accordion-user-sucursales">

						</div>
					</div>					

				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

