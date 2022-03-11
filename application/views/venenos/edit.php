<?php 
	$veneno = $veneno->row();
?>
<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>EDITAR VENENO </b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
	</div>
    <div class="col-sm-12" >
        <div class="panel panel-brown" >
            <div class="panel-heading" ><h3><?= $veneno->veneno ?></h3></div>
            <div class="panel-body" >
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Clasificación:</h4>
                    </div>
                    <div class="col-sm-2 text-center">
                        <h5>A</h5>
                        <button class="btn btn-sm btn-success" ><?= $veneno->c_a ?></button>
                    </div>
                    <div class="col-sm-2 text-center">
                        <h5>B</h5>
                        <button class="btn btn-sm btn-success" ><?= $veneno->c_b ?></button>
                    </div>
                    <?php if($veneno->c_c != "0"){ ?> 
                        <div class="col-sm-2 text-center">
                            <h5>C</h5>
                        <button class="btn btn-sm btn-success" ><?= $veneno->c_c ?></button>
                        </div>
                    <?php } ?> 
                    <?php if($veneno->c_d != "0"){ ?> 
                    <div class="col-sm-2 text-center">
                        <h5>D</h5>
                        <button class="btn btn-sm btn-success" ><?= $veneno->c_d ?></button>
                    </div>
                    <?php } ?> 
                    <?php if($veneno->c_e != "0"){ ?> 
                    <div class="col-sm-2 text-center">
                        <h5>E</h5>
                        <button class="btn btn-sm btn-success" ><?= $veneno->c_e ?></button>
                    </div>
                    <?php } ?> 
                    <?php if($veneno->c_f != "0"){ ?> 
                    <div class="col-sm-2 text-center">
                        <h5>F</h5>
                        <button class="btn btn-sm btn-success" ><?= $veneno->c_f ?></button>
                    </div>
                    <?php } ?> 
                    <?php if($veneno->c_g != "0"){ ?> 
                    <div class="col-sm-2 text-center">
                        <h5>G</h5>
                        <button class="btn btn-sm btn-success" ><?= $veneno->c_g ?></button>
                    </div>
                    <?php } ?> 
                    <?php if($veneno->c_h != "0"){ ?> 
                    <div class="col-sm-2 text-center">
                        <h5>H</h5>
                        <button class="btn btn-sm btn-success" ><?= $veneno->c_h ?></button>
                    </div>
                    <?php } ?> 
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Productos Relacionados</h4>
                        <div id="panel_relations" class="col-sm-12" >
                        <ul class="list-group" id="list-product">
                        <?php foreach ( $relations as $relation ): ?>
                            <li class="list-group-item ">
                                <a data-id="<?= $relation->id ?>" data-toggle="modal" data-target="#delete_relation" class="text-danger"> <i class="fa fa-trash" >  </i> </a>
                                <?= $relation->nombre_p ?>
                            </li>
                        <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4>Relacionar Producto</h4>
                        <select class="select2 form-control" name="" id="producto_ven">
                            <option value="">Buscar...</option>
                            <?php foreach ( $productos->result() as $product ): ?>
                                <option value="<?= $product->id ?>" ><?= $product->nombre_p ?></option>
                                <?php endforeach ?>
                            <option value="nuevo">Nuevo</option>
                        </select>
                        <div class="" id="panel-relacion"  >
                            <br>
                            <form id="add_relacion_form" name="add_relacion_form" method="post"  >
                                <input type="hidden" name="producto_id" id="producto_id" value="" />
                                <input type="hidden" name="veneno_id" id="veneno_id" value="<?= $veneno->id ?>" />

                                <button class="btn btn-sm btn-block btn-primary" type="submit" ><span class="fa fa-save" ></span> Añadir Relación</button>
                            </form>
                        </div>
                        <div class="" id="panel-add-v"  >
                            <br>
                            <a href="#" class="btn btn-sm btn-info" data-id="19" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nuevo Producto</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


     <!-- Modal Add settings -->
     <div class="modal fade" id="delete_relation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="delete_relation_form" name="delete_relation_form" method="post"  >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Eliminar Relación</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row" >
                            <div class="col-sm-12 text-center">
                                <p>¿Realmente deseas eliminar la relación?</p>
                            </div>
                            <div class="col-sm-1" > 
                            <input class="form-control"  type="hidden" name="relation_id" id="relation_id"   /></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-md btn-danger" type="submit" ><span class="fa fa-trash"></span> Eliminar</button>    
                    </div>
                </form>
            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal fade -->
    <!-- Cierra Modal -->

    <!-- Modal Add settings -->
    <div class="modal fade" id="addSet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addSet_form" name="addSet_form" method="post"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Añadir</h4>
                </div>
                <div class="modal-body">

                    <div class="row" >
                        <div class="col-sm-1" > 
                        <input class="form-control "  type="text" name="input_id" id="input_id"   /></div>

                    <div class="col-sm-11" >
                        <label>Añade aqui</label>
                    <input class="form-control" id="dato" name="dato"  />
                        </div>

                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-md btn-primary" type="submit" ><span class="fa fa-save"></span> Guardar</button>    
                    </div>
                </form>
            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal fade -->
    <!-- Cierra Modal -->