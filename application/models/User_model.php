<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User_model extends CI_Model
{
    // untuk mengambil data user
    public function getUser($nik = null)
    {
        if ($nik === null) {
            return $this->db->get('user')->result_array();
        } else {
            return $this->db->get_where('user', ['nik' => $nik])->result_array();
        }

    }

    // untuk menghapus user
    public function deleteUser($nik)
    {
        $this->db->delete('user', ['nik' => $nik]);
        return $this->db->affected_rows();
    }

    // untuk menambahkan user
    public function createUser($dataUser)
    {
        $this->db->insert('user', $dataUser);
        return $this->db->affected_rows();
    }

    // mengubah data User
    public function updateUser($dataUser, $id)
    {
        $this->db->update('user',$dataUser, ['id' => $id]);
        return $this->db->affected_rows();
    }
} 