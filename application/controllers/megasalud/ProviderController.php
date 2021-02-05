<?php 

class ProviderController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/provider');
    }

    public function index() {

        session_redirect();

        $data = array();
        $data['title'] = 'Provedores';
        $data['data'] = $this->provider->getAll();
        $data['view_controller'] = 'provider_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Contador"){
            $this->load->view('providers/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }

    public function create(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nuevo Proveedor';
        $data['view_controller'] = 'provider_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Contador"){
            $this->load->view('providers/create', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    } 
    
     public function edit(){

        session_redirect();

        $id = $this->uri->segment(3);

        $data = array();
        $data['title'] = 'Editar Proveedor';
        $data['prov'] = $this->getProvider($id);
        $data['view_controller'] = 'provider_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
         $type = $this->session->type;
         if($type == "Administrador" || $type == "Contador"){
            $this->load->view('providers/edit', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
    }
    
      public function getProvider($id){
        
        $this->db->where('id', $id);
        $query = $this->db->get('providers');
        return $query;
    }


    public function newEntry(){
        
         $data = array(
            'empresa' => $_POST["empresa"],
            'nombre_contacto' => $_POST["nombre_contacto"],
            'cargo_contacto' => $_POST["cargo_contacto"],
            'giro' => $_POST["giro"],
            'municipio' => $_POST["municipio"],
            'estado' => $_POST["estado"],
            'pais' => $_POST["pais"],
            'calle' => $_POST["calle"],
            'colonia' => $_POST['colonia'],
            'cp' => $_POST['cp'],
            'telefono' => $_POST["telefono"],
            'email' => $_POST["email"],
            'notas' => $_POST["notas"],
            'status' => 1
            
        );
        
         if($this->db->insert('providers', $data)){
                echo json_encode(array('error' => false));
            }
            else{
                echo json_encode(array('error' => true));
            }
    }
    
    public function editEntry(){
      
         $data = array(
            'empresa' => $_POST["empresa"],
            'nombre_contacto' => $_POST["nombre_contacto"],
            'cargo_contacto' => $_POST["cargo_contacto"],
            'giro' => $_POST["giro"],
            'municipio' => $_POST["municipio"],
            'estado' => $_POST["estado"],
            'pais' => $_POST["pais"],
            'calle' => $_POST["calle"],
            'colonia' => $_POST['colonia'],
            'cp' => $_POST['cp'],
            'telefono' => $_POST["telefono"],
            'email' => $_POST["email"],
            'notas' => $_POST["notas"]
            
        );
        
       
            $this->db->where('id', $_POST["id_provider"]);
         if($this->db->update('providers', $data)){
           
                echo json_encode(array('error' => false));
            }
            else{
               echo json_encode(array('error' => true));
            }
    }


    public function show(){

        $this->db->where('id', $this->uri->segment(4));
        $result = $this->db->get('providers');
        $row = $result->row();
        $response = array();
        $response['data'] = $result->row_array();
        

        echo json_encode($response);
    }

    public function delete(){

        $this->db->set('status', 0);
        $this->db->where('id', $this->uri->segment(4));

        if($this->db->update('providers')){
            echo json_encode(array('error' => false));
        }
        else{
            echo json_encode(array('error' => true));
        }
    }

}