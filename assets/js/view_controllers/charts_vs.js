Pace.on('done', function(){
	init();
});

//se usa del lado del cliente y del medico

function init(){
    
    
    $('#form_new_chart').validate({
		submitHandler: function(form) {
            var id = document.getElementById("id_paciente").value;
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/new_chart',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Gráfica generada'});
                        
                        location.reload();
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
				}
			});
		}
	}); 
    
    $('#form_new_data').validate({
		submitHandler: function(form) {
            var id = document.getElementById("id_paciente").value;
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/new_chart_data',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Dato Añadido'});
                        
                        location.reload();
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
				}
			});
		}
	});
    
    var id = document.getElementById("id_paciente").value;
    
    if (document.getElementById("id_chart")){
            var id_chart = document.getElementById("id_chart").value;
    }
    $("input[name='charts[]']").each(function(indice, elemento) {
        
         $.ajax({
            url: base_url + 'megasalud/PatientsController/find_charts2/' + id +'/'+$(elemento).val(),
			success: function(res){
				let json = JSON.parse(res);
				let data = json.data;
                var valores = [];
                var fechas = [];
                var max = [];
                var min = [];
                
                for(x =0; x < data.length; x++){
                        
                        valores.push(data[x].valor);
                        fechas.push(data[x].fecha);
                        max.push(data[x].max);
                        min.push(data[x].min);
                    
                        var ctx = $('#'+data[x].titulo);
                        var chart = new Chart(ctx, {
                            // The type of chart we want to create
                            type: 'line',

                            // The data for our dataset
                            data: {
                                labels: fechas,
                                datasets: [{
                                    data: valores,
                                    label: data[x].titulo,
                                    pointBorderWidth: 4,
                                    
                                    borderColor: 'rgb(74, 181, 251)',
                                    fill: false
                                },
                                {
                                    data: max,
                                    label: "Maximo",
                                    pointBorderWidth: 4,
                                    borderColor: 'rgb(251, 106, 74)',
                                    fill: false
                                },{
                                    data: min,
                                    label: "Minimo",
                                    pointBorderWidth: 4,
                                    borderColor: 'rgb(251, 106, 74)',
                                    fill: false
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
    
    $("#btn_new_data").on("click",function(){
        
        var i = parseInt($(this).attr("data"));
        var j = i+1;
       
        var html = "<div id='dato"+ i +"' ><div class='col-sm-5'><label>Nuevo Valor: </label><input class='form-control' name='valor[]' type='text' required placeholder='Ingrese un valor' /></div><div class='col-sm-5' ><label>Fecha:</label><input type='date' required class='form-control' name='fecha[]' /> </div><div class='col-sm-2' ><label>Borrar</label><br><button type='button' data ='dato"+i+"' onclick='btn_delete("+i+")' class='btn btn-sm btn-danger btn_delete_data'  ><i class='fa fa-trash' ></i></button></div></div>";
        
        $("#new_data").append(html);
        
        $(this).attr("data", j);
    });
    
    $(".titulo").keydown(function(event){
        
        if(event.which == 32){
            event.preventDefault();
        }
	});
    
    
    $(".btn_delete_chart").on("click",function(){
        var id = $(this).attr("data");
        var id_p = document.getElementById("id_paciente").value;
        
        var r = confirm("¿Estas seguro que deseas eliminar la gráfica con sus datos?");
        
        if (r == true){
       
        var data = {
            "id_chart" : id
        };
        	$.ajax({
				url:  base_url + 'megasalud/PatientsController/delete_chart',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Gráfica Eliminada Correctamente'});
						window.location.href = base_url + "pacientes/graficas/"+id_p;
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    message: 'No se pudo eliminar.',
						});
					}
				},
				error:  function(xhr,err){
				}
			});
         }else{
         
        }
    });
   
}

function btn_delete(n){
    $("#dato"+n).remove();   
}


