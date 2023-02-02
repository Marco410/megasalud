<?php

class OrdersController extends CI_Controller {
    
     public function __construct()
    {
        parent::__construct();
        $this->load->model('megasalud/orders');
        $this->load->model('megasalud/agent');
        $this->load->model('megasalud/Pagos');
        $this->load->model('megasalud/sucursal');
    }

    public function index(){

        session_redirect();

        $data = array();
        $data['title'] = 'Pedidos';
        $data['data'] = $this->getAll();
        $data['view_controller'] = 'orders_vs.js';
        $data['sucursales'] = $this->sucursal->getAll();
        

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
        if($type == "Administrador" || $type == "Contador" || $type == "Gerente Sucursal" || $type == "Produccion" ){
             $this->load->view('orders/index', $data); 
        }else{
          $this->load->view('auth/error'); 
        }
        $this->load->view('layout/scripts', $data);
    }

    public function create(){

        session_redirect();

        $data = array();
        $data['title'] = 'Nuevo pedido';
        $data['view_controller'] = 'orders_vs.js';
        
        $data['pacients'] = $this->getPacients();

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        
        $type = $this->session->type;
        if($type == "Administrador" || $type == "Contador" || $type == "Gerente Sucursal" ){
             $this->load->view('orders/create'); 
        }else{
          $this->load->view('auth/error'); 
        }
        $this->load->view('layout/scripts', $data);
    }
    
        public function edit($id) {

        session_redirect();

        $data['title'] = 'Editar Pedido';
        $data['order'] = $this->orders->find($id);
        $data['view_controller'] = 'orders_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
            
        $type = $this->session->type;
        if($type == "Administrador" || $type == "Contador" || $type == "Gerente Sucursal" ){
             $this->load->view('orders/edit', $data); 
            
        }else{
          $this->load->view('auth/error'); 
        }
        $this->load->view('layout/scripts', $data);
    }
    
    public function show($id) {

        session_redirect();

        $data['title'] = 'Mostrar Pedido';
        $data['order'] = $this->orders->find($id);
        $data['abonos'] = $this->orders->abonos($id);
        $data['view_controller'] = 'orders_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
        if($type == "Administrador" || $type == "Contador" || $type == "Gerente Sucursal" || $type == "Medico Administrador" || $type == "Medico" || $type == "Produccion" ){
             $this->load->view('orders/show', $data); 
            
        }else{
          $this->load->view('auth/error'); 
        }
        $this->load->view('layout/scripts', $data);
    }
    
    public function get_orders(){

        $this->db->select('p.id, pa.nombre as nombrep, u.nombre, p.importe, p.impuesto, p.total,p.created_at,p.fecha_pago,p.metodo,p.status');
        $this->db->join('pacientes pa', 'pa.id = p.paciente_id');
        $this->db->join('users u', 'u.id = p.user_id');
        $this->db->from('pedidos p');
        $this->db->join('pedidos_sucursal ps', 'ps.id_pedido = p.id', 'inner');
        $this->db->where('ps.id_sucursal', $_POST['suc']);
        $result = $this->db->get();
        $response = $result->result();

        echo json_encode($response);
    }
    
