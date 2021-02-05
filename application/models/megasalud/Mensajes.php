<?php

/**
 * 
 */
class Mensajes extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
 
    public function conversacion($id) {
		$this->db->where('id_paciente', $id);
		$this->db->order_by('created_at', 'asc');
		return $this->db->get('conversaciones')->num_rows();
	}   
    public function get_conversacion($id) {
		$this->db->where('id_paciente', $id);
		return $this->db->get('conversaciones')->row();
	} 
    
    public function get_conversaciones($id,$type) {
        if($type == "Administrador" || $type == "Medico Administrador"){
        }else{
		$this->db->where('c.id_user', $id);
        }
        $this->db->select("c.id_paciente,hm.mensaje, Date_format(hm.created_at, '%h:%i %p' ) as created_at,c.id,p.nombre,p.apellido_p,p.sexo,p.foto");
        $this->db->from('conversaciones c');
        $this->db->join('pacientes p', 'p.id = c.id_paciente', 'left');
        $this->db->join('hisclinic_msj hm', 'hm.id_conversacion = c.id', 'left');
        $this->db->group_by("c.id");
        $this->db->order_by('hm.created_at', 'DESC');
		return $this->db->get();
	} 
    
    public function mensajes($id) {
		$this->db->where('id_conversacion', $id);
		$this->db->order_by('created_at', 'asc');
		return $this->db->get('hisclinic_msj')->num_rows();
	}   
    public function get_mensajes($id) {
		$this->db->select("hm.mensaje,hm.remitente, Date_format(hm.created_at, '%d %b %Y | %h:%i %p' ) as created_at,hm.p,hm.u");
        $this->db->from('hisclinic_msj hm');
        $this->db->where('hm.id_conversacion', $id);
        $this->db->join('conversaciones c', 'hm.id_conversacion = c.id', 'inner');
        $this->db->order_by('hm.created_at', 'ASC');
        $result = $this->db->get();
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        echo json_encode($response);
	}  

}