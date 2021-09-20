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

    $("#btn-iniciar-consulta").on("click",function(){
        
        var motivo = $("#start_consultaMotivo").val();
        data = {
            'id_paciente': id_p,
            'motivo' : motivo
        }

        $.ajax({
            url:  base_url + 'megasalud/PatientsController/start_consulta',
            type:  'post',
            data: data,
            success: function(respuesta){
                let json = JSON.parse(respuesta);
                $("#btn-iniciarConsulta").hide();
                $("#btn-terminar-consulta").show();
                $("#start_consulta").modal("hide");
                $("#btn-terminar-consulta").attr("data-id",json.id);

                $("#btn-terminar-consulta2").show();
                $("#btn-terminar-consulta2").attr("data-id",json.id);
                
            }
        });

    });


    $("#btn-terminar-consulta, #btn-terminar-consulta2").on("click",function(){
        data = {
            'id_paciente': id_p,
            'id_consulta' : $(this).attr("data-id")
        }

        $.ajax({
            url:  base_url + 'megasalud/PatientsController/stop_consulta',
            type:  'post',
            data: data,
            success: function(respuesta){
                iziToast.success({
                    timeout: 3000,
                    title: 'Éxito',
                    position: 'topRight',
                    // target: '.login-message',
                    message: 'Consulta terminada',
                });
                $("#btn-iniciarConsulta").show();
                $("#btn-terminar-consulta").hide();
                $("#btn-terminar-consulta2").hide();
            }
        });
    });

    get_status_consulta();

    function get_status_consulta(){
        data = {
            'id_paciente': id_p
        }

        $.ajax({
            url:  base_url + 'megasalud/PatientsController/get_status_consulta',
            type:  'post',
            data: data,
            success: function(respuesta){
                let json = JSON.parse(respuesta);

                if (json != null){
                    $("#btn-iniciarConsulta").hide();
                    $("#start_consulta").modal("hide");
                    $("#btn-terminar-consulta").show();
                    $("#btn-terminar-consulta").attr("data-id",json.id);
                    $("#btn-terminar-consulta2").show();
                    $("#btn-terminar-consulta2").attr("data-id",json.id);
    
                }
            
                
            }
        });
    }


