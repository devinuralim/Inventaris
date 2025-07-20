@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Barang</h2>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $barang->nama_barang }}</h5>
            <p class="card-text"><strong>Kategori:</strong> {{ $barang->kategori }}</p>
            <p class="card-text"><strong>Jumlah:</strong> {{ $barang->jumlah }}</p>
            <p class="card-text"><strong>Harga Satuan:</strong> Rp{{ number_format($barang->harga_satuan, 0, ',', '.') }}</p>
        </div>
    </div>

    <a href="{{ route('barang.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
