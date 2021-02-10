<?php 
	$paciente = $paciente->row();
$img_path = base_url('estudios').'/'.$paciente->id."/";
$type = $this->session->type;
?>
<div class="container" >
<h3 class="ms-title"><b>RESUMEN - <?= $paciente->nombre . " " . $paciente->apellido_p . " " . $paciente->apellido_m  ?></b> <a href="javascript:history.back()" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i><span>Regresar</span></a></h3>
    
<div class="panel panel-primary">
        <div class="panel-heading">
            <span class="ms-subtitle">Generales</span>
         </div>
        <div class="panel-body" >
            <div class="row">
                <div class="col-sm-12" >
                    
                        <div class="panel panel-default" >  
                        <div class="panel-heading" >      
                            <h3 class="text-left" >Carga Hereditaria</h3>
                        </div>  
                        <div class="panel-body">    
                            <div class="col-sm-12" >
                                
                             <table id="carga_heredo-table" class="table table-striped" style="width:100%">
                                 <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Padecimiento</th>
                                        <th>Familiar</th>
                                        <th>Eliminar</th>

                                    </tr>
                                </thead>
                                    <tbody id="info-carga_heredo">
                                         <?php foreach ( $carga_heredo->result() as $ahf ): ?>
                                        <tr id="fila_ahf<?= $ahf->id ?>" >
                                            <td><?= $ahf->id ?></td>
                                            <td><?= $ahf->enfermedad ?></td>
                                            <td><?= $ahf->familiar  ?></td>

                                            <td>
                                            <?php if($type == "Medico"){}else{ ?>
                                            <button type="submit" class="btn btn-danger btn-delete-ahf"><i class="fa fa-trash"></i><br></button><?php } ?>
                                            </td>
                                            <input value="_ahf" id="table_ahf<?= $ahf->id ?>" type="hidden"  />
                                        </tr> 
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    
                     <div class="panel panel-default" >
            
             <div class="panel-heading" >
                <h3 class="text-left" >Enfermedades Congénitas</h3>
                </div>
            
            <div class="panel-body" >
            
            <div class="col-sm-12" >    
            <table id="antecedentes-table" class="table table-striped" style="width:100%">
             <thead>
                <tr>

                    <th>No.</th>
                    <th>Enfermedad</th>
                    <th>Manejo</th>
                    <th>Medicamento</th>
                    <th>Edad</th>
                    <th>Eliminar</th>

                </tr>
            </thead>
                <tbody id="info">
                     <?php foreach ( $hisclinic_app1->result() as $his_app1 ): ?>
                    <tr id="fila_app1<?= $his_app1->id ?>">
                        <td><?= $his_app1->id ?></td>
                        <td><?= $his_app1->enfermedad ?></td>
                        <td><?= $his_app1->manejo  ?></td>
                        <td><?= $his_app1->medicamento ?></td>
                        <td><?= $his_app1->edad ?></td>

                        <td>
                        <?php if($type == "Medico"){}else{ ?>
                        <button type="submit" class="btn btn-danger btn-delete-app1"><i class="fa fa-trash"></i><br></button><?php }?>
                        </td>
                        <input value="_app1" id="table_app1<?= $his_app1->id ?>" type="hidden"  />
                        <input value="<?= $his_app1->created_at ?>" id="fecha_app1<?= $his_app1->id ?>" type="hidden"  />
                    </tr> 
                <?php endforeach ?>
                </tbody>
            </table>
            </div>
            </div>
            </div>
                    
                    
              
            <div class="panel panel-default">
          
            <div class="panel-heading" >
                <h3 class="text-left" >Cartilla de Vacunación SS</h3>
            </div>    
            
            <div class="panel-body" >
            <table id="inmunizaciones-table" class="table table-striped" style="width:100%">
             <thead>
                <tr>
                    <th>No.</th>
                    <th>Vacuna</th>
                    <th>Descripcion</th>
                    <th>Edad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody id="info-inmun">
            <?php foreach ( $inmunizacion->result() as $inmune ): ?>
                <tr id="fila_inmun<?= $inmune->id ?>">

                <td><?= $inmune->id ?></td>
                <td><?= $inmune->vacuna ?></td>
                <td><?= $inmune->descripcion ?></td>
                <td><?= $inmune->edad ?></td>
                    
                <td>
                <?php if($type == "Medico"){}else{ ?>
                <button class="btn btn-danger btn-delete-inmun"><i class="fa fa-trash"></i></button><?php } ?></td> 
                <input value="_inmunizaciones" id="table_inmun<?= $inmune->id ?>" type="hidden"  />
                <input value="<?= $inmune->created_at ?>" id="fecha_inmun<?= $inmune->id ?>" type="hidden"  />
                </tr>
                <?php endforeach ?>
            </tbody>
            </table> 
            </div>  
            </div> 
                    
             <div class="panel panel-default" > 
            
                <div class="panel-heading" >
                    <h3 class="text-left" >ALERGIAS</h3>   
                </div>
             
               <div class="panel-body" >
                <table id="alergias-table" class="table table-striped" style="width:100%">
             <thead>
                <tr>
                    <th>No.</th>
                    <th>Alergeno</th>
                    <th>Tratamiento</th>
                    <th>Edad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody id="info-alergia" >
             <?php foreach ( $alergias->result() as $alergia ): ?>
            <tr id="fila_ale<?= $alergia->id ?>">
                <td><?= $alergia->id ?></td>
                <td><?= $alergia->alergeno ?></td>
                <td><?= $alergia->tratamiento ?></td>
                <td><?= $alergia->edad_alergia ?></td>
                <td><?php if($type == "Medico"){}else{ ?><button class="btn btn-danger btn-delete-ale"><i class="fa fa-trash"></i></button><?php } ?></td>
                <input value="_alergias" id="table_ale<?= $alergia->id ?>" type="hidden"  />
                <input value="<?= $alergia->created_at ?>" id="fecha_ale<?= $alergia->id ?>" type="hidden"  />
            </tr>  
                <?php endforeach ?>
                </tbody>
            </table>
                </div>
            </div>  
                    
            
              <div class="panel panel-default" >
                 
                <div class="panel-heading" > 
                    <h3 class="text-left">HOSPITALIZACIONES</h3>
                    <h4 class="text-left">Dentales Restos radiculares, implantes -aleaciones- Infecciones, (caries, gingivitis, estomatitis, etc)</h4></div>
                 
                 
                <div class="panel-body" >
                        <table id="hospi-table" class="table table-striped" style="width:100%">
                     <thead>
                        <tr>
                            <th>No.</th>
                            <th>Causa</th>
                            <th>Operacion</th>
                            <th>Anestecia</th>
                            <th>Transfusión</th>
                            <th>Protesis</th>
                            <th>Manejo</th>
                            <th>Medicamentos</th>
                            <th>Edad</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody id="info-hospi" >
                     <?php foreach ( $hospitalizacion->result() as $hospi ): ?>
                    <tr id="fila_hospi<?= $hospi->id ?>">
                        <td><?= $hospi->id ?></td>
                        <td><?= $hospi->causa ?></td>
                        <td><?= $hospi->tipo_operacion ?></td>
                        <td><?= $hospi->tipo_anestesia ?></td>
                        <td><?= $hospi->tipo_transfusion ?></td>
                        <td><?= $hospi->tipo_protesis ?></td>
                        <td><?= $hospi->manejo ?></td>
                        <td><?= $hospi->medicamentos ?></td>
                        <td><?= $hospi->edad_hospi ?></td>

                        <td><?php if($type == "Medico"){}else{ ?><button class="btn btn-danger btn-delete-hospi"><i class="fa fa-trash"></i></button><?php } ?></td>
                        <input value="_hospitalizaciones" id="table_hospi<?= $hospi->id ?>" type="hidden"  />
                        <input value="<?= $hospi->created_at ?>" id="fecha_hospi<?= $hospi->id ?>" type="hidden"  />
                    </tr>  
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    
                 </div>
                </div>      
                   
                <div class="panel panel-default" >
                    
                      <div class="panel-heading" >
                          
                           <h3>VIRUS</h3>
                        </div>
                    <div class="panel-body" >
                        
            <table id="enf_inf-table" class="table table-striped" style="width:100%">
           
             <thead>
                <tr>
                    <th>No.</th>
                    <th>Enfermedad</th>
                    <th>Manejo</th>
                    <th>Medicamento</th>
                    <th>Edad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody id="info-infecto-virus" >
             <?php foreach ( $enf_infecto_viruss->result() as $enf_infecto_virus ): ?>
            <tr id="fila_virus<?= $enf_infecto_virus->id ?>">
                <td><?= $enf_infecto_virus->id ?></td>
                <td><?= $enf_infecto_virus->enfermedad ?></td>
                <td><?= $enf_infecto_virus->manejo ?></td>
                <td><?= $enf_infecto_virus->medicamento ?></td>
                <td><?= $enf_infecto_virus->edad_virus ?></td>

                <td><?php if($type == "Medico"){}else{ ?><button class="btn btn-danger btn-delete-virus"><i class="fa fa-trash"></i></button><?php } ?></td>
                <input value="_enf_infecto_virus" id="table_virus<?= $enf_infecto_virus->id ?>" type="hidden" />
                <input value="<?= $enf_infecto_virus->created_at ?>" id="fecha_virus<?= $enf_infecto_virus->id ?>" type="hidden"  />
            </tr>  
                <?php endforeach ?>
                </tbody>
            </table>
                    
                    </div>
                </div>
    
                <div class="panel panel-default" >
                
                <div class="panel-heading" >
                    <h3 class="text-left">BACTERIAS</h3>
                </div>
                
            <div class="panel-body" >    
            <table id="bacterias-table" class="table table-striped" style="width:100%">
             <thead>
                <tr>
                    <th>No.</th>
                    <th>Enfermedad</th>
                    <th>Manejo</th>
                    <th>Medicamento</th>
                    <th>Edad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody id="info-infecto-bacterias" >
             <?php foreach ( $enf_infecto_bacteriass->result() as $enf_infecto_bacterias ): ?>
                <tr id="fila_bac<?= $enf_infecto_bacterias->id ?>">
                    <td><?= $enf_infecto_bacterias->id ?></td>
                    <td><?= $enf_infecto_bacterias->enfermedad ?></td>
                    <td><?= $enf_infecto_bacterias->manejo ?></td>
                    <td><?= $enf_infecto_bacterias->medicamento ?></td>
                    <td><?= $enf_infecto_bacterias->edad_bacterias ?></td>

                    <td><?php if($type == "Medico"){}else{ ?><button class="btn btn-danger btn-delete-bac"><i class="fa fa-trash"></i></button><?php } ?></td>

                    <input value="_enf_infecto_bacterias" id="table_bac<?= $enf_infecto_bacterias->id ?>" type="hidden" />
                    
                    <input value="<?= $enf_infecto_bacterias->created_at ?>" id="fecha_bac<?= $enf_infecto_bacterias->id ?>" type="hidden" />

                </tr>  
                <?php endforeach ?>
                </tbody>
            </table>
             </div>     
            </div>
                    
                     <div class="panel panel-default" >
                
            <div class="panel-heading" ><h3>HONGOS</h3></div>  
 
            <div class="panel-body">    
            <table id="hongos-table" class="table table-striped" style="width:100%">
             <thead>
                <tr>
                    <th>No.</th>
                    <th>Enfermedad</th>
                    <th>Manejo</th>
                    <th>Medicamento</th>
                    <th>Edad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody id="info-infecto-hongos" >
             <?php foreach ( $enf_infecto_hongoss->result() as $enf_infecto_hongos ): ?>
            <tr id="fila_ho<?= $enf_infecto_hongos->id ?>">
                <td><?= $enf_infecto_hongos->id ?></td>
                <td><?= $enf_infecto_hongos->enfermedad ?></td>
                <td><?= $enf_infecto_hongos->manejo ?></td>
                <td><?= $enf_infecto_hongos->medicamento ?></td>
                <td><?= $enf_infecto_hongos->edad_hongos ?></td>

                <td><?php if($type == "Medico"){}else{ ?><button class="btn btn-danger btn-delete-ho"><i class="fa fa-trash"></i></button><?php } ?></td> 
                <input value="_enf_infecto_hongos" id="table_ho<?= $enf_infecto_hongos->id ?>" type="hidden" />
                <input value="<?= $enf_infecto_hongos->created_at ?>" id="fecha_ho<?= $enf_infecto_hongos->id ?>" type="hidden" />
            </tr>  
                <?php endforeach ?>
                </tbody>
            </table>
              </div>  
             </div>   
             
              <div class="panel panel-default" >
                <div class="panel-heading" > <h3>PARÁSITOS</h3>  </div>
                
            <div class="panel-body">    
            <table id="parasitos-table" class="table table-striped" style="width:100%">
             <thead>
                <tr>
                    <th>No.</th>
                    <th>Enfermedad</th>
                    <th>Manejo</th>
                    <th>Medicamento</th>
                    <th>Edad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody id="info-infecto-parasitos" >
             <?php foreach ( $enf_infecto_parasitoss->result() as $enf_infecto_parasitos ): ?>
            <tr id="fila_pa<?= $enf_infecto_parasitos->id ?>">
                <td><?= $enf_infecto_parasitos->id ?></td>
                <td><?= $enf_infecto_parasitos->enfermedad ?></td>
                <td><?= $enf_infecto_parasitos->manejo ?></td>
                <td><?= $enf_infecto_parasitos->medicamento ?></td>
                <td><?= $enf_infecto_parasitos->edad_parasitos ?></td>

                <td><?php if($type == "Medico"){}else{ ?><button class="btn btn-danger btn-delete-pa"><i class="fa fa-trash"></i></button><?php } ?></td>
                <input value="_enf_infecto_parasitos" id="table_pa<?= $enf_infecto_parasitos->id ?>" type="hidden" />
                <input  value="<?= $enf_infecto_parasitos->created_at ?>" id="fecha_pa<?= $enf_infecto_parasitos->id ?>" type="hidden" />
            </tr>  
                <?php endforeach ?>
                </tbody>
            </table>
                </div>
              </div>  
             
                 <div class="panel panel-default" >
                <div class="panel-heading" ><h3>PSICOLÓGICAS</h3></div>
            <div class="panel-body" >    
            <table id="psicologicas-table" class="table table-striped" style="width:100%">
             <thead>
                <tr>
                    <th>No.</th>
                    <th>Enfermedad</th>
                    <th>Manejo</th>
                    <th>Medicamento</th>
                    <th>Edad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody id="info-infecto-psicologicas" >
             <?php foreach ( $enf_infecto_psicologicass->result() as $enf_infecto_psicologicas ): ?>
            <tr id="fila_psi<?= $enf_infecto_psicologicas->id ?>">
                <td><?= $enf_infecto_psicologicas->id ?></td>
                <td><?= $enf_infecto_psicologicas->enfermedad ?></td>
                <td><?= $enf_infecto_psicologicas->manejo ?></td>
                <td><?= $enf_infecto_psicologicas->medicamento ?></td>
                <td><?= $enf_infecto_psicologicas->edad_psicologica?></td>

                <td><?php if($type == "Medico"){}else{ ?><button class="btn btn-danger btn-delete-psi"><i class="fa fa-trash"></i></button><?php } ?></td>  
                <input value="_enf_infecto_psicologicas" id="table_psi<?= $enf_infecto_psicologicas->id ?>" type="hidden" />
                <input value="<?= $enf_infecto_psicologicas->created_at ?>" id="fecha_psi<?= $enf_infecto_psicologicas->id ?>" type="hidden" />
            </tr>  
                <?php endforeach ?>
                </tbody>
            </table>
            </div>   
             </div>
             
              <div class="panel panel-default">   
                <div class="panel-heading" ><h3>OTRAS</h3>  </div>
            <div class="panel-body" >    
            <table id="otras-table" class="table table-striped" style="width:100%">
             <thead>
                <tr>
                    <th>No.</th>
                    <th>Enfermedad</th>
                    <th>Manejo</th>
                    <th>Medicamento</th>
                    <th>Edad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody id="info-infecto-otras" >
             <?php foreach ( $enf_infecto_otrass->result() as $enf_infecto_otras ): ?>
            <tr id="fila_otras<?= $enf_infecto_otras->id ?>">
                <td><?= $enf_infecto_otras->id ?></td>
                <td><?= $enf_infecto_otras->enfermedad ?></td>
                <td><?= $enf_infecto_otras->manejo ?></td>
                <td><?= $enf_infecto_otras->medicamento ?></td>
                <td><?= $enf_infecto_otras->edad_otras ?></td>

                <td>
                    <input value="_enf_infecto_otras" id="table_otras<?= $enf_infecto_otras->id ?>" type="hidden" />
                    <input value="<?= $enf_infecto_otras->created_at ?>" id="fecha_otras<?= $enf_infecto_otras->id ?>" type="hidden" />
                    <?php if($type == "Medico"){}else{ ?><button class="btn btn-danger btn-delete-otras"><i class="fa fa-trash"></i></button><?php } ?>
                    </td> 
                </td>
            </tr>  
                <?php endforeach ?>
                </tbody>
            </table>
            </div>
            </div>        
                
                    
                        
                </div>
            </div>
        </div>
    </div>
</div> 

