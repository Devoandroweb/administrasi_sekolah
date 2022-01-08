<html>
<head>
    <title>Proses Update Tanggungan</title>
	  <meta name="csrf-token" content="{{ csrf_token() }}">

	  <meta charset="utf-8">

	  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

	  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

	  <link href="{{asset('css/material-dashboard.css')}}" rel="stylesheet" />

	  <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet" />
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	
<div style="position: fixed; top: 50%; width: 50%; left: 25%; right: 25%;">
	<div>Sedang Memproses Data ...</div>
	<div class="progress-container">
	    <div class="progress">
	        <div id="progress" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
	        </div>
	    </div>
	</div>
</div>


<script src="{{asset('js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('fontawesome/js/all.js')}}"></script>
<!--  Google Maps Plugin    -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
<!-- Chartist JS -->
<!-- Plugin for the momentJs  -->
  <script src="{{asset('js/plugins/moment.min.js')}}"></script>

  <!--  Plugin for Sweet Alert -->
  <script src="{{asset('js/plugins/sweetalert2.min.js')}}"></script>

  <!-- Forms Validations Plugin -->
  <script src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>

  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{asset('js/plugins/jquery.bootstrap-wizard.js')}}"></script>

  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{asset('js/plugins/bootstrap-selectpicker.js')}}" ></script>

  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{asset('js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="{{asset('js/plugins/jquery.datatables.min.js')}}"></script>

  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{asset('js/plugins/bootstrap-tagsinput.js')}}"></script>

  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{asset('js/plugins/jasny-bootstrap.min.js')}}"></script>

  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{asset('js/plugins/fullcalendar.min.js')}}"></script>

  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{asset('js/plugins/jquery-jvectormap.js')}}"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('js/plugins/nouislider.min.js')}}" ></script>

  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- Library for adding dinamically elements -->
  <script src="{{asset('js/plugins/arrive.min.js')}}"></script>

  <!--  Google Maps Plugin    -->
  <!-- <script  src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

  <!-- Chartist JS -->

  <!--  Notifications Plugin    -->
  <script src="{{asset('js/plugins/bootstrap-notify.js')}}"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('js/material-dashboard.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript" src="{{asset('datatables/datatables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('date_picker_range/daterangepicker.js')}}"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var lebar = 0;
		
			setInterval(function(){ 
				if (lebar <= 100) {
					$('#progress').css('width',lebar + '%');
					lebar = lebar + 10;
				}else if(lebar > 100){
					location.replace('{{ url("tanggungan_lalu") }}');
				}

		 	}, 1000);
		
	});	
</script>
</body>
</html>