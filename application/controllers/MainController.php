<?php

class MainController extends CI_Controller {

	function index()
	{
		header('Location: '.base_url('home'));
	}

}