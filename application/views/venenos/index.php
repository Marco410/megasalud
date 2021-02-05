
<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>VENENOS</b></h3>
	</div>
    <div class="col-sm-12" >
        <div class="panel panel-brown" >
            <div class="panel-heading" ><h3>Nuevo Medicamento</h3></div>
            <div class="panel-body" >
                
                <form id="form-new-medi" name="form-new-medi" method="post" >
                <div class="col-sm-6" >
                    <label>Nombre Comercial:</label>
                    <input class="form-control" placeholder="Inserta nombre comercial" type="text" name="nombre_c" required />
                    
                </div>
                <div class="col-sm-6" >
                    <label>Nombre:</label>
                    <input class="form-control" placeholder="Inserta nombre" type="text" name="nombre" />
                </div>
                <div class="col-sm-12" >
                    <label>Contraindicaciones:</label>
                    <textarea  required class="form-control" rows="10" placeholder="Escribe aqui..." name="contra" ></textarea><br>
                </div>
                <div class="col-sm-12 text-center" >
                    <button class="btn btn-primary " type="submit"  ><i class="fa fa-save" ></i>  Guardar nuevo medicamento</button>
                </div>
                </form>
            </div>
        
        </div>
    
    
    </div>
	
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-body">
	
				<table id="main-table" class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre Comercial</th>
							<th>Nombre</th>
							<th style="width: 110px">Opc.</th>
						</tr>
					</thead>
					<tbody id="main-table" >
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modal-info">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-info bg-transparent">
			
			<div class="modal-head panel panel-primary text-center no-border">
				<div class="panel-heading">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					DETALLES DEL MEDICAMENTO
				</div>
				<div class="modal-body panel-body">
					<b>Nombre Comercial:</b>
					<p id="m-medicamento"></p>
					<b>Nombre:</b>
					<p id="m-nombre"></p>
					<b>Contraindicación:</b>
					<p><pre id="m-contra" class="pre-from-textarea"></pre></p>
                    
				</div>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->