<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

$css_path = base_url('assets/css').'/';
$js_path = base_url('assets/js').'/';
$img_path = base_url('assets/images').'/';
?>
<head>
    
    <link rel="stylesheet" href="<?php echo $css_path; ?>bootstrap3.3.7/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo $css_path; ?>site.css" />
    <script type="text/javascript" data-pace-options='{ "ajax": false }' src="<?php echo $js_path; ?>pace.min.js"></script>
</head>	
<div class="container">
        
    <div class="col-xs-10 col-xs-offset-1">	
        <h3 class="ms-title text-center"><b>GRACIAS POR REGISTRARTE </b></h3>
        
		<div class="col-sm-12 text-center">
            <img src="<?= $img_path ?>success.svg" height="100px" width="100px" alt="exito" class="img-circle"><br>
            
            <p>Puedes ingresar a tu cuenta como representante desde este enlace:</p>
            <a href="https://www.megasalud.org/sistema/login"><label>https://www.megasalud.org/sistema/login</label></a>
            <p>Recuerda activar la casilla de "Ingresar como representante"</p>
			
		</div>
	</div>
	
</div>

<script src="<?php echo $js_path; ?>jquery-3.2.1.js"></script>
  <script src="<?php echo $js_path; ?>jquery.validate.js"></script>
  <script src="<?php echo $js_path; ?>bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo $js_path.'view_controllers/'.$view_controller; ?>"></script>