<?php 

class SettingsController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/settings');
	}

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
    
     public function agregar_video() {
        
        $path = "assets/videos/tutoriales/";
         
         if($_POST["s_modulo"] == "administracion"){
              $p = "administracion";
         } else if($_POST["s_modulo"] == "ventas"){
              $p = "ventas";
         }else if($_POST["s_modulo"] == "representante"){
              $p = "representante";
         }else if($_POST["s_modulo"] == "pacientes"){
              $p = "pacientes";
         }else if($_POST["s_modulo"] == "almacen"){
              $p = "almacen";
         }else if($_POST["s_modulo"] == "medico"){
              $p = "medico";
         }else if($_POST["s_modulo"] == "estadisticas"){
              $p = "estadisticas";
         }else if($_POST["s_modulo"] == "configuracion"){
              $p = "configuracion";
         }
         
         
        if (!empty($_FILES['video_sbr']['name'])) {
            
            $video = $_FILES['video_sbr']['name'];
            
            
             move_uploaded_file($_FILES['video_sbr']['tmp_name'],"assets/videos/tutoriales/".$p."/".$video);
            
                    $data =  array(
                        'nombre' => $video,
                        'modulo' =>  $p,
                        'titulo' => $_POST["titulo_v"]
                        );

                    if($this->db->insert("videos",$data)){

                        echo json_encode(array('error' => false));
                        }
                        else{
                            echo json_encode(array('error' => true));
                        }
            
        }else{
            echo json_encode(array('error' => true,'type' => "Error: ".$_FILES["video_sbr"]["error"]));
        }

    }

	public function create() {

    	session_redirect();

    	$data = array();
        $data['title'] = 'Nuevo rol';
        $data['permisos'] = $this->permiso->getAll();
        $data['roles'] = $this->rol->getAll();
        $data['view_controller'] = 'roles_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('roles/create', $data);
        $this->load->view('layout/scripts', $data);

	}
    
    public function add_motivo_consulta() {
        
        $dato = $this->input->post('motivo_consulta');
      
        $this->settings->add_motivo_consulta($dato);
    } 
    
    public function add_enf_cong() {
        
        $dato = $this->input->post('enf_cong');
        
        $this->settings->add_enf_cong($dato);
    }
    
    public function add_medicamento() {
        $dato = $this->input->post('medicamento');
      
        $this->settings->add_medicamento($dato);
        
    }
    public function add_vacuna() {
        $dato = $this->input->post('vacuna');
        
        $this->settings->add_vacuna($dato);
    } 
    
    public function add_alergia() {
      $dato = $this->input->post('alergia');
      $this->settings->add_alergia($dato);
        
    }  
    
    public function add_trat_alergia() {
      $dato = $this->input->post('trat_ale');
       $this->settings->add_trat_alergia($dato);
        
    } 
    
    public function add_hospi_causa() {
      $dato = $this->input->post('hospi_causa');
       $this->settings->add_hospi_causa($dato);
        
    }
    
    public function add_hospi_operacion() {
      $dato = $this->input->post('hospi_operacion');
        $this->settings->add_hospi_operacion($dato);
        
    }
    
    public function add_hospi_ane() {
      $dato = $this->input->post('hospi_ane');
       $this->settings->add_hospi_ane($dato);
        
    }
    
    public function add_hospi_trans() {
      $dato = $this->input->post('hospi_trans');
       $this->settings->add_hospi_trans($dato);
    } 
    
    public function add_hospi_pro() {
      $dato = $this->input->post('hospi_pro');
       $this->settings->add_hospi_pro($dato);
        
    } 
    
    public function add_enf_virus() {
      $dato = $this->input->post('enf_virus');
       $this->settings->add_hospi_pro($dato);
        
    }
    
    public function add_enf_bacteria() {
      $dato = $this->input->post('enf_bacteria');
       $this->settings->add_enf_bacteria($dato);
        
    }
    
    public function add_enf_hongos() {
      $dato = $this->input->post('enf_hongos');
        $this->settings->add_enf_hongos($dato);
        
    }
    
    public function add_enf_parasitos() {
      $dato = $this->input->post('enf_parasitos');
        $this->settings->add_enf_parasitos($dato);
        
    }
    
    public function add_enf_psico() {
      $dato = $this->input->post('enf_psico');
        $this->settings->add_enf_psico($dato);
        
    }
    
    public function add_enf_otras() {
      $dato = $this->input->post('enf_otras');
        $this->settings->add_enf_otras($dato);
        
    } 
    
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