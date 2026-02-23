<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $fillable =[
        'kode_kategori',
        'nama_kategori',
        'deskripsi'
    ];

    //ubah route key name dari id menjadi kode_kategori
    // aku tambahkan : string untuk label soalnya kode_kategori itu sifat uniserval
    public function getRouteKeyName(): string {
        return 'kode_kategori';
    }
}
