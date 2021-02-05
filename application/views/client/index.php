<?php
$cliente = $cliente->row();
?>
<div class="container">
	
		<h3 class="ms-title"><b>BIENVENIDO - <?= $this->session->name . " De " .$this->session->sucursal_name;  ?></b></h3>
	
	
		<div class="panel panel-olive">
            <div class="panel-heading" ><h3>Expediente</h3> </div>
			<div class="panel-body">
                <div class="col-sm-4 text-center" >
                    <a href="<?= base_url().'paciente/pedidos' ?>" class="btn btn-warning btn-lg" ><i class="fa fa-truck" aria-hidden="true"></i> Pedidos</a>
                </div>
                <div class="col-sm-4 text-center" >
                    <a href="<?= base_url().'paciente/estudios' ?>" class="btn btn-info btn-lg" ><i class="fa fa-file-text" aria-hidden="true"></i> Estudios</a>
                </div> 
                <div class="col-sm-4 text-center" >
                    <a href="<?= base_url().'paciente/graficas' ?>" class="btn btn-info btn-lg" ><i class="fa fa-area-chart" aria-hidden="true"></i> Gráficas</a>
                </div>
                
				
			</div>
		</div>
    
       
    <div class="panel panel-primary" >
        <div class="panel-heading text-center" style="border-radius:15px" ><h3>DIAGNOSTICOS</h3></div>
        <div class="panel-body" style="border-radius:15px" >
               
           <div class="form-group col-sm-7" >
              <!--- Estas lineas dejarlas asi  ---> 
               <b>Notas del doctor</b>
                <textarea  rows="8" readonly class="form-control" id="text_notas"><?php foreach ($notas->result() as $nota):?>
(<?= $nota->created_at ?>): 
<?= $nota->nota ?>                
<?php endforeach ?></textarea>
               <!--- Estas lineas dejarlas asi  ---> 
               
           </div>
            <section id="DiagnósticoSec">
            <div class="form-group col-sm-5" >
           
              <!--- Estas lineas dejarlas asi  ---> 
               <b>Diagnóstico</b>
                <textarea  rows="8" readonly class="form-control" id="text_diag"><?php foreach ($diagnosticos->result() as $diag):?>
(<?= $diag->created_at ?>): 
<?= $diag->diagnostico ?>                
<?php endforeach ?></textarea>
               <!--- Estas lineas dejarlas asi  ---> 
              
           </div>
            </section>    
             
        </div>
        
    </div>    
    
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
                    </div>
            </div>
                    
        </div>
    </div>
    
    <!-- Cierra Linea de Vida -->

</div>

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
                            <input type="hidden" id="typeConver" name="typeConver" value="paciente" />
                            
                            <button type="button" data="<?= $cliente->id ?>" id="btnConver" class="btn btn-warning btn-block" ><i class="fa fa-play" aria-hidden="true"></i> Iniciar Conversación</button>
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
                            <input type="hidden" id="typeConver" name="typeConver" value="paciente" />
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

