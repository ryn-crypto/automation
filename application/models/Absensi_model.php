<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Absensi_model extends CI_Model
{
    // untuk mengambil data user
    public function jadwalAbsen($nik, $today)
    {
        $this->db->select('*');
        $this->db->from('jadwal');
        $this->db->where(['id_user' => $nik]);
        $this->db->where(['tanggal' => $today]);
        $this->db->join('shift', 'jadwal.shift = shift.id');
        $this->db->join('lokasi', 'jadwal.lokasi_tugas = lokasi.id');
        $query = $this->db->get()->result_array();

        return $query;
    }
}