<?php

/**
 * 
 */
class Sucursal extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAll() {
		
		return $this->db->get('sucursales');
		
	}

	public function save($sucursal, $id = null ,$type = false) {
		
        if( !$type ) {
			return $this->db->insert('sucursales', $sucursal);
		}

		return $this->db->update('sucursales', $sucursal, array('id' => $id));
	}

	public function find($id) {

		$this->db->where('id', $id);
		return $this->db->get('sucursales');

	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('permisos');
		return $this->db->affected_rows();
	}

}