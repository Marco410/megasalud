<?php 

class MedicController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    /* 
      * Function to get view "Escuela"
      * Return json data
      * @param sucursal_id, name
    */ 

	public function escuela() {

		session_redirect();

		$data = array();
    $data['title'] = 'Escuela';
    $data['view_controller'] = 'medic_vs.js';
    $data['view_style'] = array(1=>'reproductor.css',
                                2=>'video-js.css'
                                );
    $data['view'] = 'video.js';
    
    $this->load->view('layout/head', $data);
    $this->load->view('layout/header');
    $type = $this->session->type;
      if($type == "Administrador" || $type == "Medico Administrador" || $type == "Medico" ){
        $this->load->view('medic/escuela', $data);
    }else{
      $this->load->view('auth/error'); 
    } 
    
    $this->load->view('layout/scripts');

	}

}