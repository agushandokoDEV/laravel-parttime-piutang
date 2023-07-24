<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use App\Models\SuratBalasanKNKPL;
use App\Models\SuratUsulan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BalasanKNKPL extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // $skpd = SuratUsulan::with('balasanKnkpl')->get();
        $skpd = SuratUsulan::select('nomor_surat')->whereNotNull('nomor_surat')->groupBy('nomor_surat')->get();
        return view('admin.balasanKNKPL.index', compact('skpd'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usulans_id' => 'required',
            'nomor_balasan' => 'required',
            'tgl_balasan' => 'required',
            'docs_balasan' => 'required|mimes:pdf,docx',
            'message' => 'required',
            'rincian_balasan' => 'required'
        ], [
            'usulans_id.required' => 'Pilih salah satu SPKD',
            'nomor_balasan.required' => 'Nomor Balasan KNKPL tidak boleh kosong.',
            'tgl_balasan.required' => 'Tanggal Balasan KNKPL tidak boleh kosong.',
            'docs_balasan.required' => 'Dokumen Balasan KNKPL tidak boleh kosong.',
            'message.required' => 'Silahkan Isi Pesan',
            'rincian_balasan.required' => 'SIlahkan Isi Rincian'
        ]);

        $file = $request->file('docs_balasan');
        $docsName = Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/surat/balasan_knkpl/', $docsName);


        $surat_usulan = SuratUsulan::where('nomor_surat', $request->usulans_id)->get();
        if (count($surat_usulan) > 0) {
            foreach ($surat_usulan as $item) {

                // SuratBalasanKNKPL::where('usulans_id', $item->id)->delete();
                $data = SuratBalasanKNKPL::create([
                    'usulans_id' => $item->id,
                    'nomor_balasan' => $request->nomor_balasan,
                    'tgl_balasan' => $request->tgl_balasan,
                    'docs_balasan' => $docsName,
                    'rincian_balasan' => $request->rincian_balasan
                ]);
            }
        }


        $usulan = SuratUsulan::where('nomor_surat', $request->usulans_id)->first();
        $message = Pemberitahuan::create([
            'users_id' => $request->users_id,
            'usulans_id' => $usulan->id,
            'message' => $request->message
        ]);

        // return back()->with(['message' => 'Berhasil membuat surat balasan KNKPL dengan nomor surat ' . $data->nomor_balasan]);
        return redirect('/admin/keputusan?no_surat=' . $request->usulans_id)->with(['message' => 'Berhasil membuat surat balasan PUPN dengan nomor surat ' . $request->nomor_balasan]);
    }
}
