<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BeritaAcara;
use App\Models\SuratUsulan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaAcaraController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // $skpd = SuratUsulan::with('beritaAcara')->get();
        $skpd = SuratUsulan::select('nomor_surat')->whereNotNull('nomor_surat')->groupBy('nomor_surat')->get();
        return view('admin.beritaAcara.index', compact('skpd'));
    }

    public function storeBACKUP(Request $request)
    {
        $request->validate([
            'usulans_id' => 'required',
            'judul' => 'required',
            'docs_berita' => 'required|mimes:pdf,docx',
        ], [
            'usulans_id.required' => 'Pilih salah satu SPKD',
            'judul.required' => 'Judul Berita Acara tidak boleh kosong.',
            'docs_berita.required' => 'Dokumen Berita Acara tidak boleh kosong.',
            'docs_berita.mimes' => 'Dokumen Berita Acara hanya boleh format PDF,docx.',
        ]);

        $file = $request->file('docs_berita');
        $docsName = $request->judul . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/surat/berita_acara/', $docsName);

        $data = BeritaAcara::create([
            'usulans_id' => $request->usulans_id,
            'judul' => $request->judul,
            'docs_berita' => $docsName,
        ]);
        return back()->with(['message' => 'Berhasil membuat surat keputusan GUBERNUR dengan nomor surat ' . $data->judul]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usulans_id' => 'required',
            'judul' => 'required',
            'docs_berita' => 'required|mimes:pdf,docx',
        ], [
            'usulans_id.required' => 'Pilih salah satu SPKD',
            'judul.required' => 'Judul Berita Acara tidak boleh kosong.',
            'docs_berita.required' => 'Dokumen Berita Acara tidak boleh kosong.',
            'docs_berita.mimes' => 'Dokumen Berita Acara hanya boleh format PDF,docx.',
        ]);

        $file = $request->file('docs_berita');
        $docsName = $request->judul . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/surat/berita_acara/', $docsName);


        $surat_usulan=SuratUsulan::where('nomor_surat',$request->usulans_id)->get();
        if(count($surat_usulan) > 0){
            foreach ($surat_usulan as $item) {
                $file = $request->file('docs_berita');
                $docsName = $request->judul . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/surat/berita_acara/', $docsName);

                BeritaAcara::where('usulans_id',$item->id)->delete();
                $data = BeritaAcara::create([
                    'usulans_id' => $item->id,
                    'judul' => $request->judul,
                    'docs_berita' => $docsName,
                ]);
            }
        }
        return redirect('/admin/usulan-knkpl?no_surat='.$request->usulans_id)->with(['message' => 'Berhasil membuat ' . $request->judul]);
    }
}
