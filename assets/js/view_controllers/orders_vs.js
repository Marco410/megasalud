Pace.on('done', function(){
	init();
    
});

function init(){
    
	$('#main-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [{
            orderable: false,
            targets:   0
        },
		{ responsivePriority: 1, targets: 2 },
		{ responsivePriority: 2, targets: 3 },
		{ responsivePriority: 3, targets: 4 },
		{ targets: [ 4, 8, 9 ], visible: false }
		],
		order: [1, 'desc' ],
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
			text: 'Nuevo Pedido',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'pedidos/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});
    
    $('#abonos-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [{
            targets:   [4]
        }
		],
        order: [4, 'desc' ],
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
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
        ajax:{
            type:"post",
            url: base_url + 'megasalud/OrdersController/get_abonos',
        },
        columns:[
            {"data":"id_pedido"},
            {"data":"nombre"},
            {"data":"nombrep"},
            {"data":"abono"},
            {"data":"created_at"}
        ],
	});
    
    $('#sucursales-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [{
            orderable: false,
            targets:   [7]
        }
		],
		order: [0, 'desc' ],
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
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});
    
    
    
    $('#products-table').DataTable({
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
            
			text: 'Ver Carrito',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
                
				window.location.href = base_url + 'pedidos/carrito/' + document.getElementById('id_paciente').value
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});
    
    $('#carrito-table').DataTable({
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
		{ responsivePriority: 4, targets: 5 },
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
	/* Btn Borrar Carrito
		{
            
			text: 'Borrar Carrito',
			className: 'btn btn-danger',
			action: function(e, dt, node, config){
                
            var respuesta = confirm("¿Seguro que deseas eliminar todo el carrito?");
            
            if(respuesta){
                
            
            var id_paciente = document.getElementById('id_paciente').value; 
                
                var data = {
                        'id_paciente': id_paciente
                    };
                $.ajax({
                   url: base_url + 'megasalud/OrdersController/delete_carrito',
                    type: 'post',
                    data: data,
                    success: function(res){
                    if(res) {
                        iziToast.success({
                            title: 'OK',
                            message: 'Carrito eliminado',

                        });
                        $('#carrito-table > tbody').empty();
                        $('#total').text(0);
                        $('#count_carrito').text(0);

                    }else{
                        iziToast.warning({
                            title: 'Fallo',
                            message: 'No se pudo eliminar ',
                        });
                    }
                },
                error: function(res){
                    alert(res);
                }
                    
                    
                });
             }else{
                 alert("OK");
             }   
                
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}*/
		],
	});
    
    
    
    
   $('#pacients-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [3]
        }],
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
		}
		],
	});
    
    
    $('#edit_order_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/OrdersController/update',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Pedido Actualizado'});
						window.location.href = base_url + "pedidos";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo actualizar.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    
    $('#pagar-pedido-edit').click(function(){
    });
    
    
    $('#buscar').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/OrdersController/datos_order',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
                        var data = '<a class="btn btn-success" href="receta/'+ res[0].id +'" >Continuar</a>' ;
                        
                        $('#data-order').append(data);
                        
                        iziToast.success({
							timeout: 2000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Encontrado.',
						});
                    var btnSelect =     document.getElementById("seleccion");
                        btnSelect.value = "";
                        btnSelect.hidden = true;
                        document.getElementById("nombre").value = res[0].nombre;
                        document.getElementById("apellido_p").value = res[0].apellido_p;
                        document.getElementById("apellido_m").value = res[0].apellido_m;
                        document.getElementById("calle").value = res[0].calle;
                        document.getElementById("colonia").value = res[0].colonia;
                        document.getElementById("municipio").value = res[0].municipio;
                        document.getElementById("estado").value = res[0].estado;
                        document.getElementById("cp").value = res[0].cp;
                        document.getElementById("tels").value = res[0].telefono_a + "      " + res[0].telefono_b;
                        document.getElementById("rfc").value = res[0].rfc;
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    message: 'No encontrado.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	});
    

    $('.btn-delete').click(function(){
		var id = $(this).parents("tr").find("td").eq(1).text(); 
		var producto = $(this).parents("tr").find("td").eq(2).text(); 
		var subtotal = $(this).parents("tr").find("td").eq(5).text(); 
		var total = document.getElementById("total").innerHTML;
		var count = document.getElementById("count_carrito").innerHTML;
		
        var new_total = total - subtotal;
        var new_count = count - 1;
        var id_pro = document.getElementById("id_pro"+id).value;  
        var cantidad = document.getElementById("cantidad_ante"+id).value;  
        
        var respuesta = confirm("¿Seguro que deseas eliminar "+ producto + " del carrito?");  
        if(respuesta == true){
        var data = {
            'id': id,
            'cantidad':cantidad,
            'id_pro':id_pro
        };
            $.ajax({
                url: base_url + 'megasalud/OrdersController/delete_item_carrito',
                type: 'post',
                data: data, 
                success: function(res){
                    if(res) {
                        iziToast.success({
                            title: 'OK',
                            message: 'Dato eliminado correctamente',
                        });
                        
                        $("#fila"+id).remove();
                        $("#filaM"+id).remove();
                        $("#total").text(new_total);
                        $("#total_final").text(new_total);
                        $("#count_carrito").text(new_count);
                        
                        document.getElementById("total_bd").value = new_total;
                        
                        location.reload();
                        
                    }else{
                        iziToast.warning({
                            title: 'Fallo',
                            message: 'No se pudo eliminar ',
                        });
                    }
                },
                error: function(res){
                    alert(res);
                }
            }); 
        }else{
             iziToast.warning({
                            timeout: 2000,
                            title: 'Ok',
                            message: 'No se elimina',
                        }); 
        }  
});
    
    $('.btn-actualizar').click(function(){
      
      var id_item = $(this).parents("tr").find("td").eq(1).text();
      
      var cantidad = parseFloat(document.getElementById("cantidad_pro"+id_item).value);
      
      
      var cantidad_ante = parseFloat(document.getElementById("cantidad_ante"+id_item).value);
      
      var precio = parseFloat(document.getElementById("precio_pro"+id_item).value);
      
      var subtotal = parseFloat(cantidad_ante) * parseFloat(precio.toFixed(2));
      
      var subtotal_new = parseFloat(cantidad) * parseFloat(precio.toFixed(2));
       var id_pro = document.getElementById("id_pro"+id_item).value;     
      
      
      var data = {
        'id_item': id_item,
        'cantidad': cantidad,
        'cantidad_ante':cantidad_ante,  
        'subtotal_new': subtotal_new.toFixed(2),
        'id_pro':id_pro
        };
      
      $.ajax({
          
          url: base_url + 'megasalud/OrdersController/actualizar_item_carrito',
                type: 'post',
                data: data, 
                success: function(res){
                    if(res) {
                        
                        iziToast.success({
                            title: 'OK',
                            message: 'Actualizado Correctamente',
                        });
                        
                        var id = document.getElementById("id_paciente_pedido").value;
                            $.ajax({
                                url: base_url + 'megasalud/OrdersController/get_total_carrito2/' + id,
                                success: function(res){
                                var resTotal = parseFloat(res).toFixed(2);    
                                $('#total').text(resTotal);
                                $('#total_final').text(resTotal);
                                document.getElementById("total_bd").value = resTotal;
                                document.getElementById("total_carrito").value = resTotal;
                                document.getElementById("amount").value = resTotal;
                                
                                $("#cantidad-pagar").attr("max",resTotal);         
                                var resMin = parseFloat(resTotal/3).toFixed(2);                          
                                $("#cantidad-pagar").attr("min",resMin);                       

                                },
                                error: function(res){
                                    alert(res);
                                }
                            });
                        
                       $('#subtotal'+id_item).text(subtotal_new.toFixed(2));

                       $('#cantidad_new'+id_item).text(cantidad);
                       $('#cantidad_ante'+id_item).val(cantidad);
                        $("#recetaCantidad").load(" #recetaCantidad");
                        
                    }else{
                        iziToast.error({
                            title: 'Fallo',
                            message: 'No se pudo actualizar, selecciona una cantidad diferente.',
                        });
                    }
                    
                },
                error: function(res){
                    alert(res);
                }
      });
     
  });

    $('#new_order').validate({
		submitHandler: function(form) {
            
        var respuesta = confirm("¿Todos los datos del pedido son correctos?");  
        if(respuesta == true){
          
        $.ajax({
                url: base_url +             'megasalud/OrdersController/new_order',
                type: 'post',
                data: $(form).serialize(), 
                success: function(res){
					if(res){
                        
							iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Pedido Generado, espere noticias.',
						});
                        
                        $('#carrito-table > tbody').empty();
                        $('#total').text(0);
                        $('#count_carrito').text(0);
                        $('#close').click();
                        form.reset();
                        $('#total_final').text(0);
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    message: 'No se pudo generar el pedido.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
            });
            
            
        }else{
            alert("Ok, checa de nuevo los datos...");
        }
            
            
        }
    });
    
    $('#new_receta').validate({
		submitHandler: function(form) {
        $.ajax({
                url: base_url +             'megasalud/OrdersController/new_receta',
                type: 'post',
                data: $(form).serialize(), 
                success: function(response){
                    
                    var res = JSON.parse(response);
                    
					if(response){
                        
							iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Receta Generada',
						});
                        
                document.getElementById("btn_ver_receta").innerHTML = "<a href='"+ base_url + "pacientes/recetas/"+res.id_paciente+"' class='btn btn-teal'><i class='fa fa-chevron-right'></i> <span>Ver Receta</span></a><a href='"+ base_url + "pacientes/historia/"+res.id_paciente+"' class='btn btn-primary'><i class='fa fa-chevron-right'></i> <span>Volver a la consulta</span></a> "; 
                        //$('#close2').click();
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    message: 'No se pudo generar el pedido.',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
            });
            
        }
    });
    
    //select de metodo de pago para que sea por tarjeta
    $('#metodo').on('change',function(){
        if($(this).find(":selected").val() == "Tarjeta"){
            document.getElementById("panel-pago").hidden = false;
           
        }else{
             document.getElementById("panel-pago").hidden = true;
        }
    });
    
    $('#pagar-parte').change(function(){
        
       var total =  document.getElementById("total_bd").value;
        
        if(this.checked){
            document.getElementById("pagar-parte-input").innerHTML = "<input type='number' name='cantidad-pagar' id='cantidad-pagar' max='"+total+"' min='"+parseFloat(total/3).toFixed(2)+"' required class='form-control' placeholder='Ingresa la Cantidad a Pagar' />";
            document.getElementById("pagar-parte-input").hidden = false;
        }else{
            document.getElementById("pagar-parte-input").value = 0;
            document.getElementById("pagar-parte-input").hidden = true;
        }
        
    });
    
    
    $('#sucursal_s').change(function(){
        if($(this).val() != ""){
            
            data = {
                'suc': $(this).val()
            }
            
            $.ajax({
				url:  base_url + 'megasalud/OrdersController/get_orders',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        var res = JSON.parse(respuesta);
                        var t = $('#sucursales-table').DataTable();
                            t.clear().draw();
                        for(i= 0; i< res.length; i++){
                            
                            t.row.add([res[i].id,res[i].nombrep,res[i].nombre,res[i].importe,res[i].impuesto,res[i].total,res[i].created_at,res[i].status,"<a href='" + base_url +"pedidos/editar/"+res[i].id+" ' class='btn btn-sm btn-warning'><i class='fa fa-edit'></i></a><a href='"+base_url+"pedidos/mostrar/"+res[i].id+" ' class='btn btn-sm btn-info'><i class='fa fa-file-text-o'></i></a><button class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button>"]).draw(false);
                            
                        }
                         
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se localizaron pedidos.',
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
    
    
}


    function seleccionP(elemento){

        var id = elemento.dataset.value;

        document.getElementById("seleccion").value = id ;

        //se cierra el modal
        $('#closeModal').click();

        }

    function agregar_carrito(idp, nombrep, preciop,exisp){
    
        var count_carrito = document.getElementById("count_carrito").innerHTML;
          
        var id = idp;
        var nombre = nombrep;
        var precio = preciop;
        var exis = exisp;
        var cantidad = 1;
        var id_paciente = document.getElementById("id_paciente").value;
         
        var num = 3;
         
          var data = {   
              'id_pro': id,
              'nombre': nombre,
              'precio': precio,
              'cantidad': cantidad,
              'id_paciente': id_paciente,
              'existencia': exis
            };
         
			$.ajax({
				url:  base_url + 'megasalud/OrdersController/agregar_carrito',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(!respuesta){
                        iziToast.success({
							timeout: 2000,
						    title: 'Exito',
						    position: 'topRight',
						    message: 'Agregado.',
						});  
                       var count = parseInt(count_carrito) + 1;  $('#count_carrito').text(count);
                        $('#exis'+id).text(exis-cantidad);
                       document.getElementById("btn_add"+id).hidden = true;
                  
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    message: 'No se Agrego.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        
        
    
}

   

