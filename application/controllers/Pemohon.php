<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemohon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('auth_model');
        $this->load->model('kelola_user_model');
        $this->load->model('kelola_prodi_model');
        $this->load->model('kelola_jenis_surat_model');
        $this->load->model('kelola_surat_model');
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
        $data['total_pengajuan'] = $this->kelola_surat_model->getAllDataJumlahPengajuan($_SESSION['id_user']);
        $data['jumlah_terbaru'] = $this->kelola_surat_model->getDataJumlahPengajuanTerbaru($_SESSION['id_user']);
        $data['jumlah_disetujui'] = $this->kelola_surat_model->getDataJumlahPengajuanDisetujui($_SESSION['id_user']);
        $data['jumlah_ditolak'] = $this->kelola_surat_model->getDataJumlahPengajuanDitolak($_SESSION['id_user']);
        $data['jumlah_diproses'] = $this->kelola_surat_model->getDataJumlahPengajuanDiproses($_SESSION['id_user']);
        $data['jumlah_selesai'] = $this->kelola_surat_model->getDataJumlahPengajuanSelesai($_SESSION['id_user']);

        // Data untuk grafik
        $data['labels_grafik'] = $this->kelola_surat_model->getLabelsGrafik();
        $data['data_grafik'] = $this->kelola_surat_model->getDataGrafik($_SESSION['id_user']);

        // Data pengajuan terbaru
        $data['pengajuan_terbaru'] = $this->kelola_surat_model->getDataPengajuanTerbaru($_SESSION['id_user']);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/pemohon', $data);
        $this->load->view('templates/footer');
    }

    public function pengajuan()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Pengajuan';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterPengajuan($_SESSION['id_user']);
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_pemohon/pengajuan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPengajuan()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Pengajuan';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_pemohon/kelola_pengajuan/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahAksiPengajuan()
    {
        $this->_rulesAdd();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahPengajuan();
        } else {
            $this->kelola_surat_model->insertPengajuanSurat();
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('pengajuan');
        }
    }

    public function editPengajuan($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Pengajuan';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->readPengajuanSurat($id);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_pemohon/kelola_pengajuan/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editAksiPengajuan($id)
    {
        $this->_rulesEdit();

        if ($this->form_validation->run() == FALSE) {
            $this->editPengajuan($id);
        } else {
            $this->kelola_surat_model->updatePengajuanSurat($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('pengajuan');
        }
    }

    public function removeFile($filename)
    {
        // Pastikan request adalah AJAX
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        try {
            // Ambil surat_id dari request body
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $surat_id = $data['surat_id'] ?? null;

            if (!$surat_id) {
                throw new Exception('ID surat tidak ditemukan');
            }

            // Ambil data surat
            $surat = $this->kelola_surat_model->readPengajuanSurat($surat_id);
            if (!$surat) {
                throw new Exception('Data surat tidak ditemukan');
            }

            // Verifikasi kepemilikan file
            if ($surat['id_pemohon'] != $this->session->userdata('id_user')) {
                throw new Exception('Anda tidak memiliki akses untuk menghapus file ini');
            }

            // Hapus file fisik
            $file_path = FCPATH . 'uploads/berkas/' . $filename;
            if (file_exists($file_path)) {
                if (!unlink($file_path)) {
                    throw new Exception('Gagal menghapus file fisik');
                }
            }

            // Update database - hapus nama file dari kolom berkas_file
            $current_files = explode(',', $surat['berkas_file']);
            $updated_files = array_diff($current_files, [$filename]);
            $new_berkas_file = implode(',', $updated_files);

            $this->db->where('id', $surat_id);
            $update_result = $this->db->update('surat', ['berkas_file' => $new_berkas_file]);

            if (!$update_result) {
                throw new Exception('Gagal mengupdate database');
            }

            echo json_encode(['success' => true, 'message' => 'File berhasil dihapus']);
        } catch (Exception $e) {
            log_message('error', 'Error in remove file: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function detailPengajuan($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Detail Pengajuan';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->readPengajuanSurat($id);
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_pemohon/kelola_pengajuan/detail', $data);
        $this->load->view('templates/footer');
    }

    public function hapusPengajuan($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);

        $this->kelola_surat_model->deletePengajuanSurat($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Berhasil Dihapus!</strong></div>');
        redirect('pengajuan');
    }

    public function arsip()
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Arsip';
        $data['user'] = $this->auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->kelola_surat_model->getFilterPengajuan($_SESSION['id_user']);
        $data['status'] = $this->kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['status_wadek'] = $this->kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_pemohon/arsip', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
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
        $this->load->view('pages_pemohon/kelola_profile/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editProfile($id)
    {
        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $this->kelola_user_model->updateDataUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-warning mb-0" role="alert"><strong>Berhasil Diubah!</strong></div>');
        redirect('profile');
    }

    public function _rulesAdd()
    {
        $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
        $this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat pelaksanaan', 'trim|required');
        $this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal pelaksanaan', 'required', ['required' => '%s harus dipilih!']);
        $this->form_validation->set_rules('jenis_surat[]', 'Jenis surat', 'required', ['required' => '%s harus dipilih!']);
        if (empty($_FILES['berkas_file']['name'][0])) {
            $this->form_validation->set_rules('berkas_file[]', 'Berkas file', 'required', ['required' => '%s harus dipilih!']);
        }

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEdit()
    {
        $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
        $this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat pelaksanaan', 'trim|required');
        $this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal pelaksanaan', 'required', ['required' => '%s harus dipilih!']);
        $this->form_validation->set_rules('jenis_surat[]', 'Jenis surat', 'required', ['required' => '%s harus dipilih!']);
        // if (empty($_FILES['berkas_file']['name'][0])) {
        //     $this->form_validation->set_rules('berkas_file[]', 'Berkas file', 'required', ['required' => '%s harus dipilih!']);
        // }

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }
}
