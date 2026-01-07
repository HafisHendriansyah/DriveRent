<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="rounded p-4 p-sm-5 my-4 mx-3 register-card">
                    <div class="d-flex justify-content-center mb-3 register-logo">
                        <h3>Mendaftar</h3>
                        <a href="index.html" class="driverent-link">
                            <h3 class="text-primary">DriveRent</h3>
                        </a>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        @error('nama_admin')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mb-3">
                            <input type="text" name="nama_admin" class="form-control" id="floatingText"
                                placeholder="Nama" value="{{ @old('nama_admin') }}">
                            <label for="floatingText">Nama</label>
                        </div>
                        @error('email_admin')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mb-3">
                            <input type="text" name="email_admin" class="form-control" id="floatingInput"
                                placeholder="name@example.com" value="{{ @old('email_admin') }}">
                            <label for="floatingInput">Alamat Email</label>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword"
                                placeholder="Password">
                            <label for="floatingPassword">Kata Sandi</label>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Daftar</button>
                        <p class="text-center mb-0">Sudah memiliki akun? <a href="{{ route('login') }}">Masuk</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
