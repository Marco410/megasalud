<?php 

class APIController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    /* 
        * Function get "Notas de los pacientes"
        * Return json data
        * @params init, end
    */

	public function pacientes_notas() {	
        session_redirect();

        $array = [];
        $init = intval($_GET['init']);	
        $end = intval($_GET['end']);	
        
        for ($i = $init; $i <= $end; $i++){
            $this->db->select("p.nombre, p.motivo_consulta, hn.nota, hn.created_at");
            $this->db->from("hisclinic_notas hn");
            $this->db->join('pacientes p', 'p.id = hn.paciente_id', 'inner');
            $this->db->where("p.id",$i);
            $this->db->group_by("p.id");
            $result =  $this->db->get();
            $response = $result->result();
             
            $array["paciente".strval($i)] .= json_encode($response);
        }
        echo json_encode($array);
	}

    /* 
        * Function to get "perfil inmunologio del paciente"
        * Return json data
    */

    public function perfil() {

        $array = [];
        $arrayFinal = [];        
        $this->db->select("id,nombre,motivo_consulta");
        $this->db->from("pacientes");
        $this->db->like("motivo_consulta",$_GET['motivo']);
        $pacientes = $this->db->get()->result();
        foreach($pacientes as $pa):
            $this->db->select("*");
            $this->db->from("hisclinic_linea");
            $this->db->like("id_paciente",$pa->id);
            $perfil = $this->db->get();
            $datafin = [];
            if($perfil->num_rows() >= 1){
                foreach ($perfil->result() as $per):
                    //echo $per->table_hisclinic. "\n" . $i;
                    $data= "";
                    switch($per->table_hisclinic){
                        case "congenita":
                            $data = "00";
                            break;
                        case "vacuna":
                            $data = "01";
                            break;
                        case "alergenos":
                            $data = "02";
                            break;
                        case "hospitalizacion": 
                            $data = "03";
                            break;
                        case "venenos": 
                            $data = "04";
                            break;
                        case "terapia": 
                            $data = "05";
                            break;
                        case "medicamentos": 
                            $data = "06";
                            break;
                        case "obesidad": 
                            $data = "07";
                            break;
                        case "estre": 
                            $data = "08";
                            break;
                        case "Diagnóstico":
                            $data = "99";
                            break;
                        default:
                        $data= "98";
                        break;
                        };
                    /*
                    primeros dos digitos: Prefijo de clasificación
                    cuatro digitos siguientes: id del dato 
                    digito siguiente: frecuencia
                    */
                    //valida si el dato no es de un diagnostico y no lo agrega
                    if($data != 99 && $data != "99" && $data != "98" && $data != 98){
                        array_push($datafin,$data.$per->id_dato.$per->frecuencia);
                    }
                endforeach;
                //agrega el perfil inmunologico de cada paciente
                $array = array( 'perfil'.$pa->id => $datafin);
                array_push($arrayFinal,$array);
            }
        endforeach;
        /* $array .= array('pacientescount' => $pacientes->num_rows()); */
        echo json_encode($arrayFinal);
	}
    
}   