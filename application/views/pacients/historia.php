<?php
$img_load = base_url('assets/images/loader') . '/';
$img_path = base_url('assets/images/icons') . '/';
$img_perfil = base_url('assets/foto_paciente') . '/';
$paciente = $paciente->row();
$fecha = substr($paciente->fecha_nacimiento, 0, 4);
$type = $this->session->type;

function calcular_edad($fecha)
{
    $fecha_nac = new DateTime(date('Y/m/d', strtotime($fecha)));
    $fecha_hoy = new DateTime(date('Y/m/d', time()));
    $edad = date_diff($fecha_hoy, $fecha_nac);
    return $edad;
}

$edad = calcular_edad($paciente->fecha_nacimiento);
$fechaMax = $edad->format('%Y') . '.' . $edad->format('%m');
?>
<div class="container">
    <input type="hidden" value="<?= $fecha ?>" id="anio" />
    <input type="hidden" id="seguimiento" value="<?= $paciente->seguim ?>" />
    <input type="hidden" id="id_paciente" name="id_paciente" value="<?= $paciente->id ?>" />


    <h3 class="ms-title"><b>HISTORIAL CLÍNICO</b> <button style="margin-left:300px;" class="btn btn-md btn-success"
            id="btn-iniciarConsulta"> <i class="fa fa-play"></i> Iniciar Consulta</button><button
            style="margin-left:300px;display:none;" class="btn btn-md btn-danger" id="btn-terminar-consulta"
            data-id=""> <i class="fa fa-stop"></i> Terminar Consulta</button> <i class="fa fa-clock-o"></i> <a
            href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i>
            <span>Regresar</span></a> </h3>

    <div class=" panel panel-primary" id="panel-iniciar-consulta" hidden>
        <div class="panel-body">
            <div class="container">
                <div class="col-sm-6 panel-body row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label>Motivo de Consulta</label>

                        </div>

                        <input type="hidden" id="sub_start_consulta" name="sub_start_consulta" value="0" />

                        <input type="hidden" id="clave_bancaria_start_consulta" name="clave_bancaria_start_consulta"
                            value="<?= $paciente->clave_bancaria ?>" />

                        <input type="hidden" id="estado_start_consulta" name="estado_start_consulta"
                            value="<?= $paciente->estado ?>" />

                        <div class="col-sm-12">
                            <select class="form-control select2 " style="width: 100%" required id="start_consultaMotivo"
                                name="start_consultaMotivo">
                                <option value="">Seleccione: </option>

                                <?php foreach ($motivo_consulta->result() as $motivo): ?>
                                <option value="<?= $motivo->enfermedad ?>"><?= $motivo->enfermedad ?></option>
                                <?php endforeach ?>
                                <option value="Otra">Otra</option>
                            </select>

                        </div>
                    </div>
                    <div class="" id="panel-add-m" hidden>
                        <br>
                        <a href="#" class="btn btn-sm btn-info" data-id="1" data-toggle="modal"
                            data-target="#addSet"><span class="fa fa-plus"></span>Añadir Nueva</a>
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <br>
                    <div class="col-sm-6">

                        <label for="">Primera Vez
                            <input type="radio" name="tipo_consulta" id="1" value="Primera Vez" />
                        </label>
                    </div>
                    <div class="col-sm-6">

                        <label for="">Subsecuente
                            <input type="radio" name="tipo_consulta" id="2" value="Subsecuente" />
                        </label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <button class="btn btn-sm btn-block btn-success" id="btn-iniciar-consulta"> <i
                            class="fa fa-play"></i> Empezar</button>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-4">
            <!--- Panel de Identificacion  --->
            <div class="panel panel-primary" style="border-radius:15px">
                <div class="panel-heading text-center" style="border-radius:15px">
                    <h2><i class="glyphicon glyphicon-user "></i>
                        <?= $paciente->nombre . ' ' . $paciente->apellido_p . ' ' . $paciente->apellido_m ?> </h2>
                </div>
                <div class="panel-body ">
                    <div class="container">
                        <div class="row" style="margin-bottom:10px;">
                            <div class="col-sm-6 text-center">
                                <?php if($paciente->foto == ""){ if ($paciente->sexo == "Masculino"){ ?>
                                <img src="<?php echo $img_path; ?>hombre.svg" width="100px" height="100px" alt=""
                                    class="img-responsive center-block" />
                                <?php } else{ ?>
                                <img src="<?php echo $img_path; ?>mujer.svg" width="100px" height="100px" alt=""
                                    class="img-responsive center-block" />
                                <?php }}else{ ?>
                                <img src="<?php echo $img_perfil . $paciente->foto; ?>" width="100px" height="100px" alt=""
                                    class="img-responsive img-circle center-block" />
                                <?php } ?>
                                <br>
                                <div class="">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#foto"><i
                                            class="fa fa-picture-o"></i> Actualizar Foto</a>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <h5>Motivo de Consulta: <label class="sm"
                                        id="motivo_consulta_label"><b><?= $paciente->motivo_consulta ?></b></label>
                                </h5>
                                <h5>Expediente: <label class="sm"><b><?= $paciente->clave_bancaria ?></b></label>
                                </h5>
                                <h5>Sucursal: <label class="sm"><b><?= $paciente_suc->razon_social ?></b></label>
                                </h5>
                                <h5>Ocupación: <label
                                        class="sm"><b><?= is_numeric($paciente->ocupacion) ? ($paciente_empleo ? $paciente_empleo->name : '<small class="text-danger">Edite el empleo</small>') : '<small class="text-danger">Edite el empleo</small>' ?></b></label>
                                </h5>
                                <h5>Edad: <label class="sm"><b> <?= $edad->format('%Y') ?> años y
                                            <?= $edad->format('%m') ?> meses</b></label></h5>
                            </div>

                        </div>
                        <div class="row" style="margin-butto">
                            <div class="col-sm-12 text-center">
                                <a class="badge badge-info p-5" data-toggle="collapse" href="#collapseInfo"
                                    role="button" aria-expanded="false" aria-controls="collapseInfo"> Ver más...
                                </a>
                            </div>
                        </div>

                        <div class="row collapse " id="collapseInfo">
                            <div class="form-group col-sm-6 text-center">
                                <label class="sm">Fecha de Nacimiento:</label><br>
                                <span><?= $paciente->fecha_nacimiento ?>
                                </span><br>
                                <label class="sm">Sexo:</label><br><span><?= $paciente->sexo ?></span><br>
                                <label class="sm">Estado Civil:</label><br>
                                <span><?= $paciente->estado_civil ?></span><br>
                                <label class="sm">Origen:</label><br>
                                <span><?= $paciente->municipio_origen . ' ' . $paciente->estado_origen . ' ' . $paciente->pais_origen ?>
                                </span>
                            </div>
                            <div class="form-group col-sm-6 text-center">
                                <label class="sm">Residencia:</label><br>
                                <span><?= $paciente->calle . ' ' . $paciente->colonia . ' ' . $paciente->cp . ' ' . $paciente->municipio . ' ' . $paciente->estado . ' ' . $paciente->pais ?>
                                </span> <br>
                                <label class="sm">Teléfono:
                                </label><br><span><?= ' ' . $paciente->telefono_a . ' ó ' . $paciente->telefono_b ?></span><br>
                                <label class="sm">E-mail: </label><br><span><?= $paciente->email ?></span> <br>
                                <label class="sm">Hora para
                                    llamarle:</label><br><span><?= $paciente->hr_llamarle ?></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 text-center ">
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#historial"><i
                                            class="fa fa-clock-o "></i> Citas</a>
                                    <a href="<?= base_url() . 'pacientes/editar/' . $paciente->id ?>"
                                        class="btn  btn-warning btn-sm"><i class="fa fa-edit "></i> Editar</a>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#pass"
                                        id="show-pass" name="show-pass"><i class="fa fa-key "></i>
                                        Contraseña</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--- Termina Panel de Identificacion  --->
        </div>

        <!-- Modal Contraseña -->
        <div class="modal fade" id="pass" tabindex="-1" role="dialog" aria-labelledby="Password"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Contraseña</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Solo muestrasela al paciente</label>
                        <p><?= $paciente->password ?></p>
                    </div>

                </div>
            </div>
        </div>
        <!-- Termina Modal Contraseña -->

        <!-- Modal Sucursal -->
        <div class="modal fade" id="sucursal_modal" tabindex="-1" role="dialog" aria-labelledby="Password"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fotoPerfil">Selecciona Sucursal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="insert-suc" method="post" name="insert-suc">
                        <div class="modal-body">
                            <div class="row">
                                <div id="panel-sucursales" class="col-sm-8" hidden>
                                    <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                                    <label>
                                        Sucursal
                                    </label>
                                    <select id="suc_paciente" name="suc_paciente" class="form-control" required>

                                        <option value="">Seleccione una opción</option>
                                        <?php foreach ($sucursales->result() as $sucursal): ?>
                                        <option value="<?= $sucursal->id ?>"><?= $sucursal->razon_social ?></option>
                                        <?php endforeach ?>

                                    </select>


                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"> <button class="btn btn-sm btn-primary" type="submit"><i
                                    class="fa fa-save"> </i> Guarda en Sucursal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Termina Modal Sucursal -->

        <!-- Modal  Historial citas -->

        <div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="fotoPerfil"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Citas del Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Doctor</th>
                                        <th>Motivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($historial->result() as $his):?>
                                    <tr>
                                        <td><?= $his->created_at ?></td>
                                        <td><?= $his->nombre ?> </td>
                                        <td><?= $his->motivo ?></td>
                                    </tr>
                                    <?php endforeach ?>

                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--- Termina modal Historial citas -->

        <!-- Modal Agregar Foto -->
        <div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="fotoPerfil"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="agregar_foto" name="agregar_foto" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <b>Selecciona la imagen</b>
                                    <input class="form-control" type="file" id="foto_sbr" name="foto_sbr"
                                        accept="image/x-png,image/gif,image/jpeg" />
                                    <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!--- Termina modal foto -->

        <div class="col-sm-8">
            <!--- Panel de Acciones  --->
            <div class="panel panel-primary" style="border-radius:15px">
                <div class="panel mb-0 panel-default panel-flat border-left-brown">
                    <div class="panel-heading">
                        <span class="ms-subtitle">ACCIONES</span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <!-- Botones estudios y recetas -->
                            <div class="row">
                                <div class="col-sm-3 text-center">
                                    <h5 class="text-center title">ESTUDIOS</h5>
                                    <div class="btn-group-vertical">
                                        <a href="<?= base_url() . 'pacientes/historia/' . $paciente->id . '/estudios/' . $paciente->id ?>"
                                            class="btn btn-info btn-info-user"><i class="fa fa-file-text-o"></i>
                                            Ver</a>
                                        <a id="estudiosBtn" class="btn btn-info" data-toggle="modal"
                                            data-target="#estudios"><i class="fa fa-plus"></i> Agregar</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <h5 class="text-center title">RECETA</h5>
                                    <div class="btn-group-vertical">
                                        <a id="receta" href="<?= base_url() ?>pedidos/receta/<?= $paciente->id ?>"
                                            class="btn btn-info "><i class="fa fa-file-text"></i> Crear</a>
                                        <a href="<?= base_url() ?>pacientes/recetas/<?= $paciente->id ?>"
                                            class="btn btn-info "><i class="fa fa-file-text"></i> Ver</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <h5 class="text-center title">GRÁFICAS</h5>
                                    <div class="btn-group-vertical">
                                        <a href="<?= base_url() . 'pacientes/graficas/' . $paciente->id ?>"
                                            class="btn btn-info btn-info-user"><i class="fa fa-bar-chart"></i> Ver</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <h5 class="text-center title">CREAR CITA</h5>
                                    <div class="btn-group-vertical">
                                        <a class="btn btn-info text-center" data-toggle="modal"
                                            data-target="#nuevacita"><i class="fa fa-calendar "></i> Nueva</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <h5 class="text-center title">RESUMEN</h5>
                                    <div class="btn-group-vertical">
                                        <a href="<?= base_url() ?>pacientes/resumen/<?= $paciente->id ?>"
                                            class="btn btn-info "><i class="fa fa-folder"></i> Ver</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <h5 class="text-center title">FINANZAS</h5>
                                    <div class="btn-group-vertical">
                                        <a href="<?= base_url() ?>pacientes/adeudos/<?= $paciente->id ?>"
                                            class="btn btn-info "><i class="fa fa-h-square"></i> Ver </a>

                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row" style="margin-top:40px;margin-bottom:20px;">
              <div class="col-sm-12 text-center">
              <?php if ($paciente->seguim != 0){  ?><button  class="btn btn-md btn-warning  ml-2" data-toggle="modal" data-target="#citaSubsecuente" > <i class="fa fa-plus" ></i> Agregar Cita Subsecuente</button><?php } ?>
              </div>
            </div> -->
                            <!-- Modal Cita Subsecuente -->
                            <?php if ($paciente->seguim != 0){  ?>
                            <div class="modal fade" id="citaSubsecuente" tabindex="-1" role="dialog"
                                aria-labelledby="Password" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cita Subsecuente</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <form name="inicia_consulta" method="post" id="inicia_consulta">
                                                    <input type="hidden" id="sub" name="sub"
                                                        value="<?= $paciente->seguim ?>" />
                                                    <input type="hidden" id="id_paciente" name="id_paciente"
                                                        value="<?= $paciente->id ?>" />
                                                    <input type="hidden" id="id_user" name="id_user"
                                                        value="<?= $this->session->id ?>" />

                                                    <div class="col-sm-6">
                                                        <label>Motivo de Consulta</label>
                                                        <select class="form-control" required id="motivo"
                                                            name="motivo">
                                                            <option value="">Seleccione: </option>

                                                            <?php foreach ($motivo_consulta->result() as $motivo): ?>
                                                            <option value="<?= $motivo->enfermedad ?>">
                                                                <?= $motivo->enfermedad ?></option>
                                                            <?php endforeach ?>
                                                            <option value="Otra">Otra</option>
                                                        </select>
                                                        <div class="" id="panel-add-m" hidden>
                                                            <br>
                                                            <a href="#" class="btn btn-sm btn-info"
                                                                data-id="1" data-toggle="modal"
                                                                data-target="#addSet"><span
                                                                    class="fa fa-plus"></span>Añadir Nueva</a>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Descripción</label>
                                                        <input required type="text" class="form-control"
                                                            id="motivo_des" name="motivo_des"
                                                            placeholder="Escribe Motivo o Descripción" />
                                                    </div>

                                                    <div class="col-sm-12 text-center">
                                                        <button type="submit" class="btn btn-warning btn-block"
                                                            style="margin-top:10px"><i
                                                                class="glyphicon glyphicon-play"></i> Iniciar Cita
                                                            Subsecuente</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <?php } ?>
                            <!-- Termina Modal Cita Subsecuente -->
                        </div>
                    </div>

                </div>

            </div>
            <!--- Termina Panel de Acciones  --->
            <!--- Panel de Signos Vitales  --->
            <div id="signos-vitales" class="panel panel-default">
                <div class="panel-heading">
                    <span class="ms-subtitle">Signos Vitales </span>
                </div>

                <div class="panel-body">
                    <form id="form_signos" name="form_signos" method="post">
                        <input type="hidden" value="<?= $fecha ?>" name="anio" />
                        <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="">Altura (cm)</label>
                                <input class="form-control" type="text" name="altura" id="altura"
                                    placeholder="Cm" />
                            </div>
                            <div class="col-sm-2">
                                <label for="">Peso (kg)</label>
                                <input class="form-control" type="text" name="peso" id="peso"
                                    placeholder="Kg" />
                            </div>
                            <div class="col-sm-2">
                                <label for="">IMC <small id="imcCal"></small></label>
                                <input class="form-control" readonly type="text" name="imc" id="imc"
                                    placeholder="" />

                            </div>
                            <div class="col-sm-2">
                                <label for="">Presión Arterial</label>
                                <input class="form-control" type="text" name="presion_arterial"
                                    placeholder="mm Hg" />
                            </div>
                            <div class="col-sm-2">
                                <label for="">Pulso</label>
                                <input class="form-control" type="text" name="pulso" placeholder="L/min" />
                            </div>
                            <div class="col-sm-2">
                                <label for="">Temperatura</label>
                                <input class="form-control" type="text" name="temperatura" placeholder="°C" />
                            </div>

                        </div>
                        <div class="row float-right" style="margin-top:10px">
                            <div class="col-sm-6 col-sm-offset-3 mt-4 text-center">
                                <label>Edad</label>
                                <input id="edad_signo" required type="number" name="edad_signo"
                                    class="form-control" value="<?= $fechaMax ?>" min="0"
                                    max="<?= $fechaMax ?>" />
                                <button type="submit" class="btn btn-primary " style="margin-top:10px;"> <i
                                        class="fa fa-save"></i> Guardar Signos Vitales</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--- Termina Panel de Signos Vitales  --->
            <!--- Panel de Msj Consulta  --->
            <div id="consulta-msj" class="panel panel-default">
                <div class="panel-heading">
                    <span class="ms-subtitle">Mensaje sobre la Consulta</span>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5 class="text-warning">Debes iniciar una consulta para poder acceder a los demás
                                componentes.</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!--- Termina Panel de Msj Consulta  --->
        </div>
    </div>
