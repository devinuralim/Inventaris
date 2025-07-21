<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total stok semua barang
        $stokTotal = Barang::sum('jumlah');

        // Jumlah jenis kategori
        $jumlahJenisKategori = DB::table('barangs')
        ->select(DB::raw('LOWER(TRIM(kategori)) as kategori'))
        ->distinct()
        ->count('kategori');

        // Jumlah jenis barang berdasarkan nama
        $jenisBarang = Barang::select('nama_barang')->distinct()->count();

        // Data untuk Bar Chart (total stok per kategori)
        $dataBarChart = Barang::select('kategori', DB::raw('SUM(jumlah) as total_stok'))
            ->groupBy('kategori')
            ->get();

        // Data untuk Pie Chart (jumlah jenis per kategori)
        $kategoriList = Barang::select('kategori', DB::raw('COUNT(*) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        // Return ke view
        return view('pages.dashboard', compact(
            'stokTotal',
            'jumlahJenisKategori',
            'jenisBarang',
            'dataBarChart',
            'kategoriList'
        ));
    }
}
