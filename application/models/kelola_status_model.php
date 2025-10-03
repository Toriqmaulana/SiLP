<?php

class kelola_status_model extends CI_Model
{
    public function getAllStatus()
    {
        return $this->db->get('status')->result_array();
    }

    public function getDataJumlahStatus()
    {
        return $this->db->get('status')->num_rows();
    }

    public function getDataNamaStatusWadek($id)
    {
        $this->db->where('id', $id);
        $surat = $this->db->get('surat')->row();

        $wadek = $this->db->get('user')->result_array();

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($surat)) {
            $id_wadek = [];
            $pilih_wadek_list = [];
            $pilih_wadek_ids = explode(',', $surat->pilih_wadek);

            foreach ($wadek as $wk) {
                if (in_array($wk['id'], $pilih_wadek_ids)) {
                    $id_wadek[] = $wk['id'];
                    $pilih_wadek_list[] = $wk['jabatan'];
                }
            }

            $nama_status = 'Lembar Disposisi Diteruskan Ke ' . implode(', ', $pilih_wadek_list);

            $jabatan_wadek = implode('<br>', $pilih_wadek_list);

            if (!empty($id_wadek)) {
                $this->db->where('id_pengajuan_surat', $id);
                $this->db->where_in('id_user', $id_wadek);
                $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Kabag TU');
                $status = $this->db->get('status')->result_array();

                $update_status = [];

                foreach ($status as $s) {
                    $update_status[] = format_tanggal_waktu($s['update_status']);
                }

                $update = implode('<br>', $update_status);

                return [
                    'nama_status' => $nama_status,
                    'jabatan_wadek' => $jabatan_wadek,
                    'update' => $update
                ];
            } else {
                // Jika $id_wadek kosong, kembalikan nilai yang sesuai
                return [
                    'nama_status' => '',
                    'jabatan_wadek' => '',
                    'update' => ''
                ];
            }
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }
}
