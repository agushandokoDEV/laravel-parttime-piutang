<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetNotifController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function getNotif()
    {
        $data = Pemberitahuan::with('usulan')->where('users_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(7);
        return response()->json(['code' => 200, 'data' => $data,]);
    }

    public function cekNotif($id)
    {
        $data = Pemberitahuan::with('usulan')->where('users_id', '=', Auth::user()->id)->find($id);
        return response()->json(['code' => 200, 'data' => $data,]);
    }

    public function countNotif()
    {
        $data = Pemberitahuan::with('usulan')->where('users_id', '=', Auth::user()->id)->count();
        return response()->json(['code' => 200, 'data' => $data,]);
    }
}
