Pace.on('done', function () {
    init();
});

$('#new_pacient_form').validate({
    ignore: ".ignore",
    rules: {
        password2: {
            equalTo: "#password"
        },
        email: {
            remote: {
                url: base_url + "megasalud/AuthController/checkEmailPacient",
                type: "post",
                data: {
                    email: function () {
                        return $("#email").val();
                    }
                }
            }
        },
        fecha_nacimiento: {
            remote: {
                url: base_url + "megasalud/AuthController/checkExistPacient",
                type: "post",
                data: {
                    apellido_p: function () {
                        return $("#apellido_p").val();
                    },
                    nombre: function () {
                        return $("#nombre").val();
                    },
                    apellido_m: function () {
                        return $("#apellido_m").val();
                    },
                    pais_origen: function () {
                        return $("#pais_origen").val();
                    },
                    fecha_nacimiento: function () {
                        return $("#fecha_nacimiento").val();
                    }
                }
            }
        },
    },
    messages: {
        password2: {
            required: "Ingrese su contraseña nuevamente.",
            equalTo: "La contraseña no coincide."
        },
        nombre: {
            required: "Ingrese su nombre.",
            remote: "Hay pacientes con este nombre."
        },
        apellido_p: {
            required: "Ingrese su apellido paterno.",
            remote: "Hay pacientes con este apellido."
        },
        apellido_m: {
            remote: "Hay pacientes con ese apellido."
        },
        email: {
            required: "Ingrese su correo electrónico.",
            remote: "Este correo ya está registrado."
        },
        fecha_nacimiento: {
            required: "Ingrese fecha nacimiento.",
            remote: "Este paciente puede ya estar registrado. Verifique. Nombre, Pais de Origen y Fecha de nacimiento coinciden con uno registrado."
        }
    },
    submitHandler: function (form) {

        $.ajax({
            url: base_url + 'megasalud/PatientsController/newEntry',
            type: 'post',
            data: $(form).serialize(),
            success: function (respuesta) {
                var res = JSON.parse(respuesta);
                if (respuesta) {
                    iziToast.success({
                        title: 'Éxito',
                        message: 'Paciente Creado',
                    });

                    document.getElementById("btn-continuar").innerHTML = "<a class='btn btn-info btn-continuar' href=' " + base_url + "pacientes/historia/" + res.id_paciente + "'  >  <i class='fa fa-medkit '></i> Continuar</a>";
                }
                form.reset();
                //window.scrollTo(0, 0);
            }
        });
    }
});

$("#nombre").blur(function () {
    $.ajax({
        url: base_url + "megasalud/AuthController/checkNamePacient",
        type: 'post',
        data: {
            nombre: function () {
                return $('#nombre').val();
            }
        },
        success: function (respuesta) {
            var res = JSON.parse(respuesta);

            if (res.data.length != 0) {

                $("#panel_pacientes").show();
            } else {
                $("#panel_pacientes").hide();

            }
            $("#panel_pacientes").html('<p>Hay ' + res.data.length + ' paciente(s) con ese nombre.</p>  <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#verPacientes"><span class="fa fa-eye" ></span>Verlos</a>');

            if ($("#pacientes-table").dataTable()) {
                $("#pacientes-table").dataTable().fnDestroy();
            }

            $('#pacientes-table').dataTable({
                "aaData": res.data,
                "bAutoWidth": false,
                columnDefs: [{
                    orderable: false,
                    targets: [6],
                }
                ],
                "columns": [
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return row.clave_bancaria
                        }
                    },
                    { "data": "nombre" },
                    { "data": "apellido_p" },
                    { "data": "apellido_m" },
                    { "data": "fecha_nacimiento" },
                    { "data": "pais_origen" },
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return "<a id='btn-historia' target='_blank' class='btn-historia btn btn-sm btn-info' href='" + base_url + "pacientes/historia/" + data + "'><i class='fa fa-file-text-o'></i></a>";
                        }
                    },
                    {
                        "data": "created_at",
                        "render": function (data) {
                            date = moment(data).format('DD MMM YYYY');
                            return date;
                        }
                    }
                ]
            });
        }
    });
});

