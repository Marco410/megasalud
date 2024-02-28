<?php 

class ComController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/Comision');
	}

    /* 
      * Function to get view Comissions
      * Return view
    */ 

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

    /* 
      * Function to get comision from "Sucursales"
      * Return json data
    */ 
    
    public function getCom_Suc(){
        $this->Comision->getCom_Suc();
    }

    /* 
      * Function to get comision from "Represenantes"
      * Return json data
    */ 

    public function getCom_Agent(){
        $this->Comision->getCom_Agent();
    }

    /* 
      * Function to get comision from "Usuarios"
      * Return json data
    */ 

    public function getCom_User(){
        $this->Comision->getCom_User();
    }

    /* 
      * Function to get change status comission
      * Return message
      * @params comission_id, tipo, descripcion
    */ 
    
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