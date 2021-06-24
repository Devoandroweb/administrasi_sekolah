<!DOCTYPE html>
<html>
<head>
	<title>Cetak Siswa</title>
	 <meta name="csrf-token" content="{{ csrf_token() }}">
	  <meta charset="utf-8">
	  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	  <!--     Fonts and icons     -->
	<!--   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
	  <!-- Material Kit CSS -->
	  <link href="{{asset('css/material-dashboard.css')}}" rel="stylesheet" />
	  <link href="{{asset('css/sweetalert2.min.css')}}" rel="stylesheet" />
	  <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet" />
	  <link rel="stylesheet" type="text/css" href="{{asset('datatables/datatables.min.css')}}"/>
</head>
<style type="text/css">
	.menu-top{
		background: #e1e1e1;
		overflow:hidden; 
		border-bottom: 1px solid #a6a3a3;
		position: fixed;
		width: 100%;
		top: 0;
		z-index: 99999;

	}
	.menu-top button{
		border: none;
		margin-left: 5px;
		background: transparent;
	}
	.menu-top button:hover{
		background: grey;
	}
	@font-face{
		src : url('{{ url("assets/font/monaco.ttf") }}');
		font-family: 'monaco';
	}
	.monaco{
		font-family: monaco;
	}
	.page{
		padding-left: 40px; 
		padding-right: 40px; 
		margin-bottom: 40px; 
		height: 297mm; 
		width: 210mm; 
		box-shadow: 0px 5px 2px; 
		background: white;
		margin-top: 45px; 
		border: 0.1rem solid #d2d2d2;
	}
	p{
		font-size: 15pt;
	}
	@media print{

		.menu-top{
			display: none;
		}
		.container{
			
		}
		.page{
			padding-left: 0;
			padding-right: 0;
			margin-top:0;
			width: 100% !important;
			border:none;
			box-shadow: none;
		}
		body{
			background: white;
		}
		@page {
			size: portrait;
			margin:0;
		}
		.font-12pt{
			font-size: 12pt;
		}
	}
	
</style>
<body>
<div class="pl-4 pr-4 pt-1 pb-1 menu-top mx-auto mb-4">
	<span class="float-left d-flex align-items-center">
		<small class="mr-4">
			<i class="fa fa-graduation-cap fa-1x mr-2"></i> Fathur Rosidin
		</small>
		<small class="mr-4">
			<i class="fab fa-odnoklassniki fa-1x mr-2"></i> 12 IPA
		</small>
		<small>
			<i class="fas fa-thermometer-empty fa-1x mr-2"></i> Siswa Aktif
		</small>
	</span>
	<span class="float-left d-flex align-items-center w-100 position-absolute" style="right: 40%">
		<small class="ml-auto">
			Tahun Ajaran : 2010 - 2020
		</small>
	</span>
	<span class="float-right d-flex align-items-center" style="word-spacing: 4px;">
		<button type="button" class="cetak"><i class="fa fa-print fa-1x"></i> <SMALL class="ml-2">Cetak</SMALL></button>
	</span>
	
</div>