</div>


<!--- Accion de primera vez  --->
<div id="primera_vez" class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <!--- Panel de Notas  --->
            <div class="panel mb-0 panel-default panel-flat border-left-brown">
                <div class="panel-heading">
                    <span class="ms-subtitle">NOTAS | MOTIVO DE CONSULTA </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-sm-10">
                            <form name="notas_dr" method="post" id="notas_dr">
                                <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                                <!--- Estas lineas dejarlas asi  --->
                                <b>Notas del doctor</b>
                                <textarea rows="8" readonly class="form-control" id="text_notas"><?php foreach ($notas->result() as $nota):?>
(<?= date('j M, Y h:i a', strtotime($nota->created_at)) ?>): 
<?= $nota->nota ?>                
<?php endforeach ?></textarea>
                                <!--- Estas lineas dejarlas asi  --->
                                <div id="notas-motivo" class="">
                                    <div style="position: absolute">
                                        <div id="inputs-search" style="position:relative; bottom:35px;"></div>
                                    </div>
                                    <textarea name="notas_input" id="notas_input" class="form-control" type="text"
                                        placeholder="Agrega una nueva nota"></textarea>

                                    <div class="col-sm-8 col-sm-offset-2">
                                        <button type="submit" class="btn btn-info btn-info-user btn-block"
                                            style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i> Guardar
                                            Nota</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div id="productos" class="col-sm-2">
                            <label for="">Productos:</label>
                            <select class="form-control select2" name="productos_ven" id="productos_ven">
                                <option value="">Buscar...</option>
                                <?php foreach ($productos_ven->result() as $pro):?>
                                <option value="<?= $pro->id ?>"><?= $pro->nombre_p ?></option>
                                <?php endforeach ?>
                            </select>

                            <div id="panel-productos-ven" hidden>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div id="loader_ante" hidden><img loading="lazy" height="50px" width="50px"
                                    src="<?php echo $img_load; ?>loader.gif" alt=""
                                    class="img-responsive center-block" /> </div>
                            <div class="col-sm-6">
                                <div id="panel-ante-vacunas"></div>
                                <div id="panel-ante-alergias"></div>
                                <div id="panel-ante-congenita"></div>
                                <div id="panel-ante-terapias"></div>
                            </div>
                            <div class="col-sm-6">
                                <div id="panel-ante-hospi"></div>
                                <div id="panel-ante-venenos"></div>
                                <div id="panel-ante-medi"></div>
                                <div id="panel-ante-productos-ven"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--- Termina Panel de Notas  --->
        </div>
    </div>
    <!--- Termina Panel Notas y Acciones  --->

    <div id="antecedentes" class="panel panel-brown" style="border-radius:15px">
        <div class="panel-heading text-center" data-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="collapseLinea" style="border-radius:15px">
            <h3>ANTECEDENTES</h3>
        </div>
        <div>
            <div class="panel-body text-center">
                <!-- Tabs de antecedentes -->
                <ul class="nav nav-tabs mb-5 text-center " id="pills-tab" role="tablist">
                    <li class="nav-item mr-3">
                        <a style="font-size: 15px;" class="btn btn-warning btn-lg" id="btn-heredo" data="1"
                            data-toggle="pill" href="#btn-heredofa" role="tab" aria-controls="heredo"
                            aria-selected="true">HEREDOFAMILIARES</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-size: 15px;" class="btn btn-warning btn-lg " id="btn-pato" data="1"
                            data-toggle="pill" href="#btn-patolo" role="tab" aria-controls="pato"
                            aria-selected="false">PATOLÓGICOS</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-size: 15px;" class="btn btn-warning btn-lg " id="btn-npato"
                            data-toggle="pill" href="#npato" role="tab" aria-controls="npato"
                            aria-selected="false">NO PATOLÓGICOS</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-size: 15px;" class="btn btn-warning btn-lg " id="btn-terapias"
                            data-toggle="pill" href="#terapias" role="tab" aria-controls="terapias"
                            aria-selected="false">TERAPIAS Y MEDICAMENTOS</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-size: 15px;" class="btn btn-warning btn-lg " id="btn-diagnostico"
                            data-toggle="pill" href="#diagnostico" role="tab" aria-controls="diagnostico"
                            aria-selected="false">DIAGNÓSTICO</a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade" id="btn-heredofa" data="1" role="tabpanel"
                        aria-labelledby="herdo-tab">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="text-center">Carga Hereditaria</h4>
                                <form id="carga_heredo_in" name="carga_heredo_in" method="post">

                                    <div class="col-sm-5">
                                        <b>Padecimiento</b>
                                        <input readonly id="padecimiento" name="padecimiento" type="text"
                                            class="form-control" />
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Ver</b>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#modalAutoinmune">
                                            <i class="fa fa-file-text-o"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-5">
                                        <b>Familiar </b>
                                        <select id="familiar_heredo" name="familiar_heredo"
                                            class="select2 form-control">
                                            <option value="No seleccionado">Seleccione</option>
                                            <?php foreach ( $familiar->result() as $familia ): ?>
                                            <option value="<?= $familia->familiar ?>"><?= $familia->familiar ?>
                                            </option>
                                            <?php endforeach ?>
                                        </select>

                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                                        <br>
                                        <button type="submit" class="btn btn-info"><i
                                                class="fa fa-plus "></i>Agregar </button>
                                    </div>

                                </form>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="text-center">Congénita</h4>
                                <div id="loader_congenitas" hidden><img loading="lazy" height="50px" width="50px"
                                        src="<?php echo $img_load; ?>loader.gif" alt=""
                                        class="img-responsive center-block" /> </div>
                                <div id="panel-congenita" style="height:200px; overflow: scroll; overflow-x: hidden;">
                                </div>
                                <div class="" id="panel-add-ec" hidden>
                                    <br>
                                    <a href="#" class="btn btn-sm btn-info" data-id="2" data-toggle="modal"
                                        data-target="#addSet"><span class="fa fa-plus"></span>Añadir Nueva</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="btn-patolo" data="1" role="tabpanel"
                        aria-labelledby="pato-tab">
                        <div class="row">
                            <div class="col-sm-4">
                                <h4 class="text-center">Vacunas</h4>
                                <div id="loader_vacunas" hidden><img loading="lazy" height="50px" width="50px"
                                        src="<?php echo $img_load; ?>loader.gif" alt=""
                                        class="img-responsive center-block" /> </div>

                                <div id="panel-vacunas" style="height:200px; overflow: scroll; overflow-x: hidden; ">
                                </div>
                                <div class="" id="panel-add-v" hidden>
                                    <br>
                                    <a href="#" class="btn btn-sm btn-info" data-id="4" data-toggle="modal"
                                        data-target="#addSet"><span class="fa fa-plus"></span>Añadir Nueva</a>
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <h4 class="text-center">Alergías</h4>
                                <div id="loader_alergias" hidden><img loading="lazy" height="50px" width="50px"
                                        src="<?php echo $img_load; ?>loader.gif" alt=""
                                        class="img-responsive center-block" /> </div>
                                <div id="panel-alergias" style="height:200px; overflow: scroll; overflow-x: hidden; ">

                                </div>
                                <div id="panel-add-ma"></div>
                                <div id="panel-add-a" hidden>
                                    <br>
                                    <a href="#" class="btn btn-sm btn-info" data-id="5" data-toggle="modal"
                                        data-target="#addSet"><span class="fa fa-plus"></span>Añadir Nueva</a>
                                </div>


                            </div>
                            <div class="col-sm-4">
                                <h4 class="text-center">Hospitalizaciones</h4>
                                <div id="loader_hospi" hidden><img loading="lazy" height="50px" width="50px"
                                        src="<?php echo $img_load; ?>loader.gif" alt=""
                                        class="img-responsive center-block" /> </div>
                                <div id="panel-hospi" style="height:200px; overflow: scroll; overflow-x: hidden; ">

                                </div>
                                <div id="panel-add-causa_h" hidden>
                                    <br>
                                    <a href="#" class="btn btn-sm btn-info" data-id="7" data-toggle="modal"
                                        data-target="#addSet"><span class="fa fa-plus"></span>Añadir Nueva</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="npato" role="tabpanel" aria-labelledby="npato-tab">

                        <div class="col-sm-12">
                            <div class="text-center"><small>Da clic en el menú para empezar a buscar</small></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row" style="margin-bottom:20px">
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-info  "
                                                    id="btn-micro">Microbios</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-info  "
                                                    id="btn-venenos">Venenos</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-info"
                                                    id="btn-radiaciones">Radiaciones</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-info" disabled
                                                    id="btn-metales">Metales</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="col-sm-12 text-center">
                                            <div class="" id="nombre_c"></div>
                                            <div id="loader" hidden><img loading="lazy" height="50px"
                                                    width="50px" src="<?php echo $img_load; ?>loader.gif"
                                                    alt="" class="img-responsive center-block" /> </div>
                                        </div>

                                        <div class="col-sm-2" id="c_a">
                                            <div class="text-center"><b>A</b></div>
                                            <div id="clas_a"></div>
                                        </div>

                                        <div class="col-sm-2" id="c_b" hidden>
                                            <div class="text-center"><b>B</b></div>
                                            <div id="clas_b"></div>
                                        </div>

                                        <div class="col-sm-2" id="c_c" hidden>
                                            <div class="text-center"><b>C</b></div>
                                            <div id="clas_c"></div>
                                        </div>
                                        <div class="col-sm-2" id="c_d" hidden>
                                            <div class="text-center"><b>D</b></div>
                                            <div id="clas_d"></div>
                                        </div>
                                        <div class="col-sm-2" id="c_e" hidden>
                                            <div class="text-center"><b>E</b></div>
                                            <div id="clas_e"></div>
                                        </div>
                                        <div class="col-sm-2" id="c_f" hidden>
                                            <div class="text-center"><b>F</b></div>
                                            <div id="clas_f"></div>
                                        </div>
                                        <div class="col-sm-2" id="c_g" hidden>
                                            <div class="text-center"><b>G</b></div>
                                            <div id="clas_g"></div>
                                        </div>
                                        <div class="col-sm-2" id="c_h" hidden>
                                            <div class="text-center"><b>H</b></div>
                                            <div id="clas_h"></div>
                                        </div>
                                        <div class="col-sm-2" id="c_v" hidden>
                                            <div class="text-center"><b>Veneno</b></div>
                                            <div style="height:250px; overflow: scroll; overflow-x: hidden; ">
                                                <div id="clas_v"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="terapias" role="tabpanel" aria-labelledby="terapias-tab">
                        <div id="divMedi" class="row">

                            <div class="col-sm-4">
                                <form id="form-terapia" name="form-terapia" method="post">
                                    <input type="hidden" value="<?= $fecha ?>" name="anio" />
                                    <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                                    <h5>Terapía</h5>
                                    <select style="width: 100%;" required id="terapia" class="select2"
                                        name="terapia">
                                        <option value="">Seleccione: </option>
                                        <?php foreach ( $terapias->result() as $terapia ): ?>
                                        <option value="<?= $terapia->id ?>"><?= $terapia->terapia ?></option>
                                        <?php endforeach ?>
                                        <option value="Otra">Otro</option>
                                    </select> <br>
                                    <div class="" id="panel-add-ter" hidden>
                                        <br>
                                        <a href="#" class="btn btn-sm btn-info" data-id="18"
                                            data-toggle="modal" data-target="#addSet"><span
                                                class="fa fa-plus"></span>Añadir Nueva</a>

                                    </div>
                                    <b>Edad</b>
                                    <input id="edad_terapia" required type="number" name="edad_terapia"
                                        class="form-control" value="<?= $fechaMax ?>" min="0"
                                        max="<?= $fechaMax ?>" /><br>

                                    <button type="submit" class="btn btn-info btn-info-user"
                                        style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i> Guardar
                                        Terapia</button>
                                </form>
                            </div>

                            <div class="col-sm-4">
                                <form id="form_medi" name="form_medi" method="post" novalidate="novalidate">
                                    <input type="hidden" value="<?= $fecha ?>" name="anio" />
                                    <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                                    <h5>Medicamento (sustancia)</h5>
                                    <select style="width: 100%;" required id="p_medicamento"
                                        class="select2 form-control" name="p_medicamento">
                                        <option value="">Seleccione: </option>

                                        <option value="Otra">Otro</option>
                                    </select> <br>
                                    <div class="" id="panel-add-med" hidden>
                                        <br>
                                        <a href="#" class="btn btn-sm btn-info" data-id="3"
                                            data-toggle="modal" data-target="#addSet"><span
                                                class="fa fa-plus"></span>Añadir Nueva</a>

                                    </div>
                                    <b>Edad</b>
                                    <input required type="number" name="edad_medica" class="form-control"
                                        value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" /><br>

                                    <button type="submit" class="btn btn-info btn-info-user"
                                        style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i> Guardar
                                        Medicamento</button>
                                </form>
                            </div>
                            <div class="col-sm-4">
                                <form id="form_estres" name="form_estres" method="post" novalidate="novalidate">
                                    <input type="hidden" value="<?= $fecha ?>" name="anio" />
                                    <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                                    <h5>Estrés</h5>
                                    <select style="width: 100%;" required id="s_estres" class="select2 form-control"
                                        name="s_estres">
                                        <option value="">Seleccione: </option>
                                        <?php foreach ( $estres->result() as $estre ): ?>
                                        <option value="<?= $estre->id ?>"><?= $estre->estres ?></option>
                                        <?php endforeach ?>
                                    </select> <br>
                                    <b>Edad</b>
                                    <input required type="number" name="edad_estres" class="form-control"
                                        value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" /><br>
                                    <button type="submit" class="btn btn-info btn-info-user"
                                        style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i> Guardar
                                        Estrés</button>
                                </form>
                            </div>

                            <!--- <div  class="col-sm-3" >
                        <form id="form_obe" name="form_obe" method="post" novalidate="novalidate" >
                        <input type="hidden" value="<?= $fecha ?>" name="anio" />
                        <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                        <h4>Obesidad <small  id="obesidadTipo"></small></h4>
                        <select style="width: 100%;" required id="s_obesidad" class="select2 form-control" name="s_obesidad">
                            <option value="" >Seleccione: </option>
                              <?php foreach ( $obesidad->result() as $obe ): ?>
                            <option value="<?= $obe->id ?>" ><?= $obe->obesidad ?></option>
                            <?php endforeach ?>
                        </select> <br>
                        <b>Edad</b>
                        <input  required type="number" name="edad_obesidad" class="form-control" value="<?= $fechaMax ?>" min="0" max="<?= $fechaMax ?>" /><br>
                            
                          <button type="submit" class="btn btn-info btn-info-user" style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i>    Guardar Obesidad</button>
                        </form>
                    </div>  --->
                        </div>
                    </div>

                    <div class="tab-pane fade" id="diagnostico" role="tabpanel" aria-labelledby="diagnostico-tab">
                        <div class="row" style="padding: 20px">

                            <section id="DiagnósticoSec">
                                <div class="form-group col-sm-8 col-sm-offset-2">
                                    <form name="diagnostico_dr" method="post" id="diagnostico_dr">
                                        <!--- Estas lineas dejarlas asi  --->
                                        <b>Diagnóstico</b>
                                        <textarea rows="5" readonly class="form-control" id="text_diag"><?php foreach ($diagnosticos->result() as $diag):?>
