<script src="{{url('public/assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/assets/fontawesome/js/all.js')}}"></script>

<!--  Google Maps Plugin    -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
<!-- Chartist JS -->
<!-- Plugin for the momentJs  -->
<script src="{{url('public/assets/js/plugins/moment.min.js')}}"></script>

<!--  Plugin for Sweet Alert -->
<script src="{{url('public/assets/js/plugins/sweetalert2.min.js')}}"></script>

<!-- Forms Validations Plugin -->
<script src="{{url('public/assets/js/plugins/jquery.validate.min.js')}}"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{url('public/assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>

<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{url('public/assets/js/plugins/bootstrap-selectpicker.js')}}"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{url('public/assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{url('public/assets/js/plugins/jquery.datatables.min.js')}}"></script>

<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{url('public/assets/js/plugins/bootstrap-tagsinput.js')}}"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{url('public/assets/js/plugins/jasny-bootstrap.min.js')}}"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{url('public/assets/js/plugins/fullcalendar.min.js')}}"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{url('public/assets/js/plugins/jquery-jvectormap.js')}}"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{url('public/assets/js/plugins/nouislider.min.js')}}"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!-- Library for adding dinamically elements -->
<script src="{{url('public/assets/js/plugins/arrive.min.js')}}"></script>
<script src="{{url('public/assets/js/plugins/autoNumeric.js')}}"></script>

<!--  Google Maps Plugin    -->
<!-- <script  src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

<!-- Chartist JS -->
<script src="{{url('public/assets/js/plugins/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{url('public/assets/js/plugins/bootstrap-notify.js')}}"></script>

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{url('public/assets/js/material-dashboard.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{url('public/assets/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/assets/date_picker_range/daterangepicker.js')}}"></script>
<script src="{{url('public/assets/js/plugins/jquery.md5.js')}}"></script>
<script src="{{url('public/assets/js/input-rupiah.js')}}" type="text/javascript"></script>
<script src="{{url('public/assets/js/custom.js')}}" type="text/javascript"></script>
<script src="{{url('public/assets/plugin/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    $(".numeric").autoNumeric('init', {
        aPad: false,
        aDec: ',',
        aSep: '.'
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>