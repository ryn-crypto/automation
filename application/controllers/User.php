<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';
    
use chriskacerguis\RestServer\RestController;
use phpDocumentor\Reflection\Types\This;

class User extends RestController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index_get()
	{
		// persiapan data untuk melakukan query
		$nik = $this->get('nik');
		
		// melakukan query
		if ($nik === null) {
			$User = $this->User_model->getUser();
		} else {
			$User = $this->User_model->getUser($nik);
		} 

		// melakukan return
		if ($User) {
			$this->response([
				'status' 	=> true,
				'data'		=> $User
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message'		=> 'NIK tidak ditemukan !!'
			], RestController::HTTP_NOT_FOUND);
		}
	}

	// untuk menghapus data user
	public function index_delete() 
	{
		// persiapan data untuk melakukan query
		$nik = $this->delete('nik');

		// jika nik tidak ada dalam value
		if ($nik === null) {
			$this->response([
				'status' 	=> false,
				'message'	=> 'value NIK tidak tersedia !!'
			], RestController::HTTP_METHOD_NOT_ALLOWED);
		} else {
			// jika nik ada dalam value
			// lakukan pengecekan
			if ($this->User_model->deleteUser($nik) > 0) {
				// oke data terhapus
				$this->response([
					'status' 	=> true,
					'nik'		=> $nik,
					'message'	=> 'data sudah terhapus'
				], RestController::HTTP_OK);
			} else {
				// nik tidak tersedia
				$this->response([
					'status' 	=> false,
					'message'	=> 'NIK tidak ditemukan !!'
				], RestController::HTTP_NOT_FOUND);
			}
		}
	}

	// untuk menambah User
	public function index_post()
	{
		// persiapan data yang dikirim dari client
		$dataUser = [
			'nik'		=> $this->post('nik'),
			'password'	=> $this->post('password'),
			'nama'		=> $this->post('nama'),
			'foto'		=> $this->post('foto'),
			'email'		=> $this->post('email'),
			'jabatan'	=> $this->post('jabatan'),
			'alamat'	=> $this->post('alamat'),
			'no_telf'	=> $this->post('no_telf')
		]; 

		// melakukan penambahan ke database
		if ($this->User_model->createUser($dataUser)> 0) {
			// jika berhasil menambah user
			$this->response([
				'status' 	=> true,
				'message'	=> 'User baru sudah ditambahkan'
			], RestController::HTTP_CREATED);
		} else {
			// jika gagal menambah user
			$this->response([
				'status' 	=> false,
				'message'	=> 'User baru gagal ditambahkan'
			], RestController::HTTP_CREATED);
		}
	}

	// untuk mengubah data User
	public function index_put()
	{
		$id = $this->put('id');
		// persiapan data yang dikirim dari client
		$dataUser = [
			'nik'		=> $this->put('nik'),
			'password'	=> $this->put('password'),
			'nama'		=> $this->put('nama'),
			'foto'		=> $this->put('foto'),
			'email'		=> $this->put('email'),
			'jabatan'	=> $this->put('jabatan'),
			'alamat'	=> $this->put('alamat'),
			'no_telf'	=> $this->put('no_telf')
		]; 

		// melakukan perubahan ke database
		if ($this->User_model->updateUser($dataUser, $id)> 0) {
			// jika berhasil menambah user
			$this->response([
				'status' 	=> true,
				'message'	=> 'Data user diperbarui'
			], RestController::HTTP_OK);
		} else {
			// jika gagal menambah user
			$this->response([
				'status' 	=> false,
				'message'	=> 'Data user gagal diperbarui'
			], RestController::HTTP_NOT_MODIFIED);
		}
	}
}
