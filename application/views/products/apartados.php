<div class="container">

	<div class="col-sm-12">
		<h3 class="ms-title"><b>APARTADOS |  <?=  $suc  ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
        
	</div>
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-body">
               
                <div class="col-sm-12" >
				<table id="apartados-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Paciente</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $apartados as $apartado ): ?>
							<tr>
								<td></td>
								<td><?= $apartado->id ?></td>
								<td><?= $apartado->nombre ?></td>
								<td><?= $apartado->producto ?></td>
								<td><?= $apartado->cantidad  ?></td>
								<td class="text-center">
                                    <a class="btn btn-sm btn-info" href="<?=base_url('/pacientes/historia/');?><?= $apartado->id_paciente ?>" >Ver</a>
								</td>					
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
                </div>    
			</div>
		</div>
	</div>
</div>
