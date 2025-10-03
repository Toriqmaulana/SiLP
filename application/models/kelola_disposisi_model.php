<?php

class kelola_disposisi_model extends CI_Model
{
    public function insertDisposisi($id)
    {
        $bulan_sekarang = date('m');
        $tanggal_sekarang = date('d');

        if ($bulan_sekarang == '01' && $tanggal_sekarang == '01') {
            $no_urut_now = '01';
            $last_no = $no_urut_now;
        } else {
            // $this->db->where('id', $id);
            // $jenis_surat = $this->db->get('jenis_surat')->row();

            // $this->db->where('jenis_surat', $jenis_surat->id);
            $this->db->order_by('nomor_urut_disposisi', 'DESC');
            $this->db->limit(1);
            $last_pengajuan = $this->db->get('surat')->row();

            $no_urut = $last_pengajuan->nomor_urut_disposisi + 1;
            $no_urut_format = str_pad($no_urut, 2, '0', STR_PAD_LEFT);
            $last_no = $no_urut_format;
        }

        $data = [
            'id_pembuat_disposisi' => $_SESSION['id_user'],
            'nomor_urut_disposisi' => $last_no, // Simpan no urut disposisi
            'tanggal_terima_sm' => date('Y-m-d H:i:s'),
            'isi_ringkas' => $this->input->post('isi_ringkas', true),
            'status' => $this->input->post('status', true),
            'buat_disposisi' => $this->input->post('buat_disposisi', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        $data1 = [
            'id_pengajuan_surat' => $id,
            'id_user' => $_SESSION['id_user'],
            'status' => $data['status'],
            'update_status' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('status', $data1);

        return true;
    }

    public function insertDataDisposisiDekan($id)
    {
        $id_pilih_wadek = $this->input->post('pilih_wadek', true);

        if (!empty($id_pilih_wadek)) {
            // Sort wadek untuk konsistensi
            sort($id_pilih_wadek);

            // Gabungkan wadek menjadi string
            $pilih_wadek_string = implode(',', $id_pilih_wadek);
        }

        $wadek = $this->db->get('user')->result_array();

        $pilih_wadek_list = [];
        $pilih_wadek_ids = explode(',', $pilih_wadek_string);

        foreach ($wadek as $wk) {
            if (in_array($wk['id'], $pilih_wadek_ids)) {
                $pilih_wadek_list[] = $wk['jabatan'];
            }
        }

        // Gabungkan wadek menjadi string
        $status = 'Lembar Disposisi Diteruskan Ke ' . implode(', ', $pilih_wadek_list);

        $data = [
            'isi_disposisi_dekan' => $this->input->post('isi_disposisi_dekan', true),
            'pilih_wadek' => $pilih_wadek_string,
            'status' => $status,
            'diteruskan_kepada_dekan' => $this->input->post('diteruskan_kepada_dekan', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        $data1 = [
            'id_pengajuan_surat' => $id,
            'id_user' => $_SESSION['id_user'],
            'status' => $data['status'],
            'update_status' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('status', $data1);

        return true;
    }

    public function insertDataDisposisiWadek($id)
    {
        $id_wadek = $this->input->post('id_wadek', true);

        $this->db->where('id', $id_wadek);
        $user = $this->db->get('user')->row();

        // print_r($user);
        // exit;

        // Ambil data dari input
        $isi_disposisi = $this->input->post('isi_disposisi_' . strtolower(str_replace(' ', '', $user->jabatan)), true);
        $diteruskan_kepada = $this->input->post('diteruskan_kepada_' . strtolower(str_replace(' ', '', $user->jabatan)), true);

        // Data untuk tabel surat
        $data = [
            'isi_disposisi_' . strtolower(str_replace(' ', '', $user->jabatan)) => $isi_disposisi,
            'diteruskan_kepada_' . strtolower(str_replace(' ', '', $user->jabatan)) => $diteruskan_kepada
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        // Ambil data surat untuk tabel status
        $this->db->where('id', $id);
        $id_pengajuan = $this->db->get('surat')->row();

        // Pecah pilih_wadek menjadi array
        $pilih_wadek_ids = explode(',', $id_pengajuan->pilih_wadek);
        // Periksa apakah semua Wadek telah mengisi disposisi
        $all_filled = true;
        foreach ($pilih_wadek_ids as $pw) {
            // Ambil jabatan Wadek berdasarkan ID
            $wadek = $this->db->get_where('user', ['id' => $pw])->row();
            if ($wadek) {
                $wadek_jabatan = strtolower(str_replace(' ', '', $wadek->jabatan));
                if (empty($id_pengajuan->{'isi_disposisi_' . $wadek_jabatan})) {
                    $all_filled = false;
                    break;
                }
            }
        }

        // Jika semua Wadek telah mengisi disposisi, ubah status
        if ($all_filled) {
            $this->db->where('id', $id);
            $this->db->update('surat', ['status' => 'Lembar Disposisi Diteruskan Ke Kabag TU']);
        }

        // Data untuk tabel status
        $data1 = [
            'id_pengajuan_surat' => $id,
            'id_user' => $_SESSION['id_user'],
            // 'status' => $all_filled ? 'Lembar Disposisi Diteruskan Ke Kabag TU' : $id_pengajuan->status,
            'status' => 'Lembar Disposisi Diteruskan Ke Kabag TU',
            'update_status' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('status', $data1);

        return true;
    }

    public function insertDataDisposisiKabagtu($id)
    {
        $data = [
            'isi_disposisi_kabagtu' => $this->input->post('isi_disposisi_kabagtu', true),
            'status' => $this->input->post('status', true),
            'diteruskan_kepada_kabagtu' => $this->input->post('diteruskan_kepada_kabagtu', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        $data1 = [
            'id_pengajuan_surat' => $id,
            'id_user' => $_SESSION['id_user'],
            'status' => $data['status'],
            'update_status' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('status', $data1);

        return true;
    }

    public function updateDisposisi($id)
    {
        $data = [
            'isi_ringkas' => $this->input->post('isi_ringkas', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        return true;
    }

    public function updateDataDisposisiDekan($id)
    {
        $id_pilih_wadek = $this->input->post('pilih_wadek', true);

        if (!empty($id_pilih_wadek)) {
            // Sort wadek untuk konsistensi
            sort($id_pilih_wadek);

            // Gabungkan wadek menjadi string
            $pilih_wadek_string = implode(',', $id_pilih_wadek);
        }

        $wadek = $this->db->get('user')->result_array();

        $pilih_wadek_list = [];
        $pilih_wadek_ids = explode(',', $pilih_wadek_string);

        foreach ($wadek as $wk) {
            if (in_array($wk['id'], $pilih_wadek_ids)) {
                $pilih_wadek_list[] = $wk['jabatan'];
            }
        }

        // Gabungkan wadek menjadi string
        $status = 'Lembar Disposisi Diteruskan Ke ' . implode(', ', $pilih_wadek_list);

        $data = [
            'isi_disposisi_dekan' => $this->input->post('isi_disposisi_dekan', true),
            'pilih_wadek' => $pilih_wadek_string,
            'status' => $status
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        $this->db->delete('status', ['id_pengajuan_surat' => $id, 'id_user' => $_SESSION['id_user']]);

        $data1 = [
            'id_pengajuan_surat' => $id,
            'id_user' => $_SESSION['id_user'],
            'status' => $data['status'],
            'update_status' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('status', $data1);

        return true;
    }

    public function updateDataDisposisiWadek($id)
    {
        $id_wadek = $this->input->post('id_wadek', true);

        $this->db->where('id', $id_wadek);
        $user = $this->db->get('user')->row();

        // Ambil data dari input
        $isi_disposisi = $this->input->post('isi_disposisi_' . strtolower(str_replace(' ', '', $user->jabatan)), true);

        // Data untuk tabel surat
        $data = [
            'isi_disposisi_' . strtolower(str_replace(' ', '', $user->jabatan)) => $isi_disposisi
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        return true;
    }

    public function updateDataDisposisiKabagtu($id)
    {
        $data = [
            'isi_disposisi_kabagtu' => $this->input->post('isi_disposisi_kabagtu', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        return true;
    }

    public function readDisposisi($id)
    {
        return $this->db->get_where('surat', ['id' => $id])->row_array();
    }
}
