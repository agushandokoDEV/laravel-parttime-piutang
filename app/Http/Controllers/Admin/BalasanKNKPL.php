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
        $skpd = SuratUsulan::all();
        return view('admin.balasanKNKPL.index', compact('skpd'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usulans_id' => 'required',
            'nomor_balasan' => 'required',
            'tgl_balasan' => 'required',
            'docs_balasan' => 'required|mimes:pdf,docx',
            'message' => 'required'
        ], [
            'usulans_id.required' => 'Pilih salah satu SPKD',
            'nomor_balasan.required' => 'Nomor Balasan KNKPL tidak boleh kosong.',
            'tgl_balasan.required' => 'Tanggal Balasan KNKPL tidak boleh kosong.',
            'docs_balasan.required' => 'Dokumen Balasan KNKPL tidak boleh kosong.',
            'message.required' => 'Silahkan Isi Pesan'
        ]);

        $file = $request->file('docs_balasan');
        $docsName = Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/surat/balasan_knkpl/', $docsName);

        $data = SuratBalasanKNKPL::create([
            'usulans_id' => $request->usulans_id,
            'nomor_balasan' => $request->nomor_balasan,
            'tgl_balasan' => $request->tgl_balasan,
            'docs_balasan' => $docsName,
        ]);

        $message = Pemberitahuan::create([
            'users_id' => $request->users_id,
            'usulans_id' => $request->usulans_id,
            'message' => $request->message
        ]);

        return back()->with(['message' => 'Berhasil membuat surat balasan KNKPL dengan nomor surat ' . $data->nomor_balasan]);
    }
}
