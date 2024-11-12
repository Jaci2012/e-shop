<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dash/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('dash/assets/img/favicon.png') }}">
    <title>Login</title>
    <!-- CSS and Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" />
    <link href="{{ asset('dash/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('dash/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/assets/css/material-dashboard.css?v=3.1.0') }}" />
    <style>
        .input-group {
            position: relative;
        }
        .form-label {
            transition: all 0.2s ease;
        }
        .form-control:not(:placeholder-shown) + .form-label {
            transform: translateY(-20px);
            font-size: 12px;
            color: #3f51b5; /* Change this color as needed */
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
        }
    </style>
</head>

<body class="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Login</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form role="form" class="text-start" method="POST" action="{{ route('login.store') }}">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder=" " />
                                        <label class="form-label">Email</label>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="password" class="form-control" id="password" name="password" required placeholder=" " />
                                        <label class="form-label">Mot de passe</label>
                                        <button type="button" class="toggle-password" id="togglePassword">
                                            <i class="fa fa-eye" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Login</button>
                                    </div>
                                    <p>Pas encore inscrit ? <a href="{{ route('register') }}">Inscrivez-vous ici</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('dash/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('dash/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dash/assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
