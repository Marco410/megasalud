<?php

class LineaVidaController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/historia');
    }

    /* 
      * Function to get view Linea de Vida
      * Return view
      * @param paciente_id
    */ 

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

    /* 
      * Function to get data linea
      * Return json
      * @param paciente_id
    */ 

    public function get_linea(){
        $id = $_POST["id"];

        $result = $this->historia->linea_vida($id);
        $row = $result->result();
        $response = array();
        $response['data'] = $result->result_array();
        echo json_encode($response);
    }

}