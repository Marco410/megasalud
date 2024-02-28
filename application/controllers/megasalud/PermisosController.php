<?php 

class PermisosController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/permiso');
	}

	/* 
      * Function to get view Permisos
      * Return view 
    */

	public function index() {

		session_redirect();

		$data = array();
        $data['title'] = 'Permisos';
        $data['query'] = $this->permiso->getAll();
        // $data['view_style'] = 'users.css';
        $data['view_controller'] = 'permisos_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador" ){
            $this->load->view('permissions/index', $data);
        }else{
          $this->load->view('auth/error'); 
        }
        $this->load->view('layout/scripts');

	}

	/* 
      * Function to get view Nuevo Permiso
      * Return view 
    */

	public function create() {

		session_redirect();

		$data = array();
        $data['title'] = 'Nuevo permiso';
        // $data['view_style'] = 'users.css';
        $data['view_controller'] = 'permisos_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('permissions/create');
        $this->load->view('layout/scripts', $data);

	}

	/* 
      * Function to get permiso
      * Return json 
    */

	public function show(){

		$id = $this->uri->segment(4);

        echo json_encode($this->permiso->find($id)->row_array());
    }

	/* 
      * Function to add new permiso
      * Return message 
	  * @param permiso data
    */

	public function save() {

		$permiso = array(
			'name' => $_POST['name'],
			'display_name' => $_POST['display_name'],
			'description' => $_POST['description']
		);

		if(isset($_POST['_method'])) {
			$res = $this->permiso->save($permiso, $_POST["id"], true);
		}else{
			$res = $this->permiso->save($permiso);			
		}

		if($res){
            echo true;
        }
        else{
            echo false;
        }

	}

	/* 
      * Function to edit permiso
      * Return view 
	  * @param permiso_id
    */

	public function edit($id) {

		session_redirect();

		$data['title'] = 'Editar permiso';
        $data['permiso'] = $this->permiso->find($id);
        $data['view_controller'] = 'permisos_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('permissions/edit', $data);
        $this->load->view('layout/scripts', $data);
	}

	/* 
      * Function to delete permiso
      * Return message 
	  * @param permiso_id
    */

	public function delete() {
		if($this->permiso->delete($_POST['id']) !== 0){
			echo true;
		}else{
			echo false;
		}
	}

	/* 
      * Function to verify permiso
      * Return json 
	  * @param permiso_id
    */

	public function verifyPermission() {
		echo json_encode( $this->permiso->isAvailable($this->input->get('name'), $this->input->get('id')) );
	}
}