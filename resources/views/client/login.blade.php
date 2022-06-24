<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Flexy lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Flexy admin lite design, Flexy admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Flexy Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Flexy Admin Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('public/client')}}/assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="{{url('public/client')}}/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="{{url('public/client')}}/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url('public/client')}}/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <form action="{{url('auth-siswa')}}" method="post">
        @csrf
        <div class="p-5 mt-4">
            <div class="row justify-content-center">
                <div class="col col-md-10">
                    <div class="card overflow-hidden">
                        <div class="row">
                            <div class="col-1 col-md-7 overflow-hidden">
                                <img src="{{url('public/image/gedung-sekolah.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="p-4">
                                    <div class="border-bottom mb-4">
                                        <div class="text-center mb-3">
                                            <img style="width: 15%" class=""
                                                src="{{url('/')}}/public/assets/img/logo_sekolah.png"
                                                alt="Generic placeholder image">
                                        </div>
                                        <h3>Silahkan Masuk</h3>
                                        <p><small>untuk lanjut berselancar di Sistem Informasi Akademik</small></p>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="">No Induk Siswa</label>
                                        <input type="text" name="no_induk" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-2">Masuk</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <script type="text/javascript" src="{{url('public/client')}}/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script type="text/javascript" src="{{url('public/client')}}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="{{url('public/client')}}/dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="{{url('public/client')}}/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{url('public/client')}}/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{url('public/client')}}/dist/js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="{{url('public/client')}}/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="{{url('public/client')}}/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js">
    </script>
    <script src="{{url('public/client')}}/dist/js/pages/dashboards/dashboard1.js"></script>
</body>

</html>
