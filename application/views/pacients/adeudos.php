<?php 
	$paciente = $paciente->row();
$img_path = base_url('estudios').'/'.$paciente->id."/";
?>
<div class="container" >
<h3 class="ms-title"><b>ADEUDOS - <?= $paciente->nombre . " " . $paciente->apellido_p . " " . $paciente->apellido_m  ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i><span>Regresar</span></a></h3>
    
    
        
        <div class="row" >
            
       <?php foreach ( $pedidos->result() as $pedido ): ?>
            <div class="col-sm-3" >
                <div class="panel panel-olive" style="border-radius:10px 10px 20px 20px;" >
                    <div  class="panel-heading">No. Pedido <?= $pedido->id ?></div>
                    <div class="panel-body" >
                        <div class="col-sm-12 text-center" >
                        <label>Estatus:</label>
                        <p>  <?php
										switch ($pedido->status) {
											case "Entregado":
                                    ?>
                                    <span class="label label-success" >
                                    Entregado
                                    </span>    
                                    <?php break;
											case "Pendiente":?>
                                    <span class="label label-warning" >
                                    Pendiente
                                    </span>    
                                    <?php    break;
                                            case "Cancelado": ?>
                                    <span class="label label-danger" >
                                    Cancelado
                                    </span>    
                                    <?php  break;
                                            case "Pagado": ?>
                                    <span class="label label-default" >
                                    Pagado
                                    </span>    
                                    <?php                                      break;
                                        case "Enviado":
                                                 ?>
                                    <span class="label label-primary" >
                                    Enviado
                                    </span>    
                                    <?php
                                         break;
										}
								?></p>
                        <label>Fecha:</label>
                        <p><?php echo date("j M, Y", strtotime($pedido->created_at))  ?></p>
                        <label>Total</label>
                        <p><?= $pedido->total ?></p><label>Restante</label>
                        <p><?= $pedido->restante ?></p><label>Pagado</label>
                        <p><?= $pedido->pagado ?></p>
                        
                            
                            
                        </div>
                        <div class="col-sm-12 text-center" >
                                    
                            <a href="<?= base_url().'pedidos/mostrar/'.$pedido->id ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            
                            <?php if ($pedido->status == "Pendiente"){ ?>
                            
                            <a data-toggle="modal" data-target="#abono" data-id="<?=$pedido->id ?>" data-tot="<?=$pedido->total ?>" data-res="<?=$pedido->restante ?>" class="btn btn-sm btn-warning btn-abono"> <i class="fa fa-money"></i> Abonar</a>
                            
                            <?php } ?>

                            
                        </div>
                    </div>
                </div>
            </div>
            
        <?php endforeach ?> 
            
            
        </div>
       </div> 

  <!-- Modal Agregar Abono -->
    <div class="modal fade" id="abono" tabindex="-1" role="dialog" aria-labelledby="estudiosTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="estudioTitle">Abonar a cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <form method="post" id="form-abono" name="form-abono">
            <div class="modal-body">
                <div class="row" >
                    <input type="hidden" name="id_order" id="id_order" />
                    <input id="id_paciente" name="id_paciente" type="hidden" value="<?= $paciente->id ?>" />
                    <div class="col-sm-12" >
                    <label>Abonar:</label>
                    <input id="in-abono" name="in-abono" class="form-control" type="number" />
                    </div>
                </div>
              </div>
                   
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Abonar</button>
              </div>
                    
             </form> 
            </div>
          </div>
        </div> 
    <!-- Cierra Modal Agregar Estudio -->   
        
