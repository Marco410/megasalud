<?php

/**
 * 
 */
class Agent extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	public function find($id) {

		$this->db->where('id', $id);
		return $this->db->get('agents')->row();

	}
    
    public function get_comisiones_pen($id) {

        $this->db->where('id_agent', $id);
        $this->db->where('status', 'Pendiente');
        $this->db->select_sum('comision');
        $query = $this->db->get('agent_comision');
        
        if($query->row()->comision == ""){
             return 0 ;
        }else{
             return $query->row()->comision ;
        }

	}
    
    public function get_comisiones_pag($id) {

        $this->db->where('id_agent', $id);
        $this->db->where('status', 'Pagado');
        $this->db->select_sum('comision');
        $query = $this->db->get('agent_comision');
        
        if($query->row()->comision == ""){
             return 0 ;
        }else{
             return $query->row()->comision ;
        }
        
       

	}
    
    public function getPacientes_count($id){

        $response = null;
                
        $this->db->select('p.id,p.clave_bancaria,seguim,CONCAT(p.nombre," " , p.apellido_p, " ",p.apellido_m) AS nombre,p.email,p.telefono_a,p.estado');
        $this->db->from('pacientes p');
        $this->db->join('agent_paciente ap', 'ap.id_paciente = p.id', 'inner');
        
        $this->db->where('ap.id_agent', $id);
        $this->db->where('seguim', 1);
        return $this->db->count_all_results();
      
    }
    
    function count_a_p($id){
        
        $this->db->where('id_paciente',$id);
        return $this->db->count_all_results('agent_paciente');
    }
    function count_u_p($id){
        $this->db->where('id_paciente',$id);
        return $this->db->count_all_results('user_paciente');
    }
    function count_s_p($id){
        $this->db->where('id_paciente',$id);
        return $this->db->count_all_results('sucursal_paciente_com');
    } 
    function find_a_p($id){
        $this->db->where('id_paciente',$id);
        return $this->db->get('agent_paciente');
    }
    function find_u_p($id){
        $this->db->where('id_paciente',$id);
        return $this->db->get('user_paciente');
    }
    function find_s_p($id){
        $this->db->where('id_paciente',$id);
        return $this->db->get('sucursal_paciente_com');
    }
    
    function get_com($id){
            $this->db->where('id', $id);
		return $this->db->get('config_site');
    }
    
    function pagar_com($id_paciente,$id_pedido,$total,$des){
       
            $count_a_p = $this->count_a_p($id_paciente);
            $count_u_p = $this->count_u_p($id_paciente);
            $count_s_p = $this->count_s_p($id_paciente);
            
            //pago de comisiones
            if($count_a_p == 1 ){
                $a_p=$this->agent->find_a_p($id_paciente)->row();
                $com_a= $this->get_com(1)->row();
                $com = $this->porcentaje($total,$com_a->option_value,00);
                
                $dataCom = array(
                'id_agent' => $a_p->id_agent,
                'id_paciente' => $a_p->id_paciente,
                'id_pedido' => $id_pedido,
                'comision' => $com,
                'descripcion' => $des
                );
                
                $this->db->insert('agent_comision',$dataCom);
                
            }else if ($count_u_p == 1){
                
                $u_p=$this->agent->find_u_p($id_paciente)->row();
                $com_u= $this->get_com(2)->row();
                $com2 = $this->porcentaje($total,$com_u->option_value,00);
                
                $dataCom = array(
                'id_user' => $u_p->id_user,
                'id_paciente' => $u_p->id_paciente,
                'id_pedido' => $id_pedido,
                'comision' => $com2,
                'descripcion'=> $des
                );
                
                $this->db->insert('user_comision',$dataCom);
                
            }
        else if ($count_s_p == 1){
                
                $s_p=$this->agent->find_s_p($id_paciente)->row();
                $com_s= $this->get_com(3)->row();
                $com3 = $this->porcentaje($total,$com_s->option_value,00);
                
                $dataCom = array(
                'id_suc' => $s_p->id_sucursal,
                'id_paciente' => $s_p->id_paciente,
                'id_pedido' => $id_pedido,
                'comision' => $com3,
                'descripcion'=> $des
                );
                
                $this->db->insert('sucursal_comision',$dataCom);
                
            }
        
    }
    
    function porcentaje($cantidad,$porciento,$decimales){
        
        return number_format($cantidad*$porciento/100 ,$decimales);

        }
	
}