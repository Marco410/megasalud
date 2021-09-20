<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

$css_path = base_url('assets/css').'/';
$images_path = base_url('assets/images').'/';
$js_path = base_url('assets/js').'/';
?>
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">

	<meta name="description" content="Registrate para obtener una consulta médico más especifica sobre tu enfermedad.">

	<meta property="og:url" content="https://megasalud.com.mx/sistema/registro" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Registro" />
    <meta property="og:description" content="Registrate para obtener una consulta médico más especifica sobre tu enfermedad." />
     <meta property="og:image" content="https://megasalud.com.mx/wp-content/uploads/2020/10/Diseño-sin-título.png" />
	<meta property="og:locale" content="es_MX" />
	<meta property="og:locale:alternate" content="es_MX" />
	<meta property="og:site_name" content="Registro Megasalud" />
	
    <meta name="twitter:description" content="Descripción de la página de prueba"/>
    <meta name="twitter:image" content="https://megasalud.com.mx/wp-content/uploads/2020/10/Diseño-sin-título.png"/>
    <meta name="twitter:site" content="@megasalud"/>
    <meta name="twitter:creator" content="@megasalud"/>
    <meta name="twitter:via" content="megasalud"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://megasalud.com.mx/sistema/registro"/>
    <meta name="twitter:domain" content="www.megasalud.com.mx">

	<link rel="canonical" href="https://www.megasalud.com.mx" />
    

    <link rel="stylesheet" href="<?php echo $css_path; ?>bootstrap3.3.7/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo $css_path; ?>site.css" />
    <link rel="stylesheet" href="<?php echo $css_path; ?>style.css" />
    <link rel="stylesheet" href="<?php echo $css_path; ?>iziToast.min.css" />
    
    <script type="text/javascript" data-pace-options='{ "ajax": false }' src="<?php echo $js_path; ?>pace.min.js"></script>
    <script src="https://use.fontawesome.com/ded6d5aa91.js"></script>
</head>	
<div class="container">
        
    <div class="col-xs-10 col-xs-offset-1">
		<div class="col-sm-6 text-center">
			<h3 class="ms-title "><b>REGISTRARME </b></h3>
		</div>	
		<div class="col-sm-6 text-center" >
			<img width="45%" src="<?php echo $images_path; ?>logo2.png" alt="Logo Megasalud" style="margin-top:10px;">
		</div>
        
		<div class="col-sm-12 col-md-8 col-md-offset-2">

			<form id="new_registro_form" name="new_registro_form" class="panel-body no-padding">
				<div class="panel mb-0 panel-primary panel-flat border-left-primary">
					<div class="panel-heading ">
						<span class="ms-subtitle">LLENA TODA LA INFORMACIÓN</span>
					</div>

					<div class="panel-body">
						<div class="col-sm-12">
							<div class="form-group  col-sm-12 col-md-4 ">
								<label>
									Nombre(s): <span style="color:red;" >*</span>
								</label>
								<input type="text" name="nombre" id="nombre" class="form-control" required minlength="3">
							</div>
							<div class="form-group col-sm-12 col-md-4 ">
								<label>
									Apellido Paterno <span style="color:red;" >*</span>
								</label>
								<input type="text" name="apellido_p" id="apellido_p" class="form-control" required minlength="3">
							</div>
							<div class="form-group col-sm-12 col-md-4 ">
								<label>
									Apellido Materno <small style="color:var(--olive);" >(Opcional)</small>
								</label>
								<input type="text" name="apellido_m" id="apellido_m" class="form-control" >
							</div>
                            <div class="form-group col-sm-6">
								<label>
									Teléfono <small style="color:var(--olive);" >(Opcional)</small>
								</label>
								<input id="telefono" type="text" name="telefono" class="form-control" >
							</div>
							<div class="form-group col-sm-6">
								<label>
									Ciudad donde vives <span style="color:red;" >*</span>
								</label>
								<input id="ciudad" type="text" name="ciudad" class="form-control" required>
							</div>
							<div class="form-group col-sm-12">
								<label>
									¿Padeces alguna enfermedad? <small style="color:var(--olive);" >(Opcional)</small>
								</label>
								<input type="text" name="enfermedad" class="form-control" placeholder="Escribe aqui..." >
							</div>
                            <div class="form-group col-sm-12">
								<label>
									Comentarios <small style="color:var(--olive);" >(Opcional)</small>
								</label>
								<textarea name="notas" placeholder="Escribe aquí si tienes alguna duda..." class="form-control" ></textarea>
							</div>
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-teal btn-block"><i class="fa fa-save"></i> Guardar mi registro</button>
                
                
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
