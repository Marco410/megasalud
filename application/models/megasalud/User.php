<?php

/**
 * 
 */
class User extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAll($type = 'array'){

        $response = null;

        switch ($this->session->userdata('type')) {

            case 'Administrador':
            $this->db->select('u.*, r.name'); 
            $this->db->from('users u, roles r ');
            $this->db->join('rol_user ru', 'ru.user_id = u.id and ru.rol_id = r.id', 'inner');
            $result = $this->db->get();
            $response = $result->result();
            break;

            case 'Medico Administrador':
            $this->db->select('u.*,r.name');
            $this->db->from('users u, roles r');
            $this->db->join('sucursal_user su', 'su.user_id = u.id', 'inner');
            $this->db->join('rol_user ru', 'ru.user_id = u.id and ru.rol_id = r.id', 'inner');
            $this->db->where('su.sucursal_id', $this->session->userdata('sucursal'));
            $result = $this->db->get();
            $response = $result->result();
            break;
        }

        if( $type == 'json' ) {
            return json_encode($response);
        }

        return $response;
    }

	public function getAllPermisoRol() {

		$rol_permisos = array();

		$this->db->select('pr.*, p.display_name');
		$this->db->from('permiso_rol pr');
		$this->db->join('permisos p', 'pr.permiso_id = p.id', 'inner');
		$this->db->order_by("pr.rol_id", "asc");
		$res = $this->db->get();

		foreach ($res->result_array() as $row) {

			if(isset($rol_permisos[$row['rol_id']])){
				array_push($rol_permisos[$row['rol_id']], $row['display_name']);
			}else{
				$rol_permisos[$row['rol_id']] = array($row['display_name']);
			}
			
		}
		return $rol_permisos;
	}

	public function save($permiso, $id = null ,$type = false) {
		if( !$type ) {
			return $this->db->insert('permisos', $permiso);
		}

		return $this->db->update('permisos', $permiso, array('id' => $id));
	}

	public function find($id) {

		$this->db->where('id', $id);
		return $this->db->get('permisos');

	}

	public function findPermisosByRolId($id, $column = 'display_name') {

		$permisos = array();

		$this->db->select('pr.*, p.*');
		$this->db->from('permiso_rol pr');
		$this->db->join('permisos p', 'pr.permiso_id = p.id', 'inner');
		$this->db->where('pr.rol_id', $id);
		$res = $this->db->get();

		foreach ($res->result_array() as $row) {

			array_push($permisos, $row[$column]);
			
		}
		return $permisos;
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('permisos');
		return $this->db->affected_rows();
	}

	public function isAvailable($permiso, $id) {

		$this->db->where('name', $permiso);

		//en caso de update agregar restriccion de id
		if( !is_null($id) ){
			
			$this->db->where('id !=', $id);
		}

		$res = $this->db->get('permisos');

		if( $res->num_rows() > 0 ){
			return 'Ya existe un permiso con este nombre';
		}
		return 'true';

	}
}