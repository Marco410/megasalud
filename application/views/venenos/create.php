<div class="container">
    <div class="col-xs-12">
		<h3 class="ms-title"><b>NUEVO VENENOS</b></h3>
	</div>
    <div class="col-sm-12">
    <div class="panel panel-brown" >
            <div class="panel-heading" ><h3>Agregar</h3></div>
            <div class="panel-body" >
            <form id="create_veneno_form" name="create_veneno_form" method="post"  >
                <div class="row">
                        <div class="col-sm-12">
                            <h4>Clasificación:</h4>
                        </div>
                    <div class="col-sm-4 text-center">
                        <h5>A</h5>
                       <select class="form-control select2" name="c_a" id="c_a">
                           <option value="">Seleccione:</option>
                           <option value="Biologicos">Biologicos</option>
                           <option value="No Biologicos">No Biologicos</option>
                           <option value="Microondas">Microondas</option>
                           <option value="Agricolas">Agricolas</option>
                           <option value="Industriales">Industriales</option>
                           <option value="Riesgos Caseros">Riesgos Caseros</option>
                           <option value="Animales, Plantas y Hongos">Animales, Plantas y Hongos</option>
                           <option value="Alimentos">Alimentos</option>
                           <option value="Radiaciones">Radiaciones</option>
                       </select>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h5>B</h5>
                        <select class="form-control select2" required name="c_b" id="c_b">
                            <option value="">Seleccione:</option>
                            <?php foreach($clasificaciones->result() as $cla){ ?>
                                <?php if($cla->clasificacion == "b"){ ?>
                                <option value="<?= $cla->value ?> " > <?= $cla->value ?> </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                        <div class="col-sm-4 text-center">
                            <h5>C</h5>
                            <select class="form-control select2" required name="c_c" id="c_c">
                            <option value="">Seleccione:</option>
                            <option value="0" selected>Sin Clasificación</option>
                        </select>
                        </div>
                    <div class="col-sm-4 text-center">
                        <h5>D</h5>
                        <select class="form-control select2" required name="c_d" id="c_d">
                            <option value="">Seleccione:</option>
                            <option value="0" selected>Sin Clasificación</option>
                        </select>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h5>E</h5>
                        <select class="form-control select2" required name="c_e" id="c_e">
                            <option value="">Seleccione:</option>
                            <option value="0" selected>Sin Clasificación</option>

                        </select>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h5>F</h5>
                        <select class="form-control select2" required name="c_f" id="c_f">
                            <option value="">Seleccione:</option>
                            <option value="0" selected>Sin Clasificación</option>

                        </select>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h5>G</h5>
                        <select class="form-control select2" required name="c_g" id="c_g">
                            <option value="">Seleccione:</option>
                            <option value="0" selected>Sin Clasificación</option>

                        </select>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h5>H</h5>
                        <select class="form-control select2" required name="c_h" id="c_h">
                            <option value="">Seleccione:</option>
                            <option value="0" selected>Sin Clasificación</option>

                        </select>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h5>Veneno</h5>
                       <input type="text" class="form-control" required name="veneno" >
                    </div>
                    <div class="col-sm-12" style="margin-top:10px;">
                        <button type="submit" class="btn btn-sm btn-primary btn-block" >Guardar Veneno</button>
                    </div>
                </div>
                </form>

        </div>
    </div>
   
    <!-- <form method="post" action="recibe" class="panel-body no-padding">
        
    <div class="panel mb-0 panel-primary panel-flat border-left-primary">

        <h3 class="panel-heading ">Ingresa datos del producto</h3>
        <div >
            <label>Nombre</label>
            <input type="text" name="nombre_p" required="true" />
        </div>
       
        <div>
            <label>Descripción</label><br/>
            <textarea name="descripcion_p" required="true" rows="5" cols="40" placeholder="Escribe una descripción"></textarea>
            
        </div>
        
        <h3 class="panel-heading " >Ingresa datos del veneno</h3>
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre_v" required="true" />
        </div>
         <div>
            <label>Provoca</label><br/>
            <textarea name="provoca_p" required="true" rows="5" cols="40" placeholder="Escribe que provoca"></textarea>
            
        </div>
        <div>
            <label>Descripción</label><br/>
            <textarea name="descripcion_v" required="true" rows="5" cols="40" placeholder="Escribe una descripción"></textarea>
            
        </div>
        <div>
        <input class="btn btn-primary"  type="submit" name="registrar" value="Registrar" />
        </div>

    </div>


    </form> -->
</div>
