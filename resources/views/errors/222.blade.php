<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title>Error Koneksi</title>
</head>
<style type="text/css">
	.error{
		text-align: center;
		display: flex;
		width: 100%;
	}
	img{
		width: 100%;
	}
</style>
<body>
	<div class="error">
		<img src="{{url('image/error_phone.svg')}}">
	</div>
</body>
</html>