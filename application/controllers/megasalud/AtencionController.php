<?php 

class AtencionController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('megasalud/historia');
	}

	public function pacientes() {

        session_redirect();

        $data = array();
        $data['title'] = 'Pacientes';
        $data['view_controller'] = 'atencion/atencion_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;

         if($type == "Administrador" || $type == "Atención a Clientes" ){
             $this->load->view('atencion/pacientes', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
        
	}

    public function ver_paciente($id){

        session_redirect();
        
        $data = array();    
        $data['title'] = 'Perfil Paciente';
        $data['paciente'] = $this->historia->find($id);
        $data['historial'] = $this->historia->historial($id);

        $data['view_controller'] = array(
            2 => 'historia_start_vs.js',
            1 => 'atencion/atencion_vs.js',
            );
        
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
        if($type == "Administrador" || $type == "Atención a Clientes" ){
                 $this->load->view('atencion/ver_paciente', $data);
        }else{
          $this->load->view('auth/error'); 
        }    
        $this->load->view('layout/scripts', $data);
    }

    public function prospectos() {

      session_redirect();

      $data = array();
      $data['title'] = 'Prospectos';
      $data['view_controller'] = 'atencion/atencion_vs.js';

      $this->load->view('layout/head', $data);
      $this->load->view('layout/header');
      $type = $this->session->type;

       if($type == "Administrador" || $type == "Atención a Clientes" ){
           $this->load->view('atencion/prospectos', $data);
      }else{
        $this->load->view('auth/error'); 
      }
      
      $this->load->view('layout/scripts', $data);
      
}

public function getAll(){

  $this->db->select('CONCAT(nombre," " , apellido_p, " ",apellido_m) AS nombre,telefono,enfermedad,ciudad,notas,created_at AS fecha ,id'); 
  $this->db->from('prospectos');
  $this->db->order_by('id', 'DESC');
  $query = $this->db->get();
      
  $response = $query->result();

  
  
   $array["data"]=$response;
          
   echo json_encode($array);
}

}