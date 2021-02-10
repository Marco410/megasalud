<?php 

class AgentController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/agent');
        $this->load->model('megasalud/historia');
        $this->load->model('megasalud/funciones');
        $this->load->model('megasalud/sucursal');
	}

	public function index() {

		session_redirect();

		$data = array();
        $data['title'] = 'Representante';
        $data['view_controller'] = 'agent_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
        if($type == "Administrador" || $type == "Ventas"){
            $this->load->view('agent/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}

	public function create() {
        
        $data = array();
        $data['title'] = 'Nuevo Representante';
        // $data['view_style'] = 'pacients.css';
        $data['view_controller'] = 'agent_vs.js';
       
        $this->load->view('agent/create', $data);
        $this->load->view('layout/scripts');
	}
    public function success() {
        
        $data = array();
        $data['title'] = 'Gracias';
        $data['view_controller'] = 'agent_vs.js';
       
        $this->load->view('agent/success', $data);
        $this->load->view('layout/scripts');
	}	
    
    public function createPacient() {

        session_redirect();

        $data = array();
        $data['title'] = 'Nuevo Paciente';
        // $data['view_style'] = 'pacients.css';
        $data['view_controller'] = 'agent_vs.js';
        $data['sucursales'] = $this->sucursal->getAll();
        $data['motivo_consulta'] = $this->historia->get_motivo_consulta();
        
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
         $type = $this->session->type;
        if($type == "Administrador" || $type == "Ventas" || $type == "Representante"){
            $this->load->view('agent/createP', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        
        $this->load->view('layout/scripts', $data);

	}
    
    public function ver($id) {

        session_redirect();

        $data = array();
        $data['title'] = 'Mi Panel';
        
        $data['view_controller'] = 'agent_vs.js';
        $data['pacientes'] = $this->getPacientes($id);
        $data['count'] = $this->agent->getPacientes_count($id);
        $data['get_comisiones_pen'] = $this->agent->get_comisiones_pen($id);
        
        $data['get_comisiones_pag'] = $this->agent->get_comisiones_pag($id);
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $data['agent'] = $this->agent->find($id);
        
        $type = $this->session->type;
        
        if($type == "Administrador" || $type == "Ventas"|| $type == "Representante"){
            $this->load->view('agent/ver', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);

	}
    
    
    
    public function getAll(){

        $response = null;

        switch ($this->session->userdata('type')) {

            case 'Administrador':
                
            $this->db->where('status', 1);
                
             $this->db->select('id,CONCAT(nombre," " , apellido_p, " ",apellido_m) AS nombre,email,telefono_a,estado');   
                
            $this->db->from('agents');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get();
                
            $response = $query->result();
            break;
                
            case 'Ventas':
                
           $this->db->where('status', 1);
                
             $this->db->select('id,CONCAT(nombre," " , apellido_p, " ",apellido_m) AS nombre,email,telefono_a,estado');   
                
            $this->db->from('agents');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get();
                
            $response = $query->result();
            break;
        }
        
         $array["data"]=$response;
                
         echo json_encode($array);
    }
    
    public function getPacientes($id){

        $response = null;

                
        $this->db->select('p.id,p.clave_bancaria,seguim,CONCAT(p.nombre," " , p.apellido_p, " ",p.apellido_m) AS nombre,p.email,p.telefono_a,p.estado');
        $this->db->from('pacientes p');
        $this->db->join('agent_paciente ap', 'ap.id_paciente = p.id', 'inner');
        $this->db->where('ap.id_agent', $id);
        $this->db->where('p.status', 1);
        return $this->db->get();

      
    }
    
    public function get_Pedidos_Paciente($id){

        $response = null;
                
        $this->db->select('p.id,p.status,p.created_at');
        $this->db->from('pedidos p');
        $this->db->where('p.paciente_id', $id);
        
        $result = $this->db->get();
        $row = $result->row();
        $response = array();
        $response['data'] = $result->result();
        

        echo json_encode($response);

      
    }

    public function newEntry() {
         
        $status = 1;
         $passEncry = password_hash($_POST["password"],PASSWORD_DEFAULT);
        $data =  array(
            
        'nombre' => $this->input->post('nombre'),
        'apellido_p' => $this->input->post('apellido_p'),
        'apellido_m' => $this->input->post('apellido_m'),
        'email' => $this->input->post('email'),
        'sexo' => $this->input->post('sexo'),
        'password' => $passEncry,
        'estado_civil' => $this->input->post('estado_civil'),
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
        'no_tarjeta' => $this->input->post('no_tarjeta'),
        'banco' => $this->input->post('banco'),
        'status' => $status
        );
         
         
            if($this->db->insert('agents', $data)){
               $id_agent = $this->db->insert_id();
                
                 echo json_encode($data);
            }
        else{
            echo false;
        }
    }

    public function edit($id) {

        session_redirect();

        $data['title'] = 'Editar Representante';
        $data['view_controller'] = 'agent_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Ventas"){
            $this->load->view('representante/edit', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
    }

    public function delete() {
        if($this->rol->delete($this->input->post('id')) !== 0){
            echo true;
        }else{
            echo false;
        }
    }
    
    public function newPacient() {
         
        $status = 1;
         
        $ref = $this->input->post('referido');
        $am = "A";
         if(!isset($_POST['apellido_m'])){
             $am = substr($_POST['apellido_m'],0,1);
         }
       
        $pass = "P-".substr($_POST['apellido_p'],0,2).$am.substr($_POST['nombre'],0,1).date("d");
         
         //Se busca el id del motivo para el paciente
        $this->db->where("id",$this->input->post('motivo'));
        $motivo = $this->db->get("motivo_consulta")->row()->enfermedad;
        
        $data =  array(
            
        'nombre' => $this->input->post('nombre'),
        'apellido_p' => $this->input->post('apellido_p'),
        'apellido_m' => $this->input->post('apellido_m'),
        'email' => $this->input->post('email'),
        'password' => $pass,
        'motivo_consulta' => $motivo,
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
         
            $id_cal = $this->input->post('id_calendario');
            $nombre = $this->input->post('title_cita')." ".$this->input->post('telefono_a');
            $fecha = $this->input->post('fecha_cita');
            $tipo = "Primera vez | Agregado por representante";
                
            $cita = $this->funciones->agregar_calendario($id_cal,$nombre,$fecha,$tipo);
                
            if($cita == "Ya"){
                echo json_encode(array('error' => true));
            }else{//empieza error ya
                
         
            if($this->db->insert('pacientes', $data)){
                
               $id_paciente = $this->db->insert_id();
                
              $dataOffice = array(
                'sucursal_id' => $_POST["sucursal"],
                'paciente_id' => $id_paciente
                );  
                
                $this->db->insert('sucursal_pacientes',$dataOffice);
                
                //insertar en los referidos
               
                if($this->session->type != "Representante"){
                     $dataAgent = array(
                'id_user' => $this->input->post('referido'),
                'id_paciente' => $id_paciente
                );
                    //se inserta comision para un usuario
                     $this->db->insert('user_paciente',$dataAgent);
                    
                }else{
                     $dataAgent = array(
                'id_agent' => $this->input->post('referido'),
                'id_paciente' => $id_paciente
                );
                    //se inserta comision para representante
                    $this->db->insert('agent_paciente',$dataAgent);
                }
                
                
                //Genera clave bancaria
                //$clave_banc = $this->funciones->genera_clave($data['estado'],$id_paciente, "P");
                
                //$data_clave = array (
                //'clave_bancaria' => $clave_banc
                //);
                
                //$data['id_paciente'] = $id_paciente;
                
                //$this->db->where('id', $id_paciente);
		        //$this->db->update('pacientes',$data_clave);
                //Termina clave bancaria
                
                 //Se inserta el motivo
                 $dataMotivo = array(
                    'id_paciente' => $id_paciente,
                     'id_motivo' => $this->input->post('motivo')
                 );
                $this->db->insert("hisclinic_motivo",$dataMotivo);

                 echo json_encode(array('error' => false));
                }
                
            else{
                
                echo json_encode(array('error' => 1));
            }
                
            }//termina error ya
    }
    
    public function findAgent($id)
    {
        $id_agent = $id;

        $this->db->select('id, nombre');
        $this->db->from('agents');
        $this->db->where('id', $id_agent);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $row = $query->row();

        if (isset($row))
        {
            echo json_encode($row);
        }
        else{
            echo json_encode(false);
        }
    }  
    
    public function findSuc($id)
    {
        $id_suc = $id;

        $this->db->select('id, razon_social');
        $this->db->from('sucursales');
        $this->db->where('id', $id_suc);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $row = $query->row();

        if (isset($row))
        {
            echo json_encode($row);
        }
        else{
            echo json_encode(false);
        }
    } 
    
    public function findUser($id)
    {
        $id_user = $id;

        $this->db->select('id, nombre,apellido_p');
        $this->db->from('users');
        $this->db->where('id', $id_user);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $row = $query->row();

        if (isset($row))
        {
            echo json_encode($row);
        }
        else{
            echo json_encode(false);
        }
    } 

    

}