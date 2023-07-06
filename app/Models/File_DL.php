<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_DL extends Model
{
    use HasFactory;
    protected $table = 'file__dls';
    protected $fillable = ['docs_DL', 'usulans_id'];

    public function usulan()
    {
        return $this->belongsTo(SuratUsulan::class, 'usulans_id', 'id');
    }
}
