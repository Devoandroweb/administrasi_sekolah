<!doctype html>
<html lang="en">
  <head>
    <title>Hello, world!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- Material Kit CSS -->
    <link href="{{ url('assets/client/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/client/assets/css/now-ui-dashboard.css') }}" rel="stylesheet" />

  </head>
  <style type="text/css">
    body{
      background-image: url('{{ url('image/gedung-sekolah.jpg')  }}');
      
    }
    .card{
      box-shadow: 0px 0px 9999px rgba(0, 0, 0, 0.5);;
    }
  </style>
<body style="padding: 100px;">

    <div style="margin: auto; width: 35%;">
        <div class="card p-4">
        <div class="card-body">
          <form>
            <div class="form-group ">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
           

            <button type="submit" class="btn btn-primary">Masuk</button>
          </form>
        </div>
      </div>
    </div>
      
</body>
  <!--   Core JS Files   -->
  <script src="{{ url('assets/client/assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ url('assets/client/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
  <script src="{{ url('assets/client/assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ url('assets/client/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>

  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ url('assets/client/assets/js/now-ui-dashboard.js') }}" type="text/javascript"></script>
</html>