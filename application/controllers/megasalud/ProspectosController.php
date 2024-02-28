<?php 

class ProspectosController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    /* 
      * Function to get view prospectos
      * Return view
    */

	public function index() {

		$data = array();
        $data['title'] = '';
        $data['view_controller'] = 'prospectos/prospectos_vs.js';

        $this->load->view('prospectos/index', $data);
        $this->load->view('layout/scripts');

	}

    /* 
      * Function to add new "prospecto"
      * Return json
    */

    public function newEntry() {
         
        $data =  array(
            
        'nombre' => $this->input->post('nombre'),
        'apellido_p' => $this->input->post('apellido_p'),
        'apellido_m' => $this->input->post('apellido_m'),
        'telefono' => $this->input->post('telefono'),
        'enfermedad' => $this->input->post('enfermedad'),
        'ciudad' => $this->input->post('ciudad'),
        'notas' => $this->input->post('notas'),
        );
         
        if($this->db->insert('prospectos', $data)){
            
            echo json_encode($data);
            }
        else{
            echo false;
        }
    }

}