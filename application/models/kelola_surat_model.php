<?php

class kelola_surat_model extends CI_Model
{
    public function insertPengajuanSurat()
    {
        $bulan_sekarang = date('m');
        $tanggal_sekarang = date('d');

        if ($bulan_sekarang == '01' && $tanggal_sekarang == '01') {
            $no_urut_now = '01';
            $last_no = $no_urut_now;
        } else {
            $id_prodi = $this->input->post('id_prodi', true);
            $this->db->where('id', $id_prodi);
            $prodi = $this->db->get('prodi')->row();

            $id_jenis_surat = $this->input->post('jenis_surat', true);

            if (!empty($id_jenis_surat)) {
                // Sort jenis surat untuk konsistensi
                sort($id_jenis_surat);

                // Gabungkan jenis surat menjadi string
                $jenis_surat_string = implode(',', $id_jenis_surat);

                // Cari nomor urut terakhir berdasarkan id prodi dan jenis surat
                $this->db->where('id_prodi', $prodi->id);
                $this->db->where('jenis_surat', $jenis_surat_string);
                $this->db->order_by('nomor_urut_pengajuan', 'DESC');
                $this->db->limit(1);
                $last_pengajuan = $this->db->get('surat')->row();

                $no_urut = $last_pengajuan->nomor_urut_pengajuan + 1;
                $no_urut_format = str_pad($no_urut, 2, '0', STR_PAD_LEFT);
                $last_no = $no_urut_format;
            }
        }

        // Upload file
        if (!empty($_FILES['berkas_file']['name'][0])) {
            $uploaded_files = [];
            $file_count = count($_FILES['berkas_file']['name']);

            for ($i = 0; $i < $file_count; $i++) {
                $_FILES['file']['name'] = $_FILES['berkas_file']['name'][$i];
                $_FILES['file']['type'] = $_FILES['berkas_file']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['berkas_file']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['berkas_file']['error'][$i];
                $_FILES['file']['size'] = $_FILES['berkas_file']['size'][$i];

                $config['upload_path'] = './uploads/berkas/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 5120; // 5 MB
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $uploaded_data = $this->upload->data();
                    $uploaded_files[] = $uploaded_data['file_name'];
                }
            }
        }

        $berkas_file = implode(',', $uploaded_files);

        $data = [
            'id_pemohon' => $_SESSION['id_user'],
            'id_jurusan' => $this->input->post('id_jurusan', true),
            'id_prodi' => $this->input->post('id_prodi', true),
            'nomor_urut_pengajuan' => $last_no, // Simpan no urut
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'perihal' => $this->input->post('perihal', true),
            'tempat_pelaksanaan' => $this->input->post('tempat_pelaksanaan', true),
            'tanggal_pelaksanaan' => $this->input->post('tanggal_pelaksanaan', true),
            'berkas_file' => $berkas_file, // Simpan file
            'jenis_surat' => $jenis_surat_string, // Simpan jenis surat
            'status' => $this->input->post('status', true)
        ];

        $this->db->insert('surat', $data);

        // Ambil data terakhir dari tabel surat
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $last_data = $this->db->get('surat')->row();

        // Menyimpan data ke tabel status untuk setiap pengajuan
        $data1 = [
            'id_pengajuan_surat' => $last_data->id,
            'id_user' => $_SESSION['id_user'],
            'status' => $last_data->status,
            'update_status' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('status', $data1);

        return true; // Return true jika semua data berhasil dimasukkan
    }

    public function insertPengajuanSuratKaprodi()
    {
        $bulan_sekarang = date('m');
        $tanggal_sekarang = date('d');
        $tahun_sekarang = date('Y');

        if ($bulan_sekarang == '01' && $tanggal_sekarang == '01') {
            $no_urut_now = '01';
            $last_no = $no_urut_now;
        } else {
            $id_prodi = $this->input->post('id_prodi', true);
            $this->db->where('id', $id_prodi);
            $prodi = $this->db->get('prodi')->row();

            $id_jenis_surat = $this->input->post('jenis_surat', true);

            if (!empty($id_jenis_surat)) {
                // Sort jenis surat untuk konsistensi
                sort($id_jenis_surat);

                // Gabungkan jenis surat menjadi string
                $jenis_surat_string = implode(',', $id_jenis_surat);

                // Cari nomor urut terakhir berdasarkan id prodi dan jenis surat
                $this->db->where('id_prodi', $prodi->id);
                $this->db->where('jenis_surat', $jenis_surat_string);
                $this->db->order_by('nomor_urut_pengajuan', 'DESC');
                $this->db->limit(1);
                $last_pengajuan = $this->db->get('surat')->row();

                $no_urut = $last_pengajuan->nomor_urut_pengajuan + 1;
                $no_urut_format = str_pad($no_urut, 2, '0', STR_PAD_LEFT);
                $last_no = $no_urut_format;
            }

            $nomor_sm = $prodi->kode_prodi . '/' . $last_no . '/' . $bulan_sekarang . '/' . $tahun_sekarang;
        }

        // Upload file
        if (!empty($_FILES['berkas_file']['name'][0])) {
            $uploaded_files = [];
            $file_count = count($_FILES['berkas_file']['name']);

            for ($i = 0; $i < $file_count; $i++) {
                $_FILES['file']['name'] = $_FILES['berkas_file']['name'][$i];
                $_FILES['file']['type'] = $_FILES['berkas_file']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['berkas_file']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['berkas_file']['error'][$i];
                $_FILES['file']['size'] = $_FILES['berkas_file']['size'][$i];

                $config['upload_path'] = './uploads/berkas/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 5120; // 5 MB
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $uploaded_data = $this->upload->data();
                    $uploaded_files[] = $uploaded_data['file_name'];
                }
            }
        }

