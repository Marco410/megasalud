Pace.on('done', function(){
	initM();
});


$("#btnConver").on("click",function(){

var type = document.getElementById("typeConver").value;

var data = {
    id_paciente : $(this).attr("data"),
    type : type
};
$.ajax({
        url:  base_url + 'megasalud/MessengerController/newConver',
        type:  'post',
        data: data,
        success: function(respuesta){
            if(respuesta){
                var res = JSON.parse(respuesta);
                Cookies.set('message', { type: 'success', message: 'Conversación iniciada.'});
                 location.reload();
                $('#addMsj').modal('show'); 

                $("#id_conver").val(res.id);
            }
            else{
                iziToast.error({
                    timeout: 3000,
                    title: 'Error',
                    position: 'topRight',
                    // target: '.login-message',
                    message: 'No se pudo crear la conversación..',
                });
            }
        },
        error:  function(xhr,err){ 
        }
    });

});
$("#btnverMsj, .btnverMsj").on("click",function(){

verMsj($(this).attr("data"));

});


 $('#addMsj_form').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/MessengerController/newMsj',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        let json = JSON.parse(respuesta);
                         var insertar = document.getElementById("mensajes");
                        
                        if(json.p == 1){
                            $cambio = "p";
                        }else if (json.u == 1){
                            $cambio = "d";
                        }
                         insertar.innerHTML += "<div class='row'><div class='msj-"+$cambio+" col-sm-6'><span>"+json.remitente+"</span><br>"+json.mensaje+"<br><small>Hace un momento</small></div><div>";
                        $("#mensaje").val("");
                        $("#mensajes").animate({ scrollTop: $('#mensajes').prop("scrollHeight")}, 1000);
                       
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'center',
						    // target: '.login-message',
						    message: 'No se pudo enviar.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
        
		}
	});

function verMsj(id){
        var insertar = document.getElementById("mensajes");
            
        var data = {
            id_con : id
        };
            $("#id_conver").val(id);
        $.ajax({
				url:  base_url + 'megasalud/MessengerController/getMsj',
				type:  'post',
				data: data,
                beforeSend:function(){
                    $("#loader").show();
                },
                complete: function(){
                    $("#loader").hide();
                },
				success: function(respuesta){
					if(respuesta){
                        
                        let json = JSON.parse(respuesta);
				        let data = json.data;
                        var today  = new Date();
                        
                        if($("#mensajes").find(".row").length){
                            insertar.innerHTML = "";
                        }
                        
                        for(x =0; x < data.length; x++){
                            
                            if(data[x].u == 1){
                                insertar.innerHTML += "<div class='row'><div class='msj-d col-sm-6'><span>"+data[x].remitente+"</span><br>"+data[x].mensaje+"<br><small>"+data[x].created_at+"</small></div><div>";
                                
                            }else if (data[x].p == 1){
                                 insertar.innerHTML += "<div class='row'><div class='msj-p col-sm-6'><span>"+data[x].remitente+"</span><br>"+data[x].mensaje+"<br><small>"+data[x].created_at+"</small></div><div>";
                            }
                        }
                        $("#mensajes").animate({ scrollTop: $('#mensajes').prop("scrollHeight")}, 1000);
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'center',
						    // target: '.login-message',
						    message: 'No se cargaron los mensajes.',
						});
					}
				},
				error:  function(xhr,err){ 
				}
            
			});
}

function initM(){
    
    

    
    	/*$('#addConver').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/MessengerController/newConver',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Conversación iniciada.'});
						 location.reload();
                        $("addMsj").modal("show");
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se pudo crear la conversación..',
						});
					}
				},
				error:  function(xhr,err){ 
				}
			});
		}
	});
    */
}