<div class="container page pt-2" style="">
	<div class="row">
		<div class="col d-flex align-items-center">
			<span class="w-25  d-block text-center">
				<img src="{{ asset('img/logo_sekolah.png') }}" style="width: 60%;">
			</span>
			<span class="w-75 d-block text-center " style="line-height: 15px;">
				<h5 class="text-uppercase mb-1 font-weight-bold">Yayasan Pedidikan Al-hikmah</h5>
				<h3 class="text-uppercase mb-0 mt-0 font-weight-bold " style="font-family: Times New Roman; display: contents;">SMA Islam " AL-Hikmah " Bululawang</h3>
				<h6 class="text-uppercase mb-0">Terakreditasi A</h6>
				<table style="width: 55%; margin:auto; font-size: 10pt;" class="font-weight-bold">
					<tr>
						<td>NPSN : 20517814 </td>
						<td>NSS : 304051813067 </td>
					</tr>
				</table>
				<table style="width: 70%; margin:auto; font-size: 10pt;" class="font-weight-bold">
					<tr>
						<td>SK NOMOR : Ma. 007945 </td>
						<td>TANGGAL : 30 OKTOBER 2010 </td>
					</tr>
				</table>
				<small style="font-family: Times New Roman;">Email : smaial_hikmah@yahoo.com</small><br>
				<small style="font-family: Times New Roman;">Alamat : Jl. Raya Tanjungsari 150 PO BOX 02 Kuwolu Bululawang Malang [65171] <i class="fas fa-phone-square"></i> (0341) 8221185</small>
			</span>
		</div>
	</div>
	<hr style="border: 1px solid black;">
	<div class="container ml-4 mr-4" style="width: 100%">
		<h4 class="text-center font-weight-bold font-12pt" style=" margin-top: 40px; margin-bottom: 30px">TANGGUNGAN BIAYA SEKOLAH</h4>
		<p>Dengan ini kami beritahukan tanggungan biaya putra-putri bapak/ibu wali murid yang harus segera dilunasi sebagai berikut :</p>
		<table class="font-weight-bold mb-2 font-12pt">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>{{ $data->nama }}</td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td>{{ $data->kelas." ".$data->rombel }}</td>
			</tr>
		</table>
		<table style="width: 90%;">
			<tr>
				<td class="text-center">1</td>
				<td>SPP</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">{{ $data->spp }}</td>
			</tr>
			<tr>
				<td class="text-center">2</td>
				<td>PSB</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">{{ $data->psb }}</td>
			</tr>
			<tr>
				<td class="text-center">3</td>
				<td>LKS Semester 1</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">{{ $data->lks_1 }}</td>
			</tr>
			<tr>
				<td class="text-center">4</td>
				<td>LKS Semester 2</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">{{ $data->lks_2 }}</td>
			</tr>
			<tr>
				<td class="text-center">5</td>
				<td>UTS 1</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">{{ $data->uts_1 }}</td>
			</tr>
			<tr>
				<td class="text-center">6</td>
				<td>UTS 2</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">{{ $data->uts_2 }}</td>
			</tr>
			<tr>
				<td class="text-center">7</td>
				<td>PAS 1</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">{{ $data->pas_1 }}</td>
			</tr>
			<tr>
				<td class="text-center">8</td>
				<td>PAS 2</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">{{ $data->pas_2 }}</td>
			</tr>
			<tr>
				<td class="text-center">9</td>
				<td>UNAS</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">{{ $data->spp }}</td>
			</tr>
			<tr>
				<td class="text-center">10</td>
				<td>Study Tour</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">0</td>
			</tr>
			<tr>
				<td class="text-center">11</td>
				<td>Tanggungan Kelas X</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">0</td>
			</tr>
			<tr>
				<td class="text-center">12</td>
				<td>Tanggungan Kelas XI</td>
				<td>:</td>
				<td class="monaco">Rp.</td>
				<td class="text-right monaco numeric">0</td>
			</tr>
			<tr class="font-weight-bold">
				<td class="pt-2"></td>
				<td class="pt-2">JUMLAH</td>
				<td class="pt-2">:</td>
				<td class="pt-2 monaco" style="border-top: 2px solid black;">Rp.</td>
				<td class="text-right pt-2 monaco numeric" style="border-top: 2px solid black; font-size: 15pt;">{{$total}}</td>
			</tr>
		</table>
		<p  style="margin-left: 3rem; margin-top: 10rem;">Mengetahui,</p>
		<div class="row" style="line-height: 1rem;  margin-left: 2rem;">
			<div class="col">
				<p>Kepala Sekolah</p>
				<br>
				<br>
				<br>
				<br>
				<br>
				<b><u>H. NUR HAMIM, SE</u></b>
			</div>
			<div class="col">
				<p>Bendahara</p>
				<br>
				<br>
				<br>
				<br>
				<br>
				<b><u>H. ABDUL SOLIKIN, SE</u></b>
			</div>
		</div>
	</div>
</div>
<div id="editor"></div>
<script src="{{asset('js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('js/plugins/autoNumeric.js')}}"></script>
<script type="text/javascript" src="{{asset('fontawesome/js/all.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.cetak').click(function(event) {
			window.print();
		});
		$('.pdf').click(function(event) {
			/* Act on the event */
			var id = 1;
			$.ajax({
				url: '/cetak_siswa_pdf/'+id,
				type: 'GET',
				dataType: 'JSON',
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	
		
        $('.numeric').autoNumeric('init',{aPad:false});
 });

</script>
</body>
</html>