        $berkas_file = implode(',', $uploaded_files);

        $data = [
            'id_pemohon' => $_SESSION['id_user'],
            'id_jurusan' => $this->input->post('id_jurusan', true),
            'id_prodi' => $this->input->post('id_prodi', true),
            'nomor_urut_pengajuan' => $last_no, // Simpan no urut
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'perihal' => $this->input->post('perihal', true),
            'berkas_file' => $berkas_file, // Simpan file
            'jenis_surat' => $jenis_surat_string, // Simpan jenis surat
            'id_pembuat_sm' => $_SESSION['id_user'],
            'nomor_sm' => $nomor_sm,
            'tanggal_buat_sm' => date('Y-m-d H:i:s'),
            'isi_sm' => $this->input->post('isi_sm', false),
            'pilih_kajur' => $this->input->post('pilih_kajur', true),
            'buat_sm' => $this->input->post('buat_sm', true),
            'status' => $this->input->post('status', true)
        ];

        $this->db->insert('surat', $data);

        // Ambil data terakhir dari tabel surat
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $last_data = $this->db->get('surat')->row();

        // Menyimpan data ke tabel status untuk setiap pengajuan
        $data1 = [
            'id_pengajuan_surat' => $last_data->id,
            'id_user' => $_SESSION['id_user'],
            'status' => $last_data->status,
            'update_status' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('status', $data1);

        return true; // Return true jika semua data berhasil dimasukkan
    }

    public function updatePengajuanSurat($id)
    {
        $this->db->where('id', $id);
        $surat = $this->db->get('surat')->row();

        $this->db->where('id', $surat->id_prodi);
        $prodi = $this->db->get('prodi')->row();

        // Inisialisasi variabel
        $no_urut_format = $surat->nomor_urut_pengajuan;
        $berkas_file = $surat->berkas_file;
        $jenis_surat_string = $surat->jenis_surat;

        // Ambil data jenis surat dari input
        $id_jenis_surat = $this->input->post('jenis_surat', true);

        if (!empty($id_jenis_surat)) {
            // Sort jenis surat untuk konsistensi
            sort($id_jenis_surat);

            // Gabungkan jenis surat menjadi string
            $jenis_surat_string = implode(',', $id_jenis_surat);

            // Jika jenis surat berubah, gunakan nomor urut baru
            if ($jenis_surat_string != $surat->jenis_surat) {
                // Cari nomor urut terakhir berdasarkan id prodi dan jenis surat
                $this->db->where('id_prodi', $prodi->id);
                $this->db->where('jenis_surat', $jenis_surat_string);
                $this->db->order_by('nomor_urut_pengajuan', 'DESC');
                $this->db->limit(1);
                $last_pengajuan = $this->db->get('surat')->row();

                $no_urut = $last_pengajuan->nomor_urut_pengajuan + 1;
                $no_urut_format = str_pad($no_urut, 2, '0', STR_PAD_LEFT);
            }
        }

        // Update file jika ada
        if (!empty($_FILES['berkas_file']['name'][0])) {
            $uploaded_files = [];
            $file_count = count($_FILES['berkas_file']['name']);

            for ($i = 0; $i < $file_count; $i++) {
                if (!empty($_FILES['berkas_file']['name'][$i])) {
                    $_FILES['file']['name'] = $_FILES['berkas_file']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['berkas_file']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['berkas_file']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['berkas_file']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['berkas_file']['size'][$i];

                    $config['upload_path'] = './uploads/berkas/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 5120; // 5 MB
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $uploaded_data = $this->upload->data();
                        $uploaded_files[] = $uploaded_data['file_name'];
                    }
                }
            }

            if (!empty($uploaded_files)) {
                // Gabungkan dengan file yang sudah ada
                $existing_files = $surat->berkas_file ? explode(',', $surat->berkas_file) : [];
                $all_files = array_merge($existing_files, $uploaded_files);
                $berkas_file = implode(',', array_filter($all_files));
            }
        }

        // Data untuk update
        $data = [
            'nomor_urut_pengajuan' => $no_urut_format, // Simpan nomor urut
            'perihal' => $this->input->post('perihal', true),
            'tempat_pelaksanaan' => $this->input->post('tempat_pelaksanaan', true),
            'tanggal_pelaksanaan' => $this->input->post('tanggal_pelaksanaan', true),
            'berkas_file' => $berkas_file, // Simpan file
            'jenis_surat' => $jenis_surat_string // Simpan jenis surat
        ];

