<?php 
$vi_path = base_url('assets/videos').'/';
?>

<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>TUTORIALES</b></h3>
	</div>	
    <?php foreach ($tutoriales->result() as $tut): ?>
                    
    <div class="col-sm-12 text-center" >
        <div class="panel panel-default"  >
            <div class="panel-heading" >TUTORIAL | <?= $tut->titulo ?></div>
            <div class="panel-body" >
              
                <video width="720" height="400" controls >
                    <source src="<?= $vi_path ?>tutoriales/<?= $tut->modulo?>/<?= $tut->nombre ?>" type="video/mp4" >
                </video>
               
            </div>

        </div>
    </div>
<?php endforeach ?>  
</div>