    public function get_abonos(){
        
        $this->db->select('a.id_pedido,pa.nombre as nombrep, u.nombre,a.abono,a.created_at');
        $this->db->join('pacientes pa', 'pa.id = a.id_paciente');
        $this->db->join('users u', 'u.id = a.id_user');
        $this->db->from('pedidos_abono a');
        $result = $this->db->get();
        $response = $result->result();
        
         $array["data"]=$response;
            
            echo json_encode($array);
        
    }
    
    
     public function receta($id){

        session_redirect();

        $data = array();
        $data['title'] = 'Receta';
        // $data['view_style'] = 'orders.css';
        $data['view_controller'] = 'orders_vs.js';
        
        $data['pacient'] = $this->getPacient($id);
        $data['count_carrito'] = $this->get_count_carrito($id);
        $data['products'] = $this->get_Products();

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
        if($type == "Administrador" || $type == "Contador" || $type == "Gerente Sucursal" || $type == "Medico Administrador" || $type == "Medico" ){
             $this->load->view('orders/receta', $data); 
            
        }else{
          $this->load->view('auth/error'); 
        }
        $this->load->view('layout/scripts', $data);
    }  
    public function carrito($id){

        session_redirect();

        $data = array();
        $data['title'] = 'Carrito';
        // $data['view_style'] = 'orders.css';
        $data['view_controller'] = 'orders_vs.js';
        
        $data['pacient'] = $this->getPacient($id);
        $data['count_carrito'] = $this->get_count_carrito($id);
        $data['carritos'] = $this->get_Carrito($id);
        $data['total_carrito'] = $this->get_total_carrito($id);
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
        if($type == "Administrador" || $type == "Contador" || $type == "Gerente Sucursal" || $type == "Medico Administrador" || $type == "Medico" ){
             $this->load->view('orders/carrito', $data); 
            
        }else{
          $this->load->view('auth/error'); 
        }
        $this->load->view('layout/scripts', $data);
    }
    
      public function update() {
        
        $order = array(
            'status' => $this->input->post('status'),
            'detalle' => $this->input->post('detalle')
        );

        if(isset($_POST['_method'])) {
            $res = $this->orders->update($order, $_POST["id"], true);
        }else{
            $res = $this->orders->update($order);          
        }

        if($res){
            echo true;
        }
        else{
            echo false;
        }
    }
    
    

    public function getAll($type = 'array'){
        $id_suc = $this->session->sucursal;
        $response = null;

        $this->db->select('p.id, pa.nombre as nombrep, u.nombre, p.importe, p.impuesto, p.total,p.fecha_pedido,p.fecha_pago,p.metodo,p.status,p.created_at');
        $this->db->join('pacientes pa', 'pa.id = p.paciente_id');
        $this->db->join('users u', 'u.id = p.user_id');
        $this->db->from('pedidos p');
        $this->db->join('sucursal_pacientes sp', 'sp.paciente_id = pa.id', 'inner');
        $this->db->join('pedidos_sucursal ps', 'ps.id_pedido = p.id', 'inner');
        $this->db->where('sp.sucursal_id', $id_suc);
        $this->db->where('ps.id_sucursal', $id_suc);
        $query = $this->db->get();
        $response = $query->result();

        if( $type == 'json' ) {
            return json_encode($response);
        }

        return $response;
    }
    
    public function getPacients($type = 'array'){

        $response = null;
        $this->db->select('p.id,p.clave_bancaria,CONCAT(p.nombre," " , p.apellido_p, " ",p.apellido_m) AS nombre,p.email,p.telefono_a,p.estado');
        $this->db->from('pacientes p');
        $this->db->join('sucursal_pacientes sp', 'sp.paciente_id = p.id', 'inner');
        $this->db->where('sp.sucursal_id', $this->session->userdata('sucursal'));
        $this->db->where('status', 1);
        $this->db->where('p.seguim >=', 1);
        $query = $this->db->get();
        $response = $query->result();

        if( $type == 'json' ) {
            return json_encode($response);
        }

        return $response;
    }
    
    public function getPacient($id) {

		$this->db->where('id', $id);
		return $this->db->get('pacientes');

	} 
    
    public function get_count_carrito($id) {

		$this->db->where('id_paciente', $id);
		return $this->db->count_all_results('carrito');

	}  
    
    public function get_total_carrito($id) {

		$this->db->where('id_paciente', $id);
        $this->db->select_sum('subtotal');
        $query = $this->db->get('carrito');
        return  $query->row()->subtotal;

	}
    public function get_total_carrito2($id) {

		$this->db->where('id_paciente', $id);
        $this->db->select_sum('subtotal');
        $query = $this->db->get('carrito');
        echo  $query->row()->subtotal;

	}
    
