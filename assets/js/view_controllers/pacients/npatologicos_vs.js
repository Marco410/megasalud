$('#btn-npato').click(function () {
    if ($(this).attr("data") == 1) {

        $(this).addClass("active");
        $('#p-npato').show();
        $(this).attr("data", 0);

    } else {
        $(this).removeClass("active");
        $('#p-npato').hide();
        $(this).attr("data", 1);
    }

});

//Clasificacion a venenos

$('#btn-micro').click(function () {

    $('#nombre_c').html("<h4>Microbios</h4>");

    $("#clas_a").html("");

    $("#clas_a").append("<button class='btn btn-sm btn-teal' onclick='get_c_b(this)' data-value='Biologicos' >Biologicos</button>");

    $("#clas_b").html("");
    $("#clas_c").html("");
    $("#clas_d").html("");
    $("#clas_e").html("");
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_b").hide();
    $("#c_c").hide();
    $("#c_d").hide();
    $("#c_e").hide();
    $("#c_f").hide();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();
});

$('#btn-venenos').click(function () {

    $('#nombre_c').html("<h4>No Biologicos | Microondas | Agrícolas | Industriales | Riesgos Caseros | Animales, Plantas y Hongos</h4>");

    $("#clas_a").html("");

    $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='No Biologicos' >No Biologicos</button>");

    $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Microondas' >Microondas</button>");
    $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Agricolas' >Agricolas</button>");
    $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Industriales' >Industriales</button>");
    $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Caseros' >Riesgos Caseros</button>");
    $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Animales' >Animales,<br> Plantas y Hongos</button>");
    $("#clas_a").append("<button class='btn btn-sm btn-teal btn-a' onclick='get_c_b(this)' style='margin-bottom:5px;' data-value='Alimentos' >Alimentos</button>");
    $("#clas_b").html("");
    $("#clas_c").html("");
    $("#clas_d").html("");
    $("#clas_e").html("");
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_b").hide();
    $("#c_c").hide();
    $("#c_d").hide();
    $("#c_e").hide();
    $("#c_f").hide();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();
});

$('#btn-radiaciones').click(function () {
    $('#nombre_c').html("<h4>Radiaciones</h4>");

    $("#clas_a").html("");

    $("#clas_a").append("<button class='btn btn-sm btn-teal' onclick='get_c_b(this)' data-value='Radiaciones' >Radiaciones</button>");

    $("#clas_b").html("");
    $("#clas_c").html("");
    $("#clas_d").html("");
    $("#clas_e").html("");
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_b").hide();
    $("#c_c").hide();
    $("#c_d").hide();
    $("#c_e").hide();
    $("#c_f").hide();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();
});

$('#btn-metales').click(function () {

});

var clasis = {
    'c_a': ""
}

function get_c_b(elemento) {


    if ($('.btn-a').hasClass('active')) {
        $('.btn-a').removeClass("active");
    } else {
        elemento.className += " active";
    }

    $("#clas_c").html("");
    $("#clas_d").html("");
    $("#clas_e").html("");
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_b").show();
    $("#c_c").hide();
    $("#c_d").hide();
    $("#c_e").hide();
    $("#c_f").hide();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();

    elemento.className += ' active';

    $("#clas_b").html("");
    var c = elemento.dataset.value;


    clasis["c_a"] = c;
    clasis["c_b"] = "0";
    clasis["c_c"] = "0";
    clasis["c_d"] = "0";
    clasis["c_e"] = "0";
    clasis["c_f"] = "0";
    clasis["c_g"] = "0";
    clasis["c_h"] = "0";

    var data = {
        "clas": c,
        "clasi": "c_b",
        "clasi_an": "c_a",
        "clasis": clasis
    };

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_c',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader").show();
        },
        complete: function () {
            $("#loader").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;
                for (x = 0; x < l; x++) {
                    if (data[x].c_b == 0) {
                        $("#clas_b").append("<b>No hay</b>");
                        get_v(c, "c_a");
                    } else {
                        $("#clas_b").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-b' onclick='get_c_c(this)' data-value='" + data[x].c_b + "' >" + data[x].c_b + "</button><br>");
                    }
                }
            }
            else {
            }
        }
    });
}

