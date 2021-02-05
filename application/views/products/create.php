<div class="container">

	<div class="col-xs-10 col-xs-offset-1">
		<h3 class="ms-title"><b>NUEVO PRODUCTO</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-close"></i> <span>Cancelar</span></a></h3>
		<div class="panel panel-primary">

			<form id="new_product" class="panel-body border-left-primary">
				<div class="row">

					<div class="form-group col-sm-12">
						<label>
							Nombre:
						</label>
						<input type="text" name="nombre" id="nombre" class="form-control" required minlength="3">
					</div>
					<div class="form-group col-sm-9">
						<label>
							Descripción:
						</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required rows="4" ></textarea>
					</div>
					<div class="form-group col-sm-3">
						<label>
							Precio: $
						</label>
						<input type="number" name="precio"  id="precio"class="form-control" required minlength="2" min="0" placeholder="$">
                        <label>
									Sucursal
								</label>
                                   
								<select id="sucursal" name="sucursal" class="form-control" required >
                                    
                                     <?php if($this->session->type == "Administrador" || $this->session->type == "Contador"){ ?>
									<option value="" >Seleccione una opción</option>
									<?php foreach ($sucursales->result() as $sucursal): ?>
									<option value="<?= $sucursal->id ?>"><?= $sucursal->razon_social ?></option>
									<?php endforeach ?>
                                     <?php }else{ ?>
                                    <option value="<?= $this->session->sucursal ?>" >Tu sucursal</option>
                                    <?php } ?>
                                    
								</select>
					</div>
                    <div class="form-group col-sm-6">
						<label>
							Existencia:
						</label>
						<input type="number" id="existencia" name="existencia" class="form-control" min="1" required >
					</div>
                    <div class="form-group col-sm-6">
						<label>
							Imagen:
						</label>
						<input type="file" name="imagen_pro"  id="imagen_pro" class="form-control" required minlength="3">
					</div>
                    <div class="form-group">
								
                                   
							</div>
				</div>
				<button type="submit" class="btn btn-teal btn-save"><i class="fa fa-save fa-2x"></i> <br>Guardar</button>
			</form>
		</div>
		
	</div>

</div>