let checked = false;
//Inicia el proceso del pago
    
     OpenPay.setId('mffqh0c3hkx8gnskqcr7');
     OpenPay.setApiKey('pk_6601626e2dd14e3596f264b0dacf3e32');
     var deviceSessionId = OpenPay.deviceData.setup();
     $('#device_session_id').val(""+deviceSessionId);  
     OpenPay.setSandboxMode(false);
    
    
    $('#pay-button').on('click', function(event) {
       
        var card = document.getElementById("card").value;
        var holder_name = document.getElementById("holder_name").value;
        var exp_year = document.getElementById("expiration_year").value;
        var exp_month = document.getElementById("expiration_month").value;
        var cvv = document.getElementById("cvv2").value;
        var city = document.getElementById("city").value;
        var line3 = document.getElementById("line3").value;
        var postal_code = document.getElementById("postal_code").value;
        var line1 = document.getElementById("line1").value;
        var line2 = document.getElementById("line2").value;
        var state = document.getElementById("state").value;
        var country_code = document.getElementById("country_code").value;
        event.preventDefault();
        
        if(OpenPay.card.validateCardNumber(card)){
            
            if(OpenPay.card.validateCVC(cvv)){
                
                if(OpenPay.card.validateExpiry(exp_month, exp_year)){
                     OpenPay.token.create({
                          "card_number":card,
                          "holder_name":holder_name,
                          "expiration_year":exp_year,
                          "expiration_month":exp_month,
                          "cvv2":cvv,
                          "address":{
                             "city":city,
                             "line3":line3,
                             "postal_code":postal_code,
                             "line1":line1,
                             "line2":line2,
                             "state":state,
                             "country_code":country_code
                        }

                        },success_callbak,error_callbak);
                }else{
                     iziToast.error({
                        timeout: 3000,
                        title: 'Error',
                        position: 'topCenter',
                        message: 'Fechas de expiración inválidas',
                    });
                }
               
            }else{
                iziToast.error({
                timeout: 3000,
                title: 'Error',
                position: 'topCenter',
                message: 'Código de Seguridad Inválido',
            });
            }
            
        
        }else{
            iziToast.error({
                timeout: 3000,
                title: 'Error',
                position: 'topCenter',
                message: 'La Tarjeta que ingresaste no es Correcta',
            });
        }
        
        

    });
    
     var success_callbak = function(response) {
                iziToast.info({
                    timeout: 3000,
                    title: 'Correcto',
                    position: 'topCenter',
                    message: 'Tarjeta aceptada, procede al pago.',
                 });
                var token_id = response.data.id;
                document.getElementById("token_id").value = token_id;
                document.getElementById("btn-cargo").innerHTML = "<button type='submit' class='btn btn-m btn-success' id='btn-realizar-pago' >Pagar <i class='fa fa-money'></i></button>"
            };

     var error_callbak = function(response) {
             var desc = response.data.description != undefined ?
                response.data.description : response.message;
             alert("ERROR [" + response.status + "] " + desc);
             $("#pay-button").prop("disabled", false);
        };
    
    
    
    $('#payment_form').validate({
		submitHandler: function(form) {
        $.ajax({
                    url: base_url +   'megasalud/ClientController/chargeCard',
                    type: 'post',
                    data: $(form).serialize(), 
                    success: function(response){
                    if(response){
                    var res = JSON.parse(response);
					if(res.error == false){

                                iziToast.success({
                                timeout: 3000,
                                title: 'Exito',
                                position: 'topRight',
                                message: 'Pago correcto.',
                            });
                                var data = {   
                                  'id_pro': document.getElementById("id_p").value
                                };
                            $.ajax({
                                url: base_url +   'megasalud/ClientController/updateP',
                                type: 'post',
                                data: data,
                                success: function(response){
                                    if(response){
                                        var res = JSON.parse(response);
                                        if(res.error == false){
                                           console.log("Pedido actualizado");  
                                        }else{
                                          console.log("Pedido no se actualizo");  
                                        }
                                        
                                    }
                                    
                                },
                                error:  function(xhr,err){ 
                                    console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                                }
                                
                            });
                        }
                        else{
                            iziToast.error({
                                timeout: 3000,
                                title: 'Error',
                                position: 'topRight',
                                message: 'No se hizo el cargo, revisa que los datos sean correctos.',
                            });
                            
                            codigoError(res.code);
                            
                        }
                    }
                    },
                    error:  function(xhr,err){ 
                        console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                    }
                });
        }
    });
    
    