<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Login_model extends CI_Model
{
    public function getUser()
    {
        // return 'sudah oke harusnya';
        return $this->db->get('user')->result_array();

    }
}