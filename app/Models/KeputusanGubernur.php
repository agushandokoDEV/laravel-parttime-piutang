<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeputusanGubernur extends Model
{
    use HasFactory;
    protected $table = 'keputusan_gubernurs';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'usulans_id'];

    public function usulan()
    {
        return $this->belongsTo(SuratUsulan::class, 'usulans_id', 'id');    
    }

    public static function generateKeputusan()
    {
        $letKnkpl = self::latest()->first();

        if ($letKnkpl) {
            $usulanID = $letKnkpl->id + 1;
        } else {
            $usulanID = 1;
        }

        $knkplCode = 'GBR-' . date('d.m.y') . '/' . str_pad($usulanID, 4, '0', STR_PAD_LEFT);
        return $knkplCode;
    }
}
