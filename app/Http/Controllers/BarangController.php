<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Barang::query();

        //Search, filter berdasarkan nama barang
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        //kategori, filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
        $query->where('kategori', $request->kategori);
        }

        //urutkan berdasarkan waktu terbaru
        $query->orderBy('created_at', 'desc');

        //paginate menampilkan 10 barang
        $barang = $query->paginate(10);
        $kategoriList = Barang::select('kategori')->distinct()->pluck('kategori');

        return view('pages.barang.index', compact('barang', 'kategoriList'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|string',
        ]);

        //menghapus karakter selain angka dan harga
        $hargaBersih = preg_replace('/[^0-9]/', '', $validated['harga_satuan']);

        //simpan ke database
        Barang::create([
            'nama_barang' => $validated['nama_barang'],
            'kategori' => $validated['kategori'],
            'jumlah' => $validated['jumlah'],
            'harga_satuan' => $hargaBersih,
        ]);
        
        //kembali ke halaman daftar barang dengan pesan
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail barang
     */
    public function show(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('pages.barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('pages.barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'kategori' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'harga_satuan' => 'required|string',
        ]);
        $hargaBersih = preg_replace('/[^0-9]/', '', $request->harga_satuan);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $hargaBersih,
        ]);


        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Menghapus data barang
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus.');
    }
}
