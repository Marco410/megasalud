<?php

/**
 * 
 */
class Orders extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    
    
    public function find($id) {

		$this->db->where('id', $id);
		return $this->db->get('pedidos');

	} 
    
    public function abonos($id) {

		$this->db->where('id_pedido', $id);
		return $this->db->get('pedidos_abono');

	}
    
    public function abonos_get() {

		return $this->db->get('pedidos_abono');

	}
    
    public function update($order, $id = null ,$type = false) {
        if( !$type ) {
		}
		return $this->db->update('pedidos', $order, array('id' => $id));
	}
    
    public function get_item_cantidad($id_item){
        $this->db->select("cantidad");
        $this->db->where('id', $id_item);
		return $this->db->get("carrito");
        
    }
    
    
}

