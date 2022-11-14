<?php

/**
 * 
 */
class Settings extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    
    function get_com($id){
            $this->db->where('id', $id);
		return $this->db->get('config_site');
    }
    
     public function add_motivo_consulta($dato) {
      
        $this->db->like('enfermedad', $dato);
        $res = $this->db->count_all_results('motivo_consulta');
        if($res == 0){
            $data =  array(
                'enfermedad' => $dato
                );
                    
                if($this->db->insert('motivo_consulta', $data)){
                    $id_m = $this->db->insert_id();

                    echo json_encode(array('dat'=> $dato,'id' => 1,'id_m' => $id_m));
                }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
      
    }
    
     public function add_enf_cong($dato) {
        $this->db->like('enfermedad', $dato);
        $res = $this->db->count_all_results('enfermedades');
        if($res == 0){
            $data =  array(
            'enfermedad' => $dato,
            'tipo' => 'congenita'
            );
                
            if($this->db->insert('enfermedades', $data)){
                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 2,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
        
    }
    
    public function add_medicamento($dato) {
        $this->db->like('medicamento', $dato);
        $res = $this->db->count_all_results('medicamentos');
        if($res == 0){
            $data =  array(
            'medicamento' => $dato
            );
            
            if($this->db->insert('medicamentos', $data)){
                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 3,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    }
    
    public function add_vacuna($dato) {
        $this->db->like('vacuna', $dato);
        $res = $this->db->count_all_results('vacunas');
        if($res == 0){
            $data =  array(
            'vacuna' => $dato
            );
            
            if($this->db->insert('vacunas', $data)){
                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 4,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    } 
    
    public function add_alergia($dato) {
        $this->db->like('alergeno', $dato);
        $res = $this->db->count_all_results('alergenos');
        if($res == 0){
            $data =  array(
            'alergeno' => $dato
            );
            
            if($this->db->insert('alergenos', $data)){
                
                $id_dat = $this->db->insert_id();

                echo json_encode(array('dat'=> $dato,'id' => 5,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    }  
    
    public function add_trat_alergia($dato) {
        $this->db->like('tratamiento_alergia', $dato);
        $res = $this->db->count_all_results('tratamiento_alergia');
        if($res == 0){
            $data =  array(
            'tratamiento_alergia' => $dato
            );
            
            if($this->db->insert('tratamiento_alergia', $data)){
                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 6,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    }
    
    public function add_hospi_causa($dato) {
        $this->db->like('causa', $dato);
        $res = $this->db->count_all_results('hospi_causa');
        if($res == 0){
            $data =  array(
            'causa' => $dato
            );
            
            if($this->db->insert('hospi_causa', $data)){
                
                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 7,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    }
    
    public function add_hospi_operacion($dato) {
        $this->db->like('tipo_operacion', $dato);
        $res = $this->db->count_all_results('hospi_operacion');
        if($res == 0){
            $data =  array(
            'tipo_operacion' => $dato
            );
            
            if($this->db->insert('hospi_operacion', $data)){
                
                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 8,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    }
    
    public function add_hospi_ane($dato) {
        $this->db->like('tipo_anestesia', $dato);
        $res = $this->db->count_all_results('hospi_anestesia');
        if($res == 0){
            $data =  array(
            'tipo_anestesia' => $dato
            );
            
            if($this->db->insert('hospi_anestesia', $data)){

                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 9,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    } 
    public function add_hospi_trans($dato) {
        $this->db->like('tipo_transfusion', $dato);
        $res = $this->db->count_all_results('hospi_transfusion');
        if($res == 0){
            $data =  array(
            'tipo_transfusion' => $dato
            );
            
            if($this->db->insert('hospi_transfusion', $data)){

                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 10,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    }
    
    public function add_hospi_pro($dato) {
        $this->db->like('tipo_protesis', $dato);
        $res = $this->db->count_all_results('hospi_protesis');
        if($res == 0){
            $data =  array(
            'tipo_protesis' => $dato
            );
            
            if($this->db->insert('hospi_protesis', $data)){

                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 11,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    } 
  
    
    public function add_terapia($dato) {
        $this->db->like('terapia', $dato);
        $res = $this->db->count_all_results('terapias');
        if($res == 0){
            $data =  array(
            'terapia' => $dato
            );
            
            if($this->db->insert('terapias', $data)){
                $id_dat = $this->db->insert_id();
                echo json_encode(array('dat'=> $dato,'id' => 18,'id_dat'=> $id_dat));
            }
                else{
                    echo json_encode(array('error' => true));
                }
        }else{
            echo json_encode(array('equal' => true));
        }
    } 

    public function add_producto_ven($dato) {
      
        $data =  array(
        'nombre_p' => $dato
        );

        $this->db->where('nombre_p', $dato);
		$query = $this->db->get('productos_ven');

        if ($query->num_rows() > 0){
            echo json_encode(array('error' => true,'msj'=> 'Ya existe este producto.'));
            return;
        }
          
        if($this->db->insert('productos_ven', $data)){
            $id_dat = $this->db->insert_id();
            echo json_encode(array('dat'=> $dato,'id' => 19,'id_dat'=> $id_dat));
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    } 
    
    

}