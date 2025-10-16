<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kaprodi extends CI_Controller
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
        $this->load->library('upload');
    }

    public function index()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Dashboard';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);

        // Data statistik
        $data['total_pengajuan'] = $this->Kelola_surat_model->getAllDataJumlahPengajuanKaprodi($_SESSION['id_user']);
        $data['jumlah_terbaru'] = $this->Kelola_surat_model->getDataJumlahPengajuanTerbaruKaprodi($_SESSION['id_user']);
        $data['jumlah_disetujui'] = $this->Kelola_surat_model->getDataJumlahPengajuanDisetujuiKaprodi($_SESSION['id_user']);
        $data['jumlah_ditolak'] = $this->Kelola_surat_model->getDataJumlahPengajuanDitolakKaprodi($_SESSION['id_user']);
        $data['jumlah_diproses'] = $this->Kelola_surat_model->getDataJumlahPengajuanDiprosesKaprodi($_SESSION['id_user']);
        $data['jumlah_selesai'] = $this->Kelola_surat_model->getDataJumlahPengajuanSelesaiKaprodi($_SESSION['id_user']);

        // Data untuk grafik
        $data['labels_grafik'] = $this->Kelola_surat_model->getLabelsGrafik();
        $data['data_grafik'] = $this->Kelola_surat_model->getDataGrafikKaprodi($_SESSION['id_user']);

        // Data pengajuan terbaru
        $data['pengajuan_terbaru'] = $this->Kelola_surat_model->getDataPengajuanTerbaruKaprodi($_SESSION['id_user']);
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        if (!empty($data['pengajuan_terbaru'])) {
            foreach ($data['pengajuan_terbaru'] as &$p) {
                $p['pengajuan'] = $this->Kelola_surat_model->getDataPengajuan($p['id']);
                $p['status_wadek'] = $this->Kelola_status_model->getDataNamaStatusWadek($p['id']);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/kaprodi', $data);
        $this->load->view('templates/footer');
    }

    public function suratKaprodi()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Surat Masuk';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->getFilterAllPengajuan($_SESSION['id_user']);
        $data['status'] = $this->Kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->Kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->Kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/surat_masuk', $data);
        $this->load->view('templates/footer');
    }

    public function editPengajuanKaprodi($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Pengajuan';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->readPengajuanSurat($id);

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/kelola_pengajuan/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editAksiPengajuanKaprodi($id)
    {
        $this->_rulesEdit();

        if ($this->form_validation->run() == FALSE) {
            $this->editPengajuanKaprodi($id);
        } else {
            $this->Kelola_surat_model->updatePengajuanSuratKaprodi($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('suratKaprodi');
        }
    }

    public function detailPengajuanKaprodi($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Detail Pengajuan';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->readPengajuanSurat($id);
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();

        $data_pengajuan = $this->Kelola_surat_model->getDataPengajuan($id);
        $data['nama'] = $data_pengajuan['nama'];
        $data['nip'] = $data_pengajuan['nip'];
        $data['pangkat'] = $data_pengajuan['pangkat'];
        $data['golongan'] = $data_pengajuan['golongan'];
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/kelola_pengajuan/view', $data);
        $this->load->view('templates/footer');
    }

    public function approvePengajuanKaprodi($id)
    {
        $this->_rulesStatus();

        if ($this->form_validation->run() == FALSE) {
            $this->detailPengajuanKaprodi($id);
        } else {
            // Mendapatkan status yang dipilih dari form
            $status = $this->input->post('status', true);

            // Jika status disetujui
            if ($status == 'Disetujui Kaprodi') {
                $this->Kelola_surat_model->approvePengajuanSurat($id);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Berhasil Disetujui!</strong></div>');
            }

            // Jika status ditolak
            if ($status == 'Ditolak Kaprodi') {
                $this->Kelola_surat_model->approvePengajuanSurat($id);
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Berhasil Ditolak!</strong></div>');
            }

            redirect('suratKaprodi');
        }
    }

    public function tambahSuratPengantarKaprodi($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Surat Pengantar';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_sm'] = $this->Kelola_sm_model->readSuratMasuk($id);
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();
        $data['nomor_sm'] = $this->Kelola_sm_model->generateNomorSuratMasuk($id);
        $data['kajur'] = $this->Kelola_user_model->getDataKajur();

        $data_pengajuan = $this->Kelola_surat_model->getDataPengajuan($id);
        $data['nama'] = $data_pengajuan['nama'];
        $data['nip'] = $data_pengajuan['nip'];
        $data['pangkat'] = $data_pengajuan['pangkat'];
        $data['golongan'] = $data_pengajuan['golongan'];
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/kelola_surat_masuk/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahAksiSuratPengantarKaprodi($id)
    {
        $this->_rulesAddSurat();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahSuratPengantarKaprodi($id);
        } else {
            $this->Kelola_sm_model->insertSuratMasuk($id);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('suratKaprodi');
        }
    }

    public function editSuratPengantarKaprodi($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Surat Pengantar';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_sm'] = $this->Kelola_sm_model->readSuratMasuk($id);
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();
        $data['kajur'] = $this->Kelola_user_model->getDataKajur();

        $data_pengajuan = $this->Kelola_surat_model->getDataPengajuan($id);
        $data['nama'] = $data_pengajuan['nama'];
        $data['nip'] = $data_pengajuan['nip'];
        $data['pangkat'] = $data_pengajuan['pangkat'];
        $data['golongan'] = $data_pengajuan['golongan'];
        $data['prodi'] = $data_pengajuan['nama_prodi'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/kelola_surat_masuk/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editAksiSuratPengantarKaprodi($id)
    {
        $this->_rulesEditSurat();

        if ($this->form_validation->run() == FALSE) {
            $this->editSuratPengantarKaprodi($id);
        } else {
            $this->Kelola_sm_model->updateSuratMasuk($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('suratKaprodi');
        }
    }

    public function detailSuratPengantarKaprodi($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Detail Surat Pengantar';
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
        $this->load->view('pages_kaprodi/kelola_surat_masuk/view', $data);
        // $this->load->view('templates/footer');
    }

    public function printSuratPengantarKaprodi($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Print Surat Pengantar';
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
        $this->load->view('pages_kaprodi/kelola_surat_masuk/print', $data);
        // $this->load->view('templates/footer');
    }

    public function arsipSuratKaprodi()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Arsip Surat Masuk';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->getFilterAllPengajuan($_SESSION['id_user']);
        $data['status'] = $this->Kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['pengajuan'] = $this->Kelola_surat_model->getDataPengajuan($kp['id']);
            $kp['status_wadek'] = $this->Kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/arsip_sm', $data);
        $this->load->view('templates/footer');
    }

    public function profileKaprodi()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Profile';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $id = $_SESSION['id_user'];
        $data['kelola_user'] = $this->Kelola_user_model->readDataUser($id);
        $data['jurusan'] = $this->Kelola_prodi_model->getDataJurusan();
        $data['prodi'] = $this->Kelola_prodi_model->getDataProdi();
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
        $this->load->view('pages_kaprodi/kelola_profile/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editProfileKaprodi($id)
    {
        $this->_rulesEditProfile();

        if ($this->form_validation->run() == FALSE) {
            $this->profileKaprodi();
        } else {
            // Proses update data
            $updateData = $this->Kelola_user_model->updateDataTtd($id);

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
                redirect('profileKaprodi');
            } else {
                // Proses jika password diubah
                $updatePassword = $this->Kelola_user_model->updateDataTtdPassword($id);

                if ($updatePassword == 'password_salah') {
                    // Jika password lama salah
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-0" role="alert"><strong>Password lama salah!</strong></div>');
                } elseif ($updatePassword == 'password_sama') {
                    // Jika password baru sama dengan password lama
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-0" role="alert"><strong>Password baru tidak boleh sama dengan password lama!</strong></div>');
                } elseif ($updatePassword == 'password_berhasil') {
                    // Jika password berhasil diubah
                    $this->session->set_flashdata('message', '<div class="alert alert-warning mb-0" role="alert"><strong>Berhasil Diubah!</strong></div>');
                } else {
                    // Jika ada kesalahan lainnya
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-0" role="alert"><strong>Gagal mengubah password!</strong></div>');
                }

                redirect('profileKaprodi');
            }
        }
    }

    public function suratpengajuanKaprodi()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Pengajuan';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->getFilterPengajuan($_SESSION['id_user']);
        $data['status'] = $this->Kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['status_wadek'] = $this->Kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/pengajuan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahSuratPengajuanKaprodi()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Tambah Pengajuan';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();
        $data['kajur'] = $this->Kelola_user_model->getDataKajur();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/kelola_surat_pengajuan/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahAksiSuratPengajuanKaprodi()
    {
        $this->_rulesAddPengajuan();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahSuratPengajuanKaprodi();
        } else {
            $this->Kelola_surat_model->insertPengajuanSuratKaprodi();
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert"><strong>Berhasil Ditambahkan!</strong></div>');
            redirect('suratpengajuanKaprodi');
        }
    }

    public function editSuratPengajuanKaprodi($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Edit Pengajuan';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->readPengajuanSurat($id);
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();
        $data['kajur'] = $this->Kelola_user_model->getDataKajur();

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/kelola_surat_pengajuan/edit', $data);
        $this->load->view('templates/footer');
    }

    public function editAksiSuratPengajuanKaprodi($id)
    {
        $this->_rulesEditPengajuan();

        if ($this->form_validation->run() == FALSE) {
            $this->editSuratPengajuanKaprodi($id);
        } else {
            $this->Kelola_surat_model->updatePengajuanKaprodi($id);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Berhasil Diubah!</strong></div>');
            redirect('suratpengajuanKaprodi');
        }
    }

    public function removeFileKaprodi($filename)
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
            $surat = $this->Kelola_surat_model->readPengajuanSurat($surat_id);
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

    public function detailSuratPengajuanKaprodi($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Detail Pengajuan';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->readPengajuanSurat($id);
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();
        $data['kajur'] = $this->Kelola_user_model->getDataKajur();

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
        $this->load->view('pages_kaprodi/kelola_surat_pengajuan/detail', $data);
        // $this->load->view('templates/footer');
    }

    public function hapusSuratPengajuanKaprodi($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);

        $this->Kelola_surat_model->deletePengajuanSurat($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Berhasil Dihapus!</strong></div>');
        redirect('suratpengajuanKaprodi');
    }

    public function arsipSuratPengajuanKaprodi()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'Kaprodi') {
            $this->session->set_flashdata('pesan', '<div class="text-danger text-center">Silahkan Login Dulu!</div>');
            redirect('/');
        }

        $data['judul'] = 'Arsip Pengajuan';
        $data['user'] = $this->Auth_model->getDataLoggedIn($_SESSION['id_user']);
        $data['kelola_pengajuan'] = $this->Kelola_surat_model->getFilterPengajuan($_SESSION['id_user']);
        $data['status'] = $this->Kelola_status_model->getAllStatus();
        $data['jenis_surat'] = $this->Kelola_jenis_surat_model->getDataJenisSurat();

        // Tambahkan ini untuk mendapatkan data pengajuan
        foreach ($data['kelola_pengajuan'] as &$kp) {
            $kp['status_wadek'] = $this->Kelola_status_model->getDataNamaStatusWadek($kp['id']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages_kaprodi/arsip_pengajuan', $data);
        $this->load->view('templates/footer');
    }

    public function _rulesEdit()
    {
        $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
        $this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat pelaksanaan', 'trim|required');
        $this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal pelaksanaan', 'required', ['required' => '%s harus dipilih!']);

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesStatus()
    {
        $this->form_validation->set_rules('status', 'Approved', 'required');

        $this->form_validation->set_message('required', '%s harus dipilih!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesAddSurat()
    {
        $this->form_validation->set_rules('isi_sm', 'Isi surat pengantar', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('pilih_kajur', 'Nama ketua jurusan', 'required', ['required' => '%s harus dipilih!']);

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditSurat()
    {
        $this->form_validation->set_rules('isi_sm', 'Isi surat pengantar', 'trim|required', ['required' => '%s harus diisi!']);

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditProfile()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required');
        $this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
        $this->form_validation->set_rules('golongan', 'Golongan', 'trim|required');

        if (!empty($this->input->post('passnow', true))) {
            $this->form_validation->set_rules('passnew', 'Password baru', 'trim|required|min_length[5]', ['min_length' => '%s terlalu pendek!']);
            $this->form_validation->set_rules('passconf', 'Konfirmasi password baru', 'trim|required|matches[passnew]', ['matches' => '%s tidak sesuai dengan password yang baru!']);
        }

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesAddPengajuan()
    {
        $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
        $this->form_validation->set_rules('jenis_surat[]', 'Jenis pengajuan', 'required', ['required' => '%s harus dipilih!']);
        $this->form_validation->set_rules('isi_sm', 'Isi surat pengantar', 'trim|required');
        $this->form_validation->set_rules('pilih_kajur', 'Nama ketua jurusan', 'required', ['required' => '%s harus dipilih!']);
        if (empty($_FILES['berkas_file']['name'][0])) {
            $this->form_validation->set_rules('berkas_file[]', 'Berkas file', 'required', ['required' => '%s harus dipilih!']);
        }

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }

    public function _rulesEditPengajuan()
    {
        $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
        $this->form_validation->set_rules('isi_sm', 'Isi surat pengantar', 'trim|required');
        $this->form_validation->set_rules('jenis_surat[]', 'Jenis pengajuan', 'required', ['required' => '%s harus dipilih!']);
        // Validasi file hanya jika tidak ada file yang sudah ada dan tidak ada file baru yang diupload
        $existing_files = $this->input->post('existing_files', true);
        if (empty($existing_files) && empty($_FILES['berkas_file']['name'][0])) {
            $this->form_validation->set_rules('berkas_file[]', 'Berkas file', 'required', ['required' => '%s harus dipilih!']);
        }

        $this->form_validation->set_message('required', '%s harus diisi!');

        $this->form_validation->set_error_delimiters('<div class="text-small text-danger">', '</div>');
    }
}
