Pace.on('done', function(){
	init();
});

function init(){

	var table2 = $('#his_table').DataTable({
		responsive: true,
		fixedHeader: true,
         searching: true,
		columnDefs: [{
            orderable: false,
            targets:   [6],
        },
        { targets: [0], visible: false }
        ],
        ajax:{
            type:"post",
            url:  base_url + 'megasalud/AccountantController/his_citas',
        },
        
        columns:[
            {"data":"id"},
            {"data":"created_at"},
            {"data":"clave_bancaria"},
            {"data":"nombre_p"},
            {"data":"telefono_a"},
            {"data":"motivo"},
            {"data":"nombre"}
        ],
		order: [ 1, 'desc' ],
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
			},
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



}
