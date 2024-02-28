<?php 

class SettingsController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/settings');
	}

  /* 
    * Function to get view "Configuración"
    * Return view
  */

	public function index() {

		session_redirect();

		$data = array();
    $data['title'] = 'Configuración';
    $data['view_controller'] = 'settings_vs.js';
    $data['com_agent'] = $this->settings->get_com(1);
    $data['com_user'] = $this->settings->get_com(2);
    $data['com_suc'] = $this->settings->get_com(3);
    
    $this->load->view('layout/head', $data);
    $this->load->view('layout/header');
    
    $type = $this->session->type;
      if($type == "Administrador" || $type == "Medico Administrador"){
        $this->load->view('settings/index', $data);
    }else{
      $this->load->view('auth/error'); 
    } 
    
    $this->load->view('layout/scripts');
	}

  /* 
    * Function to get view "Configuración Sistema"
    * Return view
  */
    
  public function sistema() {

		session_redirect();

		$data = array();
    $data['title'] = 'Configuración';
    $data['view_controller'] = 'settings_vs.js';
    
    $this->load->view('layout/head', $data);
    $this->load->view('layout/header');
    
    $type = $this->session->type;
      if($type == "Administrador" || $type == "Medico Administrador"){
        $this->load->view('settings/sistema', $data);
    }else{
      $this->load->view('auth/error'); 
    } 
    
    $this->load->view('layout/scripts');

	}

  /* 
    * Function to add option "motivo de consulta"
    * @param option
  */
    
  public function add_motivo_consulta() {
      
      $dato = $this->input->post('motivo_consulta');
    
      $this->settings->add_motivo_consulta($dato);
  } 

  /* 
    * Function to add option "enfermedad congénita"
    * @param option
  */
    
  public function add_enf_cong() {
      
      $dato = $this->input->post('enf_cong');
      
      $this->settings->add_enf_cong($dato);
  }

  /* 
    * Function to add option "medicamento"
    * @param option
  */
  
  public function add_medicamento() {
      $dato = $this->input->post('medicamento');
    
      $this->settings->add_medicamento($dato);
      
  }

  /* 
    * Function to add option "vacuna"
    * @param option
  */

  public function add_vacuna() {
      $dato = $this->input->post('vacuna');
      
      $this->settings->add_vacuna($dato);
  } 

  /* 
    * Function to add option "alergia"
    * @param option
  */
  
  public function add_alergia() {
    $dato = $this->input->post('alergia');
    $this->settings->add_alergia($dato);
      
  }  

  /* 
    * Function to add option "tratamiento alergia"
    * @param option
  */
  
  public function add_trat_alergia() {
    $dato = $this->input->post('trat_ale');
      $this->settings->add_trat_alergia($dato);
      
  } 

  /* 
    * Function to add option "causa de hospitalización"
    * @param option
  */
  
  public function add_hospi_causa() {
    $dato = $this->input->post('hospi_causa');
      $this->settings->add_hospi_causa($dato);
      
  }

  /* 
    * Function to add option "operación hospitalización"
    * @param option
  */
  
  public function add_hospi_operacion() {
    $dato = $this->input->post('hospi_operacion');
      $this->settings->add_hospi_operacion($dato);
      
  }

  /* 
    * Function to add option "anestesia hospitalización"
    * @param option
  */
  
  public function add_hospi_ane() {
    $dato = $this->input->post('hospi_ane');
      $this->settings->add_hospi_ane($dato);
      
  }

  /* 
    * Function to add option "transfusión hospitalización"
    * @param option
  */
  
  public function add_hospi_trans() {
    $dato = $this->input->post('hospi_trans');
      $this->settings->add_hospi_trans($dato);
  } 

  /* 
    * Function to add option "protesis hospitalización"
    * @param option
  */
  
  public function add_hospi_pro() {
    $dato = $this->input->post('hospi_pro');
    $this->settings->add_hospi_pro($dato);
      
  } 

  /* 
    * Function to update % comisión
    * return json
    * @param com_id
  */
  
  public function update_com() {
  
    $id = $this->input->post('id_com');
    
    if($id == 1){
        $com = $this->input->post('com_agent');
    }else if ($id == 2){
        $com = $this->input->post('com_user');
    }else{
        $com = $this->input->post('com_suc');
    }

    $data =  array(
    'option_value' => $com
    );
    
    $this->db->where('id', $id);
    $this->db->update('config_site', $data);
  
    echo json_encode($data);
  }
}