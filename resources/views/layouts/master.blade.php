<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckIn GO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">CheckIn GO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Beranda</a>
                    </li>

                    @if (auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="">Profil</a>
                    </li>

                    @if (auth()->user()->role_id == 1)
                    <li class="nav-item dropdown">
                        <!-- <a class="nav-link" aria-current="page" href="{{ route('kelas.index') }}">Kelas</a> -->
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Daftar Pengguna
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="">Tenaga Kependidikan</a></li>
                            <li><a class="dropdown-item" href="">Guru</a></li>
                            <li><a class="dropdown-item" href="{{ route('orangtua.create') }}">Orang Tua</a></li>
                            <li><a class="dropdown-item" href="{{ route('siswa.create') }}">Siswa</a></li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="">Pengguna</a>
                    </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Presensi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(auth()->user()->role_id == 5)
                            <li><a class="dropdown-item" href="{{ route('presensi.create') }}">Lakukan Presensi</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('presensi.index') }}">Daftar Presensi</a></li>
                            <li><a class="dropdown-item" href="{{ route('presensi.history') }}">Riwayat Presensi</a></li>
                        </ul>
                    </li>

                    @if (auth()->user()->role_id == 4 || auth()->user()->role_id == 5)
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="">Notifikasi</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('auth.logout') }}">Keluar</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('auth.login') }}">Masuk</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

    @yield('footer')
</body>

</html>