<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kajur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('auth_model');
        $this->load->model('kelola_user_model');
        $this->load->model('kelola_prodi_model');
        $this->load->model('kelola_jenis_surat_model');
        $this->load->model('kelola_surat_model');
        $this->load->model('kelola_sm_model');
        $this->load->model('kelola_disposisi_model');
        $this->load->model('kelola_sk_model');
        $this->load->model('kelola_status_model');
        $this->load->helper('date');
    }

    public function index()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kajur') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Dashboard';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        // Data statistik
        $data['total_sm'] = $this->kelola_surat_model->getAllDataJumlahSuratMasukKajur($_SESSION['id_user']);
        $data['jumlah_terbaru'] = $this->kelola_surat_model->getDataJumlahSuratMasukTerbaruKajur($_SESSION['id_user']);
        $data['jumlah_disetujui'] = $this->kelola_surat_model->getDataJumlahSuratMasukDisetujuiKajur($_SESSION['id_user']);
        $data['jumlah_ditolak'] = $this->kelola_surat_model->getDataJumlahSuratMasukDitolakKajur($_SESSION['id_user']);
        $data['jumlah_diproses'] = $this->kelola_surat_model->getDataJumlahSuratMasukDiprosesKajur($_SESSION['id_user']);
        $data['jumlah_selesai'] = $this->kelola_surat_model->getDataJumlahSuratMasukSelesaiKajur($_SESSION['id_user']);

        // Data untuk grafik
        $data['labels_grafik'] = $this->kelola_surat_model->getLabelsGrafik();
        $data['data_grafik'] = $this->kelola_surat_model->getDataGrafikKajur($_SESSION['id_user']);

        // Data surat masuk terbaru
        $data['sm_terbaru'] = $this->kelola_surat_model->getDataSuratMasukTerbaruKajur($_SESSION['id_user']);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        if (!empty($data['sm_terbaru'])) {
            foreach ($data['sm_terbaru'] as &$s) {
                $s['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($s['id']);
                $s['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($s['id']);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/kajur', $data);
        $this->load->view('templates/footer');
    }

    public function suratKajur()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kajur') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Surat Masuk';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterSuratMasuk($_SESSION['id_user']);
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kajur/surat_masuk', $data);
        $this->load->view('templates/footer');
    }

    public function detailSuratMasukKajur($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kajur') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Detail Surat Masuk';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_sm'] = $this->kelola_sm_model->readSuratMasuk($id);

        $data_sm = $this->kelola_sm_model->getDataSuratMasuk($id);
        $data['nama'] = $data_sm['nama'];
        $data['nip'] = $data_sm['nip'];
        $data['prodi'] = $data_sm['nama_prodi'];
        $data['jurusan'] = $data_sm['nama_jurusan'];
        $data['nama_kaprodi'] = $data_sm['nama_kaprodi'];
        $data['nama_kajur'] = $data_sm['nama_kajur'];
        $data['nip_kaprodi'] = $data_sm['nip_kaprodi'];
        $data['nip_kajur'] = $data_sm['nip_kajur'];
        $data['ttd_kaprodi'] = $data_sm['ttd_kaprodi'];
        $data['ttd_kajur'] = $data_sm['ttd_kajur'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kajur/kelola_surat_masuk/view', $data);
        // $this->load->view('templates/footer');
    }

    public function approveSuratMasukKajur($id)
    {
        $this->_rulesStatus();

        if ($this->form_validation->run() == FALSE) {
            $this->detailSuratMasukKajur($id);
        } else {
            $this->kelola_surat_model->approveSuratMasuk($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Berhasil!</strong></div>');
            redirect('suratKajur');
        }
    }

    public function printSuratMasukKajur($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kajur') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Print Surat Masuk';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_sm'] = $this->kelola_sm_model->readSuratMasuk($id);

        $data_sm = $this->kelola_sm_model->getDataSuratMasuk($id);
        $data['nama'] = $data_sm['nama'];
        $data['nip'] = $data_sm['nip'];
        $data['prodi'] = $data_sm['nama_prodi'];
        $data['jurusan'] = $data_sm['nama_jurusan'];
        $data['nama_kaprodi'] = $data_sm['nama_kaprodi'];
        $data['nama_kajur'] = $data_sm['nama_kajur'];
        $data['nip_kaprodi'] = $data_sm['nip_kaprodi'];
        $data['nip_kajur'] = $data_sm['nip_kajur'];
        $data['ttd_kaprodi'] = $data_sm['ttd_kaprodi'];
        $data['ttd_kajur'] = $data_sm['ttd_kajur'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kajur/kelola_surat_masuk/print', $data);
        // $this->load->view('templates/footer');
    }

    public function arsipSuratMasukKajur()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kajur') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Arsip Surat Masuk';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterSuratMasuk($_SESSION['id_user']);
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kajur/arsip_sm', $data);
        $this->load->view('templates/footer');
    }

    public function profileKajur()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kajur') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Profile';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $id = $_SESSION['id_user'];
        $data['kelola_user'] = $this->kelola_user_model->readDataUser($id);
        $data['jurusan'] = $this->kelola_prodi_model->getDataJurusan();
        $data['prodi'] = $this->kelola_prodi_model->getDataProdi();
        $data['role_user'] = [
            'Dekan',
            'Wadek',
            'Kabag_TU',
            'Staf',
            'Dosen',
            'Kaprodi',
            'Kajur'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kajur/kelola_profile/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editProfileKajur($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kajur') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $this->kelola_user_model->updateDataTtd($id);
        $this->session->set_flashdata('message', '<div class="alert alert-warning mb-0" role="alert"><strong>Berhasil Diubah!</strong></div>');
        redirect('profileKajur');
    }

    public function _rulesStatus()
    {
        $this->form_validation->set_rules('status', 'Approved', 'required');

        $this->form_validation->set_message('required', '%s harus dipilih!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }
}
