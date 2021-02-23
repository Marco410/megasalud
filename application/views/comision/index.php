<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>COMISIONES</b></h3>
	</div>	
	
	<div class="col-sm-12">
		<div class="panel panel-default">
            <div class="panel-heading" ><h4><b>Comisiones de Sucursales</b></h4></div>
			<div class="panel-body">
	
				<table id="suc-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Sucursal</th>
							<th>Paciente</th>
							<th>Pedido</th>
							<th>Comision</th>
							<th>Estatus</th>
							<th>Descripcion</th>
							<th style="width: 110px">Opc.</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
        
        <div class="panel panel-default">
            <div class="panel-heading" ><h4><b>Comisiones de Representantes</b></h4></div>
			<div class="panel-body">
	
				<table id="agent-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Representante</th>
							<th>Paciente</th>
							<th>Pedido</th>
							<th>Comision</th>
							<th>Estatus</th>
							<th>Descripcion</th>
							<th style="width: 100px">Opc.</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
        
        <div class="panel panel-default">
            <div class="panel-heading" ><h4><b>Comisiones de Usuarios</b></h4></div>
			<div class="panel-body">
	
				<table id="user-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Usuario</th>
							<th>Paciente</th>
							<th>Pedido</th>
							<th>Comision</th>
							<th>Estatus</th>
							<th>Descripcion</th>
							<th style="width: 110px">Opc.</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modal">
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
								CAMBIAR ESTATUS
							</div>
							<div class="panel-body">
                               <div hidden id="id_com" ></div>
                                <div hidden id="tipo" ></div>
                                <h4>Total</h4>
                                <h3 id="total" ></h3><br>
                                <label>Insertar Descripción (Opcional)</label>
                                <textarea id="descripcion" cols="4" rows="4" class="form-control" ></textarea>
                                <small>Ingresa una descripción o actualización del estatus de la comisión</small>
                                <div class="text-center" >
                                <button type="button" class="btn btn-sm btn-success btn-change"  >Marcar como pagado</button>
                                </div>
                                
							</div>
						</div>
					</div>


				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->