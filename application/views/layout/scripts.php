  <?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

  $plugins = base_url('assets/plugins').'/';
  $js_path = base_url('assets/js').'/';
  ?>

  </div>
  
  <script src="<?php echo $js_path; ?>jquery-3.2.1.js"></script>
  <script src="<?php echo $js_path; ?>jquery.validate.js"></script>
  <script src="<?php echo $js_path; ?>bootstrap.js"></script>
  <script src="<?php echo $js_path; ?>js.cookie.js"></script>
  <script src="<?php echo $plugins; ?>datatables/datatables.min.js"></script>
  <script src="<?php echo $js_path; ?>iziToast.min.js"></script>
  <script src="<?php echo $js_path; ?>jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="<?php echo $js_path; ?>mCustomScrollbar-active.js"></script>
  <script src="<?php echo $js_path; ?>jquery.meanmenu.js"></script>
  <script src="<?php echo $js_path; ?>jquery.sticky.js"></script>
  <script src="<?php echo $js_path; ?>metisMenu/metisMenu.min.js"></script>
  <script src="<?php echo $js_path; ?>metisMenu/metisMenu-active.js"></script>
  <script src="<?php echo $js_path; ?>lightbox.min.js"></script>
  <script src="<?php echo $js_path; ?>main2.js"></script>
  <script src="<?php echo $js_path; ?>moment.js"></script>
  <script src="<?php echo $js_path; ?>select2.min.js"></script>

    
  <script>
    var base_url = '<?php echo base_url(); ?>';
  </script>
  <script src="<?php echo $js_path; ?>main.js"></script>

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
    
    <?php 
    
    if(isset($view)){
        ?>
  		<script type="text/javascript" src="<?php echo $js_path.''.$view; ?>"></script>
  		<?php
    }

    ?>


</body>
</html>