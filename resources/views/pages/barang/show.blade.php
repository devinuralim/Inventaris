@extends('layouts.app') 
{{-- Meng-extend layout utama dari file layouts.app --}}

@section('content') 
{{-- Memulai bagian konten utama dari halaman --}}

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Judul halaman --}}
            <h2 class="mb-4 text-center">Detail Barang</h2>

            {{-- Card untuk menampilkan detail barang --}}
            <div class="card shadow border-0">
                <div class="card-body">
                    {{-- Menampilkan nama barang sebagai judul card --}}
                    <h4 class="card-title mb-3">{{ $barang->nama_barang }}</h4>

                    {{-- List item detail informasi barang --}}
                    <ul class="list-group list-group-flush">
                        {{-- Kategori barang --}}
                        <li class="list-group-item">
                            <strong>Kategori:</strong>
                            <span class="ms-2">{{ $barang->kategori }}</span>
                        </li>

                        {{-- Jumlah barang --}}
                        <li class="list-group-item">
                            <strong>Jumlah:</strong>
                            <span class="ms-2">{{ $barang->jumlah }}</span>
                        </li>

                        {{-- Harga satuan barang, diformat ke format rupiah --}}
                        <li class="list-group-item">
                            <strong>Harga Satuan:</strong>
                            <span class="ms-2">Rp{{ number_format($barang->harga_satuan, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Tombol kembali ke halaman daftar barang --}}
            <div class="text-center mt-4">
                <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                    &larr; Kembali ke Daftar Barang
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
{{-- Menutup section konten --}}
