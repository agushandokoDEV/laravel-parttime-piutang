<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $skpd = User::orderBy('id', 'desc')->get(['id', 'no_skpd']);
        return view('admin.dashboard', compact('skpd'));
    }

    public function getSkpdById($id)
    {
        $now = Carbon::now();
        $skpd = DB::table('users')
            ->leftJoin('surat_usulans', 'surat_usulans.users_id', '=', 'users.id')
            ->leftJoin('jenis_piutangs', 'jenis_piutangs.id', '=', 'surat_usulans.id_jenis')
            ->where('surat_usulans.status', '=', 'validate')
            ->where('users.id', '=', $id)
            ->select('users.name', 'surat_usulans.*', 'jenis_piutangs.*')
            ->get();
        foreach ($skpd as $value) {
            $denda = 50000;
            $dueDate = Carbon::parse($value->tgl_surat);
            $now = Carbon::now();
            $year = $now->diffInYears($dueDate);
            $total_denda = $year * $denda;
            $value->nilai_rincian = number_format($value->nilai_rincian);
            $value->denda = number_format($total_denda);
            $value->total_rincian = number_format($value->total_rincian);
            $tglSurat = Carbon::createFromDate($value->tgl_surat);
            $value->selisihTahun = $tglSurat->diffInYears(Carbon::now());
            $value->tgl_surat = Carbon::parse($value->tgl_surat)->translatedFormat('F-Y');
        }
        return response()->json(['data' => $skpd]);
    }
}
