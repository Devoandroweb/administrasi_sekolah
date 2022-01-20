<?php

use App\Http\Controllers\Admin\CAdministrator;
use App\Http\Controllers\Admin\CGuru;
use App\Http\Controllers\Admin\CJurusan;
use App\Http\Controllers\Admin\CKelas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrasi\Controller;

use App\Http\Controllers\Administrasi\LoginController;
use App\Http\Controllers\Administrasi\HomeController;
use App\Http\Controllers\Administrasi\SiswaController;
use App\Http\Controllers\Administrasi\AdministrasiController;
use App\Http\Controllers\Administrasi\PrintsController;
use App\Http\Controllers\Administrasi\PemasukanController;
use App\Http\Controllers\Administrasi\PengeluaranController;
use App\Http\Controllers\Administrasi\riwayatlaporanController;
use App\Http\Controllers\Administrasi\TanggunganlaluController;
use App\Http\Controllers\Administrasi\PasswordController;
use App\Http\Controllers\Administrasi\ClientController;
use App\Http\Controllers\Administrasi\RekapitulasiController;
use App\Http\Controllers\Administrasi\TahunAjaranController;
use App\Http\Controllers\Administrasi\CJenisAdministrasi;
use App\Http\Controllers\Administrasi\CPembayaran;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware("guest");
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/aksilogin', [LoginController::class, 'aksiLogin']);
Route::post('/error', [LoginController::class, 'error_connection']);


