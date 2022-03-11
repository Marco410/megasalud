
$(".btn-registrar").on("click", function () {
	var id = $(this).attr("data-id");
	var edad = $(this).attr("data-edad");
	console.log(edad);
});

$('#form_evolucion').validate({
	submitHandler: function (form) {
		$.ajax({
			url: base_url + 'megasalud/PatientsController/save_evolucion',
			type: 'post',
			data: $(form).serialize(),
			success: function (respuesta) {
				if (respuesta) {
					var res = JSON.parse(respuesta);
					iziToast.success({
						timeout: 3000,
						title: 'Exito',
						position: 'topRight',
						// target: '.login-message',
						message: 'Evolución guardada.',
					});

					$("#panel-evolucion").append("<div class='col-sm-6' ><div class='panel panel-info' ><div class='panel-heading' ><h3 class='panel-title'></h3></div><p class='panel-text text-center'><b>Evolución: </b>" + res.evolucion + "</p><div class='panel-footer text-center' ><p class='panel-text text-center'><b>Edad: </b>" + res.edad + "</p><p class='panel-text text-center'><b>Fecha: </b>" + res.fecha_evolucion + "</p></div></div></div>");
				}
				else {
					iziToast.error({
						timeout: 3000,
						title: 'Error',
						position: 'topRight',
						// target: '.login-message',
						message: 'No se guardo.',
					});
				}
			}
		});

	}
});

$("#curacion_input").on('change', function () {

	p = $(this).val();
	$("#progress").width(p + "%");
	if (p <= 33) {
		$("#progress").removeClass('progress-bar-success');
		$("#progress").removeClass('progress-bar-warning').addClass('progress-bar-danger');
	} else if (p >= 34 && p <= 66) {
		$("#progress").removeClass('progress-bar-danger');
		$("#progress").removeClass('progress-bar-success').addClass('progress-bar-warning');

	} else if (p >= 67) {

		$("#progress").removeClass('progress-bar-warning');
		$("#progress").removeClass('progress-bar-danger').addClass('progress-bar-success');
	}


});

$("#envene_input").on('change', function () {

	pe = $(this).val();
	$("#progress_envene").width(pe + "%");
	if (pe <= 33) {
		$("#progress_envene").removeClass('progress-bar-danger');
		$("#progress_envene").removeClass('progress-bar-warning').addClass('progress-bar-success');
	} else if (pe >= 34 && pe <= 66) {
		$("#progress_envene").removeClass('progress-bar-danger');
		$("#progress_envene").removeClass('progress-bar-success').addClass('progress-bar-warning');

	} else if (pe >= 67) {

		$("#progress_envene").removeClass('progress-bar-warning');
		$("#progress_envene").removeClass('progress-bar-success').addClass('progress-bar-danger');
	}


});

$("#btn-save-curacion").on("click", function () {
	var curacion = {
		curacion: $("#curacion_input").val(),
		id_linea: $("#id_linea").val()
	}

	$.ajax({
		url: base_url + 'megasalud/PatientsController/save_curacion',
		type: 'post',
		data: curacion,
		success: function (respuesta) {
			if (respuesta) {
				var res = JSON.parse(respuesta);
				var data = res.data;
				iziToast.success({
					timeout: 2000,
					title: 'Exito',
					position: 'topRight',
					// target: '.login-message',
					message: 'Se actualizo el porcentaje de curación.',
				});

			}
		}
	});
});

$("#btn-save-envene").on("click", function () {
	var envene = {
		envene: $("#envene_input").val(),
		id_linea: $("#id_linea").val()
	}

	$.ajax({
		url: base_url + 'megasalud/PatientsController/save_envene',
		type: 'post',
		data: envene,
		success: function (respuesta) {
			if (respuesta) {
				var res = JSON.parse(respuesta);
				var data = res.data;
				iziToast.success({
					timeout: 2000,
					title: 'Exito',
					position: 'topRight',
					// target: '.login-message',
					message: 'Se actualizo el porcentaje de envenenamiento.',
				});

			}
		}
	});
});