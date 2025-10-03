<?php

class auth_model extends CI_Model
{
    public function login($username)
    {
        $this->db->select(['*']);
        return $this->db->get_where('user', ['username' => $username])->row();
    }

    public function getDataLoggedIn($id_user)
    {
        $this->db->select('*');
        $this->db->where('id', $id_user);
        $this->db->from('user');

        return $this->db->get()->row();
    }
}
