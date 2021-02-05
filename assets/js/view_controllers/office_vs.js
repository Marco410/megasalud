Pace.on('done', function(){
	init();
});

function init(){
    
	$('#main-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [{
            className: 'control',
            orderable: false
        },
        // { data: 'Teléfono', targets: 6, render: $.fn.dataTable.render.number( ',', '.', 2, '$ ' ) },
		{ responsivePriority: 1, targets: 0 },
		{ responsivePriority: 2, targets: 7 },
		{ responsivePriority: 3, targets: 2 },
		{ responsivePriority: 4, targets: 3 },
		{ responsivePriority: 5, targets: 4 },
		{ targets: [ -1 ], orderable: false },
		],
		order: [ 0, 'asc' ],
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
			text: 'Nueva Sucursal',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'sucursales/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});

	//initialize de plugin
	$('#new_office_form, #edit_office_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/OfficeController/save',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Datos guardados correctamente'});
						window.location.href = base_url + "sucursales";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo crear la sucursal.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
    
    

	$('.btn-info').click(function(){

		let id = $(this).data('id');

		$.ajax({
			url: base_url + 'megasalud/OfficeController/show/' + id,
			success: function(res){
				let data = JSON.parse(res);
				// console.log(res);
				$('.office-name').html(data.razon_social);
				$('#office-pais').html(data.pais);
				$('#office-estado').html(data.estado);
				$('#office-municipio').html(data.municipio);
				$('#office-direccion').html(data.direccion);
				$('#office-cp').html(data.cp);
				$('#office-telefono').html(data.telefono);
				$('#office-cuenta_bancaria').html(data.cuenta_bancaria);
				$('#office-banco').html(data.banco);
				if(data.status){
					$('#office-active').html('Activo');
				}else{
					$('#office-inactive').html('Inactivo');
				}
				$('#btn-modal-edit').attr('href', base_url + 'sucursales/editar/' + data.id);
                
				$('#btn-modal-calendario').attr('href', base_url + 'sucursales/agenda/' + data.id);
				
				$("#modal-info").modal();
			},
			error: function(res){
			}
		});
        
	});

}