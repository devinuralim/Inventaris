@extends('layouts.app')
{{-- Menggunakan layout utama dari resources/views/layouts/app.blade.php --}}

@section('content')
<div class="container-fluid">
    
    <!-- Judul Halaman -->
    <h1 class="h3 mb-4 text-gray-800">Ringkasan Inventaris Barang</h1>

    <div class="row">
        <!-- Kartu: Total Stok Barang -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            {{-- Label dan nilai total stok barang --}}
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Stok Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stokTotal }}</div>
                        </div>
                        <div class="col-auto">
                            {{-- Ikon stok --}}
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu: Jumlah Kategori -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            {{-- Label dan nilai jumlah kategori --}}
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahJenisKategori }}</div>
                        </div>
                        <div class="col-auto">
                            {{-- Ikon kategori --}}
                            <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu: Jenis Barang -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            {{-- Label dan nilai jenis barang --}}
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jenis Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jenisBarang }}</div>
                        </div>
                        <div class="col-auto">
                            {{-- Ikon jenis --}}
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Grafik -->
    <div class="row">
        <!-- Bar Chart: Stok per Kategori -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Stok Barang per Kategori</h6>
                </div>
                <div class="card-body">
                    {{-- Canvas untuk bar chart --}}
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart: Jenis Barang per Kategori -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jenis Barang per Kategori</h6>
                </div>
                <div class="card-body">
                    {{-- Canvas untuk pie chart --}}
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    {{-- Data untuk Bar Chart --}}
    const barLabels = @json($dataBarChart->pluck('kategori'));  // Label kategori
    const barData = @json($dataBarChart->pluck('total_stok'));  // Jumlah stok per kategori

    {{-- Warna random untuk masing-masing bar --}}
    const barColors = barLabels.map(() => {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.7)`;
    });

    {{-- Inisialisasi Bar Chart --}}
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: barLabels,
            datasets: [{
                label: 'Stok',
                data: barData,
                backgroundColor: barColors,
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });

    {{-- Data untuk Pie Chart --}}
    const kategoriList = @json($kategoriList); // key = kategori, value = jumlah jenis
    const pieLabels = Object.keys(kategoriList);
    const pieData = Object.values(kategoriList);

    {{-- Warna random untuk pie chart --}}
    const pieColors = pieLabels.map(() => {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.7)`;
    });

    {{-- Inisialisasi Pie Chart --}}
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: pieLabels,
            datasets: [{
                label: 'Jumlah Jenis Barang',
                data: pieData,
                backgroundColor: pieColors,
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
