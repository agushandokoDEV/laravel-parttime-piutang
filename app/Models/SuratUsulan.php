<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratUsulan extends Model
{
    use HasFactory;
    protected $table = 'surat_usulans';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'rincian_perihal' => 'array',
    ];

    // public function getRincianPerihalAttribute($value)
    // {
    //     return json_decode($value);
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function jenisPiutang()
    {
        return $this->belongsTo(JenisPiutang::class, 'id_jenis', 'id');
    }

    public function usulanKnkpl()
    {
        return $this->hasMany(SuratUsulanKNKPL::class, 'usulans_id', 'id');
    }

    public function balasanKnkpl()
    {
        return $this->hasMany(SuratBalasanKNKPL::class, 'usulans_id', 'id');
    }

    public function keputusan()
    {
        return $this->hasMany(KeputusanGubernur::class, 'usulans_id', 'id');
    }

    public function beritaAcara()
    {
        return $this->hasMany(BeritaAcara::class, 'usulans_id', 'id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'usulans_id', 'id');
    }

    public function file()
    {
        return $this->hasMany(FileSTS::class, 'usulans_id', 'id');
    }

    public function file_ST()
    {
        return $this->hasMany(File_PPP::class, 'usulans_id', 'id');
    }

    public function file_DL()
    {
        return $this->hasMany(File_DL::class, 'usulans_id', 'id');
    }

    public function file_ID()
    {
        return $this->hasMany(File_ID::class, 'usulans_id', 'id');
    }

    public function file_kriteria()
    {
        return $this->hasMany(FileKriteriaLainnya::class, 'usulans_id', 'id');
    }

    public static function generateNoSurat()
    {
        $lastSurat = self::orderBy('id', 'DESC')->first();

        if ($lastSurat) {
            $usulanID = $lastSurat->id + 1;
        } else {
            $usulanID = 1;
        }

        $surateCode = 'USL-' . date('d.m.y') . '.' . date('H') . '/' . str_pad($usulanID, 4, '0', STR_PAD_LEFT);
        return $surateCode;
    }

    public function tagihan()
    {
        return $this->hasMany(TagihanSuratUsulan::class, 'usulans_id', 'id');
    }

    public function doksts()
    {
        return $this->hasMany(FileSTS::class, 'usulans_id', 'id');
    }
}
