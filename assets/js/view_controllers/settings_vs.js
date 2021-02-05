Pace.on('done', function(){
	init();
});

function init(){
	let checked = false;

	$('#main-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        },
		{ responsivePriority: 1, targets: 2 },
		{ responsivePriority: 2, targets: 1 },
		{ targets: [ -1 ], orderable: false },
		],
		order: [ 2, 'asc' ],
		language: {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		dom: '<"row" <"col-sm-4" l> <"col-sm-8" <"pull-right ml-15" B><"pull-right" f> > >r<"mt-30" t><"row mt-30" <"col-sm-5" i> <"col-sm-7" p> >',
		buttons: [
		{
			extend: 'excel',
			className: 'btn btn-success',
			exportOptions: {
				columns: ':not(:last-child)',
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		},
		{
			text: 'Nuevo Rol',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'roles/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});
    
    $('#form-video').validate({
		submitHandler: function(form) {
            
            var formData = new FormData($("#form-video")[0]);
			
            $.ajax({
				url:  base_url + 'megasalud/SettingsController/agregar_video',
				type:  'post',
				data: formData,
                cache:false,
                contentType:false,
                processData:false,
                
				success: function(respuesta
                ){
					if(respuesta){
                        var res = JSON.parse(respuesta);
					if(res.error == false){
                      iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Video Guardado.',
						});
                    }else if (res.error == true){
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo cargar el video.'+res.type,
						});
					}
                     
					}
					
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	}); 

    $('#add_motivo_consulta').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_motivo_consulta',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("motivo_consulta").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_enf_cong').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_enf_cong',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("enf_cong").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_medicamento').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_medicamento',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("medicamento").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_vacuna').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_vacuna',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("vacuna").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_alergia').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_alergia',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("alergia").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	}); 
    
    $('#add_trat_alergia').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_trat_alergia',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("trat_ale").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	}); 
    
    
    $('#add_hospi_causa').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_hospi_causa',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("hospi_causa").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_hospi_operacion').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_hospi_operacion',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("hospi_operacion").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_hospi_ane').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_hospi_ane',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("hospi_ane").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	}); $('#add_hospi_trans').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_hospi_trans',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("hospi_trans").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	}); 
    $('#add_hospi_pro').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_hospi_pro',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("hospi_pro").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_enf_bacteria').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_enf_bacteria',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("enf_bacteria").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_enf_hongos').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_enf_hongos',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("enf_hongos").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_enf_parasitos').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_enf_parasitos',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("enf_parasitos").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_enf_psico').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_enf_psico',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("enf_psico").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_enf_otras').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_enf_otras',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("enf_otras").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#add_enf_virus').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/add_enf_virus',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Dato guardado.',
						});
                  document.getElementById("enf_virus").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#update_com_agent').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/update_com',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Actualizado correctamente.',
						});
                  document.getElementById("up_com_agent").innerHTML = res.option_value; document.getElementById("com_agent").value ="";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	}); 
    $('#update_com_user').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/update_com',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Actualizado correctamente.',
						});
                  document.getElementById("up_com_user").innerHTML = res.option_value; document.getElementById("com_user").value ="";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	}); 
    
    $('#update_com_suc').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/SettingsController/update_com',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Actualizado correctamente.',
						});
                  document.getElementById("up_com_suc").innerHTML = res.option_value; document.getElementById("com_suc").value ="";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});

}
