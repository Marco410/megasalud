<?php

/**
 * 
 */
class Producto extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAll() {
		
		return $this->db->get('productos');
		
	}

	public function save($producto, $id = null ,$type = false) {
		
        if( !$type ) {
			return $this->db->insert('productos', $producto);
		}

		return $this->db->update('productos', $producto, array('id' => $id));
	}
    
    public function nuevo($data,$id_suc){
        $this->db->insert('productos', $data);
        $id_pro = $this->db->insert_id();
        $pro_suc = array(
                    'id_pro' => $id_pro,
                    'id_suc' => $id_suc
                );
            
         return $this->db->insert('productos_sucursal',$pro_suc);
    } 
    
    public function nuevo_suc($data){
        return $this->db->insert('productos', $data);
    }

	public function find($id) {

		$this->db->where('id', $id);
		return $this->db->get('productos');

	}
    
     public function new_entrada($data){
        $this->db->set('existencia','existencia +'.$data['existencia'],FALSE);
        $this->db->where('id', $data['id_pro']);
        return $this->db->update('productos');
    }

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('productos');
		return $this->db->affected_rows();
	}

}