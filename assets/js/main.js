Pace.on('done', function(){
	$('#app_container').show();
	init_main();
});

function init_main(){

	$.extend(jQuery.validator.messages, {
		required: "Requerido.",
		remote: "Por favor arregle este campo.",
		email: "Por favor ingrese una dirección de correo válida.",
		number: "Ingrese un número válido.",
		digits: "Ingrese únicamente dígitos.",
		equalTo: "Ingresa el mismo valor.",
		maxlength: $.validator.format("Por favor no ingrese más de {0} caracteres."),
		minlength: $.validator.format("Ingrese al menos {0} caracteres."),
		rangelength: $.validator.format("Ingrese un valor entre {0} y {1} caracteres de longitud."),
		range: $.validator.format("Ingrese un valor entre {0} y {1}."),
		max: $.validator.format("Por favor ingrese un valor menor o igual a {0}."),
		min: $.validator.format("Por favor ingrese un valor mayor o igual a {0}."),
		url: "Ingrese una URL valida, es necesario añadir http o https"
	});

	$.validator.setDefaults({
		errorClass: 'help-block',
		highlight: function(el) {
			$(el).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(el) {
			$(el).closest('.form-group').removeClass('has-error');
		},
		ignore: []
	});

	$(".ms-sidenav-scroll").mCustomScrollbar({
		scrollInertia: 1000,
		theme: 'minimal',
		// scrollbarPosition:'outside'
	});

	//Check Messages in cookies
	if( Cookies.get('message') != undefined ){

		let data = Cookies.getJSON('message');
		
		if( data.type == 'success' ){
			iziToast.success({
				timeout: 3000,
			    title: 'Correcto',
			    position: 'topRight',
			    // target: '.login-message',
			    message: data.message,
			});
		}
		
		Cookies.remove('message');
	}
}

function checkAdminPass(pass) {

	return $.ajax({
				url: base_url + 'megasalud/MainController/verify_password',
				type: 'post',
				data: 'pass='+pass
			});
}

function seePass(el) {
        
    if($("#admin-pass").attr('type') == "password"){

        $("#admin-pass").attr('type', 'text');
	    el.toggleClass('fa-eye');
	    el.toggleClass('fa-eye-slash');

    }else{
        
        $("#admin-pass").attr('type', 'password');
        el.toggleClass('fa-eye');
        el.toggleClass('fa-eye-slash');

    }
}