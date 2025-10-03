<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staf extends CI_Controller
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
        $this->load->library('upload');
    }

    public function index()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Dashboard';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        // Data statistik
        $data['total_sm'] = $this->kelola_surat_model->getAllDataJumlahSuratMasukStaf();
        $data['jumlah_terbaru'] = $this->kelola_surat_model->getDataJumlahSuratMasukTerbaruStaf();
        $data['jumlah_diproses'] = $this->kelola_surat_model->getDataJumlahSuratMasukDiprosesStaf();
        $data['jumlah_selesai'] = $this->kelola_surat_model->getDataJumlahSuratMasukSelesaiStaf();

        // Data untuk grafik
        $data['labels_grafik'] = $this->kelola_surat_model->getLabelsGrafik();
        $data['data_grafik'] = $this->kelola_surat_model->getDataGrafikStaf();

        // Data surat masuk terbaru
        $data['sm_terbaru'] = $this->kelola_surat_model->getDataSuratMasukTerbaruStaf();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        if (!empty($data['sm_terbaru'])) {
            foreach ($data['sm_terbaru'] as &$s) {
                $s['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($s['id']);
                $s['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($s['id']);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/staf', $data);
        $this->load->view('templates/footer');
    }

    public function disposisiStaf()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterAllSuratMasuk();
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_staf/disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function tambahDisposisiStaf($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Disposisi';
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
        $this->load->view('pages_staf/kelola_disposisi/tambah', $data);
        // $this->load->view('templates/footer');
    }

    public function tambahAksiDisposisiStaf($id)
    {
        $this->_rulesAddDisposisi();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahDisposisiStaf($id);
        } else {
            $this->kelola_disposisi_model->insertDisposisi($id);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('disposisiStaf');
        }
    }

    public function editDisposisiStaf($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Disposisi';
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
        $this->load->view('pages_staf/kelola_disposisi/edit', $data);
        // $this->load->view('templates/footer');
    }

    public function editAksiDisposisiStaf($id)
    {
        $this->_rulesEditDisposisi();

        if ($this->form_validation->run() == FALSE) {
            $this->editDisposisiStaf($id);
        } else {
            $this->kelola_disposisi_model->updateDisposisi($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('disposisiStaf');
        }
    }

    public function detailDisposisiStaf($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Detail Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->kelola_disposisi_model->readDisposisi($id);
        $data['status'] = $this->kelola_status_model->getAllStatus();

        $data_pengajuan = $this->kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_staf/kelola_disposisi/detail', $data);
        // $this->load->view('templates/footer');
    }

    public function printDisposisiStaf($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Print Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->kelola_disposisi_model->readDisposisi($id);
        $data['status'] = $this->kelola_status_model->getAllStatus();

        $data_pengajuan = $this->kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_staf/kelola_disposisi/print', $data);
        // $this->load->view('templates/footer');
    }

    public function arsipDisposisiStaf()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Arsip Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterAllSuratMasuk();
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_staf/arsip_disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function suratStaf()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Surat Keluar';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterAllDisposisi();
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_staf/surat_keluar', $data);
        $this->load->view('templates/footer');
    }

    public function viewSuratMasukStaf($id)
    {
        if (!isset($_SESSION['logged_in'])) {
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
        $this->load->view('pages_staf/kelola_surat_masuk/view_tambah', $data);
        // $this->load->view('templates/footer');
    }

    public function tambahNoSuratKeluarStaf($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Surat Keluar';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_sk'] = $this->kelola_sk_model->readSuratKeluar($id);
        $data['nomor_sk'] = $this->kelola_sk_model->generateNomorSuratKeluar($id);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();
        $data['status'] = $this->kelola_status_model->getAllStatus();

        $data_pengajuan = $this->kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_staf/kelola_surat_keluar/tambah_nomor_surat_keluar', $data);
        // $this->load->view('templates/footer');
    }

    public function tambahAksiNoSuratKeluarStaf($id)
    {
        $this->_rulesAddNoSurat();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahNoSuratKeluarStaf($id);
        } else {
            $this->kelola_sk_model->insertNomorSuratKeluar($id);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('suratStaf');
        }
    }

    public function tambahSuratKeluarStaf($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Upload Surat Keluar';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_sk'] = $this->kelola_sk_model->readSuratKeluar($id);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_staf/kelola_surat_keluar/tambah_surat_keluar', $data);
        $this->load->view('templates/footer');
    }

    public function tambahAksiSuratKeluarStaf($id)
    {
        $this->_rulesAddSurat();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahSuratKeluarStaf($id);
        } else {
            $this->kelola_sk_model->insertSuratKeluar($id);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('arsipSuratKeluarStaf');
        }
    }

    public function arsipSuratKeluarStaf()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Arsip Surat Keluar';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterAllDisposisi();
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_staf/arsip_sk', $data);
        $this->load->view('templates/footer');
    }

    public function profileStaf()
    {
        if (!isset($_SESSION['logged_in'])) {
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
            'Pemohon',
            'Kaprodi',
            'Kajur'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_staf/kelola_profile/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editProfileStaf($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $this->kelola_user_model->updateDataUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-warning mb-0" role="alert"><strong>Berhasil Diubah!</strong></div>');
        redirect('profileStaf');
    }

    public function _rulesAddDisposisi()
    {
        $this->form_validation->set_rules('isi_ringkas', 'Isi ringkas', 'trim|required');

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditDisposisi()
    {
        $this->form_validation->set_rules('isi_ringkas', 'Isi ringkas', 'trim|required');

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesAddNoSurat()
    {
        $this->form_validation->set_rules('status', 'Status', 'trim|required', ['required' => '%s harus dipilih!']);

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesAddSurat()
    {
        $this->form_validation->set_rules('status', 'Status', 'trim|required', ['required' => '%s harus dipilih!']);

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }
}
