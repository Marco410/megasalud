<?php

/**
 * 
 */
class Almacen extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAll() {
		
		return $this->db->get('almacen');
		
	}

	public function save($producto, $id = null ,$type = false) {
		
        if( !$type ) {
			return $this->db->insert('productos', $producto);
		}

		return $this->db->update('productos', $producto, array('id' => $id));
	}

	/* 
        * Function to insert product data in almacen
        * Return providers data
		* @param: array data 
    */
    
    public function nuevo($data){
        return $this->db->insert('almacen', $data);
    }
    
   public function new_entrada($data, $b){
        if($b == 1){
            
            $this->db->set('existencia','existencia +'.$data['existencia'],FALSE);
            $this->db->where('id', $data['id_almacen']);
            
            return $this->db->update('almacen');
            
        } elseif ($b == 2){
            
             $this->db->set('existencia','existencia -'.$data['existencia'],FALSE);
            $this->db->where('id', $data['id_almacen']);
            
            return $this->db->update('almacen');
        }
       
    }

	public function find($id) {

		$this->db->where('id', $id);
		return $this->db->get('productos');

	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('productos');
		return $this->db->affected_rows();
	}

}