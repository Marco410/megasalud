function new_medi(elemento){
        var c = elemento.dataset.value;
        $("#modal_new_medi").modal("show");
        $("#p_medicamento").val(c);

    }

 $('#form_medi').validate({      
		submitHandler: function(form) {
			$.ajax({
				url:  base_url + 'megasalud/PatientsController/save_hisclinic_medi',
				type:  'post',
				data: $(form).serialize(),
				success: function(respuesta){
					if(respuesta){
                        
						iziToast.success({
							timeout: 3000,
						    title: 'Exito',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'Medicamento guardado.',
						});
                        $("#divLinea").load(" #divLinea");
                        
					}
					else{
						iziToast.error({
							timeout: 3000,
						    title: 'Error',
						    position: 'topRight',
						    // target: '.login-message',
						    message: 'No se guardo el medicamento',
						});
					}
				}
			});
        
		}
	}); 