<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>404 | Dai-ichi life</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Design by Thang Developer" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div class="authentication-bg d-flex align-items-center pb-0 vh-100">
            <div class="content-center w-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 ms-auto">
                                            <div class="ex-page-content">
                                                <h1 class="text-dark display-1 mt-4">404!</h1>
                                                <h4 class="mb-4">Sorry, page not found</h4>
                                                <p class="mb-5">It will be as simple as Occidental in fact, it will be Occidental to an English person</p>
                                                <a class="btn btn-primary mb-5 waves-effect waves-light" href="{{ route('route_BackEnd_Dashboard') }}"><i class="mdi mdi-home"></i> Back to Dashboard</a>
                                            </div>
                                
                                        </div>
                                        <div class="col-lg-5 mx-auto">
                                            <img src="{{ asset('admin/assets/images/error.png') }}" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                </div><!-- end cardbody -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!--end row-->
                </div>
                <!-- end container -->
            </div>

        </div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    </body>

</html>