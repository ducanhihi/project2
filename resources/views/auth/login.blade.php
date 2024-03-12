<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/css/bootstrap.min.css')}}">
    <style>
        /*.gradient-custom {*/
        /*    !* fallback for old browsers *!*/
        /*    background: #6a11cb;*/

        /*    !* Chrome 10-25, Safari 5.1-6 *!*/
        /*    background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));*/

        /*    !* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ *!*/
        /*    background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));*/
        /*}*/
        body {
            background-image: url('{{ asset('backgroud.jpeg') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
<form method="post">
    @csrf

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg" placeholder="Email address" />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Password" />
                                </div>
                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                            </div>

                            <div>
                                <p class="mb-0">Don't have an account? <a href="{{route('register')}}" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</form>
</body>
</html>
