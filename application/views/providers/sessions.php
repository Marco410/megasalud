<div class="container">

	<div class="col-sm-12">
		<h3 class="ms-title"><b>Historial del Sistema</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
	</div>
    
	
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-body">
            <div class="panel-heading " >
                <h3><label>Usuarios</label></h3>
           </div>
				<table id="user-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $users->result() as $user ): ?>
						 
                            <tr>
								<td><?= $user->id ?></td>
								<td><?= $user->nombre ?></td>
								<td><?= $user->created_at  ?></td>
							
                               
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
        
        
	</div>
</div>
