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
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }
        if ($request->has('kategori') && $request->kategori != '') {
        $query->where('kategori', $request->kategori);
        }

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
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|string',
        ]);

        $hargaBersih = preg_replace('/[^0-9]/', '', $validated['harga_satuan']);

        Barang::create([
            'nama_barang' => $validated['nama_barang'],
            'kategori' => $validated['kategori'],
            'jumlah' => $validated['jumlah'],
            'harga_satuan' => $hargaBersih,
        ]);
        
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
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
            'jumlah' => 'required|integer',
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus.');
    }
}