function get_c_c(elemento) {

    if ($('.btn-b').hasClass('active')) {
        $('.btn-b').removeClass("active");
    } else {
        elemento.className += " active";
    }
    elemento.className += " active";
    $("#clas_d").html("");
    $("#clas_e").html("");
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_c").html("");
    $("#clas_v").html("");
    $("#c_c").show();
    $("#c_d").hide();
    $("#c_e").hide();
    $("#c_f").hide();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();
    var c = elemento.dataset.value;
    clasis["c_b"] = c;
    clasis["c_c"] = "0";
    clasis["c_d"] = "0";
    clasis["c_e"] = "0";
    clasis["c_f"] = "0";
    clasis["c_g"] = "0";
    clasis["c_h"] = "0";

    var data = {
        "clas": c,
        "clasi": "c_c",
        "clasi_an": "c_b",
        "clasis": clasis
    };
    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_c',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader").show();
        },
        complete: function () {
            $("#loader").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;

                for (x = 0; x < l; x++) {
                    if (data[x].c_c == 0) {
                        $("#clas_c").append("<b>No hay</b>");
                        get_v(c, "c_b");
                    } else {
                        $("#clas_c").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-c' onclick='get_c_d(this)' data-value='" + data[x].c_c + "' >" + data[x].c_c + "</button><br>");
                    }
                }
            }
            else {
            }
        },
        error: function (xhr, err) {
        }
    });
}

function get_c_d(elemento) {
    if ($('.btn-c').hasClass('active')) {
        $('.btn-c').removeClass("active");
    } else {
        elemento.className += " active";
    }
    elemento.className += " active";
    $("#clas_d").html("");
    $("#clas_e").html("");
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_d").show();
    $("#c_e").hide();
    $("#c_f").hide();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();
    var c = elemento.dataset.value;

    clasis["c_c"] = c;
    clasis["c_d"] = "0";
    clasis["c_e"] = "0";
    clasis["c_f"] = "0";
    clasis["c_g"] = "0";
    clasis["c_h"] = "0";

    var data = {
        "clas": c,
        "clasi": "c_d",
        "clasi_an": "c_c",
        "clasis": clasis
    };


    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_c',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader").show();
        },
        complete: function () {
            $("#loader").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;

                for (x = 0; x < l; x++) {
                    if (data[x].c_d == 0) {
                        $("#clas_d").append("<b>No hay</b>");
                        get_v(c, "c_c");
                    } else {
                        $("#clas_d").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-d' onclick='get_c_e(this)' data-value='" + data[x].c_d + "' >" + data[x].c_d + "</button><br>");
                    }
                }
            }
            else {
            }
        },
        error: function (xhr, err) {
        }
    });
}

function get_c_e(elemento) {
    if ($('.btn-d').hasClass('active')) {
        $('.btn-d').removeClass("active");
    } else {
        elemento.className += " active";
    }
    elemento.className += " active";
    $("#clas_e").html("");
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_e").show();
    $("#c_f").hide();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();
    var c = elemento.dataset.value;

    clasis["c_d"] = c;
    clasis["c_e"] = "0";
    clasis["c_f"] = "0";
    clasis["c_g"] = "0";
    clasis["c_h"] = "0";
    var data = {
        "clas": c,
        "clasi": "c_e",
        "clasi_an": "c_d",
        "clasis": clasis
    };


    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_c',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader").show();
        },
        complete: function () {
            $("#loader").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;

                for (x = 0; x < l; x++) {
                    if (data[x].c_e == 0) {
                        $("#clas_e").append("<b>No hay</b>");
                        get_v(c, "c_d");
                    } else {
                        $("#clas_e").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-e' onclick='get_c_f(this)' data-value='" + data[x].c_e + "' >" + data[x].c_e + "</button><br>");
                    }
                }
            }
            else {
            }
        },
        error: function (xhr, err) {
        }
    });
}

function get_c_f(elemento) {
    if ($('.btn-e').hasClass('active')) {
        $('.btn-e').removeClass("active");
    } else {
        elemento.className += " active";
    }
    elemento.className += " active";
    $("#clas_f").html("");
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_f").show();
    $("#c_g").hide();
    $("#c_h").hide();
    $("#c_v").hide();
    var c = elemento.dataset.value;
    clasis["c_e"] = c;
    clasis["c_f"] = "0";
    clasis["c_g"] = "0";
    clasis["c_h"] = "0";
    var data = {
        "clas": c,
        "clasi": "c_f",
        "clasi_an": "c_e",
        "clasis": clasis
    };

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_c',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader").show();
        },
        complete: function () {
            $("#loader").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;

                for (x = 0; x < l; x++) {
                    if (data[x].c_f == 0) {
                        $("#clas_f").append("<b>No hay</b>");
                        get_v(c, "c_e");
                    } else {
                        $("#clas_f").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-f' onclick='get_c_g(this)' data-value='" + data[x].c_f + "' >" + data[x].c_f + "</button><br>");
                    }
                }
            }
            else {
            }
        },
        error: function (xhr, err) {
        }
    });
}

