<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    // Photo.php
protected $fillable = [
    'photos',
    'description',
    'umkm_id',
    'sertifikathalal_id',
];


    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }
}
