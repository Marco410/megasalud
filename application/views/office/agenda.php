<?php 
	$sucursal = $sucursal->row();
?>
<style>
.responsiveCal {
 
position: relative; padding-bottom: 75%; height: 0; overflow: hidden;
 
}
.responsiveCal iframe {
 
position: absolute; top:0; left: 0; width: 100%; height: 100%;
 
}
</style>
<div class="container">

	
		<h3 class="ms-title"><b>AGENDA | <?= $sucursal->razon_social ?> </b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Regresar</span></a></h3>
        
    <div class="col-sm-12">
            <img height="100px" width="100px" src="<?php echo IMG_PATH; ?>calendar.svg" alt="" class="img-responsive center-block">
				</div>	
			
    <div class="panel panel-warning ">
		<div class=" panel-body " > 
            <div class="col-sm-12">
                <div class="responsiveCal" >
                <?= $sucursal->calendario ?>
                </div> 
            </div>
        </div>
    </div>

</div>