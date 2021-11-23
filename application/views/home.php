
<div class="container">
	<h3 class="ms-heading"><b id="suc_name">BIENVENIDO - <?= $this->session->sucursal_name;  ?></b></h3>
    <div class="row" >
        <div class="col-sm-12">
            
        </div>
         <div class="col-sm-6" >
            <?php if($this->session->type == "Administrador" || $this->session->type == "Medico Administrador"){?>
             <div  class="panel panel-default" >
                 <div class="panel-heading" ><h4>¿En que sucursal te encuentras?</h4></div>
                 <div class="panel-body" >
                     <form id="update_suc" name="update_suc" method="post" >
                 <div class="form-group">
                     
                        <label>
                            Sucursal
                        </label>
                        <select id="sucursal" name="sucursal" class="form-control" required >

                            <option value="" >Seleccione una opción</option>
                            <?php foreach ($sucursales->result() as $sucursal): ?>
                            <option value="<?= $sucursal->id ?>"><?= $sucursal->razon_social ?></option>
                            <?php endforeach ?>

                        </select>
                    </div>
                 <button type="submit" class="btn btn-sm btn-warning pull-right" ><i class="fa fa-edit"></i> Actualizar</button>
                 </div>
             </form>
             </div>
            <?php }else{ } ?>
             
              <div class="panel panel-olive" >
                
                <div class="panel-heading text-center"><h3>Novedades y Actualizaciones | v 6.0.0</h3></div>
                <div class="panel-body" >
                    <!-- <ul>
                        <li>Nueva forma de ingresar representantes</li>
                        <li>Soluciones de errores.</li>
                    </ul>  -->
                    <?php if($this->session->type == "Administrador" || $this->session->type == "Medico Administrador" || $this->session->type == "Medico"){?>
                    <h4>Nuevas novedades</h4>
                    <h3>Se habilito el servidor de prueba para probar la nueva actualización.</h3>
                    <a target="_blank" href="http://megasalud.com.mx/app"><h4>Ingresa a dando clic aquí</h4></a>  
                    <iframe width="500" height="300" src="https://www.youtube.com/embed/sx8e89V6n6w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php }else{ } ?>
                </div>
                    
            </div>   
        </div>
        <div class="col-sm-6" >
            <div class="panel panel-primary">
                <div class="panel-heading" ><h3>Comentarios</h3></div>
                    <div class="panel-body" >
                        <form id="add_comment" method="post"  >
                            <label>Asunto</label>
                            <input class="form-control" id="asunto" placeholder="Escribe aquí" name="asunto" required /><label>Tipo</label>
                            <select class="form-control" id="tipo"  name="tipo" required>
                            <option value="" >Seleccione</option>
                            <option value="Error" >Error</option>
                            <option value="Comentario" >Comentario</option>
                            <option value="Mejora" >Mejora</option>
                            </select>
                            <label>Módulo</label>
                            <select class="form-control" id="modulo" name="modulo" required >
                            <option value="">Seleccione:</option>
                            <option value="Administración">Administración</option>
                            <option value="Ventas">Ventas</option>
                            <option value="Almacén">Almacén</option>
                            <option value="Médico">Médico</option>
                            <option value="Venenos">Venenos</option>
                            <option value="Configuración">Configuración</option>
                            </select>
                            <label>Mensaje</label>
                            <textarea class="form-control" rows="6" id="mensaje" name="mensaje" ></textarea><br>
                            <input type="hidden" value="<?= $this->session->id;  ?>" id="id_user" name="id_user" />
                            
                            <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</div>