   public function get_Products($type = 'array'){

        $response = null;
       
        $this->db->select('p.id,p.descripcion, p.precio, p.existencia,p.nombre,p.imagen,p.codigo,p.color');
        $this->db->from('productos p');
        $this->db->join('productos_sucursal ps', 'ps.id_pro = p.id', 'inner');
        $this->db->where('ps.id_suc', $this->session->userdata('sucursal'));
        $query = $this->db->get();
        $response = $query->result();

        if( $type == 'json' ) {
            return json_encode($response);
        }

        return $response;
    } 
    public function get_Carrito($id){
        $this->db->select("c.id,c.id_pro,c.id_paciente,c.producto,c.cantidad,c.subtotal,c.precio,p.descripcion");
        $this->db->from("carrito c");
        $this->db->join("productos p", "p.id = c.id_pro");
        $this->db->where('c.id_paciente', $id);
		return $this->db->get();
    }
    
    
    public function datos_order(){
        
        $id = $this->input->post('seleccion');
        
        $this->db->where('id',$id);
        $query = $this->db->get('pacientes');
        $respuesta = $query->result();
        
     
        echo json_encode($respuesta);
    } 
    
    public function agregar_carrito($id = null ,$type = false) {
        
        $idp = $this->input->post('id_pro');
        $precio = $this->input->post('precio');
        $cantidad = $this->input->post('cantidad');
        $exis = $this->input->post('existencia');
        $subtotal = $precio * $cantidad ;
        
        $pro_carrito = array(
            'id_pro' => $idp,
            'id_paciente' => $this->input->post('id_paciente'),
            'producto' => $this->input->post('nombre'),
            'cantidad' => $cantidad,
            'precio' => $precio,
            'subtotal' => $subtotal
        );
		
        if( !$type ) {
            $this->db->insert('carrito', $pro_carrito);
            
            $total_exis = $exis - $cantidad;
                $data =  array(
                    'existencia' => $total_exis,
                    );

                $this->db->where('id', $idp);
                $this->db->update('productos', $data);
			return false;
		}

		return $this->db->update('carrito', $pro_carrito, array('id' => $id));
	}
    
    public function actualizar_item_carrito(){
        $id = $_POST['id_item'];
         $data =  array(
            'cantidad' => $_POST['cantidad'],
            'subtotal' => $_POST['subtotal_new']
        );
        
         $cantidad = intval($_POST['cantidad']);
           $cant_ante = $this->orders->get_item_cantidad($id)->row();
            if($cantidad > $cant_ante->cantidad){
                $tot = $cantidad - $cant_ante->cantidad;
                $this->db->set('existencia','existencia -'.$tot,FALSE);
                $this->db->where('id', $_POST['id_pro']);
                $this->db->update('productos');
                
            }else{
                
                $tot = $cant_ante->cantidad - $cantidad;
                $this->db->set('existencia','existencia +'.$tot,FALSE);
                $this->db->where('id', $_POST['id_pro']);
                $this->db->update('productos');
            }
        
        $this->db->where('id', $id);
		$this->db->update('carrito',$data);
        
        if($this->db->affected_rows()){
			echo true;
		}else{
			echo false;
		}
    } 
    public function delete_item_carrito(){
        
        $this->db->where('id', $_POST['id']);
		$this->db->delete('carrito');
    
        if($this->db->affected_rows()){
            
            $this->db->set('existencia','existencia +'.$_POST['cantidad'],FALSE);
            $this->db->where('id', $_POST['id_pro']);
            $this->db->update('productos');
            
			echo true;
		}else{
			echo false;
		}
    }
    
    public function delete_carrito(){
        
         $data =  array(
        'id_paciente' => $_POST['id_paciente']
        );
        
        $this->db->where('id_paciente', $data['id_paciente']);
		$this->db->delete('carrito');
        
        if($this->db->affected_rows()){
			echo true;
		}else{
			echo false;
		}
    } 
    
