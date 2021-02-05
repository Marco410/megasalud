<?php $img_path = base_url('assets/images/icons').'/'; ?>

<div class="container">
    
    <h3 class="ms-title"><b>NUEVO PEDIDO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
    
    <div class="panel panel-primary" >
        
        <form id="buscar" method="post" class="panel-body border-left-warning" >
                <div class="col-sm-2">
                     <img src="<?php echo $img_path ?>order.svg" width="50px" height="50px" alt="" class="img-responsive center-block" />
                </div>
                
                <div class="form-group col-sm-5 " >
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bs-modal-pacientes">Seleccionar Paciente</button><br>
                    <small>Solo aparecen pacientes que tomaron consulta.</small>
                </div>
                
                <div class="input-group col-sm-5" >
                    <input readonly required type="text" name="seleccion" id="seleccion" class="form-control" /> <span class="input-group-btn"><button type="submit" class="btn btn-warning" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></span>
                </div>
            
        </form>
    </div> 
    
     <div class="panel panel-olive" >
        <div id="data-order" class="panel-body border-left-olive text-center" >
            <p>Información de Envío</p>
            
            <div class="row">
                    <div class="form-group col-sm-4">
						<label>
							Nombre:
						</label>
						<input type="text" name="nombre" id="nombre" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-4">
						<label>
							Apellido Paterno:
						</label>
						<input type="text" name="apellido_p" id="apellido_p" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-4">
						<label>
							Apellido Materno:
						</label>
						<input type="text" name="apellido_m" id="apellido_m" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-3">
						<label>
							Calle:
						</label>
						<input type="text" name="calle" id="calle" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-3">
						<label>
							Colonia:
						</label>
						<input type="text" name="colonia" id="colonia" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-3">
						<label>
							Municipio:
						</label>
						<input type="text" name="municipio" id="municipio" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-3">
						<label>
							Estado:
						</label>
						<input type="text" name="estado" id="estado" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-3">
						<label>
							Codigo Postal:
						</label>
						<input type="text" name="cp" id="cp" class="form-control" required minlength="3">
					</div>
                    <div class="form-group col-sm-6">
						<label>
							Telefono(s):
						</label>
						<input type="text" name="tels" id="tels" class="form-control" required minlength="3">
					</div>  
                    <div class="form-group col-sm-3">
						<label>
							RFC:
						</label>
						<input type="text" name="rfc" id="rfc" class="form-control" required minlength="3">
					</div>
        
            </div>
            
        </div>
    </div>  
</div>


<!-- Modal para seleccionar un paciente  -->
<div class="modal fade bs-modal-pacientes" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalPacientes">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-header">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
          <span aria-hidden="true">&times;</span>
        </button>
          
        <h4 class="modal-title">Seleccionar Paciente</h4>
      </div>
      
    <div class="modal-content">
        
        <div class="modal-body" >
      <table id="pacients-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Email</th>
                            <th>Seleccionar</th>
							
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $pacients as $pacient ): ?>
							<tr>
								<td><?= $pacient->id ?></td>
								<td><?= $pacient->nombre ?></td>
								<td><a href="mailto:<?= $pacient->email ?>"><?= $pacient->email ?></a></td>	
                                <td>
                                    <a onclick="seleccionP(this)" role="button" data-value="<?= $pacient->id ?>" type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                                </td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
            </div>
    </div>
  </div>
</div>
