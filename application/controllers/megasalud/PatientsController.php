<?php 

class PatientsController extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/historia');
        $this->load->model('megasalud/sucursal');
        $this->load->model('megasalud/funciones');
        $this->load->model('megasalud/settings');
        $this->load->model('megasalud/agent');
        $this->load->model('megasalud/mensajes');
    }

    public function index() {
        
        session_redirect();

        $data = array();
        $data['title'] = 'Pacientes';
        $data['view_controller'] = array(
            2 => 'pacients/index_vs.js',
            1 => 'pacients_vs.js',
            );

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador"|| $type == "Medico" ){
             $this->load->view('pacients/index', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
        
    }
    
    public function his_citas(){
         $id = $this->session->id;
        
        $this->db->select("p.id,p.clave_bancaria,p.telefono_a,h.motivo,h.created_at, CONCAT(p.nombre,' ',p.apellido_p,' ',p.apellido_m) as nombre");
        $this->db->from("hisclinic_historial h");
        $this->db->join("pacientes p", "h.id_paciente = p.id",'inner');
       
        $this->db->where('h.id_user', $id);
       
         $result =  $this->db->get();
         $response = $result->result();
        
         $array["data"]=$response;
                
         echo json_encode($array);
    }
    
    public function his_citas2(){
        $id = $this->session->id;
         $this->db->select("u.nombre,p.id,p.clave_bancaria,p.telefono_a,h.motivo,h.created_at,s.razon_social, CONCAT(p.nombre,' ',p.apellido_p,' ',p.apellido_m) as nombre_p");
         $this->db->from("hisclinic_historial h");
         $this->db->join("pacientes p", "h.id_paciente = p.id",'inner');
         $this->db->join("users u", "u.id = h.id_user",'inner');
         $this->db->join("sucursal_pacientes sp", "sp.paciente_id = p.id",'inner');
         $this->db->join("sucursales s", "s.id = sp.sucursal_id",'inner');
         $result =  $this->db->get();
         $response = $result->result();
        
         $array["data"]=$response;
                
         echo json_encode($array);
    }

    public function create(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nuevo paciente';
        // $data['view_style'] = 'pacients.css';
        $data['view_controller'] = 'pacients/create_vs.js';
        $data['sucursales'] = $this->sucursal->getAll();
        $data['empleos'] = $this->historia->get_empleos();
        
        
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
         $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador"|| $type == "Medico" || $type ==  "Atención a Clientes" ){
             $this->load->view('pacients/create');
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
    }
    
    public function edit($id) {

        session_redirect();

        $data['title'] = 'Editar Paciente';
        $data['paciente'] = $this->historia->find($id);
        $data['view_controller'] = 'pacients_vs.js';
        $data['empleos'] = $this->historia->get_empleos();
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
         $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador" || $type == "Medico" || $type == "Representante" || $type ==  "Atención a Clientes" ){
             $this->load->view('pacients/edit', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
    }
    
    public function receta($id) {
        session_redirect();

        $data['title'] = 'Recetas Paciente';
        $data['paciente'] = $this->historia->find($id);
        $data['recetas'] = $this->historia->find_receta($id);
        $data['view_controller'] = 'pacients_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
         $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador"|| $type == "Medico" || $type ==  "Atención a Clientes" ){
             $this->load->view('pacients/receta', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
    }

    public function evolucion($id) {
        session_redirect();

        $data['title'] = 'Evolución del Paciente';
        $data['paciente'] = $this->historia->find($id);
        $data['linea_vida'] = $this->historia->linea_vida($id);

        $data['view_controller'] = 'pacients/evolucion_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
         $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador"|| $type == "Medico" || $type ==  "Atención a Clientes" ){
             $this->load->view('pacients/evolucion', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
    }

    public function registro_evolucion($id) {
        session_redirect();

        $data['title'] = 'Registrar Evolución del Paciente';
        $data['dato_linea_vida'] = $this->historia->dato_linea_vida($id);
        $data['evolucion'] = $this->historia->evolucion($id);
        $data['paciente'] = $this->historia->find($_GET['p']);

        $data['view_controller'] = 'pacients/evolucion_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
         $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador"|| $type == "Medico" || $type ==  "Atención a Clientes" ){
             $this->load->view('pacients/dato_evolucion', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
    }
    
    public function historia($id){

    session_redirect();
    
    $data = array();    
    $data['title'] = 'Historial Clinico';
    $data['paciente'] = $this->historia->find($id);
    $data['paciente_suc'] = $this->historia->get_sucursal($id);
    $data['paciente_empleo'] = $this->historia->get_empleo($id);
    
    //informacion de clinica de BD 
    $data['familiar'] = $this->historia->familiar();
    $data['motivo_consulta'] = $this->historia->get_motivo_consulta();
    $data['sucursales'] = $this->sucursal->getAll();
        
    $data['autoinmune'] = $this->historia->enf_autoinmune();
    $data['enfermedades'] = $this->historia->enfCong();
    $data['infectos'] = $this->historia->infecto();
    $data['infectos_bac'] = $this->historia->infecto_bac();
    $data['infectos_hongos'] = $this->historia->infecto_hongos();
    $data['infectos_parasitos'] = $this->historia->infecto_parasitos();
    $data['infectos_psico'] = $this->historia->infecto_psico();
    $data['infectos_otras'] = $this->historia->infecto_otras();
    $data['terapias'] = $this->historia->terapias();
    /* $data['medicamentos'] = $this->historia->medicamento(); */
    $data['estres'] = $this->historia->estres();
    $data['obesidad'] = $this->historia->obesidad();
    $data['vacunas'] = $this->historia->vacunas();
    $data['alergenos'] = $this->historia->alergeno();
    $data['tratamiento'] = $this->historia->tratamiento();
    $data['productos_ven'] = $this->historia->productos_ven();
        
    //informacion del paciente desde BD 
    $data['historial'] = $this->historia->historial($id);
    $data['notas'] = $this->historia->get_notas($id);
    $data['productos_ven'] = $this->historia->get_productos_ven();
    $data['diagnosticos'] = $this->historia->get_diagnostico($id);
    $data['linea_vida'] = $this->historia->linea_vida($id);
    $data['carga_heredo'] = $this->historia->carga_heredo($id);
    $data['ante'] = $this->historia->ante($id);
        
    //mensajes
    $data['conversacion'] = $this->mensajes->conversacion($id);
    $data['gconversacion'] = $this->mensajes->get_conversacion($id);
   
        //info de hospitalizaciones
    $data['anestesias'] = $this->historia->anestesia();
    $data['causas'] = $this->historia->causa();
    $data['operaciones'] = $this->historia->operacion();
    $data['protesiss'] = $this->historia->protesis();
    $data['transfusiones'] = $this->historia->transfusion();
    
  
    $data['view_controller'] = array(
        9 => 'pacients/quiz_vs.js',
        8 => 'pacients/data_historia_vs.js',
        7 => 'pacients/historia_start_vs.js',
        6 => 'messenger_vs.js',
        5 => 'pacients/tera_medi_vs.js',
        4 => 'pacients/npatologicos_vs.js',
        3 => 'pacients/patologicos_vs.js',
        2 => 'pacients/heredo_vs.js',
        1 => 'pacients_vs.js',
        );
    $data['view_style'] = 'linea.css';
    
    $this->load->view('layout/head', $data);
    $this->load->view('layout/header');
    $type = $this->session->type;
    if($type == "Administrador" || $type == "Medico Administrador"|| $type == "Medico" ){
             $this->load->view('pacients/historia', $data);
    }else{
      $this->load->view('auth/error'); 
    }    
    $this->load->view('layout/scripts', $data);
    }
    
    public function api_find_paciente($exp){
        $tok = $_GET["token"];
        $exp =  $exp;
        $this->db->select("t.token");
        $this->db->where("t.id",1);
        $this->db->from("tokens t");
        $token = $this->db->get("tokens")->row()->token;
        if($token == $tok){
            $this->db->select('p.id,p.clave_bancaria,p.nombre,p.apellido_p,p.apellido_m');
            $this->db->from('pacientes p');
            $this->db->where('p.clave_bancaria', $exp);
            $result = $this->db->get();
            $row = $result->result();
            $response = array();
            $response['data'] = $result->result_array();
            echo json_encode($response);
        }else{
            $response['fallo'] = "El token de acceso es incorrecto";
             echo json_encode($response);
        }
		
    }
    
    public function api_find_datapersonal(){
        $tok = $_GET["token"];
        $id = $_GET["id"];
        $this->db->select("t.token");
        $this->db->where("t.id",1);
        $this->db->from("tokens t");
        $token = $this->db->get("tokens")->row()->token;
        if($token == $tok){
            $this->db->select('p.id,p.nombre,p.apellido_p,p.apellido_m,p.email,p.fecha_nacimiento,p.sexo,p.estado_civil,p.municipio,p.estado,p.pais,p.motivo_consulta');
            $this->db->from('pacientes p');
            $this->db->where('p.id', $id);
            $result = $this->db->get();
            $row = $result->result();
            $response = array();
            $response['data'] = $result->result_array();
            echo json_encode($response);
        }else{
            $response['fallo'] = "El token de acceso es incorrecto";
             echo json_encode($response);
        }
		
    }
    
    public function api_find_datapedidos(){
        $tok = $_GET["token"];
        $id = $_GET["id"];
        $this->db->select("t.token");
        $this->db->where("t.id",1);
        $this->db->from("tokens t");
        $token = $this->db->get("tokens")->row()->token;
        if($token == $tok){
            $this->db->where('paciente_id', $id);
            $n_p = $this->db->count_all_results('pedidos');
            $this->db->where('id_paciente', $id);
            $h_h = $this->db->count_all_results('hisclinic_historial');
            $this->db->where('paciente_id', $id);
            $h_n = $this->db->count_all_results('hisclinic_notas');
            $this->db->where('id_paciente', $id);
            $h_d = $this->db->count_all_results('hisclinic_diagnostico');
            $this->db->where('id_paciente', $id);
            $h_l = $this->db->count_all_results('hisclinic_linea');
            $this->db->where('id_paciente', $id);
            $h_e = $this->db->count_all_results('hisclinic_estudio');
            $this->db->where('paciente_id', $id);
            $this->db->select('p.restante');
            $h_p = $this->db->get('pedidos p')->row()->restante;

            $data = array(
                 'n_p' => $n_p,
                 'h_h' => $h_h,
                 'h_n' => $h_n,
                 'h_d' => $h_d,
                 'h_l' => $h_l,
                 'h_e' => $h_e,
                 'h_p' => $h_p
                );
            echo json_encode($data);
        }else{
            $response['fallo'] = "El token de acceso es incorrecto";
             echo json_encode($response);
        }
		
    }
    
    public function api_find_dataestadisticas(){
        $tok = $_GET["token"];
        $id = $_GET["id"];
        $this->db->select("t.token");
        $this->db->where("t.id",1);
        $this->db->from("tokens t");
        $token = $this->db->get("tokens")->row()->token;
        if($token == $tok){
            $this->db->where('status', 1);
            $e_p = $this->db->count_all_results('pacientes');
            $this->db->where("sexo","Masculino");
            $hombres = $this->db->count_all_results('pacientes');
            $this->db->where("sexo","Femenino");
            $mujeres = $this->db->count_all_results('pacientes');
            $this->db->where("created_at <=","2021-01-31");
            $this->db->where("created_at >=","2021-01-01");
            $ene = $this->db->count_all_results('pacientes');
            $citas = $this->db->count_all_results('hisclinic_historial');
            $pedidos = $this->db->count_all_results('pedidos');
            $almacen = $this->db->count_all_results('almacen');
            $productos = $this->db->count_all_results('productos');

            $data = array(
                 'e_p' => $e_p,
                 'hombres' => $hombres,
                 'mujeres' => $mujeres,
                 'mes' => $ene,
                 'citas' => $citas,
                 'pedidos' => $pedidos,
                 'almacen' => $almacen,
                 'productos' => $productos
                );
            echo json_encode($data);
        }else{
            $response['fallo'] = "El token de acceso es incorrecto";
             echo json_encode($response);
        }
		
    }
    
    public function api_find_datanotas($id){
        $tok = $_GET["token"];
       $id =  $id;
        $this->db->select("t.token");
        $this->db->where("t.id",1);
        $this->db->from("tokens t");
        $token = $this->db->get("tokens")->row()->token;
        if($token == $tok){
            $this->db->select('n.id, n.nota,n.created_at');
            $this->db->from('hisclinic_notas n');
            $this->db->where('n.paciente_id', $id);
            $result = $this->db->get();
            $row = $result->result();
            $response = array();
            $response['data'] = $result->result_array();
            echo json_encode($response);
        }else{
            $response['fallo'] = "El token de acceso es incorrecto";
             echo json_encode($response);
        }
		
    }
    
    public function api_find_datacitas($id){
        $tok = $_GET["token"];
       $id =  $id;
        $this->db->select("t.token");
        $this->db->where("t.id",1);
        $this->db->from("tokens t");
        $token = $this->db->get("tokens")->row()->token;
        if($token == $tok){
            $this->db->select('c.id, c.motivo,c.created_at');
            $this->db->from('hisclinic_historial c');
            $this->db->where('c.id_paciente', $id);
            $result = $this->db->get();
            $row = $result->result();
            $response = array();
            $response['data'] = $result->result_array();
            echo json_encode($response);
        }else{
            $response['fallo'] = "El token de acceso es incorrecto";
             echo json_encode($response);
        }
		
    }
  
    public function api_find_datalinea($id){
        $tok = $_GET["token"];
        $id =  $id;
        $this->db->select("t.token");
        $this->db->where("t.id",1);
        $this->db->from("tokens t");
        $token = $this->db->get("tokens")->row()->token;
        if($token == $tok){
            $this->db->select('l.edad_paciente,l.enfermedad,l.anio,l.descripcion,l.created_at');
            $this->db->from('hisclinic_linea l');
            $this->db->where('l.id_paciente', $id);
            $this->db->order_by('l.anio', 'ASC');
            $result = $this->db->get();
            $row = $result->result();
            $response = array();
            $response['data'] = $result->result_array();
            echo json_encode($response);
        }else{
            $response['fallo'] = "El token de acceso es incorrecto";
             echo json_encode($response);
        }
		
    }
    
    public function insert_suc(){
        $data = array(
            'paciente_id' => $_POST["id_paciente"],
            'sucursal_id' => $_POST["suc_paciente"]
        );
        
        if($this->db->insert("sucursal_pacientes",$data)){
            echo true;
        }else{
            echo false;
        }
    }

    

    public function get_status_consulta(){
        $id_user = $this->session->id;

        $this->db->select('termino,id');
        $this->db->from('consultas');
        $this->db->where('id_paciente', $_POST['id_paciente']);
        $this->db->where('id_user', $id_user);
        $this->db->where('termino', 0);
        $result = $this->db->get()->row();

        echo json_encode($result);
    }

    public function get_status_consultas(){
        $id_user = $this->session->id;

        $this->db->select('termino,id,id_paciente');
        $this->db->from('consultas');
        $this->db->where('id_user', $id_user);
        $this->db->where('termino', 0);
        $result = $this->db->get()->result();

        echo json_encode($result);
    }

    public function stop_consulta(){
        
        $id_user = $this->session->id;
        $hoy = date("Y-m-d H:i:s");
        $data = array(
            'fecha_termino' => $hoy,
            'termino' => 1
        );
        

        $this->db->where('id_paciente', $_POST['id_paciente']);
        $this->db->where('id_user', $id_user);
        $this->db->where('termino', 0);
        $this->db->where('id', $_POST['id_consulta']);

        if($this->db->update("consultas",$data)){
            echo json_encode(array('error'=> false));
        }else{
            echo json_encode(array('error'=> true));
            
        }
    }
    
    
    public function charts($id) {

        session_redirect();

        $data['title'] = 'Gráficas Paciente';
        $data['paciente'] = $this->historia->find($id);
        $data['charts'] = $this->historia->find_charts($id);
        $data['view_controller'] = 'charts_vs.js';
         $data['view'] = 'chart.min.js';
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
         $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador"|| $type == "Medico" ){
             $this->load->view('pacients/charts', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
    }
    
    public function new_chart(){
        $data = array(
            'id_paciente' => $_POST['id_paciente'],
            'titulo' => $_POST['titulo'],
            'max' => $_POST['max'],
            'min' => $_POST['min'],
            'descripcion' => $_POST['descripcion']
        );
        
        if($this->db->insert("charts",$data)){
            
            echo json_encode($data);
        }else{
            echo false;
        }
        
    }
    
    public function delete_chart(){
        $data = array(
            'id_paciente' => $_POST['id_paciente'],
            'titulo' => $_POST['titulo'],
            'max' => $_POST['max'],
            'min' => $_POST['min'],
            'descripcion' => $_POST['descripcion']
        );
        
        $this->db->where("id",$_POST["id_chart"]);
        if($this->db->delete("charts")){
            
            echo json_encode(array('id' => "Grafica eliminada"));
        }else{
            echo false;
        }
        
    }
    
    public function new_chart_data(){
        
        $id_chart = $_POST['id_chart'];
        $id_paciente = $_POST['id_paciente'];
        
        $items1 = $_POST['valor'];
        $items2 = $_POST['fecha'];
        
         $size = count($_POST['valor'])-1;
         
        for ($i = 0; $i <= $size ; $i++) {
            
            $data = array(
            'id_chart' => $id_chart,
            'id_paciente' => $id_paciente,
            'valor' => $_POST['valor'][$i],
            'fecha' => $_POST['fecha'][$i]
        );
            
            if($this->db->insert("chart_data",$data)){
            
            echo json_encode($data);
                
            }else{
                echo false;
            }
        }
        
    }
    
    public function find_charts3($id){
        $this->db->where('id_paciente', $id);
        $this->db->select('id');
        $result = $this->db->get('charts');
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        echo json_encode($response);
    }
    
    public function find_charts2($id){
        $id_chart =  $this->uri->segment(5);
		$this->db->select('c.id,cd.id_chart,c.titulo,cd.fecha,cd.valor,c.max,c.min');
            $this->db->from('charts c');
            $this->db->where('c.id_paciente', $id);
            $this->db->where('cd.id_chart', $id_chart);
            $this->db->join('chart_data cd', 'cd.id_chart = c.id', 'inner');
            $this->db->order_by('cd.fecha', 'ASC');
            $result = $this->db->get();
            $row = $result->result();
            $response = array();
            $response['data'] = $result->result_array();
            echo json_encode($response);
    }
    
    public function inicia_consulta(){
        $id = $this->input->post('id_paciente');
        $sub = $this->input->post('sub');
        $estado = $this->input->post('estado');
        $clave = $this->input->post('clave_bancaria');
        
        if($sub == 0){
            if(isset($clave)){
            
            $clave_banc = $this->funciones->genera_clave($estado,$id, "P");
                
            $data_clave = array (
                'clave_bancaria' => $clave_banc,
                'seguim' => 1    
            );
                
            $data_cita = array (
            'id_paciente' => $id,
            'id_user' =>  $this->input->post('id_user'),
            'motivo' =>  "Primera vez"
            );
            
            $this->db->insert('hisclinic_historial',$data_cita);  
            
            }else{

                $data_clave = array (
                    'seguim' => 1    
                    );
            }
        }else{
            
            $motivo = $this->input->post('motivo')." " . $this->input->post('motivo_des');;
            
            $data_cita = array (
            'id_paciente' => $id,
            'id_user' =>  $this->input->post('id_user'),
            'motivo' =>  $motivo
            );
            
            $this->db->insert('hisclinic_historial',$data_cita);
            
            $subsecuente = $sub +1;
            $data_clave = array (
                    'seguim' => $subsecuente  
            );
        }
            $this->db->where('id', $id);
            $this->db->update('pacientes',$data_clave);
        
        echo json_encode($data_clave);
    }

    public function start_consulta(){
        $id_user = $this->session->id;

        $tipo = $_POST["tipo"];
        $estado = $_POST["estado"];
        $id_paciente = $_POST["id_paciente"];
        $clave = $_POST["clave_bancaria"];
        $motivo = $_POST["motivo"];
        
        if($tipo == "Primera Vez"){
            if(isset($clave)){
            $clave_banc = $this->funciones->genera_clave($estado,$id_paciente, "P");
                
            $data_clave = array (
                'clave_bancaria' => $clave_banc,
                'seguim' => 1    
            );
                
            $data_cita = array (
            'id_paciente' => $id_paciente,
            'id_user' =>  $id_user,
            'motivo' =>  "Primera vez"
            );
            
            $this->db->insert('hisclinic_historial',$data_cita);  
            
            }else{

                $data_clave = array (
                    'seguim' => 1    
                    );
            }
        }else{
            $data_cita = array (
            'id_paciente' => $id_paciente,
            'id_user' =>  $id_user,
            'motivo' =>  $motivo
            );
            $this->db->insert('hisclinic_historial',$data_cita);
            
            //TODO:sum seguim
            $this->db->where('id', $id_paciente);
            $seguim = $this->db->get('pacientes')->row()->seguim;
            $data_clave = array (
                'seguim' => $seguim + 1  
            );
        }
            $this->db->where('id', $id_paciente);
            $this->db->update('pacientes',$data_clave);

        //New
        $data = array(
            'id_paciente' => $id_paciente,
            'motivo' => $motivo,
            'tipo' => $tipo,
            'id_user' => $id_user,
            'termino' => 0
        );

        if($this->db->insert("consultas",$data)){
            $id_c = $this->db->insert_id();

            $data_motivo = array (
                'motivo_consulta' => $motivo   
                );
   
            $this->db->where('id', $id_paciente);
            $this->db->update('pacientes',$data_motivo);
            
            echo json_encode(array('id'=> $id_c));
        }else{
            echo false;
        }
    }
    
    public function generar_cita(){
        $id_cal = $this->input->post('id_calendario');
            $nombre = $this->input->post('title_cita');
            $fecha = $this->input->post('fecha_cita');
            $tipo = "Subsecuente";    
            $cita = $this->funciones->agregar_calendario($id_cal,$nombre,$fecha,$tipo);
                
            
            if($cita == "Ya"){
                echo json_encode(array('error' => true));
            }else{
                echo json_encode(array('error' => false));
            }
    }
    
    public function ver_estudio($id){
    session_redirect();

        $data = array();
        $data['title'] = 'Estudios';
        $data['paciente'] = $this->historia->find($id);
    
        // $data['view_style'] = 'pacients.css';
        $data['view_controller'] = 'pacients_vs.js';

        $data['estudios'] = $this->historia->estudios($id);  
          
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
          if($type == "Administrador" || $type == "Medico Administrador" || $type == "Medico" ){
            $this->load->view('pacients/estudios');
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
    }
    
    public function adeudos($id){
    session_redirect();

        $data = array();
        $data['title'] = 'Adeudos';
        $data['paciente'] = $this->historia->find($id);
        $data['view_controller'] = 'historia_vs.js';

        $data['pedidos'] = $this->historia->pedidos($id);  
          
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
          if($type == "Administrador" || $type == "Medico Administrador" || $type == "Medico" || $type ==  "Atención a Clientes" ){
            $this->load->view('pacients/adeudos');
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
    } 
    
    public function resumen($id){
    session_redirect();

        $data = array();
        $data['title'] = 'Resumen';
        $data['paciente'] = $this->historia->find($id);
        $data['view_controller'] = 'pacients/resumen_vs.js';
        
        $data['carga_heredo'] = $this->historia->carga_heredo($id);
        $data['hisclinic_app1'] = $this->historia->hisclinic_app1($id);
        $data['inmunizacion'] = $this->historia->inmunizacion($id);
        $data['alergias'] = $this->historia->alergias($id);
        $data['hospitalizacion'] = $this->historia->hospitalizacion($id);
        
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
          if($type == "Administrador" || $type == "Medico Administrador" || $type == "Medico" ){
            $this->load->view('pacients/resumen');
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
    }
    
    public function insert_abono(){
        
        $id_p = $_POST["id_order"];
        $abono = $_POST["in-abono"];
        
        $this->db->where("id",$id_p);
        $query = $this->db->get("pedidos");
        $row = $query->row();
        
        if($row->restante >= $abono ){
            
            if($row->restante == $abono){
                $estatus = "Pagado";
            }else{
                $estatus = "Pendiente";
            }
            
                $data = array(
                'id_pedido' => $id_p,
                'id_user' => $this->session->id,
                'id_paciente' => $_POST["id_paciente"],
                'abono' => $abono
            );
        

            if($this->db->insert("pedidos_abono",$data)){

                $this->db->set("restante", "restante -". $abono,FALSE );
                $this->db->set("pagado", "pagado +". $abono,FALSE);
                $this->db->set("status", $estatus );
                $this->db->where("id",$id_p);
                $this->db->update("pedidos");
                
                    if($row->primero == 1){
                        $des = "Comision por Abono";
                    $this->agent->pagar_com($_POST["id_paciente"],$id_p,$abono,$des); 
                }

                echo true;
                
            }else{
                echo false;
            }

            
            
        }else{
            echo false;
        }
        
    }
    
    public function getAll(){

        $response = null;

        switch ($this->session->userdata('type')) {

            case 'Administrador':
                
            $this->db->where('status', 1);
            $this->db->select('id,clave_bancaria,CONCAT(nombre," " , apellido_p, " ",apellido_m) AS nombre,email,telefono_a,estado,motivo_consulta,municipio'); 
            $this->db->from('pacientes');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get();
                
            $response = $query->result();
            break;
                
            case 'Medico Administrador':
                
            $this->db->where('status', 1);
            $this->db->select('id,clave_bancaria,CONCAT(nombre," " , apellido_p, " ",apellido_m) AS nombre,email,telefono_a,estado,motivo_consulta,municipio'); 
            $this->db->from('pacientes');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get();
                
            $response = $query->result();
            break;

            case 'Medico':
            $this->db->select('p.id,p.clave_bancaria,CONCAT(p.nombre," " , p.apellido_p, " ",p.apellido_m) AS nombre,p.email,p.telefono_a,p.estado,p.motivo_consulta,p.municipio');
            $this->db->from('pacientes p');
            $this->db->join('sucursal_pacientes sp', 'sp.paciente_id = p.id', 'inner');
            $this->db->where('sp.sucursal_id', $this->session->userdata('sucursal'));
            $this->db->where('status', 1);
            $result = $this->db->get();
            $response = $result->result();
            break;
            
            case 'Atención a Clientes':
                
            $this->db->where('status', 1);
            $this->db->select('id,clave_bancaria,CONCAT(nombre," " , apellido_p, " ",apellido_m) AS nombre,email,telefono_a,estado,motivo_consulta,municipio'); 
            $this->db->from('pacientes');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get();
                
            $response = $query->result();
            break;
        }
        
         $array["data"]=$response;
                
         echo json_encode($array);
    }

    //trae los datos de la vista       
    public function agregar_estudio() {
         
        $id = $this->input->post('id_paciente');
        $exp = $this->input->post('expediente');
        $estudio = 'estudio_sbr';
         
         
        $path = "assets/estudios/";
         
        if (!is_dir("assets/estudios/".$id)){
              mkdir("assets/estudios/". $id, 0777);
         }

         
        if (!empty($_FILES['estudio_sbr']['name'])) {
            
            $imagen = "E-" . $exp . "-" . $this->input->post('fecha_estudio').date("hs").".png";
            
            
             move_uploaded_file($_FILES['estudio_sbr']['tmp_name'],"assets/estudios/".$id."/".$imagen);
            
                    $data =  array(
                        'id_paciente' => $this->input->post('id_paciente'),
                        'titulo' => $this->input->post('title_estudio'),
                        'fecha' => $this->input->post('fecha_estudio'),
                        'imagen' =>  "" . $imagen
                        );

                    if($this->historia->agregar_estudio($data)){

                        echo json_encode(array('error' => false));
                        }
                        else{
                            echo json_encode(array('error' => true));
                        }
            
        }else{
            echo json_encode(array('error' => true,'type' => "Esta imagen es muy pesada"));
        }

    } 
    
    public function upload_estudio() {
        
         
        $id = $this->input->post('id_paciente');
        $exp = $this->input->post('expediente');
        $estudio = 'estudio_sbr';
         
        $path = "assets/estudios/";
         
        if (!is_dir("assets/estudios/".$id)){
              mkdir("assets/estudios/". $id, 0777);
         }

            //$imagen = "E-" . $exp . "-" .date("hs").".png";
            $archivo = $_FILES['file'];
            $imagen = $archivo['name'];
            
             move_uploaded_file($_FILES['file']['tmp_name'],"assets/estudios/".$id."/".$imagen);
            
            $data =  array(
                'id_paciente' => $this->input->post('id_paciente'),
                'titulo' => "Estudio",
                'fecha' => date("d-m-y"),
                'imagen' =>  "" . $imagen
                );

            if($this->historia->agregar_estudio($data)){

                echo json_encode(array('error' => false));
                }
                else{
                    echo json_encode(array('error' => true));
                }
    }
    
    public function estudio_movil(){
      
        $imagen = $_POST['foto'];
        $exp = $_POST['expediente'];
        $titulo = $_POST['titulo'];
        $fecha = $_POST['fecha'];
        $nombre_estudio = "E-". $exp . "-".$_POST['fecha'].date("hs").".png";
        $id = substr($exp, 2, 6);
        
        if (!is_dir("assets/estudios/".$id)){
              mkdir("assets/estudios/". $id, 0777);
         }
        $path = "assets/estudios/".$id."/".$nombre_estudio;
        
        file_put_contents($path, base64_decode($imagen));
        
        $data =  array(
            'id_paciente' => $id,
            'titulo' => $titulo,
            'fecha' => $_POST['fecha'],
            'imagen' =>  "" . $nombre_estudio
        );

            if($this->historia->agregar_estudio($data)){

            echo "Se subio el estudio correctamente";
            }
            else{
                echo "Error al subir estudio";
            }
        
    }
    
    public function foto_perfil_movil(){
      
        $imagen = $_POST['foto'];
        $exp = $_POST['exp'];
        $id = substr($exp, 2, 6);
        
        $exists = file_exists("assets/foto_paciente/Img-".$id.".png");
        
        if($exists){
            unlink("assets/foto_paciente/Img-".$id.".png");
        }else{
            
        }
        $path = "assets/foto_paciente/Img-".$id.".png";
        
        file_put_contents($path, base64_decode($imagen));
        $foto = "Img-".$id.".png";
            $data =  array(
                'foto' =>  "" . $foto
                );
        
            $this->db->where("id",$id);
            if($this->db->update("pacientes",$data)){

                echo "Foto del paciente actualizada";
                }
                else{
                    echo "Error al actualizar";
                }
        
    }
    
    //imagen de perfil del paciente
    public function agregar_foto() {
         
        $id = $this->input->post('id_paciente');
        $foto = 'foto_sbr';
         
         $path = "assets/foto_paciente/";
        
        $exists = file_exists("assets/foto_paciente/Img-".$id.".png");
        
        if($exists){
            unlink("assets/foto_paciente/Img-".$id.".png");
        }else{
            
        }
         
        if (!empty($_FILES['foto_sbr']['name'])) {
        
            
            move_uploaded_file($_FILES['foto_sbr']['tmp_name'],"assets/foto_paciente/Img-".$id.".png");
            
            $data =  array(
                'foto' =>  "Img-" . $id.".png"
                );
                $this->db->where("id",$id);
            if($this->db->update("pacientes",$data)){

                    echo json_encode(array('error' => false));
                    }
                    else{
                        echo json_encode(array('error' => true));
                    }
        }else{
            //$this->upload->display_errors();
            
            echo json_encode(array('error' => true));
        }

    }
    
    //Trae las notas de la vista para guardarlas
    public function notas_dr() {
      
        $data =  array(
        'paciente_id' => $this->input->post('id_paciente'),
        'nota' => $this->input->post('notas_input')
        );
          
        if($this->historia->notas_dr($data)){

            echo json_encode($data);
        }
            else{
                echo false;
            }
        
    }
    
    public function diagnostico_dr() {
      
        $anio =  $this->input->post('anio') + $this->input->post('edad_diag');
        
        $data =  array(
        'id_paciente' => $this->input->post('id_paciente'),
        'diagnostico' => $this->input->post('diagnostico_input')
        );
        
        $data_linea = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'enfermedad' => 'Diagnóstico',
        'edad_paciente' => $this->input->post('edad_diag'), 
        'table_hisclinic' => "Diagnóstico", //_diagnostico
        'descripcion' => $this->input->post('diagnostico_input'),
        'anio' => $anio
        );
          
            if($this->historia->diagnostico_dr($data, $data_linea)){
                echo json_encode($data);
            }
            else{
                echo false;
            }
        
    }
    
    //trae de la vista los antecedentes heredo familiares
    public function carga_heredo_in() {
        
        $data =  array(
        'id_paciente' => $this->input->post('id_paciente'),
        'enfermedad' => $this->input->post('padecimiento'), 
        'familiar' => $this->input->post('familiar_heredo') 
        );
    if($this->historia->carga_heredo_in($data)){
        
        echo json_encode($data);
    }
        else{
            echo false;
        }
        
    }
    
    public function ante_in() {
        
      
        $data =  array(
        'id_paciente' => $this->input->post('id_paciente'),
        'familiar' => $this->input->post('familiar_ante'), 
        'antecedente' => $this->input->post('antecedente-heredo'), 
        'descripcion' => $this->input->post('descripcion-ante')
        );
        
      
    if($this->historia->ante_in($data)){
        
        echo json_encode($data);
    }
        else{
            echo false;
        }
        
    }
    
     public function congenita() {
        
        $anio =  $this->input->post('anio') + $this->input->post('edad_cong');
        
        $descripcion = "Enfermedad Congénita - " . $this->input->post('manejo') ;
        
        $this->db->where('id',$_POST['enfermedad']);
        $this->db->where('tipo', "congenita");
        $query = $this->db->get('enfermedades');
        $enfermedad = $query->row()->enfermedad;
                    
        $data =  array(
        'id_paciente' => $this->input->post('id_paciente'),
        'enfermedad' => $enfermedad, 
        'manejo' => $this->input->post('manejo'),
        'medicamento' => $this->input->post('medicamento'),
        'edad' => $this->input->post('edad_cong')
        );
        
        $data_linea = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'id_dato' => $_POST['enfermedad'],
        'enfermedad' => $enfermedad, 
        'table_hisclinic' => "congenita",
        'edad_paciente' => $this->input->post('edad_cong'),
        'descripcion' => $descripcion, 
        'anio' => $anio
        );
        $res = $this->historia->congenita($data, $data_linea);
        if($res){
            echo json_encode($data);
        }
        else{
            echo $res;
        }
        
    }
    
    //trae de la vista las inminizaciones
    public function vacuna() {
        $anio =  $this->input->post('anio') + $this->input->post('edad');
        
        $descripcion = "Vacuna - " . $this->input->post('descripcion_vac');
        
        $this->db->where('id',$_POST['vacuna']);
        $query = $this->db->get('vacunas');
        $vacuna = $query->row()->vacuna; 
        
        $data =  array(
        'id_paciente' => $this->input->post('id_paciente'),
        'vacuna' => $vacuna, 
        'descripcion' => $this->input->post('descripcion_vac'), 
        'edad' => $this->input->post('edad')
        );
        
        $data_linea = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'id_dato' => $_POST["vacuna"],
        'enfermedad' => $vacuna,
        'edad_paciente' => $this->input->post('edad'), 
        'table_hisclinic' => "vacuna",
        'descripcion' => $descripcion,
        'anio' => $anio
        );
        $res = $this->historia->vacuna($data, $data_linea);
        
        if($res){
            echo json_encode($data);
        }
        else{
            echo $res;
        }
        
    }
    
    public function alergia() {
        
        $id_paciente = $this->input->post('id_paciente');
               
        $anio =  $this->input->post('anio') + $this->input->post('edad_alergia');
         
        if(isset($_POST['med_op'])){
             $alergeno = "Medicamento: ". $_POST['med_op'];
        }else{
           $alergeno = $this->input->post('alergeno');
        }
        
        $id_alergeno = $this->input->post('alergeno');
        
        $this->db->where("id",$id_alergeno);
        $alergia = $this->db->get("alergenos")->row()->alergeno;
        
        
        $descripcion = "Alergia - Tratamiento" . $_POST['tratamiento'];    
         
        $data =  array(
        'id_paciente' => $id_paciente,
        'alergeno' => $alergia,
        'id_alergeno' => $id_alergeno,
        'tratamiento' => $_POST['tratamiento'],
        'edad_alergia' => $_POST['edad_alergia']
        );
         
         $data_linea = array(
        'id_paciente' => $id_paciente,
        'id_dato' => $id_alergeno,
        'enfermedad' => $alergia,
        'table_hisclinic' => "alergenos", 
        'edad_paciente' => $_POST['edad_alergia'], 
        'descripcion' => $descripcion,
        'anio' => $anio
        );

        $res = $this->historia->alergia($data, $data_linea);
    
        if($res){
            echo json_encode($data);
        }
        else{
            echo $res;
        }
            
    }
    
    public function hospitalizaciones() {
        
        $anio =  $this->input->post('anio') + $this->input->post('edad_hospi');
        
        $descripcion = "Hospitalización - " . $this->input->post('manejo'); 
        
        $this->db->where("id",$_POST["causa"]);
        $causa = $this->db->get("hospi_causa")->row()->causa;
        
        $data =  array(
        'id_paciente' => $this->input->post('id_paciente'),
        'causa' => $causa, 
        'operacion' => $this->input->post('op'),
        'tipo_operacion' => $this->input->post('tipo_operacion'),
        'anestesia' => $this->input->post('ane'),
        'tipo_anestesia' => $this->input->post('tipo_anestesia'),
        'transfusion' => $this->input->post('tran'),
        'tipo_transfusion' => $this->input->post('tipo_transfusion'),
        'protesis' => $this->input->post('pro'),
        'tipo_protesis' => $this->input->post('tipo_protesis'),
        'complicacion' => $this->input->post('com'),
        'com_explicacion' => $this->input->post('com_explicacion'),
        'manejo' => $this->input->post('manejo'),
        'medicamentos' => $this->input->post('medicamentos'),
        'edad_hospi' => $this->input->post('edad_hospi')
        );
        
         $data_linea = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'id_dato' => $_POST["causa"],
        'enfermedad' => $causa,
        'table_hisclinic' => "hospitalizacion",//_hospitalizaciones
        'edad_paciente' => $this->input->post('edad_hospi'), 
        'descripcion' => $descripcion,
        'anio' => $anio
        );
        
    if($this->historia->hospitalizaciones($data, $data_linea)){
        
        echo json_encode($data);
    }
        else{
            echo false;
        } 
    }
   
    
    public function delete(){

        $id = $_POST["id"];

        $this->db->set('status', 0);
        $this->db->where('id', $id);

        if($this->db->update('pacientes')){
            echo true;
        }
        else{
            echo false;
        }
    }
    
    public function delete_hisclinic(){
        $data =  array(
        'id' => $_POST['id'],
        'table' => $_POST['table'],
        'fecha' => $_POST['fecha']
        );
        
        if($this->historia->delete_hisclinic($data)){
			echo true;
		}else{
			echo false;
		}
    }

    public function getUser($id){

        $this->db->where('id', $id);
        $query = $this->db->get('pacientes');
        $result = $query->row_array();
        return $result;
    }
    
    public function checkVen(){
        $bebida = $_POST["bebidas"];

        $this->db->select('nombre_p');
        $this->db->from('productos_ven');
        $this->db->where('categoria', $bebida);
        $query = $this->db->get();
        $row = $query->row();

        if (isset($row))
        {
            echo json_encode(false);
        }
        else{
            echo json_encode(true);
        }
    }
    
    public function newEntry() {
         
        $status = 1;
        $ref = $this->input->post('referido');
        $am = "A";
         if(!isset($_POST['apellido_m'])){
             $am = substr($_POST['apellido_m'],0,1);
         }
       
        $pass = "P-".substr($_POST['apellido_p'],0,2).$am.substr($_POST['nombre'],0,1).date("d");
         
         //Se busca el id del motivo para el paciente
        $this->db->where("id",$this->input->post('ocupacion'));
        $ocupacion = $this->db->get("empleos")->row()->name;
         
        $data =  array(
            
        'nombre' => $this->input->post('nombre'),
        'apellido_p' => $this->input->post('apellido_p'),
        'apellido_m' => $this->input->post('apellido_m'),
        'email' => $this->input->post('email'),
        'password' => $pass,
        /* 'motivo_consulta' => $motivo, */
        'sexo' => $this->input->post('sexo'),
        'estado_civil' => $this->input->post('estado_civil'),
        'municipio_origen' => $this->input->post('municipio_origen'),
        'estado_origen' => $this->input->post('estado_origen'),
        'pais_origen' => $this->input->post('pais_origen'),
        'municipio' => $this->input->post('municipio'),
        'estado' => $this->input->post('estado'),
        'pais' => $this->input->post('pais'),
        'calle' => $this->input->post('calle'),
        'colonia' => $this->input->post('colonia'),
        'cp' => $this->input->post('cp'),
        'rfc' => $this->input->post('rfc'),
        'curp' => $this->input->post('curp'),
        'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
        'telefono_a' => $this->input->post('telefono_a'),
        'telefono_b' => $this->input->post('telefono_b'),
        'religion' => $this->input->post('religion'),
        'ocupacion' => $this->input->post('ocupacion'),
        'status' => $status,
        'seguim' => 0,  
        'hr_llamarle' => $this->input->post('hr_llamarle')
        );
         
        if($this->db->insert('pacientes', $data)){
           $id_paciente = $this->db->insert_id();

            //Referencia de sucursal
          $dataOffice = array(
            'sucursal_id' => $_POST["sucursal"],
            'paciente_id' => $id_paciente
            );  

            $this->db->insert('sucursal_pacientes',$dataOffice);

            if($ref == "Clinica" || $ref == "Social" || $ref == "Paciente"){
                if($ref == "Clinica"){
                    $type = "Clinica";
                }else if ($ref == "Social"){
                    $type ="Social";
                }else{
                    $type = "Paciente";
                }

                $dataAgent = array(
                'id_sucursal' => $_POST['agent'],
                'id_paciente' => $id_paciente,
                'type' => $type
                );
                //se inserta comision para un usuario
                $this->db->insert('sucursal_paciente_com',$dataAgent);


            }else if ($ref == "Representante"){
                $dataAgent = array(
                'id_agent' => $_POST['agent'],
                'id_paciente' => $id_paciente
                );
                //se inserta comision para un usuario
                $this->db->insert('agent_paciente',$dataAgent);

            }else if ($ref == "Usuario"){
                 //Referencia de usuario
                $dataAgent = array(
                'id_user' => $_POST['agent'],
                'id_paciente' => $id_paciente
                );
                //se inserta comision para un usuario
                $this->db->insert('user_paciente',$dataAgent);
            }

            $clave_banc = $this->funciones->genera_clave($data['estado'],$id_paciente, "P");

            $data_clave = array (
            'clave_bancaria' => $clave_banc
            );

            $data['id_paciente'] = $id_paciente;

            $this->db->where('id', $id_paciente);
            $this->db->update('pacientes',$data_clave);


            /* //Se inserta el motivo
             $dataMotivo = array(
                'id_paciente' => $id_paciente,
                 'id_motivo' => $this->input->post('motivo')
             );
             $this->db->insert("hisclinic_motivo",$dataMotivo); */

             echo json_encode($data);
            }
        else{
            echo false;
        }
    }
    
    public function updateEntry() {
         
         $id = $this->input->post('id_paciente');
        $data =  array(
        'nombre' => $this->input->post('nombre'),
        'apellido_p' => $this->input->post('apellido_p'),
        'apellido_m' => $this->input->post('apellido_m'),
        'sexo' => $this->input->post('sexo'),
        'email' => $this->input->post('email'),
        'municipio_origen' => $this->input->post('municipio_origen'),
        'estado_origen' => $this->input->post('estado_origen'),
        'pais_origen' => $this->input->post('pais_origen'),
        'municipio' => $this->input->post('municipio'),
        'estado' => $this->input->post('estado'),
        'pais' => $this->input->post('pais'),
        'calle' => $this->input->post('calle'),
        'colonia' => $this->input->post('colonia'),
        'cp' => $this->input->post('cp'),
        'rfc' => $this->input->post('rfc'),
        'curp' => $this->input->post('curp'),
        'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
        'telefono_a' => $this->input->post('telefono_a'),
        'telefono_b' => $this->input->post('telefono_b'),
        'religion' => $this->input->post('religion'),
        'ocupacion' => $this->input->post('ocupacion')
        );

        $this->db->where('paciente_id', $id);
        $dataEmpleo =  array(
            'paciente_id' => $id,
            'empleo_id' => $this->input->post('ocupacion'),
            );
        $res = $this->db->count_all_results('hisclinic_empleo');
        if($res == 0){
            $this->db->insert('hisclinic_empleo', $dataEmpleo);
        }else{
            $this->db->where('paciente_id', $id);
            $this->db->update("hisclinic_empleo",$dataEmpleo);
        }

        
        $this->db->where('id', $id);
        if($this->db->update('pacientes',$data)){
			echo json_encode($data);
		}else{
			echo false;
		}
    }
    
    public function save_hisclinic_vp(){
    
        if($_POST['clasificacion'] == "B"){
            $clasi = "Bebidas";
        }
        else if ($_POST['clasificacion'] == "DA"){
            $clasi = "Derivados Animales";
        }
        else if ($_POST['clasificacion'] == "FV"){
            $clasi = "Frutas y Vegetales";
        }
        else if ($_POST['clasificacion'] == "A"){
            $clasi = "Aditivos";
        }
        else if ($_POST['clasificacion'] == "E"){
            $clasi = "Enlatados";
        }
        
        
        $anio =  $this->input->post('anio') + $this->input->post('edad_vp');
        
        $descripcion = "Veneno Propiamente Dicho - ".$clasi." - " . $this->input->post('nombre_v') ;
        
        $data = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'edad_vp' => $this->input->post('edad_vp'),
        'clasificacion' => $clasi,    
        'nombre_v' => $this->input->post('nombre_v') 
        ); 
        
        $data_linea = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'enfermedad' => $this->input->post('nombre_v'), 
        'table_hisclinic' => $clasi, //_app1
        'edad_paciente' => $this->input->post('edad_vp'),
        'descripcion' => $descripcion, 
        'anio' => $anio
        );
        
        
        if($this->historia->save_hisclinic_vp($data, $data_linea)){
        
        echo json_encode($data);
    }
        else{
            echo "";
        }
        
    }
    
    public function save_hisclinic_vm(){
        if($_POST['clasificacion'] == "M"){
            $clasi = "Microbianos";
        }else{
            $clasi = "No Microbianos";
        }
        $subclasi = $_POST['subclas'];
        
        $anio =  $this->input->post('anio') + $this->input->post('edad_vm');
        
        $descripcion = "Microbios - ".$clasi." - ".$subclasi." - " . $this->input->post('nombre_v') ;
        
        $data = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'edad_vm' => $this->input->post('edad_vm'),
        'clasificacion' => $clasi,    
        'subclas' => $subclasi,    
        'nombre_v' => $this->input->post('nombre_v') 
        ); 
        
        $data_linea = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'enfermedad' => $this->input->post('nombre_v'), 
        'table_hisclinic' => $clasi, 
        'edad_paciente' => $this->input->post('edad_vm'),
        'descripcion' => $descripcion, 
        'anio' => $anio
        );
        
        
        if($this->historia->save_hisclinic_vm($data, $data_linea)){
        
                echo json_encode($data);
            }
        else{
            echo "";
        }
        
    } 
    
    public function save_hisclinic_vr(){
        if($_POST['clasificacion'] == "I"){
            $clasi = "Ionizantes";
        }else{
            $clasi = "No Ionizantes";
        }
        $subclasi = $_POST['subclas'];
        
        $anio =  $this->input->post('anio') + $this->input->post('edad_vr');
        
        $descripcion = "Radiaciones - ".$clasi." - ".$subclasi." - " . $this->input->post('nombre_v') ;
        
        $data = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'edad_vr' => $this->input->post('edad_vr'),
        'clasificacion' => $clasi,    
        'subclas' => $subclasi,    
        'nombre_v' => $this->input->post('nombre_v') 
        ); 
        
        $data_linea = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'enfermedad' => $this->input->post('nombre_v'), 
        'table_hisclinic' => $clasi, 
        'edad_paciente' => $this->input->post('edad_vr'),
        'descripcion' => $descripcion, 
        'anio' => $anio
        );
        
        
        if($this->historia->save_hisclinic_vr($data, $data_linea)){
        
        echo json_encode($data);
    }
        else{
            echo "";
        }
        
    }
    
    public function save_hisclinic_vmp(){
        if($_POST['clasificacion'] == "MP"){
            $clasi = "Metales Pesados";
        }
        
        $anio =  $this->input->post('anio') + $this->input->post('edad_vmp');
        
        $descripcion = "Metales Pesados - ".$clasi." - " . $this->input->post('nombre_v') ;
        
        $data = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'edad_vmp' => $this->input->post('edad_vmp'),
        'clasificacion' => $clasi,
        'nombre_v' => $this->input->post('nombre_v') 
        ); 
        
        $data_linea = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'enfermedad' => $this->input->post('nombre_v'), 
        'table_hisclinic' => $clasi, 
        'edad_paciente' => $this->input->post('edad_vmp'),
        'descripcion' => $descripcion, 
        'anio' => $anio
        );
        
        
        if($this->historia->save_hisclinic_vmp($data, $data_linea)){
        
        echo json_encode($data);
             }
        else{
            echo "";
        }
        
    }
    
    public function save_hisclinic_medi(){
        $anio =  $this->input->post('anio') + $this->input->post('edad_medica');

        if(!empty($_POST['p_medicamento'])){
            $medi_id = $_POST['p_medicamento'];
        }else{
            $medi_id = $_POST['p_medicamento2'];

        }
         
        $this->db->where("id",$medi_id);
        $query = $this->db->get("medicamentos");
        $medicamento = $query->row()->medicamento; 
        
        $descripcion = "Medicamento - " . $medicamento;
        
        $data = array(
            'id_paciente' => $this->input->post('id_paciente'),
            'id_medi' => $medi_id,
            'medi' => $medicamento,
            'edad_medi' => $this->input->post('edad_medica') 
        ); 
        
        $data_linea = array(
            'id_paciente' => $this->input->post('id_paciente'),
            'id_dato' => $medi_id,
            'enfermedad' => $medicamento, 
            'table_hisclinic' => "medicamentos", 
            'edad_paciente' => $this->input->post('edad_medica'),
            'descripcion' => $descripcion, 
            'anio' => $anio
        );
        
        if($this->db->insert("hisclinic_medi", $data)){
        $this->db->insert("hisclinic_linea", $data_linea);
        echo json_encode($data);
             }
        else{
            echo "";
        }
    } 

    public function save_hisclinic_estres(){
        $anio =  $this->input->post('anio') + $this->input->post('edad_estres');
         
        $this->db->where("id",$this->input->post('s_estres'));
        $query = $this->db->get("estres");
        $estres = $query->row()->estres; 
        
        $descripcion = "Nivel de Estrés: " . $estres;
        
        $data = array(
            'id_paciente' => $this->input->post('id_paciente'),
            'id_estres' => $this->input->post('s_estres'),
            'estres' => $estres,
            'edad_estres' => $this->input->post('edad_estres') 
        ); 
        
        $data_linea = array(
            'id_paciente' => $this->input->post('id_paciente'),
            'id_dato' => $this->input->post('s_estres'),
            'enfermedad' => $estres, 
            'table_hisclinic' => "estres", 
            'edad_paciente' => $this->input->post('edad_estres'),
            'descripcion' => $descripcion, 
            'anio' => $anio
        );
        
        if($this->db->insert("hisclinic_estres", $data)){
        $this->db->insert("hisclinic_linea", $data_linea);
        echo json_encode($data);
             }
        else{
            echo "";
        }
    }

    public function save_hisclinic_obe(){
        $anio =  $this->input->post('anio') + $this->input->post('edad_obesidad');
         
        $this->db->where("id",$this->input->post('s_obesidad'));
        $query = $this->db->get("obesidad");
        $obesidad = $query->row()->obesidad; 
        
        $descripcion = "Obesidad: " . $obesidad;
        
        $data = array(
            'id_paciente' => $this->input->post('id_paciente'),
            'id_obesidad' => $this->input->post('s_obesidad'),
            'obesidad' => $obesidad,
            'edad_obesidad' => $this->input->post('edad_obesidad') 
        ); 
        
        $data_linea = array(
            'id_paciente' => $this->input->post('id_paciente'),
            'id_dato' => $this->input->post('s_obesidad'),
            'enfermedad' => $obesidad, 
            'table_hisclinic' => "obesidad", 
            'edad_paciente' => $this->input->post('edad_obesidad'),
            'descripcion' => $descripcion, 
            'anio' => $anio
        );
        
        if($this->db->insert("hisclinic_obesidad", $data)){
        $this->db->insert("hisclinic_linea", $data_linea);
        echo json_encode($data);
             }
        else{
            echo "";
        }
    }

    public function save_hisclinic_signos(){
       $obesidad = "";
       $imc = $this->input->post('imc');

        if ($imc < 18.5) {
            $obesidad = "Bajo Peso";
    
        } else if ($imc >= 18.5 && $imc <= 24.9) {
            $obesidad = "Normal";
    
        } else if ($imc >= 25.0 && $imc <= 29.9) {
            $obesidad = "Sobre Peso";
    
        } else if ($imc > 30) {
            $obesidad = "Obesidad";
        }

        $anio =  $this->input->post('anio') + $this->input->post('edad_signo');

        $this->db->where("obesidad",$obesidad);
        $query = $this->db->get("obesidad");
        $obesidad_id = $query->row()->id; 

        $descripcion = "Altura: " . $this->input->post('altura'). '<br>Peso: '.$this->input->post('peso') . '<br>IMC: ' .$this->input->post('imc') .'<br>Presion: '.$this->input->post('presion').'<br>Pulso: '.$this->input->post('pulso'). '<br>Temp:'.$this->input->post('temperatura') . '<br>';


        $data = array(
            'paciente_id' => $this->input->post('id_paciente'),
            'edad_signos' => $this->input->post('edad_signo'), 
            'altura' => $this->input->post('altura'), 
            'peso' => $this->input->post('peso'), 
            'imc' => $this->input->post('imc'), 
            'presion' => $this->input->post('presion_arterial'), 
            'pulso' => $this->input->post('pulso'), 
            'temperatura' => $this->input->post('temperatura')
        ); 
        
        $data_linea = array(
            'id_paciente' => $this->input->post('id_paciente'),
            'id_dato' => '0000',
            'enfermedad' => 'Signos Vitales', 
            'table_hisclinic' => "signos", 
            'edad_paciente' => $this->input->post('edad_signo'),
            'descripcion' => $descripcion, 
            'anio' => $anio
        );
        
        $descripcion_obe = "Obesidad: " . $obesidad;

        $data_obe = array(
            'id_paciente' => $this->input->post('id_paciente'),
            'id_obesidad' => $obesidad_id,
            'obesidad' => $obesidad,
            'edad_obesidad' => $this->input->post('edad_signo') 
        ); 
        
        $data_linea_obe = array(
            'id_paciente' => $this->input->post('id_paciente'),
            'id_dato' => $obesidad_id,
            'enfermedad' => $obesidad, 
            'table_hisclinic' => "obesidad", 
            'edad_paciente' => $this->input->post('edad_signo'),
            'descripcion' => $descripcion_obe, 
            'anio' => $anio
        );
        
        if($this->db->insert("hisclinic_obesidad", $data_obe)){
            $this->db->insert("hisclinic_linea", $data_linea_obe);
            $this->db->insert("hisclinic_linea", $data_linea);
            $this->db->insert("hisclinic_signos", $data);
            echo json_encode($data);
             }
        else{
            echo "";
        }
    }
    
    public function save_hisclinic_terapia(){
        $anio =  $this->input->post('anio') + $this->input->post('edad_terapia');
         
        $this->db->where("id",$this->input->post('terapia'));
        $query = $this->db->get("terapias");
        $terapia = $query->row()->terapia; 
        
        $descripcion = "Terapia - " . $terapia;
        
        $data = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'id_terapia' => $this->input->post('terapia'),
        'terapia' => $terapia,
        'edad_terapia' => $this->input->post('edad_terapia') 
        ); 
        
        $data_linea = array(
        'id_paciente' => $this->input->post('id_paciente'),
        'id_dato' => $this->input->post('terapia'),
        'enfermedad' => $terapia,
        'table_hisclinic' => "terapia", 
        'edad_paciente' => $this->input->post('edad_terapia'),
        'descripcion' => $descripcion, 
        'anio' => $anio
        );
        
        
        if($this->historia->save_terapia($data, $data_linea)){
        
        echo json_encode($data);
             }
        else{
            echo "";
        }
        
    }

    public function save_evolucion(){
        $anio =  $this->input->post('anio') + $this->input->post('edad_medica');
        
        $data = array(
            'paciente_id' => $this->input->post('id_paciente'),
            'linea_id' => $this->input->post('id_linea'),
            'evolucion' => $this->input->post('evolucion'),
            'fecha_evolucion' => $this->input->post('fecha_evolucion'),
            'edad' => $this->input->post('edad_evol')
        ); 
        
        if($this->db->insert("hisclinic_evolucion", $data)){
            echo json_encode($data);
             }
        else{
            echo "";
        }
    } 

    public function save_curacion(){
        $data = array(
            'curacion' => $_POST['curacion']
        );
        
        $this->db->where('id', $_POST['id_linea']);

        if($this->db->update("hisclinic_linea",$data)){
            echo json_encode(array('error'=> false));
        }else{
            echo json_encode(array('error'=> true));
            
        }
    }  

    public function save_envene(){
        $data = array(
            'envene' => $_POST['envene']
        );
        
        $this->db->where('id', $_POST['id_linea']);

        if($this->db->update("hisclinic_linea",$data)){
            echo json_encode(array('error'=> false));
        }else{
            echo json_encode(array('error'=> true));
            
        }
    }  
 
    public function addSet(){
        $id_dato = $this->input->post('input_id');
        $dato = $this->input->post('dato');
        
        switch($id_dato){
            case 1 :
                $this->settings->add_motivo_consulta($dato);
                break;
            case 2 :
                $this->settings->add_enf_cong($dato);
                break;
            case 3 :
                $this->settings->add_medicamento($dato);
                break;
            case 4 :
                $this->settings->add_vacuna($dato);
                break;
            case 5 :
                $this->settings->add_alergia($dato);
                break;
            case 6 :
                $this->settings->add_trat_alergia($dato);
                break;
            case 7 :
                $this->settings->add_hospi_causa($dato);
                break;
            case 8 :
                $this->settings->add_hospi_operacion($dato);
                break;
            case 9 :
                $this->settings->add_hospi_ane($dato);
                break;
            case 10 :
                $this->settings->add_hospi_trans($dato);
                break;
            case 11 :
                $this->settings->add_hospi_pro($dato);
                break;
            case 12 :
                $this->settings->add_enf_virus($dato);
                break;
            case 13 :
                $this->settings->add_enf_bacteria($dato);
                break; 
            case 14 :
                $this->settings->add_enf_hongos($dato);
                break; 
            case 15 :
                $this->settings->add_enf_parasitos($dato);
                break; 
            case 16 :
                $this->settings->add_enf_psico($dato);
                break; 
            case 17 :
                $this->settings->add_enf_otras($dato);
                break;
            case 18 :
                $this->settings->add_terapia($dato);
                break;
            case 19 :
                $this->settings->add_producto_ven($dato);
                break;
            case 20 :
                $this->settings->add_empleo($dato);
                break;
            default:
                echo json_encode(array('error' => true));
                break;
                  
        }
        
        
    }
    
    //obtener elementos patologicos
    
    public function get_ante_congenita(){
        $this->db->like('enfermedad', $_POST['text'],'after');
        $this->db->where('tipo
        ', 'congenita');
        $this->db->from("enfermedades");
        $this->db->limit(1);
        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    }  
    
    public function get_ante_vacunas(){
        $this->db->like('vacuna', $_POST['text'],'after');
        $this->db->from("vacunas");
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 
    
    public function get_ante_alergias(){
        $this->db->like('alergeno', $_POST['text'],'after');
        $this->db->from("alergenos");
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 
    
    public function get_ante_hospi(){
        $this->db->like('causa', $_POST['text'],'after');
        $this->db->from("hospi_causa");
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 
    
    public function get_ante_medi(){
        $this->db->like('medicamento', $_POST['text'],'after');
        $this->db->from("medicamentos");
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 
    
    public function get_ante_terapias(){
        $this->db->like('terapia', $_POST['text'],'after');
        $this->db->from("terapias");
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 
    
    public function get_ante_venenos(){
        $this->db->like('veneno', $_POST['text'],'after');
        $this->db->from("venenos");
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 

    public function get_product_ven(){
        $this->db->like('nombre_p', $_POST['text'],'after');
        $this->db->from("productos_ven");
        $this->db->limit(3);

        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 
    
    public function get_congenita(){
         $this->db->where('tipo
        ', 'congenita','after');
        $this->db->from("enfermedades");
        
        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    }
    
    public function get_vacunas(){
        $result = $this->historia->vacunas();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    }
    
    public function get_alergias(){
        $result = $this->historia->alergeno();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 
    
    public function get_hospi(){
        $result = $this->historia->causa();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    }
    
    
    //obtener clasificacion de venenos
    
    public function get_clasificacion(){
        $this->db->where('id',$_POST["id_veneno"]);
        $result = $this->db->get("venenos")->row();
        $response = array();
        $response['data'] = $result;
        
         echo json_encode($response);
    }

    public function get_relations(){
        $this->db->select('a.id, pa.veneno, u.nombre_p');
        $this->db->join('venenos pa', 'pa.id = a.veneno_id');
        $this->db->join('productos_ven u', 'u.id = a.producto_ven_id');
         $this->db->where("a.veneno_id",$_POST["id_veneno"]);
        $this->db->from('venenos_productos a');
       
        $result =  $this->db->get()->result();
        $response = array();
        $response['data'] = $result;

        echo json_encode($response);
    }

    public function get_relations_product(){
        $this->db->select('a.id,pa.id as veneno_id, pa.veneno, u.nombre_p');
        $this->db->join('venenos pa', 'pa.id = a.veneno_id');
        $this->db->join('productos_ven u', 'u.id = a.producto_ven_id');
         $this->db->where("a.producto_ven_id",$_POST["producto_id"]);
        $this->db->from('venenos_productos a');
        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 
        
    public function get_c(){
        
        $clasis = json_encode($_POST['clasis']);
        $clasisj = json_decode($clasis);
        
        switch ($_POST['clasi_an']) {
            case 'c_a':
                $this->db->where('c_a',$clasisj->{'c_a'});
                break;
            case 'c_b':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                break;
            case 'c_c':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                break; 
            case 'c_d':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                break;
            case 'c_e':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                $this->db->where('c_e',$clasisj->{'c_e'});
                break;
            case 'c_f':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                $this->db->where('c_e',$clasisj->{'c_e'});
                $this->db->where('c_f',$clasisj->{'c_f'});
                break;
            case 'c_g':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                $this->db->where('c_e',$clasisj->{'c_e'});
                $this->db->where('c_f',$clasisj->{'c_f'});
                $this->db->where('c_g',$clasisj->{'c_g'});
                break;
            case 'c_h':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                $this->db->where('c_e',$clasisj->{'c_e'});
                $this->db->where('c_f',$clasisj->{'c_f'});
                $this->db->where('c_g',$clasisj->{'c_g'});
                $this->db->where('c_h',$clasisj->{'c_h'});
                break;
        }
        $this->db->group_by($_POST['clasi']);
        $this->db->select($_POST['clasi']);
        $result = $this->db->get("venenos");
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
         echo json_encode($response);
    } 
    
    public function get_v(){
        
        $clasis = json_encode($_POST['clasis']);
        $clasisj = json_decode($clasis);
        
        switch ($_POST['clasi_an']) {
            case 'c_a':
                $this->db->where('c_a',$clasisj->{'c_a'});
                break;
            case 'c_b':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                break;
            case 'c_c':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                break; 
            case 'c_d':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                break;
            case 'c_e':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                $this->db->where('c_e',$clasisj->{'c_e'});
                break;
            case 'c_f':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                $this->db->where('c_e',$clasisj->{'c_e'});
                $this->db->where('c_f',$clasisj->{'c_f'});
                break;
            case 'c_g':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                $this->db->where('c_e',$clasisj->{'c_e'});
                $this->db->where('c_f',$clasisj->{'c_f'});
                $this->db->where('c_g',$clasisj->{'c_g'});
                break;
            case 'c_h':
                $this->db->where('c_a',$clasisj->{'c_a'});
                $this->db->where('c_b',$clasisj->{'c_b'});
                $this->db->where('c_c',$clasisj->{'c_c'});
                $this->db->where('c_d',$clasisj->{'c_d'});
                $this->db->where('c_e',$clasisj->{'c_e'});
                $this->db->where('c_f',$clasisj->{'c_f'});
                $this->db->where('c_g',$clasisj->{'c_g'});
                $this->db->where('c_h',$clasisj->{'c_h'});
                break;
        }
        $this->db->select('id , veneno');
        $result = $this->db->get("venenos");
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        echo json_encode($response);
        
    }
    
    public function new_veneno(){
        $clasis = json_encode($_POST['clasis']);
        $clasisj = json_decode($clasis);
        $anio =  $this->input->post('anio') + $this->input->post('edad_veneno');

         $this->db->where('id',$_POST['id_veneno']);
         $query = $this->db->get('venenos');
         $veneno = $query->row()->veneno; 
        
        $descripcion = "No Patológico - ".$clasisj->{'c_a'};
       
         $data = array(
             'id_paciente' => $_POST['id_paciente'],
            'id_veneno' => $_POST['id_veneno'],
            'veneno' => $veneno,
            'frecuencia' => $_POST['frecc'],
            'edad_veneno' => $_POST['edad_veneno']
         );
         
        $data_linea = array(
        'id_paciente' => $_POST['id_paciente'],
        'id_dato' => $_POST['id_veneno'],
        'enfermedad' => $veneno, 
        'table_hisclinic' => "venenos", //_app1
        'edad_paciente' => $_POST['edad_veneno'],
        'frecuencia' => $_POST['frecc'],
        'descripcion' => $descripcion, 
        'anio' => $anio
        );
         

        $res = $this->historia->save_veneno_new($data, $data_linea);
        
        if($res){
            echo json_encode(array('error' => false));
        }
        else{
            echo $res;
        }
        
    }

    public function new_veneno_all(){
        $anio =  $this->input->post('anio') + $this->input->post('edad_veneno_all');


        $this->db->select('a.id,pa.id as veneno_id, pa.veneno, u.nombre_p');
        $this->db->join('venenos pa', 'pa.id = a.veneno_id');
        $this->db->join('productos_ven u', 'u.id = a.producto_ven_id');
        $this->db->where("a.producto_ven_id",$_POST["id_product"]);
        $this->db->from('venenos_productos a');
        $result = $this->db->get();
        $response['data'] = $result->result_array();
        $resp = [];

        foreach($result->result_array() as $ven){

            $descripcion = "No Patológico - Producto: ".$ven['nombre_p'];
        
            $data = array(
                'id_paciente' => $_POST['id_paciente'],
                'id_veneno' => $ven['veneno_id'],
                'veneno' => $ven['veneno'],
                'frecuencia' => $_POST['frecc_all'],
                'edad_veneno' => $_POST['edad_veneno_all']
            );
            
            $data_linea = array(
                'id_paciente' => $_POST['id_paciente'],
                'id_dato' => $ven['veneno_id'],
                'enfermedad' => $ven['veneno'], 
                'table_hisclinic' => "venenos", //_app1
                'edad_paciente' => $_POST['edad_veneno_all'],
                'frecuencia' => $_POST['frecc_all'],
                'descripcion' => $descripcion, 
                'anio' => $anio
            );

            $res = $this->historia->save_veneno_new($data, $data_linea);
            if($res){
                array_push($resp, array('equal' => false,'dato' => $ven['veneno']));
            }else{
                array_push($resp, array('equal' => true,'dato' => $ven['veneno']));
            }
        }

            echo json_encode($resp);


        //  echo json_encode(array('error' => false));
      }
    
    public function find_agents(){
          echo json_encode($this->db->get('agents')->result());  
      } 
    
    public function find_suc(){
          echo json_encode($this->db->get('sucursales')->result());
          
      }
    
    public function find_users(){
          echo json_encode($this->db->get('users')->result());
          
      }
    
    public function find_estados(){
        $this->db->where("id_pais",$_POST["id_pais"]);
          echo json_encode($this->db->get('estados')->result());  
      }
  

}