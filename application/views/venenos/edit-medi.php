<?php 
	$medi = $medi->row();
?>
<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>EDITAR MEDICAMENTO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
	</div>
    <div class="col-sm-12" >
        <div class="panel panel-brown" >
            <div class="panel-heading" ><h3>-</h3></div>
            <div class="panel-body" >
                
                <form id="form-edit-medi" name="form-new-medi" method="post" >
                <div class="col-sm-6" >
                    <label>Nombre Comercial:</label>
                    <input class="form-control" placeholder="Inserta nombre comercial" type="text" name="nombre_c" value="<?= $medi->medicamento ?>"  required />
                    
                    <input  type="hidden" name="id" value="<?= $medi->id ?>"  required />
                    
                </div>
                <div class="col-sm-6" >
                    <label>Nombre:</label>
                    <input class="form-control" placeholder="Inserta nombre" type="text" name="nombre" value="<?= $medi->nombre ?>" />
                </div>
                <div class="col-sm-12" >
                    <label>Contraindicaciones:</label>
                    <textarea  required class="form-control" rows="10" placeholder="Escribe aqui..." name="contra" ><?= $medi->contra ?></textarea><br>
                </div>
                <div class="col-sm-12 text-center" >
                    <button class="btn btn-warning " type="submit"  ><i class="fa fa-save" ></i>  Actualizar Medicamento</button>
                </div>
                </form>
            </div>
        
        </div>
    
    
    </div>
