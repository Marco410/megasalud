Pace.on('done', function(){
	init();
});

function init(){
	let checked = false;

	$('#main-table').DataTable({
		scrollY: true,
		fixedHeader: true,
         paging: false,
         searching: false,
		columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   [7]
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
			"sInfo":           "",
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
		
		],
	});
    
   
    $("input[name='charts[]']").each(function(indice, elemento) {
         var id = document.getElementById("id_paciente").value;
     var id_chart = document.getElementById("id_chart").value;

        
         $.ajax({
            url: base_url + 'megasalud/PatientsController/find_charts2/' + id +'/'+$(elemento).val(),
			success: function(res){
				let json = JSON.parse(res);
				let data = json.data;
                var valores = [];
                var fechas = [];
                
                for(x =0; x < data.length; x++){
                        
                        valores.push(data[x].valor);
                        fechas.push(data[x].fecha);
                    
                        var ctx = $('#'+data[x].titulo);
                        var chart = new Chart(ctx, {
                            // The type of chart we want to create
                            type: 'line',

                            // The data for our dataset
                            data: {
                                labels: fechas,
                                datasets: [{
                                    label: data[x].titulo,
                                    pointBorderWidth: 4,
                                    fill: false,
                                    borderColor: 'rgb(255, 99, 132)',
                                    data: valores
                                }]
                            },

                            // Configuration options go here
                            options: {}
                        });
                }
            
			},//termina success
			error: function(res){
			}
             
		});//termina ajax
        
    });//termina el array de input
    
   

    function codigoError(code){
            var msg = "";
                            
                switch(code){
                    case  1000:
                     msg = "Ocurrió un error interno en el servidor de Openpay";
                     break;
                    case 1001:
                        msg = "Los campos no tienen el formato correcto, o la petición no tiene campos que son requeridos.";
                        break;
                    case 1002:
                        msg = "	La llamada no esta autenticada o la autenticación es incorrecta.";
                        break; 
                    case 1003:
                        msg = "	La operación no se pudo completar por que el valor de uno o más de los parámetros no es correcto.";
                        break;
                    case 1004:
                        msg = "Un servicio necesario para el procesamiento de la transacción no se encuentra disponible.";
                        break;
                    case 1005:
                        msg = "Uno de los recursos requeridos no existe.";
                        break;
                    case 1006:
                        msg = "Ya existe una transacción con el mismo ID de orden. Procese de nuevo la tarjeta.";
                        break;
                    case 1007:
                        msg = "La transferencia de fondos entre una cuenta de banco o tarjeta y la cuenta de Openpay no fue aceptada.";
                        break;
                    case 1012:
                        msg = "El monto transacción esta fuera de los limites permitidos.";
                        break;
                    case 1018:
                        msg = "El número de intentos de cargo es mayor al permitido.";
                        break;
                    case 1020:
                        msg = "El número de dígitos decimales es inválido para esta moneda.";
                        break;
                    case 2001:
                        msg = "La cuenta de banco con esta CLABE ya se encuentra registrada en el cliente.";
                        break;
                    case 2002:
                        msg = "La tarjeta con este número ya se encuentra registrada en el cliente.";
                        break;
                    case 2003:
                        msg = "El cliente con este identificador externo ya existe.";
                        break;
                    case 2005:
                        msg = "La fecha de expiración de la tarjeta es anterior a la fecha actual.";
                        break;
                    case 2006:
                        msg = "El código de seguridad de la tarjeta (CVV2) no fue proporcionado.";
                        break;  
                    case 2008:
                        msg = "La tarjeta no es válida para puntos Santander.";
                        break; 
                    case 2009:
                        msg = "El código de seguridad de la tarjeta (CVV2) es inválido.";
                        break; 
                    case 2010:
                        msg = "Autenticación 3D Secure fallida.";
                        break; 
                    case 2011:
                        msg = "Tipo de tarjeta no soportada";
                        break; 
                    case 3001:
                        msg = "La tarjeta fue declinada.";
                        break; 
                    case 3002:
                        msg = "La tarjeta ha expirado.";
                        break; 
                    case 3003:
                        msg = "La tarjeta no tiene fondos suficientes.";
                        break; 
                    case 3004:
                        msg = "La tarjeta ha sido identificada como una tarjeta robada.";
                        break; 
                    case 3005:
                        msg = "	La tarjeta ha sido rechazada por el sistema antifraudes.";
                        break;
                    case 3006:
                        msg = "La operación no esta permitida para este cliente o esta transacción.";
                        break;
                    case 3007:
                        msg = "Deprecado. La tarjeta fue declinada.";
                        break;
                    case 3008:
                        msg = "La tarjeta no es soportada en transacciones en línea.";
                        break;
                    case 3009:
                        msg = "La tarjeta fue reportada como perdida.";
                        break;
                    case 3010:
                        msg = "El banco ha restringido la tarjeta.";
                        break;
                    case 3011:
                        msg = "El banco ha solicitado que la tarjeta sea retenida. Contacte al banco.";
                        break;
                    case 3012:
                        msg = "Se requiere solicitar al banco autorización para realizar este pago.";
                        break;
                    case 5001:
                        msg = "La orden ya existe, vuelva a procesar la tarjeta.";
                        break;
                    default:
                        msg = "Error administrativo, avisa al administrador del sistema. Código de Error: "+ res.code;
                        break;


                }
                iziToast.error({
                    timeout: 9000,
                    title: 'Error',
                    position: 'topRight',
                    message: msg,
                });
        }

}
