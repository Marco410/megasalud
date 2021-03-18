<?php 
    $img_load = base_url('assets/images/loader').'/';
    $img_path = base_url('assets/images/icons').'/';
    $img_perfil = base_url('assets/foto_paciente').'/';
	$paciente = $paciente->row();
    $fecha = substr($paciente->fecha_nacimiento, 0,4);
    $fechaMax = date('Y') - $fecha;
    $type = $this->session->type;
?>

    <div class="container">
    <input type="hidden" value="<?= $fecha ?>" id="anio" />
    <input type="hidden" id="seguimiento" value="<?= $paciente->seguim ?>"  />
    
    <h3 class="ms-title"><b>HISTORIAL CLÍNICO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
 
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
                   <a  class="btn btn-info"  data-toggle="modal" data-target="#foto" ><i class="fa fa-picture-o"></i> Actualizar Foto</a>
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
        <!-- Modal Sucursal -->
       <div class="modal fade" id="sucursal_modal" tabindex="-1" role="dialog" aria-labelledby="Password" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="fotoPerfil">Selecciona Sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form id="insert-suc" method="post" name="insert-suc" >
            <div class="modal-body">
                <div class="row" >
                <div id="panel-sucursales" class="col-sm-8"  hidden  >
                     <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                        <label>
                            Sucursal
                        </label>
                        <select id="suc_paciente" name="suc_paciente" class="form-control" required >

                            <option value="" >Seleccione una opción</option>
                            <?php foreach ($sucursales->result() as $sucursal): ?>
                            <option value="<?= $sucursal->id ?>"><?= $sucursal->razon_social ?></option>
                            <?php endforeach ?>

                        </select>
                           
                        
                  </div>
                    </div>
              </div>
                <div class="modal-footer" > <button class="btn btn-sm btn-primary" type="submit" ><i class="fa fa-save" > </i> Guarda en  Sucursal</button>
                    </div>
                 </form>  
            </div>
          </div>
        </div>    
        <!-- Termina Modal Sucursal -->
        <!-- Modal Agregar Historial citas -->
 
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
        
    <!-- Modal Agregar Foto -->
    <div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="fotoPerfil" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" >Actualizar Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <form method="post" id="agregar_foto" name="agregar_foto"  enctype="multipart/form-data" >
            <div class="modal-body">
                <div class="row" >
                      <div class="col-sm-6 form-group" >
                          <b>Selecciona la imagen</b>
                      <input class="form-control" type="file" id="foto_sbr" name="foto_sbr"  accept="image/x-png,image/gif,image/jpeg" />
                          <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                      </div>
                </div>
              </div>
                   
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
              </div>
                    
             </form> 
            </div>
          </div>
        </div>
    <!--- Termina modal foto -->
    </div>
        
   <!--- Panel de Acciones  ---> 
   <div class="panel panel-primary" style="border-radius:15px" >               
             
           <div class="panel mb-0 panel-default panel-flat border-left-brown">
             <div class="panel-heading">
				<span class="ms-subtitle">ACCIONES</span>
             </div>
               
       <div class="panel-body" >
                   
           <div class="row" >
                <div class="col-sm-4" >
                <h4 class="text-center title" >ESTUDIOS</h4>
                   
                 <div class="form-group col-sm-6 text-center" >
                    <a href="<?= base_url().'pacientes/historia/'.$paciente->id.'/estudios/'.$paciente->id ?>" class="btn btn-info btn-info-user"><i class="fa fa-file-text-o"></i>Ver Estudios</a>
                 </div>
           
                 <div class="col-sm-6 form-group text-center   "  > 
                   <a  class="btn btn-info"  data-toggle="modal" data-target="#estudios" ><i class="fa fa-plus"></i> Agregar nuevo estudio</a>

                </div>  
               </div> 
               
               <div class="col-sm-4" >
                <h4 class="text-center title" >GRÁFICAS</h4>
                   
                 <div class="form-group text-center" >
                    <a href="<?= base_url().'pacientes/graficas/'.$paciente->id ?>" class="btn btn-info btn-info-user"><i class="fa fa-bar-chart"></i>Ver Gráficas</a>
                 </div>
           
               </div>
           
            <div class="col-sm-4" >
                    <h4 class="text-center title" >RECETA</h4>

                    <div class="col-sm-12 text-center" >
                        
                       <div class="col-sm-6 form-group text-center"  >  
                        <a href="<?= base_url() ?>pedidos/receta/<?= $paciente->id ?>" class="btn btn-info "  ><i class="fa fa-file-text"></i>     Crear una receta</a>
                        </div>
                        <div class="col-sm-6 form-group text-center"  > 
                        <a href="<?= base_url() ?>pacientes/recetas/<?= $paciente->id ?>" class="btn btn-info "  ><i class="fa fa-file-text"></i>     Ver Recetas</a>
                        </div>
                    </div>
                </div>
               <div class="col-sm-12" >
                   <div class="col-sm-4" >
                <h4 class="text-center title" >CREAR CITA</h4>
                   <div class="form-group text-center" >
                    <a  class="btn btn-info text-center"  data-toggle="modal" data-target="#nuevacita"><i class="fa fa-calendar "></i>  Generar nueva cita</a>
                    </div>
                   </div>
                   <div class="col-sm-4" >
                   <h4 class="text-center title" >RESUMEN</h4>
                   <div class="form-group text-center" >
                       
                       <a href="<?= base_url() ?>pacientes/resumen/<?= $paciente->id ?>" class="btn btn-info "  ><i class="fa fa-folder"></i>     Ver Resumen</a>
                    </div>
                    </div>  
                   <div class="col-sm-4" >
                   <h4 class="text-center title" >FINANZAS</h4>
                   <div class="form-group text-center" >
                       
                       <a href="<?= base_url() ?>pacientes/adeudos/<?= $paciente->id ?>" class="btn btn-info "  ><i class="fa fa-h-square"></i>     Ver Adeudos</a>
                    </div>
                    </div>   
               </div>
             </div>  
       </div>
           
           </div>   
           <!--- Termina Panel de Acciones  ---> 
    </div>
    <?php if ($paciente->seguim == 0){  ?>
    
    <div class="panel panel-default" >
        <div class="panel-body text-center" >
            
            <form name="inicia_consulta"  method="post" id="inicia_consulta">
                
            <input type="hidden" id="sub" name="sub" value="0"  />
                
            <input type="hidden" id="clave_bancaria" name="clave_bancaria" value="<?=$paciente->clave_bancaria ?>"  />
                
            <input type="hidden" id="estado" name="estado" value="<?=$paciente->estado ?>"  />
                
            <input type="hidden" id="id_paciente" name="id_paciente" value="<?=$paciente->id ?>" />
            <input type="hidden" id="id_user" name="id_user" value="<?= $this->session->id;  ?>" />
            <button type="submit" class="btn btn-danger" style="margin-top:10px"><i class="glyphicon glyphicon-play"></i> Iniciar el Historial Clinico</button>
            </form>
            
        </div>
    
    </div>
    
    <?php }else{   ?>
    
    <!--- Accion de primera vez  ---> 
    <div id="primera_vez" >
        
    <!--- Cita subsecuente ---->    
    <div class="panel panel-default" >
        <div class="panel-body text-center" >
            
            <form name="inicia_consulta"  method="post" id="inicia_consulta">
                
            <input type="hidden" id="sub" name="sub" value="<?= $paciente->seguim ?>"  />
                
            <input type="hidden" id="id_paciente" name="id_paciente" value="<?=$paciente->id ?>" />
            <input type="hidden" id="id_user" name="id_user" value="<?= $this->session->id;  ?>" />
            
            <div class="col-sm-6" >
                <label>Motivo de Consulta</label>
               <select class="form-control" required id="motivo" name="motivo" >
                    <option value="">Seleccione: </option>

                    <?php foreach ($motivo_consulta->result() as $motivo): ?>
                    <option value="<?= $motivo->enfermedad ?>"><?= $motivo->enfermedad ?></option>
                    <?php endforeach ?>    
                    <option value="Otra">Otra</option>    
                </select>
                <div class="" id="panel-add-m" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="1" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>

                    </div>
                </div>
            <div class="col-sm-6">
                <label>Descripción</label>
                <input required  type="text" class="form-control" id="motivo_des" name="motivo_des" placeholder="Escribe Motivo o Descripción" />
            </div>
            <div class="col-sm-12" >
                <button type="submit" class="btn btn-warning" style="margin-top:10px"><i class="glyphicon glyphicon-play"></i> Iniciar Cita Subsecuente</button>
            </div>
            
            </form>
            
                    
                </div>
            
        </div>
    
    </div>
        <!-- Termina cita subsecuente --->
        
    <div class="panel panel-default" >
        <div class="panel-body" >
            
             <!--- Panel de Notas  ---> 
           
           <div class="panel mb-0 panel-default panel-flat border-left-brown">
             <div class="panel-heading">
						<span class="ms-subtitle">NOTAS | DIAGNÓSTICO | MOTIVO DE CONSULTA </span>
            </div> 
            <div class="panel-body">  
                <div class="row">
               
           <div class="form-group col-sm-7" >
           <form name="notas_dr"  method="post" id="notas_dr">
               <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
              <!--- Estas lineas dejarlas asi  ---> 
               <b>Notas del doctor</b>
                <textarea  rows="8" readonly class="form-control" id="text_notas"><?php foreach ($notas->result() as $nota):?>
(<?= date("j M, Y h:i a", strtotime($nota->created_at))  ?>): 
<?= $nota->nota ?>                
<?php endforeach ?></textarea>
               <!--- Estas lineas dejarlas asi  ---> 
               
               <textarea name="notas_input" id="notas_input" class="form-control" type="text" placeholder="Agrega una nueva nota" ></textarea>
               
               <button type="submit" class="btn btn-info btn-info-user" style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i>    Guardar Nota</button>
               </form>
           </div>
            <section id="DiagnósticoSec">
            <div class="form-group col-sm-5" >
           <form name="diagnostico_dr"  method="post" id="diagnostico_dr">
              <!--- Estas lineas dejarlas asi  ---> 
               <b>Diagnóstico</b>
                <textarea  rows="5" readonly class="form-control" id="text_diag"><?php foreach ($diagnosticos->result() as $diag):?>
(<?= date("j M, Y h:i a", strtotime($diag->created_at)) ?>): 
<?= $diag->diagnostico ?>                
<?php endforeach ?></textarea>
               <!--- Estas lineas dejarlas asi  ---> 
               
               <textarea name="diagnostico_input" id="diagnostico_input" rows="2" class="form-control" type="text" placeholder="Agrega una nuevo Diagnóstico" ></textarea>
               <b>Edad</b>
               <input id="edad_diag" required type="number" name="edad_diag" class="form-control" value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" />
               <input type="hidden" value="<?= $fecha ?>" name="anio" />
               <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
               
               <button type="submit" class="btn btn-info btn-info-user" style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i>    Guardar Diagnóstico</button>
               </form>
           </div>
            </section>    
                </div>
             </div>   
           </div>
           
           <!--- Termina Panel de Notas  ---> 
    
            
           <!--- Panel de Terapias y medicamentos  ---> 
            <div id="hisclinic_mediSec" ></div>
            <div class="panel mb-0 panel-default panel-flat border-left-olive">
             <div class="panel-heading">
						<span class="ms-subtitle">Terapias y Medicamentos </span>
            </div> 
            <div id="divMedi" class="panel-body">  
                <div class="row">
                    
                    <div class="col-sm-6" >
                         <form id="form-terapia" name="form-terapia" method="post" >
                        <input type="hidden" value="<?= $fecha ?>" name="anio" />
                        <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                        <h4>Terapía</h4>
                         <select required id="terapia" class="form-control" name="terapia">
                            <option value="" >Seleccione: </option>
                             <?php foreach ( $terapias->result() as $terapia ): ?>
                            <option value="<?= $terapia->id ?>" ><?= $terapia->terapia ?></option>
                           <?php endforeach ?>
                             <option value="Otra" >Otro</option>
                        </select>
                         <div class="" id="panel-add-ter" hidden >
                        <br>
                        <a href="#" class="btn btn-sm btn-info" data-id="18" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>

                     </div>
                        <b>Edad</b>
                        <input id="edad_terapia" required type="number" name="edad_terapia" class="form-control" value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" /><br>
                            
                         <button type="submit" class="btn btn-info btn-info-user" style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i>    Guardar Terapia</button> 
                        </form>
                    </div>
                    
                    <div  class="col-sm-6" >
                        <form id="form-medi" name="form-medi" method="post" >
                        <input type="hidden" value="<?= $fecha ?>" name="anio" />
                        <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                        <h4>Medicamento</h4>
                        <select required id="p_medicamento" class="form-control" name="p_medicamento">
                            <option value="" >Seleccione: </option>
                             <?php foreach ( $medicamentos->result() as $medicamento ): ?>
                            <option value="<?= $medicamento->id ?>" ><?= $medicamento->medicamento ?></option>
                           <?php endforeach ?>
                             <option value="Otra" >Otro</option>
                        </select>
                        <div class="" id="panel-add-med" hidden >
                        <br>
                        <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>

                     </div>
                        <b>Edad</b>
                        <input id="edad_medica" required type="number" name="edad_medica" class="form-control" value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" /><br>
                            
                         <button type="submit" class="btn btn-info btn-info-user" style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i>    Guardar Medicamento</button>   
                        </form>
                    </div>
                
                
                </div>
                
                
                </div>
            
            
            </div>
            
            
            <!--- Termina Panel de Terapias y medicamentos  ---> 
            
        </div>
    
    </div>
    
    <!--- Termina Panel Notas y Acciones  ---> 
    
    <!-- Modal Agregar Estudio -->
    <div class="modal fade" id="estudios" tabindex="-1" role="dialog" aria-labelledby="estudiosTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="estudioTitle">Agregar un nuevo estudio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <form method="post" id="agregar_estudio" name="agregar_estudio"  enctype="multipart/form-data" >
            <div class="modal-body">
                <div class="row" >
                    <div class="col-sm-12 form-group" >
                      <b>Titulo del Estudio</b>
                      <input class="form-control" type="text" id="title_estudio" name="title_estudio" required />
                      </div>
                      <div class="col-sm-6 form-group" >
                      <b>Fecha del Estudio</b>
                          <input class="form-control" type="date" id="fecha_estudio" name="fecha_estudio" required />
                      </div>
                      <div class="col-sm-6 form-group" >
                          <b>Selecciona archivo o Arrastralo aquí</b>
                      <input class="form-control" type="file" id="estudio_sbr" name="estudio_sbr"  />
                          <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                          <input type="hidden" value="<?= $paciente->clave_bancaria ?>" name="expediente" />
                      </div>
                </div>
              </div>
                   
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
              </div>
                    
             </form> 
            </div>
          </div>
        </div> 
    <!-- Cierra Modal Agregar Estudio -->    
        
<!-- Modal Agregar Cita -->
<div class="modal fade" id="nuevacita" tabindex="-1" role="dialog" aria-labelledby="citaTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
         <div class="modal-header">
                <h5 class="modal-title" id="estudioTitle">Agregar Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                 <form id="nueva-cita" name="nueva-cita" method="post" >
                    <div class="modal-body" >
                    <div class="form-group col-sm-4">
                                <label>
                                    Sucursal
                                </label>

                                <select id="id_calendario" name="id_calendario" class="form-control" required >

                                    <option value="" >Seleccione una opción</option>
                                    <?php foreach ($sucursales->result() as $sucursal): ?>
                                    <option value="<?= $sucursal->id_calendario ?>"><?= $sucursal->razon_social ?></option>
                                    <?php endforeach ?>


                                </select>

                            </div>

                        <div class="form-group col-sm-4">
                            <label>
                                Cita Para:
                            </label>

                            <input class="form-control" id="title_cita" name="title_cita" value="<?= $paciente->nombre ?> <?= $paciente->apellido_p ?> <?= $paciente->telefono_a ?> " />
                        </div>

                        <div class="form-group col-sm-4">
                            <label>
                                Fecha: (dia - hora)
                            </label>
                            <input required type="datetime-local" name="fecha_cita" id="fecha_cita" min="<?php echo  date('Y-m-d\TH:i'); ?>"  value="<?php echo date("Y-m-d\TH:i");?>" class="form-control" >
                        </div>
                    </div>
        
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Agendar</button>
                  </div>
                </form> 
             </div>
          </div>
        </div> 
    <!-- Cierra Modal Agregar cita -->
        
     <div class="panel panel-brown" style="border-radius:15px" >
        
        <div class="panel-heading text-center" data-toggle="collapse" href="#collapseHistoria" role="button" aria-expanded="false" aria-controls="collapseLinea" style="border-radius:15px"  >
            <h3>ANTECEDENTES</h3>
            
        </div>
    <div class="collapse" id="collapseHistoria" >
            <div class="panel-body" >
                
                <div class="col-sm-4 text-center" >
                    <button class="btn btn-sm btn-primary " data="1" id="btn-heredo" >Heredofamiliares</button>
                </div>
                <div class="col-sm-4 text-center" >
                    <button class="btn btn-sm btn-primary" data="1" id="btn-pato" >Patológicos</button>
                </div>
                <div class="col-sm-4 text-center" >
                    <button class="btn btn-sm btn-primary" data="1" id="btn-npato" >No Patológicos</button>
                </div>
                
            </div>
         </div>
    </div>
        
    <div class="panel panel-default" id="p-heredo"  hidden >
        <div class="panel-body" >
        </div>
    </div> 
        
        <div class="panel panel-default" id="p-pato"  hidden >
        <div class="panel-body" >
        </div>
    </div>
        
    <div class="panel panel-default" id="p-npato"  hidden  >
        <div class="panel-body" >
                <div class="col-sm-12" >
                <div class="container" >
                    <div class="row" >
                         <div class="col-sm-12" >
                             <div class="col-sm-12 text-center" >
                                 <div class="" id="nombre_c" ></div>
                                 <div id="loader" hidden ><img loading="lazy" height="50px" width="50px"   src="<?php echo $img_load ?>loader.gif" alt="" class="img-responsive center-block"  /> </div>
                             </div>
                             
                            <div class="col-sm-2" id="c_a" >
                                <div class="text-center"><b>A</b></div>
                                <div id="clas_a"></div>
                            </div>
                             
                             <div class="col-sm-2" id="c_b" hidden >
                                <div class="text-center"><b>B</b></div>
                                <div id="clas_b"></div>
                            </div>

                            <div class="col-sm-2" id="c_c" hidden >
                                <div class="text-center"><b>C</b></div>
                                <div id="clas_c"></div>
                            </div>
                             <div class="col-sm-2" id="c_d" hidden >
                                <div class="text-center"><b>D</b></div>
                                <div id="clas_d"></div>
                            </div> 
                            <div class="col-sm-2" id="c_e" hidden >
                                <div class="text-center"><b>E</b></div>
                                <div id="clas_e"></div>
                            </div>
                            <div class="col-sm-2" id="c_f" hidden >
                                <div class="text-center"><b>F</b></div>
                                <div id="clas_f"></div>
                            </div>
                             <div class="col-sm-2" id="c_g" hidden >
                                <div class="text-center"><b>G</b></div>
                                <div id="clas_g"></div>
                            </div>
                             <div class="col-sm-2" id="c_h" hidden >
                                <div class="text-center"><b>H</b></div>
                                <div id="clas_h"></div>
                            </div>
                            <div class="col-sm-2" id="c_v" hidden >
                                <div class="text-center"><b>Veneno</b></div>
                                <div style="height:250px; overflow: scroll; overflow-x: hidden; " >
                                <div id="clas_v"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    
            <!-- Modal Agregar Veneno -->
            <div class="modal fade" id="modal_new_veneno" tabindex="-1" role="dialog" aria-labelledby="estudiosTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="">Agregar nuevo Veneno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                <form method="post" id="form_new_veneno" name="form_new_veneno"  enctype="multipart/form-data" >
                    <div class="modal-body">
                        <div class="row" >
                            <input  type="hidden"  value="" id="id_veneno" name="id_veneno" />
                              <div class="col-sm-6 form-group" >
                              <b>Frecuencia</b>
                                 <select required id="frecc" name="frecc" class="form-control"  ><option value="" >Seleccione:</option>
                                     <option value="1" >Frec 1</option>
                                     <option value="2" >Frec 2</option>
                                     <option value="3" >Frec 3</option>
                                     <option value="4" >Frec 4</option>
                                     <option value="5" >Frec 5</option>
                                  </select>
                              </div>
                            <div class="col-sm-6" >
                            <b>Edad</b>
                            <input id="edad_veneno" required type="number" name="edad_veneno" class="form-control" value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" />
                            </div>
                        </div>
                      </div>
            
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button onclick="save_new_veneno('<?= $fecha ?>','<?= $paciente->id ?>')" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                      </div>

                     </form> 
                    </div>
                  </div>
                </div> 
            <!-- Cierra Modal Agregar Veneno --> 
                   
                    <div class="p-menu"  >
                        <div class="row" >
                        
                        <div class="col-sm-6" ><button class="btn btn-sm btn-info" id="btn-micro" >Microbios</button></div>
                        <div class="col-sm-6" ><button class="btn btn-sm btn-info" id="btn-venenos" >Venenos</button></div>
                        <div class="col-sm-6" ><button class="btn btn-sm btn-info" id="btn-radiaciones" >Radiaciones</button></div>
                        <div class="col-sm-6" ><button class="btn btn-sm btn-info" id="btn-metales" >Metales</button></div>
                        </div>
                        
                    </div>
                </div>
        </div>
    </div>
        
    <div id="linea_vida_section" ></div>
    <!-- Inicia Linea de Vida -->
    <div class="panel panel-olive" style="border-radius:15px" >
        
        <div class="panel-heading text-center" data-toggle="collapse" href="#collapseLinea" role="button" aria-expanded="false" aria-controls="collapseLinea" style="border-radius:15px"  >
            <h3>LINEA DE VIDA</h3>
            
        </div>
        <div class="collapse" id="collapseLinea" >
        <div class="panel-body" >
            <button type="button" class="btn btn-info btndivLinea"  onclick="recargarLinea()" style="margin-top:10px"><i class="glyphicon glyphicon-refresh"></i>     Recargar Linea</button>
            
            <div id="divLinea" class="col-sm-12 text-center comment-scrollbar" style="height:500px; overflow: scroll; overflow-x: hidden; ">
        
            <ul class="timeline" id="timeline">
            <?php  $num = 1; ?>
                <?php foreach ( $linea_vida->result() as $linea ): ?>
                
                        <li><?php if ($num%2==0){ ?>      
                     <div class="direction-l"> <?php } else { ?>
                          <div class="direction-r"><?php } $num++; ?>
                              <div class="flag-wrapper">
                                <span class="hexa"></span>
                                <span class="flag"><?= $linea->enfermedad; ?></span>
                                <span class="time-wrapper"><span class="time"><?= $linea->anio; ?> Edad: <?= $linea->edad_paciente; ?></span></span>
                              </div>
                              <div class="desc"><?= $linea->descripcion; ?><a href="#<?= $linea->table_hisclinic; ?>Sec"> <icon class="fa fa-chevron-down"> Ver</icon></a></div>
                            </div>
                          </li>
                            
                        <?php endforeach ?>
                    </ul> 
                        <small>Los elementos de la linea se borran al eliminar un dato de los Antecedentes Patológicos</small>
                    </div>
            </div>
            
             
            
            <div class="row">
                <div class="col-md-6 col-md-offset-3" >
                    
                <h3 class="text-center">Antecedentes HeredoFamiliares</h3>
                    <table  class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>-</th>
                                <th>Padecimiento</th>
                                <th>Familiar</th>

                            </tr>
                        </thead>
                        <tbody id="info-carga_heredo">
                             <?php foreach ( $carga_heredo->result() as $ahf ): ?>
                            <tr id="fila_ahf<?= $ahf->id ?>" >
                                <td>-</td>
                                <td><?= $ahf->enfermedad ?></td>
                                <td><?= $ahf->familiar  ?></td>

                            </tr> 
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12" >
                 <div class="col-sm-3 pull-right" >
                            <div data-toggle="collapse" href="#collapseLinea" role="button" aria-expanded="false" style="background: #f0ad4e; color:#F6F8FA; border-radius: 15px;"  aria-controls="collapseLinea" class="text-center" >
                            Cerrar Panel
                            </div> 
                    </div> 
                </div>
               
            </div>
                
                    
        </div>
    </div>
    <!-- Cierra Linea de Vida -->
    
    <!-- Antecedentes HeredoFamiliares -->
    <div class="panel panel-brown" style="border-radius:15px">
        
        <div class="panel-heading text-center" data-toggle="collapse" href="#collapseHeredo" role="button" aria-expanded="false" aria-controls="collapseHeredo" style="border-radius:15px" >
        <h3>ANTECEDENTES HEREDOFAMILIARES</h3> 
        </div>
    
        <div class="collapse" id="collapseHeredo" >
                <div class="panel-body">
                
                    <div class="panel panel-default border-left-brown" >
                    
                    <div class="panel-heading" >      
                    <span class="ms-subtitle" ><label>Añadir Carga Hereditaria</label></span>
                    </div>  
                    
                    <div class="panel-body">
                        <form id="carga_heredo_in" name="carga_heredo_in" method="post" >
                            
                                <div class="col-sm-5" >

                                 <b>Padecimiento</b>

                                     <input id="padecimiento" name="padecimiento" type="text" class="form-control"  />

                                </div>
                                <div class="col-sm-1" >
                                    <b class="text-center" >Ver</b>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAutoinmune">
                                  <i class="fa fa-file-text-o"></i> 
                                </button>
                                </div>

                            <div class="col-sm-5" >

                                 <b>Familiar </b>
                                <select id="familiar_heredo" name="familiar_heredo" class="form-control" >
                                        <option value="No seleccionado" >Seleccione</option>
                                        <?php foreach ( $familiar->result() as $familia ): ?>
                                        <option value="<?= $familia->familiar ?>" ><?= $familia->familiar ?></option>
                                        <?php endforeach ?>
                                </select>

                            </div>
                            <div class="col-sm-1" >
                                <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                            <b>Agregar</b>
                                <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i><br></button>
                            </div>
                        
                        </form>
                     </div>     
                    </div>
                    
                      <!--- Inicia Enfermedades Congénitas -->
           
       
            <section id="Enfermedad_CongenitaSec"></section>
            <div class="panel panel-default border-left-brown" >
                    
            <div class="panel-heading" >      
            <span class="ms-subtitle" ><label>Añadir Enfermedad Congénita</label></span>
            </div>  
            <div class="panel-body" >
            <form id="new_enf_cong" name="new_enf_cong" method="post" class="form-group" >
            <div class="row">
            <div class="col-sm-4">
            <b> Enfermedad </b>
              <select id="enfermedad" class="form-control" name="enfermedad" >
                <option>Seleccione</option>
                <?php foreach ( $enfermedades->result() as $enfCong ): ?>

                <option value="<?= $enfCong->enfermedad  ?>"> <?= $enfCong->enfermedad  ?></option>
                <?php endforeach ?>
                  
                  <option value="Otra" >Otra</option>
                </select>
                <div class="" id="panel-add-ec" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="2" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>

                 </div>
                
                <b>Medicamento</b>
                 <select id="medicamento" class="form-control" name="medicamento">
                    <option value="" >Seleccione</option>
                     <?php foreach ( $medicamentos->result() as $medicamento ): ?>
                    <option value="<?= $medicamento->medicamento ?>" ><?= $medicamento->medicamento ?></option>
                   <?php endforeach ?>
                     <option value="Otra" >Otro</option>
                </select>
                 <div class="" id="panel-add-med" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>

                 </div>
                </div>
                <div class="form-group col-sm-4">
                <b>Manejo</b>

                <textarea id="manejo" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20" rows="4" ></textarea> 
                </div>

                
                <div class="col-sm-3" >
                    <b>Edad</b>
                    <input id="edad_cong" required type="number" name="edad_cong" class="form-control" value="0" min="0" max="<?= $fechaMax ?>" /><br>
                   <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                    <input type="hidden" value="<?= $fecha ?>" name="anio" />
                </div>
                
                <div class="col-sm-1 text-center" >
                    <b>Agregar</b>
                <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i><br></button>
                </div>
                </form>
            </div>
            </div>
            </div>
                
                <!-- Termina Enfermedades Congénitas -->
                    <div class="col-sm-3 pull-right" >
                            <div data-toggle="collapse" href="#collapseHeredo" role="button" aria-expanded="false" style="background: #f0ad4e; color:#F6F8FA; border-radius: 15px;"  aria-controls="collapseHeredo" class="text-center" >
                            Cerrar Panel
                            </div> 
                    </div>      
                 
            </div>
        </div>
    </div>
    <!-- Termina Antecedentes HeredoFamiliares -->
    
    <!--- Comienza panel de Antecedentes Patologicos  --->
    
    <div class="panel panel-brown" style="border-radius:15px">
        
        <div class="panel-heading text-center" data-toggle="collapse" href="#collapsePato" role="button" aria-expanded="false" aria-controls="collapsePato" style="border-radius:15px" >
        <h3>ANTECEDENTES PATOLÓGICOS</h3> 
        </div>
        <div class="collapse" id="collapsePato" >
            
                
          <section id="VacunaSec" ></section>  
            <div class="panel-body" >
                <h3 class="text-center">INMUNIZACIONES</h3>
             <div class="panel panel-default border-left-brown" >
                    
                    <div class="panel-heading" >      
                    <span class="ms-subtitle" ><label>Añadir Vacunas</label></span>
                    </div>  
                 <div class="panel-body"  >
             <form id="form_vacuna" name="vacuna" method="post">
                 
                <div class="col-sm-4" >
                 <b>Vacuna</b>
                 <select id="vacuna" class="form-control" name="vacuna">
                    <option value="" >Selecciona</option>
                      <?php foreach ( $vacunas->result() as $vacuna ): ?>
                    <option value="<?= $vacuna->vacuna ?>" ><?= $vacuna->vacuna ?></option>
                    <?php endforeach ?>
                     <option value="Otra" >Otra</option>
                    </select>
                    <div class="" id="panel-add-v" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="4" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>

                    </div>
                 </div>
                 
                 <div class="form-group col-sm-4">
                <b>Descripcion</b>

                <textarea id="descripcion_vac" name="descripcion_vac" class="form-control" placeholder="Escribe aquí" cols="20" rows="2" ></textarea> 
                </div>
                 
                 <div class="col-sm-3" >
                 <b>Edad</b>
                <input id="edad_vacuna" required class="form-control" min="0" value="0" max="<?= $fechaMax ?>" name="edad" type="number" /> 
                 <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                <input type="hidden" value="<?= $fecha ?>" name="anio" />
                </div>
                 
                 <div class="col-sm-1 text-center" >
                     <b>Agregar</b>
                 <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i><br></button>
                    </div>
             </form>   
                </div> 
            </div>   
            </div>
           
            <section id="AlergiaSec"></section>
            <div class="panel-body">  
           
            <div class="panel panel-default border-left-brown" >
                    
                    <div class="panel-heading" >      
                    <span class="ms-subtitle" ><label>Añadir Alergía</label></span>
                    </div>  
            
            <div class="panel-body" >
                
            <form id="alergia" name="alergia" method="post" class="panel-body">
            
            <div class="col-sm-5" >
                 <b>Alergeno</b>
                     <select id="alergeno" class="form-control" name="alergeno" required >
                    <option value="">Selecciona</option>
                    <?php foreach ( $alergenos->result() as $alergeno ): ?>
                    <option value="<?= $alergeno->id ?>" ><?= $alergeno->alergeno ?></option>
                    <?php endforeach ?>
                    <option value="Otra">Otra</option>
                    </select>
                <div id="panel-add-ma" ></div>
                <div id="panel-add-a" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="5" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                </div>
                
                
            </div>
            
           <div class="col-sm-5" >
            <b>Tratamiento</b>
                    <select id="tratamiento_ale" class="form-control" name="tratamiento" required><option value="">Selecione</option>
                        <?php foreach ( $tratamiento->result() as $tratamiento ): ?>
                            <option value="<?= $tratamiento->tratamiento_alergia ?>" ><?= $tratamiento->tratamiento_alergia ?></option>
                            <?php endforeach ?>
                        <option value="Otro" >Otro</option>
                    </select>
                <div id="panel-add-a-trat" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="6" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                </div>    
            </div>
               
            <div class="col-sm-2" >  
            
            <b>Edad</b>    
                <input id="edad_ale" required name="edad_alergia" type="number" class="form-control" min="0" value="0" max="<?= $fechaMax ?>"  />
            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" required />
            <input type="hidden" value="<?= $fecha ?>" name="anio" required />
                
            <b>Agregar</b><br>
            <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i><br></button>
            </div>  

                
                </form>
                </div>
             </div>   
            </div> 
            <section id="HospitalizacionSec"></section>
            <div class="panel-body">
            
            <div class="panel panel-default border-left-brown" >
                    
            <div class="panel-heading" >      
            <span class="ms-subtitle" ><label>Añadir Hospitalización</label></span>
            </div>  
             <div class="panel-body" >
             <form id="hospitalizacion" name="hospitalizacion" method="post" >
                <div class="row" >
                
                <div class="col-sm-12" > 
                    
                    <div class="row">
                        
                <div class="form-group col-sm-4" >

                     <b>Causa</b>

                    <select id="causa_h" required name="causa" class="form-control">
                    <option  value="">Seleccione</option>
                    <?php foreach ( $causas->result() as $causa ): ?>
                            <option value="<?= $causa->causa ?>" ><?= $causa->causa ?></option>
                           <?php endforeach ?>
                        <option value="Otra">Otra</option>
                    </select>
                <div id="panel-add-causa_h" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="7" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                </div>
                      <b>Medicamentos</b>   
                    <select id="med_h" class="form-control" name="medicamentos">
                        <option value="">Seleccione</option>
                         <?php foreach ( $medicamentos->result() as $medicamento ): ?>

                        <option value="<?= $medicamento->medicamento ?>" ><?= $medicamento->medicamento ?></option>
                       <?php endforeach ?>
                        <option value="Otra" >Otra</option>
                    </select>
                    <div id="panel-add-med_h" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                </div>
                </div>
                    
                <div class="form-group col-sm-4" >
                       <b>Manejo</b>
                 <textarea id="manejo_h" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20" rows="4" ></textarea>
                </div>
                    
                <div class="form-group col-sm-4" >
                     <b>Edad</b> 
                  <input id="edad_h" required type="number" min="0" class="form-control" name="edad_hospi" max="<?= $fechaMax ?>" value="0" />
                <input type="hidden" value="<?= $fecha ?>" name="anio" />

                </div>
                    
                    </div>
                    
                    <div class="row" >
                        
                        <div class="col-sm-4" >
                           <div class="panel panel-info">
                             <div class="panel-heading" >Operación</div>
                                <div class="panel-body" >
                            <div class="form-group col-sm-12" >
                        <label>Si<input class="form-control" data-toggle="collapse" data-target="#operacion" aria-expanded="false" aria-controls="operacion"  type="radio" name="op" value="Si" /></label>
                        <label>No
                        <input class="form-control" data-toggle="collapse" data-target="#operacion" aria-expanded="false" aria-controls="operacion"  type="radio" name="op" value="No" checked /></label>


                        <div class="collapse" id="operacion" >
                        <div class="card card-body" >
                        <b>Tipo de operación</b>

                            <select id="operacion_h" name="tipo_operacion" class="form-control" >
                            <option value="No">Seleccione</option>    
                            <?php foreach ( $operaciones->result() as $operacion ): ?>
                                    <option value="<?= $operacion->tipo_operacion ?>" ><?= $operacion->tipo_operacion ?></option>
                                   <?php endforeach ?>
                                 <option value="Otra" >Otra</option>
                            </select>
                             <div id="panel-add-ope" hidden >
                                <br>
                                <a href="#" class="btn btn-sm btn-info" data-id="8" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                            </div>
                            </div>
                        </div>  

                        </div>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="col-sm-4" >
                           <div class="panel panel-info">
                             <div class="panel-heading" >Anestesia</div>
                                <div class="panel-body" >
                            <div class="form-group col-sm-12" >

                            <label>Si<input class="form-control" data-toggle="collapse" data-target="#anestesia" aria-expanded="false" aria-controls="anestesia" type="radio" name="ane" value="Si" /></label>

                            <label>No<input class="form-control" data-toggle="collapse" data-target="#anestesia" aria-expanded="false" aria-controls="anestesia"  type="radio" name="ane" value="No" checked /></label>

                                <div class="collapse" id="anestesia" >
                                    <div class="card card-body" >
                                         <b>Tipo de anestesia</b>
                                    <select id="tipo_ane" name="tipo_anestesia" class="form-control" >
                                    <option value="No">Seleccione</option>    
                                    <?php foreach ( $anestesias->result() as $anestesia ): ?>
                                                <option value="<?= $anestesia->tipo_anestesia ?>" ><?= $anestesia->tipo_anestesia ?></option>
                                               <?php endforeach ?>
                                         <option value="Otra" >Otra</option>
                                        </select>
                                        <div id="panel-add-ane" hidden >
                                            <br>
                                            <a href="#" class="btn btn-sm btn-info" data-id="9" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4" >
                           <div class="panel panel-info">
                             <div class="panel-heading" >Transfusión</div>
                                <div class="panel-body" >
                                    <div class="form-group col-sm-12" >


                            <label>Si<input class="form-control" data-toggle="collapse" data-target="#transfusion" aria-expanded="false" aria-controls="transfusion"  type="radio" name="tran" value="Si" /></label>
                            <label>No<input class="form-control" data-toggle="collapse" data-target="#transfusion" aria-expanded="false" aria-controls="transfusion"  type="radio" name="tran" value="No" checked /></label>

                            <div class="collapse" id="transfusion" >
                                <div class="card card-body" >
                                      <b>Tipo de transfusión</b>
                                    <select id="tipo_trans" name="tipo_transfusion" class="form-control" >
                                     <option value="No">Seleccione</option>    
                                    <?php foreach ( $transfusiones->result() as $transfusion ): ?>
                                            <option value="<?= $transfusion->tipo_transfusion ?>" ><?= $transfusion->tipo_transfusion ?></option>
                                           <?php endforeach ?>
                                         <option value="Otra" >Otra</option>
                                    </select>
                                    <div id="panel-add-trans" hidden >
                                            <br>
                                            <a href="#" class="btn btn-sm btn-info" data-id="10" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                                    </div>
                                </div>
                                </div>    
                            </div>     
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6" >
                           <div class="panel panel-info">
                             <div class="panel-heading" >Prótesis | Implantes | Amalgamas</div>
                                <div class="panel-body" >
                            <div class="form-group col-sm-12" >

                            <label>Si<input class="form-control" data-toggle="collapse" data-target="#protesis" aria-expanded="false" aria-controls="protesis" type="radio" name="pro" value="Si" /></label>
                            <label>No<input class="form-control" data-toggle="collapse" data-target="#protesis" aria-expanded="false" aria-controls="protesis" type="radio" name="pro" value="No" checked /></label>

                            <div class="collapse" id="protesis" >
                               <div class="card card-body" >
                                 <b>Tipo prótesis</b>
                                    <select id="tipo_prot" name="tipo_protesis" class="form-control" >
                                    <option value="No">Seleccione</option>    
                                    <?php foreach ( $protesiss->result() as $protesis ): ?>
                                            <option value="<?= $protesis->tipo_protesis ?>" ><?= $protesis->tipo_protesis ?></option>
                                           <?php endforeach ?>
                                         <option value="Otra" >Otra</option>
                                    </select>
                                    <div id="panel-add-prot" hidden >
                                            <br>
                                            <a href="#" class="btn btn-sm btn-info" data-id="11" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                                    </div>
                                </div>
                               </div>   
                            </div>
                               </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6" >
                           <div class="panel panel-info">
                             <div class="panel-heading" >Complicación</div>
                                <div class="panel-body" >
                            <div class="form-group col-sm-12" >

                            <label>Si<input class="form-control" data-toggle="collapse" data-target="#comp" aria-expanded="false" aria-controls="comp" type="radio" name="com" value="Si" /></label>
                            <label>No<input class="form-control" data-toggle="collapse" data-target="#comp" aria-expanded="false" aria-controls="comp"  type="radio" name="com" value="No" checked /></label>

                            <div class="collapse" id="comp" >
                                <div class="card card-panel" >
                                 <b>Explique</b>
                            <textarea id="comp_h" name="com_explicacion" class="form-control" placeholder="Escribe aquí" cols="20" rows="2" ></textarea> 

                                </div>
                                </div>    
                            </div>
                               </div>
                            </div>
                        </div>
                    </div> 
                    
                    
                  </div>    
                </div>
                    <div class="form-group col-sm-12 text-center" >
                        <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                    
                      <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i><br></button> 
                    </div>

                    </form>   
                </div>   
            </div>       

            </div>
                
            <h3 class="text-center">ENFERMEDADES INFECTOCONTAGIOSAS</h3>
            <section id="VirusSec"></section>  
            <div class="panel-body">
                    
            <div class="panel panel-default border-left-brown" >
                    
                    <div class="panel-heading" >      
                    <span class="ms-subtitle" ><label>Añadir Virus</label></span>
                    </div>  
                <div class="panel-body" >
                    
            <form id="enf_infecto_virus" name="enf_infecto_virus" method="post" class="panel-body">
                
                <div class="col-sm-5" >
                    <b>Enfermedad</b>
                    <select required id="enf_virus" class="form-control" name="enfermedad" >
                        <option value="">Seleccione</option>
                        <?php foreach ( $infectos->result() as $infecto ): ?>

                        <option value="<?= $infecto->id  ?>"> <?= $infecto->enfermedad  ?></option>
                        <?php endforeach ?>
                        
                        <option value="Otra">Otra</option>
                        </select>
                    <div id="panel-add-vi" hidden >
                            <br>
                            <a href="#" class="btn btn-sm btn-info" data-id="12" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                    </div>
                    <b>Medicamentos</b>   
                    <select required id="med_virus" class="form-control" name="medicamentos">
                    <option value="">Seleccione</option>
                     <?php foreach ( $medicamentos->result() as $medicamento ): ?>

                    <option value="<?= $medicamento->id ?>" ><?= $medicamento->medicamento ?></option>
                   <?php endforeach ?>
                        <option value="No Recuerda" >No Recuerda</option>
                        <option value="Otro" >Otro</option>
                    </select>
                     <div id="panel-add-med_virus" hidden >
                            <br>
                            <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                    </div>
                    
                </div>
                <div class="col-sm-5" >
                    <b>Manejo</b>
                    <textarea required id="manejo_virus" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20" rows="4" ></textarea>
                </div>
                <div class="col-sm-2" >
                    
                    <b>Edad</b>
                    <input id="edad_virus" required name="edad_virus" class="form-control" type="number" min="0" max="<?= $fechaMax ?>" />
                    <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                    <input type="hidden" value="<?= $fecha ?>" name="anio" /><br>
                    <b>Agregar</b>
                    <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i><br></button> 
                </div>
            
            </form>
                
                </div>
            </div>
            <section id="BacteriaSec"></section>
                
            <div class="panel panel-default border-left-brown" >
                    
                    <div class="panel-heading" >      
                    <span class="ms-subtitle" >Añadir Bacterias</span>
                    </div>  
                
                <div class="panel-body" >
            <form id="enf_infecto_bacterias" name="enf_infecto_bacterias" method="post" class="panel-body">
            
            <div class="col-sm-5" >
                <b>Enfermedad</b>
                <select required id="enf_bac" class="form-control" name="enfermedad" >
                        <option value="">Seleccione</option>
                        <?php foreach ( $infectos_bac->result() as $infecto ): ?>

                        <option value="<?= $infecto->id  ?>"> <?= $infecto->enfermedad  ?></option>
                        <?php endforeach ?>
                        
                        <option value="Otra">Otra</option>
                </select>
                 <div id="panel-add-bac" hidden >
                        <br>
                        <a href="#" class="btn btn-sm btn-info" data-id="13" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                    </div>
                 <b>Medicamentos</b>   
                <select required id="med_bac" class="form-control" name="medicamentos">
                    <option value="">Seleccione</option>
                     <?php foreach ( $medicamentos->result() as $medicamento ): ?>

                    <option value="<?= $medicamento->id ?>" ><?= $medicamento->medicamento ?></option>
                   <?php endforeach ?>
                    <option value="No Recuerda" >No Recuerda</option>
                    <option value="Otro" >Otro</option>
                </select>
                <div id="panel-add-med_bac" hidden >
                        <br>
                        <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                  </div>
            </div>  
          
            <div class="col-sm-5" >
                <b>Manejo</b>
                <textarea required id="manejo_bac" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20" rows="4" ></textarea>
                </div>    
                
            <div class="col-sm-2" >  
           
            <b>Edad</b>
                <input id="edad_bac" required name="edad_bacterias" class="form-control" type="number" min="0" max="<?= $fechaMax ?>" /><br>
                <input type="hidden" value="<?= $fecha ?>" name="anio" />
                <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                <b>Agregar</b>
                <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i><br></button> 
            </div>          
            
            </form>
            </div>
            </div>  
            <section id="HongoSec"></section>    
              
             <div class="panel panel-default border-left-brown" >
                    
                    <div class="panel-heading" >      
                    <span class="ms-subtitle" ><label>Añadir Hongos</label></span>
                    </div>  
            <div class="panel-body" >    
            <form id="enf_infecto_hongos" name="enf_infecto_hongos" method="post" class="panel-body">
             
            <div class="col-sm-5" >    
            <b>Enfermedad</b>
            <select required id="enf_hongo" class="form-control" name="enfermedad" >
                <option value="">Seleccione</option>
                <?php foreach ( $infectos_hongos->result() as $infecto ): ?>

                <option value="<?= $infecto->id  ?>"> <?= $infecto->enfermedad  ?></option>
                <?php endforeach ?>

                <option value="Otra">Otra</option>
            </select>
                <div id="panel-add-hongo" hidden >
                        <br>
                        <a href="#" class="btn btn-sm btn-info" data-id="14" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                  </div>
                <b>Medicamentos</b>    
            <select required id="med_hongo" class="form-control" name="medicamentos">
                    <option value="">Seleccione</option>
                     <?php foreach ( $medicamentos->result() as $medicamento ): ?>

                    <option value="<?= $medicamento->id ?>" ><?= $medicamento->medicamento ?></option>
                   <?php endforeach ?>
                <option value="No Recuerda" >No Recuerda</option>
                 <option value="Otro" >Otro</option>
                </select>
                <div id="panel-add-med_ho" hidden >
                        <br>
                        <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                  </div>
            </div>   
                
            <div class="col-sm-5">  
            <b>Manejo</b>
            <textarea required id="manejo_hongo" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20" rows="4" ></textarea>
            </div>
            
            <div class="col-sm-2" >
            <b>Edad</b>
            <input id="edad_hongo" required name="edad_hongos" class="form-control" type="number" min="0" max="<?= $fechaMax ?>" /><br>
                
                 <input type="hidden" value="<?= $fecha ?>" name="anio" />
            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                <b>Agregar</b>
            <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i></button> 
            </div>
            
            </form>
                </div>
             </div>   
            
            <section id="ParásitoSec"></section>
            
            <div class="panel panel-default border-left-brown" >
                    
                    <div class="panel-heading" >      
                    <span class="ms-subtitle" ><label>Añadir Parasitos</label></span>
                    </div> 
                
            <div class="panel-body" >   
            <form id="enf_infecto_parasitos" name="enf_infecto_parasitos" method="post" class="panel-body">
            
            <div class="col-sm-5" >
               <b> Enfermedad</b>
                <select required id="enf_para" class="form-control" name="enfermedad" >
                <option value="">Seleccione</option>
                <?php foreach ( $infectos_parasitos->result() as $infecto ): ?>

                <option value="<?= $infecto->id  ?>"> <?= $infecto->enfermedad  ?></option>
                <?php endforeach ?>

                <option value="Otra">Otra</option>
            </select>
                <div id="panel-add-enf_para" hidden >
                        <br>
                        <a href="#" class="btn btn-sm btn-info" data-id="15" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                  </div>
                <b>Medicamentos</b>    
            <select required id="med_para" class="form-control" name="medicamentos">
                    <option value="">Seleccione</option>
                     <?php foreach ( $medicamentos->result() as $medicamento ): ?>

                    <option value="<?= $medicamento->id ?>" ><?= $medicamento->medicamento ?></option>
                   <?php endforeach ?>
                <option value="No Recuerda" >No Recuerda</option>
                <option value="Otro" >Otro</option>
                </select>
                <div id="panel-add-med_pa" hidden >
                        <br>
                        <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
                  </div>
            </div> 
                
            <div class="col-sm-5" >
                 <b>Manejo</b>
                <textarea required id="manejo_para" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20" rows="4" ></textarea>
                </div>
                
            <div class="col-sm-2" >
            
            <b>Edad</b>
            <input id="edad_para" required name="edad_parasitos" class="form-control" type="number" min="0" max="<?= $fechaMax ?>" /><br>
                
            <input type="hidden" value="<?= $fecha ?>" name="anio" />
            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
            <b>Agregar</b>
            <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i></button>
            </div>
               
            </form>
                </div> 
                
             </div>   
            
                <h3 class="text-center">OTRAS ENFERMEDADES</h3>
            <section id="PsicológicaSec"></section>
              
            <div class="panel panel-default border-left-brown" >
                    
                    <div class="panel-heading" >      
                    <span class="ms-subtitle" ><label>Añadir Psicológicas</label></span>
                    </div> 
            <div class="panel-body" >
                    
            <form id="enf_infecto_psicologicas" name="enf_infecto_psicologicas" method="post" class="panel-body">
            
            <div class="col-sm-5">    
            <b>Enfermedad</b>
            <select id="enf_psico" class="form-control" name="enfermedad"  required>
                <option value="">Seleccione</option>
                <?php foreach ( $infectos_psico->result() as $infecto ): ?>

                <option value="<?= $infecto->id ?>"> <?= $infecto->enfermedad  ?></option>
                <?php endforeach ?>

                <option value="Otra">Otra</option>
            </select>
            <div id="panel-add-psico" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="16" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
              </div>
                <b>Medicamentos</b>    
            <select required id="med_psico" class="form-control" name="medicamentos">
                    <option value="">Seleccione</option>
                     <?php foreach ( $medicamentos->result() as $medicamento ): ?>

                    <option value="<?= $medicamento->id ?>" ><?= $medicamento->medicamento ?></option>
                   <?php endforeach ?>
                <option value="No Recuerda" >No Recuerda</option>
                <option value="Otro" >Otro</option>
                </select>
            <div id="panel-add-med_ps" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
              </div>    
            </div>   
            
            <div class="col-sm-5">    
            <b>Manejo</b>
            <textarea required id="manejo_psico" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20" rows="4" ></textarea>
            </div>
            
            <div class="col-sm-2" >   
            
            <b>Edad</b>
            <input id="edad_psico" required name="edad_psicologica" class="form-control" type="number" min="0" max="<?= $fechaMax ?>" /><br>
                <input type="hidden" value="<?= $fecha ?>" name="anio" />
            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                <b>Agregar</b>
            <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i></button>
            </div> 
              
            </form>
            
            </div>    
            </div>
             <section id="OtraSec"></section>   
               
                
            <div class="panel panel-default border-left-brown" >
                    
            <div class="panel-heading" >      
            <span class="ms-subtitle" ><label>Añadir Otras</label></span>
            </div> 
            <div class="panel-body">    
            <form id="enf_infecto_otras" name="enf_infecto_otras" method="post" class="panel-body">
            
            <div class="col-sm-5" >    
            <b>Enfermedad</b>
            <select id="enf_otras" class="form-control" name="enfermedad" required >
                <option value="">Seleccione</option>
                <?php foreach ( $infectos_otras->result() as $infecto ): ?>

                <option value="<?= $infecto->id  ?>"> <?= $infecto->enfermedad  ?></option>
                <?php endforeach ?>

                <option value="Otra">Otra</option>
            </select>
                <div id="panel-add-otras" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="17" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
              </div>
                <b>Medicamentos</b>   
            <select id="med_otras" class="form-control" name="medicamentos" required>
                    <option value="">Seleccione</option>
                     <?php foreach ( $medicamentos->result() as $medicamento ): ?>

                    <option value="<?= $medicamento->id ?>" ><?= $medicamento->medicamento ?></option>
                   <?php endforeach ?>
                <option value="No Recuerda" >No Recuerda</option>
                <option value="Otro" >Otro</option>
                </select>
                <div id="panel-add-med_otras" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
              </div>
            </div>
            
            <div class="col-sm-5">
               <b>Manejo</b>
                <textarea id="manejo_otras" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20" rows="4" required ></textarea>
            </div>    
            
            <div class="col-sm-2">    
            
            <b>Edad</b>
            <input id="edad_otras" required name="edad_otras" class="form-control" type="number" min="0" max="<?= $fechaMax ?>" /><br>
            <input type="hidden" value="<?= $fecha ?>" name="anio" />
            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                <b>Agregar</b>
            <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i></button>
            </div>    
            </form>
            </div>    
        </div>
            <div class="col-sm-3 pull-right" >
                    <div data-toggle="collapse" href="#collapsePato" role="button" aria-expanded="false" style="background: #f0ad4e; color:#F6F8FA; border-radius: 15px;"  aria-controls="collapsePato" class="text-center" >
                    Cerrar Panel
                    </div> 
            </div> 
    </div>  
    <!--- Termina panel de Antecedentes Patologicos  --->
   
</div>
    </div>

    <!--- Termina panel de Antecedentes Patologicos  --->

    <!-- Antecedentes No Patologicos -->
    <div class="panel panel-olive" style="border-radius:15px" >
        
        <div class="panel-heading text-center" data-toggle="collapse" href="#collapseVenenos" role="button" aria-expanded="false" aria-controls="collapseVenenos" style="border-radius:15px" >
            <h3>ANTECEDENTES NO PATOLÓGICOS</h3>
        </div>
        
        <div class="collapse" id="collapseVenenos" >
        <div class="panel-body" >
            <div class="row" >
            <div class="col-sm-6" >
                <div class="panel panel-default  border-left-olive">
                    <div class="panel-heading" ><h3>Microbios</h3></div>
                    <div class="panel-body" >
                        <div class="col-sm-12" >
                             <label>Clasificación:</label>
                            <select class="form-control" id="venenos_m" required >
                                <option value="" >Seleccione:</option>
                                <option value="M" >Microbianos</option>
                                <option value="NM" >No Microbianos</option>
                            </select>
                            <div id="panel_vm" hidden >
                            <label id="name_class_m" ></label>
                            <select class="form-control" id="vm_clas" >
                            </select>
                            </div>
                            <div id="sub_panel_vm" hidden >
                            <label id="sub_name_class_m" ></label>
                            <select class="form-control" id="sub_vm_clas" >
                            </select>
                            </div>
                            <form method="post" id="form_new_ven_m"></form>
                            <label>Edad:</label>
                            <input id="edad_vm" required type="number" name="edad_vm" class="form-control" value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" /><br>
                            <button class="btn btn-sm btn-primary btn-block btn_save_vm" id="" type="button" ><i class="fa fa-save" ></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" >
                
                <div class="panel panel-default  border-left-warning">
                    <div class="panel-heading" ><h3>Venenos propiamente dichos</h3></div>
                    <div class="panel-body" >
                        <div class="col-sm-12" >
                            <label>Clasificación:</label>
                            <select class="form-control" id="venenos_p" required >
                                <option value="" >Seleccione:</option>
                                <option value="B" >Bebidas</option>
                                <option value="DA" >Derivados Animales</option>
                                <option value="FV" >Frutas y Vegetales</option>
                                <option value="A" >Aditivos</option>
                                <option value="E" >Enlatados</option>
                            </select>
                            <div id="panel_vp" hidden >
                            <label id="name_class" ></label>
                            <select class="form-control" id="vp_clas" >
                                <option value="" >Seleccione:</option>
                            </select>
                            </div>
                            <form method="post" id="form_new_ven"></form>
                            <label>Edad:</label>
                            <input id="edad_vp" required type="number" name="edad_veneno_p" class="form-control" value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" /><br>
                            <button class="btn btn-sm btn-primary btn-block btn_save_vp" id="" type="button" ><i class="fa fa-save" ></i> Guardar</button>
                        </div>
                    </div>
                </div>
                
            </div>
            </div>
            <div class="row" >
            <div class="col-sm-6" >
               
                <div class="panel panel-default  border-left-primary">
                    <div class="panel-heading" > <h3>Radiaciones</h3></div>
                    <div class="panel-body" >
                        <div class="col-sm-12" >
                            <label>Clasificación:</label>
                            <select class="form-control" id="venenos_r" required >
                                <option value="" >Seleccione:</option>
                                <option value="I" >Ionizantes</option>
                                <option value="NI" >No Ionizantes</option>
                            </select>
                            <div id="panel_vr" hidden >
                            <label id="name_class_r" ></label>
                            <select class="form-control" id="vr_clas" >
                            </select>
                            </div>
                            <div id="sub_panel_vr" hidden >
                            <label id="sub_name_class_r" ></label>
                            <select class="form-control" id="sub_vr_clas" >
                            </select>
                            </div>
                            <form method="post" id="form_new_ven_r"></form>
                            <label>Edad:</label>
                            <input id="edad_vr" required type="number" name="edad_vr" class="form-control" value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" /><br>
                            <button class="btn btn-sm btn-primary btn-block btn_save_vr" id="" type="button" ><i class="fa fa-save" ></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" >
               
                <div class="panel panel-default  border-left-brown">
                    <div class="panel-heading" ><h3>Metales Pesados</h3></div>
                    <div class="panel-body" >
                        <div class="col-sm-12" >
                            <label>Clasificación:</label>
                            <select class="form-control" id="venenos_mp" required >
                                <option value="" >Seleccione:</option>
                                <option value="MP" >Metales Pesados</option>
                            </select>
                            <div id="panel_vmp" hidden >
                            <label id="name_class_mp" ></label>
                            <select class="form-control" id="vmp_clas" >
                            </select>
                            </div>
                            <form method="post" id="form_new_ven_mp"></form>
                            <label>Edad:</label>
                            <input id="edad_vmp" required type="number" name="edad_vmp" class="form-control" value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" /><br>
                            <button class="btn btn-sm btn-primary btn-block btn_save_vmp" id="" type="button" ><i class="fa fa-save" ></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
  
        <div class="col-sm-3 pull-right" >
                            <div data-toggle="collapse" href="#collapseVenenos" role="button" aria-expanded="false" style="background: #f0ad4e; color:#F6F8FA; border-radius: 15px;"  aria-controls="collapseVenenos" class="text-center" >
                            Cerrar Panel
                            </div> 
                    </div> 
        </div>
        </div>
    </div>

    <!--- Termina Antecedentes No Patologicos -->
    
    <?php if ($paciente->sexo == "Femenino"){ ?>
    <!--- Empieza panel Mujeres -->
    <div class="panel panel-pink" style="border-radius:15px" >
        
        <div class="panel-heading text-center" data-toggle="collapse" href="#collapseGineco" role="button" aria-expanded="false" aria-controls="collapseGineco" style="border-radius:15px"  >
            <h3>ANTECEDENTES GINECO-OBSTETRICOS</h3>
            
        </div>
        <div class="collapse" id="collapseGineco" >
        <div class="panel-body" >
            En construcción...
        </div>
        </div>
    </div>
    
    <!--- Termina panel Mujeres -->
    <?php } ?>
    </div>

    <!--- Termina Accion de primera vez  ---> 
    <?php }  ?>