function get_c_g(elemento) {
    if ($('.btn-f').hasClass('active')) {
        $('.btn-f').removeClass("active");
    } else {
        elemento.className += " active";
    }
    elemento.className += " active";
    $("#clas_g").html("");
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_g").show();
    $("#c_h").hide();
    $("#c_v").hide();
    var c = elemento.dataset.value;
    clasis["c_f"] = c;
    clasis["c_g"] = "0";
    clasis["c_h"] = "0";

    var data = {
        "clas": c,
        "clasi": "c_g",
        "clasi_an": "c_f",
        "clasis": clasis
    };


    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_c',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader").show();
        },
        complete: function () {
            $("#loader").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;

                for (x = 0; x < l; x++) {
                    if (data[x].c_g == 0) {
                        $("#clas_g").append("<b>No hay</b>");
                        get_v(c, "c_f");
                    } else {
                        $("#clas_g").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-g' onclick='get_c_h(this)' data-value='" + data[x].c_g + "' >" + data[x].c_g + "</button><br>");
                    }
                }
            }
            else {
            }
        },
        error: function (xhr, err) {
        }
    });
}

function get_c_h(elemento) {
    if ($('.btn-g').hasClass('active')) {
        $('.btn-g').removeClass("active");
    } else {
        elemento.className += " active";
    }
    elemento.className += " active";
    $("#clas_h").html("");
    $("#clas_v").html("");
    $("#c_h").show();
    $("#c_v").hide();
    var c = elemento.dataset.value;

    clasis["c_g"] = c;
    clasis["c_h"] = "0";
    var data = {
        "clas": c,
        "clasi": "c_h",
        "clasi_an": "c_g",
        "clasis": clasis
    };

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_c',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader").show();
        },
        complete: function () {
            $("#loader").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;

                for (x = 0; x < l; x++) {
                    if (data[x].c_h == 0) {
                        $("#clas_h").append("<b>No hay</b>");
                        get_v(c, "c_g");
                    } else {
                        $("#clas_h").append("<button style='margin-bottom:5px;' class='btn btn-sm btn-dark btn-h' onclick='get_v(this)' data-value='" + data[x].c_h + "' >" + data[x].c_h + "</button><br>");
                    }
                }
            }
            else {
            }
        }
    });
}

function get_v(elemento, clasi_an) {
    if ($('.btn-h').hasClass('active')) {
        $('.btn-h').removeClass("active");
    } else {
        elemento.className += " active";
    }
    elemento.className += " active";
    try {
        c = elemento.dataset.value;
        clasi_an = "c_h";
    }
    catch {
        c = elemento;
    }

    $("#clas_v").html("");

    clasis["c_h"] = c;
    $("#c_v").show();
    var data = {
        "clas": c,
        "clasi": "veneno",
        "clasi_an": clasi_an,
        "clasis": clasis
    };

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_v',
        type: 'post',
        data: data,
        beforeSend: function () {
            $("#loader").show();
        },
        complete: function () {
            $("#loader").hide();
        },
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;
                for (x = 0; x < l; x++) {
                    $("#clas_v").append("<button style='margin-bottom:5px;' onclick='new_veneno(this)' class='btn btn-sm btn-primary'  data-value='" + data[x].id + "' >" + data[x].veneno + "</button><br>");
                }
            }
            else {
            }
        },
        error: function (xhr, err) {
        }
    });
}

function new_veneno_all(elemento) {
    $("#modal_new_veneno_all").modal("show");
    $("#id_product").val(elemento.dataset.value);

    var data = {
        "id_product": elemento.dataset.value
    };

    $('#product_name').html(elemento.dataset.name);

}

function new_veneno(elemento) {
    $("#modal_new_veneno").modal("show");
    $("#id_veneno").val(elemento.dataset.value);

    var data = {
        "id_veneno": elemento.dataset.value
    };

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_clasificacion',
        type: 'post',
        data: data,
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;
                $("#show_a").html("A: " + data.c_a);
                if (data.c_b != 0) {
                    $("#show_b").html("B: " + data.c_b);
                } else {
                    $("#show_b").html("");
                }
                if (data.c_c != 0) {
                    $("#show_c").html("C: " + data.c_c);
                } else {
                    $("#show_c").html("");
                }
                if (data.c_d != 0) {
                    $("#show_d").html("D: " + data.c_d);
                } else {
                    $("#show_d").html("");
                }
                if (data.c_e != 0) {
                    $("#show_e").html("E: " + data.c_e);
                } else {
                    $("#show_e").html("");
                }
                if (data.c_f != 0) {
                    $("#show_f").html("F: " + data.c_f);
                } else {
                    $("#show_f").html("");
                }
                if (data.c_g != 0) {
                    $("#show_g").html("G: " + data.c_g);
                } else {
                    $("#show_g").html("");
                }
                if (data.c_h != 0) {
                    $("#show_h").html("H: " + data.c_h);
                } else {
                    $("#show_h").html("");
                }
            }
            else {
            }
        }
    });

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_relations',
        type: 'post',
        data: data,
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;
                $("#veneno_relations").html("");
                for (var i = 0; i < l; i++) {
                    $("#veneno_relations").append("<button type='button' class='btn btn-sm elemento' >" + data[i].nombre_p + " </button>");
                }
            }
            else {
            }
        }
    });

}

