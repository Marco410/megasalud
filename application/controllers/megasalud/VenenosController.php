<?php

class VenenosController extends CI_Controller{
    
     public function __construct()
    {
        parent::__construct();
        
    }
    
     public function index(){
        
        session_redirect();
         
        $data = array();
        $data['title'] = 'Venenos';
        $data['view_controller'] = 'venenos_vs.js';
         
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
         
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador" ){
            $this->load->view('venenos/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
         
     }
    
    public function edit($id){
        
        session_redirect();
         
        $data = array();
        $data['title'] = 'Editar Venenos';
        $data['view_controller'] = 'venenos_vs.js';
         
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $data['medi'] = $this->find_medi($id);
         
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador" ){
            $this->load->view('venenos/edit', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
         
     }
    
    public function create(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nuevo venenos';
        $data['view_controller'] = 'venenos_vs.js';
        

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('venenos/create');
        $this->load->view('layout/scripts', $data);
       
       
    }
    
    public function find_medi($id) {

		$this->db->where('id', $id);
		return $this->db->get('medicamentos');

	}
    
    public function insert_medi(){
        
        $data = array (
            'medicamento' => $_POST['nombre_c'],
            'nombre' => $_POST['nombre'],
            'contra' => $_POST['contra']
        );
        
        if($this->db->insert("medicamentos",$data)){
            echo true;
        }else{
            echo false;
        }
        
    } 
    public function edit_medi(){
        $id = $_POST["id"];
        
        $data = array (
            'medicamento' => $_POST['nombre_c'],
            'nombre' => $_POST['nombre'],
            'contra' => $_POST['contra']
        );
        $this->db->set($data);
        $this->db->where("id",$id);
        if($this->db->update("medicamentos")){
            echo true;
        }else{
            echo false;
        }
        
    }
    
    public function delete(){
        $id = $this->uri->segment(4);
        
        $this->db->where("id",$id);
        if($this->db->delete("medicamentos")){
            echo true;
        }else{
            echo false;
        }
        
    }
    
    public function get_medi(){
        $this->db->select('id,medicamento,nombre');
        $result = $this->db->get("medicamentos");
        $response = $result->result();
        
         $array["data"]=$response;
                
         echo json_encode($array);
    }
    
     public function show(){

            $this->db->select('*');
            $this->db->from('medicamentos');
            $this->db->where('id', $this->uri->segment(4));
            $result = $this->db->get();
            $row = $result->row();
            $response = array();
            $response['data'] = $result->row_array();
            echo json_encode($response);
            
    } 

}