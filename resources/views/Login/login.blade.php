<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<form action="/login" method="POST">
    @csrf
    <div class="container-fluid vh-100">
        <div class="row h-100 align-items-center justify-content-center">

            <!-- KIRI (Hilang di mobile) -->
            <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                <h1 class="signin fw-bold text-white display-4 ">SIGN IN</h1>
            </div>

            <!-- KANAN -->
            <div class="col-11 col-sm-8 col-md-6 col-lg-4">
                <div class="card-custom">
                    <h2 class="bantuhrd fw-bold">BANTU HRD</h2>

                    <label for="username">Username</label>
                    <input type="text" class="form-control mb-3" placeholder="username" name="username">

                    <label for="password">Password</label>
                    <input type="password" class="form-control mb-3" placeholder="password" name="password">

                    <button class="btn btn-light w-100 mb-3">Login</button>
                    <br>
                                        @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <hr>
                    <p class="pwlupa">Password Lupa? Hubungi Admin</p>
                </div>
            </div>

        </div>
    </div>
</form>
</body>

</html>