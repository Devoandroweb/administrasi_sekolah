<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\PrintsController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\riwayatlaporanController;
use App\Http\Controllers\TanggunganlaluController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\TahunAjaranController;

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

	Route::get('/login',[LoginController::class,'index'])->name('login');
	Route::get('/logout',[LoginController::class,'logout']);
	Route::post('/aksilogin',[LoginController::class,'aksiLogin']);
	Route::post('/error',[LoginController::class,'error_connection']);


Route::middleware(['auth'])->group(function () {


	//administrasi
	Route::post('/administrasi',[AdministrasiController::class,'index']);
	Route::post('/read_adm_by/{id}',[AdministrasiController::class,'edit']);
	Route::post('/simpan_edit_adm/{id}',[AdministrasiController::class,'update']);
	Route::post('/tgg_prev_by/{id}',[AdministrasiController::class,'get_tgg_prev']);
	Route::get('/isi_administrasi_all',[AdministrasiController::class,'refillable']);
	Route::post('/add_ijazah_5000/{id}',[AdministrasiController::class,'add_ijazah_cepek']);
	Route::post('/pick_ijazah/{id}',[AdministrasiController::class,'pick_ijazah']);
	Route::post('/simpan_edit_ijazah/{id}',[AdministrasiController::class,'simpan_edit_ijazah']);

	
	//cari pass
	Route::post('/change_pass',[PasswordController::class,'store']);
	Route::post('/checkPass',[PasswordController::class,'checkPass']);


	//chart
	Route::get('/chart_pemasukan',[PemasukanController::class,'chart']);
	Route::get('/chart_pengeluaran',[PengeluaranController::class,'chart']);

	//download
	Route::get('/download_excel_siswa',[PrintsController::class,'download_excel_siswa'])->name('download_excel_siswa');
	Route::get('/download_excel_pengeluaran',[PrintsController::class,'download_excel_pengeluaran'])->name('download_excel_pengeluaran');

	
	//datatable
	Route::get('/jsonsiswa',[SiswaController::class,'json_siswa']);
	Route::get('/jsonadministrasi',[AdministrasiController::class,'json_administrasi']);
	Route::get('/json_pemasukan/{status}/{a}/{b}',[PemasukanController::class,'jsonpemasukan']);
	Route::get('/json_pengeluaran/{status}/{a}/{b}',[PengeluaranController::class,'jsonpengeluaran']);
	Route::get('/json_riwlap',[riwayatlaporanController::class,'jsonriwlap']);
	Route::get('/json_rekapitulasi',[riwayatlaporanController::class,'jsonrekapitulasi']);
	Route::get('/json_tanggunganprev',[TanggunganlaluController::class,'json_tanggungan_lalu']);
	Route::get('/jsonalumni',[SiswaController::class,'json_siswaalumni']);
	Route::get('/jsonijazah',[AdministrasiController::class,'json_ijazah']);

	
	//export
	Route::get('/alumni_export',[PrintsController::class,'alumni_export']);
	Route::get('/export_excel',[PrintsController::class,'export_excel']);
	Route::get('/export_pemasukan',[PrintsController::class,'export_pemasukan']);

	//home
	Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');
	Route::get('/pemasukan',[HomeController::class,'pemasukan']);
	Route::get('/pengeluaran',[HomeController::class,'pengeluaran']);
	Route::get('/siswa',[HomeController::class,'siswa']);
	Route::get('/alumni',[HomeController::class,'alumni']);	
	Route::get('/administrasi',[HomeController::class,'administrasi']);
	Route::get('/riwayat_laporan',[HomeController::class,'riwayat_laporan']);
	Route::get('/rekapitulasi',[HomeController::class,'rekapitulasi']);
	Route::get('/tanggungan_lalu',[HomeController::class,'tanggungan_lalu']);
	Route::get('/tanggungan_ijazah',[HomeController::class,'tanggungan_ijazah']);

	//import
	Route::post('/import_siswa',[SiswaController::class,'import_siswa']);
	Route::post('/import_pengeluaran',[PengeluaranController::class,'import_pengeluaran']);

	//pemasukan
	Route::post('/read_pemasukan',[PemasukanController::class,'index']);
	Route::post('/add_pemasukan',[PemasukanController::class,'store']);
	Route::post('/search_pemasukan/{id}',[PemasukanController::class,'show']);
	Route::post('/hapus_pemasukan/{id}',[PemasukanController::class,'destroy']);
	Route::post('/simpan_editpemasukan/{id}',[PemasukanController::class,'update']);
	
	//pengeluaran
	Route::post('/simpan_pengeluaran',[PengeluaranController::class,'store']);
	Route::post('/hapus_pengeluaran/{id}',[PengeluaranController::class,'destroy']);
	Route::post('/edit_pengeluaran/{id}',[PengeluaranController::class,'edit']);
	Route::post('/simpan_edit_pengeluaran/{id}',[PengeluaranController::class,'update']);

	//print
	Route::get('/cetak_pemasukan',[PemasukanController::class,'index']);
	Route::get('/cetak_pengeluaran',[PengeluaranController::class,'index']);
	Route::get('/cetak_administrasi',[AdministrasiController::class,'index']);
	Route::get('/cetak_tanggungan_ijazah',[AdministrasiController::class,'cetak_ijazah']);
	Route::get('/cetak_struk',[PemasukanController::class,'cetak_struk']);
	Route::get('/cetak_administrasi_pers/{id}',[AdministrasiController::class,'cetak_siswa']);
	Route::get('/cetak_data_siswa',[SiswaController::class,'cetak_data_siswa']);
	Route::get('/cetak_tanggungan_lalu',[TanggunganlaluController::class,'index']);
	Route::get('/cetak_rekapitulasi',[RekapitulasiController::class,'cetak_rekapitulasi']);

	// riwayat
	Route::post('/add_riw_adm',[AdministrasiController::class,'create']);
	Route::post('/add_riw_pemsukan',[PemasukanController::class,'create']);
	Route::post('/add_riw_pengeluaran',[PengeluaranController::class,'create']);
	Route::post('/add_riw_siswa',[SiswaController::class,'create']);
	Route::post('/delete_riwlap/{id}',[riwayatlaporanController::class,'destroy']);


	//siswa
	Route::post('/addsiswa',[SiswaController::class,'store']);
	Route::get('/read_siswa_by/{id}',[SiswaController::class,'edit']);
	Route::post('/update_siswa/{id}',[SiswaController::class,'update']);
	Route::post('/delete_siswa/{id}',[SiswaController::class,'destroy']);
	Route::post('/search_siswa/{id}',[SiswaController::class,'show']);
	Route::post('/read_siswa',[SiswaController::class,'index']);
	Route::post('/read_siswa_alumni',[AlumniController::class,'index']);


	//tahun ajaran
	Route::post('/simpan_tahun_ajaran/{id}',[TahunAjaranController::class,'update']);
	Route::get('/halaman_tahun_ajaran',[TahunAjaranController::class,'index']);
	Route::post('/tambah_tahun_ajaran',[TahunAjaranController::class,'store']);

	
	//tgg_prev
	Route::get('/updatetggprev',[TanggunganlaluController::class,'update_tggprev']);
	Route::post('/read_tanggungan_lalu_by/{id}',[TanggunganlaluController::class,'get_tanggungan_lalu_by']);
	Route::post('/simpan_edit_tanggungan_lalu/{id}',[TanggunganlaluController::class,'update']);
	Route::post('/hapus_tgg_prev/{id}',[TanggunganlaluController::class,'destroy']);

});