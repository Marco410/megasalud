function new_medi(elemento) {
	var c = elemento.dataset.value;

	$("#modal_new_medi").modal("show");
	$("#p_medicamento").val(c);
	$("#p_medicamento2").val(c);

}

$('#form_medi').validate({
	submitHandler: function (form) {
		$.ajax({
			url: base_url + 'megasalud/PatientsController/save_hisclinic_medi',
			type: 'post',
			data: $(form).serialize(),
			success: function (respuesta) {
				if (respuesta) {

					iziToast.success({
						timeout: 3000,
						title: 'Exito',
						position: 'topRight',
						// target: '.login-message',
						message: 'Medicamento guardado.',
					});
					$("#divLinea").load(" #divLinea");

				}
				else {
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

$('#form_medi2').validate({
	submitHandler: function (form) {
		$.ajax({
			url: base_url + 'megasalud/PatientsController/save_hisclinic_medi',
			type: 'post',
			data: $(form).serialize(),
			success: function (respuesta) {
				if (respuesta) {

					iziToast.success({
						timeout: 3000,
						title: 'Exito',
						position: 'topRight',
						// target: '.login-message',
						message: 'Medicamento guardado.',
					});
					$("#divLinea").load(" #divLinea");
					$("#modal_new_medi").modal("hide");

				}
				else {
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

$('#form_estres').validate({
	submitHandler: function (form) {
		$.ajax({
			url: base_url + 'megasalud/PatientsController/save_hisclinic_estres',
			type: 'post',
			data: $(form).serialize(),
			success: function (respuesta) {
				if (respuesta) {

					iziToast.success({
						timeout: 3000,
						title: 'Exito',
						position: 'topRight',
						// target: '.login-message',
						message: 'Estrés guardado.',
					});
					$("#divLinea").load(" #divLinea");

				}
				else {
					iziToast.error({
						timeout: 3000,
						title: 'Error',
						position: 'topRight',
						// target: '.login-message',
						message: 'No se guardo el estrés',
					});
				}
			}
		});

	}
});

$('#form_obe').validate({
	submitHandler: function (form) {
		$.ajax({
			url: base_url + 'megasalud/PatientsController/save_hisclinic_obe',
			type: 'post',
			data: $(form).serialize(),
			success: function (respuesta) {
				if (respuesta) {

					iziToast.success({
						timeout: 3000,
						title: 'Exito',
						position: 'topRight',
						// target: '.login-message',
						message: 'Obesidad guardada.',
					});
					$("#divLinea").load(" #divLinea");

				}
				else {
					iziToast.error({
						timeout: 3000,
						title: 'Error',
						position: 'topRight',
						// target: '.login-message',
						message: 'No se guardo la obesidad',
					});
				}
			}
		});

	}
});


$("#altura").keyup(function () {

	var altura = $(this).val();
	var peso = $("#peso").val();
	var altura2 = altura / 100;

	var imc = peso / Math.pow(altura2, 2);

	$("#imc").val(imc.toFixed(2));
	$("#imcCal").html("");

	if (imc < 18.5) {
		$("#imcCal").html("Bajo Peso").addClass('text-danger').removeClass("text-warning text-success");
		$("#obesidadTipo").html("Bajo Peso").addClass('text-danger').removeClass("text-warning text-success");

	} else if (imc >= 18.5 && imc <= 24.9) {
		$("#imcCal").html("Normal").addClass('text-success').removeClass("text-warning text-danger");
		$("#obesidadTipo").html("Normal").addClass('text-success').removeClass("text-warning text-danger");

	} else if (imc >= 25.0 && imc <= 29.9) {
		$("#imcCal").html("Sobre Peso").addClass('text-warning').removeClass("text-success text-danger");
		$("#obesidadTipo").html("Sobre Peso").addClass('text-warning').removeClass("text-success text-danger");

	} else if (imc > 30) {
		$("#imcCal").html("Obesidad").addClass('text-danger').removeClass("text-warning text-success");
		$("#obesidadTipo").html("Obesidad").addClass('text-danger').removeClass("text-warning text-success");
	}

});

$("#peso").keyup('change', function () {

	var peso = $(this).val();
	var altura = $("#altura").val();
	var altura2 = altura / 100;

	var imc = peso / (Math.pow(altura2, 2));

	$("#imc").val(imc.toFixed(2));
	if (imc < 18.5) {
		$("#imcCal").html("Bajo Peso").addClass('text-danger').removeClass("text-warning text-success");
		$("#obesidadTipo").html("Bajo Peso");
		$("#s_obesidad").val("Bajo Peso").addClass('text-danger').removeClass("text-warning text-success");

	} else if (imc >= 18.5 && imc <= 24.9) {
		$("#imcCal").html("Normal").addClass('text-success').removeClass("text-warning text-danger");
		$("#s_obesidad").val("Normal");
		$("#obesidadTipo").html("Normal").addClass('text-success').removeClass("text-warning text-danger");

	} else if (imc >= 25.0 && imc <= 29.9) {
		$("#imcCal").html("Sobre Peso").addClass('text-warning').removeClass("text-success text-danger");
		$("#s_obesidad").val("Sobre Peso");
		$("#obesidadTipo").html("Sobre Peso").addClass('text-warning').removeClass("text-success text-danger");

	} else if (imc > 30) {
		$("#imcCal").html("Obesidad").addClass('text-danger').removeClass("text-warning text-success");
		$("#s_obesidad").val("Obesidad");
		$("#obesidadTipo").html("Obesidad").addClass('text-danger').removeClass("text-warning text-success");
	}
});

$('#form_signos').validate({
	submitHandler: function (form) {
		$.ajax({
			url: base_url + 'megasalud/PatientsController/save_hisclinic_signos',
			type: 'post',
			data: $(form).serialize(),
			success: function (respuesta) {
				if (respuesta) {

					iziToast.success({
						timeout: 3000,
						title: 'Exito',
						position: 'topRight',
						// target: '.login-message',
						message: 'Signos Vitales Guardados.',
					});
					$("#divLinea").load(" #divLinea");

				}
				else {
					iziToast.error({
						timeout: 3000,
						title: 'Error',
						position: 'topRight',
						// target: '.login-message',
						message: 'No se guardaron los signos vitales',
					});
				}
			}
		});

	}
});