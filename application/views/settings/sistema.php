<?php 

?>

<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>CONFIGURACIÓN</b></h3>
	</div>
    
    <div class="col-sm-12" >
        <div class="panel panel-default" >
            <div class="panel-heading" >SUBIR VIDEO</div>    
            <div class="panel-body" >
                
                <form id="form-video" name="form-video" method="post" enctype="multipart/form-data" >
                    
                <div class="col-sm-4" >
                    <H4>Titulo</H4>
                
                <input class="form-control" type="text" id="titulo_v" name="titulo_v"  />
                </div>    
                <div class="col-sm-4" >
                <H4>Video</H4>
                
                <input class="form-control" type="file" id="video_sbr" name="video_sbr"  accept="video/mp4" />
                </div>
                
                <div class="col-sm-4" >
                <H4>Modúlo</H4>
                
                <select class="form-control" id="s_modulo" name="s_modulo"  >
                    <option value="" >Seleccione: </option>    
                    <option value="administracion" >Administración </option>    
                    <option value="ventas" >Ventas </option>    
                    <option value="representante" >Representante </option>    
                    <option value="pacientes" >Pacientes </option>    
                    <option value="almacen" >Almacén </option>    
                    <option value="medico" >Médico </option>    
                    <option value="estadisticas" >Estadisticas </option>    
                    <option value="configuracion" >Configuración </option>    
                </select>
                </div>
                <div class="col-sm-12 text-center"  ><br>
                <button type="submit" class="btn btn-primary"><i class="fa fa-arrow-circle-up"></i> Subir Video </button>
                </div>
                </form>
               
                
                 
            
            </div>
        </div>
    
    </div>
    
</div>