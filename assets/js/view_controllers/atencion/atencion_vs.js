var table = $('#main-table').DataTable({
    fixedHeader: true,
    scrollY: true,
    columnDefs: [{
        className: 'clipboard',targets: 1,
        className: 'mayus',targets: 2
    },
    { responsivePriority: 1, targets: 1 },
    { responsivePriority: 2, targets: 4 },
    { responsivePriority: 3, targets: 2 },
    { targets: [ 0 ], visible: false }
    ],
    order: [ 0, 'des' ],
    language: {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    },
    dom: '<"row" <"col-sm-4" l> <"col-sm-8" <"pull-right ml-15" B><"pull-right" f> > >r<"mt-30" t><"row mt-30" <"col-sm-5" i> <"col-sm-7" p> >',
    buttons: [
    {
        extend: 'excel',
        className: 'btn btn-success',
        exportOptions: {
            columns: ':not(:last-child)',
        },
        init: function(api, node, config) {
            $(node).removeClass('dt-button');
        }
    },
    {
        text: 'Nuevo Paciente',
        className: 'btn btn-primary',
        action: function(e, dt, node, config){
            window.location.href = base_url + 'pacientes/nuevo'
        },
        init: function(api, node, config) {
            $(node).removeClass('dt-button');
        }
    }
    ],
    ajax:{
        type:"post",
        url: base_url + "pacientes/getxMxQ",
    },
    
    columns:[
        
        {"data":"id"},
        {"data":"clave_bancaria"},
        {"data":"nombre"},
        {"data":"email"},
        {"data":"estado"},
        {"data":"telefono_a"},
        {"defaultContent":"<button id='btn-ver-paciente' title='Ver Paciente' class='btn-editar btn btn-sm btn-primary '><i class='fa fa-eye'></i></button><button id='btn-adeudos' title='Ver Adeudos' class='btn-historia btn btn-sm btn-info '><i class='fa fa-h-square'></i></button><button id='btn-editar' title='Editar Paciente' class='btn-editar btn btn-sm btn-warning '><i class='fa fa-edit'></i></button>"}
    ],
});

$("#main-table").on("click", "#btn-ver-paciente", function(){
    var data = table.row( $(this).parents("tr") ).data();
    window.location.href = base_url + "atencion/ver-paciente/" + data.id;
    
  });

  $("#main-table").on("click", "#btn-adeudos", function(){
    var data = table.row( $(this).parents("tr") ).data();
    window.location.href = base_url + "pacientes/adeudos/" + data.id;
    
  });

$("#main-table").on("click", "#btn-editar", function(){
    var data = table.row( $(this).parents("tr") ).data();
    window.location.href = base_url + "pacientes/editar/" + data.id;
        
  });

$('#main-table').on('click', 'tbody tr td', function () {
    var data = table.row( $(this).parents("tr") ).data();
            iziToast.info({
                            timeout: 2000,
                            title: 'Copiado',
                            position: 'center',
                            message: ''+ data.clave_bancaria,
                        });
    var aux = document.createElement("input");
    aux.setAttribute("value", data.clave_bancaria);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand('copy');
    aux.setAttribute("type", "hidden");

    });


    var table = $('#pros-table').DataTable({
        fixedHeader: true,
        scrollY: true,
        columnDefs: [{
            className: 'clipboard',targets: 1,
            className: 'mayus',targets: 2
        },
        { responsivePriority: 1, targets: 1 },
        { responsivePriority: 2, targets: 4 },
        { responsivePriority: 3, targets: 2 },
        { targets: [ 0 ], visible: false }
        ],
        order: [ 0, 'des' ],
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        dom: '<"row" <"col-sm-4" l> <"col-sm-8" <"pull-right ml-15" B><"pull-right" f> > >r<"mt-30" t><"row mt-30" <"col-sm-5" i> <"col-sm-7" p> >',
        buttons: [
        {
            extend: 'excel',
            className: 'btn btn-success',
            exportOptions: {
                columns: ':not(:last-child)',
            },
            init: function(api, node, config) {
                $(node).removeClass('dt-button');
            }
        },
        {
            text: 'Nuevo Prospectos',
            className: 'btn btn-primary',
            action: function(e, dt, node, config){
                window.location.href = base_url + 'registrarme'
            },
            init: function(api, node, config) {
                $(node).removeClass('dt-button');
            }
        }
        ],
        ajax:{
            type:"post",
            url: base_url + "prospectos/getxMxQ",
        },
        
        columns:[
            
            {"data":"id"},
            {"data":"nombre"},
            {"data":"telefono"},
            {"data":"enfermedad"},
            {"data":"ciudad"},
            {"data":"notas"},
            {"data":"fecha"},
            {"defaultContent":"-"}
        ],
    });
    
    $("#pros-table").on("click", "#btn-ver-paciente", function(){
        var data = table.row( $(this).parents("tr") ).data();
        window.location.href = base_url + "atencion/ver-paciente/" + data.id;
        
      });
