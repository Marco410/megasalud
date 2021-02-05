<?php 

class ClientController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/Client');
		$this->load->model('megasalud/Historia');
		$this->load->model('megasalud/Pagos');
        $this->load->model('megasalud/mensajes');
	}

	public function index() {

		session_redirect();
        $id = $this->session->id;
		$data = array();
        $data['title'] = 'Paciente';
        $data['view_style'] = 'linea.css';
        $data['cliente'] = $this->Client->getPacient($id);
        $data['linea_vida'] = $this->Historia->linea_vida($id);
        $data['notas'] = $this->Historia->get_notas($id);
        $data['diagnosticos'] = $this->Historia->get_diagnostico($id);
        
        //mensajes
        $data['conversacion'] = $this->mensajes->conversacion($id);
        $data['gconversacion'] = $this->mensajes->get_conversacion($id);
        
        $data['view_controller'] = array(
            2 => 'client_vs.js',
            1 => 'messenger_vs.js');

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
          if($type == "Administrador" || $type == "Paciente"){
            $this->load->view('client/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}
    public function pedidos() {

		session_redirect();
        $id = $this->session->id;
		$data = array();
        $data['title'] = 'Pedidos';
        $data['cliente'] = $this->Client->getPacient($id);
        $data['pedidos'] = $this->Client->getPedidos($id);
        $data['view_controller'] = 'client_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
          if($type == "Administrador" || $type == "Paciente"){
            $this->load->view('client/pedidosC', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}  
    public function estudios() {

		session_redirect();
        $id = $this->session->id;
		$data = array();
        $data['title'] = 'Tus Estudios';
        $data['paciente'] = $this->Client->getPacient($id);
        $data['estudios'] = $this->Historia->estudios($id);  
        $data['view_controller'] = 'client_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
          if($type == "Administrador" || $type == "Paciente"){
            $this->load->view('client/estudiosC');
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}
    
     public function charts() {

        session_redirect();
        $id = $this->session->id;
        $data['title'] = 'Mis Gráficas';
        $data['paciente'] = $this->Historia->find($id);
        $data['charts'] = $this->Historia->find_charts($id);
        $data['view_controller'] = array(
            1 =>'client_vs.js',
            2 =>'charts_vs.js' );
        $data['view'] = 'chart.min.js';
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
         $type = $this->session->type;
         if($type == "Administrador" || $type == "Paciente" ){
             $this->load->view('client/charts', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
    }
    
    public function mostrar($id_pe) {

		session_redirect();
        $id = $this->session->id;
		$data = array();
        $data['title'] = 'Pedido';
        $data['order'] = $this->Client->getPedido($id_pe);
        $data['view_controller'] = 'client_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
          if($type == "Administrador" || $type == "Paciente"){
            $this->load->view('client/pedidoC', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}
    
    public function pagar($id_pe) {

		session_redirect();
        $id = $this->session->id;
		$data = array();
        $data['title'] = 'Pedido';
        $data['order'] = $this->Client->getPedido($id_pe);
        //le pasamos esta variable para que des comente los js de openpay
        $data['openPayjs'] = "-";
        $data['view_controller'] = array(
            1 =>'client_vs.js'  ,       
            2 =>'openpay/open-paciente.js'
             );

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
          if($type == "Administrador" || $type == "Paciente"){
            $this->load->view('client/pagarC', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}
    
        public function chargeCard(){
       
        $customer = array(
             'name' => $_POST["name"],
             'phone_number' => $_POST["phone_number"],
             'email' => $_POST["email"],);

        $chargeData = array(
            'method' => 'card',
            'source_id' => $_POST["token_id"],
            'amount' => $_POST["amount"], // formato númerico con hasta dos dígitos decimales. 
            'description' => $_POST["description"],
            'use_card_points' => $_POST["use_card_points"], // Opcional, si estamos usando puntos
            'device_session_id' => $_POST["device_session_id"],
            'customer' => $customer
            );

            return $this->Pagos->pagoTarjeta($chargeData);
        
         }
    
        public function updateP(){
            
            $id_p = $_POST["id_p"];
            
            $this->db->set('status','Pagado',FALSE);
            $this->db->where("id", $id_p);
            $this->db->update("pedidos");
            
             echo json_encode(array('error' => false));
            
        }


}