$("#apellido_p").blur(function () {
    $.ajax({
        url: base_url + "megasalud/AuthController/checkNamePacient",
        type: 'post',
        data: {
            nombre: function () {
                return $('#nombre').val();
            },
            apellido_p: function () {
                return $('#apellido_p').val();
            }
        },
        success: function (respuesta) {
            var res = JSON.parse(respuesta);

            if (res.data.length != 0) {
                $("#panel_pacientes").show();
            } else {
                $("#panel_pacientes").hide();
            }
            $("#panel_pacientes").html('<p>Hay ' + res.data.length + ' paciente(s) con ese nombre y apellido.</p>  <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#verPacientes"><span class="fa fa-eye" ></span>Verlos</a>');

            if ($("#pacientes-table").dataTable()) {
                $("#pacientes-table").dataTable().fnDestroy();
            }

            $('#pacientes-table').dataTable({
                "aaData": res.data,
                "bAutoWidth": false,
                columnDefs: [{
                    orderable: false,
                    targets: [6],
                }
                ],
                "columns": [
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return row.clave_bancaria
                        }
                    },
                    { "data": "nombre" },
                    { "data": "apellido_p" },
                    { "data": "apellido_m" },
                    { "data": "fecha_nacimiento" },
                    { "data": "pais_origen" },
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return "<a id='btn-historia' target='_blank' class='btn-historia btn btn-sm btn-info' href='" + base_url + "pacientes/historia/" + data + "'><i class='fa fa-file-text-o'></i></a>";
                        }
                    },
                    {
                        "data": "created_at",
                        "render": function (data) {
                            date = moment(data).format('DD MMM YYYY');
                            return date;
                        }
                    }
                ]
            });
        }
    });
});

$("#apellido_m").blur(function () {

    $.ajax({
        url: base_url + "megasalud/AuthController/checkNamePacient",
        type: 'post',
        data: {
            nombre: function () {
                return $('#nombre').val();
            },
            apellido_p: function () {
                return $('#apellido_p').val();
            },
            apellido_m: function () {
                return $('#apellido_m').val();
            }
        },
        success: function (respuesta) {
            var res = JSON.parse(respuesta);
            if (res.data.length != 0) {
                $("#panel_pacientes").show();
            } else {
                $("#panel_pacientes").hide();
            }
            $("#panel_pacientes").html('<p>Hay ' + res.data.length + ' paciente(s) con ese nombre y apellidos.</p>  <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#verPacientes"><span class="fa fa-eye" ></span>Verlos</a>');

            if ($("#pacientes-table").dataTable()) {
                $("#pacientes-table").dataTable().fnDestroy();
            }

            $('#pacientes-table').dataTable({
                "aaData": res.data,
                "bAutoWidth": false,
                columnDefs: [{
                    orderable: false,
                    targets: [6],
                }
                ],
                "columns": [
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return row.clave_bancaria
                        }
                    },
                    { "data": "nombre" },
                    { "data": "apellido_p" },
                    { "data": "apellido_m" },
                    { "data": "fecha_nacimiento" },
                    { "data": "pais_origen" },
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return "<a id='btn-historia' target='_blank' class='btn-historia btn btn-sm btn-info' href='" + base_url + "pacientes/historia/" + data + "'><i class='fa fa-file-text-o'></i></a>";
                        }
                    },
                    {
                        "data": "created_at",
                        "render": function (data) {
                            date = moment(data).format('DD MMM YYYY');
                            return date;
                        }
                    }
                ]
            });
        }
    });
});

