<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'umkm_id',
        'opened_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'opened_at' => 'datetime', // This line ensures opened_at is a Carbon instance
    ];

    /**
     * Get the user that owns the history entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the UMKM that was opened.
     */
    public function umkm()
    {
        return $this->belongsTo(Umkm::class); // Assuming your UMKM model is named 'Umkm'
    }
}
