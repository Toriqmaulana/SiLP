<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Homepage';
$route['logout'] = 'Homepage/logout';

$route['Admin'] = 'Admin';
$route['pengguna'] = 'Admin/pengguna';
$route['tambahPengguna'] = 'Admin/tambahPengguna';
$route['tambahAksiPengguna'] = 'Admin/tambahAksiPengguna';
$route['editPengguna/(:num)'] = 'Admin/editPengguna/$1';
$route['editAksiPengguna/(:num)'] = 'Admin/editAksiPengguna/$1';
$route['hapusPengguna/(:num)'] = 'Admin/hapusPengguna/$1';
$route['prodi'] = 'Admin/prodi';
$route['tambahProdi'] = 'Admin/tambahProdi';
$route['tambahAksiProdi'] = 'Admin/tambahAksiProdi';
$route['editProdi/(:num)'] = 'Admin/editProdi/$1';
$route['editAksiProdi/(:num)'] = 'Admin/editAksiProdi/$1';
$route['hapusProdi/(:num)'] = 'Admin/hapusProdi/$1';
$route['jurusan'] = 'Admin/jurusan';
$route['tambahJurusan'] = 'Admin/tambahJurusan';
$route['tambahAksiJurusan'] = 'Admin/tambahAksiJurusan';
$route['editJurusan/(:num)'] = 'Admin/editJurusan/$1';
$route['editAksiJurusan/(:num)'] = 'Admin/editAksiJurusan/$1';
$route['hapusJurusan/(:num)'] = 'Admin/hapusJurusan/$1';
$route['jenisSurat'] = 'Admin/jenisSurat';
$route['tambahJenisSurat'] = 'Admin/tambahJenisSurat';
$route['tambahAksiJenisSurat'] = 'Admin/tambahAksiJenisSurat';
$route['editJenisSurat/(:num)'] = 'Admin/editJenisSurat/$1';
$route['editAksiJenisSurat/(:num)'] = 'Admin/editAksiJenisSurat/$1';
$route['hapusJenisSurat/(:num)'] = 'Admin/hapusJenisSurat/$1';

$route['Pemohon'] = 'Pemohon';
$route['pengajuan'] = 'Pemohon/pengajuan';
$route['tambahPengajuan'] = 'Pemohon/tambahPengajuan';
$route['tambahAksiPengajuan'] = 'Pemohon/tambahAksiPengajuan';
$route['editPengajuan/(:num)'] = 'Pemohon/editPengajuan/$1';
$route['editAksiPengajuan/(:num)'] = 'Pemohon/editAksiPengajuan/$1';
$route['removeFile/(:any)'] = 'Pemohon/removeFile/$1';
$route['detailPengajuan/(:num)'] = 'Pemohon/detailPengajuan/$1';
$route['hapusPengajuan/(:num)'] = 'Pemohon/hapusPengajuan/$1';
$route['arsip'] = 'Pemohon/arsip';
$route['profile'] = 'Pemohon/profile';
$route['editProfile/(:num)'] = 'Pemohon/editProfile/$1';

