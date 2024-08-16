<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkms';  // Keep this if your table name is not 'umkms'

    protected $fillable = [
        'no_umkm', 'nama_pemilik', 'nama_umkm', 'nama_produk', 'tipe_binaan', 'alamat',
        'desa', 'kecamatan', 'kota', 'status', 'image', 'no_wa', 'email', 'instagram',
        'facebook', 'bpom', 'pirt', 'google_map', 'tokopedia', 'shopee', 'bukalapak',
        'website', 'video', 'sertifikat_halal', 'produkdesa', 'user_id', 'dosen',
        'cities_id', 'status_date', 'latitude', 'longitude', 'plus_code', 'google_maps', 'id',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function umkms()
{
    return $this->hasMany(Umkm::class, 'user_id');
}

   public function photos()
    {
        return $this->hasMany(Photo::class, 'umkm_id');
    }
    // Timestamps are managed automatically, so no need to include them in $fillable
}
