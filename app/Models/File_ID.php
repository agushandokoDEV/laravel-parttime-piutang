<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_ID extends Model
{
    use HasFactory;
    protected $table = 'file__ids';
    protected $fillable = ['usulans_id', 'docs_ID'];

    public function usulan()
    {
        return $this->belongsTo(SuratUsulan::class, 'usulans_id', 'id');
    }
}