function search_relation(elemento) {
    document.getElementById("panel-productos-ven").hidden = false;
    $("#panel-productos-ven").html("");
    search_relation_func(elemento.dataset.value, elemento.dataset.name);
}

function search_relation_func(product, product_name) {
    var texto = {
        producto_id: product
    }

    $.ajax({
        url: base_url + 'megasalud/PatientsController/get_relations_product',
        type: 'post',
        data: texto,
        success: function (respuesta) {
            if (respuesta) {
                var res = JSON.parse(respuesta);
                var data = res.data;
                var l = data.length;

                if (l > 0) {
                    $("#panel-productos-ven").append("<h5>Venenos en el producto: <b class='text-primary' >" + product_name + "</b> </h5>");
                    $("#panel-productos-ven").append("<button style='width:100%' class='btn btn-sm elemento' onclick='new_veneno_all(this)' data-name='" + product_name + "' data-value='" + product + "' >Agregar Todos</button>");
                    if (l > 10) {
                        $("#panel-productos-ven").attr("style", "height:250px; overflow: scroll; overflow-x: hidden; margin:10px;");
                    } else {
                        $("#panel-productos-ven").removeAttr("style");
                    }
                    for (x = 0; x < l; x++) {
                        $("#panel-productos-ven").append("<button class='btn btn-sm elemento' onclick='new_veneno(this)' data-name='" + data[x].veneno + "' data-value='" + data[x].veneno_id + "' >" + data[x].veneno + "</button>");
                    }

                } else {
                    $("#panel-productos-ven").html("");
                    $("#panel-productos-ven").append("<h5 class='text-danger' >Sin venenos</h5>");

                    $("#panel-productos-ven").removeAttr("style");
                }

            }
        }
    });
}

function save_new_veneno(anio, id_paciente) {
    var data = {
        "id_veneno": $("#id_veneno").val(),
        "frecc": $("#frecc").val(),
        "edad_veneno": $("#edad_veneno").val(),
        "id_paciente": id_paciente,
        "anio": anio,
        "clasis": clasis
    };

    if ($("#frecc").val() == "") {
        alert("Seleccione una frecuencia");
    } else {
        $.ajax({
            url: base_url + 'megasalud/PatientsController/new_veneno',
            type: 'post',
            data: data,
            success: function (respuesta) {
                if (respuesta) {
                    var res = JSON.parse(respuesta);
                    iziToast.success({
                        timeout: 3000,
                        title: 'Exito',
                        position: 'topRight',
                        message: 'Nuevo veneno guardado.',
                    });

                    $("#form_new_veneno")[0].reset();
                    $("#modal_new_veneno").modal("hide");

                    $("#divLinea").load(" #divLinea");
                }
                else {
                }
            }
        });
    }


}

function save_new_veneno_all(anio, id_paciente) {
    var data = {
        "id_product": $("#id_product").val(),
        "frecc_all": $("#frecc_all").val(),
        "edad_veneno_all": $("#edad_veneno_all").val(),
        "id_paciente": id_paciente,
        "anio": anio
    };

    if ($("#frecc_all").val() == "") {
        alert("Seleccione una frecuencia");
    } else {
        $.ajax({
            url: base_url + 'megasalud/PatientsController/new_veneno_all',
            type: 'post',
            data: data,
            success: function (respuesta) {
                if (respuesta) {
                    console.log(respuesta);
                    var res = JSON.parse(respuesta);
                    iziToast.success({
                        timeout: 3000,
                        title: 'Exito',
                        position: 'topRight',
                        message: 'Venenos del producto agregados correctamente.',
                    });

                    $("#form_new_veneno")[0].reset();
                    $("#modal_new_veneno_all").modal("hide");

                    $("#divLinea").load(" #divLinea");
                }
                else {
                }
            }
        });
    }


}
