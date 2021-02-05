<?php 

class RolesController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/rol');
        $this->load->model('megasalud/permiso');
	}

	public function index() {

		session_redirect();

		$data = array();
        $data['title'] = 'Roles';
        $data['roles'] = $this->rol->getAll();
        $data['roles_permisos'] = $this->permiso->getAllPermisoRol();
        // $data['view_style'] = 'users.css';
        $data['view_controller'] = 'roles_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador"){
            $this->load->view('roles/index', $data);
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}

	public function create() {

    	session_redirect();

    	$data = array();
        $data['title'] = 'Nuevo rol';
        $data['permisos'] = $this->permiso->getAll();
        $data['roles'] = $this->rol->getAll();
        $data['view_controller'] = 'roles_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('roles/create', $data);
        $this->load->view('layout/scripts', $data);

	}

    public function show(){

        $id = $this->uri->segment(4);

        $data = array(
            'rol' => $this->rol->find($id)->row_array(),
            'permisos' => $this->permiso->findPermisosByRolId($id)
        );
        echo json_encode($data);
    }

    public function save() {
        //si no existe la variable !isset retorna null
        $permisos = $this->input->post('permisos');

        $rol = array(
            'name' => $_POST['name'],
            'display_name' => $_POST['display_name'],
            'description' => $_POST['description']
        );

        $data = array(
            'rol' => $rol,
            'permisos' => $permisos
        );

        // var_dump($this->rol->save($data));

        if(isset($_POST['_method'])) {
            $res = $this->rol->save($data, $_POST["id"], true);
        }else{
            $res = $this->rol->save($data);
        }

        if($res){
            echo true;
        }
        else{
            echo false;
        }

    }

    public function edit($id) {

        session_redirect();

        $data['title'] = 'Editar rol';
        $data['rol'] = $this->rol->find($id);
        $data['roles'] = $this->rol->getAll();
        $data['permisos'] = $this->permiso->getAll();
        $data['permisos_rol'] = $this->permiso->findPermisosByRolId($id, 'id');
        $data['view_controller'] = 'roles_vs.js';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('roles/edit', $data);
        $this->load->view('layout/scripts', $data);
    }

    public function delete() {
        if($this->rol->delete($this->input->post('id')) !== 0){
            echo true;
        }else{
            echo false;
        }
    }

    public function verifyRol() {

        echo json_encode( $this->rol->isAvailable($this->input->get('name'), $this->input->get('id')) );

    }

    public function getPermisosByRolId() {
        $id = $this->uri->segment(4);
        echo json_encode($this->permiso->findPermisosByRolId($id, 'id'));
    }

}