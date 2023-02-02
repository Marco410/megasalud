<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'welcome';

/*
----------------------------------
| General Routes
-----------------------------------
*/
$route['default_controller'] = 'MainController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
----------------------------------
| Auth Routes
-----------------------------------
*/
$route['login'] = 'megasalud/AuthController/login';
$route['logout'] = 'megasalud/AuthController/logout';
$route['cuenta'] = 'megasalud/AuthController/perfil';
$route['home'] = 'megasalud/MainController/home';
$route['password-request'] = 'megasalud/AuthController/password_request';
$route['reset_password/(:any)'] = 'megasalud/AuthController/confirmToken/$1';

/*
----------------------------------
| Users Routes
-----------------------------------
*/
$route['usuarios'] = 'megasalud/UsersController/index';
$route['usuarios/nuevo'] = 'megasalud/UsersController/create';
$route['usuarios/sesiones'] = 'megasalud/UsersController/sessions';

/*
----------------------------------
| Office Routes
-----------------------------------
*/
$route['sucursales'] = 'megasalud/OfficeController/index';
$route['sucursales/nuevo'] = 'megasalud/OfficeController/create';
$route['sucursales/editar/(:num)'] = 'megasalud/OfficeController/edit/$1';
$route['sucursales/agenda/(:num)'] = 'megasalud/OfficeController/agenda/$1';
/*
----------------------------------
| Comisiones Routes
-----------------------------------
*/
$route['comisiones'] = 'megasalud/ComController/index';
$route['comisiones/getSuc'] = 'megasalud/ComController/getCom_Suc';
$route['comisiones/getAgent'] = 'megasalud/ComController/getCom_Agent';
$route['comisiones/getUser'] = 'megasalud/ComController/getCom_User';
$route['sucursales/nuevo'] = 'megasalud/OfficeController/create';
$route['sucursales/editar/(:num)'] = 'megasalud/OfficeController/edit/$1';

/*
----------------------------------
| Sales Routes
-----------------------------------
*/
$route['productos'] = 'megasalud/ProductsController/index';
$route['productos/nuevo'] = 'megasalud/ProductsController/create';
$route['productos/apartados/(:num)'] = 'megasalud/ProductsController/apartados/$1';
$route['productos/entrada/(:num)'] = 'megasalud/ProductsController/entrada/$1';
$route['productos/entradas-mostrar/(:num)'] = 'megasalud/ProductsController/entradas/$1';

/*
----------------------------------
| Orders Routes
-----------------------------------
*/

$route['pedidos'] = 'megasalud/OrdersController/index';
$route['pedidos/nuevo'] = 'megasalud/OrdersController/create';
$route['pedidos/editar/(:num)'] = 'megasalud/OrdersController/edit/$1';
$route['pedidos/mostrar/(:num)'] = 'megasalud/OrdersController/show/$1';
$route['pedidos/receta/(:num)'] = 'megasalud/OrdersController/receta/$1';
$route['pedidos/carrito/(:num)'] = 'megasalud/OrdersController/carrito/$1';

/*
----------------------------------
| Medic Routes
-----------------------------------
*/
$route['pacientes'] = 'megasalud/PatientsController/index';
$route['pacientes/getxMxQ'] = 'megasalud/PatientsController/getAll';
$route['pacientes/hist_cit'] = 'megasalud/PatientsController/his_citas';
$route['pacientes/estudio-movil'] = 'megasalud/PatientsController/estudio_movil';
$route['pacientes/perfil-movil'] = 'megasalud/PatientsController/foto_perfil_movil';
$route['pacientes/nuevo'] = 'megasalud/PatientsController/create';
$route['pacientes/editar/(:num)'] = 'megasalud/PatientsController/edit/$1';
$route['pacientes/recetas/(:num)'] = 'megasalud/PatientsController/receta/$1';
$route['pacientes/estudio'] = 'megasalud/PatientsController/agregar_estudio';

$route['pacientes/evolucion/(:num)'] = 'megasalud/PatientsController/evolucion/$1';
$route['pacientes/registro-evolucion/(:num)'] = 'megasalud/PatientsController/registro_evolucion/$1';

$route['pacientes/upload_estudio'] = 'megasalud/PatientsController/upload_estudio';

$route['pacientes/historia/(:num)'] = 'megasalud/PatientsController/historia/$1';
$route['pacientes/graficas/(:num)'] = 'megasalud/PatientsController/charts/$1';
$route['pacientes/historia/(:num)/estudios/(:num)'] = 'megasalud/PatientsController/ver_estudio/$1';
$route['pacientes/adeudos/(:num)'] = 'megasalud/PatientsController/adeudos/$1';
$route['pacientes/resumen/(:num)'] = 'megasalud/PatientsController/resumen/$1';

$route['pacientes/buscar/(:any)'] = 'megasalud/PatientsController/api_find_paciente/$1';
$route['pacientes/datapersonal'] = 'megasalud/PatientsController/api_find_datapersonal';
$route['pacientes/datanotas/(:any)'] = 'megasalud/PatientsController/api_find_datanotas/$1';
$route['pacientes/datacitas/(:any)'] = 'megasalud/PatientsController/api_find_datacitas/$1';
$route['pacientes/datapedidos'] = 'megasalud/PatientsController/api_find_datapedidos';
$route['pacientes/dataestadisticas'] = 'megasalud/PatientsController/api_find_dataestadisticas';
$route['pacientes/datalinea/(:any)'] = 'megasalud/PatientsController/api_find_datalinea/$1';
/*
----------------------------------
| Medic Routes
-----------------------------------
*/
$route['pacientes/linea-vida/(:num)'] = 'megasalud/LineaVidaController/index/$1';
$route['pacientes/buscar/(:any)'] = 'megasalud/PatientsController/api_find_paciente/$1';


