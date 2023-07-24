<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileKriteriaLainnya extends Model
{
    use HasFactory;
    protected $table = 'file_kriteria_lainnyas';
    protected $guarded = [];

    public function usulan()
    {
        return $this->belongsTo(SuratUsulan::class, 'usulans_id', 'id');
    }
}
