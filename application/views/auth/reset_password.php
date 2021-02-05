<main class="flex-column-center">

    <form id="change_pw_form"  name="change_pw_form" class="form-inline col-md-4 col-sm-6 col-xs-10 flex-column-center">

        <div class="col-sm-7 mb-30">
            <img src="<?php echo base_url();?>assets/images/Logo.svg" alt="" id="foto" class="img-responsive">
            
            <h3>Cambio de Contraseña</h3>
            <h4 class="text-center" ><?= $email ?></h4>
        </div>

        <div id="email-form-group" class="col-sm-8 form-group"> <!-- has-error -->
            <div class=" icon-wrapper">
                <i class="fa fa-key fa-lg"></i>
            </div>

            <input id="password" name="password" type="password" class="form-control" placeholder="Ingresa Nueva Contraseña" required>
            <input type="hidden" value="<?= $token ?>" name="token" />

        </div>
        
        <div id="email-form-group" class="col-sm-8 form-group"> <!-- has-error -->
            <div class=" icon-wrapper">
                <i class="fa fa-copy fa-lg"></i>
            </div>

            <input id="password2" name="password2" type="password" class="form-control" placeholder="Confirmar Contraseña" required>

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

