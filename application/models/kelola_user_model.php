<?php

class kelola_user_model extends CI_Model
{
    public function insertDataUser()
    {
        $data = [
            'id_jurusan' => $this->input->post('id_jurusan', true),
            'id_prodi' => $this->input->post('id_prodi', true),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'password' => password_hash($this->input->post('password', true), PASSWORD_BCRYPT),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'nip' => $this->input->post('nip', true),
            'pangkat' => $this->input->post('pangkat', true),
            'golongan' => $this->input->post('golongan', true),
            'jabatan' => $this->input->post('jabatan', true),
            'role' => $this->input->post('role', true)
        ];

        return $this->db->insert('user', $data);
    }

    public function updateDataUser($id)
    {
        $data = [
            'id_jurusan' => $this->input->post('id_jurusan', true),
            'id_prodi' => $this->input->post('id_prodi', true),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'nip' => $this->input->post('nip', true),
            'pangkat' => $this->input->post('pangkat', true),
            'golongan' => $this->input->post('golongan', true),
            'jabatan' => $this->input->post('jabatan', true),
            'role' => $this->input->post('role', true)
        ];

        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function updateDataTtd($id)
    {
        // Konfigurasi upload
        $config['upload_path'] = './uploads/ttd/';
        $config['allowed_types'] = 'png';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE;

        // Load library upload
        $this->load->library('upload', $config);

        // Data untuk update
        $data = [
            'id_jurusan' => $this->input->post('id_jurusan', true),
            'id_prodi' => $this->input->post('id_prodi', true),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'nip' => $this->input->post('nip', true),
            'pangkat' => $this->input->post('pangkat', true),
            'golongan' => $this->input->post('golongan', true),
            'jabatan' => $this->input->post('jabatan', true),
            'role' => $this->input->post('role', true)
        ];

        // Cek apakah ada file yang diupload
        if (!empty($_FILES['ttd']['name'])) {
            if ($this->upload->do_upload('ttd')) {
                $uploaded_data = $this->upload->data();
                // Hapus file lama jika ada
                $old_file = $this->db->get_where('user', ['id' => $id])->row_array();
                if ($old_file['ttd'] && file_exists('./uploads/ttd/' . $old_file['ttd'])) {
                    unlink('./uploads/ttd/' . $old_file['ttd']);
                }

                $data['ttd'] = $uploaded_data['file_name']; // Simpan nama file yang diupload
            }
        }

        // Update data pengguna
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function deleteDataUser($id)
    {
        return $this->db->delete('user', ['id' => $id]);
    }

    public function readDataUser($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function getDataJumlahUser()
    {
        return $this->db->get('user')->num_rows();
    }

    public function getDataUser()
    {
        return $this->db->get('user')->result_array();
    }

    public function getDataKajur()
    {
        $this->db->where('role', 'Kajur');
        return $this->db->get('user')->result_array();
    }

    public function getDataWadek()
    {
        $this->db->where('role', 'Wadek');
        return $this->db->get('user')->result_array();
    }
}
