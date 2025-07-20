<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        // Total semua barang (jumlah dari kolom 'jumlah')
        $totalBarang = Barang::sum('jumlah');

        // Jumlah data barang (berapa jenis barang)
        $jumlahBarangMasuk = Barang::count();

        return view('pages.dashboard', compact('totalBarang', 'jumlahBarangMasuk'));
    }
}
