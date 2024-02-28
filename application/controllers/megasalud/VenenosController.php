<?php

class VenenosController extends CI_Controller{
    
     public function __construct()
    {
        parent::__construct();
    }

    /* 
        * Function to get view "venenos"
        * Return view
    */
    
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

    /* 
        * Function to get view "Editar Medicamento"
        * Return view
    */
    
    public function edit_medicamento($id){
        
        session_redirect();
         
        $data = array();
        $data['title'] = 'Editar Medicamento';
        $data['view_controller'] = 'venenos_vs.js';
         
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $data['medi'] = $this->find_medi($id);
         
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador" ){
            $this->load->view('venenos/edit-medi', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
         
    }

    /* 
        * Function to get view "Editar Venenos"
        * Return view
    */

    public function edit($id){
    
        session_redirect();
            
        $data = array();
        $data['title'] = 'Editar Venenos';
        $data['view_controller'] = 'venenos_vs.js';
            
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $data['veneno'] = $this->find_veneno($id);
        $data['productos'] = $this->find_productos();
        $data['relations'] = $this->find_relations($id);
            
        $type = $this->session->type;
            if($type == "Administrador" || $type == "Medico Administrador" ){
            $this->load->view('venenos/edit', $data);
        }else{
            $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
        
    }

    /* 
        * Function to add relation
        * Return json
        * @param data relation
    */

    public function add_relation(){

        $this->db->where('producto_ven_id',$_POST['producto_id']);
        $this->db->where('veneno_id',$_POST['veneno_id']);
        $query = $this->db->get('venenos_productos');

        if ($query->num_rows() > 0){
            echo json_encode(array('error' => true,'msj'=> 'Ya éxiste esta relación.'));
        }
        else{
            $this->db->where('id', $_POST['producto_id']);
            $p=$this->db->get('productos_ven')->row();
            $data = array (
                'veneno_id' => $_POST['veneno_id'],
                'producto_ven_id' => $_POST['producto_id']
            );
    
            if($this->db->insert("venenos_productos",$data)){
                echo json_encode(array('producto'=> $p->nombre_p,'producto_id'=> $p->id));
            }else{
                echo json_encode(array('error' => true,'msj'=> 'Error inesperado.'));
            }
        }
    }

    /* 
        * Function to delete relation
        * Return json
        * @param data relation
    */

    public function delete_relation(){
        $this->db->where('id', $_POST['relation_id']);
        if($this->db->delete("venenos_productos")){
            echo json_encode(array('producto'=> "Eliminado"));
        }else{
            echo json_encode(array('error' => true,'msj'=> 'Error inesperado.'));
        }
    }

    /* 
        * Function to get view 'Nuevo Veneno'
        * Return view
    */
    
    public function create(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nuevo venenos';
        $data['view_controller'] = 'venenos_vs.js';
        $data['clasificaciones'] = $this->get_clasificaciones();
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('venenos/create');
        $this->load->view('layout/scripts', $data);
    }

    /* 
        * Function to get clasificaciones data
        * Return data
    */

    public function get_clasificaciones() {

		return $this->db->get('clasificaciones');
	}

    /* 
        * Function to find veneno data
        * Return data
    */

    public function find_veneno($id) {

		$this->db->where('id', $id);
		return $this->db->get('venenos');

	}

    /* 
        * Function to find medicamento data
        * Return data
    */
    
    public function find_medi($id) {

		$this->db->where('id', $id);
		return $this->db->get('medicamentos');
	}

    /* 
        * Function to find products data
        * Return data
    */

    public function find_productos() {
		return $this->db->get('productos_ven');
	}

    /* 
        * Function to find relations data
        * Return data
    */

    public function find_relations($id) {
        $this->db->select('a.id, pa.veneno, u.nombre_p');
        $this->db->join('venenos pa', 'pa.id = a.veneno_id');
        $this->db->join('productos_ven u', 'u.id = a.producto_ven_id');
        $this->db->from('venenos_productos a');
        $this->db->where("a.veneno_id",$id);
       
         $result =  $this->db->get();
         $response = $result->result();

		return $response;
	}

    /* 
        * Function to save 'veneno'
        * Return json
        * @param veneno data
    */

    public function store(){

        $this->db->where('veneno', $_POST['veneno']);
		$query = $this->db->get('venenos');

        if ($query->num_rows() > 0){
            echo json_encode(array('error' => true,'msj'=> 'Ya existe este veneno.'));
            return;
        }
        
        $data = array (
            'c_a' => $_POST['c_a'],
            'c_b' => $_POST['c_b'],
            'c_c' => $_POST['c_c'],
            'c_d' => $_POST['c_d'],
            'c_e' => $_POST['c_e'],
            'c_f' => $_POST['c_f'],
            'c_g' => $_POST['c_g'],
            'c_h' => $_POST['c_h'],
            'veneno' => $_POST['veneno']
        );

        if($this->db->insert("venenos",$data)){
            echo json_encode(array('error'=> false));
        }else{
            echo json_encode(array('error' => true,'msj'=> 'Error inesperado.'));
        }
    } 

    /* 
        * Function to save 'medicamento'
        * Return json
        * @param medicamento data
    */

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

    /* 
        * Function to edit 'medicamento'
        * Return json
        * @param medicamento data
    */

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

    /* 
        * Function to delete 'veneno'
        * Return message
        * @param veneno_id
    */
    
    public function delete(){
        $id = $this->uri->segment(4);
        
        $this->db->where("id",$id);
        if($this->db->delete("venenos")){
            echo true;
        }else{
            echo false;
        }
        
    }

    /* 
        * Function to delete 'medicamento'
        * Return message
        * @param veneno_id
    */

    public function delete_medi(){
        $id = $this->uri->segment(4);
        
        $this->db->where("id",$id);
        if($this->db->delete("medicamentos")){
            echo true;
        }else{
            echo false;
        }
        
    }

    /* 
        * Function to get 'venenos'
        * Return json
    */
    
    public function get_venenos(){
        $this->db->select('*');

        $result = $this->db->get("venenos");
        $response = $result->result();
        
         $array["data"]=$response;
                
         echo json_encode($array);
    }

    /* 
        * Function to get 'medicamentos'
        * Return json
    */

    public function get_medi(){
        $this->db->select('id,medicamento,nombre');
        $result = $this->db->get("medicamentos");
        $response = $result->result();
         $array["data"]=$response;
                
         echo json_encode($array);
    }

    /* 
        * Function to get 'medicamento'
        * Return json
    */
    
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