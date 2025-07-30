<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti'; // Sesuaikan jika nama tabel berbeda
    protected $fillable = [
        'user_id',
        'status',
        'catatan',
        'tanggal_mulai',
        'tanggal_selesai',
        // tambahkan kolom lain sesuai kebutuhan
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}