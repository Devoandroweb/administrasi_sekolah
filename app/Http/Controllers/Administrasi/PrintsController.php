<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\DataSiswa;
use Illuminate\Http\Request;
use App\Exports\SiswaExport;
use App\Exports\AlumniExport;
use App\Exports\PemasukanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class PrintsController extends Controller
{



	public function download_excel_siswa()
	{
		// $file=public_path()."/print/tes_excel.xlsx";
		//      return response()->download($file);
		$file = public_path() . "/template_import_data_siswa.xlsx";
		// dd($file);
		$headers = array(
			'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			// 'Content-Type: '.mime_content_type($file),
		);

		return response()->download($file, 'example_siswa.xlsx');
	}
	public function download_excel_pengeluaran()
	{
		// $file=public_path()."/print/tes_excel.xlsx";
		//      return response()->download($file);
		$file = public_path() . "/template_import_pengeluaran.xlsx";
		// dd($file);
		$headers = array(
			'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			// 'Content-Type: '.mime_content_type($file),
		);

		return response()->download($file, 'example_pengeluaran.xlsx');
	}
	public function export_excel()
	{
		$date = date('d-m-Y');
		$time = date('h:i:sa');
		$name_file = "siswa-" . $date . "-" . $time . ".xlsx";
		return Excel::download(new SiswaExport, $name_file);
	}
	public function alumni_export()
	{
		$date = date('d-m-Y');
		$time = date('h:i:sa');
		$name_file = "alumni-" . $date . "-" . $time . ".xlsx";
		return Excel::download(new AlumniExport, $name_file);
	}
	public function export_pemasukan()
	{
		$date = date('d-m-Y');
		$time = date('h:i:sa');
		$name_file = "pemasukan-" . $date . "-" . $time . ".xlsx";
		return Excel::download(new PemasukanExport, $name_file);
	}
}
