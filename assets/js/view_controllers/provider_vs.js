Pace.on('done', function(){

	$('#main-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [{
            orderable: false,
            targets:   [5]
        }
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
			text: 'Nuevo Proveedor',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'proveedores/nuevo'
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
			url: base_url + 'megasalud/ProviderController/show/' + id,
			success: function(res){
				let json = JSON.parse(res);
				let data = json.data;
				$('.prov-empresa').html(data.empresa);
				$('.prov-contacto').html(data.nombre_contacto);
				$('.prov-cargo').html(data.cargo_contacto);
				$('.prov-giro').html(data.giro);
				$('#prov-email').html(data.email);
				$('#prov-pais').html(data.pais);
				$('#prov-estado').html(data.estado);
				$('#prov-municipio').html(data.municipio);
				$('#prov-direccion').html(data.calle + ' ' + data.colonia);
				$('#prov-telefono').html(data.telefono);
				$('#prov-notas').html(data.notas);
				
			
				$("#modal-info").modal();
			},
			error: function(res){
				alert($res);
			}
		});

	});
    
    $('.btn-danger').click(function(){

        let id = $(this).data('id');
        
        var opcion = confirm("¿Estás seguro de eliminar?");
        if (opcion == true) {
           $.ajax({
			url: base_url + 'megasalud/ProviderController/delete/' + id,
			success: function(res){
				var res2 = JSON.parse(res);
                
                if(res2.error == false){
                    Cookies.set('message', { type: 'success', message: 'Proveedor Eliminado'});
                    
                    window.location.href = "proveedores";
				
                }else{
                    
                }
               
                
			},
			error: function(res){
				alert($res);
			}
		});
        } else {
        iziToast.warning({
                    title: 'OK',
                    message: 'Cancelado',
                });
        }
		

		

	});

	$('#new_pro_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url: base_url + 'megasalud/ProviderController/newEntry',
				type: 'post',
				data: $(form).serialize(),
				success: function(respuesta){
					var res2 = JSON.parse(respuesta);
                
                    if(res2.error == false){
                        Cookies.set('message', { type: 'success', message: 'Proveedor Creado'});

                          window.location.href = base_url + "/proveedores";

                    }else{

                    }

				},
				error:  function(xhr,err){ 
					
				}
			});
		}
	});
    
    $('#edit_prov_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url: base_url + 'megasalud/ProviderController/editEntry',
				type: 'post',
				data: $(form).serialize(),
				success: function(respuesta){
					var res2 = JSON.parse(respuesta);
                
                    if(res2.error == false){
                        Cookies.set('message', { type: 'success', message: 'Proveedor Actualizado'});

                        window.location.href = base_url + "/proveedores";

                    }else{

                    }
				},
				error:  function(xhr,err){ 
					
				}
			});
		}
	});

});
