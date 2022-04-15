<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';
    
use chriskacerguis\RestServer\RestController;
use phpDocumentor\Reflection\Types\This;

class Absensi extends RestController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Absensi_model');
	}

	public function index_post()
	{
        // persiapan nik untuk query jadwal dan absensi
        $nik        = $this->post('nik');
        $today      = $this->post('today');
        $lokasi     = $this->post('lokasi');
        $waktuAbsen = $this->post('waktu');

        // query jadwal
        $data = $this->Absensi_model->jadwalAbsen($nik, $today);

        // lakukan test absensi
        if ($lokasi != $data[0]['gps_lokasi']) {
            // jika lokasi tidak sesuai
            echo('lokasi tidak sesauai');
        } else {
            // hitung denda
            $denda = 0;
            // jika lokasi sesuai
            if ($waktuAbsen > $data[0]['jam_masuk']) {
                // lebih besar dari jam masuk
                if($waktuAbsen < $data[0]['jam_pulang']) {
                    // terlambat absen masuk
                    $terlambat = $waktuAbsen - $data[0]['jam_masuk'];
                    $denda = ($terlambat/5)*5000;
                } else {
                    // terlambat absen pulang
                    $terlambat = $waktuAbsen - $data[0]['jam_pulang'];
                    $denda = ($terlambat/5)*5000;
                }
            }
        }
        
        echo('denda hari ini adalah ' . $denda);
        die;


        $dataAbsen = [
            'tanggal'   => $this->post('tanggal'),
            'waktu'     => $this->post('waktu'),
            'lokasi'    => $this->post('lokasi'),
            'jmlDenda'  => $denda
        ];

    }
}