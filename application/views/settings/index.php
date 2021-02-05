<?php 
    $com_agent = $com_agent->row();
    $com_user = $com_user->row();
    $com_suc = $com_suc->row();
?>

<div class="container">
	
	<div class="col-xs-12">
		<h3 class="ms-title"><b>CONFIGURACIÓN</b></h3>
	</div>
    
    <div class="col-sm-12" >
        <div class="panel panel-default" >
            <div class="panel-heading" >COMISIONES</div>    
            <div class="panel-body" >
                
                
                <div class="col-sm-4 text-center" >
                 <form id="update_com_agent" method="post">   
                <label>Representante (%)
                <input  type="number" class="form-control" name="com_agent" id="com_agent" placeholder="%" maxlength="3" max="40" required /></label>
                <input type="hidden" value="<?= $com_agent->id ?>" name="id_com" />     
                   
                <div class="col-sm-12">
                     
                    <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-floppy-disk"></i></button>
                    <small><p><label>Actual:  </label> <span id="up_com_agent"><?= $com_agent->option_value ?></span>  %</p></small>
                    
                </div>
                </form> 
                </div>
                
               <div class="col-sm-4 text-center" >
                 <form id="update_com_user" method="post">   
                <label>Usuarios (%)
                <input  type="number" class="form-control" name="com_user" id="com_user" placeholder="%" maxlength="3" max="40" required /></label>
                <input type="hidden" value="<?= $com_user->id ?>" name="id_com" />     
                   
                <div class="col-sm-12">
                     
                    <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-floppy-disk"></i></button>
                    <small><p><label>Actual:  </label> <span id="up_com_user"><?= $com_user->option_value ?></span>  %</p></small>
                    
                </div>
                </form> 
                </div>
                
                <div class="col-sm-4 text-center" >
                 <form id="update_com_suc" method="post">   
                <label>Sucursal (%)
                <input  type="number" class="form-control" name="com_suc" id="com_suc" placeholder="%" maxlength="3" max="40" required /></label>
                <input type="hidden" value="<?= $com_suc->id ?>" name="id_com" />     
                   
                <div class="col-sm-12">
                     
                    <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-floppy-disk"></i></button>
                    <small><p><label>Actual:  </label> <span id="up_com_suc"><?= $com_suc->option_value ?></span>  %</p></small>
                    
                </div>
                </form> 
                </div>
                
                
                 
            
            </div>
        </div>
    
    </div>
    
	
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-body">
                
                <div class="col-sm-6">
                    <div class="panel panel-default" >
                        <div class="panel-heading" >
                        
                            <h4>Motivo de Consulta</h4>
                        </div>
                        <div class="panel-body" >
                            <div class="col-sm-12" >
                                <label>Enfermedad (Motivo de Consulta)</label>
                                <form id="add_motivo_consulta" name="add_motivo_consulta" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="motivo_consulta" name="motivo_consulta"  />
                                <small>Esta aparece en el motivo de consulta</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div>  
                        </div>
                    </div>
                  
                </div>
                
                <div class="col-sm-6">
                    <div class="panel panel-default" >
                        <div class="panel-heading" >
                        
                            <h4>Enfermedad Congénita</h4>
                        </div>
                        <div class="panel-body" >
                            <div class="col-sm-12" >
                                <label>Enfermedad </label>
                                <form id="add_enf_cong" name="add_enf_cong" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="enf_cong" name="enf_cong"  />
                                <small>Esta aparece en enfermedades congénitas</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div>  
                        </div>
                    </div>
                
                </div>
                
                <div class="col-sm-6">
                    <div class="panel panel-default" >
                        <div class="panel-heading" >
                        
                            <h4>Medicamentos</h4>
                        </div>
                        <div class="panel-body" >
                            <div class="col-sm-12" >
                                <label>Medicamento</label>
                                <form id="add_medicamento" name="add_medicamento" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="medicamento" name="medicamento"  />
                                <small>Esta aparece los medicamentos.</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div>  
                        </div>
                    </div>
                
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default" >
                        <div class="panel-heading" >
                        
                            <h4>Vacunas</h4>
                        </div>
                        <div class="panel-body" >
                            <div class="col-sm-12" >
                                <label>Vacuna</label>
                                <form id="add_vacuna" name="add_vacuna" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="vacuna" name="vacuna"  />
                                <small>Esta aparece en vacunas.</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div>  
                        </div>
                    </div>
                
                </div>
                
                <div class="col-sm-6">
                    <div class="panel panel-default" >
                        <div class="panel-heading" >
                        
                            <h4>Alergias</h4>
                        </div>
                        <div class="panel-body" >
                            <div class="col-sm-12" >
                                <label>Alergeno</label>
                                <form id="add_alergia" name="add_alergia" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="alergia" name="alergia"  />
                                <small>Esta aparece en alergenos.</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div>  
                        </div>
                    </div>
                
                </div> 
                
                <div class="col-sm-6">
                    <div class="panel panel-default" >
                        <div class="panel-heading" >
                        
                            <h4>Tratamiento Alergias</h4>
                        </div>
                        <div class="panel-body" >
                            <div class="col-sm-12" >
                                <label>Tratamiento</label>
                                <form id="add_trat_alergia" name="add_trat_alergia" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="trat_ale" name="trat_ale"  />
                                <small>Esta aparece en tratamiento de alergias.</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div>  
                        </div>
                    </div>
                
                </div> 
                
                <div class="col-sm-12">
                    <div class="panel panel-default" >
                        <div class="panel-heading" >
                        
                            <h4>Hospitalizaciones</h4>
                        </div>
                        <div class="panel-body" >
                            
                            <div class="col-sm-6" >
                                <label>Causa</label>
                                <form id="add_hospi_causa" name="add_hospi_causa" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="hospi_causa" name="hospi_causa"  />
                                <small>Esta aparece en hospitalizaciones.</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div> 
                            
                            <div class="col-sm-6" >
                                <label>Tipo de Operación</label>
                                <form id="add_hospi_operacion" name="add_hospi_operacion" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="hospi_operacion" name="hospi_operacion"  />
                                <small>Esta aparece en hospitalizaciones.</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div> 
                            
                            <div class="col-sm-6" >
                                <label>Tipo de Anestesia</label>
                                <form id="add_hospi_ane" name="add_hospi_ane" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="hospi_ane" name="hospi_ane"  />
                                <small>Esta aparece en hospitalizaciones.</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div> 
                            <div class="col-sm-6" >
                                <label>Tipo de Transfusión</label>
                                <form id="add_hospi_trans" name="add_hospi_trans" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="hospi_trans" name="hospi_trans"  />
                                <small>Esta aparece en hospitalizaciones.</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div> 
                            
                            <div class="col-sm-6" >
                                <label>Tipo de Prótesis</label>
                                <form id="add_hospi_pro" name="add_hospi_pro" method="post">
                                <input required class="form-control" placeholder="Ingresa aquí"  id="hospi_pro" name="hospi_pro"  />
                                <small>Esta aparece en hospitalizaciones.</small>
                                <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                </form>    
                            </div> 
                            
                        </div>
                    </div>
                
                </div>
                
             <div class="col-sm-12">
                            <div class="panel panel-default" >
                                <div class="panel-heading" >

                                    <h4>Enfermedades Infectocontagiosa</h4>
                                </div>
                                <div class="panel-body" >
                                    
                                    <div class="col-sm-6" >
                                        <label>Virus</label>
                                        <form id="add_enf_virus" name="add_enf_virus" method="post">
                                        <input required class="form-control" placeholder="Ingresa aquí"  id="enf_virus" name="enf_virus"  />
                                        <small>Esta aparece en virus.</small>
                                        <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                        </form>    
                                    </div>
                                    
                                    <div class="col-sm-6" >
                                        <label>Bacterias</label>
                                        <form id="add_enf_bacteria" name="add_enf_bacteria" method="post">
                                        <input required class="form-control" placeholder="Ingresa aquí"  id="enf_bacteria" name="enf_bacteria"  />
                                        <small>Esta aparece en bacterias.</small>
                                        <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                        </form>    
                                    </div>
                                    
                                    <div class="col-sm-6" >
                                        <label>Hongos</label>
                                        <form id="add_enf_hongos" name="add_enf_hongos" method="post">
                                        <input required class="form-control" placeholder="Ingresa aquí"  id="enf_hongos" name="enf_hongos"  />
                                        <small>Esta aparece en hongos.</small>
                                        <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                        </form>    
                                    </div>
                                    
                                    <div class="col-sm-6" >
                                        <label>Parásitos</label>
                                        <form id="add_enf_parasitos" name="add_enf_parasitos" method="post">
                                        <input required class="form-control" placeholder="Ingresa aquí"  id="enf_parasitos" name="enf_parasitos"  />
                                        <small>Esta aparece en parásitos.</small>
                                        <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                        </form>    
                                    </div>
                                    
                                    <div class="col-sm-6" >
                                        <label>Psicológicas</label>
                                        <form id="add_enf_psico" name="add_enf_psico" method="post">
                                        <input required class="form-control" placeholder="Ingresa aquí"  id="enf_psico" name="enf_psico"  />
                                        <small>Esta aparece en Psicológicas.</small>
                                        <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                        </form>    
                                    </div>
                                    
                                    <div class="col-sm-6" >
                                        <label>Otras</label>
                                        <form id="add_enf_otras" name="add_enf_otras" method="post">
                                        <input required class="form-control" placeholder="Ingresa aquí"  id="enf_otras" name="enf_otras"  />
                                        <small>Esta aparece en Otras.</small>
                                        <button type="submit" class="btn btn-sm btn-info pull-right" ><i class="glyphicon glyphicon-plus"></i></button>
                                        </form>    
                                    </div>  
                                    
                                </div>
                            </div>

                        </div>
            </div>
		</div>
	</div>

</div>