<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

$css_path = base_url('assets/css').'/';
$img_path = base_url('assets/images').'/';
$js_path = base_url('assets/js').'/';
$plugins = base_url('assets/plugins').'/';
?>

<!DOCTYPE html>
<html lang="es_MX">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="" name="description">
	<meta content="" name="keywords">
	<meta content="" name="author">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" CONTENT="no-cache">

	<title>Megasalud <?php if(isset($title)) echo "| ".$title; ?></title>
    
	
    <link rel="shortcut icon" href="<?php echo $img_path?>icons/favicon.ico">

	<link rel="stylesheet" href="<?php echo $css_path; ?>animate.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>bootstrap3.3.7/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo $plugins; ?>datatables/datatables.min.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>iziToast.min.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>jquery.mCustomScrollbar.min.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>site.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>meanmenu.min.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>educate-custon-icon.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>metisMenu/metisMenu.min.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>metisMenu/metisMenu-vertical.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>style.css" />
	<link rel="stylesheet" href="<?php echo $css_path; ?>responsive.css" />

	<?php
	if(isset($view_style))
	{
		if( ! is_array($view_style))
		{
			?>
			<link rel="stylesheet" href="<?php echo $css_path.$view_style; ?>" />
			<?php
		}
		else
		{
			foreach($view_style as $vs)
			{
				?>
				<link rel="stylesheet" href="<?php echo $css_path.$vs; ?>" />
				<?php
			}
		}
	}
	?>
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script type="text/javascript" data-pace-options='{ "ajax": false }' src="<?php echo $js_path; ?>pace.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    
    <?php
	if(isset($openPayjs))
	{ ?>
    <script type="text/javascript" src="https://js.openpay.mx/openpay.v1.min.js"></script>
    <script type='text/javascript' src="https://js.openpay.mx/openpay-data.v1.min.js"></script> 
    <?php
        }
	?>

</head>

<body>
