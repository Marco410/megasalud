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

}