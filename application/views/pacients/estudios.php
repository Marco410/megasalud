<?php 
	$paciente = $paciente->row();
$img_path = base_url('estudios').'/'.$paciente->id."/";
?>
<div class="container" >
<h3 class="ms-title"><b>ESTUDIOS</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i><span>Regresar</span></a></h3>
    
    <div class="panel panel-primary" >
        
            <div class="panel-heading text-center" >
            <h2><?= $paciente->nombre . " " . $paciente->apellido_p . " " . $paciente->apellido_m  ?> </h2>
           </div>
        
    <div class="panel-body" >
        
        <div class="row" >
            
       <?php foreach ( $estudios->result() as $estudio ): ?>
         <div class="col-sm-3" >
            
            <div class="panel panel-info" >
                
                <div class="panel-heading" >
                 <h3 class="panel-title"><?= $estudio->titulo ?></h3>
                </div>
                
                  <div class="panel-body text-center">
                      <a href="#" data-toggle="modal" data-target="#my<?= $estudio->id ?>">
                       <img  width="160px" height="160px" src="<?= base_url('assets/estudios'). '/' .  $paciente->id . '/' . $estudio->imagen ?>" class="img-responsive img-rounded " alt="estudio">
                      </a>
                      
                      
                <p class="panel-text text-center"><?= $estudio->fecha ?></p>  
                </div>
                
                
                </div>
            </div>
            
    
    <div class="modal fade" id="my<?= $estudio->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        
          <div class="modal-dialog modal-dialog-centered" role="document">
              
              <button type="button" class="close" style="margin-right: 10px" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              
                 <img  width="500px" height="500px" src="<?= base_url('assets/estudios'). '/' .  $paciente->id . '/' . $estudio->imagen ?>" class="img-responsive img-rounded" alt="estudio">
            
          </div>
        </div>
            
        <?php endforeach ?> 
            
            
        </div>
       </div> 
        
        
       
        
 </div>
</div>