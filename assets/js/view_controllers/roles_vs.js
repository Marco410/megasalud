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

	$("#btn-select-all").click(function(){
		
		$(this).text(function(i, text){
			checked = !checked;
			return text === 'Seleccionar todos'? 'Deseleccionar todos': 'Seleccionar todos';
		});

		$(".check-permisos").prop('checked', checked);
	});

	$('#new_role_form').validate({
		rules: {
			name: {
				remote: base_url + 'megasalud/RolesController/verifyRol',
			}
		},
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/RolesController/save',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					// console.log(respuesta);
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Nuevo rol creado.'});
						window.location.href = base_url + "roles";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo guardar el rol.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});

	$('#edit_role_form').validate({
		rules: {
			name: {
				remote: {
					url: base_url + 'megasalud/RolesController/verifyRol',
					data: {
						id: $('#role_id').val(),
					}
				}				
			}
		},
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/RolesController/save',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Rol actualizado correctamente.'});
						window.location.href = base_url + "roles";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo editar el rol.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});

	$('.btn-info').click(function(){

		let id = $(this).data('id');

		$.ajax({
			url: base_url + 'megasalud/RolesController/show/' + id,
			dataType: 'json',
			success: function(res){

				$('#role-name').html(res.rol.name);
				$('#role-display').html(res.rol.display_name);
				$('#role-description').html(res.rol.description);
				$('#role-permission').html(res.permisos.join(' | '));
				
				$("#modal-info").modal();
			},
			error: function(res){
				alert(res);
			}
		});

	});

	$("#role-preset").change(function(){

		let id = $(this).val();

		$.ajax({
			url: base_url + 'megasalud/RolesController/getPermisosByRolId/' + id,
			dataType: 'json',
			success: function(res){

				console.log(res);
				$(".check-permisos").prop('checked', false);
				$.each(res, function(i, val){
					$('[data-id="'+val+'"]').prop('checked', true);
				});
			},
			error: function(res){
				alert(res);
			}
		});
	});

}
