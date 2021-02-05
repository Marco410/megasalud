<?php 
$img_path = base_url('assets/images/icons').'/';
?>

<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>NUEVO PRODUCTO EN ALMACÉN</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="panel panel-primary">
           
			<form id="new_almacen" class="panel-body border-left-primary">
				<div class="row">
                    
                    <div class="col-sm-2" >
                     <img src="<?php echo $img_path ?>pallet.svg" width="80px" height="80px" alt="" class="img-responsive center-block" />
                    
                    </div>
                    <div class="col-sm-10" >
                    <div class="form-group col-sm-12">
						<label>
							Nombre
						</label>
						<input type="text" name="nombre" id="nombre" class="form-control" required minlength="3">
					</div>
                    </div>
                    <br>
                    <div class="form-group col-sm-12">
						<label>
							Descripción
						</label>
						<input type="text" name="descripcion" id="descripcion" class="form-control" required minlength="3">
					</div>
					
                    <div class="form-group col-sm-2">
						<label>
							Existencia
						</label>
						<input type="number" id="existencia" name="existencia" class="form-control" min="1" required >
					</div>
                    <div class="form-group col-sm-10">
						<label>
							Categoria
						</label>
                        <select type="file" name="clave_categoria"  id="clave_categoria" class="form-control" required >
                        <option value="" >Selecciona</option>
                        <option value="EMP" >Materia Prima</option>
                        <option value="EI" >Insumos</option>
                        <option value="EC" >Consumibles</option>
                        <option value="EEM" >Equipos y Materiales</option>
                        </select>
					</div>
				</div>
				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
			</form>
		</div>
		
	</div>

</div>