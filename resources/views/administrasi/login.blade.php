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
	<link href="{{ url('public/assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
</head>

<body>
	<div class="jumbotron bg-transparent">
		<div class="row">
			<div class="col-xl-4 col-sm-12 m-auto">
				<div class="card m-auto p-4">
					<div class="card-body">
						<div class="row">
							<div class="col text-center">
								<img style="width: 15%" src="{{ asset('public/assets/img/logo_sekolah.png') }}" alt="Generic placeholder image">
								<h4 class="mt-3 mb-0 text-uppercase font-weight-bold">Login Administrasi</h4>
								<div class="alert alert-warning d-none {{session('display')}}" role="alert">
									{{session('alert')}}
								</div>
							</div>
						</div>
						<div class="row mt-4">
							<div class="col">

								<form action="{{ url('/aksilogin') }}" method="post">
									@csrf
									<div class="row mb-2">
										<div class="col">

											<div class="input-group">
												<div class="input-group-prepend" style="width: 45px">
													<span class="input-group-text">
														<i class="fa fa-user"></i>
													</span>
												</div>
												<input type="email" name="email" class="form-control" placeholder="Masukkan Email">
											</div>
										</div>
									</div>
									<div class="row mb-2">
										<div class="col">

											<div class="input-group">
												<div class="input-group-prepend" style="width: 45px">
													<span class="input-group-text">
														<i class="fa fa-key"></i>
													</span>
												</div>
												<input type="password" name="password" class="form-control" placeholder="Masukkan Password">
											</div>
										</div>
									</div>
									@if (Session::has('error'))
									<div class="alert alert-danger">
										{{ Session::get('error') }}
									</div>
									@endif
									<input type="submit" class="btn btn-danger btn-block mt-4" name="btn-login" value="Login">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</body>

</html>