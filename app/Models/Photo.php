<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    // Photo.php
protected $fillable = [
    'photo',
    'description',
    'umkm_id', // Make sure this is included
];


    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }
}
