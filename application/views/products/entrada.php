<div class="container">

	<div class="col-sm-12">
		<h3 class="ms-title"><b>NUEVA ENTRADA |  <?=  $suc  ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
	</div>
    
    
    <div class="col-sm-12" >

        <div class="panel panel-olive" >
            <div class="panel-heading " >
                <h5>Generar nueva entrada de productos</h5>
            </div>
            <div class="panel-body" >
                <form method="post" name="form-entrada" id="form-entrada">
                <div class="col-sm-6" >
                    <label>Proveedor:</label>    
                    <select class="form-control" name="proveedor" >
                        <option value="" >Seleccione:</option>
                        <?php foreach ( $providers as $prov ): ?>
							<option value="<?= $prov->empresa ?>" ><?= $prov->empresa ?></option>
						<?php endforeach ?>
                    </select>
                    <input type="hidden" value="<?= $this->uri->segment(3) ?>" name="id_suc" />
                </div>
                <div class="col-sm-6" >
                    <label>No. Factura:</label>    
                    <input class="form-control" required type="text" name="factura"  />
                </div>  
                <div class="col-sm-12 text-center" >
                    <label>Actualizar productos</label><br>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bs-modal-productos">Agregar</button>
                </div>
                <div class="col-sm-12" >
                    
                <div class="" id="sumar_producto" ></div>    
                </div>
                    
                <div class="col-sm-12 text-center" >
                    <label>Guardar</label><br>
                    <button class="btn btn-primary" type="submit"  ><i class="fa fa-save"></i></button>
                </div>    
               </form>
            </div>
        </div>
    
    </div>
     
</div>

<!-- Modal para seleccionar productos de almacen  -->
<div class="modal fade bs-modal-productos" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalproductos">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-header">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
          <span aria-hidden="true">&times;</span>
        </button>
          
        <h4 class="modal-title">Seleccionar Productos</h4>
      </div>
      
    <div class="modal-content">
        
        <div class="modal-body" >
            <table id="entrada-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Existencia</th>
                            <th>Seleccionar</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $products as $product ): ?>
							<tr>
								<td></td>
								<td><?= $product->id ?></td>
								<td><?= $product->nombre ?></td>
								<td><?= $product->existencia ?></td>
                                
                                <td><button onclick="agregar_p('<?= $product->id ?>','<?= $product->nombre ?>','<?= $product->existencia ?>',this)"  class="btn btn-success "><span class="fa fa-plus" aria-hidden="true"></span></button>  
                                </td>
                                
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
            </div>
    </div>
  </div>
</div>
