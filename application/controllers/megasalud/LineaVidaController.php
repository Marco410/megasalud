<?php

class LineaVidaController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/historia');
    }

    public function index($id){

        session_redirect();

        $data = array();
        $data['title'] = 'Linea de Vida';
        $data['paciente'] = $this->historia->find($id);
        $data['linea_vida'] = $this->historia->linea_vida($id);

        $data['view_controller'] = 'pacients/linea_vida_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador"  || $type == "Medico" ){
             $this->load->view('linea_vida/index', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        
        $this->load->view('layout/scripts', $data);
    }

    public function get_linea(){
        $id = $_POST["id"];

        $result = $this->historia->linea_vida($id);
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        echo json_encode($response);
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