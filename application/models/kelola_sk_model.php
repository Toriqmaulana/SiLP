<?php

class kelola_sk_model extends CI_Model
{
    public function generateNomorSuratKeluar($id)
    {
        $bulan_sekarang = date('m');
        $tahun_sekarang = date('Y');

        // Ambil data pengajuan surat berdasarkan ID
        $this->db->where('id', $id);
        $pengajuan = $this->db->get('surat')->row();

        $jenis_surat = $this->db->get('jenis_surat')->result_array();

        $jenis_surat_ids = explode(',', $pengajuan->jenis_surat);

        // Inisialisasi array untuk menyimpan nomor surat
        $nomor_surat = [];

        // Proses setiap jenis surat yang dipilih
        foreach ($jenis_surat as $js) {
            if (in_array($js['id'], $jenis_surat_ids)) {
                // Nomor surat keluar sesuai dengan id jenis surat
                $nomor_surat[$js['id']] = $js['kode_surat'] . $pengajuan->nomor_urut_disposisi . $js['nomor_surat'] . '/' . $bulan_sekarang . '/' . $tahun_sekarang;
            }
        }

        return $nomor_surat;
    }

    public function insertNomorSuratKeluar($id)
    {
        $this->db->where('id', $id);
        $pengajuan = $this->db->get('surat')->row();

        $jenis_surat = $this->db->get('jenis_surat')->result_array();

        $jenis_surat_ids = explode(',', $pengajuan->jenis_surat);

        // Inisialisasi array untuk menyimpan nomor surat
        $nomor_surat = [];

        // Proses setiap jenis surat yang dipilih
        foreach ($jenis_surat as $js) {
            if (in_array($js['id'], $jenis_surat_ids)) {
                // Simpan nomor surat ke dalam array
                $nomor_surat['nomor_' . strtolower($js['nama_jenis_surat'])] = $this->input->post('nomor_' . strtolower($js['nama_jenis_surat']), true);
            }
        }

        // Simpan data yang sudah disubmit ke dalam database
        $data = [
            'id_pembuat_sk' => $_SESSION['id_user'],
            'tanggal_buat_sk' => date('Y-m-d H:i:s'),
            'status' => $this->input->post('status', true),
            'buat_sk' => $this->input->post('buat_sk', true)
        ];

        // Masukkan nomor surat ke dalam array data
        foreach ($nomor_surat as $ns => $nomor) {
            $data[$ns] = $nomor;
        }

        // Update data surat
        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        // Menyimpan status surat ke tabel status
        $data1 = [
            'id_pengajuan_surat' => $id,
            'id_user' => $_SESSION['id_user'],
            'status' => $data['status'],
            'update_status' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('status', $data1);

        // Update data detail surat
        // $data2 = $data;
        // $this->db->where('id_pengajuan_surat', $id);
        // $this->db->update('detail_surat', $data2);

        return true;
    }

    public function insertSuratKeluar($id)
    {
        $this->db->where('id', $id);
        $pengajuan = $this->db->get('surat')->row();

        $jenis_surat = $this->db->get('jenis_surat')->result_array();

        $jenis_surat_ids = explode(',', $pengajuan->jenis_surat);

        // Inisialisasi array untuk menyimpan nama file yang di-upload
        $file_surat = [];

        // Proses setiap jenis surat yang dipilih
        foreach ($jenis_surat as $js) {
            if (in_array($js['id'], $jenis_surat_ids)) {
                // Tentukan key untuk setiap file
                $file_key = 'file_' . strtolower($js['nama_jenis_surat']);

                // Periksa apakah file ada yang diupload
                if ($_FILES[$file_key]['name']) {
                    // Konfigurasi upload file
                    $config['upload_path'] = './uploads/sk/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 5120; // Maksimal 5MB
                    $config['encrypt_name'] = TRUE; // Enkripsi nama file

                    // Inisialisasi library upload
                    $this->upload->initialize($config);

                    // Proses upload file
                    if ($this->upload->do_upload($file_key)) {
                        // Ambil data upload
                        $upload_file = $this->upload->data();
                        // Simpan nama file yang di-upload ke dalam array
                        $file_surat[$file_key] = $upload_file['file_name'];
                    }
                }
            }
        }

        // Simpan data yang sudah disubmit ke dalam database
        $data = [
            'status' => $this->input->post('status', true)
        ];

        // Masukkan nama file ke dalam array data
        foreach ($file_surat as $fs => $file_name) {
            $data[$fs] = $file_name;
        }

        // Update data surat
        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        // Menyimpan status surat ke tabel status
        $data1 = [
            'id_pengajuan_surat' => $id,
            'id_user' => $_SESSION['id_user'],
            'status' => $data['status'],
            'update_status' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('status', $data1);

        return true;
    }

    public function readSuratKeluar($id)
    {
        return $this->db->get_where('surat', ['id' => $id])->row_array();
    }
}