Route::middleware(['auth'])->group(function () {




	//jenis tanggungan
	Route::get('/jenis-administrasi', [CJenisAdministrasi::class, 'index']);
	Route::post('/jenis-administrasi-add', [CJenisAdministrasi::class, 'saveCreate']);
	Route::post('/jenis-administrasi-show/{id}', [CJenisAdministrasi::class, 'show']);
	Route::get('/jenis-administrasi-delete/{id}', [CJenisAdministrasi::class, 'destroy']);
	Route::get('/jenis-administrasi-datatable', [CJenisAdministrasi::class, 'datatable']);

	//administrasi
	// Route::get('/administrasi', [AdministrasiController::class, 'index']);
	Route::post('/read_adm_by/{id}', [AdministrasiController::class, 'edit']);
	Route::post('/read_adm_by_siswa/{id}', [AdministrasiController::class, 'showByIdSiswa']);
	Route::post('/simpan_edit_adm/{id}', [AdministrasiController::class, 'update']);
	Route::post('/tgg_prev_by/{id}', [AdministrasiController::class, 'get_tgg_prev']);
	Route::get('/isi_administrasi_all', [AdministrasiController::class, 'refillable']);
	Route::post('/add_ijazah_5000/{id}', [AdministrasiController::class, 'add_ijazah_cepek']);
	Route::post('/pick_ijazah/{id}', [AdministrasiController::class, 'pick_ijazah']);
	Route::post('/simpan_edit_ijazah/{id}', [AdministrasiController::class, 'simpan_edit_ijazah']);


	//cari pass
	Route::post('/change_pass', [PasswordController::class, 'store']);
	Route::post('/checkPass', [PasswordController::class, 'checkPass']);


	//chart
	Route::get('/chart_pemasukan', [PemasukanController::class, 'chart']);
	Route::get('/chart_pengeluaran', [PengeluaranController::class, 'chart']);

	//download
	Route::get('/download_excel_pengeluaran', [PrintsController::class, 'download_excel_pengeluaran'])->name('download_excel_pengeluaran');


	//datatable
	Route::get('/jsonsiswa', [SiswaController::class, 'json_siswa']);
	Route::get('/jsonadministrasi', [AdministrasiController::class, 'json_administrasi']);
	Route::get('/json_pemasukan/{status}/{a}/{b}', [PemasukanController::class, 'jsonpemasukan']);
	Route::get('/json_pengeluaran/{status}/{a}/{b}', [PengeluaranController::class, 'jsonpengeluaran']);
	Route::get('/json_riwlap', [riwayatlaporanController::class, 'jsonriwlap']);
	Route::get('/json_rekapitulasi', [riwayatlaporanController::class, 'jsonrekapitulasi']);
	Route::get('/json_tanggunganprev', [TanggunganlaluController::class, 'json_tanggungan_lalu']);
	Route::get('/jsonalumni', [SiswaController::class, 'json_siswaalumni']);
	Route::get('/jsonijazah', [AdministrasiController::class, 'json_ijazah']);


	//export
	Route::get('/alumni_export', [PrintsController::class, 'alumni_export']);
	Route::get('/export_excel', [PrintsController::class, 'export_excel']);
	Route::get('/export_pemasukan', [PrintsController::class, 'export_pemasukan']);

	//home
	Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
	Route::get('/pemasukan', [HomeController::class, 'pemasukan']);
	Route::get('/pengeluaran', [HomeController::class, 'pengeluaran']);

	Route::get('/alumni', [HomeController::class, 'alumni']);
	Route::get('/administrasi', [HomeController::class, 'administrasi']);
	Route::get('/riwayat_laporan', [HomeController::class, 'riwayat_laporan']);
	Route::get('/rekapitulasi', [HomeController::class, 'rekapitulasi']);
	Route::get('/tanggungan_lalu', [HomeController::class, 'tanggungan_lalu']);
	Route::get('/tanggungan_ijazah', [HomeController::class, 'tanggungan_ijazah']);

	//import
	Route::post('/import_pengeluaran', [PengeluaranController::class, 'import_pengeluaran']);

	//pemasukan
	Route::post('/read_pemasukan', [PemasukanController::class, 'index']);
	Route::post('/add_pemasukan', [PemasukanController::class, 'store']);
	Route::post('/search_pemasukan/{id}', [PemasukanController::class, 'show']);
	Route::post('/hapus_pemasukan/{id}', [PemasukanController::class, 'destroy']);
	Route::post('/simpan_editpemasukan/{id}', [PemasukanController::class, 'update']);

	//pengeluaran
	Route::post('/simpan_pengeluaran', [PengeluaranController::class, 'store']);
	Route::post('/hapus_pengeluaran/{id}', [PengeluaranController::class, 'destroy']);
	Route::post('/edit_pengeluaran/{id}', [PengeluaranController::class, 'edit']);
	Route::post('/simpan_edit_pengeluaran/{id}', [PengeluaranController::class, 'update']);

	//print
	Route::get('/cetak_pemasukan', [PemasukanController::class, 'index']);
	Route::get('/cetak_pengeluaran', [PengeluaranController::class, 'index']);
	Route::get('/cetak_administrasi', [AdministrasiController::class, 'index']);
	Route::get('/cetak_tanggungan_ijazah', [AdministrasiController::class, 'cetak_ijazah']);
	Route::get('/cetak_struk', [PemasukanController::class, 'cetak_struk']);
	Route::get('/cetak_administrasi_pers/{id}', [AdministrasiController::class, 'cetak_siswa']);
	Route::get('/cetak_data_siswa', [SiswaController::class, 'cetak_data_siswa']);
	Route::get('/cetak_tanggungan_lalu', [TanggunganlaluController::class, 'index']);
	Route::get('/cetak_rekapitulasi', [RekapitulasiController::class, 'cetak_rekapitulasi']);

	// riwayat
	Route::post('/add_riw_adm', [AdministrasiController::class, 'create']);
	Route::post('/add_riw_pemsukan', [PemasukanController::class, 'create']);
	Route::post('/add_riw_pengeluaran', [PengeluaranController::class, 'create']);
	Route::post('/add_riw_siswa', [SiswaController::class, 'create']);
	Route::post('/delete_riwlap/{id}', [riwayatlaporanController::class, 'destroy']);





	//tahun ajaran
	Route::post('/simpan_tahun_ajaran/{id}', [TahunAjaranController::class, 'update']);
	Route::get('/halaman_tahun_ajaran', [TahunAjaranController::class, 'index']);
	Route::post('/tambah_tahun_ajaran', [TahunAjaranController::class, 'store']);


	//tgg_prev
	Route::get('/updatetggprev', [TanggunganlaluController::class, 'update_tggprev']);
	Route::post('/read_tanggungan_lalu_by/{id}', [TanggunganlaluController::class, 'get_tanggungan_lalu_by']);
	Route::post('/simpan_edit_tanggungan_lalu/{id}', [TanggunganlaluController::class, 'update']);
	Route::post('/hapus_tgg_prev/{id}', [TanggunganlaluController::class, 'destroy']);

	//pemabayaran
	Route::get('/pembayaran', [CPembayaran::class, 'index']);
	Route::get('/pembayaran-get-siswa/{id}', [CPembayaran::class, 'getSiswa']);
	Route::get('/pembayaran-get-adm/{id}', [CPembayaran::class, 'getDataBiaya']);
	Route::post('/pembayaran-save', [CPembayaran::class, 'save']);

	//admin
	Route::prefix('admin')->group(function () {
		### KELAS ###
		Route::get('/kelas', [CKelas::class, 'index']);
		Route::post('/kelas-add', [CKelas::class, 'saveCreate']);
		Route::get('/kelas-show/{id}', [CKelas::class, 'show']);
		Route::post('/kelas-save-update/{id}', [CKelas::class, 'saveUpdate']);
		Route::get('/kelas-delete/{id}', [CKelas::class, 'destroy']);
		Route::get('/kelas-datatable', [CKelas::class, 'datatable']);
		Route::post('/kelas-check', [CKelas::class, 'checkKelas']);
		Route::get('/kelas-add-siswa/{id}', [CKelas::class, 'addSiswa']);
		Route::post('/kelas-save-add-siswa/{id}', [CKelas::class, 'addSiswaSave']);
		Route::get('/kelas-detail-siswa/{id}', [CKelas::class, 'detailSiswa']);
		### GURU ###
		Route::get('/guru', [CGuru::class, 'index']);
		Route::post('/guru-add', [CGuru::class, 'saveCreate']);
		Route::get('/guru-show/{id}', [CGuru::class, 'show']);
		Route::post('/guru-save-update/{id}', [CGuru::class, 'saveUpdate']);
		Route::get('/guru-delete/{id}', [CGuru::class, 'destroy']);
		Route::get('/guru-datatable', [CGuru::class, 'datatable']);
		### SISWA ###
		Route::get('/siswa', [HomeController::class, 'siswa']);
		Route::post('/addsiswa', [SiswaController::class, 'store']);
		Route::get('/read_siswa_by/{id}', [SiswaController::class, 'edit']);
		Route::post('/update_siswa/{id}', [SiswaController::class, 'update']);
		Route::post('/delete_siswa/{id}', [SiswaController::class, 'destroy']);
		Route::post('/search_siswa/{id}', [SiswaController::class, 'show']);
		Route::post('/read_siswa', [SiswaController::class, 'index']);
		Route::post('/read_siswa_alumni', [AlumniController::class, 'index']);
		Route::get('/download_excel_siswa', [PrintsController::class, 'download_excel_siswa'])->name('download_excel_siswa');
		Route::post('/import_siswa', [SiswaController::class, 'import_siswa']);

		### JURUSAN ###
		Route::get('/jurusan', [CJurusan::class, 'index']);
		Route::post('/jurusan-add', [CJurusan::class, 'saveCreate']);
		Route::get('/jurusan-show/{id}', [CJurusan::class, 'show']);
		Route::post('/jurusan-save-update/{id}', [CJurusan::class, 'saveUpdate']);
		Route::get('/jurusan-delete/{id}', [CJurusan::class, 'destroy']);
		Route::get('/jurusan-datatable', [CJurusan::class, 'datatable']);
		### USER MANAGEMENT ###
		Route::get('/user-management', [CAdministrator::class, 'index']);
		Route::post('/user-management-add', [CAdministrator::class, 'saveCreate']);
		Route::get('/user-management-show/{id}', [CAdministrator::class, 'show']);
		Route::post('/user-management-save-update/{id}', [CAdministrator::class, 'saveUpdate']);
		Route::get('/user-management-delete/{id}', [CAdministrator::class, 'destroy']);
		Route::get('/user-management-datatable', [CAdministrator::class, 'datatable']);
	});
});
