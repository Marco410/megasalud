<?php

/**
 * 
 */
class Quiz extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_questions($id) {

		$this->db->where('paciente_id',$id);
		$empleo_id =$this->db->get('hisclinic_empleo')->row()->empleo_id;

		$this->db->where('id',$empleo_id);
		$empleo = $this->db->get('empleos')->row()->name;

		$this->db->select('q.id, q.question,q.description');
		$this->db->join('question_empleo qe', 'qe.question_id = q.id');
		$this->db->join('empleos e', 'e.id = qe.empleo_id');
		$this->db->where('qe.empleo_id', $empleo_id);
		$this->db->from('questions q');
		$result = $this->db->get();
		$response = array();

		$this->db->where('general',1);
		$general_questions = $this->db->get('questions')->result_array();

		$response['data'] = $result->result_array();
		$response['id'] = $id;
		$response['empleo'] = $empleo;
		$response['general_questions'] = $general_questions;

        return json_encode($response);
	}

}