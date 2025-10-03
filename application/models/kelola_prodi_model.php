<?php

class kelola_prodi_model extends CI_Model
{
    public function insertDataProdi()
    {
        $data = [
            'kode_prodi' => $this->input->post('kode_prodi', true),
            'nama_prodi' => $this->input->post('nama_prodi', true)
        ];

        return $this->db->insert('prodi', $data);
    }

    public function insertDataJurusan()
    {
        $data = [
            'kode_jurusan' => $this->input->post('kode_jurusan', true),
            'nama_jurusan' => $this->input->post('nama_jurusan', true)
        ];

        return $this->db->insert('jurusan', $data);
    }

    public function updateDataProdi($id)
    {
        $data = [
            'kode_prodi' => $this->input->post('kode_prodi', true),
            'nama_prodi' => $this->input->post('nama_prodi', true)
        ];

        $this->db->where('id', $id);
        return $this->db->update('prodi', $data);
    }

    public function updateDataJurusan($id)
    {
        $data = [
            'kode_jurusan' => $this->input->post('kode_jurusan', true),
            'nama_jurusan' => $this->input->post('nama_jurusan', true)
        ];

        $this->db->where('id', $id);
        return $this->db->update('jurusan', $data);
    }

    public function deleteDataProdi($id)
    {
        return $this->db->delete('prodi', ['id' => $id]);
    }

    public function deleteDataJurusan($id)
    {
        return $this->db->delete('jurusan', ['id' => $id]);
    }

    public function readDataProdi($id)
    {
        return $this->db->get_where('prodi', ['id' => $id])->row_array();
    }

    public function getDataJumlahProdi()
    {
        return $this->db->get('prodi')->num_rows();
    }

    public function getDataProdi()
    {
        return $this->db->get('prodi')->result_array();
    }

    public function readDataJurusan($id)
    {
        return $this->db->get_where('jurusan', ['id' => $id])->row_array();
    }

    public function getDataJumlahJurusan()
    {
        return $this->db->get('jurusan')->num_rows();
    }

    public function getDataJurusan()
    {
        return $this->db->get('jurusan')->result_array();
    }
}
