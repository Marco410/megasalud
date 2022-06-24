get_status_consulta();

function get_status_consulta() {
    data = {
        'data': 1
    }
    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_status_consultas',
        type: 'post',
        data: data,
        success: function (respuesta) {
            let json = JSON.parse(respuesta);

            if (json.length != 0) {
                $("#alert-consultas").show();

                $("#consultas-count").html(json.length);
                $("#enlace-consulta").attr('href', 'pacientes/historia/' + json[0].id_paciente);
            }
        }
    });
}