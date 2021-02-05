<div class="container">

	<div class="col-sm-12">
		<h3 class="ms-title"><b>SALIDAS</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
	</div>
    
    
    <div class="col-sm-12" >

        <div class="panel panel-olive" >
            <div class="panel-heading " >
                <h5>Todas las salidas</h5>
            </div>
            <div class="panel-body" >
                <table id="entrada-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Usuario</th>
							<th>Entregado A</th>
                            <th>Fecha</th>
                            <th>Ver</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $salidas as $sal ): ?>
							<tr>
								<td>E-<?= $sal->id ?></td>
								<td><?= $sal->nombre ?></td>
								<td><?= $sal->entregado ?></td>
								<td><p><?php echo date("j M, Y h:i a", strtotime($sal->created_at))  ?></p></td>
								<td><button title="Ver" class="btn btn-sm btn-info btn-info-salida" data-id="<?= $sal->id  ?>"><i class="fa fa-eye" ></i></button></td>
                            
                                
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
				    <img src="<?php echo IMG_PATH; ?>in.png" alt="" class="img-responsive">
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
								<b>No Salida:</b>
								<p class="sal-id"></p>
								<b>Usuario:</b>
								<p id="sal-user"></p>
                                <b>Entregado A:</b>
								<p id="sal-entre"></p>
							</div>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="panel panel-olive text-center">
							<div class="panel-heading">
								PRODUCTOS:
							</div>
							<div class="panel-body">
								<b>Fecha de Realización:</b>
								<p id="sal-fecha"></p>
                                <b>Productos:</b>
                                <textarea rows="5" class="form-control" id="sal-pro" readonly style="text-align:center" ></textarea>
								
							</div>
						</div>
					</div>

			

				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