(<?= date('j M, Y h:i a', strtotime($diag->created_at)) ?>): 
<?= $diag->diagnostico ?>                
<?php endforeach ?></textarea>
                                        <!--- Estas lineas dejarlas asi  --->

                                        <textarea name="diagnostico_input" id="diagnostico_input" rows="2" class="form-control" type="text"
                                            placeholder="Agrega una nuevo Diagnóstico"></textarea>
                                        <b>Edad</b>
                                        <input id="edad_diag" required type="number" name="edad_diag"
                                            class="form-control" value="<?= $fechaMax ?>" min="0"
                                            max="<?= $fechaMax ?>" />
                                        <input type="hidden" value="<?= $fecha ?>" name="anio" />
                                        <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />

                                        <button type="submit" class="btn btn-info btn-info-user"
                                            style="margin-top:10px"><i class="fa fa-save fa-1.5x"></i> Guardar
                                            Diagnóstico</button>
                                    </form>
                                </div>
                            </section>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <div id="linea_vida_section"></div>
    <!-- Inicia Linea de Vida -->
    <div class="panel panel-olive" style="border-radius:15px">

        <div class="panel-heading text-center collapsed" data-toggle="collapse" href="#collapseLinea" role="button"
            aria-expanded="false" aria-controls="collapseLinea" style="border-radius:15px">
            <h3>LINEA DE VIDA</h3>

        </div>
        <div class="collapse in" id="collapseLinea" aria-expanded="true">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-info btndivLinea" onclick="recargarLinea()"
                            style="margin-top:10px"><i class="glyphicon glyphicon-refresh"></i> Recargar
                            Linea</button>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?= base_url() ?>pacientes/linea-vida/<?= $paciente->id ?>"
                            class="btn btn-info float-right" type="button"><i class="fa fa-user"></i>
                            Evolución</a>
                    </div>
                </div>

                <div id="divLinea" class="col-sm-12 text-center comment-scrollbar"
                    style="height:500px; overflow: scroll; overflow-x: hidden; ">

                    <ul class="timeline" id="timeline">
                        <?php $num = 1; ?>
                        <?php foreach ( $linea_vida->result() as $linea ): ?>

                        <li><?php if ($num%2==0){ ?>
                            <div class="direction-l"> <?php } else { ?>
                                <div class="direction-r"><?php } $num++; ?>
                                    <div class="flag-wrapper">
                                        <span class="hexa"><?= $linea->edad_paciente ?></span>
                                        <span class="flag"><?= $linea->enfermedad ?></span>
                                        <span class="time-wrapper"><span
                                                class="time"><?= $linea->anio ?></span></span>
                                    </div>
                                    <div class="desc"><?= $linea->descripcion ?><a
                                            href="<?= base_url() . 'pacientes/evolucion/' . $paciente->id . '#' . $linea->id ?>">
                                            Evolución <icon class="fa fa-chevron-right"> </icon></a>
                                        <div class="progress" style="height:5px; ">
                                            <?php if ($linea->curacion < 33) {
                                                $bar = 'progress-bar-danger';
                                            } elseif ($linea->curacion > 34 && $linea->curacion < 66) {
                                                $bar = 'progress-bar-warning';
                                            } elseif ($linea->curacion > 67) {
                                                $bar = 'progress-bar-success';
                                            } ?>
                                            <div class="progress-bar <?= $bar ?> " role="progressbar"
                                                aria-valuenow="<?= $linea->curacion ?>" aria-valuemin="0"
                                                aria-valuemax="100" style="width: <?= $linea->curacion ?>%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </li>
                        <?php endforeach ?>
                    </ul>
                    <small>Los elementos de la linea se borran al eliminar un dato de los Antecedentes
                        Patológicos</small>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <h3 class="text-center">Antecedentes HeredoFamiliares</h3>
                    <table class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>-</th>
                                <th>Padecimiento</th>
                                <th>Familiar</th>

                            </tr>
                        </thead>
                        <tbody id="info-carga_heredo">
                            <?php foreach ( $carga_heredo->result() as $ahf ): ?>
                            <tr id="fila_ahf<?= $ahf->id ?>">
                                <td>-</td>
                                <td><?= $ahf->enfermedad ?></td>
                                <td><?= $ahf->familiar ?></td>

                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-3 pull-right">
                        <div data-toggle="collapse" href="#collapseLinea" role="button" aria-expanded="false"
                            style="background: #f0ad4e; color:#F6F8FA; border-radius: 15px;"
                            aria-controls="collapseLinea" class="text-center">
                            Cerrar Panel
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <!-- Cierra Linea de Vida -->

    <!--- Comienza panel de Antecedentes Patologicos  --->
    <!--
    <div class="panel panel-brown" style="border-radius:15px">
        
        <div class="panel-heading text-center" data-toggle="collapse" href="#collapsePato" role="button" aria-expanded="false" aria-controls="collapsePato" style="border-radius:15px" >
        <h3>ANTECEDENTES PATOLÓGICOS</h3>
        </div>
        <div class="collapse" id="collapsePato" >
            
        
                
            <div class="panel-body">
           
          
                <h3 class="text-center">OTRAS ENFERMEDADES</h3>
            <section id="PsicológicaSec"></section>
              
            <div class="panel panel-default border-left-brown" >
                    
                    <div class="panel-heading" >
                    <span class="ms-subtitle" ><label>Añadir Psicológicas</label></span>
                    </div>
            <div class="panel-body" >
                    
            <form id="enf_infecto_psicologicas" name="enf_infecto_psicologicas" method="post" class="panel-body">
            
            <div class="col-sm-5">
            <b>Enfermedad</b>
            <select id="enf_psico" class="form-control" name="enfermedad"  required>
                <option value="">Seleccione</option>
                <?php foreach ( $infectos_psico->result() as $infecto ): ?>

                <option value="<?= $infecto->id ?>"> <?= $infecto->enfermedad ?></option>
                <?php endforeach ?>

                <option value="Otra">Otra</option>
            </select>
            <div id="panel-add-psico" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="16" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
              </div>
                <b>Medicamentos</b>
            <select required id="med_psico" class="form-control" name="medicamentos">
                    <option value="">Seleccione</option>
                     
                <option value="No Recuerda" >No Recuerda</option>
                <option value="Otro" >Otro</option>
                </select>
            <div id="panel-add-med_ps" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
              </div>
            </div>
            
            <div class="col-sm-5">
            <b>Manejo</b>
            <textarea required id="manejo_psico" name="manejo" class="form-control" placeholder="Escribe aquí"
                cols="20" rows="4"></textarea>
            </div>
            
            <div class="col-sm-2" >
            
            <b>Edad</b>
            <input id="edad_psico" required name="edad_psicologica" class="form-control" type="number" min="0" max="<?= $fechaMax ?>" /><br>
                <input type="hidden" value="<?= $fecha ?>" name="anio" />
            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                <b>Agregar</b>
            <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i></button>
            </div>
              
            </form>
            
            </div>
            </div>
             <section id="OtraSec"></section>
               
                
            <div class="panel panel-default border-left-brown" >
                    
            <div class="panel-heading" >
            <span class="ms-subtitle" ><label>Añadir Otras</label></span>
            </div>
            <div class="panel-body">
            <form id="enf_infecto_otras" name="enf_infecto_otras" method="post" class="panel-body">
            
            <div class="col-sm-5" >
            <b>Enfermedad</b>
            <select id="enf_otras" class="form-control" name="enfermedad" required >
                <option value="">Seleccione</option>
                <?php foreach ( $infectos_otras->result() as $infecto ): ?>

                <option value="<?= $infecto->id ?>"> <?= $infecto->enfermedad ?></option>
                <?php endforeach ?>

                <option value="Otra">Otra</option>
            </select>
                <div id="panel-add-otras" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="17" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
              </div>
                <b>Medicamentos</b>
            <select id="med_otras" class="form-control" name="medicamentos" required>
                    <option value="">Seleccione</option>
                    
                <option value="No Recuerda" >No Recuerda</option>
                <option value="Otro" >Otro</option>
                </select>
                <div id="panel-add-med_otras" hidden >
                    <br>
                    <a href="#" class="btn btn-sm btn-info" data-id="3" data-toggle="modal" data-target="#addSet"><span class="fa fa-plus" ></span>Añadir Nueva</a>
              </div>
            </div>
            
            <div class="col-sm-5">
               <b>Manejo</b>
                <textarea id="manejo_otras" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20"
                    rows="4" required></textarea>
            </div>
            
            <div class="col-sm-2">
            
            <b>Edad</b>
            <input id="edad_otras" required name="edad_otras" class="form-control" type="number" min="0" max="<?= $fechaMax ?>" /><br>
            <input type="hidden" value="<?= $fecha ?>" name="anio" />
            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                <b>Agregar</b>
            <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i></button>
            </div>
            </form>
            </div>
        </div>
            <div class="col-sm-3 pull-right" >
                    <div data-toggle="collapse" href="#collapsePato" role="button" aria-expanded="false" style="background: #f0ad4e; color:#F6F8FA; border-radius: 15px;"  aria-controls="collapsePato" class="text-center" >
                    Cerrar Panel
                    </div>
            </div>
    </div>   -->
    <!--- Termina panel de Antecedentes Patologicos  --->

