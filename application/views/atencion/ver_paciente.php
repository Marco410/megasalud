<?php 
    $img_load = base_url('assets/images/loader').'/';
    $img_path = base_url('assets/images/icons').'/';
    $img_perfil = base_url('assets/foto_paciente').'/';
	$paciente = $paciente->row();
    $fecha = substr($paciente->fecha_nacimiento, 0,4);
    $fechaMax = date('Y') - $fecha;
    $type = $this->session->type;
?>
<input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
<div class="container">
    <h3 class="ms-title"><b>PERFIL DE PACIENTE</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
 
 <!--- Panel de Identificacion  ---> 
  <div class="panel panel-primary" style="border-radius:15px" >  
      
      <div class="panel-heading text-center" style="border-radius:15px" >
          <h2><i class="glyphicon glyphicon-user "></i> <?= $paciente->nombre . " " . $paciente->apellido_p . " " . $paciente->apellido_m  ?> </h2>
         </div>
     <div class="panel-body ">
         <div class="container" >
             <div  class="row" >
             <div class="col-sm-4 text-center" >
                 <?php if($paciente->foto == ""){ if ($paciente->sexo == "Masculino"){ ?>
                  <img src="<?php echo $img_path ?>hombre.svg" width="100px" height="100px" alt="" class="img-responsive center-block" /> 
                 <?php } else{ ?>
                 <img src="<?php echo $img_path ?>mujer.svg" width="100px" height="100px" alt="" class="img-responsive center-block" /> 
                 <?php }}else{ ?>
                 <img src="<?php echo $img_perfil . $paciente->foto ?>" width="100px" height="100px" alt="" class="img-responsive img-circle center-block" />
                 <?php } ?>
                 <br>
                 <div class="" >
                     <!---
                 <a  class="btn btn-info"  data-toggle="modal" data-target="#foto" ><i class="fa fa-picture-o"></i> Actualizar Foto</a>-->
                  </div>
              </div> 
             <div class="col-sm-4" >
                  <h4>Motivo de Consulta: <label><b><?=$paciente->motivo_consulta ?></b></label></h4><h4>Expediente: <label><b><?=$paciente->clave_bancaria ?></b></label></h4>
              </div>   
                 <div class="col-sm-4 text-center" >
                  <h4>Sucursal: </h4><h4><label ><b id="sucursal_p" ></b></label></h4>
              </div>   
             </div>
             <br>
      <div class="row" >
             <div class="form-group col-sm-3 text-center" >

                  <label>Fecha de Nacimiento:</label> <p><?=$paciente->fecha_nacimiento ?>
                  </p>
                 <label>Sexo:</label> <p><?=$paciente->sexo ?></p> 
                 <label>Estado Civil:</label> <p><?=$paciente->estado_civil ?></p> 

             </div>
         
             <div class="form-group col-sm-3 text-center">
                  <label>Origen:</label> <p><?= $paciente->municipio_origen . " " . $paciente->estado_origen . " " . $paciente->pais_origen ?> </p>
             </div>
         
             <div class="form-group col-sm-3 text-center">
                  <label>Residencia:</label> <p><?= $paciente->calle . " " . $paciente->colonia . " " . $paciente->cp. " " . $paciente->municipio. " " . $paciente->estado. " " . $paciente->pais ?> </p> 
             </div>
         
             <div class="form-group col-sm-3 text-center">

                 <label>Contacto:</label> <p><label>Telefono: </label><?= " " . $paciente->telefono_a . " ó " . $paciente->telefono_b ?><br><label>E-mail: </label> <?= $paciente->email ?> <br><label>RFC:  </label> <?= $paciente->rfc ?><br> <label>Hora para llamarle:</label><br><?= $paciente->hr_llamarle ?>  </p>  
             </div>
             <div class="form-group col-sm-12 " >
                 <div></div>
                 
                 <div class="pull-right">
                  <a  class="btn btn-info"  data-toggle="modal" data-target="#historial"><i class="fa fa-clock-o "></i>  Historial de Citas</a>
                  <a href="<?= base_url().'pacientes/editar/'.$paciente->id ?>" class="btn  btn-warning"><i class="fa fa-edit "></i> Editar</a>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#pass" id="show-pass" name="show-pass" ><i class="fa fa-key "></i>Ver Contraseña</button>   
                  </div>
             </div>
             
         </div>
         </div>
         </div>
      
      
      
      
    </div>
</div>

      <!-- Modal Contraseña -->
     <div class="modal fade" id="pass" tabindex="-1" role="dialog" aria-labelledby="Password" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" >Contraseña</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="modal-body">
              <label>Solo muestrasela al paciente</label>
              <p ><?= $paciente->password ?></p>
            </div>
                 
          </div>
        </div>
      </div>    
      <!-- Termina Modal Contraseña -->

        <!-- Modal  Historial citas -->

    <div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="fotoPerfil" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Citas del Paciente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body">
            <div class="row" >

            <table  class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Doctor</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                         <?php foreach ($historial->result() as $his):?>
                     <tr>
                        <td><?= $his->created_at ?></td>
                        <td><?= $his->nombre ?> </td>
                        <td><?= $his->motivo ?></td>    
                    </tr>
                        <?php endforeach ?>

                </tbody>

            </table>

            </div>
          </div>

        </div>
      </div>
    </div>
    <!--- Termina modal Historial citas --> 
        
