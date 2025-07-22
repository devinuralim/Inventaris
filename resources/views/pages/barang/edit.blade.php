@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h4 class="mb-4 text-center">Edit Data Barang</h4>
                    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                        <!-- Token CSRF sebagai keamanan dari Laravel -->
                        @csrf
                        <!-- Menggunakan method spoofing untuk method PUT -->
                        @method('PUT')

                        <!-- Input untuk Nama Barang -->
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <!-- Mengisi nilai input dengan data lama atau input sebelumnya jika gagal validasi -->
                            <input type="text" name="nama_barang" class="form-control"
                                value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                        </div>

                        <!-- Input untuk Kategori Barang -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-control"
                                value="{{ old('kategori', $barang->kategori) }}" required>
                        </div>

                        <!-- Input untuk Jumlah Barang -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control"
                                value="{{ old('jumlah', $barang->jumlah) }}" required>
                        </div>

                        <!-- Input untuk Harga Satuan Barang -->
                        <div class="mb-3">
                            <label for="harga_satuan" class="form-label">Harga Satuan</label>
                            <!-- Menampilkan harga dengan format ribuan -->
                            <input type="text" name="harga_satuan" class="form-control" id="harga_satuan"
                                value="{{ number_format(old('harga_satuan', $barang->harga_satuan), 0, ',', '.') }}" required>
                        </div>

                        <!-- Tombol Kembali dan Simpan -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">← Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('harga_satuan').addEventListener('input', function (e) {
        // Menghapus titik dan karakter selain angka
        let value = e.target.value.replace(/\./g, '').replace(/[^0-9]/g, '');
        // Format ulang ke ribuan Indonesia jika ada angka
        if (value) {
            e.target.value = new Intl.NumberFormat('id-ID').format(value);
        } else {
            e.target.value = '';
        }
    });
</script>
@endsection
