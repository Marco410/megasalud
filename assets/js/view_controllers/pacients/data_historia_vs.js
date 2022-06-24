$.ajax({
	url: base_url + 'megasalud/DataController/get_medicamentos',
	type: 'get',
	success: function (respuesta) {
		if (respuesta) {

			var res = JSON.parse(respuesta);
			var data = res.data;
			var l = data.length;
			$("#p_medicamento").html("");
			$("#med_h").html("");
			$("#medicamento").html("");
			$("#p_medicamento").append("<option value='' >Seleccione:</option>");
			$("#med_h").append("<option value='' >Seleccione:</option>");
			$("#medicamento").append("<option value='' >Seleccione:</option>");

			for (x = 0; x < l; x++) {
				$("#p_medicamento").append("<option value=" + data[x].id + " >" + data[x].medicamento + " (" + data[x].sustancia + ")</option>");
				$("#med_h").append("<option value=" + data[x].id + " >" + data[x].medicamento + " (" + data[x].sustancia + ")</option>");
				$("#medicamento").append("<option value=" + data[x].id + " >" + data[x].medicamento + " (" + data[x].sustancia + ")</option>");

			}

			$("#p_medicamento").append("<option value='Otra' >Añadir Nuevo</option>");
			$("#med_h").append("<option value='Otra' >Añadir Nuevo</option>");
			$("#medicamento").append("<option value='Otra' >Añadir Nuevo</option>");


		}
	}
});