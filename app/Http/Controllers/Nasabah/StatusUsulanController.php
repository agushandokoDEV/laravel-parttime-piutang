<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\File_DL;
use App\Models\File_ID;
use App\Models\File_PPP;
use App\Models\FileSTS;
use App\Models\SuratUsulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StatusUsulanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $piutang = SuratUsulan::with('usulanKnkpl', 'keputusan', 'file')
            ->where('status', '=', 'proses')
            ->orWhere('status', '=', 'validate')
            ->where('users_id', '=', Auth::user()->id)
            ->get();
        return view('nasabah.status', compact('piutang'));
    }

    public function detail($id)
    {
        $data = SuratUsulan::with('file', 'file_ST', 'file_DL', 'file_ID')->find($id);
        return view('nasabah.detail', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'docs_ID' => 'mimes:png,jpg,jpeg,pdf',
            'docs_skpd' => 'mimes:pdf',
            'docs_STS' => 'mimes:pdf',
            'docs_ST' => 'mimes:png,jpg,jpeg,pdf',
            'docs_DL' => 'mimes:png,jpg,jpeg,pdf',
        ], [
            'docs_ID.mimes' => 'Dokumen Harus Berformat PDF',
            'docs_skpd.mimes' => 'Dokumen Harus Berformat PDF',
            'docs_STS.mimes' => 'Dokumen Harus Berformat PDF',
            'docs_ST.mimes' => 'Dokumen Harus Berformat PDF',
            'docs_DL.mimes' => 'Dokumen Harus Berformat PDF',
            'docs_lainnya.mimes' => 'Dokumen Harus Berformat PDF',
        ]);

        $data = SuratUsulan::find($id);

        if ($request->docs_ID) {
            $file = $request->file('docs_ID');
            $docsID = Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/docs_ID/', $docsID);

            $data = File_ID::create([
                'usulans_id' => $id,
                'docs_ID' => $docsID
            ]);
            return back()->with(['message' => 'Berhasil Menambahkan Kekurangan Dokumen.']);
        } elseif ($request->docs_skdp) {
            $file = $request->file('docs_skdp');
            $docsSkdp = Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/skdp/', $docsSkdp);

            $data->update([
                'docs_skdp' => $docsSkdp,
            ]);
            return back()->with(['message' => 'Berhasil Menambahkan Kekurangan Dokumen.']);
        } elseif ($request->docs_STS) {
            $file = $request->file('docs_STS');
            $docsSTS = Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/STS/', $docsSTS);

            $uploadFile = new FileSTS();
            $uploadFile->usulans_id = $data->id;
            $uploadFile->docs_STS = $docsSTS;
            $uploadFile->save();
            return back()->with(['message' => 'Berhasil Menambahkan Kekurangan Dokumen.']);
        } elseif ($request->docs_ST) {
            $file = $request->file('docs_ST');
            $docsST = Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/ST/', $docsST);

            $data = File_PPP::create([
                'usulans_id' => $id,
                'docs_ST' => $docsST
            ]);
            return back()->with(['message' => 'Berhasil Menambahkan Kekurangan Dokumen.']);
        } else if ($request->docs_DL) {
            $file = $request->file('docs_DL');
            $docsDL = Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/DL/', $docsDL);

            $data = File_DL::create([
                'usulans_id' => $id,
                'docs_DL' => $docsDL
            ]);
            return back()->with(['message' => 'Berhasil Menambahkan Kekurangan Dokumen.']);
        } else if ($request->docs_lainnya) {
            $file = $request->file('docs_lainnya');
            $docsLainnya = Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/docs_lainnya/', $docsLainnya);

            $data->update([
                'docs_lainnya' => $docsLainnya,
            ]);
            return back()->with(['message' => 'Berhasil Menambahkan Kekurangan Dokumen.']);
        } else {
            return back()->with(['err' => 'Gagalam Menambahkan Kekurangan Dokumen.']);
        }
    }
}
