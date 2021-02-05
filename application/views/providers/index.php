<div class="container">

	<div class="col-xs-12">
		<h3 class="ms-title"><b>PROVEEDORES </b></h3>
	</div>	
    
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="main-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Empresa</th>
							<th>Contacto</th>
							<th>Teléfono</th>
							<th>E-mail</th>
							<th >Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $data as $prov ): ?>
							<tr>
								<td><?= $prov->id ?></td>
								<td><?= $prov->empresa ?></td>
								
								<td ><?= $prov->nombre_contacto ?></td>
								<td><a href="tel:<?= $prov->telefono ?>"><?= $prov->telefono ?></a></td>
                                <td><a href="mailto:<?= $prov->email ?>"><?= $prov->email ?></a></td>
								<td class="text-center btn-group">
                                     <a class="btn btn-sm btn-warning" role="button" href="<?= base_url().'proveedores/editar/'.$prov->id ?> " ><li class="fa fa-edit" ></li></a>
									<button class="btn btn-sm btn-info btn-info-user" data-id="<?= $prov->id  ?>"><i class="fa fa-file-text-o"></i></button>
									<button class="btn btn-sm btn-danger" data-id="<?= $prov->id  ?>"><i class="fa fa-trash"></i></button>
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
				    <img src="<?php echo IMG_PATH; ?>company.png" alt="" class="img-responsive">
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
								<b>Empresa:</b>
								<p class="prov-empresa"></p>
								<b>Nombre Contacto:</b>
								<p class="prov-contacto"></p>
                                <b>Cargo Contacto:</b>
								<p class="prov-cargo"></p>
                                <b>Giro:</b>
								<p class="prov-giro"></p>
								<b>Email:</b>
								<p id="prov-email"></p>
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
								<p id="prov-pais"></p>
								<b>Estado:</b>
								<p id="prov-estado"></p>
								<b>Municipio:</b>
								<p id="prov-municipio"></p>
								<b>Dirección:</b>
								<p id="prov-direccion"></p>
								<b>Telefono(s):</b>
								<p id="prov-telefono" class="no-margin"></p>
							</div>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="panel panel-brown text-center">
							<div class="panel-heading">
								OTROS
							</div>
							<div class="panel-body">
								<b>Notas:</b>
								<p id="prov-notas"></p>
							</div>
						</div>
					</div>					

			

				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

