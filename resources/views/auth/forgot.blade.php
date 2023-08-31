<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('login/css/owl.carousel.min.css') }}">

    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">

    <title>Forgot</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="form-block">
                                <center>
                                    <div class="mb-4">
                                        <img src="{{ asset('img/servvo.png') }}" width="50%" alt="">
                                    </div>
                                </center>
                                <br>
                                <form action="{{ route('forgot.updatepass') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group first">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required>
                                    </div>
                                    <div class="form-group last mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>

                                    </div>
                                    <div class="form-group last mb-4">
                                        <label for="repassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="repassword" name="repassword"
                                            required>

                                    </div>

                                    <div class="d-flex mb-5 align-items-center">
                                        <span class="ml-auto">
                                            <a href="{{ route('login.index') }}" class="forgot-pass">
                                                <i>Back To Log In</i>
                                            </a>
                                        </span>
                                    </div>

                                    <button type="submit" class="btn btn-pill text-white btn-block btn-primary">
                                        Reset Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Sweet Alert -->
    <script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login/js/main.js') }}"></script>
</body>
@if (Session::has('success'))
    <script type="text/javascript">
        swal({
            icon: 'success',
            text: '{{ Session::get('success') }}',
            button: false,
            timer: 1500
        });
    </script>
    <?php
    Session::forget('success');
    ?>
@endif
@if (Session::has('gagal'))
    <script type="text/javascript">
        swal({
            icon: 'error',
            title: '{{ Session::get('gagal') }}',
            button: false,
            text: 'Invalid Credentials!',
            timer: 1500
        });
    </script>
    <?php
    Session::forget('gagal');
    ?>
@endif

</html>
