<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\SuratUsulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $skpd = SuratUsulan::with('user', 'jenisPiutang')->where('users_id', Auth::user()->id)->get();
        $sumSkpd = DB::table('users')
            ->leftJoin('surat_usulans', 'surat_usulans.users_id', '=', 'users.id')
            ->leftJoin('jenis_piutangs', 'jenis_piutangs.id', '=', 'surat_usulans.id_jenis')
            ->where('users.id', '=', Auth::user()->id)
            ->sum('surat_usulans.total_rincian');
        foreach ($skpd as $value) {
            $value->nilai_rincian = number_format($value->nilai_rincian);
            $value->denda = number_format($value->denda);
            $value->total_rincian = number_format($value->total_rincian);
            $tglSurat = Carbon::createFromDate($value->tgl_surat);
            $value->selisihTahun = $tglSurat->diffInYears(Carbon::now());
            $value->tgl_surat = Carbon::parse($value->tgl_surat)->translatedFormat('d-F-Y');
        }

        // dd($skpd);
        return view('nasabah.index', compact('skpd', 'sumSkpd'));
    }

    public function getUsulan($id)
    {
        $data = SuratUsulan::find($id);
        return view('nasabah.usulan.form_usulan', compact('data'));
    }

    public function updateUsulan(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'rincian' => 'required',
            'tgl_surat' => 'required',
            'nilai_rincian' => 'required'
        ]);

        $rincian = str_replace('.', '', $request->nilai_rincian);
        $total = str_replace('.', '', $request->total_rincian);
        $data = SuratUsulan::find($id);
        $data->update([
            'nomor_surat' => $request->nomor_surat,
            'rincian' => $request->rincian,
            'nilai_rincian' => $rincian,
            'total_rincian' => $total
        ]);
        return redirect('/nasabah/usulan/surat/next/' . $data->id);
    }


    public function usualan(Request $request)
    {
        $id=explode(',', $request->id);
        $list=SuratUsulan::whereIn('id',$id)->get();
        $data['list']=$list;
        $data['total_rincian']=collect($list)->sum('total_rincian');
        $data['nilai_rincian']=collect($list)->sum('nilai_rincian');
        $data['denda']=collect($list)->sum('denda');

        return view('nasabah.usulan.v2.form_usulan')->with($data);
    }

    public function simpanUsulan(Request $request)
    {
    
        $request->validate([
            'id' => 'required|array',
            'nomor_surat' => 'required',
            'rincian' => 'required',
            'tgl_usulan' => 'required', 
            'nilai_rincian' => 'required'
        ]);
       
        for ($i=0; $i < count($request->id); $i++) { 
            $rincian = str_replace('.', '', $request->nilai_rincian[$i]);
            $total = str_replace('.', '', $request->total_rincian[$i]);
            $data = SuratUsulan::find($request->id[$i]);

            // $p=$data->rincian_perihal;
            // // $p=array($request->rincian[$i]);
            // array_push($p,$request->rincian[$i]);
            // dd($p);

            $rincian_perihal[]=array(
                'step'=>1,
                'perihal'=>$request->rincian[$i]
            );
            $data->update([
                'nomor_surat' => $request->nomor_surat[$i],
                // 'rincian' => $request->rincian[$i],
                'rincian_perihal' => $rincian_perihal,
                'nilai_rincian' => $rincian,
                'tgl_usulan' => $request->tgl_usulan[$i],
                'total_rincian' => $total 
            ]);
        }

        return redirect('/nasabah/surat-usulan/step2?id=' . implode(",", $request->id));
    }
}
