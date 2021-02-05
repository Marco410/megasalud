Pace.on('done', function(){
	init();
});

function init(){
	$('#add_comment').validate({
        
		submitHandler: function(form) {
        
			$.ajax({
				url:  base_url + 'megasalud/MainController/add_comment',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
						iziToast.success({
							timeout: 5000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Comentario enviado, espere respuestas.',
						});
                        
                  document.getElementById("asunto").value = "";
                  document.getElementById("modulo").value = "";
                  document.getElementById("mensaje").value = "";
                  document.getElementById("tipo").value = "";
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
						});
					}
				},
				error:  function(xhr,err){ 
					console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
				}
			});
           
        
		}
	});
    
    $('#update_suc').validate({
        
		submitHandler: function(form) {
             var select = document.getElementById("sucursal");
              var options=document.getElementsByTagName("option");
             
           var data = {
                'id': select.value,
                'name': options[select.value].innerHTML ,
                };
           var suc = options[select.value].innerHTML;
			$.ajax({
				url:  base_url + 'megasalud/MainController/update_suc',
				type:  'post',
				data: data,
				success: function(respuesta){
					if(respuesta){
                        
                        var res = JSON.parse(respuesta);
                        if(res.error == false){
                           iziToast.success({
							timeout: 5000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Se actualizo tu ubicación.',
						}); 
                            
                        document.getElementById("suc_name").innerHTML ="BIENVENIDO - "+suc;    
                        }
						else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se creo ',
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
}