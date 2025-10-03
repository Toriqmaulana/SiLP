<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dekan extends CI_Controller
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
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Dashboard';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        // Data statistik
        $data['total_disposisi'] = $this->kelola_surat_model->getAllDataJumlahDisposisiDekan();
        $data['jumlah_terbaru'] = $this->kelola_surat_model->getDataJumlahDisposisiTerbaruDekan();
        $data['jumlah_diproses'] = $this->kelola_surat_model->getDataJumlahDisposisiDiprosesDekan();
        $data['jumlah_selesai'] = $this->kelola_surat_model->getDataJumlahDisposisiSelesaiDekan();

        // Data untuk grafik
        $data['labels_grafik'] = $this->kelola_surat_model->getLabelsGrafik();
        $data['data_grafik'] = $this->kelola_surat_model->getDataGrafikDekan();

        // Data disposisi terbaru
        $data['disposisi_terbaru'] = $this->kelola_surat_model->getDataDisposisiTerbaruDekan();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        if (!empty($data['disposisi_terbaru'])) {
            foreach ($data['disposisi_terbaru'] as &$d) {
                $d['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($d['id']);
                $d['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($d['id']);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/dekan', $data);
        $this->load->view('templates/footer');
    }

    public function disposisiDekan()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Disposisi';
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
        $this->load->view('pages_dekan/disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function detailSuratMasukDekan($id)
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
        $this->load->view('pages_dekan/kelola_surat_masuk/view_tambah', $data);
        // $this->load->view('templates/footer');
    }

    public function tambahDisposisiDekan($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->kelola_disposisi_model->readDisposisi($id);
        $data['wadek'] = $this->kelola_user_model->getDataWadek();
        $data['status'] = $this->kelola_status_model->getAllStatus();

        $data_pengajuan = $this->kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_dekan/kelola_disposisi/tambah', $data);
        // $this->load->view('templates/footer');
    }

    public function tambahAksiDisposisiDekan($id)
    {
        $this->_rulesAddDisposisi();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahDisposisiDekan($id);
        } else {
            $this->kelola_disposisi_model->insertDataDisposisiDekan($id);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('disposisiDekan');
        }
    }

    public function lihatSuratMasukDekan($id)
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
        $this->load->view('pages_dekan/kelola_surat_masuk/view_edit', $data);
        // $this->load->view('templates/footer');
    }

    public function editDisposisiDekan($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->kelola_disposisi_model->readDisposisi($id);
        $data['wadek'] = $this->kelola_user_model->getDataWadek();
        $data['status'] = $this->kelola_status_model->getAllStatus();

        $data_pengajuan = $this->kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_dekan/kelola_disposisi/edit', $data);
        // $this->load->view('templates/footer');
    }

    public function editAksiDisposisiDekan($id)
    {
        $this->_rulesEditDisposisi();

        if ($this->form_validation->run() == FALSE) {
            $this->editDisposisiDekan($id);
        } else {
            $this->kelola_disposisi_model->updateDataDisposisiDekan($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('disposisiDekan');
        }
    }

    public function detailDisposisiDekan($id)
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
        $this->load->view('pages_dekan/kelola_disposisi/view', $data);
        // $this->load->view('templates/footer');
    }

    public function printDisposisiDekan($id)
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
        $this->load->view('pages_dekan/kelola_disposisi/print', $data);
        // $this->load->view('templates/footer');
    }

    public function arsipDisposisiDekan()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Arsip Disposisi';
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
        $this->load->view('pages_dekan/arsip_disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function profileDekan()
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
        $this->load->view('pages_dekan/kelola_profile/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editProfileDekan($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $this->kelola_user_model->updateDataUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-warning mb-0" role="alert"><strong>Berhasil Diubah!</strong></div>');
        redirect('profileDekan');
    }

    public function _rulesAddDisposisi()
    {
        $this->form_validation->set_rules('isi_disposisi_dekan', 'Isi disposisi', 'trim|required');
        $this->form_validation->set_rules('pilih_wadek[]', 'Wakil dekan', 'required', ['required' => '%s harus dipilih!']);

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditDisposisi()
    {
        $this->form_validation->set_rules('isi_disposisi_dekan', 'Isi disposisi', 'trim|required');
        $this->form_validation->set_rules('pilih_wadek[]', 'Wakil dekan', 'required', ['required' => '%s harus dipilih!']);

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }
}
