<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberitahuan extends Model
{
    use HasFactory;
    protected $table = 'pemberitahuans';
    protected $guarded = [];

    public function usulan()
    {
        return $this->belongsTo(SuratUsulan::class, 'usulans_id', 'id');
    }
}
