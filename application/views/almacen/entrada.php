<div class="container">

	<div class="col-sm-12">
		<h3 class="ms-title"><b>NUEVA ENTRADA</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
	</div>
    
    
    <div class="col-sm-12" >

        <div class="panel panel-olive" >
            <div class="panel-heading " >
                <h5>Generar nueva entrada al almacén</h5>
            </div>
            <div class="panel-body" >
                <form method="post" name="form-entrada-almacen" id="form-estrada-almacen">
                <div class="col-sm-6" >
                    <label>Proveedor:</label>    
                    <select class="form-control" name="proveedor" >
                        <option value="" >Seleccione:</option>
                        <?php foreach ( $providers as $prov ): ?>
							<option value="<?= $prov->empresa ?>" ><?= $prov->empresa ?></option>
						<?php endforeach ?>
                    </select>
                </div>
                <div class="col-sm-6" >
                    <label>No. Factura:</label>    
                    <input required class="form-control" type="text" name="factura"  />
                </div>  
                <div class="col-sm-12 text-center" >
                    <label>Nuevos productos</label><br>
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
            <table id="main-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Existencia</th>
                            <th>Categoria</th>
                            <th>Seleccionar</th>
                            
							
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $data as $almacen ): ?>
							<tr>
								<td><?= $almacen->id ?></td>
								<td><?= $almacen->nombre ?></td>
								<td><?= $almacen->existencia ?></td>
                                <td><?= $almacen->clave_categoria ?></td>
                                <td><button onclick="agregar_p('<?= $almacen->id ?>','<?= $almacen->nombre ?>','<?= $almacen->existencia ?>','<?= $almacen->clave_categoria ?>',this)" class="btn btn-success agregar_p"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                </td>
                                
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
            </div>
    </div>
  </div>
</div>
