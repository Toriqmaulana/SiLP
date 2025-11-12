<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kabag_TU extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Auth_model');
        $this->load->model('Kelola_user_model');
        $this->load->model('Kelola_prodi_model');
        $this->load->model('Kelola_jenis_surat_model');
        $this->load->model('Kelola_surat_model');
        $this->load->model('Kelola_sm_model');
        $this->load->model('Kelola_disposisi_model');
        $this->load->model('Kelola_sk_model');
        $this->load->model('Kelola_status_model');
        $this->load->helper('date');
    }

    public function index()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Dashboard';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);

        // Data statistik
        $data['total_disposisi'] = $this->Kelola_surat_model->getAllDataJumlahDisposisiKabagtu();
        $data['jumlah_terbaru'] = $this->Kelola_surat_model->getDataJumlahDisposisiTerbaruKabagtu();
        $data['jumlah_diproses'] = $this->Kelola_surat_model->getDataJumlahDisposisiDiprosesKabagtu();
        $data['jumlah_selesai'] = $this->Kelola_surat_model->getDataJumlahDisposisiSelesaiKabagtu();

        // Data untuk grafik
        $data['labels_grafik'] = $this->Kelola_surat_model->getLabelsGrafik();
        $data['data_grafik'] = $this->Kelola_surat_model->getDataGrafikKabagtu();

        // Data disposisi terbaru
        $data['disposisi_terbaru'] = $this->Kelola_surat_model->getDataDisposisiTerbaruKabagtu();
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        if (!empty($data['disposisi_terbaru'])) {
            foreach ($data['disposisi_terbaru'] as &$d) {
                $d['pengajuan'] = $this->Kelola_surat_model->getDataPengajuan($d['id']);
                $d['status_wadek'] = $this->Kelola_status_model->getDataNamaStatusWadek($d['id']);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/kabag_tu', $data);
        $this->load->view('templates/footer');
    }

    public function disposisiKabagtu()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Disposisi';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->getFilterAllDisposisi();
        $data['status'] = $this->Kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->Kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->Kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kabagtu/disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function detailSuratMasukKabagtu($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Detail Surat Masuk';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_sm'] = $this->Kelola_sm_model->readSuratMasuk($id);

        $data_sm = $this->Kelola_sm_model->getDataSuratMasuk($id);
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
        $this->load->view('pages_kabagtu/kelola_surat_masuk/view_tambah', $data);
        // $this->load->view('templates/footer');
    }

    public function tambahDisposisiKabagtu($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Disposisi';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->Kelola_disposisi_model->readDisposisi($id);
        $data['status'] = $this->Kelola_status_model->getAllStatus();

        $data_pengajuan = $this->Kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->Kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kabagtu/kelola_disposisi/tambah', $data);
        // $this->load->view('templates/footer');
    }

    public function tambahAksiDisposisiKabagtu($id)
    {
        $this->_rulesAddDisposisi();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahDisposisiKabagtu($id);
        } else {
            $this->Kelola_disposisi_model->insertDataDisposisiKabagtu($id);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('disposisiKabagtu');
        }
    }

    public function lihatSuratMasukKabagtu($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Detail Surat Masuk';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_sm'] = $this->Kelola_sm_model->readSuratMasuk($id);

        $data_sm = $this->Kelola_sm_model->getDataSuratMasuk($id);
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
        $this->load->view('pages_kabagtu/kelola_surat_masuk/view_edit', $data);
        // $this->load->view('templates/footer');
    }

    public function editDisposisiKabagtu($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Disposisi';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->Kelola_disposisi_model->readDisposisi($id);
        $data['status'] = $this->Kelola_status_model->getAllStatus();

        $data_pengajuan = $this->Kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->Kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kabagtu/kelola_disposisi/edit', $data);
        // $this->load->view('templates/footer');
    }

    public function editAksiDisposisiKabagtu($id)
    {
        $this->_rulesEditDisposisi();

        if ($this->form_validation->run() == FALSE) {
            $this->editDisposisiKabagtu($id);
        } else {
            $this->Kelola_disposisi_model->updateDataDisposisiKabagtu($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('disposisiKabagtu');
        }
    }

    public function detailDisposisiKabagtu($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Detail Disposisi';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->Kelola_disposisi_model->readDisposisi($id);
        $data['status'] = $this->Kelola_status_model->getAllStatus();

        $data_pengajuan = $this->Kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->Kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kabagtu/kelola_disposisi/view', $data);
        // $this->load->view('templates/footer');
    }

    public function printDisposisiKabagtu($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Print Disposisi';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_disposisi'] = $this->Kelola_disposisi_model->readDisposisi($id);
        $data['status'] = $this->Kelola_status_model->getAllStatus();

        $data_pengajuan = $this->Kelola_surat_model->getDataPengajuan($id);
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $status_wadek = $this->Kelola_status_model->getDataNamaStatusWadek($id);
        $data['status_wadek'] = $status_wadek['nama_status'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kabagtu/kelola_disposisi/print', $data);
        // $this->load->view('templates/footer');
    }

    public function arsipDisposisiKabagtu()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Arsip Disposisi';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->getFilterAllDisposisi();
        $data['status'] = $this->Kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->Kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->Kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kabagtu/arsip_disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function profileKabagtu()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kabag_TU') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Profile';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $id = $_SESSION['id_user'];
        $data['kelola_user'] = $this->Kelola_user_model->readDataUser($id);

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kabagtu/kelola_profile/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editProfileKabagtu($id)
    {
        $this->_rulesEditProfile();

        if ($this->form_validation->run() == FALSE) {
            $this->profileKabagtu();
        } else {
            // Proses update data
            $updateData = $this->Kelola_user_model->updateDataProfile($id);

            // Cek hasil update
            if (empty($this->input->post('passnow'))) {
                // Jika tidak ada perubahan password, hanya update data user
                if ($updateData) {
                    // Jika berhasil diupdate
                    $this->session->set_flashdata('message', '<div class="alert alert-warning mb-0" role="alert"><strong>Berhasil Diubah!</strong></div>');
                } else {
                    // Jika ada kesalahan update data user, tampilkan pesan error
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-0" role="alert"><strong>Gagal mengubah data!</strong></div>');
                }
                // Redirect ke halaman profile setelah update
                redirect('profileKabagtu');
            } else {
                // Proses jika password diubah
                $updatePassword = $this->Kelola_user_model->updateDataProfilePassword($id);

                if ($updatePassword == 'password_salah') {
                    // Jika password lama salah
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-0" role="alert"><strong>Password lama salah!</strong></div>');
                } elseif ($updatePassword == 'password_sama') {
                    // Jika password baru sama dengan password lama
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-0" role="alert"><strong>Password baru tidak boleh sama dengan password lama!</strong></div>');
                } elseif ($updatePassword == 'password_berhasil') {
                    // Jika password berhasil diubah
                    session_destroy();
                    redirect('/');
                } else {
                    // Jika ada kesalahan lainnya
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-0" role="alert"><strong>Gagal mengubah password!</strong></div>');
                }

                redirect('profileKabagtu');
            }
        }
    }

    public function _rulesAddDisposisi()
    {
        $this->form_validation->set_rules('isi_disposisi_kabagtu', 'Isi disposisi', 'trim|required');

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditDisposisi()
    {
        $this->form_validation->set_rules('isi_disposisi_kabagtu', 'Isi disposisi', 'trim|required');

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditProfile()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');

        if (!empty($this->input->post('passnow', true))) {
            $this->form_validation->set_rules('passnew', 'Password baru', 'trim|required|min_length[5]', ['min_length' => '%s terlalu pendek!']);
            $this->form_validation->set_rules('passconf', 'Konfirmasi password baru', 'trim|required|matches[passnew]', ['matches' => '%s tidak sesuai dengan password yang baru!']);
        }

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }
}