function init() {

    $('#referido').on('change', function () {
        var ref = $(this).val();


        if (ref == "Representante") {

            document.getElementById("panel_referido").hidden = false;
            $("#titulo_ref").text("Representantes");
            $.ajax({
                url: base_url + 'megasalud/PatientsController/find_agents',
                type: 'post',
                beforeSend: function () {
                    $("#loader").show();
                },
                complete: function () {
                    $("#loader").hide();
                },
                success: function (respuesta) {
                    if (respuesta) {
                        $('#agent').empty();
                        var res = JSON.parse(respuesta);
                        $('#agent').append("<option  value='' >Seleccione:</option>");
                        for (var i = 0; i < res.length; i++) {

                            $('#agent').append("<option  value='" + res[i].id + "' >" + res[i].nombre + " " + res[i].apellido_p + " " + res[i].apellido_m + "  ID: (" + res[i].id + ")</option>");
                        }
                    }
                }
            });
        } else if (ref == "Clinica" || ref == "Social" || ref == "Paciente") {

            document.getElementById("panel_referido").hidden = false;
            $("#titulo_ref").text("Clinica: ");
            $.ajax({
                url: base_url + 'megasalud/PatientsController/find_suc',
                type: 'post',
                success: function (respuesta) {
                    if (respuesta) {
                        $('#agent').empty();
                        var res = JSON.parse(respuesta);
                        $('#agent').append("<option  value='' >Seleccione:</option>");
                        for (var i = 0; i < res.length; i++) {

                            $('#agent').append("<option  value='" + res[i].id + "' >" + res[i].razon_social + "  ID: (" + res[i].id + ")</option>");
                        }
                    }
                }
            });

        } else if (ref == "Usuario") {

            document.getElementById("panel_referido").hidden = false;
            $("#titulo_ref").text("Usuarios: ");
            $.ajax({
                url: base_url + 'megasalud/PatientsController/find_users',
                type: 'post',
                success: function (respuesta) {
                    if (respuesta) {
                        $('#agent').empty();
                        var res = JSON.parse(respuesta);
                        $('#agent').append("<option  value='' >Seleccione:</option>");
                        for (var i = 0; i < res.length; i++) {

                            $('#agent').append("<option  value='" + res[i].id + "' >" + res[i].nombre + " " + res[i].apellido_p + " " + res[i].apellido_m + "  ID: (" + res[i].id + ")</option>");
                        }
                    }
                }
            });

        }

    });

    $('#pais').on('change', function () {
        var pais = $(this).val();

        if (pais == "México") {
            id = 1
        } else if (pais == "EEUU") {
            id = 2
        }
        var data = {
            id_pais: id
        };

        document.getElementById("panel_referido").hidden = false;
        $("#titulo_ref").text("Representantes");
        $.ajax({
            url: base_url + 'megasalud/PatientsController/find_estados',
            type: 'post',
            data: data,
            beforeSend: function () {
                $("#loaderPais").show();
            },
            complete: function () {
                $("#loaderPais").hide();
            },
            success: function (respuesta) {
                if (respuesta) {
                    $('#estado').empty();
                    var res = JSON.parse(respuesta);
                    $('#estado').append("<option  value='' >Seleccione:</option>");
                    for (var i = 0; i < res.length; i++) {

                        $('#estado').append("<option  value='" + res[i].estado + "' >" + res[i].estado + "</option>");
                    }
                }
            }
        });

    });

    $('#motivo, #motivo_m').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-m").hidden = false;

        } else {
            document.getElementById("panel-add-m").hidden = true;
        }
    });

    $('#addSet').on('show.bs.modal', function (e) {

        var id = $(e.relatedTarget).data().id;
        $("#input_id").val("" + id);

    });

    $('#addSet_form').validate({
        submitHandler: function (form) {

            $.ajax({
                url: base_url + 'megasalud/PatientsController/addSet',
                type: 'post',
                data: $(form).serialize(),
                success: function (respuesta) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        if (!res.equal) {
                            if (res.error != true) {
                                iziToast.success({
                                    timeout: 3000,
                                    title: 'Exito',
                                    position: 'topRight',
                                    // target: '.login-message',
                                    message: 'Guardado correctamente.',
                                });
                                switch (res.id) {
                                    case 1:
                                        $('#motivo').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        $('#motivo_m').append("<option selected value='" + res.id_m + "' >" + res.dat + "</option>");
                                        break;
                                    case 2:
                                        $('#enfermedad').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 3:
                                        $('#medicamento').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        $("#divMedi").load(" #divMedi");
                                        $('#med_h').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        $('#med_virus').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        $('#med_bac').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        $('#med_hongo').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        $('#med_para').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        $('#med_psico').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        $('#med_otras').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 4:
                                        $('#vacuna').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 5:
                                        $('#alergeno').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 6:
                                        $('#tratamiento_ale').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 7:
                                        $('#causa_h').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 8:
                                        $('#operacion_h').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 9:
                                        $('#tipo_ane').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 10:
                                        $('#tipo_trans').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 11:
                                        $('#tipo_prot').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 12:
                                        $('#enf_virus').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 13:
                                        $('#enf_bac').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 14:
                                        $('#enf_hongo').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 15:
                                        $('#enf_para').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 16:
                                        $('#enf_psico').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 17:
                                        $('#enf_otras').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                    case 18:
                                        $('#terapia').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                        break;
                                }

                                $("#addSet").modal("hide");
                                $("#dato").val("");


                            } else {
                                iziToast.error({
                                    timeout: 3000,
                                    title: 'Error',
                                    position: 'topRight',
                                    // target: '.login-message',
                                    message: 'No se guardo.',
                                });

                            }
                        } else {
                            iziToast.warning({
                                timeout: 3000,
                                title: 'Cuidado',
                                position: 'center',
                                // target: '.login-message',
                                message: 'Ya hay un dato igual o parecido al que intentas ingresar.',
                            });

                        }
                    }

                },
                error: function (xhr, err) {

                }
            });
        }
    });

}
