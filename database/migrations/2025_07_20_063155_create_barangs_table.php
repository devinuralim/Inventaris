<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama_barang'); 
            $table->string('kategori'); 
            $table->integer('jumlah'); 
            $table->decimal('harga_satuan', 12, 2); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
