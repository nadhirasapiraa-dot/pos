<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama']; // Boleh diisi kolom 'nama'

    // 1 Kategori punya BANYAK Produk
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
    
    public function up(): void
{
    Schema::create('kategoris', function (Blueprint $table) {
        $table->id();             // ID otomatis (1, 2, 3...)
        $table->string('nama');   // Kolom untuk nama jenis (ex: "Makanan", "Minuman")
        $table->timestamps();     // Kolom created_at & updated_at
    });
}
}
