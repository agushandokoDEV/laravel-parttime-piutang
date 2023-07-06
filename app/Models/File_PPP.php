<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_PPP extends Model
{
    use HasFactory;
    protected $table = 'file__ppps';
    protected $fillable = ['docs_ST', 'usulans_id'];

    public function usulan()
    {
        return $this->belongsTo(SuratUsulan::class, 'usulans_id', 'id');
    }
}
