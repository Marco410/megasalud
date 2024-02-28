<?php

class AuthController extends CI_Controller {
 
    /* 
      * Function to get view "Login"
      * Return view
    */

	public function login()
    {
        if($this->session->userdata('auth') == true){
            redirect('home');
        }

        $data = array();
        $data['title'] = 'Login';
        $data['view_style'] = 'login.css';
        
        $data['view_controller'] = 'login_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('auth/login');
        $this->load->view('layout/scripts', $data);
    }

    /* 
      * Function to get view "Recuperar Contraseña"
      * Return view
    */
    
    public function password_request(){
        $data = array();
        $data['title'] = 'Recuperar Contraseña';
        $data['view_style'] = 'login.css';
        
        $data['view_controller'] = 'login_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('auth/reset_pw');
        $this->load->view('layout/scripts', $data);
    }

    /* 
      * Function to get view "Perfil"
      * Return view
    */
    
    public function perfil()
    {
        $id = $this->session->id;
       
        session_redirect();

        $data = array();
        $data['title'] = 'perfil';
        $type = $this->session->type;
         if($type == "Representante"  ){
            $data['user'] = $this->getAgent($id);
         }else{
             $data['user'] = $this->getUser($id);
         }
        $data['view_controller'] = 'login_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('auth/perfil');
        $this->load->view('layout/scripts', $data);
    }

    /* 
      * Function to get user data
      * Return data
      * @param user_id
    */
    
    public function getUser($id){
       
        $this->db->where("id",$id);
        return $this->db->get("users");
    }

    /* 
      * Function to get "representante" data
      * Return data
      * @param agent_id
    */
    
    public function getAgent($id){
       
        $this->db->where("id",$id);
        return $this->db->get("agents");
    }

    /* 
      * Function to save session data
      * Return json response
      * @param email, password, agent?
    */

    public function auth(){
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        //si selecciona inicio como representante
        if(isset($_POST['agent'])){
            $this->db->select('id, nombre, apellido_p, password,aprobado');
            $this->db->from('agents');
            $this->db->where('email', $email);
            $this->db->where('status', 1);
            $query = $this->db->get();
            $row = $query->row();
            
        }else{
            //buscar un usuario
            $this->db->select('id, nombre, apellido_p, password,apellido_m,cedula');
            $this->db->from('users');
            $this->db->where('email', $email);
            $this->db->where('status', 1);
            $query = $this->db->get();
            $row = $query->row();
        }

        //si encuentra un usuario con ese correo, verifica la pass
        if (isset($row))
        {
        
            $this->db->select('r.id,r.name');
            $this->db->from('roles r');
            $this->db->join('rol_user ru','ru.rol_id = r.id', 'inner');
            $this->db->where('ru.user_id', $row->id);
            $query3 = $this->db->get();
            $row3 = $query3->row();
            
            if(password_verify($password, $row->password)){
                $bandera = 0;
                
                if(isset($_POST['agent'])){
                    
                    $data = array(
                    'id' => $row->id,
                    'name' => $row->nombre.' '.$row->apellido_p,
                    'error' => false,
                    'type' => 'Representante',
                    'auth' => true
                        );
                    $data_s = array(
                        'id_agent' => $data['id']
                    );
                    $this->db->insert('sessions_agent',$data_s);
                    
                }else{
                    
                    $data = array(
                    'id' => $row->id,
                    'name' => $row->nombre.' '.$row->apellido_p,
                    'apellido_m' => $row->apellido_m,
                    'cedula' => $row->cedula,
                    'error' => false,
                    'type' => $row3->name,
                    'auth' => true
                        );
                    
                   switch ($this->session->type ) {
                     case 'Administrador':
                         $data['sucursal'] = 0;
                         $data['auth'] = true;
                     break;

                     default:
                         $this->db->select('s.*');
                         $this->db->from('sucursales s');
                         $this->db->join('sucursal_user us', 'us.sucursal_id = s.id', 'inner');
                         $this->db->where('us.user_id', $row->id);
                         $query2 = $this->db->get();

                         if($query2->num_rows() > 1){
                             $bandera = 1;
                             $data['auth'] = false;
                         }
                         else{
                             $row2 = $query2->row();
                             $data['sucursal'] = $row2->id;
                             $data['sucursal_name'] = $row2->razon_social;
                             $data['auth'] = true;
                         }
                     break;
                 }
                    
                    $data_s = array(
                        'id_user' => $data['id']
                    );
                    $this->db->insert('sessions_user',$data_s);
                    
                }
                //verificar si el representante esta aprobado
                if(isset($_POST['agent'])){
                    //verifica el representnate aprobado
                    if($row->aprobado == "0"){

                        echo json_encode(array('aprobado'=>false));
                    }else{
                        $this->session->set_userdata($data);
                        if($bandera == 1){
                            $data['sucursales'] = $query2->result_array();
                        }
                        echo json_encode($data);
                    }
                
                    //si no es representante no pasa nada
                }else{

                    $this->session->set_userdata($data);

                    if($bandera == 1){
                        $data['sucursales'] = $query2->result_array();
                    }

                    echo json_encode($data);
                }
            }
            else{
                echo json_encode(array('error' => true));
            }
        }
        else{
            echo json_encode(array('error' => true));
        }
    }

