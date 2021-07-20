Pace.on('done', function(){
	initi();
});

function initi(){
	
$('#new_agent_form').validate({
		ignore: ".ignore",
		rules: {
			password2: {
				equalTo: "#password"
			},
			email: {
				remote: {
					url: base_url + "megasalud/AuthController/checkEmailAgent",
					type: "post",
					data: {
						email: function() {
							return $( "#email" ).val();
						}
					}
				}
			},
		},
		messages: {
			password2: {
				required: "Ingrese su contraseña nuevamente.",
				equalTo: "La contraseña no coincide."
			},
			email: {
				required: "Ingrese su correo electrónico.",
				remote: "Este correo ya está registrado."
			}
		},
		submitHandler: function(form) {
           
			$.ajax({
				url: base_url + 'megasalud/AgentController/newEntry',
				type: 'post',
				data: $(form).serialize(),
				success: function(respuesta){
                    
					 var response = JSON.parse(respuesta);
					if(response.error != true){
						iziToast.success({
                            title: 'Éxito',
                            message: 'Solicitud creada con éxito, da clic en el siguiente botón para continuar tu proceso',
                             position: 'bottomCenter',
                        });
                         document.getElementById("btn-continuar").innerHTML = "<a class='btn btn-info btn-continuar' href=' "+ base_url +  "representante/archivos/"+response.id_agent + "'  >  <i class='fa fa-files-o'></i> Continuar</a>";   
                        form.reset();
					    window.scrollTo(0, 0);
					}else{
                        iziToast.error({
                            title: 'Error',
                            message: 'No se pudo crear el representante',
                        });
                    }
                        
					
				}
			});
		}
	});
    
    $('#new_files_form').validate({
		submitHandler: function(form) {
            
           var formData = new FormData($("#new_files_form")[0]);
            
			$.ajax({
				url: base_url + 'megasalud/AgentController/agregar_archivos',
				type:  'post',
				data: formData,
                cache:false,
                contentType:false,
                processData:false,
                 beforeSend:function(){
                        $("#loader").show();
                    },
                    complete: function(){
                        $("#loader").hide();
                    },
                
				success: function(respuesta){
                    
				var response = JSON.parse(respuesta);
					if(response.error != true){
						iziToast.success({
                            title: 'Éxito',
                            message: 'Archivos cargados correctamente',
                             position: 'bottomCenter',
                        });
                        form.reset();
					    window.scrollTo(0, 0);
					}else{
                        iziToast.error({
                            title: 'Error',
                            message: 'Ocurrio un error, intentelo de nuevo.',
                        });
                    }
                        
					
				}
			});
		}
	}); 



$('#nombre').keyup(function(){
    $("#nombre_copy").val($(this).val());
});

$('#apellido_p').keyup(function(){
    $("#apellido_p_copy").val($(this).val());
});

$('#apellido_m').keyup(function(){
    $("#apellido_m_copy").val($(this).val());
});
    
}