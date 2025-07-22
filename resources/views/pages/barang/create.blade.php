@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    {{-- Card sebagai wrapper form --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-4 text-center">Tambah Barang</h3>

            {{-- Form tambah barang, method POST menuju route barang.store --}}
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf {{-- Token CSRF untuk keamanan form --}}

                {{-- Input nama barang --}}
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>

                {{-- Input kategori barang --}}
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" required>
                </div>

                {{-- Input jumlah barang --}}
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>

                {{-- Input harga satuan dengan format angka (ribuan) --}}
                <div class="mb-3">
                    <label for="harga_satuan" class="form-label">Harga Satuan</label>
                    <input 
                        type="text" 
                        name="harga_satuan" 
                        class="form-control" 
                        id="harga_satuan" 
                        value="{{ old('harga_satuan') }}" 
                        required
                    >
                </div>

                {{-- Tombol Kembali & Simpan --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Format input harga_satuan agar otomatis jadi format ribuan --}}
<script>
    document.getElementById('harga_satuan').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\./g, '');
        value = value.replace(/\D/g, ''); 
        e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // tambahkan titik setiap 3 digit
    });
</script>
@endsection
