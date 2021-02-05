Pace.on('done', function(){
	init();
});

function init(){
    
	
	var table = $('#main-table').DataTable({
        
		responsive: true,
		fixedHeader: true,
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
			text: 'Nuevo Representante',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'representante/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
         ajax:{
            type:"post",
            url: base_url + "representante/get",
        },
        columns:[
            {"data":"id"},
            {"data":"nombre"},
            {"data":"email"},
            {"data":"estado"},
            {"data":"telefono_a"},
            {"defaultContent":"<button id='btn-ver' class='btn-ver btn btn-sm btn-info '><i class='fa fa-eye'></i></button> <button id='btn-editar' class='btn-editar btn btn-sm btn-warning '><i class='fa fa-edit'></i></button>"}
        ],
       
	});
    
     $("#main-table").on("click", "#btn-ver", function(){
        var data = table.row( $(this).parents("tr") ).data();
         console.log(data);
         window.location.href = base_url + "representante/ver/" + data.id;
            
      });
    
    $('#ver-table').DataTable({
        
		responsive: true,
		fixedHeader: true,
		columnDefs: [{
            className: 'control',
            orderable: false,
            targets:   0
        },
		{ responsivePriority: 1, targets: 2 },
		{ responsivePriority: 2, targets: 3 },
		{ responsivePriority: 3, targets: 4 },
		{ targets: [ 0 ], visible: false },
		{ targets: [ -1 ], orderable: false }
		],
		order: [ 1, 'asc' ],
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
			text: 'Nuevo paciente',
			className: 'btn btn-primary',
			action: function(e, dt, node, config){
				window.location.href = base_url + 'representante/paciente/nuevo'
			},
			init: function(api, node, config) {
				$(node).removeClass('dt-button');
			}
		}
		],
	});
    
    
     $('#new_agent_form').validate({
		ignore: ".ignore",
		rules: {
			password2: {
				equalTo: "#password"
			},
			email: {
				remote: {
					url: base_url + "megasalud/AuthController/checkEmailAgent",
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
				url: base_url + 'megasalud/AgentController/newEntry',
				type: 'post',
				data: $(form).serialize(),
				success: function(respuesta){
                    
					if(respuesta){
						iziToast.success({
                            title: 'Éxito',
                            message: 'Representante Creado',
                        });
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

     $('#new_pacient_form').validate({
		ignore: ".ignore",
		rules: {
			password2: {
				equalTo: "#password"
			},
			email: {
				remote: {
					url: base_url + "megasalud/AuthController/checkEmailPacient",
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
				url: base_url + 'megasalud/AgentController/newPacient',
				type: 'post',
				data: $(form).serialize(),
				success: function(respuesta){
                    var response = JSON.parse(respuesta);
					if(response.error != true){
                        
						iziToast.success({
                            title: 'Éxito',
                            message: 'Paciente Creado',
                        });
                        
                        form.reset();
					    window.scrollTo(0, 0);
					}
                    else{
                        
                        iziToast.warning({
                            title: 'De nuevo',
                            message: 'Ya hay una cita para esa fecha.',
                        });
                        
                    }

					
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
		}
	}); 
    
    $( ".titleCalendar" ).change(function() {
        var nombre = document.getElementById("nombre").value;
        var apellido = document.getElementById("apellido_p").value;

        document.getElementById("title_cita").value = nombre + " " + apellido;
        });
    
    $('.btn-info-pedido').click(function(){

		let id = $(this).attr('data-id');

		$.ajax({
			url: base_url + 'megasalud/AgentController/get_pedidos_Paciente/' + id,
			success: function(res){
				let json = JSON.parse(res);
				let data = json.data;
                
                for (var i = 0; i < data.length; i++ ){
                    if (json.data[i].status == "Pendiente"){
                        var l = "<p><span class='label label-warning' >Pendiente</span></p>";
                    }else if (json.data[i].status == "Pagado") {
                        var l = "<p><span class='label label-default' >Pagado</span></p>";
                    }else if (json.data[i].status == "Entregado") {
                        var l = "<p><span class='label label-success' >Entregado</span></p>";
                    }else if (json.data[i].status == "Cancelado") {
                        var l = "<p><span class='label label-danger' >Cancelado</span></p>";
                    }
                    
                    $('.pedido').append("<div class='col-sm-4 panel panel-deafult' >"+'<p>P-'+json.data[i].id+'</p>'+l+'<p>Fecha:</p><p>'+json.data[i].created_at+'</p>'+"</div>");
                }
			
				$("#modal-info").modal();
			},
			error: function(res){
			}
		});

	});
 $("#modal-info").on('hidden.bs.modal', function () {
            $('.pedido').empty();  
    });

}