    /* 
      * Function to save session data from patient
      * Return json response
      * @param expediente, password
    */
    
    public function auth_pacient(){

        $exp = $_POST['expediente'];
        $password = $_POST['pass'];
        
        //buscar un usuario
        $this->db->select('id, nombre, apellido_p, password,apellido_m,motivo_consulta');
        $this->db->from('pacientes');
        $this->db->where('clave_bancaria', $exp);
        $this->db->where('password', $password);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $row = $query->row();

        //si encuentra un usuario con ese correo, verifica la pass
        if (isset($row))
        {
        
            $data = array(
                'id' => $row->id,
                'name' => $row->nombre.' '.$row->apellido_p,
                'apellido_m' => $row->apellido_m,
                'motivo' => $row->motivo_consulta,
                'error' => false,
                'type' => 'Paciente',
                'auth' => true
            );
                    
            switch ($this->session->type ) {
                case 'Administrador':
                break;

                default:
                    $this->db->select('s.*');
                    $this->db->from('sucursales s');
                    $this->db->join('sucursal_pacientes us', 'us.sucursal_id = s.id', 'inner');
                    $this->db->where('us.paciente_id', $row->id);
                    $query2 = $this->db->get();

                    if($query2->num_rows() == ""){
                        $bandera = 1;
                        $data['auth'] = false;
                    }
                    else{
                        $row2 = $query2->row();
                        $data['sucursal'] = $row2->id;
                        $data['sucursal_name'] = $row2->razon_social;
                        $data['auth'] = true;
                    }
                break;
            }  
                $data_s = array(
                    'id_paciente' => $data['id']
                );
                $this->session->set_userdata($data);
                $this->db->insert('sessions_pa',$data_s);
                echo json_encode($data);
        }
        else{
            echo json_encode(array('error' => true));
        }
    }

    /* 
      * Function to check email
      * Return json response
      * @param email
    */

