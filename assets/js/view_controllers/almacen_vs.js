Pace.on('done', function(){
	init();
});

function init(){
	$('#main-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [ 
		{
            className: 'control',
            orderable: false,
            targets:   0
        },
		{ responsivePriority: 1, targets: 2 },
		{ responsivePriority: 2, targets: 3 },
		{ responsivePriority: 3, targets: 4 },
		{ targets: [ -1 ], orderable: false },
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
			text: 'Nuevo Almacén',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'almacen/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});
    
    $('#insumos-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [ 
		{
            className: 'control',
            orderable: false,
            targets:   0
        },
		{ responsivePriority: 1, targets: 2 },
		{ responsivePriority: 2, targets: 3 },
		{ responsivePriority: 3, targets: 4 },
		{ targets: [ -1 ], orderable: false },
		],
		order: [ 3, 'des' ],
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
		}
		],
	});
    
    $('#consumibles-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [ 
		{
            className: 'control',
            orderable: false,
            targets:   0
        },
		{ responsivePriority: 1, targets: 2 },
		{ responsivePriority: 2, targets: 3 },
		{ responsivePriority: 3, targets: 4 },
		{ targets: [ -1 ], orderable: false },
		],
		order: [ 3, 'des' ],
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
		}
		],
	}); 
    
    $('#e-materiales-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [ 
		{
            className: 'control',
            orderable: false,
            targets:   0
        },
		{ responsivePriority: 1, targets: 2 },
		{ responsivePriority: 2, targets: 3 },
		{ responsivePriority: 3, targets: 4 },
		{ targets: [ -1 ], orderable: false },
		],
		order: [ 3, 'des' ],
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
		}
		],
	});
    
    $('#entrada-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [ 
		{
            targets:   [3]
        }
		],
		order: [ 3, 'des' ],
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
		}
		],
	});
    
    
    
    $('#new_almacen, #edit_almacen_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/AlmacenController/save',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Datos guardados correctamente'});
						window.location.href = base_url + "almacen";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo crear.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    
    
    
   
    
  
    $('#form-estrada-almacen').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/AlmacenController/new_entrada',
				type:  'post',
                data: $(form).serialize(),
				success: function(respuesta){
                    var res = JSON.parse(respuesta);
					if(res.error != 'true'){
                           
                            Cookies.set('message', { type: 'success', message: 'Entrada Realizada'});
                            window.location.href = base_url + "almacen";
                        }else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo generar la entrada.',
						});
                        }
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    
    $('#form-salida-almacen').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/AlmacenController/new_salida',
				type:  'post',
                data: $(form).serialize(),
				success: function(respuesta){
                    var res = JSON.parse(respuesta);
					if(res.error != 'true'){
                           
                            Cookies.set('message', { type: 'success', message: 'Salida Realizada'});
                            window.location.href = base_url + "almacen";
                        }else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo generar la entrada.',
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
            url: base_url + 'megasalud/AlmacenController/show/' + id,
			success: function(res){
				let json = JSON.parse(res);
				let data = json.data;
				$('.al-id').html(""+data.id);
				$('#al-nombre').html(data.nombre);
				$('#al-des').html(data.descripcion);
				$('#al-exis').html(data.existencia);
                if(data.clave_categoria == "EMP" ){
                    $('#al-cat').html("Materia Prima");
                }else if(data.clave_categoria == "EI" ){
                    $('#al-cat').html("Insumos");
                }else if(data.clave_categoria == "EC" ){
                    $('#al-cat').html("Consumibles");
                }else if(data.clave_categoria == "EEM" ){
                    $('#al-cat').html("Equipos y Materiales");
                }
			
				$("#modal-info").modal();
			},
			error: function(res){
			}
		});

	}); 
    
    $('.btn-info-entrada').click(function(){

		let id = $(this).data('id');
		$.ajax({
            url: base_url + 'megasalud/AlmacenController/get_entradas_show/' + id,
			success: function(res){
				let json = JSON.parse(res);
				let data = json.data;
				$('.entra-id').html("E-"+data.id);
				$('#entra-user').html(data.nombre);
				$('#entra-prov').html(data.proveedor);
				$('#entra-fact').html(data.factura);
				$('#entra-pro').html(data.productos);
				$('#entra-fecha').html(data.created_at);

			
				$("#modal-info").modal();
			},
			error: function(res){
			}
		});

	}); 
    
    $('.btn-info-salida').click(function(){

		let id = $(this).data('id');
		$.ajax({
            url: base_url + 'megasalud/AlmacenController/get_salidas_show/' + id,
			success: function(res){
				let json = JSON.parse(res);
				let data = json.data;
				$('.sal-id').html("S-"+data.id);
				$('#sal-user').html(data.nombre);
				$('#sal-entre').html(data.entregado);
				$('#sal-pro').html(data.productos);
				$('#sal-fecha').html(data.created_at);

			
				$("#modal-info").modal();
			},
			error: function(res){
			}
		});

	});
    
  $('.btn-danger').click(function(){

        let id = $(this).data('id');
        
        var opcion = confirm("¿Estás seguro de eliminar?");
        if (opcion == true) {
           $.ajax({
			url: base_url + 'megasalud/AlmacenController/delete/' + id,
			success: function(res){
				var res2 = JSON.parse(res);
                
                if(res2.error == false){
                    Cookies.set('message', { type: 'success', message: 'Producto Eliminado'});
                    
                    window.location.href = "almacen";
				
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
    
}

function agregar_ps(id,name,exis,cat,elemento){
    var id_item = id;
        var nombre = name;
        var categoria = cat;
        var exis = exis;
        document.getElementById("sumar_producto").innerHTML += "<div class='col-sm-12' > <div class='panel border-left-olive' ><div class='panel-body' ><div class='col-sm-6' ><input type='hidden' name='id_almacen[]' value='"+id_item+"' /><input type='hidden' name='name[]' value='"+nombre+"' /><label>Producto: <b>"+nombre+"</b></label><br><label>Categoria: "+categoria+"</label><br><label>Existencia: "+exis+"</label></div><div class='col-sm-6' ><label>Agregar:</label><input required class='form-control' name='exis[]' value='0' min='1' max='"+exis+"' type='number' /></div></div></div></div>";
        
        $(elemento).closest('tr').remove();
}

function agregar_p(id,name,exis,cat,elemento){
        var id_item = id;
        var nombre = name;
        var categoria = cat;
        var exis = exis;
        document.getElementById("sumar_producto").innerHTML += "<div class='col-sm-12' > <div class='panel border-left-olive' ><div class='panel-body' ><div class='col-sm-6' ><input type='hidden' name='id_almacen[]' value='"+id_item+"' /><input type='hidden' name='name[]' value='"+nombre+"' /><label>Producto: <b>"+nombre+"</b></label><br><label>Categoria: "+categoria+"</label><br><label>Existencia: "+exis+"</label></div><div class='col-sm-6' ><label>Agregar:</label><input required class='form-control' name='exis[]' value='0' min='1' type='number' /></div></div></div></div>";
        
        $(elemento).closest('tr').remove();

}