$route['Kaprodi'] = 'Kaprodi';
$route['suratKaprodi'] = 'Kaprodi/suratKaprodi';
$route['editPengajuanKaprodi/(:num)'] = 'Kaprodi/editPengajuanKaprodi/$1';
$route['editAksiPengajuanKaprodi/(:num)'] = 'Kaprodi/editAksiPengajuanKaprodi/$1';
$route['detailPengajuanKaprodi/(:num)'] = 'Kaprodi/detailPengajuanKaprodi/$1';
$route['approvePengajuanKaprodi/(:num)'] = 'Kaprodi/approvePengajuanKaprodi/$1';
$route['tambahSuratPengantarKaprodi/(:num)'] = 'Kaprodi/tambahSuratPengantarKaprodi/$1';
$route['tambahAksiSuratPengantarKaprodi/(:num)'] = 'Kaprodi/tambahAksiSuratPengantarKaprodi/$1';
$route['editSuratPengantarKaprodi/(:num)'] = 'Kaprodi/editSuratPengantarKaprodi/$1';
$route['editAksiSuratPengantarKaprodi/(:num)'] = 'Kaprodi/editAksiSuratPengantarKaprodi/$1';
$route['detailSuratPengantarKaprodi/(:num)'] = 'Kaprodi/detailSuratPengantarKaprodi/$1';
$route['printSuratPengantarKaprodi/(:num)'] = 'Kaprodi/printSuratPengantarKaprodi/$1';
$route['arsipSuratKaprodi'] = 'Kaprodi/arsipSuratKaprodi';
$route['profileKaprodi'] = 'Kaprodi/profileKaprodi';
$route['editProfileKaprodi/(:num)'] = 'Kaprodi/editProfileKaprodi/$1';
$route['suratpengajuanKaprodi'] = 'Kaprodi/suratpengajuanKaprodi';
$route['tambahSuratPengajuanKaprodi'] = 'Kaprodi/tambahSuratPengajuanKaprodi';
$route['tambahAksiSuratPengajuanKaprodi'] = 'Kaprodi/tambahAksiSuratPengajuanKaprodi';
$route['editSuratPengajuanKaprodi/(:num)'] = 'Kaprodi/editSuratPengajuanKaprodi/$1';
$route['editAksiSuratPengajuanKaprodi/(:num)'] = 'Kaprodi/editAksiSuratPengajuanKaprodi/$1';
$route['removeFileKaprodi/(:any)'] = 'Kaprodi/removeFileKaprodi/$1';
$route['detailSuratPengajuanKaprodi/(:num)'] = 'Kaprodi/detailSuratPengajuanKaprodi/$1';
$route['hapusSuratPengajuanKaprodi/(:num)'] = 'Kaprodi/hapusSuratPengajuanKaprodi/$1';
$route['arsipSuratPengajuanKaprodi'] = 'Kaprodi/arsipSuratPengajuanKaprodi';

$route['Kajur'] = 'Kajur';
$route['suratKajur'] = 'Kajur/suratKajur';
$route['detailSuratMasukKajur/(:num)'] = 'Kajur/detailSuratMasukKajur/$1';
$route['approveSuratMasukKajur/(:num)'] = 'Kajur/approveSuratMasukKajur/$1';
$route['printSuratMasukKajur/(:num)'] = 'Kajur/printSuratMasukKajur/$1';
$route['arsipSuratMasukKajur'] = 'Kajur/arsipSuratMasukKajur';
$route['profileKajur'] = 'Kajur/profileKajur';
$route['editProfileKajur/(:num)'] = 'Kajur/editProfileKajur/$1';

$route['Staf'] = 'Staf';
$route['disposisiStaf'] = 'Staf/disposisiStaf';
$route['tambahDisposisiStaf/(:num)'] = 'Staf/tambahDisposisiStaf/$1';
$route['tambahAksiDisposisiStaf/(:num)'] = 'Staf/tambahAksiDisposisiStaf/$1';
$route['editDisposisiStaf/(:num)'] = 'Staf/editDisposisiStaf/$1';
$route['editAksiDisposisiStaf/(:num)'] = 'Staf/editAksiDisposisiStaf/$1';
$route['detailDisposisiStaf/(:num)'] = 'Staf/detailDisposisiStaf/$1';
$route['printDisposisiStaf/(:num)'] = 'Staf/printDisposisiStaf/$1';
$route['arsipDisposisiStaf'] = 'Staf/arsipDisposisiStaf';
$route['suratStaf'] = 'Staf/suratStaf';
$route['viewSuratMasukStaf/(:num)'] = 'Staf/viewSuratMasukStaf/$1';
$route['tambahNoSuratKeluarStaf/(:num)'] = 'Staf/tambahNoSuratKeluarStaf/$1';
$route['tambahAksiNoSuratKeluarStaf/(:num)'] = 'Staf/tambahAksiNoSuratKeluarStaf/$1';
$route['tambahSuratKeluarStaf/(:num)'] = 'Staf/tambahSuratKeluarStaf/$1';
$route['tambahAksiSuratKeluarStaf/(:num)'] = 'Staf/tambahAksiSuratKeluarStaf/$1';
$route['arsipSuratKeluarStaf'] = 'Staf/arsipSuratKeluarStaf';
$route['profileStaf'] = 'Staf/profileStaf';
$route['editProfileStaf/(:num)'] = 'Staf/editProfileStaf/$1';