    public function new_order(){
        
        $id_paciente = $_POST["id_paciente_pedido"];
        $metodo = $this->input->post('metodo');
        
        $hoy = date("d/m/y h:i:s");
        $hoy2 = date("d-m-y-h-i-s");
        
        $total = floatval($this->input->post('total_bd'));
        $pagado = floatval($this->input->post('cantidad-pagar'));
        $seguim = $this->input->post('seguim');
        
        $img_path = base_url('assets/images').'/';
        
        if( $metodo == "Credito"){
            $status = 'Pendiente'; 
            $restante = floatval($this->input->post('cantidad-pagar'));
            $pagado = 0;
            $hoyp = 0;
            
        }else{
            if (!empty($_POST['pagar-parte'])) {
                $status = 'Pendiente';    
                $restante = $total - $pagado;
                $hoyp = 0;
            } else {
                $status = 'Pagado';
                $hoyp = date("d/m/y h:i:s");
                $pagado = $total;
                $restante = 0;
            }
        }
        
        if (!empty($_POST['folio'])) {
            $nota = "Folio de Pago: ". $_POST['folio'];
        }else{
            $nota = "";
        }
        
        $this->db->where("paciente_id",$id_paciente);
        $countPedidos = $this->db->count_all_results("pedidos");
        
        if($countPedidos == 0){
            $primero = 1;
        }else{
            $primero = 0;
        }
        
        $data =  array(
        'paciente_id' => $id_paciente,
        'user_id' => $this->input->post('id_user_pedido'), 
        'total' => $total,
        'importe' => 0,
        'impuesto' => 0,
        'restante' => $restante,    
        'pagado' => $pagado,    
        'fecha_pedido' => $hoy,
        'referencia_pago' => $this->input->post('referencia_pago'),
            'primero' => $primero,
        'fecha_pago' => $hoyp,
        'metodo' => $metodo,
        'detalle' => $this->input->post('detalle'). " ".$nota,
        'status' => $status
        );
        
        $datos = array(
        'paciente_name' => $this->input->post('nombre'),
        'apellido_p' => $this->input->post('apellido_p'),
        'apellido_m' => $this->input->post('apellido_m'),
        'calle' => $this->input->post('calle'),
        'colonia' => $this->input->post('colonia'),
        'municipio' => $this->input->post('municipio'),
        'estado' => $this->input->post('estado'),
        'cp' => $this->input->post('cp'),
        'tels' => $this->input->post('tels'),
        'rfc' => $this->input->post('rfc'),
        'producto' => $this->input->post('producto'),
        'cantidad' => $this->input->post('cantidad'),
        'total_bd' => $this->input->post('total_bd')
        );
        
        
        $carrito = $this->get_Carrito($data['paciente_id']);
        $total = $this->get_total_carrito($data['paciente_id']);
        
        $product = "";
        $cantidad = "";
        
        foreach ($carrito->result() as $car){
            
            $product .= "
                <tr>
                    <td style=' padding:20px; ' ><p>". $car->cantidad."</p></td>
                    <td style=' padding:20px; ' ><p>". $car->producto."</p></td>
                </tr>
            ";
            
        }
        
        $html = "
        <p align='center' ><img src='". $img_path ."logo2.png' width='500px' height='100px' /></p>
        
        <h4 align='right' >Pedido de: ".$datos['paciente_name'] ." </h4>
        <hr>
        <div class='row'>
    
            <h3 align='center' >Datos de envio:</h3>
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold;' >Nombre:</b>
            <p style='font-family: frutiger; '  >". $datos['paciente_name']  ."</p>
            </div>
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold; ' >Apellido Paterno:</b>
            <p>". $datos['apellido_p']  ."</p>
            </div>
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold;' >Apellido Materno:</b>
            <p>". $datos['apellido_m']  ."</p>
            </div>
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold;' >Calle:</b>
            <p>". $datos['calle']  ."</p>
            </div>
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold;' >Colonia:</b>
            <p>". $datos['colonia']  ."</p>
            </div> 
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold;' >Colonia:</b>
            <p>". $datos['municipio']  ."</p>
            </div>
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold;' >Colonia:</b>
            <p>". $datos['estado']  ."</p>
            </div>
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold;' >Código Postal:</b>
            <p>". $datos['cp']  ."</p>
            </div>
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold;' >Telefonos:</b>
            <p>". $datos['tels']  ."</p>
            </div>  
            
            <div style=' float: left; width:225px; height:60px; ' >
            <b style='font-weight: bold;' >Telefonos:</b>
            <p>". $datos['rfc']  ."</p>
            </div>
            
        </div>
        
        <hr>
        
        <h3 align='center' >Productos:</h3>
        
        <table style='background-color: white; text-align:center; width:100%; border-collapse: collapse;  ' >
            <thead style=' background-color: #00BEE2; border-bottom: solid 5px #054E5C; color: white; ' >
                <tr>
                    <th style=' padding:20px; ' >Cantidad</>
                    <th style=' padding:20px; ' >Producto</>
                </tr>
            </thead>
            <tbody>     
                    ". $product ."
         
            </tbody>
        
        </table>
        
        <h3 align='right' >Total:</h3>
        <p align='right' >$ ". $total  ." .00</p>
        ";
        
        $pdfFilePath = "assets/pedidos/P_".$data['paciente_id'].$hoy2.".pdf";
        $this->load->library('M_pdf');
        $this->m_pdf->pdf->writeHtml($html);
        $this->m_pdf->pdf->Output($pdfFilePath,'F');
        $data['archivo'] = $pdfFilePath;

        //se hace el pedido
        if($this->db->insert('pedidos', $data)){
            
            $id_pedido = $this->db->insert_id();
            
            foreach ($carrito->result() as $car){

                $ped_pro = array(
                    'pedido_id' => $id_pedido,
                    'producto_id' => $car->id_pro,
                    'cantidad' => $car->cantidad
                );
                
                $this->db->insert('pedido_producto',$ped_pro);
            }
            if($seguim == 1){
                $id = $data['paciente_id'];
                $des = "Comision por 1er Pedido";
                if($status = 'Pendiente'){
                    $this->agent->pagar_com($id,$id_pedido,$pagado,$des); 
                }else{
                    $this->agent->pagar_com($id,$id_pedido,$total,$des); 
                }
                
            }else{              
            }
            $ped_suc = array(
                'id_pedido' => $id_pedido,
                'id_sucursal' => $this->session->sucursal
            );
            
            $this->db->insert('pedidos_sucursal',$ped_suc);

            echo json_encode($data);
        }else{
            echo false;
        }
        
        $this->db->where('id_paciente', $data['paciente_id']);
		$this->db->delete('carrito');
    }
    
