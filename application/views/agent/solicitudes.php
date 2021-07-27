<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>SOLICITUDES PARA REPRESENTANTE (No Aprobados)</b><a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
	</div>	
	
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
                <table id="sol-table" class="table table-striped" style="width:100%">
                    <thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Telefono A</th>
                            <th>Estado</th>
                            <th>Aprobado</th>
                            <th>Documentos</th>
                            <th>Opc.</th>
						</tr>
					</thead>
                    <tbody>
					<?php foreach ( $solicitudes->result() as $agent ): ?>
						<tr>
							<td><?= $agent->id ?></td>
							<td><?= $agent->nombre ?></td>
							<td><?= $agent->email ?></td>
							<td><?= $agent->telefono_a ?></td>
                            <td><?= $agent->estado ?></td>
							
							<td><?php if ($agent->aprobado == "0"): ?>
								<span class="label label-danger">No</span>
								<?php elseif ($agent->aprobado == "1"):  ?>
								<span class="label label-success">Si</span>								
								<?php endif ?>
							</td>
                            <td><?php if ($agent->documentos == "0"): ?>
								<span class="label label-danger">No</span>
								<?php else: ?>
								<span class="label label-success">Si</span>								
								<?php endif ?>
							</td>
							<td class="text-center btn-group">
                                
								<a href="<?= base_url().'representante/ver-solicitud/'.$agent->id ?>" class="btn btn-sm btn-info"><i class="fa fa-file"></i></a>
                            
							</td>					
						</tr>
					<?php endforeach ?>
                    </tbody>
				</table>
	
            </div>
		</div>
	</div>

	

</div>