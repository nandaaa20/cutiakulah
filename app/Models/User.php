<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }

    public function getSisaCutiAttribute()
    {
        $year = now()->year;
        $entitlement = 12;

        $used = $this->cutis()
            ->where('status', 'disetujui')
            ->whereYear('tanggal_mulai', $year)
            ->get()
            ->reduce(function ($carry, $cuti) {
                $start = Carbon::parse($cuti->tanggal_mulai);
                $end = Carbon::parse($cuti->tanggal_selesai);
                return $carry + $start->diffInDays($end) + 1;
            }, 0);

        return max($entitlement - $used, 0);
    }
}
