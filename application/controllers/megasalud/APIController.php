<?php 

class APIController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function pacientes_notas() {

		session_redirect();

        $this->db->select("p.nombre, hn.nota, hn.created_at");
        $this->db->from("hisclinic_notas hn");
        $this->db->join('pacientes p', 'p.id = hn.paciente_id', 'inner');
        $this->db->limit(4);
        $result =  $this->db->get();
        $response = $result->result();
        
        $array["data"]=$response;
                
         echo json_encode($array);

	}
    
}