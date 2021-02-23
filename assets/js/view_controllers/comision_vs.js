Pace.on('done', function(){
	init();
});

function init(){
	var tableS = $('#suc-table').DataTable({
      
		responsive: true,
		fixedHeader: true,
		columnDefs: [ {
            targets:   [7]
        }
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
		}
		],
        ajax:{
            type:"post",
            url: base_url + "comisiones/getSuc",
        },
        
        columns:[
            
            {"data":"id"},
            {"data":"razon_social"},
            {"data":"nombrep"},
            {"data":"id_pedido"},
            {"data":"comision"},
            {"data":"status"},
            {"data":"descripcion"},
            {"defaultContent":"<button id='btn-pagar' class='btn-pagar btn btn-sm btn-info '><i class='fa fa-money'></i></button>"}
        ],
         'rowCallback': function(row, data, index){
        if(data.status == "Pendiente"){
          $(row).find('td:eq(5)').addClass('label label-warning');
            
        }else{
          $(row).find('td:eq(5)').addClass('label label-success');
            $(row).find('td:eq(7)').addClass('pace-inactive');
        }
             
      },
       
	});
    
    $("#suc-table").on("click", "#btn-pagar", function(){
        var data = tableS.row( $(this).parents("tr") ).data();
        $("#modal").modal("show");
         $("#id_com").attr("data",data.id);
         $("#tipo").attr("data","sucursal");
         $("#descripcion").html(data.descripcion);
         $("#total").html("$ "+data.comision);
     });
    
    var tableA = $('#agent-table').DataTable({
        
		responsive: true,
		fixedHeader: true,
		columnDefs: [ {
            targets:   [7]
        }
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
		}
		],
        ajax:{
            type:"post",
            url: base_url + "comisiones/getAgent",
        },
        
        columns:[
            
            {"data":"id"},
            {"data":"nombre"},
            {"data":"nombrep"},
            {"data":"id_pedido"},
            {"data":"comision"},
            {"data":"status"},
            {"data":"descripcion"},
            {"defaultContent":"<button id='btn-pagarAgent' class='btn-pagarAgent btn btn-sm btn-info '><i class='fa fa-money'></i></button>"}
        ],
        'rowCallback': function(row, data, index){
        if(data.status == "Pendiente"){
          $(row).find('td:eq(5)').addClass('label label-warning');
        }else{
          $(row).find('td:eq(5)').addClass('label label-success');
            
          $(row).find('td:eq(7)').addClass('pace-inactive');
        }
      },
	});
    
     $("#agent-table").on("click", "#btn-pagarAgent", function(){
        var data = tableA.row( $(this).parents("tr") ).data();
         
         $("#modal").modal("show");
         $("#id_com").attr("data",data.id);
         $("#tipo").attr("data","agente");
         $("#descripcion").html(data.descripcion);
         $("#total").html("$ "+data.comision);
         
        
     });
    
   var tableU = $('#user-table').DataTable({
		responsive: true,
		fixedHeader: true,
		columnDefs: [ {
            targets:   [7]
        }
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
		}
		],
        ajax:{
            type:"post",
            url: base_url + "comisiones/getUser",
        },
        
        columns:[
            
            {"data":"id"},
            {"data":"nombre"},
            {"data":"nombrep"},
            {"data":"id_pedido"},
            {"data":"comision"},
            {"data":"status"},
            {"data":"descripcion"},
            {"defaultContent":"<button id='btn-pagarUser' class='btn-pagarUser btn btn-sm btn-info '><i class='fa fa-money'></i></button>"}
        ],
        'rowCallback': function(row, data, index){
        if(data.status == "Pendiente"){
          $(row).find('td:eq(5)').addClass('label label-warning');
        }else{
          $(row).find('td:eq(5)').addClass('label label-success');
            $(row).find('td:eq(7)').addClass('pace-inactive');
        }
           

      },
	});
    
    $("#user-table").on("click", "#btn-pagarUser", function(){
        var data = tableU.row( $(this).parents("tr") ).data();
        $("#modal").modal("show");
         $("#id_com").attr("data",data.id);
         $("#tipo").attr("data","usuario");
         $("#descripcion").html(data.descripcion);
         $("#total").html("$ "+data.comision);
     });
    
    
}

$('.btn-change').click(function(){
         data = {
                'id' : $("#id_com").attr("data"),
                'tipo' : $("#tipo").attr("data"),
                'descripcion': $("#descripcion").val(),
             };
    console.log(data);
         $.ajax({
				url:  base_url + 'megasalud/ComController/change/',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        Cookies.set('message', { type: 'success', message: 'Se cambio el estatus'});
                        location.reload();
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se cambio el estatus.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
   });

