Pace.on('done', function(){
	init();
});

function init(){

	var table = $('#main-table').DataTable({
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
		{ targets: [ 4 ], visible: false}
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
			text: 'Nuevo Permiso',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'permisos/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});

	//initialize de plugin
	$('#new_permission_form').validate({
		rules: {
			name: {
				remote: base_url + 'megasalud/PermisosController/verifyPermission',
			}
		},
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PermisosController/save',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Nuevo permiso creado.'});
						window.location.href = base_url + "permisos";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo guardar el permiso.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});

	$('#edit_permission_form').validate({
		rules: {
			name: {
				remote: {
					url: base_url + 'megasalud/PermisosController/verifyPermission',
					data: {
						id: $('#permission_id').val(),
					}
				}				
			}
		},
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PermisosController/save',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Permiso actualizado correctamente.'});
						window.location.href = base_url + "permisos";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo editar el permiso.',
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
			url: base_url + 'megasalud/PermisosController/show/' + id,
			success: function(res){
				let data = JSON.parse(res);
				// console.log(res);
				$('#permission-name').html(data.name);
				$('#permission-display').html(data.display_name);
				$('#permission-description').html(data.description);
				
				$("#modal-info").modal();
			},
			error: function(res){
				alert(res);
			}
		});

	});

	$('.btn-delete').click(function(){

		let id = $(this).data('id');
		let $row = $(this).parents('tr');
		let confirm = false;

		iziToast.question({
		    timeout: false,
		    close: true,
		    overlay: true,
		    icon: 'fa fa-lock',
		    displayMode: 'once',
		    zindex: 999,
		    closeOnEscape: true,
		    overlayClose: true,
		    title: 'Confirmación',
		    message: 'Ingrese su contraseña de administrador:',
		    position: 'center',
		    buttons: [
		        ['<button class="btn btn-primary"><b>OK</b></button>', function (instance, toast) {

		 			let pass = $('#admin-pass').val();

		 			//si es bueno el pass
		 			checkAdminPass(pass).done(function(response){
		 				
		 				if(response){
		 					$.ajax({
			 					url: base_url + 'megasalud/PermisosController/delete',
			 					type: 'post',
			 					data: 'id='+id,
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Permiso eliminado correctamente',
										});
										confirm = true;
			 						}else{
			 							iziToast.warning({
										    title: 'Fallo',
										    message: 'No se pudo eliminar el permiso',
										});
			 						}
			 					},
			 					error: function(res){
			 						alert(res);
			 					}
			 				});
		 				}else{
		 					iziToast.error({
							    title: 'Error',
							    message: 'Contraseña incorrecta',
							});
		 				}

		 			}).fail(function(error){
		 				iziToast.error({
						    title: 'Error',
						    message: error,
						});
		 			});

		            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
		 
		        }]
		    ],
		    inputs: [
		        ['<input type="password" class="form-control" id="admin-pass"><span class="fa fa-eye form-control-feedback pass-verify" aria-hidden="true" onclick="seePass($(this))"></span>', null, null ,true] //el true es el que le da el focus
		    ],
		    
		    onClosing: function(instance, toast, closedBy){
		        // console.info('Closing | closedBy: ' + closedBy + 'text:' + text);
		    },
		    onClosed: function(instance, toast, closedBy){
		        // console.info('Closed | closedBy: ' + closedBy);
		        if(confirm){
		        	table.row($row).remove().draw();
		        }
		    }
		});

	});
}