<!-- Modal para añadir carga hereditaria  -->
<div class="modal fade" id="modalAutoinmune" tabindex="-1" role="dialog" aria-labelledby="modalAutoinmuneT" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAutoinmuneT">Lista de Enfermedades Autoinmunes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <div id="accordion">
                    <div class="card">
                            <div class="card-header" id="headingOne">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                 <i class="fa fa-plus "></i> Trastornos hematológicos asociados con autoinmunidad.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                                <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 1) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingTwo">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                 <i class="fa fa-plus "></i> Manifestaciones hematologicas secundarias de las enfermedades autoinmunitarias.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                                <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 2) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)" ><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>

                                               <?php endforeach ?>
                                     </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingThree">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                 <i class="fa fa-plus "></i> Autoinmunidad del tracto gastrointestinal.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 3) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingAutoCor">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseAutoCor" aria-expanded="false" aria-controls="collapseAutoCor">
                                 <i class="fa fa-plus "></i> Autoinmunidad y corazón.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseAutoCor" class="collapse" aria-labelledby="headingAutoCor" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 4) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingNeu">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseNeu" aria-expanded="false" aria-controls="collapseNeu">
                                 <i class="fa fa-plus "></i> Neumopatias mediadas inmunologicamente.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseNeu" class="collapse" aria-labelledby="headingNeu" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 5) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingRen">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseRen" aria-expanded="false" aria-controls="collapseRen">
                                 <i class="fa fa-plus "></i> Autoinmunidad renal.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseRen" class="collapse" aria-labelledby="headingRen" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 6) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingSisN">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseSisN" aria-expanded="false" aria-controls="collapseSisN">
                                 <i class="fa fa-plus "></i> Enfermedades autoinmunitarias del sistema nervioso.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseSisN" class="collapse" aria-labelledby="headingSisN" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 7) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingEndo">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseEndo" aria-expanded="false" aria-controls="collapseEndo">
                                 <i class="fa fa-plus "></i> Trastornos endocrinos autoinmunitarios.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseEndo" class="collapse" aria-labelledby="headingEndo" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 8) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div> 
                    <div class="card">
                            <div class="card-header" id="headingPiel">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapsePiel" aria-expanded="false" aria-controls="collapsePiel">
                                 <i class="fa fa-plus "></i> Enfermedades autoinmunitarias de la piel.
                                </button>
                              </h5>
                            </div>
                            <div id="collapsePiel" class="collapse" aria-labelledby="headingPiel" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 9) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingMusc">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseMusc" aria-expanded="false" aria-controls="collapseMusc">
                                 <i class="fa fa-plus "></i> Enfermedades musculares.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseMusc" class="collapse" aria-labelledby="headingMusc" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 10) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingApaR">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseApaR" aria-expanded="false" aria-controls="collapseApaR">
                                 <i class="fa fa-plus "></i> Autoinmunidad del aparato reproductor.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseApaR" class="collapse" aria-labelledby="headingApaR" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 11) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingOtorri">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseOtorri" aria-expanded="false" aria-controls="collapseOtorri">
                                 <i class="fa fa-plus "></i> Trastornos autoinmunitarios en otorrinolaringologia.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseOtorri" class="collapse" aria-labelledby="headingOtorri" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 12) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div> 
                    <div class="card">
                            <div class="card-header" id="headingOcular">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseOcular" aria-expanded="false" aria-controls="collapseOcular">
                                 <i class="fa fa-plus "></i> Autoinmunidad ocular.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseOcular" class="collapse" aria-labelledby="headingOcular" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 13) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingSistem">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseSistem" aria-expanded="false" aria-controls="collapseSistem">
                                 <i class="fa fa-plus "></i> Enfermedades sitemicas autoinmunitarias.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseSistem" class="collapse" aria-labelledby="headingSistem" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 14) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingAfecO">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseAfecO" aria-expanded="false" aria-controls="collapseAfecO">
                                 <i class="fa fa-plus "></i> Otras enfermedades autoinmunitarias con afectación ocular.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseAfecO" class="collapse" aria-labelledby="headingAfecO" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 15) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingSilic">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseSilic" aria-expanded="false" aria-controls="collapseSilic">
                                 <i class="fa fa-plus "></i> Enfermedades asociadas a los implantes de silicona.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseSilic" class="collapse" aria-labelledby="headingSilic" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 16) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingAtipi">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseAtipi" aria-expanded="false" aria-controls="collapseAtipi">
                                 <i class="fa fa-plus "></i> Enfermedad del tejido conjuntivo atípica o indiferenciada.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseAtipi" class="collapse" aria-labelledby="headingAtipi" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 17) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                    <div class="card">
                            <div class="card-header" id="headingInfecA">
                              <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseInfecA" aria-expanded="false" aria-controls="collapseInfecA">
                                 <i class="fa fa-plus "></i> Enfermedades asociadas a problemas infecciosos autoinmunes y crónico degenerativas.
                                </button>
                              </h5>
                            </div>
                            <div id="collapseInfecA" class="collapse" aria-labelledby="headingInfecA" data-parent="#accordion">
                              <div class="card-body">
                                  <ul>
                                     <?php foreach ( $autoinmune->result() as $auto ): ?>
                                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 18) {
                                                    ?>
                                                <li><a data-value="<?= $auto->enfermedad ?>" role="button" onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                                 <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                              </div>
                            </div>
                          </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!--- Cierra Modal -->
<a href="#linea_vida_section" role="button" class="btn btn-teal btn-save" ><i class="glyphicon glyphicon-chevron-up fa-2x"></i><br>Linea</a>

<button type="button" data="<?php if($conversacion == 0){ echo 0;}else{ echo $gconversacion->id; } ?>" id="btnverMsj" class="btn btn-brown btn-msj" data-toggle="modal" data-target="#addMsj" ><i class="fa fa-inbox fa-2x"></i></button>

<!-- Modal Add Messenger -->
    <div class="modal fade" id="addMsj" tabindex="-1" role="dialog" aria->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensajes</h4>
                </div>
                <div class="modal-body">
                    <div class="row" >
                        <div class="col-sm-12" >
                            <?php if ($conversacion == 0){ ?>
                            <h3 class="text-center" >Aún no has iniciado una conversación.</h3>
                            <input type="hidden" id="typeConver" name="typeConver" value="user" />
                            
                            <button type="button" data="<?= $paciente->id ?>" id="btnConver" class="btn btn-warning btn-block" ><i class="fa fa-play" aria-hidden="true"></i> Iniciar Conversación</button>
                            
                            
                           <?php }else{?>
                            <div id="mensajes" style="height:400px; overflow: scroll; overflow-x: hidden; padding:10px;" >
                                
                            </div>
                             <?php } ?>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <?php if ($conversacion == 0){ ?>
                         <?php }else{?>
                        
                        <form id="addMsj_form" name="addMsj_form" method="post"  >
                            <input type="hidden" name="id_conver" id="id_conver" value="<?= $gconversacion->id ?>" />
                            <input type="hidden" id="typeConver" name="typeConver" value="user" />
                        <div class="col-sm-2" >
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-sm-8" >
                         <input type="text" name="mensaje" id="mensaje" placeholder="Escribe tu mensaje aquí" class="form-control" />
                        </div>
                        <div class="col-sm-2" >
                         <button class="btn btn-md btn-primary" type="submit"  >Enviar <span class="fa fa-paper-plane"></span> </button>
                            
                        </form>
                        </div>
                        <?php  }  ?>
                    </div>
            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal fade -->
<!-- Cierra Modal -->

<!-- Modal Add settings -->
    <div class="modal fade" id="addSet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addSet_form" name="addSet_form" method="post"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Añadir</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row" >
                        <div class="col-sm-1" > 
                        <input class="form-control "  type="text" name="input_id" id="input_id"   /></div>
                   
                    <div class="col-sm-11" >
                        <label>Añade aqui</label>
                    <input class="form-control" id="dato" name="dato"  />
                        </div>
                        
                    </div>
                    

                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                         <button class="btn btn-md btn-primary" type="submit" ><span class="fa fa-save"></span> Guardar</button>    
                    </div>
                </form>
            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal fade -->
<!-- Cierra Modal -->
