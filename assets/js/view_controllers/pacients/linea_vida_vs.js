var data = {
    id: $('#id_paciente').val()
};

$.ajax({
    url: base_url + 'megasalud/LineaVidaController/get_linea/',
    type: 'post',
    data: data,
    success: function (respuesta) {
        if (respuesta) {
            var res = JSON.parse(respuesta);
            console.log(res);
        }
    }
});