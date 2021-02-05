<div class="container">

	<div class="col-sm-12">
		<h3 class="ms-title"><b>PRODUCTOS |  <?= $this->session->sucursal_name;  ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
        
	</div>
	<div class="col-sm-6" >
        <div class="panel panel-olive" >
            <div class="panel-body text-center" >
                <a href="<?= base_url().'productos/apartados/' ?><?= $this->session->sucursal;  ?> " class="btn btn-success"><i class="fa fa-eye"></i> <span>Ver Apartados</span></a>
                
                <?php if($this->session->type == "Administrador" || $this->session->type == "Contador"){ ?>
                <a href="<?= base_url().'proveedores/' ?> " class="btn btn-warning"><i class="fa fa-eye"></i> <span>Ver Provedores</span></a>
                <a href="<?= base_url().'sucursales/agenda/' ?><?= $this->session->sucursal;  ?> " class="btn btn-brown"><i class="fa fa-calendar"></i> <span>Ver Agenda</span></a>
                <?php } ?>
                
            </div>
        </div>
    </div>
    <div class="col-sm-6" >
        <div class="panel panel-olive" >
            <div class="panel-body text-center" >
                <a href="<?= base_url().'productos/entrada/'?><?= $this->session->sucursal;  ?>  " class="btn btn-primary"><i class="fa fa-plus"></i> <span>Nueva Entrada
                    </span></a>
                <a href="<?= base_url().'productos/entradas-mostrar/' ?><?= $this->session->sucursal;  ?>  " class="btn btn-warning"><i class="fa fa-plus"></i> <span>Ver Entradas
                    </span></a>
            </div>
        </div>
    </div>
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-body">
               
                <div class="col-sm-12" >
				<table id="main-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Existencia</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $data as $product ): ?>
							<tr>
								<td><?= $product->id ?></td>
								<td><?= $product->nombre ?></td>
								<td><?= $product->precio ?></td>
								<td><?= $product->existencia  ?></td>
								<td class="text-center btn-group">
									<button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
								</td>					
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
                </div>    
			</div>
		</div>
	</div>
    <?php if($this->session->type == "Administrador" || $this->session->type == "Contador"){ ?>
    <div class="col-sm-12">
		<h3 class="ms-title"><b>VER SUCURSALES </b> </h3>
        <div class="text-center" ><h3><div id="suc_select" ></div> </h3></div>
	</div>
    
    <div id="panel-accion-pro" >
    <div class="col-sm-6" >
        <div class="panel panel-olive" >
            <div class="panel-body text-center" >
                <a id="href_a" href="" class="btn btn-success"><i class="fa fa-eye"></i> <span>Ver Apartados</span></a>
                <a id="href_agenda" href="" class="btn btn-brown"><i class="fa fa-calendar"></i> <span>Ver Agenda</span></a>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6" >
        <div class="panel panel-olive" >
            <div class="panel-body text-center" >
                <a id="href_e" href="" class="btn btn-primary"><i class="fa fa-plus"></i> <span>Nueva Entrada
                    </span></a>
                <a id="href_ve" href="" class="btn btn-warning"><i class="fa fa-plus"></i> <span>Ver Entradas
                    </span></a>
            </div>
        </div>
    </div>
    </div>
    
    <div class="col-sm-12" >
        <div class="panel panel-olive" >
            <div class="panel-body border-left-olive" >
                <div class="col-sm-6" >
                    <form id="find_suc">
            <label>
                Sucursal
            </label>

            <select id="sucursal_s" name="sucursal_s" class="form-control" required >
                 <?php if($this->session->type == "Administrador" || $this->session->type == "Contador"){ ?>
                <option value="" selected >Seleccione una opción</option>
                <?php foreach ($sucursales->result() as $sucursal): ?>
                <option value="<?= $sucursal->id ?>"><?= $sucursal->razon_social ?></option>
                <?php endforeach ?>
                 <?php }else{ ?>
                <option value="<?= $this->session->sucursal ?>" >Tu sucursal</option>
                <?php } ?>
            </select>
                        </form>
             </div><br>
                <div class="col-sm-12" >
                <table id="sucursales-table" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Existencia</th>
							<th>Precio</th>
							<th style="width: 110px;">Opc.</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
                </div>
            </div>
        </div>
        
        
    </div>
    
    
    
    <?php } ?>
</div>
