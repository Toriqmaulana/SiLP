<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data['jumlah_pengguna'] = $this->kelola_user_model->getDataJumlahUser();
        $data['jumlah_prodi'] = $this->kelola_prodi_model->getDataJumlahProdi();
        $data['jumlah_jurusan'] = $this->kelola_prodi_model->getDataJumlahJurusan();
        $data['jumlah_jenis_surat'] = $this->kelola_jenis_surat_model->getDataJumlahJenisSurat();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/admin', $data);
        $this->load->view('templates/footer');
    }

    public function pengguna()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Pengguna';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_user'] = $this->kelola_user_model->getDataUser();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/pengguna', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPengguna()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Pengguna';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['jurusan'] = $this->kelola_prodi_model->getDataJurusan();
        $data['prodi'] = $this->kelola_prodi_model->getDataProdi();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/kelola_pengguna/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahAksiPengguna()
    {
        $this->_rulesAddUser();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahPengguna();
        } else {
            $this->kelola_user_model->insertDataUser();
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('pengguna');
        }
    }

    public function editPengguna($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Pengguna';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
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
            // 'Admin'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/kelola_pengguna/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editAksiPengguna($id)
    {
        $this->_rulesEditUser();

        if ($this->form_validation->run() == FALSE) {
            $this->editPengguna($id);
        } else {
            $this->kelola_user_model->updateDataUser($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('pengguna');
        }
    }

    public function hapusPengguna($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        $this->kelola_user_model->deleteDataUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Berhasil Dihapus!</strong></div>');
        redirect('pengguna');
    }

    public function prodi()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Prodi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_prodi'] = $this->kelola_prodi_model->getDataProdi();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/prodi', $data);
        $this->load->view('templates/footer');
    }

    public function tambahProdi()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Prodi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/kelola_prodi/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahAksiProdi()
    {
        $this->_rulesAddProdi();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahProdi();
        } else {
            $this->kelola_prodi_model->insertDataProdi();
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('prodi');
        }
    }

    public function editProdi($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Prodi';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_prodi'] = $this->kelola_prodi_model->readDataProdi($id);

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/kelola_prodi/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editAksiProdi($id)
    {
        $this->_rulesEditProdi();

        if ($this->form_validation->run() == FALSE) {
            $this->editProdi($id);
        } else {
            $this->kelola_prodi_model->updateDataProdi($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('prodi');
        }
    }

    public function hapusProdi($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        $this->kelola_prodi_model->deleteDataProdi($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Berhasil Dihapus!</strong></div>');
        redirect('prodi');
    }

    public function jurusan()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Jurusan';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_jurusan'] = $this->kelola_prodi_model->getDataJurusan();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/jurusan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahJurusan()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Jurusan';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/kelola_jurusan/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahAksiJurusan()
    {
        $this->_rulesAddJurusan();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahJurusan();
        } else {
            $this->kelola_prodi_model->insertDataJurusan();
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('jurusan');
        }
    }

    public function editJurusan($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Jurusan';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_jurusan'] = $this->kelola_prodi_model->readDataJurusan($id);

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/kelola_jurusan/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editAksiJurusan($id)
    {
        $this->_rulesEditJurusan();

        if ($this->form_validation->run() == FALSE) {
            $this->editJurusan($id);
        } else {
            $this->kelola_prodi_model->updateDataJurusan($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('jurusan');
        }
    }

    public function hapusJurusan($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        $this->kelola_prodi_model->deleteDataJurusan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Berhasil Dihapus!</strong></div>');
        redirect('jurusan');
    }

    public function jenisSurat()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Jenis Surat';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/jenis_surat', $data);
        $this->load->view('templates/footer');
    }

    public function tambahJenisSurat()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Jenis Surat';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/kelola_jenis_surat/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahAksiJenisSurat()
    {
        $this->_rulesAddJenisSurat();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahJenisSurat();
        } else {
            $this->kelola_jenis_surat_model->insertDataJenisSurat();
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('jenisSurat');
        }
    }

    public function editJenisSurat($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Jenis Surat';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->readDataJenisSurat($id);
        $data['role_access'] = [
            'Pemohon',
            'Kaprodi'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_admin/kelola_jenis_surat/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editAksiJenisSurat($id)
    {
        $this->_rulesEditJenisSurat();

        if ($this->form_validation->run() == FALSE) {
            $this->editJenisSurat($id);
        } else {
            $this->kelola_jenis_surat_model->updateDataJenisSurat($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('jenisSurat');
        }
    }

    public function hapusJenisSurat($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        $this->kelola_jenis_surat_model->deleteDataJenisSurat($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Berhasil Dihapus!</strong></div>');
        redirect('jenisSurat');
    }

    public function _rulesAddUser()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]', ['is_unique' => '%s sudah ada, silahkan ganti username!']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]', ['min_length' => '%s terlalu pendek!']);
        $this->form_validation->set_rules('passconf', 'Konfirmasi password', 'trim|required|matches[password]', ['matches' => '%s tidak sesuai dengan password!']);
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required');
        $this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
        $this->form_validation->set_rules('golongan', 'Golongan', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required', ['required' => '%s harus dipilih!']);
        $this->form_validation->set_rules('role', 'Role', 'required', ['required' => '%s harus dipilih!']);

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditUser()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required');
        $this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
        $this->form_validation->set_rules('golongan', 'Golongan', 'trim|required');

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesAddProdi()
    {
        $this->form_validation->set_rules('kode_prodi', 'Kode prodi', 'trim|required|is_unique[prodi.kode_prodi]', ['is_unique' => 'Silahkan ganti kode prodi!']);
        $this->form_validation->set_rules('nama_prodi', 'Nama prodi', 'trim|required|is_unique[prodi.nama_prodi]', ['is_unique' => 'Silahkan ganti nama prodi!']);

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditProdi()
    {
        $this->form_validation->set_rules('kode_prodi', 'Kode prodi', 'trim|required');
        $this->form_validation->set_rules('nama_prodi', 'Nama prodi', 'trim|required');

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesAddJurusan()
    {
        $this->form_validation->set_rules('kode_jurusan', 'Kode jurusan', 'trim|required|is_unique[jurusan.kode_jurusan]', ['is_unique' => 'Silahkan ganti kode jurusan!']);
        $this->form_validation->set_rules('nama_jurusan', 'Nama jurusan', 'trim|required|is_unique[jurusan.nama_jurusan]', ['is_unique' => 'Silahkan ganti nama jurusan!']);

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditJurusan()
    {
        $this->form_validation->set_rules('kode_jurusan', 'Kode jurusan', 'trim|required');
        $this->form_validation->set_rules('nama_jurusan', 'Nama jurusan', 'trim|required');

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesAddJenisSurat()
    {
        $this->form_validation->set_rules('nama_surat', 'Nama surat', 'trim|required|is_unique[jenis_surat.nama_surat]', ['is_unique' => 'Silahkan ganti nama surat!']);
        $this->form_validation->set_rules('nama_jenis_surat', 'Nama jenis surat', 'trim|required|is_unique[jenis_surat.nama_jenis_surat]', ['is_unique' => 'Silahkan ganti nama jenis surat!']);
        $this->form_validation->set_rules('role_access[]', 'Role Access', 'required', ['required' => '%s harus dipilih!']);

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditJenisSurat()
    {
        $this->form_validation->set_rules('nama_surat', 'Nama surat', 'trim|required');
        $this->form_validation->set_rules('nama_jenis_surat', 'Nama jenis surat', 'trim|required');
        $this->form_validation->set_rules('role_access[]', 'Role Access', 'required', ['required' => '%s harus dipilih!']);

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }
}
