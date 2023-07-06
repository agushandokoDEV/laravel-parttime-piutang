<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileSTS extends Model
{
    use HasFactory;
    protected $table = 'file_sts';
    protected $guarded = ['usulans_id', 'docs_STS'];

    public function usulan()
    {
        return $this->belongsTo(SuratUsulan::class, 'usulans_id', 'id');
    }
}
