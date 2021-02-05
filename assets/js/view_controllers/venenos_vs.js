Pace.on('done', function(){
	init();
});

function init(){
	let checked = false;

	var table = $('#main-table').DataTable({
		fixedHeader: true,
		columnDefs: [{
            className: 'control',
            orderable: false,
            targets:   [3]
        }
		],
		order: [ 0, 'desc' ],
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
            url:  base_url + 'megasalud/VenenosController/get_medi',
        },
        
        columns:[
            
            {"data":"id"},
            {"data":"medicamento"},
            {"data":"nombre"},
            {"defaultContent":"<button id='btn-ver' class='btn-editar btn btn-sm btn-info '><i class='fa fa-eye'></i></button><button id='btn-editar' class='btn-editar btn btn-sm btn-warning '><i class='fa fa-edit'></i></button><button id='btn-delete' class='btn-delete btn btn-sm btn-danger '><i class='fa fa-edit'></i></button>"}
        ],
	});
    
    $("#main-table").on("click", "#btn-editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        window.location.href = base_url + "venenos/editar/" + data.id;
            
      });
    
    $("#main-table").on("click", "#btn-ver", function(){
        var data = table.row( $(this).parents("tr") ).data();
        let id = data.id;
		$.ajax({
            url: base_url + 'megasalud/VenenosController/show/' + id,
			success: function(res){
				let json = JSON.parse(res);
				let data = json.data;
				$('#m-medicamento').html(data.medicamento);
				$('#m-nombre').html(data.nombre);
				$('#m-contra').html(data.contra);
			
				$("#modal-info").modal();
			},
			error: function(res){
			}
		});
            
      });
    
    $("#main-table").on("click", "#btn-delete", function(){
        var data = table.row( $(this).parents("tr") ).data();
        let id = data.id;
        
        var opcion = confirm("¿Seguro que deseas eliminar?");
        if(opcion == true){
            $.ajax({
            url: base_url + 'megasalud/VenenosController/delete/' + id,
			success: function(res){
                if(res){
                    iziToast.success({
                        timeout: 3000,
                        title: 'Medicamento ',
                        position: 'topRight',
                        message: 'Eliminado Correctamente',
                    });
                }else{
                    alert("No se pudo eliminar");
                }
				 
			},
			error: function(res){
			}
		});
        }else{
            alert("¡Ok!");
        }
        
        $(this).closest('tr').remove();
		
            
      });
    
    $('#form-new-medi').validate({
        
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/VenenosController/insert_medi',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        iziToast.success({
							timeout: 3000,
						    title: 'Correcto',
						    position: 'topRight',
						    message: 'Medicamento guardado',
						});
                        
                        form.reset();
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Error al guardar',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        
		}
	}); 
    
    $('#form-edit-medi').validate({
        
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/VenenosController/edit_medi',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                       Cookies.set('message', { type: 'success', message: 'Actualizado correctamente'});
						window.location.href = base_url + "venenos";
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Error al actualizar',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        
		}
	});
    

}
