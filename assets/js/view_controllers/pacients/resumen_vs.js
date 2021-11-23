Pace.on('done', function(){
	init();
});


function init(){

	var espanol = {
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
	};
    //tabla heredo familiares
    
    $('#carga_heredo-table').DataTable({
		responsive: true,
         paging: false,
         searching: false,
		columnDefs: [{
            orderable: false,
            targets:   [3]
        }],
         order: [ 0, 'asc' ],
		language: espanol
	});
    
    //tabla de antecedentes
    
    $('#antecedentes-table').DataTable({
		responsive: true,
		fixedHeader: true,
         paging: false,
         searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [4]
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
    //tabla de inmunizaciones
    
    $('#inmunizaciones-table').DataTable({
		responsive: true,
		fixedHeader: true,
        paging: false,
         searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [3]
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
    //tabla de alergias
    
    $('#alergias-table').DataTable({
		responsive: true,
		fixedHeader: true,
        paging: false,
         searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [4]
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
    //Hospitalizaciones table
    
    $('#hospi-table').DataTable({
		responsive: true,
		fixedHeader: true,
        paging: false,
        scrollY:true,
        searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
    //tabla enfermedades infecto contagiosas
    
    $('#enf_inf-table').DataTable({
		responsive: true,
		fixedHeader: true,
        paging: false,
         searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [5]
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
    //bacterias table
    
    $('#bacterias-table').DataTable({
		responsive: true,
		fixedHeader: true,
        paging: false,
        searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [5]
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
     //Hongos table
    
    $('#hongos-table').DataTable({
		responsive: true,
		fixedHeader: true,
        paging: false,
         searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [5]
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
    //Parasitos table
    
    $('#parasitos-table').DataTable({
		responsive: true,
		fixedHeader: true,
        paging: false,
         searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [5]
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
    //psicologicas table
    
    $('#psicologicas-table').DataTable({
		responsive: true,
		fixedHeader: true,
        paging: false,
         searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [5]
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
    //otras table
    
    $('#otras-table').DataTable({
		responsive: true,
		fixedHeader: true,
        paging: false,
         searching: false,
		columnDefs: [{
            //className: 'control',
            orderable: false,
            targets:   [5]
        }],
		order: [ 0, 'asc' ],
		language: espanol
	});
    
    $('.btn-delete-ahf').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_ahf"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?");
		 			
            if(respuesta == true){
            var data = {
                'id': id,
                'table': table
            };

                $.ajax({
                    url: base_url + 'megasalud/PatientsController/delete_hisclinic',
                    type: 'post',
                    data: data, 
                    success: function(res){
                        if(res) {
                            iziToast.success({
                                title: 'OK',
                                message: 'Dato eliminado correctamente',

                            });

                        $("#fila_ahf"+id).remove();



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
                }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	}); 
    
    $('.btn-delete-ante').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_ante"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'table': table
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_ante"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	});
    
    $('.btn-delete-app1').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_app1"+id).value; 
        var fecha = document.getElementById("fecha_app1"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'table': table,
                            'fecha': fecha
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_app1"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	});  
    
    $('.btn-delete-inmun').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_inmun"+id).value;
        var fecha = document.getElementById("fecha_inmun"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'fecha': fecha,
                            'table': table
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_inmun"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	}); 
    
    $('.btn-delete-ale').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_ale"+id).value; 
        var fecha = document.getElementById("fecha_ale"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'fecha': fecha,
                            'table': table
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_ale"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	});
    
    $('.btn-delete-hospi').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_hospi"+id).value; 
        var fecha = document.getElementById("fecha_hospi"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'fecha': fecha,
                            'table': table
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_hospi"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	});
    
    $('.btn-delete-virus').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_virus"+id).value; 
        var fecha = document.getElementById("fecha_virus"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'fecha': fecha,
                            'table': table
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_virus"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	});
    
    $('.btn-delete-bac').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_bac"+id).value; 
        var fecha = document.getElementById("fecha_bac"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'fecha': fecha,
                            'table': table
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_bac"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	});
    
    $('.btn-delete-ho').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_ho"+id).value; 
        var fecha = document.getElementById("fecha_ho"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'fecha': fecha,
                            'table': table
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_ho"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	});
    
    $('.btn-delete-pa').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_pa"+id).value; 
        var fecha = document.getElementById("fecha_pa"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'fecha': fecha,
                            'table': table
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_pa"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	});
    
    $('.btn-delete-psi').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_psi"+id).value; 
        var fecha = document.getElementById("fecha_psi"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
                        if(respuesta == true){
                        var data = {
                            'id': id,
                            'fecha': fecha,
                            'table': table
                        };
                            
		 					$.ajax({
			 					url: base_url + 'megasalud/PatientsController/delete_hisclinic',
			 					type: 'post',
			 					data: data, 
			 					success: function(res){
			 						if(res) {
			 							iziToast.success({
										    title: 'OK',
										    message: 'Dato eliminado correctamente',
                                            
										});
                                        
                                    $("#fila_psi"+id).remove();
										
										
                                    
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
                            }
               else{
                    iziToast.warning({
                                    timeout: 2000,
                                    title: 'Ok',
                                    message: 'Cancelado',
                                }); 
               }
	});
    
    $('.btn-delete-otras').click(function(){
       
		var id = $(this).parents("tr").find("td").eq(0).text();
        var table = document.getElementById("table_otras"+id).value; 
        var fecha = document.getElementById("fecha_otras"+id).value; 
       
        var respuesta = confirm("¿Estas seguro que deseas eliminar?" + table);
		 			
            if(respuesta == true){
            var data = {
                'id': id,
                'fecha': fecha,
                'table': table
            };

                $.ajax({
                    url: base_url + 'megasalud/PatientsController/delete_hisclinic',
                    type: 'post',
                    data: data, 
                    success: function(res){
                        if(res) {
                            iziToast.success({
                                title: 'OK',
                                message: 'Dato eliminado correctamente',

                            });
                        $("#fila_otras"+id).remove();
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
                }
   else{
        iziToast.warning({
                        timeout: 2000,
                        title: 'Ok',
                        message: 'Cancelado',
                    }); 
   }
	});
    
}