        // Update data tabel surat
        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        return true; // Return true jika semua data berhasil
    }

    public function updatePengajuanKaprodi($id)
    {
        $this->db->where('id', $id);
        $surat = $this->db->get('surat')->row();

        $this->db->where('id', $surat->id_prodi);
        $prodi = $this->db->get('prodi')->row();

        // Inisialisasi variabel
        $no_urut_format = $surat->nomor_urut_pengajuan;
        $berkas_file = $surat->berkas_file;
        $jenis_surat_string = $surat->jenis_surat;

        // Ambil data jenis surat dari input
        $id_jenis_surat = $this->input->post('jenis_surat', true);

        if (!empty($id_jenis_surat)) {
            // Sort jenis surat untuk konsistensi
            sort($id_jenis_surat);

            // Gabungkan jenis surat menjadi string
            $jenis_surat_string = implode(',', $id_jenis_surat);

            // Jika jenis surat berubah, gunakan nomor urut baru
            if ($jenis_surat_string != $surat->jenis_surat) {
                // Cari nomor urut terakhir berdasarkan id prodi dan jenis surat
                $this->db->where('id_prodi', $prodi->id);
                $this->db->where('jenis_surat', $jenis_surat_string);
                $this->db->order_by('nomor_urut_pengajuan', 'DESC');
                $this->db->limit(1);
                $last_pengajuan = $this->db->get('surat')->row();

                $no_urut = $last_pengajuan->nomor_urut_pengajuan + 1;
                $no_urut_format = str_pad($no_urut, 2, '0', STR_PAD_LEFT);
            }
        }

        // Update file jika ada
        if (!empty($_FILES['berkas_file']['name'][0])) {
            $uploaded_files = [];
            $file_count = count($_FILES['berkas_file']['name']);

            for ($i = 0; $i < $file_count; $i++) {
                if (!empty($_FILES['berkas_file']['name'][$i])) {
                    $_FILES['file']['name'] = $_FILES['berkas_file']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['berkas_file']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['berkas_file']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['berkas_file']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['berkas_file']['size'][$i];

                    $config['upload_path'] = './uploads/berkas/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 5120; // 5 MB
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $uploaded_data = $this->upload->data();
                        $uploaded_files[] = $uploaded_data['file_name'];
                    }
                }
            }

            if (!empty($uploaded_files)) {
                // Gabungkan dengan file yang sudah ada
                $existing_files = $surat->berkas_file ? explode(',', $surat->berkas_file) : [];
                $all_files = array_merge($existing_files, $uploaded_files);
                $berkas_file = implode(',', array_filter($all_files));
            }
        }

        $bulan_sekarang = date('m');
        $tahun_sekarang = date('Y');

        $nomor_sm = $prodi->kode_prodi . '/' . $no_urut_format . '/' . $bulan_sekarang . '/' . $tahun_sekarang;

        // Data untuk update
        $data = [
            'nomor_urut_pengajuan' => $no_urut_format, // Simpan nomor urut
            'nomor_sm' => $nomor_sm, // Simpan nomor surat masuk
            'perihal' => $this->input->post('perihal', true),
            'berkas_file' => $berkas_file, // Simpan file
            'jenis_surat' => $jenis_surat_string, // Simpan jenis surat
            'isi_sm' => $this->input->post('isi_sm', false),
            'pilih_kajur' => $this->input->post('pilih_kajur', true),
        ];

        // Update data tabel surat
        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        return true; // Return true jika semua data berhasil
    }

    public function updatePengajuanSuratKaprodi($id)
    {
        $data = [
            'perihal' => $this->input->post('perihal', true),
            'tempat_pelaksanaan' => $this->input->post('tempat_pelaksanaan', true),
            'tanggal_pelaksanaan' => $this->input->post('tanggal_pelaksanaan', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        return true;
    }

    public function approvePengajuanSurat($id)
    {
        $data = [
            'status' => $this->input->post('status', true),
            'alasan_kaprodi' => $this->input->post('alasan_kaprodi', true)
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

    public function approveSuratMasuk($id)
    {
        $data = [
            'status' => $this->input->post('status', true),
            'alasan_kajur' => $this->input->post('alasan_kajur', true)
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

    public function deletePengajuanSurat($id)
    {
        $this->db->delete('status', ['id_pengajuan_surat' => $id]);
        $this->db->delete('surat', ['id' => $id]);

        return true;
    }

    public function readPengajuanSurat($id)
    {
        return $this->db->get_where('surat', ['id' => $id])->row_array();
    }

    public function getDataPengajuan($id)
    {
        $this->db->where('id', $id);
        $surat = $this->db->get('surat')->row();

        $this->db->where('id', $surat->id_pemohon);
        $user = $this->db->get('user')->row();

        $this->db->where('id', $surat->id_prodi);
        $prodi = $this->db->get('prodi')->row();

        $jenis_surat = $this->db->get('jenis_surat')->result_array();

        $jenis_surat_list = [];
        $jenis_surat_ids = explode(',', $surat->jenis_surat);

        foreach ($jenis_surat as $js) {
            if (in_array($js['id'], $jenis_surat_ids)) {
                $jenis_surat_list[] = $js['nama_surat'];
            }
        }
        $nama_surat = implode('<br>', $jenis_surat_list);

        return [
            'nama' => $user->nama,
            'nip' => $user->nip,
            'pangkat' => $user->pangkat,
            'golongan' => $user->golongan,
            'jabatan' => $user->jabatan,
            'nama_prodi' => $prodi->nama_prodi,
            'nama_surat' => $nama_surat
        ];
    }

    public function getDataPengajuanTerakhir()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $id = $this->db->get('surat')->row();
        return $id->id;
    }

    public function getLabelsGrafik()
    {
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $labels[] = date('d M', strtotime($date));
        }
        return $labels;
    }

    public function getFilterPengajuan($id_user)
    {
        // Ambil parameter filter
        $status = $this->input->get('status');
        $jenis_surat = $this->input->get('jenis_surat');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        // Filter status
        if (!empty($status)) {
            if ($status == 'Lembar Disposisi Diteruskan Ke Wadek') {
                $this->db->like('status', 'Lembar Disposisi Diteruskan Ke Wadek');
            } else {
                $this->db->where('status', $status);
            }
        }

        // Filter jenis surat
        if (!empty($jenis_surat)) {
            $this->db->like('jenis_surat', $jenis_surat);
        }

        // Filter tanggal
        if (!empty($start_date)) {
            $this->db->where('DATE(tanggal_pengajuan) >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('DATE(tanggal_pengajuan) <=', $end_date);
        }

        $this->db->where('id_pemohon', $id_user);
        $this->db->order_by('tanggal_pengajuan', 'DESC');
        return $this->db->get('surat')->result_array();
    }

    public function getFilterAllPengajuan($id_user)
    {
        // Ambil parameter filter
        $status = $this->input->get('status');
        $jenis_surat = $this->input->get('jenis_surat');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        // Filter status
        if (!empty($status)) {
            if ($status == 'Lembar Disposisi Diteruskan Ke Wadek') {
                $this->db->like('status', 'Lembar Disposisi Diteruskan Ke Wadek');
            } else {
                $this->db->where('status', $status);
            }
        }

        // Filter jenis surat
        if (!empty($jenis_surat)) {
            $this->db->like('jenis_surat', $jenis_surat);
        }

        // Filter tanggal
        if (!empty($start_date)) {
            $this->db->where('DATE(tanggal_pengajuan) >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('DATE(tanggal_pengajuan) <=', $end_date);
        }

        $this->db->where_not_in('id_pemohon', $id_user);
        $this->db->order_by('tanggal_pengajuan', 'DESC');
        return $this->db->get('surat')->result_array();
    }

    public function getFilterSuratMasuk($id_user)
    {
        // Ambil parameter filter
        $status = $this->input->get('status');
        $jenis_surat = $this->input->get('jenis_surat');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        // Filter status
        if (!empty($status)) {
            if ($status == 'Lembar Disposisi Diteruskan Ke Wadek') {
                $this->db->like('status', 'Lembar Disposisi Diteruskan Ke Wadek');
            } else {
                $this->db->where('status', $status);
            }
        }

        // Filter jenis surat
        if (!empty($jenis_surat)) {
            $this->db->like('jenis_surat', $jenis_surat);
        }

        // Filter tanggal
        if (!empty($start_date)) {
            $this->db->where('DATE(tanggal_buat_sm) >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('DATE(tanggal_buat_sm) <=', $end_date);
        }

        $this->db->where('pilih_kajur', $id_user);
        $this->db->order_by('tanggal_buat_sm', 'DESC');
        return $this->db->get('surat')->result_array();
    }

    public function getFilterAllSuratMasuk()
    {
        // Ambil parameter filter
        $status = $this->input->get('status');
        $jenis_surat = $this->input->get('jenis_surat');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        // Filter status
        if (!empty($status)) {
            if ($status == 'Lembar Disposisi Diteruskan Ke Wadek') {
                $this->db->like('status', 'Lembar Disposisi Diteruskan Ke Wadek');
            } else {
                $this->db->where('status', $status);
            }
        }

        // Filter jenis surat
        if (!empty($jenis_surat)) {
            $this->db->like('jenis_surat', $jenis_surat);
        }

        // Filter tanggal
        if (!empty($start_date)) {
            $this->db->where('DATE(tanggal_buat_sm) >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('DATE(tanggal_buat_sm) <=', $end_date);
        }

        $this->db->order_by('tanggal_buat_sm', 'DESC');
        return $this->db->get('surat')->result_array();
    }

    public function getFilterDisposisi($id_user)
    {
        // Ambil parameter filter
        $status = $this->input->get('status');
        $jenis_surat = $this->input->get('jenis_surat');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $disposisi = $this->db->get('surat')->result_array();

        // Filter status
        if (!empty($status)) {
            if ($status == 'Lembar Disposisi Diteruskan Ke Wadek') {
                $this->db->like('status', 'Lembar Disposisi Diteruskan Ke Wadek');
            } else {
                $this->db->where('status', $status);
            }
        }

        // Filter jenis surat
        if (!empty($jenis_surat)) {
            $this->db->like('jenis_surat', $jenis_surat);
        }

        // Filter tanggal
        if (!empty($start_date)) {
            $this->db->where('DATE(tanggal_terima_sm) >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('DATE(tanggal_terima_sm) <=', $end_date);
        }

        // Tambahkan pengecekan jika data surat tidak kosong
        if (!empty($disposisi)) {
            $id = [];

            foreach ($disposisi as $d) {
                // Pastikan pilih_wadek tidak kosong atau NULL
                if (!empty($d['pilih_wadek'])) {
                    // Pisahkan nilai pilih_wadek berdasarkan koma
                    $wadek_values = explode(',', $d['pilih_wadek']);

                    // Periksa apakah id_user ada dalam wadek_values
                    if (in_array($id_user, $wadek_values)) {
                        $id[] = $d['id'];
                    }
                }
            }

            $this->db->where_in('id', $id);
            $this->db->order_by('tanggal_terima_sm', 'DESC');
            return $this->db->get('surat')->result_array();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getFilterAllDisposisi()
    {
        // Ambil parameter filter
        $status = $this->input->get('status');
        $jenis_surat = $this->input->get('jenis_surat');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        // Filter status
        if (!empty($status)) {
            if ($status == 'Lembar Disposisi Diteruskan Ke Wadek') {
                $this->db->like('status', 'Lembar Disposisi Diteruskan Ke Wadek');
            } else {
                $this->db->where('status', $status);
            }
        }

        // Filter jenis surat
        if (!empty($jenis_surat)) {
            $this->db->like('jenis_surat', $jenis_surat);
        }

        // Filter tanggal
        if (!empty($start_date)) {
            $this->db->where('DATE(tanggal_terima_sm) >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('DATE(tanggal_terima_sm) <=', $end_date);
        }

        $this->db->order_by('tanggal_terima_sm', 'DESC');
        return $this->db->get('surat')->result_array();
    }

    public function getAllDataJumlahPengajuan($id_user)
    {
        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('id_pemohon', $id_user);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahPengajuanTerbaru($id_user)
    {
        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('id_pemohon', $id_user);
            $this->db->where('status', 'Diajukan Ke Prodi');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahPengajuanDiproses($id_user)
    {
        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        $status_value = ['Diajukan Ke Prodi', 'Ditolak Kaprodi', 'Ditolak Kajur', 'Surat Selesai'];

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where_not_in('status', $status_value);
            $this->db->where('id_pemohon', $id_user);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahPengajuanDisetujui($id_user)
    {
        $this->db->where('id_pemohon', $id_user);
        $pengajuan = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika pengajuan tidak kosong
        if (!empty($pengajuan)) {
            $id_pengajuan = [];

            foreach ($pengajuan as $p) {
                $id_pengajuan[] = $p['id'];
            }

            // Cek apakah ada status yang ditolak kajur
            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where('status', 'Ditolak Kajur');
            $rejected_status = $this->db->get('status')->result_array();

            // Jika ada status yang ditolak kajur, kembalikan 0
            if (!empty($rejected_status)) {
                return 0;
            }

            // Jika tidak ada status yang ditolak kajur, lanjutkan untuk menghitung jumlah status disetujui kaprodi dan kajur
            $this->db->distinct();
            $this->db->select('id_pengajuan_surat');
            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where_in('status', ['Disetujui Kaprodi', 'Disetujui Kajur']);
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data pengajuan
    }

    public function getDataJumlahPengajuanDitolak($id_user)
    {
        $this->db->where('id_pemohon', $id_user);
        $pengajuan = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika pengajuan tidak kosong
        if (!empty($pengajuan)) {
            $id_pengajuan = [];

            foreach ($pengajuan as $p) {
                $id_pengajuan[] = $p['id'];
            }

            // $this->db->distinct();
            // $this->db->select('id_pengajuan_surat');
            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where_in('status', ['Ditolak Kaprodi', 'Ditolak Kajur']);
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data pengajuan
    }

    public function getDataJumlahPengajuanSelesai($id_user)
    {
        $this->db->where('status', 'Surat Selesai');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('id_pemohon', $id_user);
            $this->db->where('status', 'Surat Selesai');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataGrafik($id_user)
    {
        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $this->db->where_in('id', $id_pengajuan);
                $this->db->where('id_pemohon', $id_user);
                $this->db->where('DATE(tanggal_pengajuan)', $date);
                $count = $this->db->count_all_results('surat');
                $data[] = $count;
            }

            return $data;
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataPengajuanTerbaru($id_user)
    {
        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('id_pemohon', $id_user);
            $this->db->order_by('tanggal_pengajuan', 'DESC');
            $this->db->limit(5);
            return $this->db->get('surat')->result_array();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getAllDataJumlahPengajuanKaprodi($id_user)
    {
        $this->db->where('id', $id_user);
        $kaprodi = $this->db->get('user')->row();

        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where_not_in('id_pemohon', $id_user);
            $this->db->where('id_prodi', $kaprodi->id_prodi);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahPengajuanTerbaruKaprodi($id_user)
    {
        $this->db->where('id', $id_user);
        $kaprodi = $this->db->get('user')->row();

        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where_not_in('id_pemohon', $id_user);
            $this->db->where('id_prodi', $kaprodi->id_prodi);
            $this->db->where('status', 'Diajukan Ke Prodi');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahPengajuanDiprosesKaprodi($id_user)
    {
        $this->db->where('id', $id_user);
        $kaprodi = $this->db->get('user')->row();

        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        $status_value = ['Diajukan Ke Prodi', 'Ditolak Kaprodi', 'Ditolak Kajur', 'Surat Selesai'];

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where_not_in('id_pemohon', $id_user);
            $this->db->where_not_in('status', $status_value);
            $this->db->where('id_prodi', $kaprodi->id_prodi);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahPengajuanDisetujuiKaprodi($id_user)
    {
        $this->db->where('status', 'Disetujui Kaprodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where('id_user', $id_user);
            $this->db->where('status', 'Disetujui Kaprodi');
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahPengajuanDitolakKaprodi($id_user)
    {
        $this->db->where('status', 'Ditolak Kaprodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where('id_user', $id_user);
            $this->db->where('status', 'Ditolak Kaprodi');
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahPengajuanSelesaiKaprodi($id_user)
    {
        $this->db->where('id', $id_user);
        $kaprodi = $this->db->get('user')->row();

        $this->db->where('status', 'Surat Selesai');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where_not_in('id_pemohon', $id_user);
            $this->db->where('id_prodi', $kaprodi->id_prodi);
            $this->db->where('status', 'Surat Selesai');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataGrafikKaprodi($id_user)
    {
        $this->db->where('id', $id_user);
        $kaprodi = $this->db->get('user')->row();

        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $this->db->where_in('id', $id_pengajuan);
                $this->db->where_not_in('id_pemohon', $id_user);
                $this->db->where('id_prodi', $kaprodi->id_prodi);
                $this->db->where('DATE(tanggal_pengajuan)', $date);
                $count = $this->db->count_all_results('surat');
                $data[] = $count;
            }

            return $data;
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataPengajuanTerbaruKaprodi($id_user)
    {
        $this->db->where('id', $id_user);
        $kaprodi = $this->db->get('user')->row();

        $this->db->where('status', 'Diajukan Ke Prodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where_not_in('id_pemohon', $id_user);
            $this->db->where('id_prodi', $kaprodi->id_prodi);
            $this->db->order_by('tanggal_pengajuan', 'DESC');
            $this->db->limit(5);
            return $this->db->get('surat')->result_array();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getAllDataJumlahSuratMasukKajur($id_user)
    {
        $this->db->where('status', 'Surat Pengantar Selesai Dibuat Kaprodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('pilih_kajur', $id_user);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahSuratMasukTerbaruKajur($id_user)
    {
        $this->db->where('status', 'Surat Pengantar Selesai Dibuat Kaprodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('pilih_kajur', $id_user);
            $this->db->where('status', 'Surat Pengantar Selesai Dibuat Kaprodi');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahSuratMasukDiprosesKajur($id_user)
    {
        $this->db->where('status', 'Surat Pengantar Selesai Dibuat Kaprodi');
        $status = $this->db->get('status')->result_array();

        $status_value = ['Diajukan Ke Prodi', 'Disetujui Kaprodi', 'Ditolak Kaprodi', 'Surat Pengantar Selesai Dibuat Kaprodi', 'Ditolak Kajur', 'Surat Selesai'];

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('pilih_kajur', $id_user);
            $this->db->where_not_in('status', $status_value);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahSuratMasukDisetujuiKajur($id_user)
    {
        $this->db->where('status', 'Disetujui Kajur');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where('id_user', $id_user);
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahSuratMasukDitolakKajur($id_user)
    {
        $this->db->where('status', 'Ditolak Kajur');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where('id_user', $id_user);
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahSuratMasukSelesaiKajur($id_user)
    {
        $this->db->where('status', 'Surat Selesai');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('pilih_kajur', $id_user);
            $this->db->where('status', 'Surat Selesai');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataGrafikKajur($id_user)
    {
        $this->db->where('status', 'Surat Pengantar Selesai Dibuat Kaprodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $this->db->where_in('id', $id_pengajuan);
                $this->db->where('pilih_kajur', $id_user);
                $this->db->where('DATE(tanggal_buat_sm)', $date);
                $count = $this->db->count_all_results('surat');
                $data[] = $count;
            }

            return $data;
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataSuratMasukTerbaruKajur($id_user)
    {
        $this->db->where('status', 'Surat Pengantar Selesai Dibuat Kaprodi');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('pilih_kajur', $id_user);
            $this->db->order_by('tanggal_buat_sm', 'DESC');
            $this->db->limit(5);
            return $this->db->get('surat')->result_array();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getAllDataJumlahSuratMasukStaf()
    {
        $this->db->where('status', 'Disetujui Kajur');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where('status', 'Disetujui Kajur');
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahSuratMasukTerbaruStaf()
    {
        $sm = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($sm)) {
            $id_pengajuan = [];

            foreach ($sm as $s) {
                $id_pengajuan[] = $s['id'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('status', 'Disetujui Kajur');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataJumlahSuratMasukDiprosesStaf()
    {
        $sm = $this->db->get('surat')->result_array();

        $status = ['Diajukan Ke Prodi', 'Disetujui Kaprodi', 'Ditolak Kaprodi', 'Surat Pengantar Selesai Dibuat Kaprodi', 'Disetujui Kajur', 'Ditolak Kajur', 'Surat Selesai'];

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($sm)) {
            $id_pengajuan = [];

            foreach ($sm as $s) {
                $id_pengajuan[] = $s['id'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where_not_in('status', $status);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataJumlahSuratMasukSelesaiStaf()
    {
        $sm = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($sm)) {
            $id_pengajuan = [];

            foreach ($sm as $s) {
                $id_pengajuan[] = $s['id'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('status', 'Surat Selesai');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataGrafikStaf()
    {
        $this->db->where('status', 'Disetujui Kajur');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $this->db->where_in('id', $id_pengajuan);
                $this->db->where('DATE(tanggal_buat_sm)', $date);
                $count = $this->db->count_all_results('surat');
                $data[] = $count;
            }

            return $data;
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataSuratMasukTerbaruStaf()
    {
        $this->db->where('status', 'Disetujui Kajur');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->order_by('tanggal_buat_sm', 'DESC');
            $this->db->limit(5);
            return $this->db->get('surat')->result_array();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getAllDataJumlahDisposisiDekan()
    {
        $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Dekan');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Dekan');
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahDisposisiTerbaruDekan()
    {
        $disposisi = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($disposisi)) {
            $id_pengajuan = [];

            foreach ($disposisi as $d) {
                $id_pengajuan[] = $d['id'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Dekan');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataJumlahDisposisiDiprosesDekan()
    {
        $disposisi = $this->db->get('surat')->result_array();

        $status = ['Diajukan Ke Prodi', 'Disetujui Kaprodi', 'Ditolak Kaprodi', 'Surat Pengantar Selesai Dibuat Kaprodi', 'Disetujui Kajur', 'Ditolak Kajur', 'Lembar Disposisi Diteruskan Ke Dekan', 'Surat Selesai'];

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($disposisi)) {
            $id_pengajuan = [];

            foreach ($disposisi as $d) {
                $id_pengajuan[] = $d['id'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where_not_in('status', $status);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataJumlahDisposisiSelesaiDekan()
    {
        $disposisi = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($disposisi)) {
            $id_pengajuan = [];

            foreach ($disposisi as $d) {
                $id_pengajuan[] = $d['id'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('status', 'Surat Selesai');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataGrafikDekan()
    {
        $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Dekan');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $this->db->where_in('id', $id_pengajuan);
                $this->db->where('DATE(tanggal_terima_sm)', $date);
                $count = $this->db->count_all_results('surat');
                $data[] = $count;
            }

            return $data;
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataDisposisiTerbaruDekan()
    {
        $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Dekan');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->order_by('tanggal_terima_sm', 'DESC');
            $this->db->limit(5);
            return $this->db->get('surat')->result_array();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getAllDataJumlahDisposisiWadek($id_user)
    {
        $disposisi = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($disposisi)) {
            $id = [];

            foreach ($disposisi as $d) {
                // Pastikan pilih_wadek tidak kosong atau NULL
                if (!empty($d['pilih_wadek'])) {
                    // Pisahkan nilai pilih_wadek berdasarkan koma
                    $wadek_values = explode(',', $d['pilih_wadek']);

                    // Periksa apakah id_user ada dalam wadek_values
                    if (in_array($id_user, $wadek_values)) {
                        $id[] = $d['id'];
                    }
                }
            }

            $this->db->where_in('id_pengajuan_surat', $id);
            $this->db->like('status', 'Lembar Disposisi Diteruskan Ke Wadek');
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataJumlahDisposisiTerbaruWadek($id_user)
    {
        $this->db->where('id', $id_user);
        $user = $this->db->get('user')->row();

        $disposisi = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika data surat tidak kosong
        if (!empty($disposisi)) {
            $id = [];

            foreach ($disposisi as $d) {
                // Pastikan pilih_wadek tidak kosong atau NULL
                if (!empty($d['pilih_wadek'])) {
                    // Pisahkan nilai pilih_wadek berdasarkan koma
                    $wadek_values = explode(',', $d['pilih_wadek']);

                    // Periksa apakah id_user ada dalam wadek_values
                    if (in_array($id_user, $wadek_values)) {
                        $id[] = $d['id'];
                    }
                }
            }

            $this->db->where_in('id', $id);
            $dis = $this->db->get('surat')->result_array();
            $ids = [];

            foreach ($dis as $ds) {
                if (empty($ds['isi_disposisi_' . strtolower(str_replace(' ', '', $user->jabatan))])) {
                    $ids[] = $ds['id'];
                }
            }

            if (!empty($ids)) {
                $this->db->where_in('id', $ids);
                return $this->db->get('surat')->num_rows();
            } else {
                return 0;
            }
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataJumlahDisposisiDiprosesWadek($id_user)
    {
        $disposisi = $this->db->get('surat')->result_array();

        $status = ['Lembar Disposisi Diteruskan Ke Kabag TU', 'Surat Masih Dicetak Staf', 'Surat Masih Ditandatangani Dekan'];

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($disposisi)) {
            $id = [];

            foreach ($disposisi as $d) {
                // Pastikan pilih_wadek tidak kosong atau NULL
                if (!empty($d['pilih_wadek'])) {
                    // Pisahkan nilai pilih_wadek berdasarkan koma
                    $wadek_values = explode(',', $d['pilih_wadek']);

                    // Periksa apakah id_user ada dalam wadek_values
                    if (in_array($id_user, $wadek_values)) {
                        $id[] = $d['id'];
                    }
                }
            }

            $this->db->where_in('id', $id);
            $this->db->where_in('status', $status);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataJumlahDisposisiSelesaiWadek($id_user)
    {
        $disposisi = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika data surat tidak kosong
        if (!empty($disposisi)) {
            $id = [];

            foreach ($disposisi as $d) {
                // Pastikan pilih_wadek tidak kosong atau NULL
                if (!empty($d['pilih_wadek'])) {
                    // Pisahkan nilai pilih_wadek berdasarkan koma
                    $wadek_values = explode(',', $d['pilih_wadek']);

                    // Periksa apakah id_user ada dalam wadek_values
                    if (in_array($id_user, $wadek_values)) {
                        $id[] = $d['id'];
                    }
                }
            }

            $this->db->where_in('id', $id);
            $this->db->where('status', 'Surat Selesai');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataGrafikWadek($id_user)
    {
        $disposisi = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika data surat tidak kosong
        if (!empty($disposisi)) {
            $id = [];

            foreach ($disposisi as $d) {
                // Pastikan pilih_wadek tidak kosong atau NULL
                if (!empty($d['pilih_wadek'])) {
                    // Pisahkan nilai pilih_wadek berdasarkan koma
                    $wadek_values = explode(',', $d['pilih_wadek']);

                    // Periksa apakah id_user ada dalam wadek_values
                    if (in_array($id_user, $wadek_values)) {
                        $id[] = $d['id'];
                    }
                }
            }

            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $this->db->where_in('id', $id);
                $this->db->where('DATE(tanggal_terima_sm)', $date);
                $count = $this->db->count_all_results('surat');
                $data[] = $count;
            }

            return $data;
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataDisposisiTerbaruWadek($id_user)
    {
        $disposisi = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika data surat tidak kosong
        if (!empty($disposisi)) {
            $id = [];

            foreach ($disposisi as $d) {
                // Pastikan pilih_wadek tidak kosong atau NULL
                if (!empty($d['pilih_wadek'])) {
                    // Pisahkan nilai pilih_wadek berdasarkan koma
                    $wadek_values = explode(',', $d['pilih_wadek']);

                    // Periksa apakah id_user ada dalam wadek_values
                    if (in_array($id_user, $wadek_values)) {
                        $id[] = $d['id'];
                    }
                }
            }

            $this->db->where_in('id', $id);
            $this->db->order_by('tanggal_terima_sm', 'DESC');
            $this->db->limit(5);
            return $this->db->get('surat')->result_array();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getAllDataJumlahDisposisiKabagtu()
    {
        $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Kabag TU');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->distinct();
            $this->db->select('id_pengajuan_surat');
            $this->db->where_in('id_pengajuan_surat', $id_pengajuan);
            $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Kabag TU');
            return $this->db->get('status')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataJumlahDisposisiTerbaruKabagtu()
    {
        $disposisi = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($disposisi)) {
            $id_pengajuan = [];

            foreach ($disposisi as $d) {
                $id_pengajuan[] = $d['id'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Kabag TU');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataJumlahDisposisiDiprosesKabagtu()
    {
        $disposisi = $this->db->get('surat')->result_array();

        $status = ['Surat Masih Dicetak Staf', 'Surat Masih Ditandatangani Dekan'];

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($disposisi)) {
            $id_pengajuan = [];

            foreach ($disposisi as $d) {
                $id_pengajuan[] = $d['id'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where_in('status', $status);
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataJumlahDisposisiSelesaiKabagtu()
    {
        $disposisi = $this->db->get('surat')->result_array();

        // Tambahkan pengecekan jika surat tidak kosong
        if (!empty($disposisi)) {
            $id_pengajuan = [];

            foreach ($disposisi as $d) {
                $id_pengajuan[] = $d['id'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->where('status', 'Surat Selesai');
            return $this->db->get('surat')->num_rows();
        }

        return 0; // Kembalikan 0 jika tidak ada data surat
    }

    public function getDataGrafikKabagtu()
    {
        $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Kabag TU');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $this->db->where_in('id', $id_pengajuan);
                $this->db->where('DATE(tanggal_terima_sm)', $date);
                $count = $this->db->count_all_results('surat');
                $data[] = $count;
            }

            return $data;
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }

    public function getDataDisposisiTerbaruKabagtu()
    {
        $this->db->where('status', 'Lembar Disposisi Diteruskan Ke Kabag TU');
        $status = $this->db->get('status')->result_array();

        // Tambahkan pengecekan jika status tidak kosong
        if (!empty($status)) {
            $id_pengajuan = [];

            foreach ($status as $s) {
                $id_pengajuan[] = $s['id_pengajuan_surat'];
            }

            $this->db->where_in('id', $id_pengajuan);
            $this->db->order_by('tanggal_terima_sm', 'DESC');
            $this->db->limit(5);
            return $this->db->get('surat')->result_array();
        }

        return 0; // Kembalikan 0 jika tidak ada data status
    }
}
