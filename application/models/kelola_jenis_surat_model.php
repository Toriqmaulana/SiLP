<?php

class kelola_jenis_surat_model extends CI_Model
{
    public function insertDataJenisSurat()
    {
        $role_access = $this->input->post('role_access', true);

        if (!empty($role_access)) {
            // Sort role_access untuk konsistensi
            sort($role_access);

            // Gabungkan role_access menjadi string
            $role_access_string = implode(',', $role_access);
        }

        $data = [
            'kode_surat' => $this->input->post('kode_surat', true),
            'nomor_surat' => $this->input->post('nomor_surat', true),
            'nama_surat' => $this->input->post('nama_surat', true),
            'nama_jenis_surat' => $this->input->post('nama_jenis_surat', true),
            'role_access' => $role_access_string // Simpan role_access
        ];

        return $this->db->insert('jenis_surat', $data);
    }

    public function updateDataJenisSurat($id)
    {
        $this->db->where('id', $id);
        $js = $this->db->get('jenis_surat')->row();

        // Inisialisasi variabel
        $role_access_string = $js->role_access;

        // Ambil data role_access dari input
        $role_access = $this->input->post('role_access', true);

        if (!empty($role_access)) {
            // Sort role_access untuk konsistensi
            sort($role_access);

            // Gabungkan role_access menjadi string
            $role_access_string = implode(',', $role_access);
        }

        $data = [
            'kode_surat' => $this->input->post('kode_surat', true),
            'nomor_surat' => $this->input->post('nomor_surat', true),
            'nama_surat' => $this->input->post('nama_surat', true),
            'nama_jenis_surat' => $this->input->post('nama_jenis_surat', true),
            'role_access' => $role_access_string // Simpan role_access
        ];

        $this->db->where('id', $id);
        return $this->db->update('jenis_surat', $data);
    }

    public function deleteDataJenisSurat($id)
    {
        return $this->db->delete('jenis_surat', ['id' => $id]);
    }

    public function readDataJenisSurat($id)
    {
        return $this->db->get_where('jenis_surat', ['id' => $id])->row_array();
    }

    public function getDataJumlahJenisSurat()
    {
        return $this->db->get('jenis_surat')->num_rows();
    }

    public function getDataJenisSurat()
    {
        return $this->db->get('jenis_surat')->result_array();
    }
}
