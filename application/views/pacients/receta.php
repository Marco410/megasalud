<?php 
$paciente = $paciente->row();
$img_path = base_url('assets/images/icons').'/';
?>
<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>RECETAS DE <?= $paciente->nombre ." " . $paciente->apellido_p  ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
		<div class="panel panel-warning">
			<!-- <div class="panel-heading">
				<span class="ms-subtitle">Generales</span>
			</div> -->
			
				<div class="row">
                    <div class="col-sm-12" >
                    <a style="margin:10px;" class="btn btn-teal" href="<?=base_url('/pacientes/historia/') . $paciente->id   ?>" >Regresar a la Consulta</a>
                    </div>
                    <?php foreach ( $recetas->result() as $receta ): ?>
                     <div class="col-sm-12" >

                        <div class="panel panel-info" >

                            <div class="panel-heading" >
                             <h3 class="panel-title"> Receta - <?= $receta->created_at ?></h3>
                            </div>

                              <div class="panel-body">
                                  <div style="width:100%px; height:600px;"  class="form-group col-sm-12" >

                                    <embed height="100%" width="100%" name="embed_content" src="<?php echo base_url($receta->archivo) ?>" type="application/pdf"  />

                                     </div>
                            </div>


                            </div>
                        </div>


                    <?php endforeach ?> 
                    
            </div>
			
		</div>
		
		
	</div>

</div>