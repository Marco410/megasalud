Pace.on('done', function () {
	init();
});

function init() {
	let checked = false;
	var espanol = {
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

	var table2 = $('#venenos-table').DataTable({
		fixedHeader: true,
		columnDefs: [{
			className: 'control',
			orderable: false,
			targets: [3]
		}
		],
		order: [0, 'desc'],
		language: espanol,
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
			}, {
				text: 'Nuevo Veneno',
				className: 'btn btn-primary',
				action: function (e, dt, node, config) {
					window.location.href = base_url + 'venenos/nuevo'
				},
				init: function (api, node, config) {
					$(node).removeClass('dt-button');
				}
			}
		],
		ajax: {
			type: "post",
			url: base_url + 'megasalud/VenenosController/get_venenos',
		},

		columns: [

			{ "data": "id" },
			{ "data": "c_a" },
			{
				"data": "c_b", 'render': function (data) {
					var v = "";
					if (data == 0) {
						v = "SC";
					} else {
						v = data;
					}
					return v;
				}
			},
			{
				"data": "c_c", 'render': function (data) {
					var v = "";
					if (data == 0) {
						v = "SC";
					} else {
						v = data;
					}
					return v;
				}
			},
			{
				"data": "c_d", 'render': function (data) {
					var v = "";
					if (data == 0) {
						v = "SC";
					} else {
						v = data;
					}
					return v;
				}
			},
			{
				"data": "c_e", 'render': function (data) {
					var v = "";
					if (data == 0) {
						v = "SC";
					} else {
						v = data;
					}
					return v;
				}
			},
			{
				"data": "c_f", 'render': function (data) {
					var v = "";
					if (data == 0) {
						v = "SC";
					} else {
						v = data;
					}
					return v;
				}
			},
			{
				"data": "c_g", 'render': function (data) {
					var v = "";
					if (data == 0) {
						v = "SC";
					} else {
						v = data;
					}
					return v;
				}
			},
			{
				"data": "c_h", 'render': function (data) {
					var v = "";
					if (data == 0) {
						v = "SC";
					} else {
						v = data;
					}
					return v;
				}
			},
			{
				"data": "veneno", 'render': function (data) {
					var v = "";
					if (data == 0) {
						v = "SC";
					} else {
						v = data;
					}
					return "<span class='text-primary' >" + v + "</span>";
				}
			},
			{ "defaultContent": "<button id='btn-editar' class='btn-editar btn btn-sm btn-warning '><i class='fa fa-edit'></i></button><button id='btn-delete' class='btn-delete btn btn-sm btn-danger '><i class='fa fa-trash'></i></button>" }
		],
	});

	$("#venenos-table").on("click", "#btn-editar", function () {
		var data = table2.row($(this).parents("tr")).data();
		window.location.href = base_url + "venenos/editar/" + data.id;
	});

	$("#venenos-table").on("click", "#btn-delete", function () {
		var data = table2.row($(this).parents("tr")).data();
		let id = data.id;

		var opcion = confirm("¿Seguro que deseas eliminar?");
		if (opcion == true) {
			$.ajax({
				url: base_url + 'megasalud/VenenosController/delete/' + id,
				success: function (res) {
					if (res) {
						iziToast.success({
							timeout: 3000,
							title: 'Veneno',
							position: 'topRight',
							message: 'Eliminado Correctamente',
						});
					} else {
						alert("No se pudo eliminar");
					}
				},
				error: function (res) {
				}
			});
		} else {
			alert("¡Ok!");
		}
		$(this).closest('tr').remove();
	});

	var table = $('#main-table').DataTable({
		fixedHeader: true,
		columnDefs: [{
			className: 'control',
			orderable: false,
			targets: [3]
		}
		],
		order: [0, 'desc'],
		language: espanol,
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
			}
		],
		ajax: {
			type: "post",
			url: base_url + 'megasalud/VenenosController/get_medi',
		},

		columns: [

			{ "data": "id" },
			{ "data": "medicamento" },
			{ "data": "nombre" },
			{ "defaultContent": "<button id='btn-ver' class='btn-editar btn btn-sm btn-info '><i class='fa fa-eye'></i></button><button id='btn-editar' class='btn-editar btn btn-sm btn-warning '><i class='fa fa-edit'></i></button><button id='btn-delete' class='btn-delete btn btn-sm btn-danger '><i class='fa fa-trash'></i></button>" }
		],
	});

	$("#main-table").on("click", "#btn-editar", function () {
		var data = table.row($(this).parents("tr")).data();
		window.location.href = base_url + "venenos/editar-medicamento/" + data.id;
	});

	$("#main-table").on("click", "#btn-ver", function () {
		var data = table.row($(this).parents("tr")).data();
		let id = data.id;
		$.ajax({
			url: base_url + 'megasalud/VenenosController/show/' + id,
			success: function (res) {
				let json = JSON.parse(res);
				let data = json.data;
				$('#m-medicamento').html(data.medicamento);
				$('#m-nombre').html(data.nombre);
				$('#m-contra').html(data.contra);

				$("#modal-info").modal();
			},
			error: function (res) {
			}
		});
	});

	$("#main-table").on("click", "#btn-delete", function () {
		var data = table.row($(this).parents("tr")).data();
		let id = data.id;

		var opcion = confirm("¿Seguro que deseas eliminar?");
		if (opcion == true) {
			$.ajax({
				url: base_url + 'megasalud/VenenosController/delete_medi/' + id,
				success: function (res) {
					if (res) {
						iziToast.success({
							timeout: 3000,
							title: 'Medicamento ',
							position: 'topRight',
							message: 'Eliminado Correctamente',
						});
					} else {
						alert("No se pudo eliminar");
					}
				},
				error: function (res) {
				}
			});
		} else {
			alert("¡Ok!");
		}
		$(this).closest('tr').remove();
	});

	$('#form-new-medi').validate({

		submitHandler: function (form) {
			$.ajax({
				url: base_url + 'megasalud/VenenosController/insert_medi',
				type: 'post',
				data: $(form).serialize(),
				success: function (respuesta) {
					if (respuesta) {

						iziToast.success({
							timeout: 3000,
							title: 'Correcto',
							position: 'topRight',
							message: 'Medicamento guardado',
						});

						form.reset();
					}
					else {
						iziToast.error({
							timeout: 3000,
							title: 'Error',
							position: 'topRight',
							// target: '.login-message',
							message: 'Error al guardar',
						});
					}
				},
				error: function (xhr, err) {
				}
			});

		}
	});

	$('#form-edit-medi').validate({

		submitHandler: function (form) {
			$.ajax({
				url: base_url + 'megasalud/VenenosController/edit_medi',
				type: 'post',
				data: $(form).serialize(),
				success: function (respuesta) {
					if (respuesta) {

						Cookies.set('message', { type: 'success', message: 'Actualizado correctamente' });
						window.location.href = base_url + "venenos";
					}
					else {
						iziToast.error({
							timeout: 3000,
							title: 'Error',
							position: 'topRight',
							// target: '.login-message',
							message: 'Error al actualizar',
						});
					}
				},
				error: function (xhr, err) {
				}
			});

		}
	});

	$('#producto_ven').on('change', function () {
		if ($(this).find(":selected").val() == "nuevo") {
			document.getElementById("panel-add-v").hidden = false;
			document.getElementById("panel-relacion").hidden = true;

		} else {
			document.getElementById("panel-add-v").hidden = true;
			document.getElementById("panel-relacion").hidden = false;

			$("#producto_id").val($(this).val());
		}
	});

	$('#delete_relation').on('show.bs.modal', function (e) {

		var id = $(e.relatedTarget).data().id;
		$("#relation_id").val("" + id);

	});

	$('#add_relacion_form').validate({
		submitHandler: function (form) {

			$.ajax({
				url: base_url + 'megasalud/VenenosController/add_relation',
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
								message: 'Relación guardada correctamente.',
							});

							$("#list-product").append('<li class="list-group-item"><a data-id="' + res.producto_id + '" data-toggle="modal" data-target="#delete_relation" class="text-danger" > <i class="fa fa-trash"></i></a> ' + res.producto + ' </li> ');


						} else {
							iziToast.error({
								timeout: 3000,
								title: 'Error',
								position: 'topRight',
								// target: '.login-message',
								message: 'No se guardo. ' + res.msj,
							});

						}
					}

				}
			});
		}
	});

	$('#delete_relation_form').validate({
		submitHandler: function (form) {

			$.ajax({
				url: base_url + 'megasalud/VenenosController/delete_relation',
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
								message: 'Relación borrada correctamente.',
							});

							setTimeout(function () { location.reload(); }, 2500);

						} else {
							iziToast.error({
								timeout: 3000,
								title: 'Error',
								position: 'topRight',
								// target: '.login-message',
								message: 'No se elimino. ' + res.msj,
							});

						}
					}

				}
			});
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
								case 19:
									$('#producto_ven').append("<option selected value='" + res.id_dat + "' >" + res.dat + "</option>");
									break;
							}

							$("#producto_id").val(res.id_dat);
							$("#addSet").modal("hide");
							$("#dato").val("");


						} else {
							iziToast.error({
								timeout: 3000,
								title: 'Error',
								position: 'topRight',
								// target: '.login-message',
								message: 'No se guardo. ' + res.msj,
							});

						}
					}

				},
				error: function (xhr, err) {

				}
			});
		}
	});

	$('#create_veneno_form').validate({

		submitHandler: function (form) {
			$.ajax({
				url: base_url + 'megasalud/VenenosController/store',
				type: 'post',
				data: $(form).serialize(),
				success: function (respuesta) {
					var res = JSON.parse(respuesta);
					if (respuesta) {
						if (res.error != true) {
							Cookies.set('message', { type: 'success', message: 'Veneno Guardado' });
							window.location.href = base_url + "venenos";
						} else {
							iziToast.error({
								timeout: 3000,
								title: 'Error:',
								position: 'topRight',
								// target: '.login-message',
								message: res.msj,
							});
						}
					}
					else {
						iziToast.error({
							timeout: 3000,
							title: 'Error',
							position: 'topRight',
							// target: '.login-message',
							message: 'Error inesperado',
						});
					}
				},
				error: function (xhr, err) {
				}
			});

		}
	});


}
