<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanSuratUsulan extends Model
{
    use HasFactory;

    protected $table = 'tagihan_surat_usulan';

    protected $fillable = ['usulans_id', 'surat_tagihan_id','nomor','tgl','dokumen'];

    public function surattagihan()
    {
        return $this->belongsTo(SuratTagihan::class, 'surat_tagihan_id', 'id');
    }
}
