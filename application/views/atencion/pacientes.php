<div class="container">

	<div class="col-xs-12">
		<h3 class="ms-title"><b>PACIENTES - <?php if($this->session->type =="Administrador" || $this->session->type =="Medico Administrador" ){ echo "TODOS"; }else{ echo $this->session->sucursal_name; } ?></b></h3>
	</div>
    
      <div class="col-sm-12" >
        <div class="panel panel-default" >
             <div class="panel-heading" >
                <h4>ACCIONES</h4>
                </div>
            <div class="panel-body" >
                <div class="col-sm-6 text-center" >
                    <a class="btn btn-success" role="button" href="<?= base_url().'sucursales/agenda/'.$this->session->sucursal?> " ><li class="fa fa-calendar" ></li> Agenda de Sucursal</a>
                </div>
                <?php if ($this->session->type == "Administrador" || $this->session->type == "Medico Administrador" || $this->session->type == "Atención a Clientes" ) ?>
                <div class="col-sm-6 text-center" >
                    <a  class="btn btn-info"  data-toggle="modal" data-target="#historial2"><i class="fa fa-clock-o "></i>  Todas las citas</a>
                </div>
            </div>
        </div>
    </div>
    
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body" >
                <table id="main-table" class="table table-striped table-condensed table-hover" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Clave</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Motivo Consulta</th>
							<th>Estado</th>
							<th>Telefono A</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
            <tbody id="main-table" >
            
            </tbody>
					
				</table>
			</div>
		</div>
	</div>
</div>

        <!-- Modal Agregar Historial citas -->
 
        <div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="fotoPerfil" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="fotoPerfil">Tus Citas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <div class="row" >
                
                <table id="his_table"  class="table table-striped"  style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Expediente</th>
                            <th>Paciente</th>
                            <th>Telefono</th>
                            <th>Motivo</th>
                            <th>Historia</th>
                        </tr>
                       
                    </thead>
                    <tbody id="his_table">
                       
                       
                    </tbody>

                </table>
               
                </div>
              </div>
                   
            </div>
          </div>
        </div>
    <!--- Termina modal Historial citas -->  

<!-- Modal Agregar Historial citas -->
 
        <div class="modal fade" id="historial2" tabindex="-1" role="dialog" aria-labelledby="fotoPerfil" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="fotoPerfil">Todas las citas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <div class="row" >
                
                <table id="his_table2"  class="table table-striped"  style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Expediente</th>
                            <th>Paciente</th>
                            <th>Telefono</th>
                            <th>Motivo</th>
                            <th>Médico</th>
                            <th>Sucursal Paciente</th>
                            <th>Historia</th>
                        </tr>
                    </thead>
                    <tbody id="his_table2">
                    </tbody>

                </table>
               
                </div>
              </div>
                   
            </div>
          </div>
        </div>
    <!--- Termina modal Historial citas --> 

    
