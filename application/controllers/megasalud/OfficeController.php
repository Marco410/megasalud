<?php

class OfficeController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/sucursal');
    }

    public function index(){

        session_redirect();

        $data = array();
        $data['title'] = 'Sucursales';
        $data['sucursales'] = $this->sucursal->getAll();
        // $data['view_style'] = 'office.css';
        $data['view_controller'] = 'office_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador" ){
             $this->load->view('office/index', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
    }

    public function create(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nueva sucursal';
        // $data['view_style'] = 'office.css';
        $data['view_controller'] = 'office_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
        if($type == "Administrador" ){
         $this->load->view('office/create', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        $this->load->view('layout/scripts', $data);
    }

    public function edit($id) {

        session_redirect();

        $data['title'] = 'Editar sucursal';
        $data['sucursal'] = $this->sucursal->find($id);
        $data['view_controller'] = 'office_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
        if($type == "Administrador" ){
          $this->load->view('office/edit', $data);
        }else{
          $this->load->view('auth/error'); 
        }
       
        $this->load->view('layout/scripts', $data);
    } 
    
    public function agenda($id) {

        session_redirect();

        $data['title'] = 'Agenda';
        $data['sucursal'] = $this->sucursal->find($id);
        $data['view_controller'] = 'office_vs.js';
       

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
         $type = $this->session->type;
         if($type == "Administrador" || $type="Contador"){
          $this->load->view('office/agenda', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        $this->load->view('layout/scripts', $data);
    }

    public function show(){

        $id = $this->uri->segment(4);

        echo json_encode($this->sucursal->find($id)->row_array());
    }

    public function save() {
        
        $sucursal = array(
            'razon_social' => $this->input->post('razon_social'), 
            'pais' => $this->input->post('pais'),
            'estado' => $this->input->post('estado'),
            'municipio' => $this->input->post('municipio'),
            'direccion' => $this->input->post('direccion'),
            'cp' => $this->input->post('cp'),
            'telefono' => $this->input->post('telefono'),
            'cuenta_bancaria' => $this->input->post('cuenta_bancaria'),
            'banco' => $this->input->post('banco'),
            'id_calendario' => $this->input->post('id_calendario'),
            'calendario' => $this->input->post('calendario')
        );

        if(isset($_POST['_method'])) {
            $res = $this->sucursal->save($sucursal, $_POST["id"], true);
        }else{
            $res = $this->sucursal->save($sucursal);          
        }

        if($res){
            echo true;
        }
        else{
            echo false;
        }
    }

}