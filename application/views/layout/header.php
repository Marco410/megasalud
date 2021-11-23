<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

$css_path = base_url('assets/css').'/';
$img_path = base_url('assets/images').'/';
$js_path = base_url('assets/js').'/';
$plugins = base_url('assets/plugins').'/';
$type = $this->session->type;  
?>
	<div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="<?=base_url('/home');?>"><img width="180px" height="45px" class="main-logo" src="<?= $img_path ?>logo2.png" alt="" /></a>
                <strong><a href="<?=base_url('/home');?>"><img width="45px" height="45px"  src="<?= $img_path ?>logo.png" alt="Logo" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        
                         <?php if($type == "Paciente"  ){ ?>
                        <li>
                            <a title="Inicio" href="<?=base_url('/cliente');?>" aria-expanded="false"><span class="fa fa-home" aria-hidden="true"></span> <span class="mini-click-non">Inicio</span></a>
                        </li>
                        
                        <?php } else{ ?>
                        <li>
                            <a title="Inicio" href="<?=base_url('/home');?>" aria-expanded="false"><span class="fa fa-home" aria-hidden="true"></span> <span class="mini-click-non">Inicio</span></a>
                        </li>
                        <?php } ?>
                        <?php if($type == "Representante"  ){ ?>
                        <li>
                            <a title="Representante" href="<?=base_url('/representante/ver/'). $this->session->id;?>" aria-expanded="false"><span class="fa fa-th-large" aria-hidden="true"></span> <span class="mini-click-non">Mi Panel</span></a>
                        </li>
                        <?php } ?>
                        
                         <?php if($type == "Administrador"  ){  ?>
                        <li>
                            <a class="has-arrow" href="#">
								   <span class="glyphicon glyphicon-th-list"></span>
								   <span class="mini-click-non"> Administración</span>
								</a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a title="Usuarios" href="<?=base_url('/usuarios');?>"><span class="mini-sub-pro"><i class="fa fa-user"></i> Usuarios</span></a></li>
                                <li><a title="Sucursales" href="<?=base_url('/sucursales');?>" ><span class="mini-sub-pro"><i class="fa fa-hospital-o"></i> Sucursales</span></a></li>
                                <li><a title="Comisiones" href="<?=base_url('/comisiones');?>" ><span class="mini-sub-pro"><i class="fa fa-money"></i> Comisiones</span></a></li>
                                <li><a title="Proveedores" href="<?=base_url('/proveedores');?>"><span class="mini-sub-pro"><i class="fa fa-bus" ></i> Proveedores</span></a></li>
                                
                               
                            </ul>
                        </li>
                        <?php } ?>
                        
                        <?php if($type == "Administrador" || $type == "Ventas"  ){ ?>
                        <li>
                            <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="fa fa-shopping-bag"></span><span class="mini-click-non">  Ventas</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Representantes" href="<?=base_url('/representante')?>"><span class="mini-sub-pro"><i class="fa fa-users" ></i> Representantes</span></a></li>
                                <li><a title="Representantes" href="<?=base_url('/representante/solicitudes')?>"><span class="mini-sub-pro"><i class="fa fa-address-card" ></i> Solicitudes</span></a></li>
                                
                            </ul>
                        </li>
                      <?php } ?>

                      <?php if($type == "Administrador" || $type == "Atención a Clientes"  ){ ?>
                        <li>
                            <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="fa fa-handshake-o"></span><span class="mini-click-non">  Atención</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Pacientes" href="<?=base_url('/atencion/pacientes')?>"><span class="mini-sub-pro"><i class="fa fa-address-book" ></i> Pacientes</span></a></li>
                                
                            </ul>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Prospectos" href="<?=base_url('/atencion/prospectos')?>"><span class="mini-sub-pro"><i class="fa fa-users" ></i> Prospectos</span></a></li>
                                
                            </ul>
                        </li>
                      <?php } ?>
                    
                        <?php if($type == "Administrador" || $type == "Contador" || $type == "Gerente Sucursal" || $type == "Produccion"  ){ ?>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="fa fa-cubes"></span> <span class="mini-click-non">Almacén</span></a>
                            <ul class="submenu-angle chart-mini-nb-dp" aria-expanded="false">
                                <?php if($type == "Administrador" || $type == "Contador"  ){ ?>
                                <li><a title="Almacén" href="<?=base_url('/almacen');?>"><span class="mini-sub-pro"><i class="fa fa-cube" ></i> Inventario</span></a></li>
                                <?php } ?>
                                <li><a title="Productos" href="<?=base_url('/productos');?>"><span class="mini-sub-pro"><i class="fa fa-tags" ></i>  Productos</span></a></li>
                                <li><a title="Pedidos" href="<?=base_url('/pedidos');?>"><span class="mini-sub-pro"><i class="fa fa-truck" ></i>  Pedidos</span></a></li> 
                                <li><a title="Contaduria" href="<?=base_url('/contaduria');?>"><span class="mini-sub-pro"><i class="fa fa-calculator" ></i>  Contaduria</span></a></li>
                               
                            </ul>
                        </li>
                        <?php } ?>
                        
                        <?php if($type == "Administrador" || $type == "Medico Administrador" || $type== "Medico" ){ ?>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="fa fa-user-md"></span> <span class="mini-click-non">Médico</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Pacientes" href="<?=base_url('/pacientes');?>"><span class="mini-sub-pro"><span class="fa fa-address-book"></span> Pacientes</span></a></li>
                                <li><a title="Escuela" href="<?=base_url('/escuela');?>"><span class="mini-sub-pro"><span class="fa fa-stethoscope"></span> Escuela</span></a></li>
                                
                                 <?php if($type == "Administrador" || $type == "Medico Administrador" ){ ?>
                                
                                <li><a title="Venenos" href="<?=base_url('/venenos');?>"><span class="mini-sub-pro"><span class="fa fa-exclamation-triangle"></span> Venenos</span></a></li>
                                
                                 <?php } ?>
                                <li><a title="Tutoriales" href="<?=base_url('/tutoriales/medico');?>"><span class="mini-sub-pro"><span class="fa fa-play"></span> Tutoriales</span></a></li>
                                <li><a title="Mensajes" href="<?=base_url('/mensajes');?>"><span class="mini-sub-pro"><span class="fa fa-inbox"></span> Mensajes</span></a></li>
                            </ul>
                        </li>
                         <?php } ?>
                        
                        <?php if($type == "Administrador" || $type == "Medico Administrador"|| $type == "Ventas" || $type == "Produccion" ){ ?>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="fa fa-bar-chart"></span> <span class="mini-click-non">Estadísticas</span></a>
                            <ul class="submenu-angle form-mini-nb-dp" aria-expanded="false">
                                <li><a title="Principal" href="<?=base_url('/estadisticas');?>"><span class="mini-sub-pro"><i class="fa fa-pie-chart" ></i> Pacientes</span></a></li>
                                <li><a title="Ventas" href="<?=base_url('/estadisticas/ventas');?>"><span class="mini-sub-pro"><i class="fa fa-pie-chart" ></i> Ventas</span></a></li>
                                
                            </ul>
                        </li>
                        <?php } ?>
                        
                        <?php if($type == "Administrador" || $type == "Medico Administrador" ){ ?>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> <span class="mini-click-non">Configuración</span></a>
                            <ul class="submenu-angle form-mini-nb-dp" aria-expanded="false">
                                <li><a title="Datos" href="<?=base_url('/configuracion');?>"><span class="mini-sub-pro"><i class="fa fa-database" ></i> Datos</span></a></li>
                                <li><a title="Sistema" href="<?=base_url('/configuracion/sistema');?>"><span class="mini-sub-pro"><i class="fa fa-server" ></i> Sistema</span></a></li>
                                
                            </ul>
                        </li>
                        <?php } ?>
                     
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
<div class="all-content-wrapper">
<div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="<?=base_url('/home');?>"><img class="main-logo" height="40px" width="180px" src="<?= $img_path ?>logo2.png" alt="logo megasalud" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
													<i class="glyphicon glyphicon-align-left"></i>
								            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12 text-center">
                                        <!-- Puede ir un menu aqui  --->
                                        <h2 class="text-danger" > <strong>Servidor de Prueba</strong> </h2>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
															<img src="<?php echo $img_path ?>user.jpg" alt="" />
															<span class="admin-name"><?php echo $this->session->name ?></span>
															<i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
														</a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <?php if($type == "Paciente"  ){ ?><?php } else{ ?>
                                                        <li><a href="<?= base_url().'cuenta' ?>"><span class="fa fa-user"></span>  Mi Cuenta</a>
                                                        </li>
                                                        <?php } ?>
                                                        <li><a href="<?=base_url('/logout');?>"><span class="fa fa-times"></span>  Cerrar Sesión</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        
                                        
                                        <?php if($type == "Paciente"  ){ ?>
                                    <li>
                                        <a title="Inicio" href="<?=base_url('/cliente');?>" aria-expanded="false"><span class="fa fa-home" aria-hidden="true"></span> <span class="mini-click-non">Inicio</span></a>
                                    </li>

                                    <?php } else{ ?>
                                    <li>
                                        <a title="Inicio" href="<?=base_url('/home');?>" aria-expanded="false"><span class="fa fa-home" aria-hidden="true"></span> <span class="mini-click-non">Inicio</span></a>
                                    </li>
                                    <?php } ?>
                                        
                                    <?php if($type == "Administrador" || $type == "Representante"  ){ ?>
                                    <li>
                                        <a title="Representante" href="<?=base_url('/representante/ver/'). $this->session->id;?>" aria-expanded="false"><span class="fa fa-th-large" aria-hidden="true"></span> <span class="mini-click-non">Mi Panel</span></a>
                                    </li>
                                    <?php } ?>
                                        
                                         <?php if($type == "Administrador"  ){  ?>
                                        
                                        
                                         <li class="active" ><a data-toggle="collapse" data-target="#Charts" href="#">Administración<span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="<?=base_url('/usuarios');?>">Usuarios</a></li>
                                                <li><a href="<?=base_url('/sucursales');?>">Sucursales</a></li>
                                                <li><a href="<?=base_url('/comisiones');?>">Comisiones</a></li>
                                                <li><a title="Proveedores" href="<?=base_url('/proveedores');?>"><span class="mini-sub-pro"><i class="fa fa-bus" ></i> Proveedores</span></a></li>
                                                
                                            </ul>
                                        </li>
                                        <?php } ?>
                                        
                                        <?php if($type == "Administrador" || $type == "Ventas"  ){ ?>
                                    
                                         <li  class="active" ><a data-toggle="collapse" data-target="#demoevent" href="#">Ventas<span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demoevent" class="collapse dropdown-header-top">
                                                <li><a href="<?=base_url('/representante')?>">Representantes</a>
                                                </li>
                                                
                                            </ul>
                                        </li>
                                      <?php } ?>
                                        
                                    <?php if($type == "Administrador" || $type == "Contador" ){ ?>
                                        
                                     <li class="active" ><a data-toggle="collapse" data-target="#demopro" href="#">Almacén<span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                        <ul id="demopro" class="collapse dropdown-header-top">
                                            <li><a href="<?=base_url('/almacen');?>">Inventario</a>
                                            </li>
                                            <li><a href="<?=base_url('/productos');?>">Productos</a>
                                            </li>
                                            <li><a href="<?=base_url('/pedidos');?>">Pedido</a>
                                            </li> 
                                            <li><a href="<?=base_url('/contaduria');?>">Contaduria</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                        
                                    <?php if($type == "Administrador" || $type == "Medico Administrador" || $type== "Medico" ){ ?>
                                   
                                        
                                     <li><a data-toggle="collapse" data-target="#democrou" href="#">Médico<span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                        <ul id="democrou" class="collapse dropdown-header-top">
                                            <li><a href="<?=base_url('/pacientes');?>">Pacientes</a>
                                            </li>
                                            <li><a href="<?=base_url('/escuela');?>">Escuela</a>
                                            </li>

                                            <?php if($type == "Administrador" || $type == "Medico Administrador" ){ ?>
                                            <li><a href="<?=base_url('/venenos');?>">Venenos</a>
                                            </li>
                                            <?php } ?>
                                            <li><a title="Tutoriales" href="<?=base_url('/tutoriales/medico');?>"><span class="mini-sub-pro"><span class="fa fa-play"></span> Tutoriales</span></a></li>
                                            <li><a title="Mensajes" href="<?=base_url('/mensajes');?>"><span class="mini-sub-pro"><span class="fa fa-inbox"></span> Mensajes</span></a></li>
                                        </ul>
                                    </li>
                                     <?php } ?>   
                                    
                                    <?php if($type == "Administrador" || $type == "Medico Administrador" ){ ?>
                                   
                                        
                                     <li><a data-toggle="collapse" data-target="#demolibra">Configuración <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                        <ul id="demolibra" class="collapse dropdown-header-top">
                                            <li><a href="<?=base_url('/configuracion');?>">Datos</a>
                                            <li><a href="<?=base_url('/configuracion/sistema');?>">Sistema</a>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    <?php } ?>
                                       
                                       
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>