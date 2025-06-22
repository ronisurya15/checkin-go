@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
                    <span>Edit Kelas</span>

                    <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="">Jenjang Kelas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="jenjang_kelas" placeholder="Masukkan Jenjang Kelas" required value="{{ $kelas->jenjang_kelas }}">
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Lokasi Ruangan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="lokasi_ruangan" placeholder="Masukkan Ruangan Kelas" required value="{{ $kelas->lokasi_ruangan }}">
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Status <span class="text-danger">*</span></label>
                            <select name="status" id="" class="form-control">
                                <option value="Aktif" {{ ($kelas->status == 'Aktif') ? 'selected' : '' }}>Aktif</option>
                                <option value="Non Aktif" {{ ($kelas->status == 'Non Aktif') ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Tahun Ajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tahun_ajaran" required readonly>
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Wali Kelas <span class="text-danger">*</span></label>
                            <select name="wali_kelas" id="" class="form-control" required>
                                <option value="">-- Pilih Wali Kelas --</option>
                                @foreach ($waliKelas as $item)
                                <option value="{{ $item->id }}" {{ ($item->id == $kelas->waliKelas->guru_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-2 mb-2">
                            <hr>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tahunSekarang = new Date().getFullYear();
        const tahunDepan = tahunSekarang + 1;
        const tahunAjaran = `${tahunSekarang}/${tahunDepan}`;

        const inputTahun = document.querySelector('input[name="tahun_ajaran"]');
        if (inputTahun && !inputTahun.value) {
            inputTahun.value = tahunAjaran;
        }
    });
</script>
@endsection