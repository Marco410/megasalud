<main class="flex-column-center">

    <form id="reset_form"  name="reset_form" class="form-inline col-md-4 col-sm-6 col-xs-10 flex-column-center">

        <div class="col-sm-7 mb-30">
            <img src="<?php echo base_url();?>assets/images/Logo.svg" alt="" id="foto" class="img-responsive">
            
            <h3>Recuperar Contraseña</h3>
        </div>

        <div id="email-form-group" class="col-sm-8 form-group"> <!-- has-error -->
            <div class=" icon-wrapper">
                <i class="fa fa-user fa-lg"></i>
            </div>

            <input id="email" name="email" type="email" class="form-control" placeholder="Correo Electrónico" required>
            
        
            <span class="help-block">
                <strong class="email-error"></strong>
            </span>

        </div>
        
        <div id="radio-form-group" class="col-sm-8 form-group checkbox text-center"> <!-- has-error -->
            <div class="radio">
              <label><input type="radio" name="user" value="1">   Usuario</label>
            </div>

        </div>
        
        <div id="radio-form-group" class="col-sm-8 form-group checkbox text-center"> <!-- has-error -->
            <div class="radio">
              <label><input type="radio" name="user" value="2">    Representante</label>
            </div>

        </div>

        <div class="col-sm-12 no-padding mt-30">
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
    

    <div class="col-md-4 col-sm-6 col-xs-10 mt-30 text-center">
        <a href="javascript:history.back()">Regresar</a>
    </div>


    <footer style="position: absolute;bottom: 15px;">
        <p>Todos los derechos reservados. <i class="fa fa-copyright"></i> Megasalud <?= date('Y'); ?></p>
    </footer>
</main>

