<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';
    
use chriskacerguis\RestServer\RestController;

class Produk extends RestController {

	public function index_get()
	{
		echo('api already');
	}
}
