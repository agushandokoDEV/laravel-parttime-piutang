<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usulan()
    {
        return $this->hasMany(SuratUsulan::class, 'users_id', 'id');
    }

    public function jenisPiutang()
    {
        return $this->belongsTo(JenisPiutang::class, 'id_jenis', 'id');
    }

    public function suratUsulanKNKPL()
    {
        return $this->hasMany(SuratUsulanKNKPL::class, 'users_id', 'id');
    }
}
