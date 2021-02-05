Pace.on('done', function(){
	init();
});

function init(){
    $("#panel-accion-pro").hide();
    
	$('#main-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [ 
		{
            className: 'control',
            orderable: false,
            targets:   [4]
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
			text: 'Nuevo Producto',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'productos/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});
    
    $('#sucursales-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [ 
		{
            orderable: false,
            targets:   [4]
        }
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
		}
		],
	});
    
    $('#sucursal_s').change(function(){
        if($(this).val() != ""){
            
            data = {
                'suc': $(this).val()
            }
            
            $.ajax({
				url:  base_url + 'megasalud/ProductsController/get_ps',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        var t = $('#sucursales-table').DataTable();
                            t.clear().draw();
                        for(i= 0; i< res.length; i++){
                            
                            t.row.add([res[i].id,res[i].nombre,res[i].existencia,res[i].precio,"<button data_id='"+res[i].id+"' class='btn btn-sm btn-warning'><i class='fa fa-edit'></i></button>"]).draw(false);
                            
                        }
                        
                       document.getElementById("suc_select").innerHTML = "<label>"+$("#sucursal_s option:selected").text()+"</label>";
                        
                        $("#href_a").attr("href",base_url +"productos/apartados/"+$("#sucursal_s").val()); 
                        $("#href_e").attr("href",base_url +"productos/entrada/"+$("#sucursal_s").val()); 
                        $("#href_ve").attr("href",base_url +"productos/entradas-mostrar/"+$("#sucursal_s").val());
                        
                        $("#href_agenda").attr("href",base_url +"sucursales/agenda/"+$("#sucursal_s").val());
                        
                        $("#panel-accion-pro").show();
                         
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se localizaron productos.',
						});
					}
				},
				error:  function(xhr,err){
				}
			});
           
        }else{
            $("#panel-accion-pro").hide();
            document.getElementById("suc_select").innerHTML = "";
        }
                      
    });
    
    
    $('#apartados-table').DataTable({
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
            targets:   [4]
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
    
    
    $('#new_product_form, #edit_product_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/ProductsController/save',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Datos guardados correctamente'});
						window.location.href = base_url + "productos";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo crear el producto.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    $('#new_product').validate({
		submitHandler: function(form) {
            
            var formData = new FormData($("#new_product")[0]);
            
			$.ajax({
				url:  base_url + 'megasalud/ProductsController/save',
				type:  'post',
				data: formData,
                cache:false,
                contentType:false,
                processData:false,
                
				success: function(respuesta){
					if(respuesta){
                        
							iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Producto Guardado.',
						});
                     document.getElementById("nombre").value = "";
                    document.getElementById("descripcion").value = "";
                    document.getElementById("precio").value = "";
                    document.getElementById("existencia").value = "";
                    document.getElementById("imagen_pro").value = "";
                    document.getElementById("sucursal").value = "";
                                
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo crear el producto.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    
    
    $('#form-entrada').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/ProductsController/new_entrada',
				type:  'post',
                data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                       
                        if(res.error != 'true'){
                           
                            Cookies.set('message', { type: 'success', message: 'Entrada Realizada'});
                            window.location.href = base_url + "productos";
                        }else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo generar la entrada.',
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
    
    
      $('.btn-info-entrada').click(function(){

		let id = $(this).data('id');
		$.ajax({
            url: base_url + 'megasalud/ProductsController/get_entradas_show/' + id,
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
    
}

function agregar_p(id,name,exis,elemento){

    
     var id_item = id;
        var nombre = name;
        var exis = exis;
        document.getElementById("sumar_producto").innerHTML += "<div class='col-sm-12' > <div class='panel border-left-olive' ><div class='panel-body' ><div class='col-sm-6' ><input type='hidden' name='id_pro[]' value='"+id_item+"' /><input type='hidden' name='name[]' value='"+nombre+"' /><label>Producto: <b>"+nombre+"</b></label><br><label>Existencia: "+exis+"</label></div><div class='col-sm-6' ><label>Agregar:</label><input required class='form-control' name='exis[]' value='0' min='1' type='number' /></div></div></div></div>";
        
        $(elemento).closest('tr').remove();
        

}