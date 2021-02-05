<?php

/**
 * 
 */
class Provider extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAll($type = 'array'){

        $response = null;
            $this->db->select('*'); 
            $this->db->where('status', 1); 
            $this->db->from('providers');
            $result = $this->db->get();
            $response = $result->result();
        return $response;
    }



	
}