@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <!-- Kartu Jumlah Barang Masuk -->
        <div class="col-md-6 mb-3">
            <div class="card border-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Barang Masuk</h5>
                    <p class="card-text display-6">{{ $jumlahBarangMasuk }}</p>
                </div>
            </div>
        </div>

        <!-- Kartu Total Barang -->
        <div class="col-md-6 mb-3">
            <div class="card border-success shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Seluruh Barang</h5>
                    <p class="card-text display-6">{{ $totalBarang }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
