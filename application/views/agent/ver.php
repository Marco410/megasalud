<div class="container">
	
	<div class="col-sm-12">
		<h3 class="ms-title"><b>Mi Panel - <?= $agent->nombre . " " . $agent->apellido_p ?></b><a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
	</div>	
    
    <div class="col-sm-12" >
        <div class="col-sm-4" >
            <div class="panel panel-olive" >
                <div class="panel-heading" >Balance - Pendiente</div>
                <div class="panel-body">
                    <h1 class="text-center">$ <?= $get_comisiones_pen ?> </h1>
                </div>
            </div>
        
        
        </div>
        
        <div class="col-sm-4" >
            <div class="panel panel-brown" >
                <div class="panel-heading" >Balance - Pagados</div>
                <div class="panel-body">
                    <h1 class="text-center">$ <?= $get_comisiones_pag ?> </h1>
                </div>
            </div>
        
        
        </div>
        
        <div class="col-sm-4" >
            <div class="panel panel-primary" >
                <div class="panel-heading" >Pacientes Concretados</div>
                
                <div class="panel-body">
                
                    <h1 class="text-center" id="count_paciente"><?= $count ?></h1>
                
                </div>
                
            </div>
            
        
        </div>
    
    </div>
    
	
	<div class="col-sm-12">
		<div class="panel panel-default">
            <div class="panel-heading" >
                <h3 class="title">Mis Pacientes Registrados</h3>
            </div>
			<div class="panel-body">
                
                <table id="ver-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Clave Bancaria</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Estado</th>
							<th>Telefono A</th>
							<th>Cita</th>
                            <th>Opc.</th>
						</tr>
					</thead>
                    <tbody>
                        <?php foreach ( $pacientes->result() as $paciente ): ?>
						<tr>
							<td><?= $paciente->id ?></td>
                            <td><?= $paciente->clave_bancaria ?></td>
							<td><?= $paciente->nombre ?></td>
							<td><?= $paciente->email ?></td>
							<td><?= $paciente->estado ?></td>
							<td><?= $paciente->telefono_a ?></td>
							
							<td><?php if ($paciente->seguim): ?>
								<span class="label label-success">Realizada</span>
								<?php else: ?>
								<span class="label label-warning">Pendiente</span>								
								<?php endif ?>
							</td>
							<td class="text-center btn-group">
                                
                                <button class="btn btn-sm btn-info btn-info-pedido" data-id="<?= $paciente->id  ?>"><i class="fa fa-eye"></i></button>
                                
								<a href="<?= base_url().'pacientes/editar/'.$paciente->id ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                
								
                                
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
								PEDIDOS
							</div>
							<div class="panel-body">
                                <div class="pedido" >
                                
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