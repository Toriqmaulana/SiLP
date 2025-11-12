<?php

class Kelola_user_model extends CI_Model
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

    public function updateDataProfile($id)
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true))
        ];

        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function updateDataProfilePassword($id)
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true))
        ];

        // Cek password baru jika ada perubahan password lama
        $passnow = $this->input->post('passnow', true);
        $passnew = $this->input->post('passnew', true);
        $pass = $this->db->get_where('user', ['id' => $id])->row_array();

        // Validasi password lama salah
        if (!password_verify($passnow, $pass['password'])) {
            // Jika password lama salah, kembalikan pesan error
            return 'password_salah';
        }

        // Validasi password baru tidak boleh sama dengan password lama
        if ($passnow == $passnew) {
            // Jika password baru sama dengan password lama, kembalikan pesan error
            return 'password_sama';
        }

        // Jika password valid, hash password baru
        $password = password_hash($passnew, PASSWORD_BCRYPT);
        $data['password'] = $password;

        $this->db->where('id', $id);
        $updateStatus = $this->db->update('user', $data);
        return $updateStatus ? 'password_berhasil' : 'gagal_update';
    }

    public function updateDataProfileTtd($id)
    {
        // Data untuk update
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true))
        ];

        // Cek apakah ada file yang diupload
        if (!empty($_FILES['ttd']['name'])) {
            // Konfigurasi upload
            $config['upload_path'] = './uploads/ttd/';
            $config['allowed_types'] = 'png';
            $config['max_size'] = 5120; // 5MB
            $config['encrypt_name'] = TRUE;

            // Load library upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('ttd')) {
                // Hapus file lama jika ada
                $old_file = $this->db->get_where('user', ['id' => $id])->row_array();
                if ($old_file['ttd'] && file_exists('./uploads/ttd/' . $old_file['ttd'])) {
                    unlink('./uploads/ttd/' . $old_file['ttd']);
                }

                $uploaded_data = $this->upload->data('file_name');
                $data['ttd'] = $uploaded_data; // Simpan nama file yang diupload
            }
        }

        // Update data pengguna
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function updateDataProfileTtdPassword($id)
    {
        // Data untuk update
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true))
        ];

        // Cek apakah ada file yang diupload
        if (!empty($_FILES['ttd']['name'])) {
            // Konfigurasi upload
            $config['upload_path'] = './uploads/ttd/';
            $config['allowed_types'] = 'png';
            $config['max_size'] = 5120; // 5MB
            $config['encrypt_name'] = TRUE;

            // Load library upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('ttd')) {
                // Hapus file lama jika ada
                $old_file = $this->db->get_where('user', ['id' => $id])->row_array();
                if ($old_file['ttd'] && file_exists('./uploads/ttd/' . $old_file['ttd'])) {
                    unlink('./uploads/ttd/' . $old_file['ttd']);
                }

                $uploaded_data = $this->upload->data('file_name');
                $data['ttd'] = $uploaded_data; // Simpan nama file yang diupload
            }
        }

        // Cek password baru jika ada perubahan password lama
        $passnow = $this->input->post('passnow', true);
        $passnew = $this->input->post('passnew', true);
        $pass = $this->db->get_where('user', ['id' => $id])->row_array();

        // Validasi password lama salah
        if (!password_verify($passnow, $pass['password'])) {
            // Jika password lama salah, kembalikan pesan error
            return 'password_salah';
        }

        // Validasi password baru tidak boleh sama dengan password lama
        if ($passnow == $passnew) {
            // Jika password baru sama dengan password lama, kembalikan pesan error
            return 'password_sama';
        }

        // Jika password valid, hash password baru
        $password = password_hash($passnew, PASSWORD_BCRYPT);
        $data['password'] = $password;

        // Update data pengguna
        $this->db->where('id', $id);
        $updateStatus = $this->db->update('user', $data);
        return $updateStatus ? 'password_berhasil' : 'gagal_update';
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
