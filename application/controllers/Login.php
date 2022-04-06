<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';
    
use chriskacerguis\RestServer\RestController;

class Login extends RestController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function index_get()
	{
		$this->response([
			'status' 	=> '200',
			'data'		=> $this->Login_model->getUser() 
		], RestController::HTTP_OK);
	}
}
