<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
   protected $table = 'umkms'; // Specify the actual table name

    // Optionally define fillable attributes if you're using mass assignment
       protected $fillable = [
        'no_umkm', 'nama_pemilik', 'nama_umkm', 'nama_produk', 'tipe_binaan', 'alamat',
        'desa', 'kecamatan', 'kota', 'status', 'image', 'no_wa', 'email', 'instagram',
        'facebook', 'created_at', 'updated_at', 'bpom', 'pirt', 'google_map', 'tokopedia',
        'shopee', 'bukalapak', 'website', 'video', 'sertifikat_halal', 'produkdesa',
        'user_id', 'dosen', 'cities_id', 'status_date'
    ];
}
