<?php 

class UsersController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/user');
        $this->load->model('megasalud/sucursal');
        $this->load->model('megasalud/rol');
        $this->load->model('megasalud/funciones');
    }

    public function index() {

        session_redirect();

        $data = array();
        $data['title'] = 'Usuarios';
        $data['data'] = $this->user->getAll();
        $data['view_controller'] = 'users_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador"){
            $this->load->view('users/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }

    public function create(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nuevo usuario';
        $data['view_controller'] = 'users_vs.js';
        $data['sucursales'] = $this->sucursal->getAll();
        $data['roles'] = $this->rol->getAll();

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador"){
            $this->load->view('users/create', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }
    
    public function sessions(){

        session_redirect();

        $data = array();
        $data['title'] = 'Sesiones';
        $data['view_controller'] = 'users_vs.js';
        
        $data['users'] = $this->ses_user();
        $data['agents'] = $this->ses_agent();
        $data['pacientes'] = $this->ses_pa();

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador"){
            $this->load->view('users/sessions', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
    }
    
    public function ses_user(){
        
        $this->db->select(" CONCAT (u.nombre ,' ' , u.apellido_p , ' ', u.apellido_m) AS nombre,su.created_at, su.id ");
        $this->db->from("sessions_user su");
        $this->db->join("users u", "su.id_user = u.id",'inner');
        $this->db->order_by('su.created_at', 'asc');
        return $this->db->get();
    }
    
    public function ses_agent(){
        $this->db->select("sa.created_at, CONCAT(u.nombre,' ' , u.apellido_p, ' ',u.apellido_m) AS nombre, sa.id");
         $this->db->from("sessions_agent sa");
         $this->db->join("agents u", "sa.id_agent = u.id",'inner');
         $this->db->order_by('sa.created_at', 'asc');
        return $this->db->get();
    } 
    
    public function ses_pa(){
        $this->db->select("sp.created_at, CONCAT(u.nombre,' ' , u.apellido_p, ' ',u.apellido_m) AS nombre, sp.id");
         $this->db->from("sessions_pa sp");
         $this->db->join("pacientes u", "sp.id_paciente = u.id",'inner');
         $this->db->order_by('sp.created_at', 'asc');
        return $this->db->get();
    }

    public function newEntry(){
        
        $passEncry = password_hash($_POST["password"],PASSWORD_DEFAULT);
        
         $data = array(
            'nombre' => $_POST["nombre"],
            'apellido_p' => $_POST["apellido_p"],
            'apellido_m' => $_POST["apellido_m"],
            'email' => $_POST["email"],
            'password' => $passEncry,
            'fecha_nacimiento' => $_POST['fecha_nacimiento'],
            'sexo' => $_POST['sexo'],
            'municipio' => $_POST["municipio"],
            'estado' => $_POST["estado"],
            'pais' => $_POST["pais"],
            'calle' => $_POST["calle"],
            'colonia' => $_POST['colonia'],
            'cp' => $_POST['cp'],
            'rfc' => $_POST['rfc'],
            'curp' => $_POST['curp'],
            'telefono_a' => $_POST["telefono_a"],
            'telefono_b' => $_POST['telefono_b'],
            'clave_bancaria' => $_POST['clave_bancaria'],
            
            'cedula' => $_POST['cedula'],
            'especialidad' => $_POST['especialidad'],
            'cuenta_bancaria' => $_POST['cuenta_bancaria'],
            'banco' => $_POST['banco']
        );
        
       
        
         if($this->db->insert('users', $data)){
                $id_user = $this->db->insert_id();
             
             $this->db->select('id');
             $this->db->from('users');
             $this->db->where('email',$_POST["email"]);
             $query = $this->db->get();
             $row = $query->row();
             
              $dataOffice = array(
                'sucursal_id' => $_POST["sucursal"],
                'user_id' => $row->id
                );
        
                $dataRol = array(
                    'rol_id' => $_POST["tipo_usuario"],
                    'user_id' => $row->id
                );
             
             $this->db->insert('rol_user',$dataRol);
             $this->db->insert('sucursal_user',$dataOffice);
             
             //GENERA CLAVE
                
             if($_POST["tipo_usuario"] == "1"){
                  $clave_banc = $this->funciones->genera_clave($data['estado'],$id_user, "A");
             }
             else if ($_POST["tipo_usuario"] == "2"){
                 $clave_banc = $this->funciones->genera_clave($data['estado'],$id_user, "D");
             } 
             else if ($_POST["tipo_usuario"] == "3"){
                 $clave_banc = $this->funciones->genera_clave($data['estado'],$id_user, "M");
             } 
             
             else if ($_POST["tipo_usuario"] == "4"){
                 $clave_banc = $this->funciones->genera_clave($data['estado'],$id_user, "V");
             }
             else if ($_POST["tipo_usuario"] == "5"){
                 $clave_banc = $this->funciones->genera_clave($data['estado'],$id_user, "C");
             }
               
                
                $data_clave = array (
                'clave_bancaria' => $clave_banc
                );
                
                $data['id_paciente'] = $id_paciente;
                
                $this->db->where('id', $id_user);
		        $this->db->update('users',$data_clave);
             
             //TERMINA GENERA CLAVE
                echo true;
            }
            else{
                echo false;
            }
    }

    public function getUser($id){
        
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        $result = $query->row_array();

        return $result;
    }

    public function edit(){

        session_redirect();

        $id = $this->uri->segment(2);

        $data = array();
        $data['title'] = 'Usuarios';
        $data['data'] = $this->getUser($id);
        // $data['view_style'] = 'users.css';
        $data['view_controller'] = 'users_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('users/edit', $data);
        $this->load->view('layout/scripts', $data);
    }
    
    public function getTipo($id){
        
        $this->db->select('r.id,r.name');
        $this->db->from('roles r');
        $this->db->join('rol_user ru','ru.rol_id = r.id', 'inner');
        $this->db->where('ru.user_id', $id);
        $query3 = $this->db->get();
        
        $response = array();
        $response['data'] = $query3->row_array();
        
        echo json_encode($response);
    }

    public function userControl(){

        $data = array(
            'nombre' => $_POST["nombre"],
            'apellido_p' => $_POST["apellido_p"],
            'apellido_m' => $_POST["apellido_m"],
            'email' => $_POST["email"],
            'password' => $_POST["password"],
            'fecha_nacimiento' => $_POST['fecha_nacimiento'],
            'sexo' => $_POST['sexo'],
            'municipio' => $_POST["municipio"],
            'estado' => $_POST["estado"],
            'pais' => $_POST["pais"],
            'calle' => $_POST["calle"],
            'colonia' => $_POST['colonia'],
            'cp' => $_POST['cp'],
            'rfc' => $_POST['rfc'],
            'curp' => $_POST['curp'],
            'telefono_a' => $_POST["telefono_a"],
            'telefono_b' => $_POST['telefono_b'],
            'clave_bancaria' => $_POST['clave_bancaria'],
            'tipo_usuario' => $_POST["tipo_usuario"],
            'cedula' => $_POST['cedula'],
            'especialidad' => $_POST['especialidad'],
            'cuenta_bancaria' => $_POST['cuenta_bancaria'],
            'banco' => $_POST['banco']
        );

        if(isset($_POST['_method'])){
            $this->db->where('id', $_POST["id"]);

            if($this->db->update('users', $data)){
                echo true;
            }
            else{
                echo false;
            }
        }
        else{
            if($this->db->insert('users', $data)){
                echo true;
            }
            else{
                echo false;
            }
        }
    }

    public function show(){

        $this->db->where('id', $this->uri->segment(4));
        $result = $this->db->get('users');
        $row = $result->row();
        $response = array();
        $response['data'] = $result->row_array();
        //modificar
        // if( $row->tipo_usuario == 'Administrador') {
        //     $response['type'] = 'Administrador';
        // } else {
        //     $response['type'] = $row->tipo_usuario;
        //     $this->db->select('s.*');
        //     $this->db->from('sucursales s');
        //     $this->db->join('user_sucursal us', 'us.sucursal_id = s.id', 'inner');
        //     $this->db->where('us.user_id', $row->id);
        //     $result = $this->db->get();
        //     $response['sucursales'] = $result->result_array();
        // }

        echo json_encode($response);
    }

    public function changePassword()
    {
        $id = $_POST["id"];
        $password = $_POST["password"];

        $this->db->set('password', $password);
        $this->db->where('id', $id);

        if($this->db->update('users')){
            echo true;
        }
        else{
            echo false;
        }
    }

    public function delete(){

        $id = $_POST["id"];

        $this->db->set('status', 0);
        $this->db->where('id', $id);

        if($this->db->update('users')){
            echo true;
        }
        else{
            echo false;
        }
    }

}