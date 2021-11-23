<?php 

class AccountantController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/rol');
	}

	public function index() {

		session_redirect();

		$data = array();
        $data['title'] = 'Contaduría';
        $data['view_controller'] = 'accountant_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Contador"){
            $this->load->view('accountant/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}
    
    public function his_citas(){
         $id = $this->session->id;
         $this->db->select("u.nombre,p.id,p.clave_bancaria,p.telefono_a,h.motivo,h.created_at, CONCAT(p.nombre,' ',p.apellido_p,' ',p.apellido_m) as nombre_p");
         $this->db->from("hisclinic_historial h");
         $this->db->join("pacientes p", "h.id_paciente = p.id",'inner');
         $this->db->join("users u", "u.id = h.id_user",'inner');
         $result =  $this->db->get();
         $response = $result->result();
        
         $array["data"]=$response;
                
         echo json_encode($array);
    }

    public function his_consultas(){
      $id = $this->session->id;
      $this->db->select("u.nombre,c.id,p.clave_bancaria,p.telefono_a,c.motivo,c.termino,c.created_at,c.fecha_termino, CONCAT(p.nombre,' ',p.apellido_p,' ',p.apellido_m) as nombre_p");
      $this->db->from("consultas c");
      $this->db->join("pacientes p", "c.id_paciente = p.id",'inner');
      $this->db->join("users u", "u.id = c.id_user",'inner');
      $result =  $this->db->get();
      $response = $result->result();
     
      $array["data"]=$response;
             
      echo json_encode($array);
 }
}