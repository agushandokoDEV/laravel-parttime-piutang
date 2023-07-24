<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\SuratUsulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SuratBpkdController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $no_skrd = SuratUsulan::get(['id', 'nomor_surat', 'docs_skdp']);
        return view('nasabah.surat_bpkd', compact('no_skrd'));
    }

    public function updateBACKUP(Request $request)
    {
        $request->validate([
            'usulans_id' => 'required',
            'no_skrd' => 'required',
            'tgl_surat' => 'required',
            'docs_skdp' => 'required|mimes:pdf,docx'
        ], [
            'usulans_id.required' => 'Anda harus mengirimkan surat permohonan dulu baru bisa mengusulkan surat ke BPKD.',
            'tgl_surat.required' => 'Tanggal surat usulan ke BPKD tidak boleh kosong.',
            'docs_skdp.required' => 'Dokumen usulan ke BPKD tidak boleh kosong.',
            'docs_skdp.mimes' => 'Dokumen usulan ke BPKD hanya boleh berformat PDF, docx',
            'no_skrd.required' => 'No SKRD tidak boleh kosong'
        ]);

        $usulans_id = $request->usulans_id;

        $file = $request->file('docs_skdp');
        $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/surat/skdp/', $docsName);

        $data = SuratUsulan::where('id', '=', $usulans_id)->update([
            'tgl_surat' => $request->tgl_surat,
            'docs_skdp' => $docsName,
            'status' => 'proses'
        ]);
        return back()->with(['message' => 'Berhasil mengirimkan surat usulan BPKD.']);
    }

    public function update(Request $request)
    {
        // $request->validate([
        //     'usulans_id' => 'required',
        //     'no_skrd' => 'required',
        //     'tgl_surat' => 'required',
        //     'docs_skdp' => 'required|mimes:pdf,docx'
        // ], [
        //     'usulans_id.required' => 'Anda harus mengirimkan surat permohonan dulu baru bisa mengusulkan surat ke BPKD.',
        //     'tgl_surat.required' => 'Tanggal surat usulan ke BPKD tidak boleh kosong.',
        //     'docs_skdp.required' => 'Dokumen usulan ke BPKD tidak boleh kosong.',
        //     'docs_skdp.mimes' => 'Dokumen usulan ke BPKD hanya boleh berformat PDF, docx',
        //     'no_skrd.required' => 'No SKRD tidak boleh kosong'
        // ]);

        // $id=[5,6];
        $id=explode(',',$request->usulans_id);
        $data = SuratUsulan::whereIn('id',$id)->get();

        $file = $request->file('docs_skdp');
        $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/surat/skdp/', $docsName);


        $data = SuratUsulan::whereIn('id', $id)->update([
            'tgl_surat' => $request->tgl_surat,
            'docs_skdp' => $docsName,
            'status' => 'proses'
        ]);

        return back()->with(['message' => 'Berhasil mengirimkan surat usulan BPKD.']);
    }
}
