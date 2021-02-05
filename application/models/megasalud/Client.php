<?php

/**
 * 
 */
class Client extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getPacient($id) {
        
        $this->db->where("id",$id);
		return $this->db->get('pacientes');
		
	}
    
    public function getPedidos($id) {
        
        $this->db->where("paciente_id",$id);
		return $this->db->get('pedidos');
		
	}
    
    public function getPedido($id) {
        
        $this->db->where("id",$id);
		return $this->db->get('pedidos');
		
	}

	public function find($id) {

		$this->db->where('id', $id);
		return $this->db->get('roles');

	}

}