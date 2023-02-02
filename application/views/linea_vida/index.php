<?php 
	$paciente = $paciente->row();
$img_path = base_url('estudios').'/'.$paciente->id."/";
?>
<div class="container" >
<h3 class="ms-title"><b>LINEA DE VIDA - <?= $paciente->nombre . " " . $paciente->apellido_p . " " . $paciente->apellido_m  ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i><span>Regresar</span></a></h3>
<input type="hidden" value="<?= $paciente->id ?>" id="id_paciente" >
<div class=" panel panel-primary" >
    <div class="panel-body">
      <div class="container">
        <div class="row">
          <div class="col-sm-12" style="">
          <?php foreach ( $linea_vida->result() as $linea ): ?>
            <?= $linea->enfermedad; ?>
          <?php endforeach ?>
          </div>
        </div>
      </div>
  </div>
</div>
    
  
</div> 