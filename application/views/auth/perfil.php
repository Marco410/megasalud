<?php
$img_path = base_url('assets/images/icons').'/';
$u = $user->row();
?>
<div class="container" >
    <h3 class="ms-title"><b>TU CUENTA</b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> <span>Regresar</span></a></h3>
    <div class="panel panel-primary" style="border-radius:15px" >  
        
        <div class="panel-heading text-center" style="border-radius:15px" >
            <h2><i class="fa fa-id-card-o"></i> <?= $u->nombre . " " . $u->apellido_p . " " . $u->apellido_m  ?> </h2>
           </div>
       <div class="panel-body ">
           <div class="container" >
               <div  class="row" >
               <div class="col-sm-4 text-center" >
                   <?php  if ($u->sexo == "Masculino"){ ?>
                    <img src="<?php echo $img_path ?>hombre.svg" width="100px" height="100px" alt="" class="img-responsive center-block" /> 
                   <?php } else{ ?>
                   <img src="<?php echo $img_path ?>mujer.svg" width="100px" height="100px" alt="" class="img-responsive center-block" /> 
                   <?php } ?>
                   
                </div>
                <div class="col-sm-4" >
                    <label>ID:</label>
                    <h4 title="Proporciona este número para recomendar a pacientes." ><i class="fa fa-shield x2"></i> <?= $this->session->id ?></h4>
                    <label>Sucursal:</label>
                    <h4><i class="fa fa-hospital-o x2"></i> <?= $this->session->sucursal_name ?></h4>
                </div>
                <div class="col-sm-4" >
                    <label>Tipo:</label>
                    <h4><i class="fa fa-user-secret x2"></i> <?= $this->session->type ?></h4>
                    <label>Correo:</label>
                    <h4><i class="fa fa-envelope-o x2"></i> <?= $u->email ?></h4> 
                    
                </div> 
               
            
               </div>
               
               <div class="row" >
                  
                  <div class="col-sm-12" >
                    <h3><i class="fa fa-address-book x2"></i> Dirección:</h3>
                    <div class="col-sm-5" >
                        <label>Calle:</label>
                        <p><?= $u->calle ?></p>
                    </div>
                     <div class="col-sm-3" >
                        <label>Colonia:</label>
                        <p><?= $u->colonia ?></p>
                    </div> 
                     <div class="col-sm-4" >
                        <label>Municipio:</label>
                        <p><?= $u->municipio ?></p>
                    </div>
                     <div class="col-sm-4" >
                        <label>Estado:</label>
                        <p><?= $u->estado ?></p>
                    </div>
                     <div class="col-sm-4" >
                        <label>Pais:</label>
                        <p><?= $u->pais ?></p>
                    </div> 
                    <div class="col-sm-4" >
                        <label>Código Postal:</label>
                        <p><?= $u->cp ?></p>
                    </div> 
                  <h3><i class="fa fa-address-card x2"></i> Información:</h3>    
                    <div class="col-sm-3" >
                        <label>RFC:</label>
                        <p><?= $u->rfc ?></p>
                    </div> 
                    <div class="col-sm-5" >
                        <label>CURP:</label>
                        <p><?= $u->curp ?></p>
                    </div> 
                    <div class="col-sm-4" >
                        <label>Telefonos:</label>
                        <p><?= $u->telefono_a ?>, <?= $u->telefono_a ?></p>
                    </div>
                     <div class="col-sm-2" >
                        <label>Cédula:</label>
                        <p><?= $u->cedula ?></p>
                    </div> 
                     <div class="col-sm-3" >
                        <label>Especialidad:</label>
                        <p><?= $u->especialidad ?></p>
                    </div> 
                     <div class="col-sm-4" >
                        <label>Cuenta Bancaria:</label>
                        <p><?= $u->cuenta_bancaria ?></p>
                    </div>   
                    <div class="col-sm-3" >
                        <label>Banco:</label>
                        <p><?= $u->banco ?></p>
                    </div> 
                  </div>
               
               </div>

           </div>
           </div>
        
 
    </div>


</div>