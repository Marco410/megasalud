Pace.on('done', function(){
	initi();
});

function initi(){
	
$('#new_registro_form').validate({
		submitHandler: function(form) {
           
			$.ajax({
				url: base_url + 'megasalud/ProspectosController/newEntry',
				type: 'post',
				data: $(form).serialize(),
				success: function(respuesta){
                    
					 var response = JSON.parse(respuesta);
					if(response.error != true){
						iziToast.success({
                            title: 'Éxito',
                            message: 'Gracias por registrarte con nosostros, en breve nos comunicaremos contigo para asesorarte. ¡Saludos!',
                             position: 'center',
							 timeout: 8000,
                        });
                        form.reset();
					    window.scrollTo(0, 0);
					}else{
                        iziToast.error({
                            title: 'Error',
                            message: 'Tuvimos un problema con tu registro, intenta de nuevo más tarde',
                        });
                    }
                        
					
				}
			});
		}
	});
}
