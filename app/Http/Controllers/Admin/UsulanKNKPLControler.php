<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratUsulan;
use App\Models\SuratUsulanKNKPL;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsulanKNKPLControler extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        //$skpd = SuratUsulan::with('usulanKnkpl')->get();
        $skpd = SuratUsulan::select('nomor_surat')->whereNotNull('nomor_surat')->groupBy('nomor_surat')->get();

        return view('admin.usulanKNKPL.index', compact('skpd'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usulans_id' => 'required',
            'nomor_knkpl' => 'required',
            'tgl_knkpl' => 'required',
            'docs_knkpl' => 'required|mimes:pdf,docx',
            'rincian_usulan_knkpl' => 'required',
        ], [
            'usulans_id.required' => 'Pilih salah satu SPKD',
            'nomor_knkpl.required' => 'Nomor SUrat Usulan tidak boleh kosong.',
            'tgl_knkpl.required' => 'Tanggal Surat Usulan tidak boleh kosong.',
            'docs_knkpl.required' => 'Dokumen Surat Usulan tidak boleh kosong.',
            'docs_knkpl.mimes' => 'Dokumen Surat Usulan hanya boleh format PDF, docx.',
            'rincian_usulan_knkpl.required' => 'Rincian Surat Usulan KNKPL Harus Di Isi'
        ]);

        $file = $request->file('docs_knkpl');
        $docsName = Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/surat/usulan_knkpl/', $docsName);

        $surat_usulan = SuratUsulan::where('nomor_surat', $request->usulans_id)->get();
        if (count($surat_usulan) > 0) {
            foreach ($surat_usulan as $item) {
                // SuratUsulanKNKPL::where('usulans_id', $item->id)->delete();
                $data = SuratUsulanKNKPL::with('usulans')->create([
                    'usulans_id' => $item->id,
                    'nomor_knkpl' => $request->nomor_knkpl,
                    'tgl_knkpl' => $request->tgl_knkpl,
                    'docs_knkpl' => $docsName,
                    'rincian_usulan_knkpl' => $request->rincian_usulan_knkpl
                ]);
                $data->usulans->status = $request->status;
                $data->usulans->save();
                $data->save();
            }
        }

        // return back()->with(['message' => 'Berhasil membuat surat usulan KNKPL dengan nomor surat ' . $data->nomor_knkpl]);
        return redirect('/admin/balasan-knkpl?no_surat=' . $request->usulans_id)->with(['message' => 'Berhasil membuat surat usulan PUPN dengan nomor surat ' . $request->nomor_knkpl]);
    }

    public function getPiutangsById(Request $request)
    {
        $usulansId = $request->usulans_id;
        $data = SuratUsulan::with('jenisPiutang', 'user')->where('id', '=', $usulansId)->get();
        foreach ($data as $value) {
            $value->tgl_piutang = Carbon::parse($value->tgl_piutang)->translatedFormat('d-F-Y');
            $value->pokok = number_format($value->pokok, 0, '', '.');
        }
        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

    public function getPiutangsByNoSurat(Request $request)
    {
        $nomor_surat = $request->usulans_id;
        $data = SuratUsulan::with('jenisPiutang', 'user')->where('nomor_surat', $nomor_surat)->first();

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }
}