</div>
</div>

<!--- Termina panel de Antecedentes Patologicos  --->

<?php if ($paciente->sexo == "Femenino"){ ?>
<!--- Empieza panel Mujeres -->
<div class="panel panel-pink" style="border-radius:15px">

    <div class="panel-heading text-center" data-toggle="collapse" href="#collapseGineco" role="button"
        aria-expanded="false" aria-controls="collapseGineco" style="border-radius:15px">
        <h3>ANTECEDENTES GINECO-OBSTETRICOS</h3>

    </div>
    <div class="collapse" id="collapseGineco">
        <div class="panel-body">
            En construcción...
        </div>
    </div>
</div>

<!--- Termina panel Mujeres -->
<?php } ?>
</div>


<!-- Modal para añadir carga hereditaria  -->
<div class="modal fade" id="modalAutoinmune" tabindex="-1" role="dialog" aria-labelledby="modalAutoinmuneT"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAutoinmuneT">Lista de Enfermedades Autoinmunes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <i class="fa fa-plus "></i> Trastornos hematológicos asociados con autoinmunidad.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 1) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa fa-plus "></i> Manifestaciones hematologicas secundarias de las
                                    enfermedades autoinmunitarias.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 2) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>

                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    <i class="fa fa-plus "></i> Autoinmunidad del tracto gastrointestinal.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 3) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingAutoCor">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseAutoCor" aria-expanded="false"
                                    aria-controls="collapseAutoCor">
                                    <i class="fa fa-plus "></i> Autoinmunidad y corazón.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseAutoCor" class="collapse" aria-labelledby="headingAutoCor"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 4) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingNeu">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseNeu" aria-expanded="false" aria-controls="collapseNeu">
                                    <i class="fa fa-plus "></i> Neumopatias mediadas inmunologicamente.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseNeu" class="collapse" aria-labelledby="headingNeu"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 5) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingRen">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseRen" aria-expanded="false" aria-controls="collapseRen">
                                    <i class="fa fa-plus "></i> Autoinmunidad renal.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseRen" class="collapse" aria-labelledby="headingRen"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 6) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSisN">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseSisN" aria-expanded="false"
                                    aria-controls="collapseSisN">
                                    <i class="fa fa-plus "></i> Enfermedades autoinmunitarias del sistema nervioso.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSisN" class="collapse" aria-labelledby="headingSisN"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 7) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingEndo">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseEndo" aria-expanded="false"
                                    aria-controls="collapseEndo">
                                    <i class="fa fa-plus "></i> Trastornos endocrinos autoinmunitarios.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseEndo" class="collapse" aria-labelledby="headingEndo"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 8) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingPiel">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapsePiel" aria-expanded="false"
                                    aria-controls="collapsePiel">
                                    <i class="fa fa-plus "></i> Enfermedades autoinmunitarias de la piel.
                                </button>
                            </h5>
                        </div>
                        <div id="collapsePiel" class="collapse" aria-labelledby="headingPiel"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 9) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingMusc">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseMusc" aria-expanded="false"
                                    aria-controls="collapseMusc">
                                    <i class="fa fa-plus "></i> Enfermedades musculares.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseMusc" class="collapse" aria-labelledby="headingMusc"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 10) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingApaR">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseApaR" aria-expanded="false"
                                    aria-controls="collapseApaR">
                                    <i class="fa fa-plus "></i> Autoinmunidad del aparato reproductor.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseApaR" class="collapse" aria-labelledby="headingApaR"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 11) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOtorri">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseOtorri" aria-expanded="false"
                                    aria-controls="collapseOtorri">
                                    <i class="fa fa-plus "></i> Trastornos autoinmunitarios en otorrinolaringologia.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOtorri" class="collapse" aria-labelledby="headingOtorri"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 12) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOcular">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseOcular" aria-expanded="false"
                                    aria-controls="collapseOcular">
                                    <i class="fa fa-plus "></i> Autoinmunidad ocular.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOcular" class="collapse" aria-labelledby="headingOcular"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 13) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSistem">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseSistem" aria-expanded="false"
                                    aria-controls="collapseSistem">
                                    <i class="fa fa-plus "></i> Enfermedades sitemicas autoinmunitarias.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSistem" class="collapse" aria-labelledby="headingSistem"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 14) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingAfecO">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseAfecO" aria-expanded="false"
                                    aria-controls="collapseAfecO">
                                    <i class="fa fa-plus "></i> Otras enfermedades autoinmunitarias con afectación
                                    ocular.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseAfecO" class="collapse" aria-labelledby="headingAfecO"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 15) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSilic">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseSilic" aria-expanded="false"
                                    aria-controls="collapseSilic">
                                    <i class="fa fa-plus "></i> Enfermedades asociadas a los implantes de silicona.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSilic" class="collapse" aria-labelledby="headingSilic"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 16) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingAtipi">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseAtipi" aria-expanded="false"
                                    aria-controls="collapseAtipi">
                                    <i class="fa fa-plus "></i> Enfermedad del tejido conjuntivo atípica o
                                    indiferenciada.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseAtipi" class="collapse" aria-labelledby="headingAtipi"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 17) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingInfecA">
                            <h5 class="mb-0">
                                <button class="btn btn-primary collapsed" data-toggle="collapse"
                                    data-target="#collapseInfecA" aria-expanded="false"
                                    aria-controls="collapseInfecA">
                                    <i class="fa fa-plus "></i> Enfermedades asociadas a problemas infecciosos
                                    autoinmunes y crónico degenerativas.
                                </button>
                            </h5>
                        </div>
                        <div id="collapseInfecA" class="collapse" aria-labelledby="headingInfecA"
                            data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <?php foreach ( $autoinmune->result() as $auto ): ?>
                                    <?php
                                                            $tipo = $auto->tipo;
                                                        if ($tipo == 18) {
                                                    ?>
                                    <li><a data-value="<?= $auto->enfermedad ?>" role="button"
                                            onclick="copiarAutoinmune(this)"><?= $auto->enfermedad ?></a></li>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!--- Cierra Modal -->

<a href="#linea_vida_section" role="button" class="btn btn-teal btn-save"><i
        class="glyphicon glyphicon-chevron-up fa-2x" title="Ir a la linea de vida"></i><br>Linea</a>

<a href="<?= base_url() ?>pedidos/receta/<?= $paciente->id ?>" role="button" class="btn btn-info btn-receta"
    title="Hacer receta"><i class="fa fa-file-text"></i></a>


<button type="button" data="<?php if ($conversacion == 0) {
    echo 0;
} else {
    echo $gconversacion->id;
} ?>" id="btnverMsj" class="btn btn-brown btn-msj"
    data-toggle="modal" data-target="#addMsj" title="Iniciar Conversación"><i
        class="fa fa-inbox fa-2x"></i></button>

