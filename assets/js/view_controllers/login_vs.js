Pace.on('done', function(){
	init();
});

if(navigator.onLine) {
} else {
     alert("NO se detecta ninguna conexion a internet");
}

function init(){
    
    
	$('#login_form').validate({
		errorPlacement: function(error, element) {
			if (element.attr("name") == "email" ){
				error.insertAfter(".email-error");
			}
			if (element.attr("name") == "password" ){
				error.insertAfter(".password-error");
			}
		},
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/AuthController/auth',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						var response = JSON.parse(respuesta);

						if(response.error == false){
							if(response.auth == true){
								window.location.href = "home";
							}
							else{
                                window.location.href = "sucursales";
								alert('mostrar sucursales');
							}
						}
						else if (response.error == true) {
							iziToast.error({
								timeout: 3000,
							    title: 'Error',
							    position: 'topRight',
							    // target: '.login-message',
							    message: 'Usuario o Contraseña Incorrecta',
							});
						}
						if(response.aprobado == false){
							iziToast.error({
								timeout: 7000,
							    title: 'Error',
							    position: 'topRight',
							    // target: '.login-message',
							    message: 'Aún no has sido aprobado, consulta tu correo o haznos una llamada.',
							});
						}
					}
					else{
						alert('Error de conexión con el servidor.');
					}
				}
			});
		}
	});
    
    $('#pacient-form').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/AuthController/auth_pacient',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						var response = JSON.parse(respuesta);

						if(response.error == false){
							if(response.auth == true){
								window.location.href = "paciente";
							}else{
                                iziToast.info({
								timeout: 6000,
							    title: 'Error',
							    position: 'topRight',
							    // target: '.login-message',
							    message: 'Pide a tu medico que te agregue a la sucursal',
							});
                            }
						}
						else{
							// alert('Contraseña incorrecta.');
							iziToast.error({
								timeout: 3000,
							    title: 'Error',
							    position: 'topRight',
							    // target: '.login-message',
							    message: 'Expediente o Contraseña Incorrecta',
							});
						}
					}
					else{
						alert('Error de conexión con el servidor.');
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    
    
    $("#btnPaciente").on("click",function(){
        $("#paciente").modal("show");
    });
    
    
    $('#reset_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/AuthController/reset_pass',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						var response = JSON.parse(respuesta);
                        console.log(respuesta);
						if(response.error == true){
                            console.log(response.token);
                                iziToast.success({
								timeout: 6000,
							    title: 'Correcto',
							    position: 'topRight',
							    // target: '.login-message',
							    message: 'Se envio un correo para recuperar tu contraseña. Te recomendamos revisar tu bandeja de "Correo no deseado"',
							});
						}
						else if(response.error == false) {
							iziToast.error({
								timeout: 3000,
							    title: 'Error',
							    position: 'topRight',
							    // target: '.login-message',
							    message: 'No existe este correo',
							});
						}
					}
					else{
						alert('Error de conexión con el servidor.');
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    
    $('#change_pw_form').validate({
        ignore: ".ignore",
		rules: {
			password2: {
				equalTo: "#password"
			}
		},
		messages: {
			password2: {
				required: "Ingrese su contraseña nuevamente.",
				equalTo: "La contraseña no coincide."
			}
		},
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/AuthController/changePW',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						var response = JSON.parse(respuesta);
                        console.log(respuesta);
						if(response.error == false){
                                Cookies.set('message', { type: 'success', message: 'Contraseña cambiada correctamente.'});
						window.location.href = base_url + "login";
						}
						else if(response.error == true) {
							iziToast.error({
								timeout: 3000,
							    title: 'Error',
							    position: 'topRight',
							    // target: '.login-message',
							    message: 'Ocurrio un error. Intente de nuevo.',
							});
						}
					}
					else{
						alert('Error de conexión con el servidor.');
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
     
}