<?php 

class ComController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/Comision');
	}

	public function index() {

		session_redirect();

		$data = array();
        $data['title'] = 'Comisiones';
        $data['view_controller'] = 'comision_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador"){
            $this->load->view('comision/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}
    
    public function getCom_Suc(){
        $this->Comision->getCom_Suc();
    }
    public function getCom_Agent(){
        $this->Comision->getCom_Agent();
    }
    public function getCom_User(){
        $this->Comision->getCom_User();
    }

	public function create() {

    	session_redirect();

    	$data = array();
        $data['title'] = 'Nuevo rol';
        $data['permisos'] = $this->permiso->getAll();
        $data['roles'] = $this->rol->getAll();
        $data['view_controller'] = 'roles_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('roles/create', $data);
        $this->load->view('layout/scripts', $data);

	}
    
    public function change(){
        $id = $_POST['id'];
        $tipo = $_POST['tipo'];
        $fecha = date("d-m-y");
        
        
         $data = [
            'status' => 'Pagado',
             'descripcion' => $_POST['descripcion'],
             'updated_at' => $fecha
        ];
        
        $this->db->where('id', $id);
        
        if($tipo == "agente"){
            $db = 'agent_comision';
        }else if ($tipo == "usuario"){
            $db = 'user_comision';
        }else if ($tipo == "sucursal"){
            $db = 'sucursal_comision';
        }
        
        $this->db->update($db, $data);
        echo "Esto" .$id;
    
    }





}