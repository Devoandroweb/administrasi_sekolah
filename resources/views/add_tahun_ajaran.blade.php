<!doctype html>
<html lang="en">

<head>
  <title>Login Administrator | SIAKAD</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="{{ url('assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
</head>
<body>
<div class="jumbotron bg-transparent">
	<div class="row">
		<div class="col-xl-4 col-sm-12 m-auto">
			<div class="card m-auto p-4">
				<div class="card-body">
					<div class="row">
						<div class="col text-center">
							<img style="width: 15%" src="{{ url('assets/img/logo_sekolah.png') }}" alt="Generic placeholder image">
							<h4 class="mt-3 mb-0 text-uppercase font-weight-bold">Masukkan Tahun Ajaran</h4>
							<label class="mt-1 mb-0 ">Tentukan Tahun Ajaran terlebih dahulu sebelum menggunakan Aplikasi</label>
							
						</div>
					</div>
					<div class="row mt-4">
						<div class="col">
							
							 <form id="form_tahun_ajaran" action="/tambah_tahun_ajaran" method="POST">
						          @csrf
						            <div class="input-group">
						              <div class="input-group-prepend">
						                <span class="input-group-text">
						                    <i class="material-icons">flight_takeoff</i>
						                </span>
						              </div>
						              <select class="form-control" data-style="btn btn-link" id="tahun_ajaran_awal_select" name="tahun_awal">
						               
						              </select>
						            </div>
						            <div class="input-group">
						              <div class="input-group-prepend">
						                <span class="input-group-text">
						                    <i class="material-icons">flight_land</i>
						                </span>
						              </div>
						              <select class="form-control" data-style="btn btn-link" id="tahun_ajaran_akhir_select" name="tahun_akhir">
						                
						              </select>
						            </div>
								<input type="submit" class="btn btn-success btn-block mt-4" name="btn-simpan" value="Simpan">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

</div>
<script src="{{url('assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	select_picker();
	function select_picker() {
        var html_option_awal = "<option selected>2019</option>";
        var html_option_akhir = "<option selected>2019</option>";
      
        for (var i = 2020; i <= 2050; i++) {
          
              html_option_awal += "<option selected>"+i+"</option>";
          
          
             html_option_akhir += "<option selected>"+i+"</option>";
          
         
        }


        $("#tahun_ajaran_awal_select").html(html_option_awal);
        $("#tahun_ajaran_akhir_select").html(html_option_akhir);
      }
</script>
</body>

</html>