$route['Dekan'] = 'Dekan';
$route['disposisiDekan'] = 'Dekan/disposisiDekan';
$route['detailSuratMasukDekan/(:num)'] = 'Dekan/detailSuratMasukDekan/$1';
$route['tambahDisposisiDekan/(:num)'] = 'Dekan/tambahDisposisiDekan/$1';
$route['tambahAksiDisposisiDekan/(:num)'] = 'Dekan/tambahAksiDisposisiDekan/$1';
$route['lihatSuratMasukDekan/(:num)'] = 'Dekan/lihatSuratMasukDekan/$1';
$route['editDisposisiDekan/(:num)'] = 'Dekan/editDisposisiDekan/$1';
$route['editAksiDisposisiDekan/(:num)'] = 'Dekan/editAksiDisposisiDekan/$1';
$route['detailDisposisiDekan/(:num)'] = 'Dekan/detailDisposisiDekan/$1';
$route['printDisposisiDekan/(:num)'] = 'Dekan/printDisposisiDekan/$1';
$route['arsipDisposisiDekan'] = 'Dekan/arsipDisposisiDekan';
$route['profileDekan'] = 'Dekan/profileDekan';
$route['editProfileDekan/(:num)'] = 'Dekan/editProfileDekan/$1';

$route['Wadek'] = 'Wadek';
$route['disposisiWadek'] = 'Wadek/disposisiWadek';
$route['detailSuratMasukWadek/(:num)'] = 'Wadek/detailSuratMasukWadek/$1';
$route['tambahDisposisiWadek/(:num)'] = 'Wadek/tambahDisposisiWadek/$1';
$route['tambahAksiDisposisiWadek/(:num)'] = 'Wadek/tambahAksiDisposisiWadek/$1';
$route['lihatSuratMasukWadek/(:num)'] = 'Wadek/lihatSuratMasukWadek/$1';
$route['editDisposisiWadek/(:num)'] = 'Wadek/editDisposisiWadek/$1';
$route['editAksiDisposisiWadek/(:num)'] = 'Wadek/editAksiDisposisiWadek/$1';
$route['detailDisposisiWadek/(:num)'] = 'Wadek/detailDisposisiWadek/$1';
$route['printDisposisiWadek/(:num)'] = 'Wadek/printDisposisiWadek/$1';
$route['arsipDisposisiWadek'] = 'Wadek/arsipDisposisiWadek';
$route['profileWadek'] = 'Wadek/profileWadek';
$route['editProfileWadek/(:num)'] = 'Wadek/editProfileWadek/$1';

$route['Kabag_TU'] = 'Kabag_TU';
$route['disposisiKabagtu'] = 'Kabag_TU/disposisiKabagtu';
$route['detailSuratMasukKabagtu/(:num)'] = 'Kabag_TU/detailSuratMasukKabagtu/$1';
$route['tambahDisposisiKabagtu/(:num)'] = 'Kabag_TU/tambahDisposisiKabagtu/$1';
$route['tambahAksiDisposisiKabagtu/(:num)'] = 'Kabag_TU/tambahAksiDisposisiKabagtu/$1';
$route['lihatSuratMasukKabagtu/(:num)'] = 'Kabag_TU/lihatSuratMasukKabagtu/$1';
$route['editDisposisiKabagtu/(:num)'] = 'Kabag_TU/editDisposisiKabagtu/$1';
$route['editAksiDisposisiKabagtu/(:num)'] = 'Kabag_TU/editAksiDisposisiKabagtu/$1';
$route['detailDisposisiKabagtu/(:num)'] = 'Kabag_TU/detailDisposisiKabagtu/$1';
$route['printDisposisiKabagtu/(:num)'] = 'Kabag_TU/printDisposisiKabagtu/$1';
$route['arsipDisposisiKabagtu'] = 'Kabag_TU/arsipDisposisiKabagtu';
$route['profileKabagtu'] = 'Kabag_TU/profileKabagtu';
$route['editProfileKabagtu/(:num)'] = 'Kabag_TU/editProfileKabagtu/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
