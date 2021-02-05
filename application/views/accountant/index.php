<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>Contaduría</b></h3>
	</div>	
	
	<div class="col-sm-12" >
        <div class="panel panel-default" >
             <div class="panel-heading" >
                <h4>ACCIONES</h4>
                </div>
            <div class="panel-body" >
                <div class="col-sm-4 text-center" >
                    <a class="btn btn-success" role="button" href="<?= base_url().'sucursales/agenda/'.$this->session->sucursal?> " ><li class="fa fa-calendar" ></li> Agenda de Sucursal</a>
                </div>
                <div class="col-sm-4 text-center" >
                    <a href="<?= base_url().'proveedores/' ?> " class="btn btn-warning"><i class="fa fa-eye"></i> <span>Ver Provedores</span></a>
                </div>
                <div class="col-sm-4 text-center" >
                    <a  class="btn btn-info"  data-toggle="modal" data-target="#historial"><i class="fa fa-clock-o "></i>  Historial de Citas</a>
                </div>
            </div>
        </div>
    </div>

</div>

  <!-- Modal Agregar Historial citas -->
 
        <div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="fotoPerfil" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="fotoPerfil">Historial de Citas</h5>
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
                            <th>Medico</th>
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