    public function checkEmail()
    {
        $email = $_POST["email"];

        $this->db->select('id, email');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('status', 1);
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

    /* 
      * Function to check email patient
      * Return json response
      * @param email
    */ 
    
    public function checkEmailPacient()
    {
        $email = $_POST["email"];

        $this->db->select('id, email');
        $this->db->from('pacientes');
        $this->db->where('email', $email);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $row = $query->row();
        
        if($email == "na@na.com"){
            echo json_encode(true);
        }
        else{
            if (isset($row))
            {
                echo json_encode(false);
            }
            else{
                echo json_encode(true);
            }
        }
    }
    
    /* 
      * Function to check if patient exist
      * Return json response
      * @param pais_origen, fecha_nacimiento, apellido_p, nombre, apellido_m
    */ 
    
    public function checkExistPacient()
    {
        
        $pais_origen = $_POST["pais_origen"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $ap = $_POST["apellido_p"];
        $nombre = $_POST["nombre"];

        $this->db->select('id, nombre');
        $this->db->from('pacientes');
        $this->db->where('nombre', $nombre);
        
        if (isset($_POST["apellido_m"])){
            $am = $_POST["apellido_m"];
            $this->db->where('apellido_m', $am);
        }
        $this->db->where('apellido_p', $ap);
        $this->db->where('pais_origen', $pais_origen);
        $this->db->where('fecha_nacimiento', $fecha_nacimiento);
        $this->db->where('status', 1);
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
    
    /* 
      * Function to check patient name
      * Return json response
      * @param apellido_p, nombre, apellido_m
    */ 

    public function checkNamePacient()
    {
        $nombre = $_POST["nombre"];

        $this->db->select('id, nombre,apellido_p, apellido_m,fecha_nacimiento,pais_origen,clave_bancaria,created_at');
        $this->db->from('pacientes');
        $this->db->where('nombre', $nombre);

        if (isset($_POST["apellido_p"])){
            $ap = $_POST["apellido_p"];
            $this->db->where('apellido_p', $ap);
        }
        
        if (isset($_POST["apellido_m"])){
            $am = $_POST["apellido_m"];
            $this->db->where('apellido_m', $am);
        }
        $this->db->where('status', 1);
        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        
        if (isset($row))
        {
            echo json_encode($response);
        }
        else{
            echo json_encode($response);
        }
    }
    
    /* 
      * Function to check email "representante"
      * Return json response
      * @param email
    */ 
    
    public function checkEmailAgent()
    {
        $email = $_POST["email"];

        $this->db->select('id, email');
        $this->db->from('agents');
        $this->db->where('email', $email);
        $this->db->where('status', 1);
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

    /* 
      * Function to destroy session
      * Return redirect
    */ 

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

    /* 
      * Function to send email to change pass
      * Return json response
      * @param email, user
    */ 
    
    public function reset_pass(){
        
         $this->load->model('megasalud/Correos');
        
        $email = $_POST["email"];
        
        if ($_POST["user"] == "1"){
            $table = "users";
        }else{
            $table = "agents";
        }

        $this->db->select('email');
        $this->db->from($table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row))
        {
            $token = $this->generar_token();
            $data = array(
                'email' => $_POST["email"],
                'token' => $token,
                'tipo' => $table
            );
            
            $this->db->insert("password_resets", $data);
            
            $this->load->library('email');
            $config['mailtype']  = 'html';
            $this->email->initialize($config);
            $this->email->from('desarrollo_software@megasalud.com.mx','Soporte Técnico Megasalud ');
            $this->email->to($_POST["email"]);
            $this->email->cc('info@megasalud.com.mx');
            $this->email->subject("Recuperación de Contraseña");
            
            $this->email->message($this->Correos->request_pass($token));
            
            if($this->email->send()){
                
                echo json_encode(array('error' => true, 'token' => $token));
                
            }else{
                
                echo json_encode(array('email' => false));
            }
        }
        else{
             echo json_encode(array('error' => false));
        }
    }

    /* 
      * Function to generate token
      * Return token
    */ 
    
    function generar_token(){
       
       $token = "M";
       
       for($i=1; $i<=8;$i++){
           $numero = rand(0,9);
           $token.= $numero;
       }
       
       $date = date("my");
       
       return $token.$date;
       
   }

    /* 
      * Function to generate token
      * Return token
    */ 
    
    public function confirmToken($token){
        $data = array();
        $data['title'] = 'Recuperar Contraseña';
        $data['view_style'] = 'login.css'; 
        $this->db->select("email,token,tipo");
        $this->db->where("token",$token);
        $r = $this->db->get("password_resets");
        $row = $r->row();
            
        $data['email'] = $row->email; 
        $data['tipo'] = $row->tipo; 
        $data['token'] = $token; 
        
        if(isset($row)){
            
            $data['view_controller'] = 'login_vs.js';

            $this->load->view('layout/head', $data);
            $this->load->view('auth/reset_password');
            $this->load->view('layout/scripts', $data);
            
        }else{
            $this->load->view('layout/head');
            $this->load->view('auth/error_pw'); 
        }
       
    }

    /* 
      * Function to change password
      * Return json response
      * @params password
    */ 
    
    public function changePW(){
        
        $this->db->select("email,tipo");
        $this->db->where("token",$_POST['token']);
        $r = $this->db->get("password_resets");
        $row = $r->row();
        
        $passEncry = password_hash($_POST["password"],PASSWORD_DEFAULT);
        $this->db->set('password', $passEncry);
        $this->db->where('email', $row->email);
        
        if($this->db->update($row->tipo)){
             echo json_encode(array('error' => false));
        }
        else{
             echo json_encode(array('error' => true));
        }
    }
}