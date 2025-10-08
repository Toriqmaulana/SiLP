<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wadek extends CI_Controller
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
        $data['total_disposisi'] = $this->kelola_surat_model->getAllDataJumlahDisposisiWadek($_SESSION['id_user']);
        $data['jumlah_terbaru'] = $this->kelola_surat_model->getDataJumlahDisposisiTerbaruWadek($_SESSION['id_user']);
        $data['jumlah_diproses'] = $this->kelola_surat_model->getDataJumlahDisposisiDiprosesWadek($_SESSION['id_user']);
        $data['jumlah_selesai'] = $this->kelola_surat_model->getDataJumlahDisposisiSelesaiWadek($_SESSION['id_user']);

        // Data untuk grafik
        $data['labels_grafik'] = $this->kelola_surat_model->getLabelsGrafik();
        $data['data_grafik'] = $this->kelola_surat_model->getDataGrafikWadek($_SESSION['id_user']);

        // Data disposisi terbaru
        $data['disposisi_terbaru'] = $this->kelola_surat_model->getDataDisposisiTerbaruWadek($_SESSION['id_user']);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        if (!empty($data['disposisi_terbaru'])) {
            foreach ($data['disposisi_terbaru'] as &$d) {
                $d['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($d['id']);
                $d['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($d['id']);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/wadek', $data);
        $this->load->view('templates/footer');
    }

    public function disposisiWadek()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterDisposisi($_SESSION['id_user']);
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        if (!empty($data['kelola_pengajuan'])) {
            foreach ($data['kelola_pengajuan'] as &$kp) {
                $kp['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($kp['id']);
                $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_wadek/disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function detailSuratMasukWadek($id)
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
        $this->load->view('pages_wadek/kelola_surat_masuk/view_tambah', $data);
        // $this->load->view('templates/footer');
    }

    public function tambahDisposisiWadek($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->kelola_disposisi_model->readDisposisi($id);
        $data['status'] = $this->kelola_status_model->getAllStatus();

        $data_pengajuan = $this->kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_wadek/kelola_disposisi/tambah', $data);
        // $this->load->view('templates/footer');
    }

    public function tambahAksiDisposisiWadek($id)
    {
        $this->_rulesAddDisposisi();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahDisposisiWadek($id);
        } else {
            $this->kelola_disposisi_model->insertDataDisposisiWadek($id);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('disposisiWadek');
        }
    }

    public function lihatSuratMasukWadek($id)
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
        $this->load->view('pages_wadek/kelola_surat_masuk/view_edit', $data);
        // $this->load->view('templates/footer');
    }

    public function editDisposisiWadek($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->kelola_disposisi_model->readDisposisi($id);
        $data['status'] = $this->kelola_status_model->getAllStatus();

        $data_pengajuan = $this->kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_wadek/kelola_disposisi/edit', $data);
        // $this->load->view('templates/footer');
    }

    public function editAksiDisposisiWadek($id)
    {
        $this->_rulesEditDisposisi();

        if ($this->form_validation->run() == FALSE) {
            $this->editDisposisiWadek($id);
        } else {
            $this->kelola_disposisi_model->updateDataDisposisiWadek($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('disposisiWadek');
        }
    }

    public function detailDisposisiWadek($id)
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
        $this->load->view('pages_wadek/kelola_disposisi/view', $data);
        // $this->load->view('templates/footer');
    }

    public function printDisposisiWadek($id)
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
        $this->load->view('pages_wadek/kelola_disposisi/print', $data);
        // $this->load->view('templates/footer');
    }

    public function arsipDisposisiWadek()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Arsip Disposisi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterDisposisi($_SESSION['id_user']);
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        if (!empty($data['kelola_pengajuan'])) {
            foreach ($data['kelola_pengajuan'] as &$kp) {
                $kp['pengajuan'] = $this->kelola_surat_model->getDataPengajuan($kp['id']);
                $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_wadek/arsip_disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function profileWadek()
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
            'Dosen',
            'Kaprodi',
            'Kajur'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_wadek/kelola_profile/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editProfileWadek($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $this->kelola_user_model->updateDataUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-warning mb-0" role="alert"><strong>Berhasil Diubah!</strong></div>');
        redirect('profileWadek');
    }

    public function _rulesAddDisposisi()
    {
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        // Ambil jabatan user yang sedang login
        $user_jabatan = strtolower(str_replace(' ', '', $data['user']->jabatan));

        // Aturan untuk isi disposisi sesuai jabatan
        if ($user_jabatan == 'wadek1') {
            $this->form_validation->set_rules('isi_disposisi_wadek1', 'Isi disposisi Wadek 1', 'trim|required');
        } elseif ($user_jabatan == 'wadek2') {
            $this->form_validation->set_rules('isi_disposisi_wadek2', 'Isi disposisi Wadek 2', 'trim|required');
        } elseif ($user_jabatan == 'wadek3') {
            $this->form_validation->set_rules('isi_disposisi_wadek3', 'Isi disposisi Wadek 3', 'trim|required');
        }

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditDisposisi()
    {
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        // Ambil jabatan user yang sedang login
        $user_jabatan = strtolower(str_replace(' ', '', $data['user']->jabatan));

        // Aturan untuk isi disposisi sesuai jabatan
        if ($user_jabatan == 'wadek1') {
            $this->form_validation->set_rules('isi_disposisi_wadek1', 'Isi disposisi Wadek 1', 'trim|required');
        } elseif ($user_jabatan == 'wadek2') {
            $this->form_validation->set_rules('isi_disposisi_wadek2', 'Isi disposisi Wadek 2', 'trim|required');
        } elseif ($user_jabatan == 'wadek3') {
            $this->form_validation->set_rules('isi_disposisi_wadek3', 'Isi disposisi Wadek 3', 'trim|required');
        }

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }
}
