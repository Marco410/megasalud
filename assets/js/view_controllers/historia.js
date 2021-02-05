Pace.on('done', function(){

	$('#main-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [{
            className: 'control',
            orderable: false,
            targets:   0
        },
		{ responsivePriority: 1, targets: 2 },
		{ responsivePriority: 2, targets: 4 },
		{ responsivePriority: 3, targets: 2 },
		{ targets: [ -1 ], orderable: false },
		{ targets: [ 1, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 16, 17, 18, 19, 20, 21 ], visible: false }
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
			text: 'Nuevo Usuario',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'usuarios/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});

	$('.btn-info-user').click(function(){

		let id = $(this).data('id');

		$.ajax({
			url: base_url + 'megasalud/UsersController/show/' + id,
			success: function(res){
				let json = JSON.parse(res);
				let data = json.data;
				// console.log(res);
				$('.user-name').html(data.nombre + ' ' + data.apellido_p +' '+ data.apellido_m);
				$('.user-tipoUsuario').html(json.type);
				$('#user-email').html(data.email);
				$('#user-curp').html(data.curp);
				$('#user-rfc').html(data.rfc);
				$('#user-nacimiento').html(data.fecha_nacimiento);
				$('#user-sexo').html(data.sexo);
				$('#user-pais').html(data.pais);
				$('#user-estado').html(data.estado);
				$('#user-municipio').html(data.municipio);
				$('#user-direccion').html(data.calle + ' ' + data.colonia);
				$('#user-telefono_a').html(data.telefono_a);
				if( data.telefono_b != '' ){
					$("#user-telefono_a").append(' | '+data.telefono_b);
				}
				$('#user-especialidad').html(data.especialidad);
				$('#user-cedula').html(data.cedula);
				$('#user-cuenta_bancaria').html(data.cuenta_bancaria);
				$('#user-clave_bancaria').html(data.clave_bancaria);
				$('#user-banco').html(data.banco);

				if(json.type != 'Administrador'){
					$("#panel-user-sucursales").show();
					$("#accordion-user-sucursales").html('');
					$.each(json.sucursales, function(i,sucursal){
						$("#accordion-user-sucursales").append("<div class='panel panel-brown'><div class='panel-heading'><h4 class='panel-title text-center'><a data-toggle='collapse' data-parent='#accordion-user-sucursales' href='#sucursal-"+sucursal.id+"'>"+sucursal.razon_social+"</a></h4></div><div id='sucursal-"+sucursal.id+"' class='panel-collapse collapse text-center'><a'><div class='panel-body'> <b>Pais</b><p>"+sucursal.pais+"</p><b>Estado</b><p>"+sucursal.estado+"</p><b>Municipio</b><p>"+sucursal.municipio+"</p><b>Dirección</b><p>"+sucursal.direccion+" "+sucursal.cp+"</p><b>Teléfono</b><p>"+sucursal.telefono+"</p> </div></div>  </div>");
					});
				}else{
					$("#panel-user-sucursales").hide();
				}
				$("#modal-info").modal();
			},
			error: function(res){
				alert($res);
			}
		});

	});

	$('#new_user_form').validate({
		ignore: ".ignore",
		rules: {
			password2: {
				equalTo: "#password"
			},
			email: {
				remote: {
					url: base_url + "megasalud/AuthController/checkEmail",
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
				url: base_url + 'megasalud/UsersController/newEntry',
				type: 'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						alert('Usuario creado');
					}

					form.reset();
					window.scrollTo(0, 0);
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});

});
