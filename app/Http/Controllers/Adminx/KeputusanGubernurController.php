<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KeputusanGubernur;
use App\Models\SuratUsulan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KeputusanGubernurController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $skpd = SuratUsulan::all();
        return view('admin.keputusanGUBERNUR.index', compact('skpd'));    
    }

    public function store(Request $request)
    {
        $request->validate([
            'usulans_id' => 'required',
            'nomor_keputusan' => 'required',
            'tgl_keputusan' => 'required',
            'docs_keputusan' => 'required|mimes:pdf,docx',
        ],[
            'usulans_id.required' => 'Pilih salah satu SPKD',
            'nomor_keputusan.required' => 'Nomor Keputusan Gubernur tidak boleh kosong.',
            'tgl_keputusan.required' => 'Tanggal Keputusan Gubernur tidak boleh kosong.',
            'docs_keputusan.required' => 'Dokumen Keputusan Gubernur tidak boleh kosong.',
            'docs_keputusan.mimes' => 'Dokumen Keputusan Gubernur hanya boleh format PDF,docx.',
        ]);   
        
        $file = $request->file('docs_keputusan');
        $docsName = Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/surat/keputusan_gubernur/', $docsName);

        $data = KeputusanGubernur::create([
            'usulans_id' => $request->usulans_id,
            'nomor_keputusan' => $request->nomor_keputusan,
            'tgl_keputusan' => $request->tgl_keputusan,
            'docs_keputusan' => $docsName,
        ]);
        return back()->with(['message' => 'Berhasil membuat surat keputusan GUBERNUR dengan nomor surat ' . $data->nomor_keputusan]);
    }
}
