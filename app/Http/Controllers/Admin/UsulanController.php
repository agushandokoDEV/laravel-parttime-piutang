<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileSTS;
use App\Models\File_ID;
use App\Models\JenisPiutang;
use App\Models\Piutang;
use App\Models\SuratUsulan;
use App\Models\TagihanSuratUsulan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pemberitahuan;

class UsulanController extends  Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $piutang = SuratUsulan::with('jenisPiutang')->where('status', '=', 'proses')->orderBy('id', 'desc')->get();
        // $piutang = SuratUsulan::select('nomor_surat','nama_peminjam','id_jenis','tgl_surat','status','created_at')
        //     ->groupBy('nomor_surat','nama_peminjam','id_jenis','tgl_surat','status','created_at')
        //     ->where('status','proses')
        //     ->orderBy('created_at', 'desc')
        //     ->get();


        return view('admin.usulan.index', compact('piutang'));
    }

    public function showUsulan($id)
    {
        $data = SuratUsulan::with('file', 'file_ST','doksts', 'file_DL', 'file_ID','file_kriteria','tagihan.surattagihan')->find($id);
        $file_ID=File_ID::where('usulans_id',$id)->first();
        $select_STS = [];
        $select_DL = [];
        $select_kriteria=[];
        if($data->select_STS != null){
            $select_STS=explode(',',$data->select_STS);
        }
        if ($data->select_DL != null) {
            $select_DL = explode(',', $data->select_DL);
        }
        if ($data->select_kriteria != null) {
            $select_kriteria = explode(',', $data->select_kriteria);
        }

        // $dok_sts=FileSTS::where('usulans_id',$id)->get();
        // $tagihan_surat_usulan=TagihanSuratUsulan::where('usulans_id',$id)->get();
        // dd($data->file_kriteria);
        $showFile = SuratUsulan::with('file', 'file_ST', 'file_DL', 'file_ID')->where('id', '=', $id)->get();
        return view('admin.usulan.detail', compact('data', 'showFile','file_ID','select_STS','select_DL','select_kriteria'));
    }

    public function detailSuratUsulan(Request $request)
    {
        $id=$request->no;
        $data = SuratUsulan::with('file', 'file_ST', 'file_DL', 'file_ID')->where('nomor_surat',$id)->first();
        $list = SuratUsulan::with('file', 'file_ST', 'file_DL', 'file_ID')->where('nomor_surat',$id)->get();

        $showFile = SuratUsulan::with('file', 'file_ST', 'file_DL', 'file_ID')->where('id', '=', $data->id)->get();
        // dd($showFile);
        return view('admin.usulan.detail', compact('data', 'showFile'));
    }

    public function getPiutangs(Request $request)
    {
        $usersId = $request->users_id;
        $data = SuratUsulan::with('jenisPiutang', 'user')->where('users_id', '=', $usersId)->get();
        foreach ($data as $value) {
            $value->user->pokok = round($value->user->pokok);
            $tglSurat = Carbon::createFromDate($value->tgl_surat);
            $value->selisihTahun = $tglSurat->diffInYears(Carbon::now());
            $value->tgl_surat = Carbon::parse($value->tgl_surat)->translatedFormat('d-F-Y');
            $value->nilai_rincian = number_format($value->nilai_rincian);
        }
        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

    public function suratUsulan($id)
    {
        $data = Piutang::find($id);
        return view('admin.usulan.form_1', compact('data'));
    }

    public function show($id)
    {
        $data = SuratUsulan::with('jenisPiutang', 'user')->find($id);
        return view('admin.usulan.form_1', compact('data'));
    }

    public function usulanUpdate_1(Request $request, $id)
    {
        $request->validate([
            'denda' => 'required',
            'docs_skdp' => 'mimes:pdf,docx',
        ], [
            'denda.required' => 'Denda tidak boleh kosong.',
            'docs_skdp.mimes' => 'Surat Permohonan hanya boleh berformat PDF, docx.',
        ]);

        $data = SuratUsulan::find($id);

        $oldPath = public_path('storage/surat/skdp/' . $data->docs_skdp);

        if ($request->file('docs_skdp')) {
            if ($data->docs_skdp != null) {
                unlink($oldPath);
            }
            $file = $request->file('docs_skdp');
            $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/skdp/', $docsName);

            $data->update([
                'rincian' => $request->rincian,
                'docs_skdp' => $docsName
            ]);
        } else {
            $data->update([
                'rincian' => $request->rincian,
            ]);
        }
        return redirect('/admin/usulan/next_2/' . $request->id);
    }

    public function showNext2($id)
    {
        $data = SuratUsulan::with('jenisPiutang', 'user')->find($id);
        return view('admin.usulan.form_2', compact('data'));
    }

    public function usulanUpdate_2(Request $request, $id)
    {
        $request->validate([
            'select_STS' => 'required',
            'docs_STS' => 'mimes:pdf,docx',
        ], [
            'select_STS.required' => 'STS tidak boleh kosong.',
            'docs_STS.mimes' => 'Surat Permohonan hanya boleh berformat PDF, docx.',
        ]);

        $data = SuratUsulan::find($id);

        $oldPath = public_path('storage/surat/STS/' . $data->docs_STS);

        if ($request->file('docs_STS')) {
            if ($data->docs_STS != null) {
                unlink($oldPath);
            }
            $file = $request->file('docs_STS');
            $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/STS/', $docsName);

            $data->update([
                'select_STS' => $request->select_STS,
                'docs_STS' => $docsName
            ]);
        } else {
            $data->update([
                'select_STS' => $request->select_STS,
            ]);
        }
        return redirect('/admin/usulan/next_3/' . $request->id);
    }

    public function showNext3($id)
    {
        $data = SuratUsulan::with('jenisPiutang', 'user')->find($id);
        return view('admin.usulan.form_3', compact('data'));
    }

    public function usulanUpdate_3(Request $request, $id)
    {
        $request->validate([
            'select_ST' => 'required',
            'docs_ST' => 'mimes:pdf,docx',
        ], [
            'select_ST.required' => 'ST tidak boleh kosong.',
            'docs_ST.mimes' => 'Surat Permohonan hanya boleh berformat PDF, docx.',
        ]);

        $data = SuratUsulan::find($id);

        $oldPath = public_path('storage/surat/ST/' . $data->docs_ST);

        if ($request->file('docs_ST')) {
            if ($data->docs_ST != null) {
                unlink($oldPath);
            }
            $file = $request->file('docs_ST');
            $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/ST/', $docsName);

            $data->update([
                'select_ST' => $request->select_ST,
                'docs_ST' => $docsName
            ]);
        } else {
            $data->update([
                'select_ST' => $request->select_ST,
            ]);
        }
        return redirect('/admin/usulan/next_4/' . $request->id);
    }

    public function showNext4($id)
    {
        $data = SuratUsulan::with('jenisPiutang', 'user')->find($id);
        return view('admin.usulan.form_4', compact('data'));
    }

    public function usulanUpdate_4(Request $request, $id)
    {
        $request->validate([
            'select_DL' => 'required',
            'docs_DL' => 'mimes:pdf,docx,png,jpeg,jpg',
        ], [
            'select_DL.required' => 'ST tidak boleh kosong.',
            'docs_DL.mimes' => 'Surat Permohonan hanya boleh berformat PDF, docx.',
        ]);

        $data = SuratUsulan::find($id);

        $oldPath = public_path('storage/surat/DL/' . $data->docs_DL);

        if ($request->file('docs_DL')) {
            if ($data->docs_DL != null) {
                unlink($oldPath);
            }
            $file = $request->file('docs_DL');
            $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/DL/', $docsName);

            $data->update([
                'select_DL' => $request->select_DL,
                'docs_DL' => $docsName
            ]);
        } else {
            $data->update([
                'select_DL' => $request->select_DL,
            ]);
        }
        return redirect('/admin/usulan/save/' . $request->id);
    }

    public function save($id)
    {
        $data = SuratUsulan::with('jenisPiutang', 'user')->find($id);
        $jenis = JenisPiutang::all();
        return view('admin.usulan.form_5', compact('data', 'jenis'));
    }

    public function save_update(Request $request, $id)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'id_jenis' => 'required',
            'docs_ID' => 'required|mimes:pdf,docx,png,jpeg,jpg',
        ], [
            'id_jenis.required' => 'Jenis tidak boleh kosong.',
            'nama_peminjam.required' => 'Nama Peminjam tidak boleh kosong.',
            'docs_ID.required' => 'Surat Permohonan tidak boleh kosong.',
            'docs_ID.mimes' => 'Surat Permohonan hanya boleh berformat PDF, docx.',
        ]);

        $data = SuratUsulan::find($id);

        $oldPath = public_path('storage/surat/docs_ID/' . $data->docs_ID);

        if ($request->file('docs_ID')) {
            if ($data->docs_ID != null) {
                unlink($oldPath);
            }
            $file = $request->file('docs_ID');
            $docsName = Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/surat/docs_ID/', $docsName);

            $data->update([
                'nama_peminjam' => $request->nama_peminjam,
                'id_jenis' => $request->id_jenis,
                'docs_ID' => $docsName
            ]);
        } else {
            $data->update([
                'id_jenis' => $request->id_jenis,
                'nama_peminjam' => $request->nama_peminjam,
            ]);
        }
        return redirect('/admin/usulan/')->with(['message' => 'Berhasil mengubah surat permohonan usulan dengan nomor surat ' . $data->nomor_surat]);
    }

    public function showPiutangsById($id)
    {
        $data = Piutang::with('jenisPiutang', 'user', 'suratUsulan')->withCount(['suratUsulan'])->find($id);
        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }


    public function statusAjuan(Request $request)
    {
        $id=$request->id;
        $status=$request->stts_ajuan;
        $ket=$request->ket;

        $usulan=SuratUsulan::find($id);

        $param['status_ajuan']=$status;

        $msg='';
        if($status == 'tolak'){
            $param['ket_tolak']=$ket;
            $msg='Surat usulan telah ditolak dengan alasan '.$ket;
        }else{
            $param['ket_tolak']=null;
            $msg='Surat usulan telah disetujui';
        }
        SuratUsulan::where('nomor_surat',$usulan->nomor_surat)->update($param);

        $message = Pemberitahuan::create([
            'users_id' => $usulan->users_id,
            'usulans_id' => $usulan->id,
            'message' => $msg
        ]);

        return response()->json($msg);
    }
}
