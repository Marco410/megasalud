$('#btn-heredo').click(function () {
    if ($(this).attr("data") == 1) {

        $(this).addClass("active");
        $('#p-heredo').show();
        $(this).attr("data", 0);
        p_congenita();

    } else {
        $(this).removeClass("active");
        $('#p-heredo').hide();
        $(this).attr("data", 1);
    }

});

function p_congenita() {

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_congenita',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader_congenitas").show();
        },
        complete: function () {
            $("#loader_congenitas").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;
                $("#panel-congenita").html("");
                for (x = 0; x < l; x++) {

                    $("#panel-congenita").append("<button class='btn btn-sm elemento' onclick='new_congenita(this)' data-name='" + data[x].enfermedad + "' data-value='" + data[x].id + "' >" + data[x].enfermedad + "</button>");

                }
                $("#panel-congenita").append("<button class='btn btn-sm elemento' onclick='add_congenita(this)' id='btn-otra-congenita' data-value='0' >Otra</button>");

            }
            else {
            }
        }
    });
}

function new_congenita(elemento) {
    var c = elemento.dataset.value;
    $("#modal_congenita").modal("show");
    $("#congenita").val(c);

}

function add_congenita(elemento) {
    var c = elemento.dataset.value;
    if (c == 0) {
        document.getElementById("panel-add-ec").hidden = false;
        $("#btn-otra-congenita").attr("data-value", 1);
    } else {
        document.getElementById("panel-add-ec").hidden = true;
        $("#btn-otra-congenita").attr("data-value", 0);
    }
}

$('#new_enf_cong').validate({
    submitHandler: function (form) {
        $.ajax({
            url: base_url + 'megasalud/PatientsController/congenita',
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
                            message: 'Antecedente Guardado.',
                        });
                        $("#modal_congenita").modal("hide");
                        $(form)[0].reset();
                        $("#divLinea").load(" #divLinea");
                    }
                    else {
                        iziToast.error({
                            timeout: 3000,
                            title: 'Error',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'No se creo el antecedente.',
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

            }
        });
    }
});
