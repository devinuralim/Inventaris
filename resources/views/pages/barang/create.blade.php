@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Barang</h2>

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan</label>
            <input type="text" name="harga_satuan" class="form-control" id="harga_satuan" value="{{ old('harga_satuan') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    // Format angka otomatis saat diketik (titik ribuan)
    document.getElementById('harga_satuan').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\./g, ''); // hilangkan semua titik
        value = value.replace(/\D/g, ''); // hilangkan huruf/karakter selain angka
        e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // tambahkan titik ribuan
    });
</script>
@endsection
