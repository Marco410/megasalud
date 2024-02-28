<?php 

class MessengerController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('megasalud/mensajes');
	}

    /* 
      * Function to get view "Mensajes"
      * Return view
    */ 
    
    public function index() {

		session_redirect();
        $id = $this->session->id;
        $type = $this->session->type;
		$data = array();
        $data['title'] = 'Mensajes';
        $data['view_controller'] = 'messenger_vs.js';
        $data['conversaciones'] = $this->mensajes->get_conversaciones($id,$type);

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
          if($type == "Administrador" || $type == "Medico Administrador" || $type =="Medico"){
            $this->load->view('messenger/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts');
	}  

    /* 
      * Function to initialize new conversation
      * Return json
      * @param paciente
    */ 
    
    public function newConver(){
        
        if($_POST["type"] == "paciente"){
            $id_user = 000001;
        }else{
            $id_user = $this->session->id;
        }
        
         $data = array(
            'id_paciente' => $_POST['id_paciente'],
            'id_user' => $id_user
        );
        
        if($this->db->insert("conversaciones",$data)){
            
            echo json_encode(array('error' => "false",'id'=>  $this->db->insert_id() ));
        }else{
             echo json_encode(array('error' => "true"));
        }
        
    }

    /* 
      * Function to get messages
      * Return messages data
      * @param conversacion_id
    */ 
    
    public function getMsj(){
        
       return $this->mensajes->get_mensajes($_POST["id_con"]);
        
    }

    /* 
      * Function to save new message
      * Return json
      * @param message, conversacion_id
    */ 
    
    public function newMsj(){
        
        if($_POST["typeConver"] == "paciente"){
           $p = 1;
            $u = 0;
        }else{
            $u = 1;
            $p = 0;
        }
        
        $data = array(
            'mensaje' => $_POST["mensaje"],
            'id_conversacion' => $_POST["id_conver"],
            'remitente' => $this->session->name,
            'p' => $p,
            'u' => $u
            
        );
        
        if($this->db->insert("hisclinic_msj",$data)){
            
            echo json_encode(array('error' => "false",'mensaje' => $_POST["mensaje"],'remitente'=>$this->session->name,'u' => $u, 'p' => $p));
        }else{
             echo json_encode(array('error' => "true"));
        }
    }


}