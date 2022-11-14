var id_p = document.getElementById("id_paciente").value;
var seguim = document.getElementById("seguimiento").value;

var data = {
    'id': id_p
};

$('#insert-suc').validate({
    submitHandler: function (form) {
        $.ajax({
            url: base_url + 'megasalud/PatientsController/insert_suc',
            type: 'post',
            data: $(form).serialize(),
            success: function (respuesta) {
                if (respuesta) {
                    Cookies.set('message', { type: 'success', message: 'Añadido correctamente a una sucursal.' });
                    location.reload();
                }
                else {
                    iziToast.error({
                        timeout: 3000,
                        title: 'Error',
                        position: 'topRight',
                        // target: '.login-message',
                        message: 'No se guado',
                    });
                }
            }
        });
    }
});

$("#btn-iniciar-consulta").on("click", function () {

    var motivo = $("#start_consultaMotivo").val();
    var tipo = $("input:radio[name=tipo_consulta]:checked").val();
    if (motivo && tipo) {

        data = {
            'id_paciente': id_p,
            'motivo': motivo,
            'tipo': tipo
        }

        $.ajax({
            url: base_url + 'megasalud/PatientsController/start_consulta',
            type: 'post',
            data: data,
            success: function (respuesta) {
                iziToast.success({
                    timeout: 1500,
                    title: 'Éxito',
                    position: 'topRight',
                    // target: '.login-message',
                    message: 'Iniciando la consulta...',
                });
                let json = JSON.parse(respuesta);
                document.getElementById("panel-iniciar-consulta").hidden = true;
                $("#btn-iniciarConsulta").hide();
                $("#btn-iniciarConsulta2").hide();
                $("#btn-terminar-consulta").show();
                $("#start_consulta").modal("hide");
                $("#btn-terminar-consulta").attr("data-id", json.id);

                $("#btn-terminar-consulta2").show();
                $("#btn-terminar-consulta2").attr("data-id", json.id);

                $("#motivo_consulta_label").html("<b>" + motivo + "</b>");

                mostrar_componentes();

            }
        });
    } else {
        iziToast.warning({
            timeout: 1500,
            title: 'Cuidado',
            position: 'center',
            // target: '.login-message',
            message: 'Llena todos los campos.',
        });
    }

});


$("#btn-terminar-consulta, #btn-terminar-consulta2").on("click", function () {
    data = {
        'id_paciente': id_p,
        'id_consulta': $(this).attr("data-id")
    }

    iziToast.question({
        timeout: 20000,
        close: false,
        overlay: true,
        displayMode: 'once',
        zindex: 999,
        title: 'Terminar',
        message: '¿Estás seguro de terminar la consulta? Recuerda añadir tu diagnóstico final.',
        position: 'center',
        buttons: [
            ['<button><b>Si</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                $.ajax({
                    url: base_url + 'megasalud/PatientsController/stop_consulta',
                    type: 'post',
                    data: data,
                    success: function (respuesta) {
                        iziToast.success({
                            timeout: 3000,
                            title: 'Éxito',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'Consulta terminada',
                        });
                        $("#btn-iniciarConsulta").show();
                        $("#btn-iniciarConsulta2").show();
                        $("#btn-terminar-consulta").hide();
                        $("#btn-terminar-consulta2").hide();

                        ocultar_componentes();
                    }
                });

            }, true],
            ['<button>NO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
        ]
    });


});

get_status_consulta();

function get_status_consulta() {
    data = {
        'id_paciente': id_p
    }

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_status_consulta',
        type: 'post',
        data: data,
        success: function (respuesta) {
            let json = JSON.parse(respuesta);

            if (json != null) {
                $("#btn-iniciarConsulta").hide();
                $("#btn-iniciarConsulta2").hide();
                $("#start_consulta").modal("hide");

                $("#btn-terminar-consulta").show();
                $("#btn-terminar-consulta").attr("data-id", json.id);

                $("#btn-terminar-consulta2").show();
                $("#btn-terminar-consulta2").attr("data-id", json.id);

                mostrar_componentes();
            } else {
                ocultar_componentes();
            }
        }
    });
}

function mostrar_componentes() {
    $("#consulta-msj").hide();

    $("#signos-vitales").show();
    $("#receta").show();
    $("#estudiosBtn").show();
    $("#notas-motivo").show();
    $("#productos").show();
    $("#antecedentes").show();
}

function ocultar_componentes() {
    $("#consulta-msj").show();

    $("#signos-vitales").hide();
    $("#receta").hide();
    $("#estudiosBtn").hide();
    $("#notas-motivo").hide();
    $("#productos").hide();
    $("#antecedentes").hide();
}

/* window.addEventListener("beforeunload", (evento) => {
    if (true) {
        evento.preventDefault();
        evento.returnValue = "";
        return "";
    }
}); */

