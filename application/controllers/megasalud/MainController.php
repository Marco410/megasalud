<?php

class MainController extends CI_Controller {
    
     public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/Sucursal');
    }


    public function view($page = 'home')
    {
        if( ! $this->session->has_userdata('auth')){
            $page = 'login';
        }
        else{
            if($this->session->userdata('auth') == false){
                $this->session->sess_destroy();
                $page = 'login';
            }
            else{
                $page = 'home';
            }
        }

        redirect($page);
    }

    public function home()
    {
        if($this->session->userdata('auth') != true){
            redirect('login');
        }

        $data = array();
        $data['title'] = 'Inicio';
        $data['sucursales'] = $this->Sucursal->getAll();
        $data['view_controller'] = 'home_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('home');
        $this->load->view('layout/scripts', $data);
    }

    public function verify_password()
    {
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('id', $this->session->userdata('id'));
        $query = $this->db->get();
        $row = $query->row();

        if(password_verify($_POST['pass'], $row->password)) {
            echo true;
        }else{
            echo false;            
        }
    }
    
     public function add_comment() {
      
        $data =  array(
        'asunto' => $this->input->post('asunto'),
        'tipo' => $this->input->post('tipo'),
        'modulo' => $this->input->post('modulo'),
        'mensaje' => $this->input->post('mensaje'),
        'id_user' => $this->input->post('id_user')
        );
          
        if($this->db->insert('comentarios', $data)){

            echo json_encode($data);
        }
            else{
                echo json_encode(array('error' => true));
            }
        
    }
    
    public function update_suc(){
        
        $this->session->sucursal = $_POST['id'];
        $this->session->sucursal_name = $_POST['name'];
        
        echo json_encode(array('error' => false));
    }

}