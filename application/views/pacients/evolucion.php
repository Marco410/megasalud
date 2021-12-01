<?php 
	$paciente = $paciente->row();
$img_path = base_url('estudios').'/'.$paciente->id."/";
?>
<div class="container" >
<h3 class="ms-title"><b>EVOLUCIÓN</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i><span>Regresar</span></a></h3>
    
    <div class="panel panel-primary" >
        
            <div class="panel-heading text-center" >
            <h2><?= $paciente->nombre . " " . $paciente->apellido_p . " " . $paciente->apellido_m  ?> </h2>
           </div>
        
    <div class="panel-body" >
        <div class="row" >
            <div class="col-sm-12" >
       <?php foreach ( $linea_vida->result() as $linea ): ?>
            <div class="col-sm-3" id="<?= $linea->id ?>" >
                <div class="panel panel-info" >
                    <div class="panel-heading" >
                    <h3 class="panel-title"><?= $linea->enfermedad ?></h3>
                    </div>
                      
                <p class="panel-text text-center">Año: <?= $linea->anio ?></p>  
                <p class="panel-text text-center">Edad: <?= $linea->edad_paciente ?></p>  
                <p class="panel-text text-center"><?= $linea->descripcion ?></p>  
                <div class="panel-footer text-center" >
                    <small >Curación: <?= $linea->curacion ?>%</small>
                    <div class="progress" style="height:10px;">
                        <?php if($linea->curacion < 33){ 
                            $bar = "progress-bar-danger";
                        }else if($linea->curacion > 34 && $linea->curacion < 66 ){ 
                            $bar = "progress-bar-warning";
                        }else if($linea->curacion > 67){
                            $bar = "progress-bar-success";
                        } ?>
                        <div class="progress-bar <?= $bar ?> " role="progressbar" aria-valuenow="<?= $linea->curacion ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $linea->curacion ?>%">
                        </div>
                </div>
                    <a class="btn btn-sm btn-primary btn-block btn-registrar" href="<?= base_url().'pacientes/registro-evolucion/'.$linea->id."?p=".$paciente->id ?>" data-id="<?= $linea->id ?>" data-edad="<?= $linea->edad_paciente ?>" >Registrar Evolución</a>
                </div>
                </div>
            </div>
        <?php endforeach ?> 
            </div>
        </div>
    
        </div>
       </div> 
        
        
       
        
 </div>
</div>