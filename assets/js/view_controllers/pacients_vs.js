Pace.on('done', function(){
	init();
});

  $('#inicia_consulta').validate({
        
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/inicia_consulta',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        Cookies.set('message', { type: 'success', message: 'Iniciando consulta...'});
                        location.reload();
                       $("#primera_vez").show();
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Error al iniciar el historial',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        
		}
	});

function init(){
    var id = 0;
    
    var table = $('#main-table').DataTable({
		fixedHeader: true,
        scrollY: true,
        columnDefs: [{
            className: 'clipboard',targets: 1,
            className: 'mayus',targets: 2
        },
        { responsivePriority: 1, targets: 1 },
		{ responsivePriority: 2, targets: 4 },
		{ responsivePriority: 3, targets: 2 },
		{ targets: [ 0 ], visible: false }
        ],
		order: [ 0, 'des' ],
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
			text: 'Nuevo Paciente',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'pacientes/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
        ajax:{
            type:"post",
            url: base_url + "pacientes/getxMxQ",
        },
        
        columns:[
            
            {"data":"id"},
            {"data":"clave_bancaria"},
            {"data":"nombre"},
            {"data":"email"},
            {"data":"estado"},
            {"data":"telefono_a"},
            {"defaultContent":"<button id='btn-historia' class='btn-historia btn btn-sm btn-info '><i class='fa fa-file-text-o'></i></button><button id='btn-editar' class='btn-editar btn btn-sm btn-warning '><i class='fa fa-edit'></i></button>"}
        ],
	});
    
    $("#main-table").on("click", "#btn-historia", function(){
        var data = table.row( $(this).parents("tr") ).data();
        window.location.href = base_url + "pacientes/historia/" + data.id;
        
      });
    
    $("#main-table").on("click", "#btn-editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        window.location.href = base_url + "pacientes/editar/" + data.id;
            
      });
    
    $('#main-table').on('click', 'tbody tr td', function () {
        var data = table.row( $(this).parents("tr") ).data();
                iziToast.info({
                                timeout: 2000,
                                title: 'Copiado',
                                position: 'center',
                                message: ''+ data.clave_bancaria,
                            });
        var aux = document.createElement("input");
        aux.setAttribute("value", data.clave_bancaria);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand('copy');
        aux.setAttribute("type", "hidden");

        });

    var table2 = $('#his_table').DataTable({
        scrollY: true,
		fixedHeader: true,
         searching: false,
		columnDefs: [{
            orderable: false,
            targets:   [6],
        },
        { targets: [0], visible: false }
        ],
        ajax:{
            type:"post",
            url: base_url + 'megasalud/PatientsController/his_citas',
        },
        
        columns:[
            {"data":"id"},
            {"data":"created_at"},
            {"data":"clave_bancaria"},
            {"data":"nombre"},
            {"data":"telefono_a"},
            {"data":"motivo"},
            {"defaultContent":"<button id='btn-historia-2' class='btn-historia-2 btn btn-sm btn-info '><i class='fa fa-file-text-o'></i></button>"}
        ],
		order: [ 1, 'desc' ],
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
		}
	});
    
    $("#his_table").on("click", "#btn-historia-2", function(){
        var data = table2.row( $(this).parents("tr") ).data();
        window.location.href = base_url + "pacientes/historia/" + data.id;
        
      });
    
    var table3 = $('#his_table2').DataTable({
        scrollY: true,
		columnDefs: [{
            orderable: false,
            targets:   [7],
        },
        { targets: [0], visible: false }
        ],
        ajax:{
            type:"post",
            url:  base_url + 'megasalud/PatientsController/his_citas2',
        },
        
        columns:[
            {"data":"id"},
            {"data":"created_at"},
            {"data":"clave_bancaria"},
            {"data":"nombre_p"},
            {"data":"telefono_a"},
            {"data":"motivo"},
            {"data":"nombre"},
            {"data":"razon_social"},
            {"defaultContent":"<button id='btn-historia-3' class='btn-historia-3 btn btn-sm btn-info '><i class='fa fa-file-text-o'></i></button>"}
        ],
		order: [ 1, 'desc' ],
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
		}
	});
    
    $("#his_table2").on("click", "#btn-historia-3", function(){
        var dato = table3.row( $(this).parents("tr") ).data();
        window.location.href = base_url + "pacientes/historia/" + dato.id;
        
      });

    // recibir inmunizaciones para mandarlas a la BD    
	$('#new_app1, #edit_office_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/save',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Datos guardados correctamente'});
						window.location.href = base_url + "pacientes/historia";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo el antecedente.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
    
    $('#agregar_estudio').validate({
		submitHandler: function(form) {
            
            var formData = new FormData($("#agregar_estudio")[0]);
			
            $.ajax({
				url:  base_url + 'megasalud/PatientsController/agregar_estudio',
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
						    message: 'Estudio Guardado.',
						});
                        document.getElementById("title_estudio").value = "";
                        document.getElementById("fecha_estudio").value = "";
                        document.getElementById("estudio_sbr").value = "";  
                    }else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se cargo el estudio. La imagen es muy pesada o no se admite ese tipo de archivos',
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
    
    $('#nueva-cita').validate({
		submitHandler: function(form) {
            
            var formData = new FormData($("#nueva-cita")[0]);
			
            $.ajax({
				url:  base_url + 'megasalud/PatientsController/generar_cita',
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
						    message: 'Cita Generada.',
						});  
                    }else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo crear la cita.',
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
    
    $('#agregar_foto').validate({
		submitHandler: function(form) {
            
            var formData = new FormData($("#agregar_foto")[0]);
			
            $.ajax({
				url:  base_url + 'megasalud/PatientsController/agregar_foto',
				type:  'post',
				data: formData,
                cache:false,
                contentType:false,
                processData:false,
                
				success: function(respuesta){
                    console.log(respuesta);
                    if(respuesta){
                    var response = JSON.parse(respuesta);
					if(response.error == false){
						Cookies.set('message', { type: 'success', message: 'Imagen actualizada'});
                        
                         document.getElementById("foto_sbr").value = "";
                       
					}
					else{
						Cookies.set('message', { type: 'error', message: 'Imagen no soportada'});
					}
                    location.reload();
                    }
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});

    $('#new_enf_cong').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/save',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Datos guardados correctamente'});
                        
                        var res = JSON.parse(respuesta);
                        
                        var data = '<tr><td>#</td><td>'+res.enfermedad+'</td><td>'+res.manejo+'</td><td>'+res.medicamento+'</td><td>'+res.edad+'</td><td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td></tr>';
                        $('#info').append(data);
                        
                         iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Antecedente Guardado.',
						});
                        
                        document.getElementById("enfermedad").value = "";
                         document.getElementById("medicamento").value = "";
                         document.getElementById("manejo").value = "";
                         document.getElementById("edad").value = "";
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo el antecedente.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    
    $('#notas_dr').validate({
        
		submitHandler: function(form) {
             var new_nota = document.getElementById("notas_input").value;
       
            if (new_nota == ""){
                alert("Escribe algo");
            }else{ 
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/notas_dr',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
                    console.log(respuesta);
					if(respuesta){
                        
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Nota Guardada.',
						});
                        
                        var res = JSON.parse(respuesta);
                         document.getElementById("text_notas").value += "(Hoy) \n" + new_nota + "";
                        
                        document.getElementById("notas_input").value = "";
                        
                        var h1 = $('#text_notas')[0].scrollHeight,
                            h2 = $('#text_notas').height();

                            $('#text_notas').scrollTop(h1 - h2);
        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la nota',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
            }
        
		}
	});
    
    $('#diagnostico_dr').validate({
        
		submitHandler: function(form) {
             var new_diag = document.getElementById("diagnostico_input").value;
       
            if (new_diag == ""){
                alert("Escribe algo");
            }else{ 
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/diagnostico_dr',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
                    console.log(respuesta);
					if(respuesta){
                        
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Diagnóstico Guardado.',
						});
                        
                        var res = JSON.parse(respuesta);
                         document.getElementById("text_diag").value += "(Hoy) \n" + new_diag + "";
                        
                        document.getElementById("diagnostico_input").value = "";
                        
                        var h1 = $('#text_diag')[0].scrollHeight,
                            h2 = $('#text_diag').height();

                            $('#text_diag').scrollTop(h1 - h2);
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo el diagnóstico',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
            }
        
		}
	});
    
    $('#form-medi').validate({      
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/save_hisclinic_medi',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Medicamento guardado.',
						});
                        
                        var res = JSON.parse(respuesta);
                        $("#divLinea").load(" #divLinea");
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se guardo el medicamento',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        
		}
	}); 
    
    $('#form-terapia').validate({      
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/save_hisclinic_terapia',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Terapia Guardada.',
						});
                        
                        var res = JSON.parse(respuesta);
                        $("#divLinea").load(" #divLinea");
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se guardo la terapia',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        
		}
	});
    
    $('#carga_heredo_in').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/carga_heredo_in',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Carga Hereditaria Guardada.',
						});
                    
                         document.getElementById("padecimiento").value = "";
                         document.getElementById("familiar_heredo").value = "";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    
    $('#ante_in').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/ante_in',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Antecedente Guardado.',
						});
                        
                        document.getElementById("familiar_ante").value = "";
                         document.getElementById("antecedente_heredo").value = "";
                         document.getElementById("descripcion").value = "";
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo.',
						});
					}
				},
				error:  function(xhr,err){ 
					
				}
			});
		}
	});
    
    $('#form_vacuna').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/vacuna',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                       
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Vacuna Guardada.',
						});
                        
                        document.getElementById("vacuna").value = "";
                         document.getElementById("descripcion_vac").value = "";
                         document.getElementById("edad_vacuna").value =0;
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la vacuna.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
    
    $('#alergia').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/alergia',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                         iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Alergia Guardada.',
						});
                        
                        document.getElementById("alergeno").value = "";
                        document.getElementById("tratamiento_ale").value = "";
                        document.getElementById("edad_ale").value = "";
                        document.getElementById("edad_ale").value = "";
                        document.getElementById("med_op").value = "";
                        
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la inmunizacion.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
    
    $('#hospitalizacion').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/hospitalizaciones',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Hospitalización Guardada.',
						});
                        
                         document.getElementById("causa_h").value = "";
                         document.getElementById("operacion_h").value = "No";
                         document.getElementById("tipo_ane").value = "No";
                         document.getElementById("tipo_trans").value = "No";
                         document.getElementById("tipo_prot").value = "No";
                         document.getElementById("comp_h").value = "";
                         document.getElementById("manejo_h").value = "";
                         document.getElementById("med_h").value = "";
                         document.getElementById("edad_h").value = "";
                        
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la hospitalizacion.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    
    //Datos de enfermedades infectocontagiosas
    
    $('#enf_infecto_virus').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/enf_virus',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Virus Guardado.',
						});
                        
                        document.getElementById("enf_virus").value = "";
                         document.getElementById("manejo_virus").value = "";
                         document.getElementById("med_virus").value = "";
                         document.getElementById("edad_virus").value = "";
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la inmunizacion.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
    
    $('#enf_infecto_bacterias').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/enf_bacterias',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Bacteria Guardada.',
						});
                        
                         document.getElementById("enf_bac").value = "";
                         document.getElementById("manejo_bac").value = "";
                         document.getElementById("med_bac").value = "";
                         document.getElementById("edad_bac").value = "";
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la inmunizacion.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});

    $('#enf_infecto_hongos').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/enf_hongos',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){

                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Hongo Guardado.',
						});
                        
                         document.getElementById("enf_hongo").value = "";
                         document.getElementById("manejo_hongo").value = "";
                         document.getElementById("med_hongo").value = "";
                         document.getElementById("edad_hongo").value = "";
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la inmunizacion.',
						});
					}
				},
				error:  function(xhr,err){ 
				
				}
			});
		}
	});
    
    $('#enf_infecto_parasitos').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/enf_parasitos',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Parasito Guardado.',
						});
                        
                         document.getElementById("enf_para").value = "";
                         document.getElementById("manejo_para").value = "";
                         document.getElementById("med_para").value = "";
                         document.getElementById("edad_para").value = "";
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la inmunizacion.',
						});
					}
				},
				error:  function(xhr,err){ 
					
				}
			});
		}
	});
    
    $('#enf_infecto_psicologicas').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/enf_psicologica',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
 
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Psicologica Guardada.',
						});
                        
                         document.getElementById("enf_psico").value = "";                       
                         document.getElementById("manejo_psico").value = "";
                         document.getElementById("med_psico").value = "";
                         document.getElementById("edad_psico").value = "";
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la inmunizacion.',
						});
					}
				},
				error:  function(xhr,err){ 
					
				}
			});
		}
	});
    
    $('#enf_infecto_otras').validate({
		submitHandler: function(form) {
            //console.log('Submit');
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/enf_otras',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Datos guardados correctamente'});
     
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Datos Guardados.',
						});
                        
                         document.getElementById("enf_otras").value = "";
                        document.getElementById("manejo_otras").value = "";
                         document.getElementById("med_otras").value = "";
                         document.getElementById("edad_otras").value = "";
                        $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo la inmunizacion.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	}); 
    
    $('#edit_pacient_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url: base_url + 'megasalud/PatientsController/updateEntry',
				type: 'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
						Cookies.set('message', { type: 'success', message: 'Datos actualizados correctamente'});
                        
                        window.location.href = base_url + "pacientes";
                        
					}

					form.reset();
					window.scrollTo(0, 0);
				}
			});
		}
	});
    
     //Al seleccionar otro
    $('#motivo, #motivo_m').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-m").hidden = false;
           
        }else{
             document.getElementById("panel-add-m").hidden = true;
        }
    });
    
    $('#enfermedad').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-ec").hidden = false;
           
        }else{
             document.getElementById("panel-add-ec").hidden = true;
        }
    }); 
    
    $('#medicamento').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-med").hidden = false;
           
        }else{
             document.getElementById("panel-add-med").hidden = true;
        }
    });
    
    $('#p_medicamento').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-med").hidden = false;
           
        }else{
             document.getElementById("panel-add-med").hidden = true;
        }
    }); 
    
    $('#terapia').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-ter").hidden = false;
           
        }else{
             document.getElementById("panel-add-ter").hidden = true;
        }
    }); 
    
    $('#vacuna').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-v").hidden = false;
           
        }else{
             document.getElementById("panel-add-v").hidden = true;
        }
    });
    
    $('#alergeno').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-a").hidden = false;
            document.getElementById("panel-add-ma").hidden = true;
           
        }
        else if($(this).find(":selected").val() == "Medicamento"){
            document.getElementById("panel-add-a").hidden = true;
            document.getElementById("panel-add-ma").hidden = false;
            document.getElementById("panel-add-ma").innerHTML = "<input class='form-control' placeholder='¿Cuál medicamento?' name='med_op' id='med_op' />";
           
        }else{
             document.getElementById("panel-add-a").hidden = true;
             document.getElementById("panel-add-ma").hidden = true;
        }
    });
    
    $('#tratamiento_ale').on('change',function(){
        if($(this).find(":selected").val() == "Otro"){
            document.getElementById("panel-add-a-trat").hidden = false;
           
        }else{
             document.getElementById("panel-add-a-trat").hidden = true;
        }
    });
    
    $('#causa_h').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-causa_h").hidden = false;
           
        }else{
             document.getElementById("panel-add-causa_h").hidden = true;
        }
    });
    
    $('#med_h').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-med_h").hidden = false;
           
        }else{
             document.getElementById("panel-add-med_h").hidden = true;
        }
    });
    
    $('#operacion_h').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-ope").hidden = false;
           
        }else{
             document.getElementById("panel-add-ope").hidden = true;
        }
    });
    
    $('#tipo_ane').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-ane").hidden = false;
           
        }else{
             document.getElementById("panel-add-ane").hidden = true;
        }
    }); 
    
    $('#tipo_trans').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-trans").hidden = false;
           
        }else{
             document.getElementById("panel-add-trans").hidden = true;
        }
    });
    
    $('#tipo_prot').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-prot").hidden = false;
           
        }else{
             document.getElementById("panel-add-prot").hidden = true;
        }
    });
    
    $('#tipo_prot').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-prot").hidden = false;
           
        }else{
             document.getElementById("panel-add-prot").hidden = true;
        }
    });
    
    $('#enf_virus').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-vi").hidden = false;
           
        }else{
             document.getElementById("panel-add-vi").hidden = true;
        }
    }); 
    
    $('#med_virus').on('change',function(){
        if($(this).find(":selected").val() == "Otro"){
            document.getElementById("panel-add-med_virus").hidden = false;
           
        }else{
             document.getElementById("panel-add-med_virus").hidden = true;
        }
    });
    
    $('#enf_bac').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-bac").hidden = false;
           
        }else{
             document.getElementById("panel-add-bac").hidden = true;
        }
    }); 
    
    $('#med_bac').on('change',function(){
        if($(this).find(":selected").val() == "Otro"){
            document.getElementById("panel-add-med_bac").hidden = false;
           
        }else{
             document.getElementById("panel-add-med_bac").hidden = true;
        }
    });
    
    $('#enf_hongo').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-hongo").hidden = false;
           
        }else{
             document.getElementById("panel-add-hongo").hidden = true;
        }
    });
    
    $('#med_hongo').on('change',function(){
        if($(this).find(":selected").val() == "Otro"){
            document.getElementById("panel-add-med_ho").hidden = false;
           
        }else{
             document.getElementById("panel-add-med_ho").hidden = true;
        }
    });
    
    $('#enf_para').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-enf_para").hidden = false;
           
        }else{
             document.getElementById("panel-add-enf_para").hidden = true;
        }
    });
    
    $('#med_para').on('change',function(){
        if($(this).find(":selected").val() == "Otro"){
            document.getElementById("panel-add-med_pa").hidden = false;
           
        }else{
             document.getElementById("panel-add-med_pa").hidden = true;
        }
    });
    
    $('#enf_psico').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-psico").hidden = false;
           
        }else{
             document.getElementById("panel-add-psico").hidden = true;
        }
    });
    
    $('#med_psico').on('change',function(){
        if($(this).find(":selected").val() == "Otro"){
            document.getElementById("panel-add-med_ps").hidden = false;
           
        }else{
             document.getElementById("panel-add-med_ps").hidden = true;
        }
    });
    
    $('#enf_otras').on('change',function(){
        if($(this).find(":selected").val() == "Otra"){
            document.getElementById("panel-add-otras").hidden = false;
           
        }else{
             document.getElementById("panel-add-otras").hidden = true;
        }
    });
    
    $('#med_otras').on('change',function(){
        if($(this).find(":selected").val() == "Otro"){
            document.getElementById("panel-add-med_otras").hidden = false;
           
        }else{
             document.getElementById("panel-add-med_otras").hidden = true;
        }
    });
    
    $('#addSet').on('show.bs.modal', function(e) { 
         
        var id = $(e.relatedTarget).data().id;
        $("#input_id").val(""+id);
         
        });
    
    $('#addSet_form').validate({
            submitHandler: function(form) {
                
                $.ajax({
                    url:  base_url + 'megasalud/PatientsController/addSet',
                    type:  'post',
                    data: $(form).serialize(),
                    success: function(respuesta){
                    if(respuesta){
                    var res = JSON.parse(respuesta);
                        
                        if(res.error != true){
                             iziToast.success({
                            timeout: 3000,
                            title: 'Exito',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'Guardado correctamente.',
                        });
                            switch(res.id){
                                case 1 :
                                    $('#motivo').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    $('#motivo_m').append("<option selected value='"+res.id_m+"' >"+res.dat+"</option>");
                                    break;
                                case 2 :
                                    $('#enfermedad').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;                              
                                case 3 :
                                    $('#medicamento').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    $("#divMedi").load(" #divMedi");
                                    $('#med_h').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    $('#med_virus').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    $('#med_bac').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    $('#med_hongo').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    $('#med_para').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    $('#med_psico').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    $('#med_otras').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 4 :
                                    $('#vacuna').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 5 :
                                    $('#alergeno').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 6 :
                                    $('#tratamiento_ale').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 7 :
                                    $('#causa_h').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 8 :
                                    $('#operacion_h').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 9 :
                                    $('#tipo_ane').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 10 :
                                    $('#tipo_trans').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 11 :
                                    $('#tipo_prot').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 12 :
                                    $('#enf_virus').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break; 
                                case 13 :
                                    $('#enf_bac').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 14 :
                                    $('#enf_hongo').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 15 :
                                    $('#enf_para').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 16 :
                                    $('#enf_psico').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break; 
                                case 17 :
                                    $('#enf_otras').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                                case 18 :
                                    $('#terapia').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");
                                    break;
                            }
                            
                            $("#addSet").modal("hide");
                            $("#dato").val("");
                            
                        
                        }else{
                            iziToast.error({
                                timeout: 3000,
                                title: 'Error',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'No se guardo.',
                            });

                            }
                    } 
                       
                    },
                    error:  function(xhr,err){ 
                       
                    }
                });
            }
        });
    
    //venenos
    
    $('#venenos_p').on('change',function(){
        var clas = $(this).val();
        document.getElementById("panel_vp").hidden=false;
        data = {
            'clas':clas
        };
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/find_venenos',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        
                       
                        $('#vp_clas').empty();
                        $('#vp_clas').append("<option  value='' >Seleccione:</option>");
                        for (var i = 0; i< res.length;i++){
                            
                            $('#vp_clas').append("<option  value='"+res[i].nombre+"' >"+res[i].nombre+"</option>");
                        }
                        $('#vp_clas').append("<option  value='"+clas+"' >Otra</option>");
                        switch(clas){
                            case "B":
                        document.getElementById("name_class").innerHTML="Bebidas: ";
                                break;
                            case "DA":
                        document.getElementById("name_class").innerHTML="Derivados Animales: ";
                                break; 
                            case "FV":
                        document.getElementById("name_class").innerHTML="Frutas y Vegetales: ";
                                break;
                            case "A":
                        document.getElementById("name_class").innerHTML="Aditivos: ";
                                break;
                            case "E":
                        document.getElementById("name_class").innerHTML="Enlatados: ";
                                break;
                        }
                        
                        //$("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    message: '',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        
  
        
    });
    
    $('#venenos_m').on('change',function(){
        var clas = $(this).val();
        document.getElementById("panel_vm").hidden=false;
        
        switch(clas){
            case "M":
                $('#vm_clas').empty();
               
                $('#name_class_m').html("Microbianos");
                $('#vm_clas').append("<option  value='' >Seleccione:</option>");
                $('#vm_clas').append("<option  value='Virus' >Virus</option>");
                $('#vm_clas').append("<option  value='Bacterias' >Bacterias</option>");
                $('#vm_clas').append("<option  value='Hongos' >Hongos</option>");
                $('#vm_clas').append("<option  value='Rickettsia' >Rickettsia</option>");
                $('#vm_clas').append("<option  value='Protosuarios' >Protosuarios</option>");
                break;
            case "NM":
                $('#vm_clas').empty();
                $('#name_class_m').html("No Microbianos");
                $('#vm_clas').append("<option  value='' >Seleccione:</option>");
                $('#vm_clas').append("<option  value='Parasitos' >Parasitos</option>");
                $('#vm_clas').append("<option  value='Moleculas' >Moleculas</option>");
                $('#vm_clas').append("<option  value='Autoantigenos' >Autoantigenos</option>");
                break;
        }
        
    });
    
    $('#venenos_r').on('change',function(){
        var clas = $(this).val();
        document.getElementById("panel_vr").hidden=false;
        
        switch(clas){
            case "I":
                $('#vr_clas').empty();
               
                $('#name_class_r').html("Ionizantes");
                $('#vr_clas').append("<option  value='' >Seleccione:</option>");
                $('#vr_clas').append("<option  value='Electromagnetica' >Electromagnetica</option>");
                $('#vr_clas').append("<option  value='Corpuscular' >Corpuscular</option>");
                $('#vr_clas').append("<option  value='Artificial' >Artificial</option>");
                break;
            case "NI":
                document.getElementById("sub_panel_vr").hidden=true;
                $('#vr_clas').empty();
                $('#name_class_r').html("No Ionizantes");
                data = {
                    'clas':clas
                };
                
                $.ajax({
                        url:  base_url + 'megasalud/PatientsController/find_venenos_r',
                        type:  'post',
                        data: data,
                        success: function(respuesta){
                            if(respuesta){
                                var res = JSON.parse(respuesta);
                                 $('#vr_clas').append("<option  value='' >Seleccione:</option>");
                                 for (var i = 0; i< res.length;i++){
                            
                                    $('#vr_clas').append("<option  value='"+res[i].nombre_v+"' >"+res[i].nombre_v+"</option>");
                                }
                                 $('#vr_clas').append("<option  value='NI' >Otro</option>");
                            }
                        }
                });
               
               
                break;
        }
        
    });
    
    $('#venenos_mp').on('change',function(){
        var clas = $(this).val();
        document.getElementById("panel_vmp").hidden=false;
        
        switch(clas){
            
            case "MP":
                $('#vmp_clas').empty();
                $('#name_class_mp').html("Metales");
                data = {
                    'clas':clas
                };
                
                $.ajax({
                        url:  base_url + 'megasalud/PatientsController/find_venenos_mp',
                        type:  'post',
                        data: data,
                        success: function(respuesta){
                            if(respuesta){
                                var res = JSON.parse(respuesta);
                                 $('#vmp_clas').append("<option  value='' >Seleccione:</option>");
                                 for (var i = 0; i< res.length;i++){
                            
                                    $('#vmp_clas').append("<option  value='"+res[i].nombre_v+"' >"+res[i].nombre_v+"</option>");
                                }
                                 $('#vmp_clas').append("<option  value='NMP' >Otro</option>");
                            }
                        }
                });
               
               
                break;
            case "NMP":
                
                break;
        }
        
    });
    
    $('#vm_clas').on('change',function(){
         
        var clas = $(this).val();
        document.getElementById("sub_panel_vm").hidden=false;
        data = {
            'clas':clas
        };
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/find_venenos_m',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                       
                        $('#sub_vm_clas').empty();
                        $('#sub_vm_clas').append("<option  value='' >Seleccione:</option>");
                        for (var i = 0; i< res.length;i++){
                            
                            $('#sub_vm_clas').append("<option  value='"+res[i].nombre_v+"' >"+res[i].nombre_v+"</option>");
                        }
                        $('#sub_vm_clas').append("<option  value='"+clas+"' >Otra</option>");
                        switch(clas){
                            case "Virus":
                                $('#sub_name_class_m').html("Virus");
                                break;
                            case "Bacterias":
                                $('#sub_name_class_m').html("Bacterias");
                                break; 
                            case "Hongos":
                                $('#sub_name_class_m').html("Hongos");
                                break;
                            case "Rickettsia":
                            $('#sub_name_class_m').html("Rickettsia");
                                break;
                            case "Protosuarios":
                            $('#sub_name_class_m').html("Protosuarios");
                                break;
                            case "Parasitos":
                            $('#sub_name_class_m').html("Parasitos");
                                break;
                            case "Moleculas":
                            $('#sub_name_class_m').html("Moleculas");
                                break;
                            case "Autoantigenos":
                            $('#sub_name_class_m').html("Autoantigenos");
                                break;
                        }
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    message: '',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
         
     });
    
    $('#vr_clas').on('change',function(){
        var html_new = "<input type='hidden' id='table_v' name='table_v' value='t_r' /><input type='hidden' name='name_clasi_r' id='name_clasi_r' /><label>Añade: </label><div><input id='nombre_ven_r' name='nombre_ven_r' class='form-control' type='text' /><button class='btn btn-info btn-sm' type='submit' ><i class='fa fa-save' ></i></button></div>";
        
        var clas = $(this).val();
        switch(clas){
        case "Electromagnetica":
             document.getElementById("sub_panel_vr").hidden=false;
            break;
        case "Corpuscular": 
            
            document.getElementById("sub_panel_vr").hidden=false;
            break; 
        case "Artificial":
             
            document.getElementById("sub_panel_vr").hidden=false;
            break;
        default:
         document.getElementById("sub_panel_vr").disabled=true;
            break;
        }
        
        data = {
            'clas':clas
        };
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/find_venenos_r',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                       
                        $('#sub_vr_clas').empty();
                        $('#sub_vr_clas').append("<option  value='' >Seleccione:</option>");
                        switch(clas){
                            case "Electromagnetica":
                                 for (var i = 0; i< res.length;i++){
                                    $('#sub_vr_clas').append("<option  value='"+res[i].nombre_v+"' >"+res[i].nombre_v+"</option>");
                                } $('#sub_name_class_r').html("Electromagnetica");
                                break;
                            case "Corpuscular": 
                                for (var i = 0; i< res.length;i++){
                                    $('#sub_vr_clas').append("<option  value='"+res[i].nombre_v+"' >"+res[i].nombre_v+"</option>");
                                }
                                $('#sub_name_class_r').html("Corpuscular");
                                break; 
                            case "Artificial":
                                 for (var i = 0; i< res.length;i++){
                                    $('#sub_vr_clas').append("<option  value='"+res[i].nombre_v+"' >"+res[i].nombre_v+"</option>");
                                }
                                $('#sub_name_class_r').html("Artificial");
                                break;
                            case "NI":
                    document.getElementById("form_new_ven_r").innerHTML = html_new;
                    document.getElementById("name_clasi_r").value = clas;
                                break;
                        }
                        $('#sub_vr_clas').append("<option  value='"+clas+"' >Otra</option>");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    message: '',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
         
     });
    
    $('#vp_clas').on('change',function(){
         
         var html_new = "<div id=''><input type='hidden' id='table_v' name='table_v' value='t_v' /><input type='hidden' name='name_clasi' id='name_clasi' /><label>Añade: </label><div><input id='nombre_ven' name='nombre_ven' class='form-control' type='text' /><button class='btn btn-info btn-sm' ><i class='fa fa-save' ></i></button></div></div>";
         
         var clas = $(this).val();
        switch(clas){
            case "B":
                document.getElementById("form_new_ven").innerHTML = html_new;
                document.getElementById("name_clasi").value = clas;
                break;
            case "DA":
                document.getElementById("form_new_ven").innerHTML = html_new;
                document.getElementById("name_clasi").value = clas;
                break;
            case "FV":
                document.getElementById("form_new_ven").innerHTML = html_new;
                document.getElementById("name_clasi").value = clas;
                break;
            case "A":
                document.getElementById("form_new_ven").innerHTML = html_new;
                document.getElementById("name_clasi").value = clas;
                break;
            case "E":
               document.getElementById("form_new_ven").innerHTML = html_new;
                document.getElementById("name_clasi").value = clas;
                break;
        }
         
     });
    
    $('#vmp_clas').on('change',function(){
         
         var html_new = "<div id=''><input type='hidden' id='table_v' name='table_v' value='t_mp' /><input type='hidden' name='name_clasi_mp' id='name_clasi_mp' /><label>Añade: </label><div><input id='nombre_ven_mp' name='nombre_ven_mp' class='form-control' type='text' /><button class='btn btn-info btn-sm' ><i class='fa fa-save' ></i></button></div></div>";
         
         var clas = $(this).val();
        switch(clas){
            case "NMP":
                document.getElementById("form_new_ven_mp").innerHTML = html_new;
                document.getElementById("name_clasi_mp").value = "MP";
                break;
            
        }
         
     });
    
    $('#sub_vm_clas').on('change',function(){
         
         var html_new = "<div id=''><input type='hidden' id='table_v' name='table_v' value='t_m' /><input type='hidden' name='name_clasi_m' id='name_clasi_m' /><label>Añade: </label><div><input id='nombre_ven_m' name='nombre_ven_m' class='form-control' type='text' /><button class='btn btn-info btn-sm' type='submit' ><i class='fa fa-save' ></i></button></div></div>";
         
         var clas = $(this).val();
        switch(clas){
            case "Virus":
                document.getElementById("form_new_ven_m").innerHTML = html_new;
                document.getElementById("name_clasi_m").value = clas;
                break;
            case "Bacterias":
                document.getElementById("form_new_ven_m").innerHTML = html_new;
                document.getElementById("name_clasi_m").value = clas;
                break;
            case "Hongos":
                document.getElementById("form_new_ven_m").innerHTML = html_new;
                document.getElementById("name_clasi_m").value = clas;
                break;
            case "Rickettsia":
                document.getElementById("form_new_ven_m").innerHTML = html_new;
                document.getElementById("name_clasi_m").value = clas;
                break;
            case "Protosuarios":
               document.getElementById("form_new_ven_m").innerHTML = html_new;
                document.getElementById("name_clasi_m").value = clas;
                break;
            case "Parasitos":
               document.getElementById("form_new_ven_m").innerHTML = html_new;
                document.getElementById("name_clasi_m").value = clas;
                break;
            case "Moleculas":
               document.getElementById("form_new_ven_m").innerHTML = html_new;
                document.getElementById("name_clasi_m").value = clas;
                break;
            case "Autoantigenos":
               document.getElementById("form_new_ven_m").innerHTML = html_new;
                document.getElementById("name_clasi_m").value = clas;
                break;
        }
         
     });
    
    $('#sub_vr_clas').on('change',function(){
         
         var html_new = "<input type='hidden' id='table_v' name='table_v' value='t_r' /><input type='hidden' name='name_clasi_r' id='name_clasi_r' /><label>Añade: </label><div><input id='nombre_ven_r' name='nombre_ven_r' class='form-control' type='text' /><button class='btn btn-info btn-sm' type='submit' ><i class='fa fa-save' ></i></button></div>";
         
         var clas = $(this).val();
        switch(clas){
            case "Electromagnetica":
                document.getElementById("form_new_ven_r").innerHTML = html_new;
                document.getElementById("name_clasi_r").value = clas;
                break;
            case "Corpuscular":
                document.getElementById("form_new_ven_r").innerHTML = html_new;
                document.getElementById("name_clasi_r").value = clas;
                break;
            case "Artificial":
                document.getElementById("form_new_ven_r").innerHTML = html_new;
                document.getElementById("name_clasi_r").value = clas;
                break;
            
        }
         
     });
    
    $('#form_new_ven').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/save_veneno',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
                    
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        
                        $('#vp_clas').append("<option selected value='"+res.nombre+"' >"+res.nombre+"</option>");
						
                        if(document.getElementById("nombre_ven")){
                          document.getElementById("nombre_ven").value = "";  
                        }
                        
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Nuevo guardado.',
						});
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se guardo.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	}); 
    
    $('#form_new_ven_m').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/save_veneno',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
                    
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        
                        $('#sub_vm_clas').append("<option selected value='"+res.nombre_v+"' >"+res.nombre_v+"</option>");
						
                        if (document.getElementById("nombre_ven_m")){
                           document.getElementById("nombre_ven_m").value = ""; 
                        }
                        
                        
                        
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Nuevo guardado.',
						});
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se guardo.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
    
    $('#form_new_ven_r').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/save_veneno',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
                    
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        
                        $('#sub_vr_clas').append("<option selected value='"+res.nombre_v+"' >"+res.nombre_v+"</option>");
                        
		              if (document.getElementById("nombre_ven_r")){
                           document.getElementById("nombre_ven_r").value = ""; 
                        }
                        if(res.clasificacion == "NI"){
                            $('#vr_clas').append("<option selected value='"+res.nombre_v+"' >"+res.nombre_v+"</option>");
                        }
                        
                        
                        
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Nuevo guardado.',
						});
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se guardo.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
    
    $('#form_new_ven_mp').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/save_veneno',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        $('#vmp_clas').append("<option selected value='"+res.nombre_v+"' >"+res.nombre_v+"</option>");
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Nuevo guardado.',
						});
                        
                        document.getElementById("nombre_ven_mp").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se guardo.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
    
    $('.btn_save_vp').click(function(){
        
        var id_paciente = $('#id_paciente').val();
        var clas = $('#venenos_p').val();
        var nombre_v = $('#vp_clas').val();
        var edad_vp = $('#edad_vp').val();
        var anio = $('#anio').val();
        
    if(clas == "" || nombre_v =="" || edad_vp == ""){
        
        iziToast.warning({
                timeout: 3000,
                title: 'Error',
                position: 'topRight',
                // target: '.login-message',
                message: 'Añade todos los datos.',
            });
       }else{
             
        var data = {
            'id_paciente': id_paciente,
            'clasificacion': clas,
            'nombre_v':nombre_v,
            'edad_vp':edad_vp,
            'anio':anio
        };
        
       $.ajax({
				url:  base_url + 'megasalud/PatientsController/save_hisclinic_vp',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        console.log(res);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Guardado correctamente.',
						});
                        
                    $('#venenos_p').val("");
                    $('#vp_clas').val("");
                        
                    $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Hubo un problema.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        }
    });
    
    $('.btn_save_vm').click(function(){
        
        var id_paciente = $('#id_paciente').val();
        var clas = $('#venenos_m').val();
        var subclas = $('#vm_clas').val();
        var nombre_v = $('#sub_vm_clas').val();
        var edad_vm = $('#edad_vm').val();
        var anio = $('#anio').val();
        
    if(clas == "" || nombre_v =="" || subclas == "" || edad_vm == ""){
        
        iziToast.warning({
                timeout: 3000,
                title: 'Error',
                position: 'topRight',
                // target: '.login-message',
                message: 'Añade todos los datos.',
            });
       }else{
             
        var data = {
            'id_paciente': id_paciente,
            'clasificacion': clas,
            'subclas': subclas,
            'nombre_v':nombre_v,
            'edad_vm':edad_vm,
            'anio':anio
        };
        
       $.ajax({
				url:  base_url + 'megasalud/PatientsController/save_hisclinic_vm',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Guardado correctamente.',
						});
                        
                    $('#venenos_m').val("");
                    $('#vm_clas').val("");
                    $('#sub_vm_clas').val("");
                        
                    $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Hubo un problema.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        }
    });
    
    $('.btn_save_vr').click(function(){
        
        var id_paciente = $('#id_paciente').val();
        var clas = $('#venenos_r').val();
        var edad_vr = $('#edad_vr').val();
        var anio = $('#anio').val();
        
        if(clas == "NI"){
             nombre_v = $('#vr_clas').val();
            subclas =".";
            
        }else{
           subclas = $('#vr_clas').val();
            nombre_v = $('#sub_vr_clas').val();
            
        }
        
    if(clas == "" || subclas == "" || edad_vm == ""){
        
        iziToast.warning({
                timeout: 3000,
                title: 'Error',
                position: 'topRight',
                // target: '.login-message',
                message: 'Añade todos los datos.',
            });
       }else{
             
        var data = {
            'id_paciente': id_paciente,
            'clasificacion': clas,
            'subclas': subclas,
            'nombre_v':nombre_v,
            'edad_vr':edad_vr,
            'anio':anio
        };
       $.ajax({
				url:  base_url + 'megasalud/PatientsController/save_hisclinic_vr',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Guardado correctamente.',
						});
                        
                    $('#venenos_r').val("");
                    $('#vr_clas').val("");
                    $('#sub_vr_clas').val("");
                        
                    $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Hubo un problema.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        }
    }); 
    
    $('.btn_save_vmp').click(function(){
        
        var id_paciente = $('#id_paciente').val();
        var clas = $('#venenos_mp').val();
        var edad_vmp = $('#edad_vmp').val();
        var nombre_v = $('#vmp_clas').val();
        var anio = $('#anio').val();
        
        
    if(clas == "" || nombre_v == "" || edad_vm == ""){
        
        iziToast.warning({
                timeout: 3000,
                title: 'Error',
                position: 'topRight',
                // target: '.login-message',
                message: 'Añade todos los datos.',
            });
       }else{
             
        var data = {
            'id_paciente': id_paciente,
            'clasificacion': clas,
            'nombre_v':nombre_v,
            'edad_vmp':edad_vmp,
            'anio':anio
        };
       $.ajax({
				url:  base_url + 'megasalud/PatientsController/save_hisclinic_vmp',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Guardado correctamente.',
						});
                        
                    $('#venenos_mp').val("");
                    $('#vmp_clas').val("");
                        
                    $("#divLinea").load(" #divLinea");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Hubo un problema.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        }
    });
    
    //vista de panel de los antecedentes
    
    $('#btn-heredo').click(function(){
        if($(this).attr("data") == 1){
            
            $(this).addClass("active");
            $('#p-heredo').show();
            $(this).attr("data",0);
            
        }else{
            $(this).removeClass("active");
            $('#p-heredo').hide();
            $(this).attr("data",1);
        }
        
    });
    
    $('#btn-pato').click(function(){
        if($(this).attr("data") == 1){
            
            $(this).addClass("active");
            $('#p-pato').show();
            $(this).attr("data",0);
            
        }else{
            $(this).removeClass("active");
            $('#p-pato').hide();
            $(this).attr("data",1);
        }
        
    });
    
    $('#btn-npato').click(function(){
        if($(this).attr("data") == 1){
            
            $(this).addClass("active");
            $('#p-npato').show();
            $(this).attr("data",0);
            
        }else{
            $(this).removeClass("active");
            $('#p-npato').hide();
            $(this).attr("data",1);
        }
        
    });
    
    //Clasificacion a venenos
    
    $('#btn-micro').click(function(){            
        
        $('#nombre_c').html("<h4>Microbios</h4>");
        
        $("#clas_a").html("");
        
        $("#clas_a").append("<button class='btn btn-sm btn-teal' onclick='get_c_b(this)' data-value='Biologicos' >Biologicos</button>");
        
        $("#clas_b").html("");
        $("#clas_c").html("");
        $("#clas_d").html("");
        $("#clas_e").html("");
        $("#clas_f").html("");
        $("#clas_g").html("");
        $("#clas_h").html("");
        $("#clas_v").html("");
        $("#c_b").hide();
        $("#c_c").hide();
        $("#c_d").hide();
        $("#c_e").hide();
        $("#c_f").hide();
        $("#c_g").hide();
        $("#c_h").hide();
        $("#c_v").hide();
    });
    
    $('#btn-venenos').click(function(){
        
        $('#nombre_c').html("<h4>No Biologicos | Microondas | Agrícolas | Industriales | Riesgos Caseros | Animales, Plantas y Hongos</h4>");
        
        $("#clas_a").html("");
        
        $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='No Biologicos' >No Biologicos</button>");
        
        $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Microondas' >Microondas</button>");
        $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Agricolas' >Agricolas</button>");
        $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Industriales' >Industriales</button>");
        $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Caseros' >Riesgos Caseros</button>");
        $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Animales' >Animales,<br> Plantas y Hongos</button>");
        $("#clas_b").html("");
        $("#clas_c").html("");
        $("#clas_d").html("");
        $("#clas_e").html("");
        $("#clas_f").html("");
        $("#clas_g").html("");
        $("#clas_h").html("");
        $("#clas_v").html("");
        $("#c_b").hide();
        $("#c_c").hide();
        $("#c_d").hide();
        $("#c_e").hide();
        $("#c_f").hide();
        $("#c_g").hide();
        $("#c_h").hide();
        $("#c_v").hide();
    });
    
    $('#btn-radiaciones').click(function(){
        
    });
                                
                                
    $('#btn-metales').click(function(){
        
    });
    
    
    }

    var clasis = {
            'c_a' : ""
        }

    function get_c_b(elemento){
       
        
    if( $('.btn-a').hasClass('active') ){
            $('.btn-a').removeClass("active");
        }else{
            elemento.className += " active";
        }
        
        $("#clas_c").html("");
        $("#clas_d").html("");
        $("#clas_e").html("");
        $("#clas_f").html("");
        $("#clas_g").html("");
        $("#clas_h").html("");
        $("#clas_v").html("");
        $("#c_b").show();
        $("#c_c").hide();
        $("#c_d").hide();
        $("#c_e").hide();
        $("#c_f").hide();
        $("#c_g").hide();
        $("#c_h").hide();
        $("#c_v").hide();
        
       elemento.className += ' active';
        
       $("#clas_b").html("");
       var c = elemento.dataset.value;
        
        
        clasis["c_a"] = c;
        clasis["c_b"] = "0";
        clasis["c_c"] = "0";
        clasis["c_d"] = "0";
        clasis["c_e"] = "0";
        clasis["c_f"] = "0";
        clasis["c_g"] = "0";
        clasis["c_h"] = "0";
        
       var data = {
            "clas" : c,
           "clasi": "c_b",
           "clasi_an":"c_a",
           "clasis":clasis
        };
        
        $.ajax({
            url:  base_url + 'megasalud/PatientsController/get_c',
            type:  'post',
            data: data,
            beforeSend:function(){
                    $("#loader").show();
                },
                complete: function(){
                    $("#loader").hide();
                },
            success: function(respuesta){
                if(respuesta){
                    var res = JSON.parse(respuesta);
                    var data = res.data;
                    var l = data.length;
                    for (x = 0; x < l; x++){
                        if(data[x].c_b == 0){
                            $("#clas_b").append("<b>No hay</b>");
                            get_v(c,"c_a");
                        }else{
                            $("#clas_b").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-b' onclick='get_c_c(this)' data-value='"+data[x].c_b+"' >"+data[x].c_b+"</button><br>"); 
                        }
                    }
                }
                else{
                }
            }
		});
    }

    function get_c_c(elemento){
        
        if( $('.btn-b').hasClass('active') ){
            $('.btn-b').removeClass("active");
        }else{
            elemento.className += " active";
        }
        elemento.className += " active";
        $("#clas_d").html("");
        $("#clas_e").html("");
        $("#clas_f").html("");
        $("#clas_g").html("");
        $("#clas_h").html("");
        $("#clas_c").html("");
        $("#clas_v").html("");
        $("#c_c").show();
        $("#c_d").hide();
        $("#c_e").hide();
        $("#c_f").hide();
        $("#c_g").hide();
        $("#c_h").hide();
        $("#c_v").hide();
       var c = elemento.dataset.value;
        clasis["c_b"] = c;
        clasis["c_c"] = "0";
        clasis["c_d"] = "0";
        clasis["c_e"] = "0";
        clasis["c_f"] = "0";
        clasis["c_g"] = "0";
        clasis["c_h"] = "0";
        
       var data = {
            "clas" : c,
           "clasi": "c_c",
           "clasi_an":"c_b",
           "clasis":clasis
        };
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/get_c',
				type:  'post',
				data: data,
            beforeSend:function(){
                    $("#loader").show();
                },
                complete: function(){
                    $("#loader").hide();
                },
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        
                        for (x = 0; x < l; x++){
                            if(data[x].c_c == 0){
                                $("#clas_c").append("<b>No hay</b>");
                                get_v(c,"c_b");
                            }else{
                            $("#clas_c").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-c' onclick='get_c_d(this)' data-value='"+data[x].c_c+"' >"+data[x].c_c+"</button><br>");
                            }
                        }
					}
					else{
					}
				},
				error:  function(xhr,err){ 
				}
		});
    }

    function get_c_d(elemento){
         if( $('.btn-c').hasClass('active') ){
            $('.btn-c').removeClass("active");
        }else{
            elemento.className += " active";
        }
        elemento.className += " active";
        $("#clas_d").html("");
        $("#clas_e").html("");
        $("#clas_f").html("");
        $("#clas_g").html("");
        $("#clas_h").html("");
        $("#clas_v").html("");
        $("#c_d").show();
        $("#c_e").hide();
        $("#c_f").hide();
        $("#c_g").hide();
        $("#c_h").hide();
        $("#c_v").hide();
       var c = elemento.dataset.value;
        
        clasis["c_c"] = c;
        clasis["c_d"] = "0";
        clasis["c_e"] = "0";
        clasis["c_f"] = "0";
        clasis["c_g"] = "0";
        clasis["c_h"] = "0";
        
       var data = {
            "clas" : c,
           "clasi": "c_d",
           "clasi_an":"c_c",
           "clasis":clasis
        };
        
        
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/get_c',
				type:  'post',
				data: data,
            beforeSend:function(){
                    $("#loader").show();
                },
                complete: function(){
                    $("#loader").hide();
                },
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        
                        for (x = 0; x < l; x++){
                            if(data[x].c_d == 0){
                                $("#clas_d").append("<b>No hay</b>");
                                get_v(c,"c_c");
                            }else{
                            $("#clas_d").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-d' onclick='get_c_e(this)' data-value='"+data[x].c_d+"' >"+data[x].c_d+"</button><br>");
                            }
                        }
					}
					else{
					}
				},
				error:  function(xhr,err){ 
				}
		});
    }

    function get_c_e(elemento){
     if( $('.btn-d').hasClass('active') ){
            $('.btn-d').removeClass("active");
        }else{
            elemento.className += " active";
        }
        elemento.className += " active";
    $("#clas_e").html("");
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_e").show();
    $("#c_f").hide();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();
       var c = elemento.dataset.value;
        
        clasis["c_d"] = c;
        clasis["c_e"] = "0";
        clasis["c_f"] = "0";
        clasis["c_g"] = "0";
        clasis["c_h"] = "0";
       var data = {
            "clas" : c,
           "clasi": "c_e",
           "clasi_an":"c_d",
           "clasis":clasis
        };
        
        
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/get_c',
				type:  'post',
				data: data,
            beforeSend:function(){
                    $("#loader").show();
                },
                complete: function(){
                    $("#loader").hide();
                },
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        
                        for (x = 0; x < l; x++){
                            if(data[x].c_e == 0){
                                $("#clas_e").append("<b>No hay</b>");
                                get_v(c,"c_d");
                            }else{
                            $("#clas_e").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-e' onclick='get_c_f(this)' data-value='"+data[x].c_e+"' >"+data[x].c_e+"</button><br>");
                            }
                        }
					}
					else{
					}
				},
				error:  function(xhr,err){ 
				}
		});
    }

    function get_c_f(elemento){
     if( $('.btn-e').hasClass('active') ){
            $('.btn-e').removeClass("active");
        }else{
            elemento.className += " active";
        }
        elemento.className += " active";
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_f").show();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();
       var c = elemento.dataset.value;
        clasis["c_e"] = c;
        clasis["c_f"] = "0";
        clasis["c_g"] = "0";
        clasis["c_h"] = "0";
       var data = {
            "clas" : c,
           "clasi": "c_f",
           "clasi_an":"c_e",
           "clasis":clasis
        };
    
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/get_c',
				type:  'post',
				data: data,
            beforeSend:function(){
                    $("#loader").show();
                },
                complete: function(){
                    $("#loader").hide();
                },
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        
                        for (x = 0; x < l; x++){
                            if(data[x].c_f == 0){
                                $("#clas_f").append("<b>No hay</b>");
                                get_v(c,"c_e");
                            }else{
                            $("#clas_f").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-f' onclick='get_c_g(this)' data-value='"+data[x].c_f+"' >"+data[x].c_f+"</button><br>");
                            }
                        }
					}
					else{
					}
				},
				error:  function(xhr,err){ 
				}
		});
    }

    function get_c_g(elemento){
     if( $('.btn-f').hasClass('active') ){
            $('.btn-f').removeClass("active");
        }else{
            elemento.className += " active";
        }
        elemento.className += " active";
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_g").show();
    $("#c_h").hide();
    $("#c_v").hide();
       var c = elemento.dataset.value;
        clasis["c_f"] = c;
        clasis["c_g"] = "0";
        clasis["c_h"] = "0";
        
       var data = {
            "clas" : c,
           "clasi": "c_g",
           "clasi_an":"c_f",
           "clasis":clasis
        };
        
        
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/get_c',
				type:  'post',
				data: data,
            beforeSend:function(){
                    $("#loader").show();
                },
                complete: function(){
                    $("#loader").hide();
                },
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        
                        for (x = 0; x < l; x++){
                            if(data[x].c_g == 0){
                                $("#clas_g").append("<b>No hay</b>");
                                get_v(c,"c_f");
                            }else{
                            $("#clas_g").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-g' onclick='get_c_h(this)' data-value='"+data[x].c_g+"' >"+data[x].c_g+"</button><br>");
                            }
                        }
					}
					else{
					}
				},
				error:  function(xhr,err){ 
				}
		});
    }

    function get_c_h(elemento){
         if( $('.btn-g').hasClass('active') ){
            $('.btn-g').removeClass("active");
        }else{
            elemento.className += " active";
        }
        elemento.className += " active";
        $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_h").show();
    $("#c_v").hide();
       var c = elemento.dataset.value;
        
        clasis["c_g"] = c;
        clasis["c_h"] = "0";
       var data = {
            "clas" : c,
           "clasi": "c_h",
           "clasi_an":"c_g",
           "clasis":clasis
        };
        
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/get_c',
				type:  'post',
				data: data,
            beforeSend:function(){
                    $("#loader").show();
                },
                complete: function(){
                    $("#loader").hide();
                },
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        
                        for (x = 0; x < l; x++){
                            if(data[x].c_h == 0){
                                $("#clas_h").append("<b>No hay</b>");
                                get_v(c,"c_g");
                            }else{
                            $("#clas_h").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-h' onclick='get_v(this)' data-value='"+data[x].c_h+"' >"+data[x].c_h+"</button><br>");
                            }
                        }
					}
					else{
					}
				}
		});
    }

    function get_v(elemento,clasi_an){
        if( $('.btn-h').hasClass('active') ){
            $('.btn-h').removeClass("active");
        }else{
            elemento.className += " active";
        }
        elemento.className += " active";
        try{
             c = elemento.dataset.value;
            clasi_an = "c_h";
        }
        catch{
               c = elemento; 
            }
    
    $("#clas_v").html("");
    
    clasis["c_h"] = c;
    $("#c_v").show();
       var data = {
            "clas" : c,
           "clasi": "veneno",
           "clasi_an": clasi_an,
           "clasis":clasis
        };
        
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/get_v',
				type:  'post',
				data: data,
            beforeSend:function(){
                    $("#loader").show();
                },
                complete: function(){
                    $("#loader").hide();
                },
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        for (x = 0; x < l; x++){
                            $("#clas_v").append("<button style='margin-bottom:5px;' onclick='new_veneno(this)' class='btn btn-sm btn-primary'  data-value='"+data[x].id+"' >"+data[x].veneno+"</button><br>");     
                        }
					}
					else{
					}
				},
				error:  function(xhr,err){ 
				}
		});
    }

    function new_veneno(elemento){
        $("#modal_new_veneno").modal("show");
        $("#id_veneno").val(elemento.dataset.value);
        
    }

    function save_new_veneno(anio,id_paciente){
         var data = {
            "id_veneno" : $("#id_veneno").val(),
            "frecc" : $("#frecc").val(),
            "edad_veneno" : $("#edad_veneno").val(),
            "id_paciente" : id_paciente,
            "anio" : anio,
             "clasis":clasis
        };
        
        $.ajax({
				url:  base_url + 'megasalud/PatientsController/new_veneno',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        console.log(res.error);
                        iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Nuevo veneno guardado.',
						});
                        
                       $("#divLinea").load(" #divLinea");
					}
					else{
					}
				}
		});
    }

    function recargarLinea(){
        $("#divLinea").load(" #divLinea");
    }

    function copiarAutoinmune(elemento){

        var enf = elemento.dataset.value;

        document.getElementById("padecimiento").value = enf ;

        //se cierra el modal
        $('#closeModal').click();

        }



