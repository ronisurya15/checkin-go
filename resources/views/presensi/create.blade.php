@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
                    <span>Lakukan Presensi</span>

                    <a href="{{ route('presensi.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                </div>

                <div class="card-body">
                    @if (isset($checkExistsData) && $checkExistsData->waktu_keluar)
                    <div class="alert alert-info">Anda sudah melakukan presensi hari ini.</div>
                    @else
                    <form action="{{ route('presensi.store') }}" method="POST">
                        @csrf

                        @if (auth()->user()->role_id == 3)
                        <div class="form-group mt-2">
                            <label for="">Siswa <span class="text-danger">*</span></label>
                            <select name="user_id" id="" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach ($siswa as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Keterangan <span class="text-danger">*</span></label>
                            <br>
                            <input type="radio" name="keterangan" value="Hadir"> Hadir
                            <input type="radio" name="keterangan" value="Izin"> Izin
                            <input type="radio" name="keterangan" value="Sakit"> Sakit
                            <input type="radio" name="keterangan" value="Tanpa Keterangan"> Tanpa Keterangan
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Tanggal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tanggal" id="inputTanggal" required readonly>
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Jam Masuk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="waktu_masuk" id="inputMasuk" readonly>
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Jam Pulang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="waktu_keluar" id="inputKeluar" readonly>
                        </div>

                        <div class="mt-2 mb-2">
                            <hr>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        @else
                        <div class="form-group mt-2">
                            <label for="">Tanggal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tanggal" id="inputTanggal" required readonly>
                        </div>

                        @if (!isset($checkExistsData))
                        <div class="form-group mt-2">
                            <label for="">Jam Masuk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="waktu_masuk" id="inputMasuk" readonly>
                        </div>

                        <div class="mt-2 mb-2">
                            <hr>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Check In</button>

                        @elseif (isset($checkExistsData) && !$checkExistsData->waktu_keluar)
                        <input type="hidden" name="waktu_masuk" value="{{ $checkExistsData->waktu_masuk }}">

                        <div class="form-group mt-2">
                            <label for="">Jam Pulang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="waktu_keluar" id="inputKeluar" readonly>
                        </div>

                        <div class="mt-2 mb-2">
                            <hr>
                        </div>

                        <button type="submit" class="btn btn-sm btn-warning">Check Out</button>
                        @endif
                        @endif
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Set tanggal hari ini
        const inputTanggal = document.getElementById('inputTanggal');
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD
        inputTanggal.value = formattedDate;

        // Realtime waktu masuk & keluar
        const inputMasuk = document.getElementById('inputMasuk');
        const inputKeluar = document.getElementById('inputKeluar');

        function updateWaktu() {
            const now = new Date();
            const jam = now.getHours().toString().padStart(2, '0');
            const menit = now.getMinutes().toString().padStart(2, '0');
            const detik = now.getSeconds().toString().padStart(2, '0');

            const waktu = `${jam}:${menit}:${detik}`;

            if (inputMasuk) {
                inputMasuk.value = waktu;
            }

            if (inputKeluar) {
                inputKeluar.value = waktu;
            }
        }

        // Jalankan pertama kali
        updateWaktu();

        // Update setiap detik
        setInterval(updateWaktu, 1000);
    });
</script>

@endsection