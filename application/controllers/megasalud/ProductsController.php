<?php

class ProductsController extends CI_Controller {
    
     public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/producto');
        $this->load->model('megasalud/sucursal');
    }

    public function index(){

        session_redirect();

        $data = array();
        $data['title'] = 'Productos';
        $data['data'] = $this->getAll($this->session->sucursal);
        $data['sucursales'] = $this->sucursal->getAll();
        $data['view_controller'] = 'products_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type== "Gerente Sucursal" || $type== "Produccion" ){
            $this->load->view('products/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }

    public function create(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nuevo producto';
        // $data['view_style'] = 'products.css';
        $data['view_controller'] = 'products_vs.js';
        $data['sucursales'] = $this->sucursal->getAll();
     
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type== "Gerente Sucursal" ){
            $this->load->view('products/create', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }
    public function apartados(){
 
        session_redirect();
        $type = $this->session->type;
        if($type == "Administrador" || $type== "Contador"){
        $id = $this->uri->segment(3);
        }else{
            $id = $this->session->sucursal;
        }
        $data = array();
        $data['title'] = 'Productos Apartados';
        // $data['view_style'] = 'products.css';
        $data['view_controller'] = 'products_vs.js';
        $data['apartados'] = $this->getApartados($id);
        $data['suc'] = $this->getSuc($id);
     
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
       
         if($type == "Administrador" || $type== "Contador" || $type== "Gerente Sucursal" ){
            $this->load->view('products/apartados', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }
    
    public function entrada(){

        session_redirect();
        
        $type = $this->session->type;
        if($type == "Administrador" || $type== "Contador"){
        $id = $this->uri->segment(3);
        }else{
            $id = $this->session->sucursal;
        }

        $data = array();
        $data['title'] = 'Nueva Entrada';
        $data['view_controller'] = 'products_vs.js';
        $data['products'] = $this->getAll($id);
        $data['suc'] = $this->getSuc($id);
        $data['providers'] = $this->getProv();
     
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type== "Gerente Sucursal" ){
            $this->load->view('products/entrada', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts', $data);
    }
    
    public function entradas(){

        session_redirect();
        
         $type = $this->session->type;
        if($type == "Administrador" || $type== "Contador"){
        $id = $this->uri->segment(3);
        }else{
            $id = $this->session->sucursal;
        }

        $data = array();
        $data['title'] = 'Ver Entradas';
        $data['view_controller'] = 'products_vs.js';
        $data['entradas'] = $this->get_entradas($id);
        $data['suc'] = $this->getSuc($id);
        
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        
        $type = $this->session->type;
         if($type == "Administrador" || $type== "Contador" || $type== "Gerente Sucursal" ){
            $this->load->view('products/entrada-show', $data);
            }else{
              $this->load->view('auth/error'); 
            } 
        
        $this->load->view('layout/scripts', $data);
    }
    
     public function getProv(){

        $response = null;
        $this->db->where("status",1);
        $query = $this->db->get('providers');
        $response = $query->result();

        return $response;
    }
    
    public function getSuc($id){
        $this->db->select('razon_social');
        $this->db->from('sucursales');
        $this->db->where('id', $id);
        
        $result = $this->db->get();
        return $result->row()->razon_social;
    }

    public function getAll($id){

            $this->db->select('p.id, p.nombre,p.existencia,p.precio');
            $this->db->from('productos p');
            $this->db->join('productos_sucursal sp', 'sp.id_pro= p.id', 'inner');
            $this->db->where('sp.id_suc', $id);
            $this->db->where('status', 1);
            $result = $this->db->get();
            $response = $result->result();
            
        return $response;
    } 
    
    public function get_ps(){

            $this->db->select('p.id, p.nombre,p.existencia,p.precio');
            $this->db->from('productos p');
            $this->db->join('productos_sucursal sp', 'sp.id_pro= p.id', 'inner');
            $this->db->where('sp.id_suc', $_POST['suc']);
            $this->db->where('status', 1);
            $result = $this->db->get();
            $response = $result->result();
            
            echo json_encode($response);
    }
    
    public function getApartados($id){


        $this->db->select('c.id, c.id_pro, c.producto, c.cantidad, p.nombre,p.id as id_paciente, c.created_at');
        $this->db->from('carrito c');
        $this->db->join('productos_sucursal sp', 'sp.id_pro= c.id_pro', 'inner');
        $this->db->join('pacientes p', 'p.id= c.id_paciente', 'inner');
        $this->db->join('sucursales s', 's.id = sp.id_suc');
        $this->db->where('s.id',$id);
        $this->db->order_by('c.id', 'DESC');
        $result = $this->db->get();
        $response = $result->result();
            

        return $response;
    }
    
    public function save() {
        
         $imagen_pro = 'imagen_pro';
         
         $path = "productos_img/";
         

        $config['upload_path'] = "assets/productos_img/";  
        $config['file_name'] = $this->input->post('nombre') ;
        $config['allowed_types'] = "*";
        $config['max_size'] = "5000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
         
        if ($this->upload->do_upload($imagen_pro)) {
            
            $imagen = $this->upload->data('file_name');
            
                    $data = array(
                        'nombre' => $this->input->post('nombre'), 
                        'descripcion' => $this->input->post('descripcion'),
                        'precio' => $this->input->post('precio'),
                        'existencia' => $this->input->post('existencia'),
                        'imagen' => $imagen
                    );
            $id_suc = $this->input->post('sucursal');

            if($this->producto->nuevo($data, $id_suc)){
                
                echo json_encode($data);
                }
                else{
                    echo false;
                }
            
        }else{
            echo $this->upload->display_errors();
        }
      
    }
    
     public function new_entrada() {
         $pro ="";
        $ban = false;
        $items1 = $_POST['id_pro'];
        $items2 = $_POST['exis'];
        
         $size = count($_POST['id_pro'])-1;
         
        for ($i = 0; $i <= $size ; $i++) {
            $data = array(
                'id_pro' => $_POST['id_pro'][$i],
                'existencia' => $_POST['exis'][$i]
            );
            
            $this->producto->new_entrada($data);
                
            $ban = true;
        }
         for ($i = 0; $i <= $size ; $i++) {
          
            $pro .= "Producto: " . $_POST['name'][$i] . " Cantidad: " . $_POST['exis'][$i]."\n";
        }
         
         $data_entra = array(
             'proveedor' => $_POST['proveedor'],
             'factura' => $_POST['factura'],
             'productos' => $pro,
             'id_user' => $this->session->id
         );

        if($this->db->insert("productos_entrada",$data_entra)){
            $id_entra = $this->db->insert_id();
            $entra_suc = array(
                    'id_entra' => $id_entra,
                    'id_suc' => $_POST['id_suc']
                );
            $this->db->insert('productos_entrada_suc',$entra_suc);
        echo json_encode(array('error' => false));
        }
        else{
           echo json_encode(array('error' => true));
        }
    }
    
    public function get_entradas($id){

        
            $this->db->select('pe.id, pe.proveedor,pe.factura,pe.productos,pe.created_at');
            $this->db->from('productos_entrada pe');
            $this->db->join('productos_entrada_suc pes', 'pes.id_entra = pe.id', 'inner');
            $this->db->where('pes.id_suc', $id);
            $result = $this->db->get();
            $response = $result->result();
            

        return $response;
    }
    
        public function get_entradas_show(){

        
            $this->db->select('ae.id,u.nombre,ae.proveedor,ae.factura,ae.productos,ae.created_at');
            $this->db->from('productos_entrada ae');
            $this->db->join('users u','u.id = ae.id_user', 'inner');  
            $this->db->where('ae.id', $this->uri->segment(4));
            $result = $this->db->get();
            $row = $result->row();
            $response = array();
            $response['data'] = $result->row_array();
            echo json_encode($response);
            
    } 
    

}