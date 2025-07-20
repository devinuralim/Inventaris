@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $barang->kategori) }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $barang->jumlah) }}" required>
        </div>

        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan</label>
            <input type="text" name="harga_satuan" class="form-control" id="harga_satuan" value="{{ number_format(old('harga_satuan', $barang->harga_satuan), 0, ',', '.') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    document.getElementById('harga_satuan').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\./g, '').replace(/[^0-9]/g, '');
        if (value) {
            e.target.value = new Intl.NumberFormat('id-ID').format(value);
        } else {
            e.target.value = '';
        }
    });
</script>
@endsection
