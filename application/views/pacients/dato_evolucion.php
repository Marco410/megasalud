<?php 
	$paciente = $paciente->row();
	$dato_linea = $dato_linea_vida->row();
    $img_path = base_url('estudios').'/'.$paciente->id."/";

    function calcular_edad($fecha){
        $fecha_nac = new DateTime(date('Y/m/d',strtotime($fecha))); 
        $fecha_hoy =  new DateTime(date('Y/m/d',time())); 
        $edad = date_diff($fecha_hoy,$fecha_nac); 
        return $edad;
      }
      
      $edad = calcular_edad($paciente->fecha_nacimiento);
      $fechaMax = $edad->format('%Y') ."." . $edad->format('%m');
?>
<div class="container" >
<h3 class="ms-title"><b>REGISTRAR EVOLUCIÓN</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i><span>Regresar</span></a></h3>
    
    <div class="panel panel-primary" >
        
        <div class="panel-heading text-center" >
            <h2><?= $paciente->nombre . " ". $paciente->apellido_p . " " . "'" .  $dato_linea->enfermedad . "'" ?></h2>
        </div>
        
    <div class="panel-body" >
        <div class="row" >
            <div class="col-sm-12 text-center" >
                <h4><?= $dato_linea->descripcion ?></h4>
            </div>
            <div class="col-sm-12 text-center">
                <div class="col-sm-9">
                <small >Curación: <?= $dato_linea->curacion ?>%</small>
                    <div class="progress" style="height:10px;">
                        <?php if($dato_linea->curacion <= 33){ 
                            $bar = "progress-bar-danger";
                        }else if($dato_linea->curacion >= 34 && $dato_linea->curacion <= 66 ){ 
                            $bar = "progress-bar-warning";
                        }else if($dato_linea->curacion >= 67){
                            $bar = "progress-bar-success";
                        } ?>
                        <div id="progress" class="progress-bar <?= $bar ?> " role="progressbar" aria-valuenow="<?= $dato_linea->curacion ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $dato_linea->curacion ?>%">
                        </div>
                </div>
                </div>
                <div class="col-sm-2" >
                    <input type="number" id="curacion_input" class="form-control" min="0" step="5"  max="100" value="<?= $dato_linea->curacion ?>" />
                </div>
                <div class="col-sm-1">
                    
                    <button class="btn btn-sm btn-info" id="btn-save-curacion" type="button" > <i class="fa fa-save" ></i> </button>
                </div>
            </div>
            <div class="col-sm-12" id="panel-evolucion" >
        <?php $i = 1; foreach ( $evolucion->result() as $evol ): ?>
                <div class="col-sm-6" id="<?= $evol->id ?>" >
                    <div class="panel panel-info" >
                        <div class="panel-heading" >
                        <h3 class="panel-title"><?= $i; $i++; ?></h3>
                        </div>
                        <div class="panel-body">
                            <span class="panel-text text-center"><b>Evolución:</b> <?= $evol->evolucion ?></span>  
                        </div>
                        
                    <div class="panel-footer text-center" >
                        <p class="panel-text text-center"><b>Edad:</b> <?= $evol->edad ?></p>  
                        <p class="panel-text text-center"><b>Fecha:</b> <?= $evol->fecha_evolucion ?></p>  
                    </div>
                    </div>
                </div>
            <?php endforeach ?> 
            </div>
            
        </div>
    
        </div>
       </div> 

       <div class="panel panel-olive">
       <div class="panel-heading text-center" >
            <h4>Añadir nueva evolución</h4>
           </div>
           <div class="panel-body">
               <div class="row">
                <div class="col-sm-6 col-sm-offset-3 text-center">
                    <form name="form_evolucion" id="form_evolucion" method="post">
                        <input type="hidden" name="id_paciente" value="<?= $paciente->id ?>">
                        <input type="hidden" name="id_linea" id="id_linea" value="<?= $dato_linea->id ?>">
                        <div class="form-group">
                            <label for="">Descripción:</label>
                            <textarea name="evolucion" id="evolucion" placeholder="Añade la descripción de la evolución" required cols="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Fecha de Evolución</label>
                            <input type="date" name="fecha_evolucion" id="fecha_evolucion" required class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Edad:</label>
                            <input type="number" required name="edad_evol" id="edad_evol" min="1" max="<?= $fechaMax ?>" value="<?= $fechaMax ?>" class="form-control" aria-invalid="true" >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" ><i class="fa fa-plus" ></i> Añadir nueva evolución </button>
                        </div>
                    </form>
                </div>
               </div>
           </div>
       </div>
        
        
       
        
 </div>
</div>