<?php 

    $img_path = base_url('assets/images/icons').'/';
    $img_load = base_url('assets/images/loader').'/';
    $img_perfil = base_url('assets/foto_paciente').'/';
?>
<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>Mensajería</b></h3>
	</div>	
	
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
                <h3>CHATS</h3>
                <div class="col-sm-4 left-custom-menu-adp-wrap comment-scrollbar" >
                    
                    <div class="panel panel-olive " style=" padding:10px;" >

                        <?php foreach ( $conversaciones->result() as $conver ): ?>
                        <div class="col-sm-10" >
                        <li class="row-msj btnverMsj" data="<?= $conver->id ?>" ><div class="row" style="padding:10px;" >
                        <div class="col-sm-4" >
                         <?php if($conver->foto == ""){ if ($conver->sexo == "Masculino"){ ?>
                            <img loading="lazy" src="<?php echo $img_path ?>hombre.svg" width="50px" height="50px" alt="" class="img-responsive " /> 
                           <?php } else{ ?>
                           <img loading="lazy" src="<?php echo $img_path ?>mujer.svg" width="50px" height="50px" alt="" class="img-responsive " /> 
                           <?php }}else{ ?>
                           <img loading="lazy" src="<?php echo $img_perfil . $conver->foto ?>" width="50px" height="50px" alt="" class="img-responsive img-circle " />
                           <?php } ?>
                            </div>
                            <div class="col-sm-8" >
                            <div class="" ><h5><b><?= $conver->nombre ?></b> <?= $conver->apellido_p ?></h5></div>
                            <p><?= $conver->mensaje ?></p>
                                <small style="float: right;"><?= $conver->created_at ?></small>
                            </div>
                        </div>
                        </li>
                            </div>
                        <div class="col-sm-2" >
                        <a class="btn btn-primary btn-sm" href="<?=base_url('/pacientes/historia/');?><?= $conver->id_paciente ?>" ><i class="fa fa-file-o" ></i></a>
                        </div>
                       <?php endforeach ?>

                        </div>
                </div>
                <div class="col-sm-8" >
                    <div class="panel panel-defult" >
                        <div class="panel-body  "  >
                        <div class="row" >    
                        <div class="col-sm-12 " style="height:500px; overflow: scroll; overflow-x: hidden; margin-botton:10px;" id="mensajes" >
                            <div class="row  " >
                            <img loading="lazy" height="200px" width="200px" style="padding: 20px; margin-top:20px;" class="img-responsive center-block"  src="<?php echo $img_path ?>mensajes.svg"  />
                            </div>
                            
                            <div id="loader" class="text-center" style="display:none;" >
                            <img loading="lazy" height="150px" width="150px"   src="<?php echo $img_load ?>loader.gif" alt="" class="img-responsive center-block"  /> 
                            </div>
                        </div>
                            
                        <div class="col-sm-12" style="margin-top:20px;" >
                        <form id="addMsj_form" name="addMsj_form" method="post"  >
                            <input type="hidden" name="id_conver" id="id_conver" value="" />
                            <input type="hidden" id="typeConver" name="typeConver" value="user" />
                            <div class="col-sm-10" >
                             <input type="text" name="mensaje" id="mensaje" placeholder="Escribe tu mensaje aquí" class="form-control" />
                            </div>
                            <div class="col-sm-2" >
                             <button class="btn btn-md btn-primary" type="submit"  >Enviar <span class="fa fa-paper-plane"></span> </button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                        
                    </div>
                
                </div>
                
			</div>
		</div>
	</div>

</div>