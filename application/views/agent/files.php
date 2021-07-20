<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

$css_path = base_url('assets/css').'/';
$js_path = base_url('assets/js').'/';
$img_load = base_url('assets/images/loader').'/';
$repre = $agent->row();

?>
<head>
    
    <link rel="stylesheet" href="<?php echo $css_path; ?>bootstrap3.3.7/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo $css_path; ?>site.css" />
    <link rel="stylesheet" href="<?php echo $css_path; ?>style.css" />
    <link rel="stylesheet" href="<?php echo $css_path; ?>iziToast.min.css" />
    
    <script type="text/javascript" data-pace-options='{ "ajax": false }' src="<?php echo $js_path; ?>pace.min.js"></script>
    <script src="https://use.fontawesome.com/ded6d5aa91.js"></script>
</head>	
<div class="container">
        
    <div class="col-xs-10 col-xs-offset-1">	
        <h3 class="ms-title"><b>SUBE TUS ARCHIVOS <?= $repre->nombre . " " . $repre->apellido_p . " " . $repre->apellido_m ?> </b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
        
		<div class="col-xs-12">

			<form id="new_files_form" name="new_files_form" class="panel-body no-padding" enctype="multipart/form-data" >
				<div class="panel mb-0 panel-primary panel-flat border-left-primary">
					<div class="panel-heading ">
						<span class="ms-subtitle">GENERAL</span>
					</div>
                    <input type="hidden" name="id_agent" value="<?= $repre->id ?>" />
					<div class="panel-body">
                        <div class="row" >
                            <div class="col-sm-4">
                                <label>Fotografía* </label>
				                <input type="file" required class="form-control" name="foto" accept="image/png,image/jpeg,image/jpg" />           
						    </div>
                            
                             <div class="col-sm-4">
                                <label>Comprobante de Domicilio* </label>
				                <input type="file" required class="form-control" name="domicilio" accept="image/png,image/jpeg,image/jpg" />           
						    </div>
                            
                            <div class="col-sm-4">
                                <label>Constancia de Situación FIscal* <a href="https://www.sat.gob.mx/aplicacion/53027/genera-tu-constancia-de-situacion-fiscal" target="_blank" >Generár aquí</a> </label>
				                <input type="file" required class="form-control" name="c_fiscal" accept="image/png,image/jpeg,image/jpg" />           
						    </div>                           
                             </div><br>
                        <div class="row" >
                            <div class="col-sm-6">
                                <label>Ingresa INE (Parte Delantera)* </label>
				                <input type="file" required class="form-control" name="ine_front" accept="image/png,image/jpeg,image/jpg" />           
						    </div>
                            
                            <div class="col-sm-6">
                                <label>Ingresa INE (Parte Trasera)* </label>
				                <input type="file" required class="form-control" name="ine_back" accept="image/png,image/jpeg,image/jpg" />           
						    </div>
                        </div><br>
                        <div class="row" >
                            <div class="col-sm-12" >
                                 <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> El proceso de envio de datos no garantiza que ya serás un representante. Se te contactará vía correo electrónico o teléfono con los que te registraste.</p>
                            </div>
                        </div>
					</div>
				</div>

                <div class="col-sm-12 text-center" >
                    <div id="loader" hidden ><img loading="lazy" height="50px" width="50px"   src="<?php echo $img_load ?>loader.gif" alt="" class="img-responsive center-block"  /> </div>
                </div>


				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
                
                
			</form>
		</div>
	</div>
	
</div>

<script>
    var base_url = '<?php echo base_url(); ?>';
  </script>
<script src="<?php echo $js_path; ?>jquery-3.2.1.js"></script>
  <script src="<?php echo $js_path; ?>jquery.validate.js"></script>
  <script src="<?php echo $js_path; ?>bootstrap.js"></script>
<script src="<?php echo $js_path; ?>iziToast.min.js"></script>

  <?php
  if(isset($view_controller))
  {
  	if( ! is_array($view_controller))
  	{
  		?>
  		<script type="text/javascript" src="<?php echo $js_path.'view_controllers/'.$view_controller; ?>"></script>
  		<?php
  	}
  	else
  	{
  		foreach($view_controller as $vc)
  		{
  			?>
  			<script type="text/javascript" src="<?php echo $js_path.'view_controllers/'.$vc; ?>"></script>
  			<?php
  		}
  	}
  }
  ?>
