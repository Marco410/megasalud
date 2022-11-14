$('#btn-pato').click(function () {
    if ($(this).attr("data") == 1) {

        $(this).addClass("active");
        $('#p-pato').show();
        $(this).attr("data", 0);
        p_vacunas()
        p_alergias()
        p_hospi()

    } else {
        $(this).removeClass("active");
        $('#p-pato').hide();
        $(this).attr("data", 1);
    }

});


function p_vacunas() {

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_vacunas',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader_vacunas").show();
        },
        complete: function () {
            $("#loader_vacunas").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;
                $("#panel-vacunas").html("");
                for (x = 0; x < l; x++) {

                    $("#panel-vacunas").append("<button class='btn btn-sm elemento' onclick='new_vacuna(this)' data-name='" + data[x].vacuna + "' data-value='" + data[x].id + "' >" + data[x].vacuna + "</button>");

                }
                $("#panel-vacunas").append("<button class='btn btn-sm elemento' onclick='add_vacuna(this)' id='btn-otra-vacuna' data-value='0' >Otra</button>");

            }
            else {
            }
        }
    });
}

function new_vacuna(elemento) {
    var c = elemento.dataset.value;
    $("#modal_vacuna").modal("show");
    $("#vacuna").val(c);

}

function add_vacuna(elemento) {
    var c = elemento.dataset.value;
    if (c == 0) {
        document.getElementById("panel-add-v").hidden = false;
        $("#btn-otra-vacuna").attr("data-value", 1);
    } else {
        document.getElementById("panel-add-v").hidden = true;
        $("#btn-otra-vacuna").attr("data-value", 0);
    }
}

$('#form_vacuna').validate({
    submitHandler: function (form) {
        $.ajax({
            url: base_url + 'megasalud/PatientsController/vacuna',
            type: 'post',
            data: $(form).serialize(),
            success: function (respuesta) {
                var res = JSON.parse(respuesta);
                if (!res.equal) {
                    if (respuesta) {
                        iziToast.success({
                            timeout: 3000,
                            title: 'Exito',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'Vacuna Guardada.',
                        });

                        $("#descripcion_vac").val("");
                        $("#edad_vacuna").val(0);
                        $("#modal_vacuna").modal("hide");
                        $("#divLinea").load(" #divLinea");
                    }
                    else {
                        iziToast.error({
                            timeout: 3000,
                            title: 'Error',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'No se creo la vacuna.',
                        });
                    }
                } else {
                    iziToast.warning({
                        timeout: 3000,
                        title: 'Cuidado',
                        position: 'center',
                        // target: '.login-message',
                        message: 'Ya hay un dato igual o parecido en la linea de vida.',
                    });
                }
            },
            error: function (xhr, err) {
            }
        });
    }
});


function p_alergias() {

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_alergias',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader_alergias").show();
        },
        complete: function () {
            $("#loader_alergias").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;
                $("#panel-alergias").html("");
                for (x = 0; x < l; x++) {

                    $("#panel-alergias").append("<button class='btn btn-sm elemento' onclick='new_alergia(this)' data-name='" + data[x].alergeno + "' data-value='" + data[x].id + "' >" + data[x].alergeno + "</button>");

                }
                $("#panel-alergias").append("<button class='btn btn-sm elemento' onclick='add_alergia(this)' id='btn-otra-alergia' data-value='0' >Otra</button>");
            }
            else {
            }
        }
    });
}

function new_alergia(elemento) {
    var c = elemento.dataset.value;
    $("#modal_alergia").modal("show");
    $("#alergeno").val(c);

}

function add_alergia(elemento) {
    var c = elemento.dataset.value;
    if (c == 0) {
        document.getElementById("panel-add-a").hidden = false;
        $("#btn-otra-alergia").attr("data-value", 1);
    } else {
        document.getElementById("panel-add-a").hidden = true;
        $("#btn-otra-alergia").attr("data-value", 0);
    }
}

$('#form_alergia').validate({
    submitHandler: function (form) {
        $.ajax({
            url: base_url + 'megasalud/PatientsController/alergia',
            type: 'post',
            data: $(form).serialize(),
            success: function (respuesta) {
                if (respuesta) {
                    var res = JSON.parse(respuesta);

                    if (!res.equal) {

                        iziToast.success({
                            timeout: 3000,
                            title: 'Exito',
                            position: 'topRight',
                            message: 'Alergia Guardada.',
                        });
                        $("#tratamiento_ale").val("");
                        $("#edad_ale").val(0);
                        $("#modal_alergia").modal("hide");
                        $("#divLinea").load(" #divLinea");
                    } else {
                        iziToast.warning({
                            timeout: 3000,
                            title: 'Cuidado',
                            position: 'center',
                            // target: '.login-message',
                            message: 'Ya hay un dato igual o parecido en la linea de vida.',
                        });
                    }
                }
                else {
                    iziToast.error({
                        timeout: 3000,
                        title: 'Error',
                        position: 'topRight',
                        // target: '.login-message',
                        message: 'No se creo la alergía.',
                    });
                }
            }
        });
    }
});


function p_hospi() {

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_hospi',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader_hospi").show();
        },
        complete: function () {
            $("#loader_hospi").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;
                $("#panel-hospi").html("");
                for (x = 0; x < l; x++) {

                    $("#panel-hospi").append("<button class='btn btn-sm elemento' onclick='new_hospi(this)' data-name='" + data[x].causa + "' data-value='" + data[x].id + "' >" + data[x].causa + "</button>");

                }
                $("#panel-hospi").append("<button class='btn btn-sm elemento' onclick='add_causa(this)' id='btn-otra-causa' data-value='0' >Otra</button>");
            }
            else {
            }
        }
    });
}

function new_hospi(elemento) {
    var c = elemento.dataset.value;
    $("#modal_hospi").modal("show");
    $("#causa_h").val(c);

}

function add_causa(elemento) {
    var c = elemento.dataset.value;
    if (c == 0) {
        document.getElementById("panel-add-causa_h").hidden = false;
        $("#btn-otra-causa").attr("data-value", 1);
    } else {
        document.getElementById("panel-add-causa_h").hidden = true;
        $("#btn-otra-causa").attr("data-value", 0);
    }
}

$('#form_hospi').validate({
    submitHandler: function (form) {
        $.ajax({
            url: base_url + 'megasalud/PatientsController/hospitalizaciones',
            type: 'post',
            data: $(form).serialize(),
            success: function (respuesta) {
                if (respuesta) {


                    iziToast.success({
                        timeout: 3000,
                        title: 'Exito',
                        position: 'topRight',
                        // target: '.login-message',
                        message: 'Hospitalización Guardada.',
                    });

                    $(form)[0].reset();

                    $("#modal_hospi").modal("hide");
                    $("#divLinea").load(" #divLinea");
                }
                else {
                    iziToast.error({
                        timeout: 3000,
                        title: 'Error',
                        position: 'topRight',
                        // target: '.login-message',
                        message: 'No se creo la hospitalizacion.',
                    });
                }
            }
        });
    }
});