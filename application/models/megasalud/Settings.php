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
        
    }
    
     public function add_enf_cong($dato) {
      
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
        
    }
    
    public function add_medicamento($dato) {
      
        $data =  array(
        'medicamento' => $dato
        );
          
        if($this->db->insert('medicamentos', $data)){

            echo json_encode(array('dat'=> $dato,'id' => 3));
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    }
    
    public function add_vacuna($dato) {
      
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
        
    } 
    
    public function add_alergia($dato) {
      
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
        
    }  
    
    public function add_trat_alergia($dato) {
      
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
        
    }
    
    public function add_hospi_causa($dato) {
      
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
        
    }
    
    public function add_hospi_operacion($dato) {
      
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
        
    }
    
    public function add_hospi_ane($dato) {
      
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
        
    } 
    public function add_hospi_trans($dato) {
      
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
        
    }
    
    public function add_hospi_pro($dato) {
      
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
        
    } 
    
     public function add_enf_virus($dato) {
      
        $data =  array(
        'enfermedad' => $dato,
        'tipo' => 'virus'
        );
          
        if($this->db->insert('enfermedades', $data)){
            
            $id_dat = $this->db->insert_id();
           echo json_encode(array('dat'=> $dato,'id' => 12,'id_dat'=> $id_dat));
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    }
    
        public function add_enf_bacteria($dato) {
      
        $data =  array(
        'enfermedad' => $dato,
        'tipo' => 'bacterias'
        );
          
        if($this->db->insert('enfermedades', $data)){

            echo json_encode(array('dat'=> $dato,'id' => 13));
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    }
    
    public function add_enf_hongos($dato) {
      
        $data =  array(
        'enfermedad' => $dato,
        'tipo' => 'hongos'
        );
          
        if($this->db->insert('enfermedades', $data)){

            echo json_encode(array('dat'=> $dato,'id' => 14));
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    }
    
    public function add_enf_parasitos($dato) {
      
        $data =  array(
        'enfermedad' => $dato,
        'tipo' => 'parasitos'
        );
          
        if($this->db->insert('enfermedades', $data)){

            echo json_encode(array('dat'=> $dato,'id' => 15));
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    }
    
     public function add_enf_psico($dato) {
      
        $data =  array(
        'enfermedad' => $dato,
        'tipo' => 'psico'
        );
          
        if($this->db->insert('enfermedades', $data)){

            echo json_encode(array('dat'=> $dato,'id' => 16));
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    }
    
    public function add_enf_otras($dato) {
      
        $data =  array(
        'enfermedad' => $dato,
        'tipo' => 'otras'
        );
          
        if($this->db->insert('enfermedades', $data)){

            echo json_encode(array('dat'=> $dato,'id' => 17));
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    }  
    
    public function add_terapia($dato) {
      
        $data =  array(
        'terapia' => $dato
        );
          
        if($this->db->insert('terapias', $data)){

            echo json_encode(array('dat'=> $dato,'id' => 18));
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    } 
    
    

}