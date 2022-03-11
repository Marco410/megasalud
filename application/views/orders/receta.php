<?php 
	$pacient = $pacient->row();
?>
<div class="container">
    
    <h3 class="ms-title"><b>RECETA/PEDIDO - PACIENTE | <?= $pacient->nombre ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
    
    <div class="panel panel-primary" >
        
        <div class="panel-body">
            <div class="col-sm-12" >
            <a class="btn btn-primary" href="<?= base_url('pedidos/carrito'). "/" . $pacient->id ?>" ><i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> |  Ver Carrito de Compras</a><label>--<i class="fa fa-info-circle" ></i>--  Pon el cursor en la imagen del kit para ver su contenido</label>
              
            <h4 class="pull-right" >Artículos en el carrito | (<label id="count_carrito" ><?= $count_carrito ?></label>)</h4></div>
            
            <br><br>
              <?php foreach ( $products as $product ):
                if( $product->existencia == 0 ){
                }else{
            ?>
                
            <div class="panel panel-default col-sm-3 text-center" >
                <div class="panel-heading" style="background-color:<?= ($product->color) ? $product->color : '' ?>">
                    <h5 class="panel-title"><label><?= $product->nombre ?></label></h5>
                    <small><?= $product->codigo ?></small>
                  </div>
                
                <div class="panel-body">
                    <input type="hidden" id="id_paciente" value="<?= $pacient->id  ?>" />
                <img title="<?= $product->descripcion  ?>"  width="70px" height="70px" src="<?= base_url('assets/productos_img')."/".$product->imagen ?>" class="img-responsive img-circle center-block " alt="imagen_producto">
                <img src="" alt="" class="">
                
                
                <p>Costo: $<?= $product->precio ?> </p>
                <p>Existencia: <label id="exis<?= $product->id; ?>" ><?= $product->existencia ?> </label> </p>
                <p>Contenido:</p>
                <p style="height:155px;" ><?php echo $product->descripcion ?></p>
                <div id="btn_add<?= $product->id; ?>" >
                  <a onclick="agregar_carrito('<?= $product->id; ?>','<?= $product->nombre; ?>','<?= $product->precio; ?>','<?= $product->existencia ?>')" role="button" type="button" class="btn btn-sm btn-success" id="btn_add_carrito"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                  <a data-toggle="modal" data-target="#productModal" data-whatever="<?= $product->descripcion ?>" class="btn btn-sm btn-info" onclick=see_product(this) href="">Ver Productos</a>
                </div>
                </div>
            </div>
            
                    <?php }  endforeach ?>
            
            <div class="col-sm-12 text-center" >
            
             <a rel="noopener noreferrer" target="_blank" class="btn btn-warning" href="http://nutraceuticos.com.mx/404.html" >Vender Productos Sueltos</a> 
            
            </div>
			</div>

</div>

<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Productos del Kit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div id="description" class="col-sm-12 text-center">

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  function see_product(elemento){
    console.log(elemento.getAttribute('data-whatever'));
    $("#description").html(elemento.getAttribute('data-whatever'));
  }
</script>

