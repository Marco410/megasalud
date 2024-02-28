<?php 

class QuizController extends CI_Controller {

	public function __construct()
	{
		
		parent::__construct();
        $this->load->model('megasalud/quiz');

	}

	/* 
      * Function to get questions
      * Return data
	  * @param paciente_id
    */

	public function getQuestions() {

        echo $this->quiz->get_questions($_GET['paciente_id']);
	}

}