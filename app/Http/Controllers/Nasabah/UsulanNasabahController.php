<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\File_DL;
use App\Models\File_ID;
use App\Models\File_PPP;
use App\Models\FileSTS;
use App\Models\JenisPiutang;
use App\Models\SuratUsulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UsulanNasabahController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('nasabah.usulan.form_1');
    }

    public function storeUsulan(Request $request)
    {
        $request->validate([
            'nilai_rincian' => 'required',
            'rincian' => 'required',
            'nilai_rincian' => 'required',
        ], [
            'nomor_surat.required' => 'Nomor Surat tidak boleh kosong.',
            'rincian.required' => 'Rincian/Perihal Dokumen tidak boleh kosong.',
            'nilai_rincian.required' => 'Nilai Rincian tidak boleh kosong.',
        ]);

        $usersId = $request->users_id;

        $rincian = str_replace('.', '', $request->nilai_rincian);
        $denda = 50000;

        $data = SuratUsulan::create([
            'users_id' => $usersId,
            'nomor_surat' => SuratUsulan::generateNoSurat(),
            'rincian' => $request->rincian,
            'denda' => $denda,
            'nilai_rincian' => $rincian,
            'tgl_surat' => Carbon::now(),
            'total_rincian' => $rincian,
        ]);
        return redirect('/nasabah/usulan/surat/next/' . $data->id);
    }

    public function nextUsulan($id)
    {
        $data = SuratUsulan::find($id);
        $skpd = SuratUsulan::where('users_id', '=', Auth::user()->id)->get(['id', 'nomor_surat']);
        return view('nasabah.usulan.form_2', compact('data', 'skpd'));
    }

    public function storeNext2(Request $request, $id)
    {
        $request->validate([
            'select_STS' => 'required',
            // 'docs_STS' => 'mimes:pdf',
        ], [
            'select_STS.required' => 'Silahkan Pilih SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan',
            'docs_STS.mimes' => 'Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan harus berformat PDF',
            'docs_STS.required' => 'Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan harus Di isi'
        ]);

        $data = SuratUsulan::find($id);
        $select = implode(',', $request->input('select_STS'));
        if ($request->file('docs_STS')) {
            $files = $request->file('docs_STS');
            foreach ($files as $file) {
                $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/surat/STS/', $docsName);

                $uploadFile = new FileSTS();
                $uploadFile->usulans_id = $data->id;
                $uploadFile->docs_STS = $docsName;
                $uploadFile->save();
            }
            $data->update([
                'select_STS' => $select,
            ]);
        } else {
            $data->update([
                'select_STS' => $select,
            ]);
        }
        return redirect('/nasabah/usulan/surat/next3/' . $data->id);
    }

    public function nextUsulan3($id)
    {
        $data = SuratUsulan::find($id);
        return view('nasabah.usulan.form_3', compact('data'));
    }

    public function storeNext3(Request $request, $id)
    {
        $request->validate([
            'select_ST' => 'required',
            // 'docs_ST' => 'mimes:pdf',
        ], [
            'select_ST.required' => 'Silahkan Pilih Surat Tagihan/Dokumen yang dipersamakan',
            'docs_ST.mimes' => 'Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah sebagai berikut harus berformat PDF',
            'docs_ST.required' => 'Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah sebagai berikut harus Di isi'
        ]);
        $data = SuratUsulan::find($id);
        $select = implode(',', $request->input('select_ST'));
        if ($request->file('docs_ST')) {
            $files = $request->file('docs_ST');
            foreach ($files as $file) {
                $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/surat/ST/', $docsName);

                $uploadFileST = new File_PPP();
                $uploadFileST->usulans_id = $id;
                $uploadFileST->docs_ST = $docsName;
                $uploadFileST->save();
            }
            $data->update([
                'select_ST' => $select,
            ]);
        } else {
            $data->update([
                'select_ST' => $select,
            ]);
        }
        return redirect('/nasabah/usulan/surat/next4/' . $data->id);
    }

    public function nextUsulan4($id)
    {
        $data = SuratUsulan::find($id);
        return view('nasabah.usulan.form_4', compact('data'));
    }

    public function storeNext4(Request $request, $id)
    {
        $request->validate([
            'select_DL' => 'required',
            // 'docs_DL' => 'mimes:pdf,png,jpeg,jpg',
        ], [
            'select_DL.required' => 'Silahkan Pilih Dokumen Pendukung Lainnya (tidak menjadi syarat dalam Pergub 148 Tahun 2018)',
            'docs_DL.mimes' => 'Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah harus berformat PDF, PNG, JPG, JPEG',
            'docs_DL.required' => 'Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah harus di isi'
        ]);
        $data = SuratUsulan::find($id);
        $select = implode(',', $request->input('select_DL'));
        if ($request->file('docs_DL')) {
            $files = $request->file('docs_DL');
            foreach ($files as $file) {
                $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/surat/DL/', $docsName);

                $uploadFileDL = new File_DL();
                $uploadFileDL->usulans_id = $id;
                $uploadFileDL->docs_DL = $docsName;
                $uploadFileDL->save();
            }

            $data->update([
                'select_DL' => $select,
            ]);
        } else {
            $data->update([
                'select_DL' => $select,
            ]);
        }
        return redirect('/nasabah/usulan/surat/next5/' . $data->id);
    }

    public function nextUsulan5($id)
    {
        $data = SuratUsulan::find($id);
        $jenis = JenisPiutang::get(['id', 'jenis']);
        return view('nasabah.usulan.form_5', compact('data', 'jenis'));
    }

    public function saveNext(Request $request, $id)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'id_jenis' => 'required',
            'no_identitas' => 'required',
            // 'docs_ID' => 'mimes:pdf,png,jpeg,jpg',
        ], [
            'nama_peminjam.required' => 'Nama Peminjam Tidak Boleh Kosong.',
            'id_jenis.required' => 'Silahkan Pilih Jenis Piutang',
            'docs_ID.mimes' => 'Fotocopy KTP/Identitas Perusahaan/Identitas Lainnya harus berformat PDF, PNG, JPG, JPEG'
        ]);
        $data = SuratUsulan::find($id);
        if ($request->file('docs_ID')) {
            $files = $request->file('docs_ID');
            foreach ($files as $file) {
                $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/surat/docs_ID/', $docsName);

                $uploadFileID = new File_ID();
                $uploadFileID->usulans_id = $id;
                $uploadFileID->docs_ID = $docsName;
                $uploadFileID->save();
            }

            $data->update([
                'nama_peminjam' => $request->nama_peminjam,
                'id_jenis' => $request->id_jenis,
                'no_identitas' => $request->no_identitas,
            ]);
        } else {
            $data->update([
                'nama_peminjam' => $request->nama_peminjam,
                'id_jenis' => $request->id_jenis,
                'no_identitas' => $request->no_identitas,
            ]);
        }
        session()->flash('data', $data);
        return redirect('/nasabah/surat-bpkd')->with(['message' => 'Berhasil Membuat Surat Permohonan Usulan dengan nomor surat ' . $data->nomor_surat]);
    }

    public function getUsulanById($id)
    {
        $data = SuratUsulan::find($id);
        $data->denda = number_format($data->denda);
        $data->nilai_rincian = number_format($data->nilai_rincian, 0, '', '.');
        $data->total_rincian = number_format($data->total_rincian, 0, '', '.');
        $data->tgl_surat = Carbon::parse($data->tgl_surat)->translatedFormat('d-F-Y');
        return response()->json($data);
    }
}
