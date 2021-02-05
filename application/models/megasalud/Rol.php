<?php

/**
 * 
 */
class Rol extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAll() {

		return $this->db->get('roles');
		
	}

	public function save($data, $id = null ,$type = false) {

		$permisos_rol = array();

		$this->db->trans_start();
		//insert
		if( !$type ) {

			$this->db->insert('roles', $data['rol']);
			$id = $this->db->insert_id();

			
		}else{//update

			$this->db->update('roles', $data['rol'], array('id' => $id));

			$this->db->where('rol_id', $id);
			$this->db->delete('permiso_rol');

		}

		if(!is_null($data['permisos'])){
			foreach (array_keys($data['permisos']) as $permiso) {
				array_push($permisos_rol, array('rol_id' => $id, 'permiso_id' => $permiso));
			}
			$this->db->insert_batch('permiso_rol', $permisos_rol);
		}


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}

		return true;
	}

	public function find($id) {

		$this->db->where('id', $id);
		return $this->db->get('roles');

	}

	public function isAvailable($rol, $id) {

		$this->db->where('name', $rol);

		//en caso de update agregar restriccion de id
		if( !is_null($id) ){
			
			$this->db->where('id !=', $id);
		}

		$res = $this->db->get('roles');

		if( $res->num_rows() > 0 ){
			return 'Ya existe un rol con este nombre';
		}
		return 'true';

	}
}