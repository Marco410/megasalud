<?php

/**
 * 
 */
class Comision extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getCom_Suc() {
        
        $this->db->select('sc.id, pa.nombre as nombrep, s.razon_social, sc.id_pedido, sc.comision, sc.status,sc.descripcion');
        $this->db->join('pacientes pa', 'pa.id = sc.id_paciente');
        $this->db->join('sucursales s', 's.id = sc.id_suc');
        $this->db->from('sucursal_comision sc');
        $result = $this->db->get();
        $response = $result->result();
        $array["data"]=$response;
                
        echo json_encode($array);
		
	}
    public function getCom_Agent() {
        
        $this->db->select('ac.id, pa.nombre as nombrep, a.nombre, ac.id_pedido, ac.comision, ac.status,ac.descripcion');
        $this->db->join('pacientes pa', 'pa.id = ac.id_paciente');
        $this->db->join('agents a', 'a.id = ac.id_agent');
        $this->db->from('agent_comision ac');
        $result = $this->db->get();
        $response = $result->result();
        $array["data"]=$response;
                
        echo json_encode($array);
		
	} 
    public function getCom_User() {
        
        $this->db->select('uc.id, pa.nombre as nombrep, u.nombre, uc.id_pedido, uc.comision, uc.status,uc.descripcion');
        $this->db->join('pacientes pa', 'pa.id = uc.id_paciente');
        $this->db->join('users u', 'u.id = uc.id_user');
        $this->db->from('user_comision uc');
        $result = $this->db->get();
        $response = $result->result();
        $array["data"]=$response;
                
        echo json_encode($array);
		
	}

}