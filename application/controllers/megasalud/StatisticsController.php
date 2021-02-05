<?php 

class StatisticsController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('megasalud/Statistics');
	}

	public function index() {

		session_redirect();

		$data = array();
        $data['title'] = 'Estadísticas';
        $data['view_controller'] = 'statistics_vs.js';
        $data['count_pacientes'] = $this->get_count_pacients();
        $data['count_citas'] = $this->get_count_citas();
        $data['view'] = 'chart.min.js';
        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $type = $this->session->type;
         if($type == "Administrador" || $type == "Medico Administrador" ){
             
            $this->load->view('statistics/index', $data);
             
        }else{
          $this->load->view('auth/error'); 
        } 
        
        $this->load->view('layout/scripts');

	}
    
     public function get_count_pacients() {

		$this->db->where('status', 1);
		return $this->db->count_all_results('pacientes');

	}  public function get_count_citas() {

		return $this->db->count_all_results('hisclinic_historial');

	}
    public function getSexoP(){
        
        $this->db->where("sexo","Masculino");
        $hombres = $this->db->count_all_results('pacientes');
        $this->db->where("sexo","Femenino");
        $mujeres = $this->db->count_all_results('pacientes');
        
        $data = array(
         'hombres' => $hombres,
            'mujeres' => $mujeres
        );
        
        echo json_encode($data);

        
    } 
    
    public function getEdad(){
        
        $this->db->where("fecha_nacimiento <=","2007-01-01");
        $this->db->where("fecha_nacimiento >=","2000-01-01");
        $e1320 = $this->db->count_all_results('pacientes');
        $this->db->where("fecha_nacimiento <=","1999-01-01");
        $this->db->where("fecha_nacimiento >=","1995-01-01");
        $e2125 = $this->db->count_all_results('pacientes');
        $this->db->where("fecha_nacimiento <=","1994-01-01");
        $this->db->where("fecha_nacimiento >=","1990-01-01");
        $e2630 = $this->db->count_all_results('pacientes');
        $this->db->where("fecha_nacimiento <=","1989-01-01");
        $this->db->where("fecha_nacimiento >=","1985-01-01");
        $e3135 = $this->db->count_all_results('pacientes');
        $this->db->where("fecha_nacimiento <=","1984-01-01");
        $this->db->where("fecha_nacimiento >=","1980-01-01");
        $e3640 = $this->db->count_all_results('pacientes');
        $this->db->where("fecha_nacimiento <=","1979-01-01");
        $this->db->where("fecha_nacimiento >=","1975-01-01");
        $e4145 = $this->db->count_all_results('pacientes');
        $this->db->where("fecha_nacimiento <=","1974-01-01");
        $this->db->where("fecha_nacimiento >=","1970-01-01");
        $e4650 = $this->db->count_all_results('pacientes');
        $this->db->where("fecha_nacimiento <=","1969-01-01");
        $this->db->where("fecha_nacimiento >=","1965-01-01");
        $e5155 = $this->db->count_all_results('pacientes');
        $this->db->where("fecha_nacimiento <=","1964-01-01");
        $this->db->where("fecha_nacimiento >=","1950-01-01");
        $e5660 = $this->db->count_all_results('pacientes');
        $this->db->where("fecha_nacimiento <=","1949-01-01");
        $this->db->where("fecha_nacimiento >=","1945-01-01");
        $e6165 = $this->db->count_all_results('pacientes');
        
        $data = array(
         'e1320' => $e1320,
         'e2125' => $e2125,
         'e2630' => $e2630,
         'e3135' => $e3135,
         'e3640' => $e3640,
         'e4145' => $e4145,
         'e4650' => $e4650,
         'e5155' => $e5155,
         'e5660' => $e5660,
         'e6165' => $e6165
        );
        
        echo json_encode($data);

        
    } 
    
    public function getLugar(){
        $this->db->where("estado","Aguascalientes");
        $aguas = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Baja California");
        $bc = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Baja California Sur");
        $bcs = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Campeche");
        $camp = $this->db->count_all_results('pacientes'); 
        $this->db->where("estado","Chiapas");
        $chiapas = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Chihuahua");
        $chihu = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Coahuila");
        $coahu = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Colima");
        $col = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Distrito Federal");
        $df = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Durango");
        $dur = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Guanajuato");
        $guana = $this->db->count_all_results('pacientes'); $this->db->where("estado","Guerrero");
        $gue = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Hidalgo");
        $hida = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Jalisco");
        $jal = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Michoacan");
        $mich = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Mexico");
        $mex = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Morelos");
        $mor = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Nayarit");
        $nay = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Nuevo Leon");
        $nl = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Oaxaca");
        $oax = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Puebla");
        $pueb = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Queretaro");
        $que = $this->db->count_all_results('pacientes');
        $this->db->where("estado","San Luis Potosi");
        $slp = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Sinaloa");
        $sin = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Sonora");
        $son = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Tabasco");
        $tab = $this->db->count_all_results('pacientes'); $this->db->where("estado","Tamaulipas");
        $tama = $this->db->count_all_results('pacientes'); $this->db->where("estado","Tlaxcala");
        $tlax = $this->db->count_all_results('pacientes'); $this->db->where("estado","Veracruz");
        $vera = $this->db->count_all_results('pacientes'); $this->db->where("estado","Yucatan");
        $yuca = $this->db->count_all_results('pacientes');
        $this->db->where("estado","Zacatecas");
        $zaca = $this->db->count_all_results('pacientes');
        
        $data = array(
         'aguas' => $aguas,
         'bc' => $bc,
         'bcs' => $bcs,
         'camp' => $camp,
         'chia' => $chiapas,
         'chihu' => $chihu,
         'coahu' => $coahu,
         'col' => $col,
         'df' => $df,
         'dur' => $dur,
         'guana' => $guana,
         'gue' => $gue,
         'hida' => $hida,
         'jal' => $jal,
         'mich' => $mich,
         'mex' => $mex,
         'mor' => $mor,
         'nay' => $nay,
         'nl' => $nl,
         'oax' => $oax,
         'pueb' => $pueb,
         'que' => $que,
         'slp' => $slp,
         'sin' => $sin,
         'son' => $son,
         'tab' => $tab,
         'tama' => $tama,
         'tlax' => $tlax,
         'vera' => $vera,
         'yuca' => $yuca,
         'zaca' => $zaca
        );
        
        echo json_encode($data);

        
    }
