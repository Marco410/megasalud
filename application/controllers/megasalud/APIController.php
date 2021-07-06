<?php 

class APIController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function pacientes_notas() {

		session_redirect();
        
        for ($i = 900; $i <= 905; $i++){
            $this->db->select("p.nombre, hn.nota, hn.created_at");
            $this->db->from("hisclinic_notas hn");
            $this->db->join('pacientes p', 'p.id = hn.paciente_id', 'inner');
            $this->db->where("p.id",$i);
            $this->db->group_by("p.id");
            $result =  $this->db->get();
            $response = $result->result();
             
            $array["paciente".strval($i)] += $response;
        }
        
         echo json_encode($array);

	}
    
}   