<button type="button" style="display:none;" class="btn btn-danger btn-stop" id="btn-terminar-consulta2" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });"
    data-id="" title="Terminar Consulta"><i class="fa fa-stop"></i></button>

<button type="button" class="btn btn-success btn-stop" id="btn-iniciarConsulta2" data-toggle="modal"
    data-target="#start_consulta" data-id="" title="Iniciar Consulta"><i class="fa fa-play"></i></button>

<!-- Modal Add Messenger -->
<div class="modal fade" id="addMsj" tabindex="-1" role="dialog" aria->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Mensajes</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if ($conversacion == 0){ ?>
                        <h3 class="text-center">Aún no has iniciado una conversación.</h3>
                        <input type="hidden" id="typeConver" name="typeConver" value="user" />

                        <button type="button" data="<?= $paciente->id ?>" id="btnConver"
                            class="btn btn-warning btn-block"><i class="fa fa-play" aria-hidden="true"></i>
                            Iniciar Conversación</button>


                        <?php }else{?>
                        <div id="mensajes"
                            style="height:400px; overflow: scroll; overflow-x: hidden; padding:10px;">

                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php if ($conversacion == 0){ ?>
                <?php }else{?>

                <form id="addMsj_form" name="addMsj_form" method="post">
                    <input type="hidden" name="id_conver" id="id_conver" value="<?= $gconversacion->id ?>" />
                    <input type="hidden" id="typeConver" name="typeConver" value="user" />
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="mensaje" id="mensaje"
                            placeholder="Escribe tu mensaje aquí" class="form-control" />
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-md btn-primary" type="submit">Enviar <span
                                class="fa fa-paper-plane"></span> </button>

                </form>
            </div>
            <?php  }  ?>
        </div>
    </div><!-- modal content -->
</div><!-- modal dialog -->
</div><!-- modal fade -->
<!-- Cierra Modal -->

<!-- Modal Agregar Estudio -->
<div class="modal fade" id="estudios" tabindex="-1" role="dialog" aria-labelledby="estudiosTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estudioTitle">Agregar un nuevo estudio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="agregar_estudio" name="agregar_estudio" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <b>Titulo del Estudio</b>
                            <input class="form-control" type="text" id="title_estudio" name="title_estudio"
                                required />
                        </div>
                        <div class="col-sm-6 form-group">
                            <b>Fecha del Estudio</b>
                            <input class="form-control" type="date" id="fecha_estudio" name="fecha_estudio"
                                required />
                        </div>
                        <div class="col-sm-6 form-group">
                            <b>Selecciona archivo o Arrastralo aquí</b>
                            <input class="form-control" type="file" id="estudio_sbr" name="estudio_sbr" />
                            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                            <input type="hidden" value="<?= $paciente->clave_bancaria ?>" name="expediente" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>

            </form>

            <form class="dropzone" id="estudios_up">
                <div class="dz-message">
                    <div class="icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <h2>Suelta los estudios aquí</h2>
                    <span class="note">No hay Archivos seleccionados</span>
                </div>
                <div class="fallback">
                    <input type="file" name="file" id="estudios_up" multiple />
                </div>
                <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                <input type="hidden" value="<?= $paciente->clave_bancaria ?>" name="expediente" />
            </form>

            <script>
                var base_url = '<?php echo base_url(); ?>';
                var dropzone = new Dropzone("#estudios_up", {
                    url: base_url + 'megasalud/PatientsController/upload_estudio',
                    maxFiles: 40,
                    init: function() {
                        this.on("success", function() {
                            iziToast.success({
                                timeout: 3000,
                                title: 'Exito',
                                position: 'topRight',
                                // target: '.login-message',
                                message: 'Estudio Guardado.',
                            });
                        });
                    }

                });
            </script>
        </div>
    </div>
</div>
<!-- Cierra Modal Agregar Estudio -->

<!-- Modal Agregar Cita -->
<div class="modal fade" id="nuevacita" tabindex="-1" role="dialog" aria-labelledby="citaTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estudioTitle">Agregar Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="nueva-cita" name="nueva-cita" method="post">
                <div class="modal-body">
                    <div class="form-group col-sm-4">
                        <label>
                            Sucursal
                        </label>

                        <select id="id_calendario" name="id_calendario" class="form-control" required>
                            <option value="">Seleccione una opción</option>
                            <?php foreach ($sucursales->result() as $sucursal): ?>
                            <option value="<?= $sucursal->id_calendario ?>"><?= $sucursal->razon_social ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>
                            Cita Para:
                        </label>

                        <input class="form-control" id="title_cita" name="title_cita"
                            value="<?= $paciente->nombre ?> <?= $paciente->apellido_p ?> <?= $paciente->telefono_a ?> " />
                    </div>

                    <div class="form-group col-sm-4">
                        <label>
                            Fecha: (dia - hora)
                        </label>
                        <input required type="datetime-local" name="fecha_cita" id="fecha_cita"
                            min="<?php echo date('Y-m-d\TH:i'); ?>" value="<?php echo date('Y-m-d\TH:i'); ?>" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Agendar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Cierra Modal Agregar cita -->

<!-- Modal Add settings -->
<div class="modal fade" id="addSet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addSet_form" name="addSet_form" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Añadir</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-1">
                            <input class="form-control " type="text" name="input_id" id="input_id" />
                        </div>

                        <div class="col-sm-11">
                            <label>Añade aqui</label>
                            <input class="form-control" id="dato" name="dato" />
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-md btn-primary" type="submit"><span class="fa fa-save"></span>
                        Guardar</button>
                </div>
            </form>
        </div><!-- modal content -->
    </div><!-- modal dialog -->
</div><!-- modal fade -->
<!-- Cierra Modal -->

<!-- Modal Agregar congenita -->
<div class="modal fade" id="modal_congenita" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estudioTitle">Agregar Congenita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="new_enf_cong" name="new_enf_cong" method="post" class="form-group">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5">
                                <input type="hidden" name="enfermedad" id="congenita" value="" />
                                <b>Medicamento (sustancia)</b>
                                <select id="medicamento" class="form-control" name="medicamento">
                                    <option value="">Seleccione</option>

                                    <option value="Otra">Otro</option>
                                </select>
                                <div class="" id="panel-add-med" hidden>
                                    <br>
                                    <a href="#" class="btn btn-sm btn-info" data-id="3"
                                        data-toggle="modal" data-target="#addSet"><span
                                            class="fa fa-plus"></span>Añadir Nueva</a>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <b>Manejo</b>

                                <textarea id="manejo" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20"
                                    rows="4"></textarea>
                            </div>

                            <div class="col-sm-2">
                                <b>Edad</b>
                                <input id="edad_cong" required type="number" name="edad_cong"
                                    class="form-control" value="<?= $fechaMax ?>" min="1"
                                    max="<?= $fechaMax ?>" /><br>
                                <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                                <input type="hidden" value="<?= $fecha ?>" name="anio" />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Cierra Modal Agregar congenita -->

<!-- Modal Agregar Vacuna -->
<div class="modal fade" id="modal_vacuna" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estudioTitle">Agregar Vacuna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_vacuna" name="vacuna" method="post">
                <div class="modal-body">
                    <div class="container">
                        <input class="form-control" id="vacuna" name="vacuna" type="hidden" />

                        <div class="form-group col-sm-8">
                            <b>Descripcion</b>
                            <textarea id="descripcion_vac" name="descripcion_vac" class="form-control" placeholder="Escribe aquí"
                                cols="20" rows="2"></textarea>
                        </div>
                        <div class="col-sm-3">
                            <b>Edad</b>
                            <input id="edad_vacuna" required class="form-control" min="1"
                                value="<?= $fechaMax ?>" max="<?= $fechaMax ?>" name="edad" type="number" />
                            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                            <input type="hidden" value="<?= $fecha ?>" name="anio" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Cierra Modal Agregar Vacuna -->

<!-- Modal Agregar Alergia -->
<div class="modal fade" id="modal_alergia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estudioTitle">Agregar Alergía</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form_alergia" name="form_alergia" method="post">
                <div class="modal-body">
                    <div class="container">
                        <input class="form-control" id="alergeno" name="alergeno" value=""
                            type="hidden" />

                        <div class="col-sm-8">
                            <b>Tratamiento</b>
                            <select id="tratamiento_ale" class="form-control" name="tratamiento" required>
                                <option value="">Selecione</option>
                                <?php foreach ( $tratamiento->result() as $tratamiento ): ?>
                                <option value="<?= $tratamiento->tratamiento_alergia ?>">
                                    <?= $tratamiento->tratamiento_alergia ?></option>
                                <?php endforeach ?>
                                <option value="Otro">Otro</option>
                            </select>
                            <div id="panel-add-a-trat" hidden>
                                <br>
                                <a href="#" class="btn btn-sm btn-info" data-id="6" data-toggle="modal"
                                    data-target="#addSet"><span class="fa fa-plus"></span>Añadir Nueva</a>
                            </div>
                        </div>

                        <div class="col-sm-4">

                            <b>Edad</b>
                            <input id="edad_ale" required name="edad_alergia" type="number"
                                class="form-control" min="1" value="<?= $fechaMax ?>"
                                max="<?= $fechaMax ?>" />
                            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" required />
                            <input type="hidden" value="<?= $fecha ?>" name="anio" required />

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Cierra Modal Agregar Alergia -->

<!-- Modal Agregar Hospitalización -->
<div class="modal fade" id="modal_hospi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estudioTitle">Agregar Hospitalización</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_hospi" name="form_hospi" method="post">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">

                            <div class="col-sm-12">

                                <div class="row">

                                    <div class="form-group col-sm-4">
                                        <input id="causa_h" name="causa" value="" type="hidden" />

                                        <b>Medicamentos (sustancia)</b>
                                        <select id="med_h" class="form-control" name="medicamentos">
                                            <option value="">Seleccione</option>

                                            <option value="Otra">Otra</option>
                                        </select>
                                        <div id="panel-add-med_h" hidden>
                                            <br>
                                            <a href="#" class="btn btn-sm btn-info" data-id="3"
                                                data-toggle="modal" data-target="#addSet"><span
                                                    class="fa fa-plus"></span>Añadir Nueva</a>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <b>Manejo</b>
                                        <textarea id="manejo_h" name="manejo" class="form-control" placeholder="Escribe aquí" cols="20"
                                            rows="4"></textarea>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <b>Edad</b>
                                        <input id="edad_h" required type="number" min="1"
                                            class="form-control" name="edad_hospi" max="<?= $fechaMax ?>"
                                            value="<?= $fechaMax ?>" />
                                        <input type="hidden" value="<?= $fecha ?>" name="anio" />
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">Operación</div>
                                            <div class="panel-body">
                                                <div class="form-group col-sm-12">
                                                    <label>Si<input class="form-control" data-toggle="collapse"
                                                            data-target="#operacion" aria-expanded="false"
                                                            aria-controls="operacion" type="radio"
                                                            name="op" value="Si" /></label>
                                                    <label>No
                                                        <input class="form-control" data-toggle="collapse"
                                                            data-target="#operacion" aria-expanded="false"
                                                            aria-controls="operacion" type="radio"
                                                            name="op" value="No" checked /></label>
                                                    <div class="collapse" id="operacion">
                                                        <div class="card card-body">
                                                            <b>Tipo de operación</b>

                                                            <select id="operacion_h" name="tipo_operacion"
                                                                class="form-control">
                                                                <option value="No">Seleccione</option>
                                                                <?php foreach ( $operaciones->result() as $operacion ): ?>
                                                                <option value="<?= $operacion->tipo_operacion ?>">
                                                                    <?= $operacion->tipo_operacion ?></option>
                                                                <?php endforeach ?>
                                                                <option value="Otra">Otra</option>
                                                            </select>
                                                            <div id="panel-add-ope" hidden>
                                                                <br>
                                                                <a href="#" class="btn btn-sm btn-info"
                                                                    data-id="8" data-toggle="modal"
                                                                    data-target="#addSet"><span
                                                                        class="fa fa-plus"></span>Añadir Nueva</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">Anestesia</div>
                                            <div class="panel-body">
                                                <div class="form-group col-sm-12">

                                                    <label>Si<input class="form-control" data-toggle="collapse"
                                                            data-target="#anestesia" aria-expanded="false"
                                                            aria-controls="anestesia" type="radio"
                                                            name="ane" value="Si" /></label>

                                                    <label>No<input class="form-control" data-toggle="collapse"
                                                            data-target="#anestesia" aria-expanded="false"
                                                            aria-controls="anestesia" type="radio"
                                                            name="ane" value="No" checked /></label>

                                                    <div class="collapse" id="anestesia">
                                                        <div class="card card-body">
                                                            <b>Tipo de anestesia</b>
                                                            <select id="tipo_ane" name="tipo_anestesia"
                                                                class="form-control">
                                                                <option value="No">Seleccione</option>
                                                                <?php foreach ( $anestesias->result() as $anestesia ): ?>
                                                                <option value="<?= $anestesia->tipo_anestesia ?>">
                                                                    <?= $anestesia->tipo_anestesia ?></option>
                                                                <?php endforeach ?>
                                                                <option value="Otra">Otra</option>
                                                            </select>
                                                            <div id="panel-add-ane" hidden>
                                                                <br>
                                                                <a href="#" class="btn btn-sm btn-info"
                                                                    data-id="9" data-toggle="modal"
                                                                    data-target="#addSet"><span
                                                                        class="fa fa-plus"></span>Añadir Nueva</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">Transfusión</div>
                                            <div class="panel-body">
                                                <div class="form-group col-sm-12">


                                                    <label>Si<input class="form-control" data-toggle="collapse"
                                                            data-target="#transfusion" aria-expanded="false"
                                                            aria-controls="transfusion" type="radio"
                                                            name="tran" value="Si" /></label>
                                                    <label>No<input class="form-control" data-toggle="collapse"
                                                            data-target="#transfusion" aria-expanded="false"
                                                            aria-controls="transfusion" type="radio"
                                                            name="tran" value="No" checked /></label>

                                                    <div class="collapse" id="transfusion">
                                                        <div class="card card-body">
                                                            <b>Tipo de transfusión</b>
                                                            <select id="tipo_trans" name="tipo_transfusion"
                                                                class="form-control">
                                                                <option value="No">Seleccione</option>
                                                                <?php foreach ( $transfusiones->result() as $transfusion ): ?>
                                                                <option value="<?= $transfusion->tipo_transfusion ?>">
                                                                    <?= $transfusion->tipo_transfusion ?></option>
                                                                <?php endforeach ?>
                                                                <option value="Otra">Otra</option>
                                                            </select>
                                                            <div id="panel-add-trans" hidden>
                                                                <br>
                                                                <a href="#" class="btn btn-sm btn-info"
                                                                    data-id="10" data-toggle="modal"
                                                                    data-target="#addSet"><span
                                                                        class="fa fa-plus"></span>Añadir Nueva</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">Prótesis | Implantes | Amalgamas</div>
                                            <div class="panel-body">
                                                <div class="form-group col-sm-12">

                                                    <label>Si<input class="form-control" data-toggle="collapse"
                                                            data-target="#protesis" aria-expanded="false"
                                                            aria-controls="protesis" type="radio" name="pro"
                                                            value="Si" /></label>
                                                    <label>No<input class="form-control" data-toggle="collapse"
                                                            data-target="#protesis" aria-expanded="false"
                                                            aria-controls="protesis" type="radio" name="pro"
                                                            value="No" checked /></label>

                                                    <div class="collapse" id="protesis">
                                                        <div class="card card-body">
                                                            <b>Tipo prótesis</b>
                                                            <select id="tipo_prot" name="tipo_protesis"
                                                                class="form-control">
                                                                <option value="No">Seleccione</option>
                                                                <?php foreach ( $protesiss->result() as $protesis ): ?>
                                                                <option value="<?= $protesis->tipo_protesis ?>">
                                                                    <?= $protesis->tipo_protesis ?></option>
                                                                <?php endforeach ?>
                                                                <option value="Otra">Otra</option>
                                                            </select>
                                                            <div id="panel-add-prot" hidden>
                                                                <br>
                                                                <a href="#" class="btn btn-sm btn-info"
                                                                    data-id="11" data-toggle="modal"
                                                                    data-target="#addSet"><span
                                                                        class="fa fa-plus"></span>Añadir Nueva</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">Complicación</div>
                                            <div class="panel-body">
                                                <div class="form-group col-sm-12">

                                                    <label>Si<input class="form-control" data-toggle="collapse"
                                                            data-target="#comp" aria-expanded="false"
                                                            aria-controls="comp" type="radio" name="com"
                                                            value="Si" /></label>
                                                    <label>No<input class="form-control" data-toggle="collapse"
                                                            data-target="#comp" aria-expanded="false"
                                                            aria-controls="comp" type="radio" name="com"
                                                            value="No" checked /></label>

                                                    <div class="collapse" id="comp">
                                                        <div class="card card-panel">
                                                            <b>Explique</b>
                                                            <textarea id="comp_h" name="com_explicacion" class="form-control" placeholder="Escribe aquí" cols="20"
                                                                rows="2"></textarea>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group col-sm-12 text-center">
                            <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />

                            <button type="submit" class="btn btn-info"><i class="fa fa-plus "></i><br></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Cierra Modal Agregar Hospitalización -->

<!-- Modal Agregar Veneno -->
<div class="modal fade" id="modal_new_veneno" tabindex="-1" role="dialog" aria-labelledby="estudiosTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Agregar nuevo Veneno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_new_veneno" name="form_new_veneno" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" value="" id="id_veneno" name="id_veneno" />
                        <div class="col-sm-12">
                            <h4 class="text-center">Clasificación</h4>
                        </div>
                        <div class="col-sm-12 form-inline">
                            <div class="col-sm-3">
                                <div id="show_a"></div>
                                <div id="show_b"></div>
                            </div>
                            <div class="col-sm-3">
                                <div id="show_c"></div>
                                <div id="show_d"></div>
                            </div>
                            <div class="col-sm-3">
                                <div id="show_e"></div>
                                <div id="show_f"></div>
                            </div>
                            <div class="col-sm-3">
                                <div id="show_g"></div>
                                <div id="show_h"></div>
                            </div>
                        </div><br><br>
                        <div class="col-sm-6 form-group">
                            <b>Frecuencia</b>
                            <select required id="frecc" name="frecc" class="form-control">
                                <option value="">Seleccione:</option>
                                <option value="1">Diariamente</option>
                                <option value="2">Semanalmente</option>
                                <option value="3">Mensualmente</option>
                                <option value="4">Anualmente</option>
                                <option value="5">Una sola vez</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <b>Edad</b>
                            <input id="edad_veneno" required type="number" name="edad_veneno"
                                class="form-control" value="<?= $fechaMax ?>" min="0"
                                max="<?= $fechaMax ?>" />
                        </div>
                        <div class="col-sm-12">
                            <h4 class="text-center">Aparece en:</h4>
                            <div class="col-sm-12" id="veneno_relations"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button onclick="save_new_veneno('<?= $fecha ?>','<?= $paciente->id ?>')" type="button"
                        class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- Cierra Modal Agregar Veneno -->

<!-- Modal Agregar Venenos del producto -->
<div class="modal fade" id="modal_new_veneno_all" tabindex="-1" role="dialog"
    aria-labelledby="estudiosTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Agregar todos los venenos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_new_veneno" name="form_new_veneno" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" value="" id="id_product" name="id_product" />
                        <div class="col-sm-12">
                            <h4 class="text-center">Producto: <label class="txt-primary"
                                    id="product_name"></label></h4>
                        </div><br><br>
                        <div class="col-sm-6 form-group">
                            <b>Frecuencia</b>
                            <select required id="frecc_all" name="frecc_all" class="form-control">
                                <option value="">Seleccione:</option>
                                <option value="1">Diariamente</option>
                                <option value="2">Semanalmente</option>
                                <option value="3">Mensualmente</option>
                                <option value="4">Anualmente</option>
                                <option value="5">Una sola vez</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <b>Edad</b>
                            <input id="edad_veneno_all" required type="number" name="edad_veneno_all"
                                class="form-control" value="<?= $fechaMax ?>" min="0"
                                max="<?= $fechaMax ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button onclick="save_new_veneno_all('<?= $fecha ?>','<?= $paciente->id ?>')" type="button"
                        class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- Cierra Modal Agregar Veneno -->

<!-- Modal Agregar Medicamento -->
<div class="modal fade" id="modal_new_medi" tabindex="-1" role="dialog" aria-labelledby="estudiosTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Agregar nuevo Medicamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form_medi2" name="form_medi" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" value="<?= $fecha ?>" name="anio" />
                        <input type="hidden" value="<?= $paciente->id ?>" name="id_paciente" />
                        <input type="hidden" id="p_medicamento2" name="p_medicamento2" />
                        <div class="col-sm-12 text-center">
                            <b>Edad</b>
                            <input id="edad_medica" required type="number" name="edad_medica"
                                class="form-control" value="<?= $fechaMax ?>" min="0"
                                max="<?= $fechaMax ?>" step="0.1" />
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-info-user"><i class="fa fa-save fa-1.5x"></i>
                        Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- Cierra Modal Agregar Medicamento -->