public function getEntradaP(){
        
        $this->db->where("created_at <=","2021-01-31");
        $this->db->where("created_at >=","2021-01-01");
        $ene = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-02-28");
        $this->db->where("created_at >=","2021-02-01");
        $feb = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-03-31");
        $this->db->where("created_at >=","2021-03-01");
        $mar = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-04-30");
        $this->db->where("created_at >=","2021-04-01");
        $abr = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-05-31");
        $this->db->where("created_at >=","2021-05-01");
        $may = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-06-30");
        $this->db->where("created_at >=","2021-06-01");
        $jun = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-07-31");
        $this->db->where("created_at >=","2021-07-01");
        $jul = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-08-31");
        $this->db->where("created_at >=","2021-08-01");
        $ago = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-09-30");
        $this->db->where("created_at >=","2021-09-01");
        $sep = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-10-31");
        $this->db->where("created_at >=","2021-10-01");
        $oct = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-11-30");
        $this->db->where("created_at >=","2021-11-01");
        $nov = $this->db->count_all_results('pacientes');
        $this->db->where("created_at <=","2021-12-31");
        $this->db->where("created_at >=","2021-12-01");
        $dic = $this->db->count_all_results('pacientes');
        
        $data = array(
         'ene' => $ene,
         'feb' => $feb,
         'mar' => $mar,
         'abr' => $abr,
         'may' => $may,
         'jun' => $jun,
         'jul' => $jul,
         'ago' => $ago,
         'sep' => $sep,
         'oct' => $oct,
         'nov' => $nov,
         'dic' => $dic
        );
        
        echo json_encode($data);

        
    } 
    
    public function getPacientesFrom(){
        
        $agent = $this->db->count_all_results('agent_paciente');
        $dr = $this->db->count_all_results('user_paciente');
        $this->db->where("type","Clinica");
        $suc_c = $this->db->count_all_results('sucursal_paciente_com'); 
        $this->db->where("type","Social");
        $suc_s = $this->db->count_all_results('sucursal_paciente_com');
        $this->db->where("type","Paciente");
        $suc_p = $this->db->count_all_results('sucursal_paciente_com');
        
        $data = array(
         'agent' => $agent,
         'dr' => $dr,
         'clinica' => $suc_c,
         'paciente' => $suc_p,
         'social' => $suc_s
        );
        
        echo json_encode($data);

        
    } 

}