    public function new_receta(){
        
    include_once APPPATH.'libraries/fpdf/fpdf.php';
        
    $medico = $_POST['medico'];
    $cedula = $_POST['cedula'];
    $expediente = $_POST['expediente'];
    $paciente = $_POST['paciente'];
    $fecha =  date("d/m/y h:i:s");
    $fecha2 =  date("d-m-y-h-i-s");
    $prescripcion = $_POST['descripcion'];
        
    $pdf = new FPDF('L','mm',array(165,200));
	$pdf->AddPage();
	$pdf->SetMargins(42,0,0);
	$pdf->SetAutoPageBreak(true, 10);
	$pdf->SetFont('Arial','',11);
	$pdf->Ln(13);
	$pdf->Cell(115);
	$pdf->Cell(45, 8, $expediente, 0, 0, 'C', false);
	$pdf->Ln(10);
	$pdf->Cell(95, 8, utf8_decode($paciente), 0, 0, 'L', false);
	$pdf->Cell(15);
	$pdf->Cell(50, 8, $fecha, 0, 0, 'C', false);

	$pdf->SetMargins(25,0,15);
	$pdf->Ln(12);
	$pdf->write(6, utf8_decode($prescripcion));
	$pdf->Ln(18);
	$pdf->Cell(0, 6, "ATENTAMENTE", 0, 0, 'C', false);
	$pdf->Ln(18);
	$pdf->Cell(0, 6, utf8_decode($medico), 0, 0, 'C', false);
        
    $pdfFilePath = "assets/recetas/R_".$_POST['paciente_id'].$fecha2.".pdf";
	$pdf->Output('F',$pdfFilePath);
        if (ob_get_contents()){
        ob_end_flush();
        } 
        
        $data = array(
            'id_paciente' => $_POST['paciente_id'],
            'archivo' => $pdfFilePath
        );
        
        $this->db->insert('receta_paciente', $data);
        
        echo json_encode($data);
    }

}