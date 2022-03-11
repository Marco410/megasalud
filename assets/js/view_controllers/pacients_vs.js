Pace.on('done', function () {
    init();
});

var español = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
};

$('#inicia_consulta').validate({

    submitHandler: function (form) {
        $.ajax({
            url: base_url + 'megasalud/PatientsController/inicia_consulta',
            type: 'post',
            data: $(form).serialize(),
            success: function (respuesta) {
                if (respuesta) {
                    Cookies.set('message', { type: 'success', message: 'Iniciando consulta...' });
                    location.reload();
                    $("#primera_vez").show();
                }
                else {
                    iziToast.error({
                        timeout: 3000,
                        title: 'Error',
                        position: 'topRight',
                        // target: '.login-message',
                        message: 'Error al iniciar el historial',
                    });
                }
            },
            error: function (xhr, err) {
            }
        });

    }
});

function init() {
    var id = 0;

    var table = $('#main-table').DataTable({
        fixedHeader: true,
        scrollY: true,
        columnDefs: [{
            className: 'clipboard', targets: 1,
            className: 'mayus', targets: 2
        },
        { responsivePriority: 1, targets: 1 },
        { responsivePriority: 2, targets: 4 },
        { responsivePriority: 3, targets: 2 },
        { targets: [0], visible: false }
        ],
        order: [0, 'des'],
        language: español,
        dom: '<"row" <"col-sm-4" l> <"col-sm-8" <"pull-right ml-15" B><"pull-right" f> > >r<"mt-30" t><"row mt-30" <"col-sm-5" i> <"col-sm-7" p> >',
        buttons: [
            {
                extend: 'excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: ':not(:last-child)',
                },
                init: function (api, node, config) {
                    $(node).removeClass('dt-button');
                }
            },
            {
                text: 'Nuevo Paciente',
                className: 'btn btn-primary',
                action: function (e, dt, node, config) {
                    window.location.href = base_url + 'pacientes/nuevo'
                },
                init: function (api, node, config) {
                    $(node).removeClass('dt-button');
                }
            }
        ],
        ajax: {
            type: "post",
            url: base_url + "pacientes/getxMxQ",
        },

        columns: [

            { "data": "id" },
            { "data": "clave_bancaria" },
            { "data": "nombre" },
            { "data": "email" },
            { "data": "estado" },
            { "data": "telefono_a" },
            { "defaultContent": "<button id='btn-historia' class='btn-historia btn btn-sm btn-info '><i class='fa fa-file-text-o'></i></button><button id='btn-editar' class='btn-editar btn btn-sm btn-warning '><i class='fa fa-edit'></i></button>" }
        ],
    });

    $("#main-table").on("click", "#btn-historia", function () {
        var data = table.row($(this).parents("tr")).data();
        window.location.href = base_url + "pacientes/historia/" + data.id;

    });

    $("#main-table").on("click", "#btn-editar", function () {
        var data = table.row($(this).parents("tr")).data();
        window.location.href = base_url + "pacientes/editar/" + data.id;

    });

    $('#main-table').on('click', 'tbody tr td', function () {
        var data = table.row($(this).parents("tr")).data();
        iziToast.info({
            timeout: 2000,
            title: 'Copiado',
            position: 'center',
            message: '' + data.clave_bancaria,
        });
        var aux = document.createElement("input");
        aux.setAttribute("value", data.clave_bancaria);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand('copy');
        aux.setAttribute("type", "hidden");

    });

    var table2 = $('#his_table').DataTable({
        scrollY: true,
        fixedHeader: true,
        searching: false,
        columnDefs: [{
            orderable: false,
            targets: [6],
        },
        { targets: [0], visible: false }
        ],
        ajax: {
            type: "post",
            url: base_url + 'megasalud/PatientsController/his_citas',
        },
        columns: [
            { "data": "id" },
            {
                "data": "created_at",
                "render": function (value) {
                    return moment(value).format('DD-MMM-YYYY HH:mm a');
                }
            },
            { "data": "clave_bancaria" },
            { "data": "nombre" },
            { "data": "telefono_a" },
            { "data": "motivo" },
            { "defaultContent": "<button id='btn-historia-2' class='btn-historia-2 btn btn-sm btn-info '><i class='fa fa-file-text-o'></i></button>" }
        ],
        order: [1, 'desc'],
        language: español
    });

    $("#his_table").on("click", "#btn-historia-2", function () {
        var data = table2.row($(this).parents("tr")).data();
        window.location.href = base_url + "pacientes/historia/" + data.id;

    });

    var table3 = $('#his_table2').DataTable({
        scrollY: true,
        columnDefs: [{
            orderable: false,
            targets: [7],
        },
        { targets: [0], visible: false }
        ],
        ajax: {
            type: "post",
            url: base_url + 'megasalud/PatientsController/his_citas2',
        },

        columns: [
            { "data": "id" },
            {
                "data": "created_at",
                "render": function (value) {
                    return moment(value).format('DD-MMM-YYYY HH:mm a');;
                }
            },
            { "data": "clave_bancaria" },
            { "data": "nombre_p" },
            { "data": "telefono_a" },
            { "data": "motivo" },
            { "data": "nombre" },
            { "data": "razon_social" },
            { "defaultContent": "<button id='btn-historia-3' class='btn-historia-3 btn btn-sm btn-info '><i class='fa fa-file-text-o'></i></button>" }
        ],
        order: [1, 'desc'],
        language: español
    });

    $("#his_table2").on("click", "#btn-historia-3", function () {
        var dato = table3.row($(this).parents("tr")).data();
        window.location.href = base_url + "pacientes/historia/" + dato.id;

    });

    // recibir inmunizaciones para mandarlas a la BD    
    $('#new_app1, #edit_office_form').validate({
        submitHandler: function (form) {
            $.ajax({
                url: base_url + 'megasalud/PatientsController/save',
                type: 'post',
                data: $(form).serialize(),
                success: function (respuesta) {
                    if (respuesta) {
                        Cookies.set('message', { type: 'success', message: 'Datos guardados correctamente' });
                        window.location.href = base_url + "pacientes/historia";
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
                },
                error: function (xhr, err) {
                }
            });
        }
    });

    $('#agregar_estudio').validate({
        submitHandler: function (form) {

            var formData = new FormData($("#agregar_estudio")[0]);

            $.ajax({
                url: base_url + 'megasalud/PatientsController/agregar_estudio',
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function (respuesta
                ) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        if (res.error == false) {
                            iziToast.success({
                                timeout: 3000,
                                title: 'Exito',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'Estudio Guardado.',
                            });
                            document.getElementById("title_estudio").value = "";
                            document.getElementById("fecha_estudio").value = "";
                            document.getElementById("estudio_sbr").value = "";
                        } else {
                            iziToast.error({
                                timeout: 3000,
                                title: 'Error',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'No se cargo el estudio. La imagen es muy pesada o no se admite ese tipo de archivos',
                            });
                        }

                    }

                }
            });
        }
    });

    $('#nueva-cita').validate({
        submitHandler: function (form) {

            var formData = new FormData($("#nueva-cita")[0]);

            $.ajax({
                url: base_url + 'megasalud/PatientsController/generar_cita',
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function (respuesta
                ) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        if (res.error == false) {
                            iziToast.success({
                                timeout: 3000,
                                title: 'Exito',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'Cita Generada.',
                            });
                        } else {
                            iziToast.error({
                                timeout: 3000,
                                title: 'Error',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'No se pudo crear la cita.',
                            });
                        }

                    }

                },
                error: function (xhr, err) {
                    console.log("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        }
    });

    $('#agregar_foto').validate({
        submitHandler: function (form) {

            var formData = new FormData($("#agregar_foto")[0]);

            $.ajax({
                url: base_url + 'megasalud/PatientsController/agregar_foto',
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function (respuesta) {
                    console.log(respuesta);
                    if (respuesta) {
                        var response = JSON.parse(respuesta);
                        if (response.error == false) {
                            Cookies.set('message', { type: 'success', message: 'Imagen actualizada' });

                            document.getElementById("foto_sbr").value = "";

                        }
                        else {
                            Cookies.set('message', { type: 'error', message: 'Imagen no soportada' });
                        }
                        location.reload();
                    }
                },
                error: function (xhr, err) {
                    console.log("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        }
    });

    $('#notas_dr').validate({

        submitHandler: function (form) {
            var new_nota = document.getElementById("notas_input").value;

            if (new_nota == "") {
                alert("Escribe algo");
            } else {
                $.ajax({
                    url: base_url + 'megasalud/PatientsController/notas_dr',
                    type: 'post',
                    data: $(form).serialize(),
                    success: function (respuesta) {
                        console.log(respuesta);
                        if (respuesta) {

                            iziToast.success({
                                timeout: 3000,
                                title: 'Exito',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'Nota Guardada.',
                            });

                            var res = JSON.parse(respuesta);
                            document.getElementById("text_notas").value += "(Hoy) \n" + new_nota + "";

                            document.getElementById("notas_input").value = "";

                            var h1 = $('#text_notas')[0].scrollHeight,
                                h2 = $('#text_notas').height();

                            $('#text_notas').scrollTop(h1 - h2);

                        }
                        else {
                            iziToast.error({
                                timeout: 3000,
                                title: 'Error',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'No se creo la nota',
                            });
                        }
                    },
                    error: function (xhr, err) {
                        console.log("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                    }
                });
            }

        }
    });

    $('#notas_input').keyup(function () {

        var texto = $(this).val();
        var textoA = texto.split(" ");
        var text = textoA[textoA.length - 1];

        $("#panel-ante").html("");
        if (text.length <= 0) {
            $("#panel-ante-vacunas").html("");
            $("#panel-ante-alergias").html("");
            $("#panel-ante-hospi").html("");
            $("#panel-ante-venenos").html("");
            $("#panel-ante-congenita").html("");
            $("#panel-ante-productos-ven").html("");

            $("#panel-ante-vacunas").removeAttr("style");
            $("#panel-ante-alergias").removeAttr("style");
            $("#panel-ante-hospi").removeAttr("style");
            $("#panel-ante-venenos").removeAttr("style");
            $("#panel-ante-congenita").removeAttr("style");
            $("#panel-ante-productos-ven").removeAttr("style");
        } else {
            var texto = {
                text: text
            }

            $.ajax({
                url: base_url + 'megasalud/PatientsController/get_ante_congenita',
                type: 'post',
                data: texto,
                success: function (respuesta) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        if (l > 0) {
                            $("#panel-ante-congenita").html("<h4>Congénitas</h4>");
                            if (l > 10) {
                                $("#panel-ante-congenita").attr("style", "height:150px; overflow: scroll; overflow-x: hidden; margin:10px;");
                            } else {
                                $("#panel-ante-congenita").removeAttr("style");
                            }
                            for (x = 0; x < l; x++) {
                                $("#panel-ante-congenita").append("<button class='btn btn-sm elemento' onclick='new_congenita(this)' data-name='" + data[x].enfermedad + "' data-value='" + data[x].id + "' >" + data[x].enfermedad + "</button>");

                            }
                        } else {
                            $("#panel-ante-congenita").html("");
                            $("#panel-ante-congenita").removeAttr("style");
                        }

                    }
                }
            });

            $.ajax({
                url: base_url + 'megasalud/PatientsController/get_ante_vacunas',
                type: 'post',
                data: texto,
                beforeSend: function () {
                    $("#loader_ante").show();
                },
                complete: function () {
                    $("#loader_ante").hide();
                },
                success: function (respuesta) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        if (l > 0) {
                            $("#panel-ante-vacunas").html("<h4>Vacunas</h4>");
                            if (l > 10) {
                                $("#panel-ante-vacunas").attr("style", "height:150px; overflow: scroll; overflow-x: hidden; margin:10px;");
                            } else {
                                $("#panel-ante-vacunas").removeAttr("style");
                            }
                            for (x = 0; x < l; x++) {
                                $("#panel-ante-vacunas").append("<button class='btn btn-sm elemento' onclick='new_vacuna(this)' data-name='" + data[x].vacuna + "' data-value='" + data[x].id + "' >" + data[x].vacuna + "</button>");

                            }
                        } else {
                            $("#panel-ante-vacunas").html("");
                            $("#panel-ante-vacunas").removeAttr("style");
                        }

                    }
                }
            });

            $.ajax({
                url: base_url + 'megasalud/PatientsController/get_ante_alergias',
                type: 'post',
                data: texto,
                success: function (respuesta) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        if (l > 0) {
                            $("#panel-ante-alergias").html("<h4>Alergías</h4>");
                            if (l > 10) {
                                $("#panel-ante-alergias").attr("style", "height:150px; overflow: scroll; overflow-x: hidden; margin:10px;");
                            } else {
                                $("#panel-ante-alergias").removeAttr("style");
                            }
                            for (x = 0; x < l; x++) {
                                $("#panel-ante-alergias").append("<button class='btn btn-sm elemento' onclick='new_alergia(this)' data-name='" + data[x].alergeno + "' data-value='" + data[x].id + "' >" + data[x].alergeno + "</button>");

                            }
                        } else {
                            $("#panel-ante-alergias").html("");
                            $("#panel-ante-alergias").removeAttr("style");
                        }

                    }
                }
            });

            $.ajax({
                url: base_url + 'megasalud/PatientsController/get_ante_hospi',
                type: 'post',
                data: texto,
                success: function (respuesta) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        if (l > 0) {
                            $("#panel-ante-hospi").html("<h4>Hospitalización</h4>");
                            if (l > 10) {
                                $("#panel-ante-hospi").attr("style", "height:150px; overflow: scroll; overflow-x: hidden; margin:10px;");
                            } else {
                                $("#panel-ante-hospi").removeAttr("style");
                            }
                            for (x = 0; x < l; x++) {
                                $("#panel-ante-hospi").append("<button class='btn btn-sm elemento' onclick='new_hospi(this)' data-name='" + data[x].causa + "' data-value='" + data[x].id + "' >" + data[x].causa + "</button>");

                            }
                        } else {
                            $("#panel-ante-hospi").html("");
                            $("#panel-ante-hospi").removeAttr("style");
                        }

                    }
                }
            });

            $.ajax({
                url: base_url + 'megasalud/PatientsController/get_ante_venenos',
                type: 'post',
                data: texto,
                success: function (respuesta) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        if (l > 0) {
                            $("#panel-ante-venenos").html("<h4>Venenos</h4>");
                            if (l > 10) {
                                $("#panel-ante-venenos").attr("style", "height:150px; overflow: scroll; overflow-x: hidden; margin:10px;");
                            } else {
                                $("#panel-ante-venenos").removeAttr("style");
                            }
                            for (x = 0; x < l; x++) {
                                $("#panel-ante-venenos").append("<button class='btn btn-sm elemento' onclick='new_veneno(this)' data-name='" + data[x].veneno + "' data-value='" + data[x].id + "' >" + data[x].veneno + "</button>");
                            }
                        } else {
                            $("#panel-ante-venenos").html("");
                            $("#panel-ante-venenos").removeAttr("style");
                        }

                    }
                }
            });

            $.ajax({
                url: base_url + 'megasalud/PatientsController/get_ante_medi',
                type: 'post',
                data: texto,
                success: function (respuesta) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        if (l > 0) {
                            $("#panel-ante-medi").html("<h4>Medicamentos</h4>");
                            if (l > 10) {
                                $("#panel-ante-medi").attr("style", "height:150px; overflow: scroll; overflow-x: hidden; margin:10px;");
                            } else {
                                $("#panel-ante-medi").removeAttr("style");
                            }
                            for (x = 0; x < l; x++) {
                                $("#panel-ante-medi").append("<button class='btn btn-sm elemento' onclick='new_medi(this)' data-name='" + data[x].medicamento + "' data-value='" + data[x].id + "' >" + data[x].medicamento + "</button>");
                            }
                        } else {
                            $("#panel-ante-medi").html("");
                            $("#panel-ante-medi").removeAttr("style");
                        }

                    }
                }
            });

            $.ajax({
                url: base_url + 'megasalud/PatientsController/get_ante_terapias',
                type: 'post',
                data: texto,
                success: function (respuesta) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        if (l > 0) {
                            $("#panel-ante-terapias").html("<h4>Terapias</h4>");
                            if (l > 10) {
                                $("#panel-ante-terapias").attr("style", "height:150px; overflow: scroll; overflow-x: hidden; margin:10px;");
                            } else {
                                $("#panel-ante-terapias").removeAttr("style");
                            }
                            for (x = 0; x < l; x++) {
                                $("#panel-ante-terapias").append("<button class='btn btn-sm elemento' onclick='new_terapia(this)' data-name='" + data[x].terapia + "' data-value='" + data[x].id + "' >" + data[x].terapia + "</button>");
                            }
                        } else {
                            $("#panel-ante-terapias").html("");
                            $("#panel-ante-terapias").removeAttr("style");
                        }

                    }
                }
            });

            $.ajax({
                url: base_url + 'megasalud/PatientsController/get_product_ven',
                type: 'post',
                data: texto,
                success: function (respuesta) {
                    if (respuesta) {
                        var res = JSON.parse(respuesta);
                        var data = res.data;
                        var l = data.length;
                        if (l > 0) {
                            $("#panel-ante-productos-ven").html("<h4>Productos</h4>");
                            if (l > 10) {
                                $("#panel-ante-productos-ven").attr("style", "height:150px; overflow: scroll; overflow-x: hidden; margin:10px;");
                            } else {
                                $("#panel-ante-productos-ven").removeAttr("style");
                            }
                            for (x = 0; x < l; x++) {
                                $("#panel-ante-productos-ven").append("<button class='btn btn-sm elemento' onclick='search_relation(this)' data-name='" + data[x].nombre_p + "' data-value='" + data[x].id + "' >" + data[x].nombre_p + "</button>");
                            }
                        } else {
                            $("#panel-ante-productos-ven").html("");
                            $("#panel-ante-productos-ven").removeAttr("style");
                        }

                    }
                }
            });
        }
    });



    $('#productos_ven').on('change', function () {
        var product = $(this).val();
        document.getElementById("panel-productos-ven").hidden = false;
        $("#panel-productos-ven").html("");
        search_relation_func(product, $(this).find(":selected").text());
    });


    $('#diagnostico_dr').validate({

        submitHandler: function (form) {
            var new_diag = document.getElementById("diagnostico_input").value;

            if (new_diag == "") {
                alert("Escribe algo");
            } else {
                $.ajax({
                    url: base_url + 'megasalud/PatientsController/diagnostico_dr',
                    type: 'post',
                    data: $(form).serialize(),
                    success: function (respuesta) {
                        console.log(respuesta);
                        if (respuesta) {

                            iziToast.success({
                                timeout: 3000,
                                title: 'Exito',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'Diagnóstico Guardado.',
                            });

                            var res = JSON.parse(respuesta);
                            document.getElementById("text_diag").value += "(Hoy) \n" + new_diag + "";

                            document.getElementById("diagnostico_input").value = "";

                            var h1 = $('#text_diag')[0].scrollHeight,
                                h2 = $('#text_diag').height();

                            $('#text_diag').scrollTop(h1 - h2);
                            $("#divLinea").load(" #divLinea");
                        }
                        else {
                            iziToast.error({
                                timeout: 3000,
                                title: 'Error',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'No se creo el diagnóstico',
                            });
                        }
                    },
                    error: function (xhr, err) {
                        console.log("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                    }
                });
            }

        }
    });


    $('#form-terapia').validate({
        submitHandler: function (form) {
            $.ajax({
                url: base_url + 'megasalud/PatientsController/save_hisclinic_terapia',
                type: 'post',
                data: $(form).serialize(),
                success: function (respuesta) {
                    if (respuesta) {

                        iziToast.success({
                            timeout: 3000,
                            title: 'Exito',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'Terapia Guardada.',
                        });

                        var res = JSON.parse(respuesta);
                        $("#divLinea").load(" #divLinea");

                    }
                    else {
                        iziToast.error({
                            timeout: 3000,
                            title: 'Error',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'No se guardo la terapia',
                        });
                    }
                },
                error: function (xhr, err) {
                }
            });

        }
    });

    $('#carga_heredo_in').validate({
        submitHandler: function (form) {
            //console.log('Submit');
            $.ajax({
                url: base_url + 'megasalud/PatientsController/carga_heredo_in',
                type: 'post',
                data: $(form).serialize(),
                success: function (respuesta) {
                    if (respuesta) {
                        iziToast.success({
                            timeout: 3000,
                            title: 'Exito',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'Carga Hereditaria Guardada.',
                        });

                        document.getElementById("padecimiento").value = "";
                        document.getElementById("familiar_heredo").value = "";
                    }
                    else {
                        iziToast.error({
                            timeout: 3000,
                            title: 'Error',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'No se creo.',
                        });
                    }
                },
                error: function (xhr, err) {
                    console.log("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        }
    });

    $('#ante_in').validate({
        submitHandler: function (form) {
            //console.log('Submit');
            $.ajax({
                url: base_url + 'megasalud/PatientsController/ante_in',
                type: 'post',
                data: $(form).serialize(),
                success: function (respuesta) {
                    if (respuesta) {

                        iziToast.success({
                            timeout: 3000,
                            title: 'Exito',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'Antecedente Guardado.',
                        });

                        document.getElementById("familiar_ante").value = "";
                        document.getElementById("antecedente_heredo").value = "";
                        document.getElementById("descripcion").value = "";
                        $("#divLinea").load(" #divLinea");
                    }
                    else {
                        iziToast.error({
                            timeout: 3000,
                            title: 'Error',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'No se creo.',
                        });
                    }
                },
                error: function (xhr, err) {

                }
            });
        }
    });


    //Datos de enfermedades infectocontagiosas

    $('#enf_infecto_psicologicas').validate({
        submitHandler: function (form) {
            //console.log('Submit');
            $.ajax({
                url: base_url + 'megasalud/PatientsController/enf_psicologica',
                type: 'post',
                data: $(form).serialize(),
                success: function (respuesta) {
                    if (respuesta) {

                        iziToast.success({
                            timeout: 3000,
                            title: 'Exito',
                            position: 'topRight',
                            message: 'Psicologica Guardada.',
                        });

                        document.getElementById("enf_psico").value = "";
                        document.getElementById("manejo_psico").value = "";
                        document.getElementById("med_psico").value = "";
                        document.getElementById("edad_psico").value = "";
                        $("#divLinea").load(" #divLinea");
                    }
                    else {
                        iziToast.error({
                            timeout: 3000,
                            title: 'Error',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'No se creo la inmunizacion.',
                        });
                    }
                },
                error: function (xhr, err) {

                }
            });
        }
    });

    $('#enf_infecto_otras').validate({
        submitHandler: function (form) {
            //console.log('Submit');
            $.ajax({
                url: base_url + 'megasalud/PatientsController/enf_otras',
                type: 'post',
                data: $(form).serialize(),
                success: function (respuesta) {
                    if (respuesta) {
                        Cookies.set('message', { type: 'success', message: 'Datos guardados correctamente' });

                        iziToast.success({
                            timeout: 3000,
                            title: 'Exito',
                            position: 'topRight',
                            message: 'Datos Guardados.',
                        });

                        document.getElementById("enf_otras").value = "";
                        document.getElementById("manejo_otras").value = "";
                        document.getElementById("med_otras").value = "";
                        document.getElementById("edad_otras").value = "";
                        $("#divLinea").load(" #divLinea");
                    }
                    else {
                        iziToast.error({
                            timeout: 3000,
                            title: 'Error',
                            position: 'topRight',
                            // target: '.login-message',
                            message: 'No se creo la inmunizacion.',
                        });
                    }
                },
                error: function (xhr, err) {
                    console.log("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        }
    });

    $('#edit_pacient_form').validate({
        submitHandler: function (form) {
            $.ajax({
                url: base_url + 'megasalud/PatientsController/updateEntry',
                type: 'post',
                data: $(form).serialize(),
                success: function (respuesta) {
                    if (respuesta) {

                        Cookies.set('message', { type: 'success', message: 'Datos actualizados correctamente' });

                        window.location.href = base_url + "pacientes";

                    }

                    form.reset();
                    window.scrollTo(0, 0);
                }
            });
        }
    });

    //Al seleccionar otro
    $('#motivo, #motivo_m,#start_consultaMotivo').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-m").hidden = false;

        } else {
            document.getElementById("panel-add-m").hidden = true;
        }
    });

    $('#enfermedad').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-ec").hidden = false;

        } else {
            document.getElementById("panel-add-ec").hidden = true;
        }
    });

    $('#medicamento').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-med").hidden = false;

        } else {
            document.getElementById("panel-add-med").hidden = true;
        }
    });

    $('#p_medicamento').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-med").hidden = false;

        } else {
            document.getElementById("panel-add-med").hidden = true;
        }
    });

    $('#terapia').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-ter").hidden = false;

        } else {
            document.getElementById("panel-add-ter").hidden = true;
        }
    });

    $('#alergeno').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-a").hidden = false;
            document.getElementById("panel-add-ma").hidden = true;

        }
        else if ($(this).find(":selected").val() == "Medicamento") {
            document.getElementById("panel-add-a").hidden = true;
            document.getElementById("panel-add-ma").hidden = false;
            document.getElementById("panel-add-ma").innerHTML = "<input class='form-control' placeholder='¿Cuál medicamento?' name='med_op' id='med_op' />";

        } else {
            document.getElementById("panel-add-a").hidden = true;
            document.getElementById("panel-add-ma").hidden = true;
        }
    });

    $('#tratamiento_ale').on('change', function () {
        if ($(this).find(":selected").val() == "Otro") {
            document.getElementById("panel-add-a-trat").hidden = false;

        } else {
            document.getElementById("panel-add-a-trat").hidden = true;
        }
    });

    $('#causa_h').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-causa_h").hidden = false;

        } else {
            document.getElementById("panel-add-causa_h").hidden = true;
        }
    });

    $('#med_h').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-med_h").hidden = false;

        } else {
            document.getElementById("panel-add-med_h").hidden = true;
        }
    });

    $('#operacion_h').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-ope").hidden = false;

        } else {
            document.getElementById("panel-add-ope").hidden = true;
        }
    });

    $('#tipo_ane').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-ane").hidden = false;

        } else {
            document.getElementById("panel-add-ane").hidden = true;
        }
    });

    $('#tipo_trans').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-trans").hidden = false;

        } else {
            document.getElementById("panel-add-trans").hidden = true;
        }
    });

    $('#tipo_prot').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-prot").hidden = false;

        } else {
            document.getElementById("panel-add-prot").hidden = true;
        }
    });

    $('#tipo_prot').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-prot").hidden = false;

        } else {
            document.getElementById("panel-add-prot").hidden = true;
        }
    });

    $('#enf_virus').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-vi").hidden = false;

        } else {
            document.getElementById("panel-add-vi").hidden = true;
        }
    });

    $('#med_virus').on('change', function () {
        if ($(this).find(":selected").val() == "Otro") {
            document.getElementById("panel-add-med_virus").hidden = false;

        } else {
            document.getElementById("panel-add-med_virus").hidden = true;
        }
    });

    $('#enf_bac').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-bac").hidden = false;

        } else {
            document.getElementById("panel-add-bac").hidden = true;
        }
    });

    $('#med_bac').on('change', function () {
        if ($(this).find(":selected").val() == "Otro") {
            document.getElementById("panel-add-med_bac").hidden = false;

        } else {
            document.getElementById("panel-add-med_bac").hidden = true;
        }
    });

    $('#enf_hongo').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-hongo").hidden = false;

        } else {
            document.getElementById("panel-add-hongo").hidden = true;
        }
    });

    $('#med_hongo').on('change', function () {
        if ($(this).find(":selected").val() == "Otro") {
            document.getElementById("panel-add-med_ho").hidden = false;

        } else {
            document.getElementById("panel-add-med_ho").hidden = true;
        }
    });

    $('#enf_para').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-enf_para").hidden = false;

        } else {
            document.getElementById("panel-add-enf_para").hidden = true;
        }
    });

    $('#med_para').on('change', function () {
        if ($(this).find(":selected").val() == "Otro") {
            document.getElementById("panel-add-med_pa").hidden = false;

        } else {
            document.getElementById("panel-add-med_pa").hidden = true;
        }
    });

    $('#enf_psico').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-psico").hidden = false;

        } else {
            document.getElementById("panel-add-psico").hidden = true;
        }
    });

    $('#med_psico').on('change', function () {
        if ($(this).find(":selected").val() == "Otro") {
            document.getElementById("panel-add-med_ps").hidden = false;

        } else {
            document.getElementById("panel-add-med_ps").hidden = true;
        }
    });

    $('#enf_otras').on('change', function () {
        if ($(this).find(":selected").val() == "Otra") {
            document.getElementById("panel-add-otras").hidden = false;

        } else {
            document.getElementById("panel-add-otras").hidden = true;
        }
    });

    $('#med_otras').on('change', function () {
        if ($(this).find(":selected").val() == "Otro") {
            document.getElementById("panel-add-med_otras").hidden = false;

        } else {
            document.getElementById("panel-add-med_otras").hidden = true;
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
                                    $('#start_consultaMotivo').append("<option selected value='" + res.id_m + "' >" + res.dat + "</option>");
                                    break;
                                case 2:
                                    $('#enfermedad').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");

                                    $("#panel-congenita").append("<button class='btn btn-sm elemento' onclick='new_congenita(this)' data-name='" + res.dat + "' data-value='" + res.id_dat + "' >" + res.dat + "</button>");
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
                                    $('#p_medicamento').append("<option selected value='" + res.id_dat + "' >" + res.dat + "</option>");
                                    break;
                                case 4:
                                    /*$('#vacuna').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");*/

                                    $("#panel-vacunas").append("<button class='btn btn-sm elemento' onclick='new_vacuna(this)' data-name='" + res.dat + "' data-value='" + res.id_dat + "' >" + res.dat + "</button>");
                                    break;
                                case 5:
                                    /* $('#alergeno').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");*/

                                    $("#panel-alergias").append("<button class='btn btn-sm elemento' onclick='new_alergia(this)' data-name='" + res.dat + "' data-value='" + res.id_dat + "' >" + res.dat + "</button>");
                                    break;
                                case 6:
                                    $('#tratamiento_ale').append("<option selected value='" + res.dat + "' >" + res.dat + "</option>");
                                    break;
                                case 7:
                                    /*$('#causa_h').append("<option selected value='"+res.dat+"' >"+res.dat+"</option>");*/

                                    $("#panel-hospi").append("<button class='btn btn-sm elemento' onclick='new_hospi(this)' data-name='" + res.dat + "' data-value='" + res.id_dat + "' >" + res.dat + "</button>");
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
                                    $('#terapia').append("<option selected value='" + res.id_dat + "' >" + res.dat + "</option>");
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
                    }

                },
                error: function (xhr, err) {

                }
            });
        }
    });

}

function recargarLinea() {
    $("#divLinea").load(" #divLinea");
}

function copiarAutoinmune(elemento) {

    var enf = elemento.dataset.value;

    document.getElementById("padecimiento").value = enf;

    //se cierra el modal
    $('#closeModal').click();

}



