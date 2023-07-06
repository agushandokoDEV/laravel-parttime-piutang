<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratUsulanKNKPL extends Model
{
    use HasFactory;
    protected $table = 'surat_usulan_knkpls';
    protected $guarded = [];
    protected $hidden = ['usulans_id', 'created_at', 'updated_at'];

    public function usulans()
    {
        return $this->belongsTo(SuratUsulan::class, 'usulans_id', 'id');    
    }

    public static function generateKnkpl()
    {
        $letKnkpl = self::latest()->first();

        if ($letKnkpl) {
            $usulanID = $letKnkpl->id + 1;
        } else {
            $usulanID = 1;
        }

        $knkplCode = 'KNKPL-' . date('d.m.y') . '/' . str_pad($usulanID, 4, '0', STR_PAD_LEFT);
        return $knkplCode;
    }
}
