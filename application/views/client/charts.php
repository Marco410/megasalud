<?php 
$paciente = $paciente->row();
$img_path = base_url('assets/images/icons').'/';
?>


<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>GRÁFICAS DE <?= $paciente->nombre ." " . $paciente->apellido_p  ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
		<div class="panel panel-primary">
                <div class="panel-heading">
				<span class="ms-subtitle">Generales</span>
			 </div>
            <div class="panel-body" >
				<div class="row">
                    <div class="col-sm-12" >
                        
                    <button class="btn btn-primary" data-toggle="modal" data-target="#new_chart" ><i class="fa fa-bar-chart "></i> Nueva Gráfica</button>   
                    </div>
                    <div  ></div>
                    
                    <div class="col-sm-12" >
                       
                        
                        <?php foreach ( $charts->result() as $chart ): ?>
                        <input type="hidden" id="id_chart" name="charts[]" value="<?= $chart->id ?>"  />
                         <div class="panel panel-default border-left-olive" >
                             <div class="panel-heading" ><h3> <label>Titulo: <?= $chart->titulo ?></label></h3></div>
                        <div class="panel-body" >
                             <div class="col-sm-12" >
                            
                        <p><label>Descripcion:</label> <?= $chart->descripcion ?></p>
                        </div>
                        
                        <div class="col-sm-12" >
                        <canvas id="<?= $chart->titulo ?>"></canvas>
                        </div>
                        </div>
                            
                      </div>       
					<?php endforeach ?>
                       
                    </div>
            </div>
			</div>
		</div>
        
        <div class="col-sm-12" >
            <div class="panel panel-orange" >
                <div class="panel-heading" ><h3>Nuevo Dato</h3></div>
                <div class="panel-body" >
                     <form name="form_new_data" id="form_new_data" method="post" >
                    <input type="hidden" name="id_paciente" id="id_paciente" value="<?= $paciente->id ?>"  />

                    <div class="col-sm-4" >
                        <label>Gráfica</label>
                        <select class="form-control" name="id_chart" required >
                            <option value="" >Seleccione: </option>
                          <?php foreach ( $charts->result() as $chart ): ?>
                            <option value="<?= $chart->id ?>" ><?= $chart->titulo ?></option>
                           <?php endforeach ?>

                        </select>     
                    </div>
                    <div class="col-sm-8" id="new_data" >
                    <div class="col-sm-5" >
                    <label>Nuevo Valor: </label>
                    <input class="form-control" name="valor[]" type="text" required placeholder="Ingrese un valor" />

                    </div>
                    <div class="col-sm-5" >
                        <label>Fecha:</label>
                    <input type="date" required class="form-control" name="fecha[]" />
                    </div>
                        <div class="col-sm-2" >
                        <label>Agregar</label><br>
                        <button type="button"  id="btn_new_data" class="btn btn-sm btn-success" data="1"  ><i class="fa fa-plus"></i> </button>
                        </div>
                    </div>     
                    <div class="col-sm-12 text-center" ><br>
                        <button type="submit" class="btn btn-sm btn-warning" ><i class="fa fa-plus"></i> Añadir Dato</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
	</div>

</div>

 <div class="modal fade" id="new_chart" tabindex="-1" role="dialog" aria-labelledby="Gráfica" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" >Nueva Gráfica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <form id="form_new_chart" name="form_new_chart" method="post" >
            <div class="modal-body">
                
                <div class="row" >
                    <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" id="id_paciente"  />
                    <div class="col-sm-12" >
                        
                        <label>Titulo</label>
                        <input class="form-control titulo" type="text" placeholder="Ingrese Titulo" pattern="[A-Za-z0-9_-]{1,15}" id="titulo" name="titulo" required />
                        <small>No estan permitidos los espacios.</small>
                    
                    </div>
                    <div class="col-sm-12" >
                        
                        <label>Descripción</label>
                        <input class="form-control" type="text" placeholder="De que se trata la gráfica" name="descripcion" required />
                    
                    </div>  
                    <div class="col-sm-6" >
                        
                        <label>Dato Maximo</label>
                        <input class="form-control" type="number" placeholder="Ingrese" name="max" required />
                    
                    </div>  
                    <div class="col-sm-6" >
                        
                        <label>Dato Minimo</label>
                        <input class="form-control" type="number" placeholder="Ingrese" name="min" required />
                    
                    </div> 
        
                </div>
                
                
              </div>
            <div class="modal-footer" >
             <button class="btn btn-md btn-info" type="submit" ><i class="fa fa-save"  ></i> Hacer nueva gráfica</button>
            </div>
               </form>
            </div>
          </div>
        </div>  