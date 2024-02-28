<?php

class AlmacenController extends CI_Controller {
    
     public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/almacen');
    }

    /* 
        * Function to get view "almacen"
        * Return view
    */

    public function index(){

        session_redirect();

        $data = array();
        $data['title'] = 'Almacen';
        $data['data'] = $this->getAll();
        $data['view_controller'] = 'almacen_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type == "Atención a Clientes" ){
            $this->load->view('almacen/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }

    /* 
        * Function get view to create new "producto de almacén"
        * Return view
    */

    public function create(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nuevo producto de almacén';
        $data['view_controller'] = 'almacen_vs.js';
     
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type == "Atención a Clientes" ){
            $this->load->view('almacen/create');
        }else{
          $this->load->view('auth/error'); 
        } 
        $this->load->view('layout/scripts', $data);
    }

    /* 
        * Function get view to create new "entrada"
        * Return view
    */
    
    public function entrada(){

        session_redirect();

        $data = array();
        $data['title'] = 'Entrada';
        $data['data'] = $this->getAll();
        $data['providers'] = $this->getProv();
        $data['view_controller'] = 'almacen_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type == "Atención a Clientes" ){
            $this->load->view('almacen/entrada', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }

    /* 
        * Function to get view entradas
        * Return view
    */
    
    public function entrada_show(){

        session_redirect();

        $data = array();
        $data['title'] = 'Entradas';
        $data['entradas'] = $this->get_entradas();
        $data['view_controller'] = 'almacen_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type == "Atención a Clientes" ){
            $this->load->view('almacen/entrada-show', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }

    /* 
        * Function to get view salidas
        * Return view
    */

    public function salida(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nueva Salida';
        $data['data'] = $this->getAll_s();
        $data['view_controller'] = 'almacen_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type == "Atención a Clientes" ){
            $this->load->view('almacen/salida', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }

    /* 
        * Function to get view salidas
        * Return view
    */
    
    public function salida_show(){

        session_redirect();

        $data = array();
        $data['title'] = 'Salidas';
        $data['salidas'] = $this->get_salidas();
        $data['view_controller'] = 'almacen_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type == "Atención a Clientes" ){
            $this->load->view('almacen/salida-show', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }

    /* 
        * Function to get all data from almacen
        * Return almacen data
    */

    public function getAll(){

        $response = null;
        $this->db->where("status",1);
        $query = $this->db->get('almacen');
        $response = $query->result();

        return $response;
    }

    /* 
        * Function to get all data from almacen
        * Return almacen data where existencia > 0
    */
    
     public function getAll_s($type = 'array'){

        $response = null;
        $this->db->where("status",1);
        $this->db->where("existencia >" ,0);
        $query = $this->db->get('almacen');
        $response = $query->result();

        return $response;
    }

    /* 
        * Function to get all data from "proveedores"
        * Return providers data
    */
    
    public function getProv($type = 'array'){

        $response = null;
        $this->db->where("status",1);
        $query = $this->db->get('providers');
        $response = $query->result();

        return $response;
    }

    /* 
        * Function to save product data
        * Return providers data
    */
    
    public function save() {
        
        $data = array(
            'nombre' => $this->input->post('nombre'), 
            'descripcion' => $this->input->post('descripcion'),
            'clave_categoria' => $this->input->post('clave_categoria'),
            'existencia' => $this->input->post('existencia'),
            'status' => 1
        );

        if($this->almacen->nuevo($data)){

            echo json_encode($data);
        }
        else{
            echo false;
        }
    }
    
    /* 
        * Function to get almacen data
        * Return almacen data
        * @param id almacen
    */
     public function show(){

        $this->db->select('*');
        $this->db->from('almacen');
        $this->db->where('id', $this->uri->segment(4));
        $result = $this->db->get();
        $row = $result->row();
        $response = array();
        $response['data'] = $result->row_array();
        echo json_encode($response);
    } 
    
    /* 
        * Function to save "nueva entrada"
        * Return message error
        * @param id_almacen: id almacen, exis: count stock  
    */
    public function new_entrada() {
        
        $pro ="";
        $ban = false;
        $items1 = $_POST['id_almacen'];
        $items2 = $_POST['exis'];
        
         $size = count($_POST['id_almacen'])-1;
         
        for ($i = 0; $i <= $size ; $i++) {
            $data = array(
                'id_almacen' => $_POST['id_almacen'][$i],
                'existencia' => $_POST['exis'][$i]
            );
            $b = 1;
            $this->almacen->new_entrada($data,$b);
                
            $ban = true;
        }
         for ($i = 0; $i <= $size ; $i++) {
          
            $pro .= "Producto: " . $_POST['name'][$i] . ", Cantidad: " . $_POST['exis'][$i]."\n";
        }
         
         $data_entra = array(
             'proveedor' => $_POST['proveedor'],
             'factura' => $_POST['factura'],
             'productos' => $pro,
             'id_user' => $this->session->id
         );

        if($this->db->insert("almacen_entrada",$data_entra)){
            
        echo json_encode(array('error' => false));
        }
        else{
           echo json_encode(array('error' => true));
        }
    }

    /* 
        * Function to save "nueva salida"
        * Return message error
        * @param id_almacen: id almacen, exis: count stock  
    */
    
    public function new_salida() {
        
        $pro ="";
        $ban = false;
        $items1 = $_POST['id_almacen'];
        $items2 = $_POST['exis'];
        
         $size = count($_POST['id_almacen'])-1;
         
        for ($i = 0; $i <= $size ; $i++) {
            $data = array(
                'id_almacen' => $_POST['id_almacen'][$i],
                'existencia' => $_POST['exis'][$i]
            );
            $b = 2;
            
            $this->almacen->new_entrada($data,$b);
                
            $ban = true;
        }
         for ($i = 0; $i <= $size ; $i++) {
          
            $pro .= "Producto: " . $_POST['name'][$i] . ", Cantidad: " . $_POST['exis'][$i]."\n";
        }
         
         $data_entra = array(
             'entregado' => $_POST['entregado'],
             'productos' => $pro,
             'id_user' => $this->session->id
         );

        if($this->db->insert("almacen_salida",$data_entra)){
            
        echo json_encode(array('error' => false));
        }
        else{
           echo json_encode(array('error' => true));
        }
    }

    /* 
        * Function to get entradas
        * Return message entradas data
    */
    
    public function get_entradas(){
        
        $this->db->select('ae.id,u.nombre,ae.proveedor,ae.factura,ae.productos,ae.created_at');
        $this->db->from('almacen_entrada ae');
        $this->db->join('users u','u.id = ae.id_user', 'inner');    
        $result = $this->db->get();
        $response = $result->result();

        return $response;
    }

    /* 
        * Function to get entradas depending of almacen
        * These data are to fill datatable
        * Return entradas data
        * @param id_almacen
    */
    
    public function get_entradas_show(){

        $this->db->select('ae.id,u.nombre,ae.proveedor,ae.factura,ae.productos,ae.created_at');
        $this->db->from('almacen_entrada ae');
        $this->db->join('users u','u.id = ae.id_user', 'inner');  
        $this->db->where('ae.id', $this->uri->segment(4));
        $result = $this->db->get();
        $row = $result->row();
        $response = array();
        $response['data'] = $result->row_array();
        echo json_encode($response);
    } 

    /* 
        * Function to get salidas 
        * Return salidas data
    */
    
    public function get_salidas(){

        $this->db->select('ae.id,u.nombre,ae.entregado,ae.productos,ae.created_at');
        $this->db->from('almacen_salida ae');
        $this->db->join('users u','u.id = ae.id_user', 'inner');    
        $result = $this->db->get();
        $response = $result->result();

        return $response;
    }

     /* 
        * Function to get salidas depending of almacen
        * These data are to fill datatable
        * Return salidas data
        * @param id_almacen
    */
    
    public function get_salidas_show(){
        
        $this->db->select('ae.id,u.nombre,ae.entregado,ae.productos,ae.created_at');
        $this->db->from('almacen_salida ae');
        $this->db->join('users u','u.id = ae.id_user', 'inner');  
        $this->db->where('ae.id', $this->uri->segment(4));
        $result = $this->db->get();
        $row = $result->row();
        $response = array();
        $response['data'] = $result->row_array();

        echo json_encode($response);
    }

     /* 
        * Function to delete salidas y entradas depending of almacen
        * Return message error
        * @param id_almacen
    */
    
     public function delete(){

        $this->db->set('status', 0);
        $this->db->where('id', $this->uri->segment(4));

        if($this->db->update('almacen')){
            echo json_encode(array('error' => false));
        }
        else{
            echo json_encode(array('error' => true));
        }
    }

}