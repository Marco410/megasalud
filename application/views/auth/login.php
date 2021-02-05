<main class="flex-column-center">

    <form id="login_form"  name="login_form" class="form-inline col-md-4 col-sm-6 col-xs-10 flex-column-center">

        <div class="col-sm-7 mb-30">
            <img src="<?php echo base_url();?>assets/images/Logo.svg" alt="" id="foto" class="img-responsive">
        </div>

        <div id="email-form-group" class="col-sm-8 form-group"> <!-- has-error -->
            <div class=" icon-wrapper">
                <i class="fa fa-user fa-lg"></i>
            </div>

            <input id="email" name="email" type="email" class="form-control" placeholder="Email" required>
            
        
            <span class="help-block">
                <strong class="email-error"></strong>
            </span>

        </div>
        <div id="password-form-group" class="col-sm-8 form-group">
            <!-- has-error -->
            <div class="icon-wrapper">
                <i class="fa fa-lock fa-lg"></i>
            </div>

            <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña" required autocomplete="off">

            <span class="help-block">
                <strong class="password-error"></strong>
            </span>

        </div>
        
        <div id="check-form-group" class="col-sm-8 form-group checkbox text-center"> <!-- has-error -->
            <div class="checkbox">
              <label><input type="checkbox" id="agent" name="agent" value="1">   Ingresar como Representante</label>
            </div>

        </div>
        
        <div id="check-form-group" class="col-sm-8 form-group checkbox"> <!-- has-error -->
                <button type="button" id="btnPaciente" class="btn btn-primary btn-sm" data-title="Da clic aquí para ingresar como paciente." >Soy un paciente</button>
        </div>

        <div class="col-sm-12 no-padding mt-30">
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
    
  

    <div class="col-md-4 col-sm-6 col-xs-10 mt-30 text-center">
        <a href="<?=base_url('/password-request');?>">¿Olvidaste tu contraseña?</a>
    </div>


    <footer style="position: absolute;bottom: 15px;">
        <p>Todos los derechos reservados. <i class="fa fa-copyright"></i> Megasalud <?= date('Y'); ?></p>
    </footer>
</main>

   <!-- Modal Login paciente -->
       <div class="modal fade" id="paciente" tabindex="-1" role="dialog" aria-labelledby="Paciente" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" >Ingresa Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <div class="row" >
                <div class="col-sm-12" >
                  <form id="pacient-form" name="pacient-form" class="text-center" >
        
                    <div class="col-sm-12" style="margin:20px;">
                        <img src="<?php echo base_url();?>assets/images/Logo.svg" alt="" id="foto" class="img-responsive center-block" height="100px" width="250px">
                    </div><br><br>
                <div id="email-form-group" class="col-sm-12 form-group">
                        <div class="col-sm-1" >
                         <div class=" icon-wrapper">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                       <div class="col-sm-10" >
                        <input id="expediente" name="expediente" class="form-control" type="text"  required placeholder="Ingresa tu No. Expediente" />
                        </div>
                        
                    </div>
                    <div id="password-form-group" class="col-sm-12 form-group"> <!-- has-error -->
                        <div class="col-sm-1" >
                            <div class="icon-wrapper">
                            <i class="fa fa-lock"></i>
                        </div>
                        </div>
                        <div class="col-sm-10" >
                            <input id="pass" name="pass" class="form-control" type="password" required placeholder="Ingresa tu contraseña" autocomplete="off"  />
                        </div>
                    </div>
                <div class="col-sm-12">
                        <input type="submit" class="btn btn-primary">
                    </div>
            </form>
                
           </div> 
                    </div>
              </div>
                   
            </div>
          </div>
        </div> 


