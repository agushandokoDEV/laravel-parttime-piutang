<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;
    protected $table = 'piutangs';
    protected $guarded = [];
    protected $hidden = ['users_id', 'id_jenis', 'created_at', 'updated_at'];

    function jenisPiutang() {
        return $this->belongsTo(JenisPiutang::class, 'id_jenis', 'id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');    
    }

    function suratUsulan()
    {
        return $this->hasMany(SuratUsulan::class, 'piutangs_id', 'id');    
    }

    function keputusan()
    {
        return $this->hasMany(KeputusanGubernur::class, 'piutangs_id', 'id');    
    }
}
