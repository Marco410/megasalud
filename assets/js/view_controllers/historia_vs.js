 $(".btn-abono").click(function(){
     
    var id_p = $(this).attr("data-id");
    var total = $(this).attr("data-tot");
    var restante = $(this).attr("data-res");
     
     
    var minim = Math.round(restante/3); 
     
    $("#in-abono").val(restante);
    $("#in-abono").attr("max",restante);
    $("#in-abono").attr("min",minim);
    $("#id_order").val(id_p);
 });


$('#form-abono').validate({
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/insert_abono',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
						Cookies.set('message', { type: 'success', message: 'Abono de pedido realizado.'});
                        location.reload();
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se hizo el abono',
						});
					}
				}
			});
		}
	});