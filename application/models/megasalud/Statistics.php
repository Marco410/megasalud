<?php

/**
 * 
 */
class Statistics extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAll() {

		return $this->db->get('roles');
		
	}


}