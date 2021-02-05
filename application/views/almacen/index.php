<div class="container">

	<div class="col-sm-12">
		<h3 class="ms-title"><b>ALMACÉN</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
	</div>
    <div class="col-sm-12" >
        <div class="panel panel-default" >
             <div class="panel-heading" >
                <h4>ACCIONES</h4>
                </div>
            <div class="panel-body" >
                <div class="col-sm-3 text-center" >
                    <a class="btn btn-success" role="button" href="<?= base_url().'almacen/entrada' ?> " >Hacer Entrada</a>
                </div>
                
                <div class="col-sm-3 text-center" >
                    <a class="btn btn-primary" role="button" href="<?= base_url().'almacen/entradas-mostrar' ?> " >Ver Entradas</a>
                </div>
                
                <div class="col-sm-3 text-center" >
                    <a class="btn btn-warning" role="button" href="<?= base_url().'almacen/salida' ?> " >Hacer Salida</a>
                </div>
                
                <div class="col-sm-3 text-center" >
                    <a class="btn btn-primary" role="button" href="<?= base_url().'almacen/salidas-mostrar' ?> " >Ver Salidas</a>
                </div>
                
            </div>
        </div>
    </div>
    
	
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-body">
            <div class="panel-heading " >
                <h3><label>Materia Prima</label></h3>
           </div>
				<table id="main-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Existencia</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $data as $almacen ): ?>
						 <?php if ($almacen->clave_categoria == "EMP"){ ?>
                            <tr>
								<td></td>
								<td><?= $almacen->id ?></td>
								<td><?= $almacen->nombre ?></td>
								<td><?= $almacen->existencia  ?></td>
								<td class="text-center btn-group">
									<button class="btn btn-sm btn-info" data-id="<?= $almacen->id  ?>"><i class="fa fa-file-text-o"></i></button>
									<button class="btn btn-sm btn-danger" data-id="<?= $almacen->id ?>"><i class="fa fa-trash"></i></button>
								</td>
                               
							</tr>
                         <?php } ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
        
        <div class="panel panel-default">
			<div class="panel-body">
            <div class="panel-heading " >
                <h3><label>Insumos</label></h3>
           </div>
				<table id="insumos-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Existencia</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $data as $almacen ): ?>
						 <?php if ($almacen->clave_categoria == "EI"){ ?>
                            <tr>
								<td></td>
								<td><?= $almacen->id ?></td>
								<td><?= $almacen->nombre ?></td>
								<td><?= $almacen->existencia  ?></td>
								<td class="text-center btn-group">
									<button class="btn btn-sm btn-info" data-id="<?= $almacen->id  ?>"><i class="fa fa-file-text-o"></i></button>
									<button class="btn btn-sm btn-danger" data-id="<?= $almacen->id ?>"><i class="fa fa-trash"></i></button>
								</td>
                               
							</tr>
                         <?php } ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
        
        <div class="panel panel-default">
			<div class="panel-body">
            <div class="panel-heading " >
                <h3><label>Consumibles</label></h3>
           </div>
				<table id="consumibles-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Existencia</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $data as $almacen ): ?>
						 <?php if ($almacen->clave_categoria == "EC"){ ?>
                            <tr>
								<td></td>
								<td><?= $almacen->id ?></td>
								<td><?= $almacen->nombre ?></td>
								<td><?= $almacen->existencia  ?></td>
								<td class="text-center btn-group">
									<button class="btn btn-sm btn-info" data-id="<?= $almacen->id  ?>"><i class="fa fa-file-text-o"></i></button>
									<button class="btn btn-sm btn-danger" data-id="<?= $almacen->id ?>"><i class="fa fa-trash"></i></button>
								</td>
                               
							</tr>
                         <?php } ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
        
        <div class="panel panel-default">
			<div class="panel-body">
            <div class="panel-heading " >
                <h3><label>Equipos y Materiales</label></h3>
           </div>
				<table id="e-materiales-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Existencia</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $data as $almacen ): ?>
						 <?php if ($almacen->clave_categoria == "EEM"){ ?>
                            <tr>
								<td></td>
								<td><?= $almacen->id ?></td>
								<td><?= $almacen->nombre ?></td>
								<td><?= $almacen->existencia  ?></td>
								<td class="text-center btn-group">
									<button class="btn btn-sm btn-info" data-id="<?= $almacen->id  ?>"><i class="fa fa-file-text-o"></i></button>
									<button class="btn btn-sm btn-danger" data-id="<?= $almacen->id ?>" ><i class="fa fa-trash"></i></button>
								</td>
                               
							</tr>
                         <?php } ?>
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
				    <img src="<?php echo IMG_PATH; ?>pro.png" alt="" class="img-responsive">
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
								<b>No Producto:</b>
								<p class="al-id"></p>
								<b>Producto:</b>
								<p id="al-nombre"></p>
                                <b>Descripción:</b>
								<p id="al-des"></p>
                                <b>Existencia:</b>
								<p id="al-exis"></p>
                                <b>Categoría:</b>
								<p id="al-cat"></p>
							</div>
						</div>
					</div>

			

				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
