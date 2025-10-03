<?php

class kelola_sm_model extends CI_Model
{
    public function generateNomorSuratMasuk($id)
    {
        $bulan_sekarang = date('m');
        $tahun_sekarang = date('Y');

        $this->db->where('id', $id);
        $pengajuan = $this->db->get('surat')->row();

        $this->db->where('id', $pengajuan->id_prodi);
        $prodi = $this->db->get('prodi')->row();

        return $prodi->kode_prodi . '/' . $pengajuan->nomor_urut_pengajuan . '/' . $bulan_sekarang . '/' . $tahun_sekarang;
    }

    public function insertSuratMasuk($id)
    {
        $data = [
            'id_pembuat_sm' => $_SESSION['id_user'],
            'nomor_sm' => $this->input->post('nomor_sm', true),
            'tanggal_buat_sm' => date('Y-m-d H:i:s'),
            'isi_sm' => $this->input->post('isi_sm', false),
            'pilih_kajur' => $this->input->post('pilih_kajur', true),
            'status' => $this->input->post('status', true),
            'buat_sm' => $this->input->post('buat_sm', true)
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

    public function updateSuratMasuk($id)
    {
        $data = [
            'isi_sm' => $this->input->post('isi_sm', false),
            'pilih_kajur' => $this->input->post('pilih_kajur', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        return true;
    }

    public function readSuratMasuk($id)
    {
        return $this->db->get_where('surat', ['id' => $id])->row_array();
    }

    public function getDataSuratMasuk($id)
    {
        $this->db->where('id', $id);
        $surat = $this->db->get('surat')->row();

        $this->db->where('id', $surat->id_pemohon);
        $user = $this->db->get('user')->row();

        $this->db->where('id', $surat->id_prodi);
        $prodi = $this->db->get('prodi')->row();

        $this->db->where('id', $surat->id_jurusan);
        $jurusan = $this->db->get('jurusan')->row();

        $this->db->where('id', $surat->id_pembuat_sm);
        $kaprodi = $this->db->get('user')->row();

        $this->db->where('id', $surat->pilih_kajur);
        $kajur = $this->db->get('user')->row();

        return [
            'nama' => $user->nama,
            'nip' => $user->nip,
            'nama_prodi' => $prodi->nama_prodi,
            'nama_jurusan' => $jurusan->nama_jurusan,
            'nama_kaprodi' => $kaprodi->nama,
            'nama_kajur' => $kajur->nama,
            'nip_kaprodi' => $kaprodi->nip,
            'nip_kajur' => $kajur->nip,
            'ttd_kaprodi' => $kaprodi->ttd,
            'ttd_kajur' => $kajur->ttd
        ];
    }
}
