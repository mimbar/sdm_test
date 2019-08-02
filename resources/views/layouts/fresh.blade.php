
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Siliwangi Integrated System - Sintesys - Universitas Siliwangi</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('assets/batagor/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/ui/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/particle/particles.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/notifications/noty.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('assets/batagor/js/app.js') }}"></script>
    <!-- /theme JS files -->

    <style>
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: #08784c; /* this was my color */
            left: 0px;
            top: 0px;
        }
    </style>

</head>

<body>

<!-- Page content -->
<div class="page-content" style="z-index : 99999;">
    <div class="content-wrapper">
        <div class="content d-flex justify-content-center align-items-center" >
            <form class="login-form" method="post" action="{{ route('auth.login') }}">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class=""><img style="width:90px; height: auto; padding-bottom: 9px" src="../../assets/batagor/global_assets/images/logo_unsil.png"/></div>
                            <h5 class="content-group">Selamat datang, {{ $user->name }}<br>
                                <small class="display-block">Untuk menggunakan sistem ini, silakan ganti password anda karena anda memiliki password default.</small>
                            </h5>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" class="form-control" name="password1" placeholder="Password">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" class="form-control" name="password2" placeholder="Password">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Masuk <i class="icon-circle-right2 ml-2"></i></button>
                        </div>

                        <div class="text-center">
                            <a href="#">Saya Lupa Password 😿</a>
                        </div>
                        {{ csrf_field() }}
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<div id="particles-js"></div>

<script>
    particlesJS.load('particles-js', '../../assets/batagor/global_assets/js/plugins/particle/particlesjs-config.json');

    @if(session('loginStatus')['code'] === 404)
    new Noty({
        theme: ' alert bg-danger text-white alert-styled-left p-0',
        text: 'Username atau Password salah.',
        type: 'error',
        progressBar: true,
    }).show();
    @elseif(session('loginStatus')['code'] === 500)
    new Noty({
        theme: ' alert bg-danger text-white alert-styled-left p-0',
        text: "{!! session('loginStatus')['message'] !!}",
        type: 'danger',
        progressBar: true,
    }).show();
    @elseif(session('loginStatus')['code'] === 401)
    new Noty({
        theme: ' alert bg-danger text-white alert-styled-left p-0',
        text: "{!! session('loginStatus')['message'] !!}",
        type: 'danger',
        progressBar: true,
    }).show();
    @endif
</script>
</body>
</html>
