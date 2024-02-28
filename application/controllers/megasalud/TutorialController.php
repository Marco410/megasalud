<?php 

class TutorialController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    /* 
        * Function to get view "Tutoriales Médico"
        * Return view
    */

	public function medico() {

		session_redirect();

		$data = array();
        $data['title'] = 'Tutoriales Médico';
        $data['view_controller'] = 'tutorial_vs.js';
        $data['view_style'] = array(1=>'reproductor.css',
                                    2=>'video-js.css'
                                   );
        $data['view'] = 'video.js';
        $data['tutoriales'] = $this->getTutorialesMedico();
        
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador" || $type == "Medico" ){
            $this->load->view('tutoriales/medico', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}

     /* 
        * Function to get "Tutoriales Médico
        * Return data
    */
    
    public function getTutorialesMedico(){
        $this->db->where("modulo","medico");
        $this->db->order_by("created_at","DESC");
        return $this->db->get("videos");
        
    }

}