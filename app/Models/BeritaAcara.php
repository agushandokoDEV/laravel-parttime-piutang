<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;
    protected $table = 'berita_acaras';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'users_id'];

    public function user() 
    {
        return $this->belongsTo(User::class, 'users_id', 'id');    
    }
}
