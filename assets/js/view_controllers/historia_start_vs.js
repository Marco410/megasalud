 var id_p = document.getElementById("id_paciente").value;
 var seguim = document.getElementById("seguimiento").value;

    var data = {
        'id' : id_p
    };
    
    $.ajax({
        url:  base_url + 'megasalud/PatientsController/get_suc_p',
        type:  'post',
        data: data,
        success: function(respuesta){
                let json = JSON.parse(respuesta);
				let data = json.data;
            if(json.error){
                
                document.getElementById("sucursal_p").innerHTML = data[0].razon_social;
                
                if (seguim > 0){
                     iziToast.info({
                        timeout: 6000,
                        title: '¡Recuerda!',
                         theme: 'dark',
                         color:'black',
                        position: 'center',
                        // target: '.login-message',
                        message: 'Si es cita subsecuente, comienzala.',
                    });
                
                    document.getElementById("motivo").focus();
                }
            }
            else{
                iziToast.warning({
                    timeout: 8000,
                    title: 'Precaución',
                    position: 'center',
                    // target: '.login-message',
                    message: 'Este paciente no esta registrado en una sucursal. Registralo.',
                });
                $("#panel-sucursales").show();
                $("#sucursal_modal").modal("show");
                document.getElementById("suc_paciente").focus();
            }
        }
    });
    
    $('#insert-suc').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/insert_suc',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Añadido correctamente a una sucursal.'});
                        location.reload();
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se guado',
						});
					}
				}
			});
		}
	});