/*
----------------------------------
| Client Routes
-----------------------------------
*/
$route['paciente'] = 'megasalud/ClientController/index';
$route['paciente/pedidos'] = 'megasalud/ClientController/pedidos';
$route['paciente/estudios'] = 'megasalud/ClientController/estudios';
$route['paciente/graficas'] = 'megasalud/ClientController/charts';
$route['paciente/pedido/mostrar/(:num)'] = 'megasalud/ClientController/mostrar/$1';
$route['paciente/pedido/pagar/(:num)'] = 'megasalud/ClientController/pagar/$1';

/*
----------------------------------
| Roles Routes
-----------------------------------
*/
$route['roles'] = 'megasalud/RolesController/index';
$route['roles/nuevo'] = 'megasalud/RolesController/create';
$route['roles/editar/(:num)'] = 'megasalud/RolesController/edit/$1';


/*
----------------------------------
| Medic Routes
-----------------------------------
*/
$route['escuela'] = 'megasalud/MedicController/escuela';

/*
----------------------------------
| Proveedores Routes
-----------------------------------
*/
$route['proveedores'] = 'megasalud/ProviderController/index';
$route['proveedores/nuevo'] = 'megasalud/ProviderController/create';
$route['proveedores/editar/(:num)'] = 'megasalud/ProviderController/edit/$1';


/*
----------------------------------
| Almacen Routes
-----------------------------------
*/
$route['almacen'] = 'megasalud/AlmacenController/index';
$route['almacen/nuevo'] = 'megasalud/AlmacenController/create';
$route['almacen/entrada'] = 'megasalud/AlmacenController/entrada';
$route['almacen/entradas-mostrar'] = 'megasalud/AlmacenController/entrada_show';
$route['almacen/salida'] = 'megasalud/AlmacenController/salida';
$route['almacen/salidas-mostrar'] = 'megasalud/AlmacenController/salida_show';

/*
----------------------------------
| Permisos Routes
-----------------------------------
*/
$route['permisos'] = 'megasalud/PermisosController/index';
$route['permisos/nuevo'] = 'megasalud/PermisosController/create';
$route['permisos/editar/(:num)'] = 'megasalud/PermisosController/edit/$1';
/*
----------------------------------
| Estadisticas Routes
-----------------------------------
*/
$route['estadisticas'] = 'megasalud/StatisticsController/index';
$route['estadisticas/ventas'] = 'megasalud/StatisticsController/ventas';

/*
----------------------------------
| Form route
-----------------------------------
*/
$route['venenos'] = 'megasalud/VenenosController/index';
$route['venenos/nuevo'] = 'megasalud/VenenosController/create';
$route['venenos/editar/(:num)'] = 'megasalud/VenenosController/edit/$1';
$route['venenos/editar-medicamento/(:num)'] = 'megasalud/VenenosController/edit_medicamento/$1';
/*

/*
----------------------------------
| Settigs route
-----------------------------------
*/
$route['configuracion'] = 'megasalud/SettingsController/index';
$route['configuracion/sistema'] = 'megasalud/SettingsController/sistema';

/*
----------------------------------
| Accountant route
-----------------------------------
*/
$route['contaduria'] = 'megasalud/AccountantController/index';

/*
----------------------------------
| Agent route
-----------------------------------
*/
$route['representante'] = 'megasalud/AgentController/index';
$route['representante/nuevo'] = 'megasalud/AgentController/create';
$route['representante/exito'] = 'megasalud/AgentController/success';
$route['representante/paciente/nuevo'] = 'megasalud/AgentController/createPacient';
$route['representante/editar/(:num)'] = 'megasalud/AgentController/edit/$1';
$route['representante/ver/(:num)'] = 'megasalud/AgentController/ver/$1';
$route['representante/get'] = 'megasalud/AgentController/getAll';
$route['representante/getPaciente'] = 'megasalud/AgentController/getPacientes';
$route['representante/archivos/(:num)'] = 'megasalud/AgentController/archivos/$1';
$route['representante/solicitudes'] = 'megasalud/AgentController/solicitudes';
$route['representante/ver-solicitud/(:num)'] = 'megasalud/AgentController/ver_solicitud/$1';

/*
----------------------------------
| Atención a clientes
-----------------------------------
*/
$route['atencion/pacientes'] = 'megasalud/AtencionController/pacientes';
$route['atencion/ver-paciente/(:num)'] = 'megasalud/AtencionController/ver_paciente/$1';
$route['atencion/prospectos'] = 'megasalud/AtencionController/prospectos';
$route['prospectos/getxMxQ'] = 'megasalud/AtencionController/getAll';



/*
----------------------------------
| Tutorials route
-----------------------------------
*/
$route['tutoriales/medico'] = 'megasalud/TutorialController/medico';

/*
----------------------------------
| Mensajes routes
-----------------------------------
*/
$route['mensajes'] = 'megasalud/MessengerController/index';


/*
----------------------------------
| API routes
-----------------------------------
*/
$route['pa_nl'] = 'megasalud/APIController/pacientes_notas';
$route['perfil'] = 'megasalud/APIController/perfil';

/*
----------------------------------
| Prospectos routes
-----------------------------------
*/
$route['registrame'] = 'megasalud/ProspectosController/index';




/*
----------------------------------
| Wildcard route
-----------------------------------
*/
$route['(:any)'] = 'megasalud/MainController/view/$1';

