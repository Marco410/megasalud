<?php

/**
 * 
 */
class Historia extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAll() {
		return $this->db->get('pacientes');
	}
    
    //guarda en la bd
     public function notas_dr($data) {
   	 	return $this->db->insert('hisclinic_notas', $data);	
	}

    public function diagnostico_dr($data, $data_linea) {
        $this->db->insert('hisclinic_linea', $data_linea);
    	return $this->db->insert('hisclinic_diagnostico', $data);	
	}
    
     public function agregar_estudio($data) {
    	return $this->db->insert('hisclinic_estudio', $data);
	}
    
    public function carga_heredo_in($data) {
    	return $this->db->insert('hisclinic_ahf', $data);
	} 
    
    public function ante_in($data) {
    	return $this->db->insert('hisclinic_antecedente', $data);
	}
    
    public function congenita($hisclinic_app1, $data_linea) {

		$res = $this->insert_in_linea_vida($data_linea);
        if($res == 0){
			return $this->db->insert('hisclinic_app1', $hisclinic_app1);
		}else{
			echo json_encode(array('equal' => true));
		}
	}
    
    public function vacuna($data, $data_linea) {

		$res = $this->insert_in_linea_vida($data_linea);

        if($res == 0){
			return $this->db->insert('hisclinic_inmunizaciones', $data);
		}else{
			echo json_encode(array('equal' => true));
		}
	}
    
    public function alergia($data,$data_linea) {
		$res = $this->insert_in_linea_vida($data_linea);

        if($res == 0){
			return $this->db->insert('hisclinic_alergias', $data);
		}else{
			echo json_encode(array('equal' => true));
		}
    
	}

    public function hospitalizaciones($data, $data_linea) {
		$this->db->insert('hisclinic_linea', $data_linea);
    return $this->db->insert('hisclinic_hospitalizaciones', $data);
	}

	public function save_veneno_new($data,$data_linea) {
		$res = $this->insert_in_linea_vida($data_linea);

        if($res == 0){
			return $this->db->insert('hisclinic_venenos',$data);
		}else{
			return false;
		}
	}
    
    //busca el paciente en la bd
	public function find($id) {

		$this->db->where('id', $id);
		return $this->db->get('pacientes');
	}

	public function get_empleo($id) {

		$this->db->select('sp.paciente_id, sp.empleo_id,s.name');
		$this->db->from('hisclinic_empleo sp');
		$this->db->where('sp.paciente_id', $id);
		$this->db->join('empleos s', 's.id = sp.empleo_id', 'inner');
		$result = $this->db->get()->row();
		return $result;
	}

	public function get_sucursal($id) {

		$this->db->select('sp.paciente_id, sp.sucursal_id,s.razon_social');
		$this->db->from('sucursal_pacientes sp');
		$this->db->where('sp.paciente_id', $id);
		$this->db->join('sucursales s', 's.id = sp.sucursal_id', 'inner');
		$result = $this->db->get()->row();
		return $result;
	}
    
    public function find_charts($id){
        $this->db->where('id_paciente', $id);
		return $this->db->get('charts');
    }
    
    public function find_receta($id) {
        
		$this->db->order_by('created_at', 'desc');
		$this->db->where('id_paciente', $id);
		return $this->db->get('receta_paciente');
	}
    
    //desde la bd
    
     public function historial($id) {
        $this->db->select("h.motivo,h.created_at, u.nombre");
         $this->db->from("hisclinic_historial h");
         $this->db->join("users u", "u.id = h.id_user",'inner');
		 $this->db->where('h.id_paciente', $id);
         $this->db->order_by('h.created_at', 'asc');
		return $this->db->get();
	} 
    
    public function estudios($id) {
		$this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_estudio');
	}  
    public function pedidos($id) {
		$this->db->where('paciente_id', $id);
		$this->db->order_by('created_at',"DESC");
		return $this->db->get('pedidos');
	}  
    public function get_notas($id) {
		$this->db->where('paciente_id', $id);
		$this->db->order_by('created_at', 'asc');
		return $this->db->get('hisclinic_notas');
	}  

	public function get_productos_ven() {
		return $this->db->get('productos_ven');
	}  
    
    public function get_diagnostico($id) {
		$this->db->where('id_paciente', $id);
		$this->db->order_by('created_at', 'asc');
		return $this->db->get('hisclinic_diagnostico');
	}  
    
    public function linea_vida($id) {
		$this->db->where('id_paciente', $id);
		$this->db->order_by('edad_paciente', 'DESC');
		return $this->db->get('hisclinic_linea');
	} 

	public function linea_vida_with_evol($id) {
		$this->db->where('h.id_paciente', $id);
		$this->db->select("h.*, he.id as idEvol,he.evolucion");
		$this->db->from("hisclinic_linea h");
		$this->db->join("hisclinic_evolucion he", "he.linea_id = h.id ",'inner');
		$this->db->order_by('h.anio', 'asc');
		return $this->db->get()->result();
	}
	
	public function insert_in_linea_vida($data_linea){
		$this->db->where('id_paciente', $data_linea['id_paciente']);
		$this->db->where('id_dato', $data_linea['id_dato']);
		$this->db->where('table_hisclinic', $data_linea['table_hisclinic']);
        $res = $this->db->count_all_results('hisclinic_linea');
        if($res == 0){
			$this->db->insert('hisclinic_linea', $data_linea);
			return 0;
		}else{
			return $res;
		}
	}

	public function dato_linea_vida($id) {
		$this->db->where('id', $id);
		return $this->db->get('hisclinic_linea');
	}

	public function evolucion($id) {
		$this->db->where('linea_id', $id);
		return $this->db->get('hisclinic_evolucion');
	}
   
    public function carga_heredo($id) {
		$this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_ahf');
	} 
    public function ante($id) {
		$this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_antecedente');
	}
    public function antecedentes() {
		return $this->db->get('antecedentes');
	}
    
    public function familiar() {
		return $this->db->get('hisclinic_familia');
	}
    public function enf_autoinmune() {
		return $this->db->get('hisclinic_enf_autoinmune');
	}
    public function hisclinic_app1($id) {
		$this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_app1');
	}
    public function alergeno() {
		return $this->db->get('alergenos');

	}
   
    public function tratamiento() {
		return $this->db->get('tratamiento_alergia');

	}
    public function productos_ven() {
		return $this->db->get('productos_ven');
	}
    
    public function inmunizacion($id) {
		$this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_inmunizaciones');
	}
    
    public function enfCong() {
        $this->db->where('tipo', "congenita");
		return $this->db->get('enfermedades');

	}
    public function infecto() {
        $this->db->where('tipo', "virus");
		return $this->db->get('enfermedades');

	}
    public function infecto_bac() {
        $this->db->where('tipo', "bacterias");
		return $this->db->get('enfermedades');

	}
    public function infecto_hongos() {
        $this->db->where('tipo', "hongos");
		return $this->db->get('enfermedades');

	} 
    
    public function infecto_parasitos() {
        $this->db->where('tipo', "parasitos");
		return $this->db->get('enfermedades');

	} 
    public function infecto_psico() {
        $this->db->where('tipo', "psico");
		return $this->db->get('enfermedades');

	}
    
    public function infecto_otras() {
        $this->db->where('tipo', "otras");
		return $this->db->get('enfermedades');

	}
    
    public function get_motivo_consulta() {
		return $this->db->get('motivo_consulta');
        
	}public function medicamento() {
        $this->db->order_by('medicamento', 'ASC');
		return $this->db->get('medicamentos');
	}
	public function estres() {
        $this->db->order_by('id', 'ASC');
		return $this->db->get('estres');
	}
	public function obesidad() {
        $this->db->order_by('id', 'ASC');
		return $this->db->get('obesidad');
	}
    public function terapias() {
        $this->db->order_by('terapia', 'ASC');
		return $this->db->get('terapias');
	}
    public function vacunas() {
		return $this->db->get('vacunas');
	}
    public function alergias($id) {
        $this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_alergias');
	}
    
    public function hospitalizacion($id) {
        $this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_hospitalizaciones');
	}
    
    //info de hospitalizaciones
    public function anestesia() {
		return $this->db->get('hospi_anestesia');
	}
    public function causa() {
		return $this->db->get('hospi_causa');
	} 
    
   
    public function operacion() {
		return $this->db->get('hospi_operacion');
	}
    public function protesis() {
		return $this->db->get('hospi_protesis');
	}
    public function transfusion() {
		return $this->db->get('hospi_transfusion');
	}
    
     public function terapia() {
		return $this->db->get('terapia');
	}
    
    //info enfermedades infectocontagiosas del usuario
    public function enf_infecto_virus($id) {
        $this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_enf_infecto_virus');
	}
     public function enf_infecto_bacterias($id) {
        $this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_enf_infecto_bacterias');
	}
     public function enf_infecto_hongos($id) {
        $this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_enf_infecto_hongos');
	}
     public function enf_infecto_parasitos($id) {
        $this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_enf_infecto_parasitos');
	}
     public function enf_infecto_psicologicas($id) {
        $this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_enf_infecto_psicologicas');
	}
     public function enf_infecto_otras($id) {
        $this->db->where('id_paciente', $id);
		return $this->db->get('hisclinic_enf_infecto_otras');
	}
    
    public function delete_hisclinic($data) {
		$table_bd = 'hisclinic' . $data['table'];
        
        if($data['table'] == "_ahf" || $data['table'] == "_antecedente"){
            
        }else{
            $this->db->where('table_hisclinic', $data['table']);
            $this->db->where('created_at', $data['fecha']);
            $this->db->delete('hisclinic_linea');
        }
        
        
        $this->db->where('id', $data['id']);
		$this->db->delete($table_bd);
		return $this->db->affected_rows();
	}
 
	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('permisos');
		return $this->db->affected_rows();
	}
    
     public function save_veneno($data) {
     return $this->db->insert('hisclinic_venenos', $data);
	}
    
    public function save_hisclinic_vp($data, $data_linea) {
		$this->db->insert('hisclinic_linea', $data_linea);
        return $this->db->insert('hisclinic_vp', $data);	
	}
    public function save_hisclinic_vm($data, $data_linea) {
		$this->db->insert('hisclinic_linea', $data_linea);
        return $this->db->insert('hisclinic_vm', $data);	
	}
    public function save_hisclinic_vr($data, $data_linea) {
		$this->db->insert('hisclinic_linea', $data_linea);
        return $this->db->insert('hisclinic_vr', $data);	
	}
    public function save_hisclinic_vmp($data, $data_linea) {
		$this->db->insert('hisclinic_linea', $data_linea);
        return $this->db->insert('hisclinic_vmp', $data);	
	}
	public function save_terapia($data, $data_linea) {
		$this->db->insert('hisclinic_linea', $data_linea);
        return $this->db->insert('hisclinic_terapia', $data);	
	}

	public function get_empleos() {
		return $this->db->get('empleos');
	}

}