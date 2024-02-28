<?php 

class DataController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    /* 
      * Function to get medicamentos
      * Return json data
    */ 

	public function get_medicamentos() {	
        session_redirect();
        $this->db->select('id,medicamento,sustancia');
        $this->db->from('medicamentos');
        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        echo json_encode($response);
	}
}   