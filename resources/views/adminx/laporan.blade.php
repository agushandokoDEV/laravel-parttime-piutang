@extends('layouts.app')

@section('title') Laporan @endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
@endpush

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <a href="{{url('/admin/laporan/export')}}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i></a>
        <a href="{{url('/admin/laporan/cetak')}}" class="btn btn-danger btn-sm" target="__blank"><i class="fas fa-print"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover dt-responsive nowrap" id="laporan" style="width: 100%">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2" class="bg-warning text-white">Nama</th>
                        <th colspan="3" class="bg-warning text-white">Usulan Ke BPKD</th>
                        <th colspan="3" class="bg-info text-white">Rincian Piutang</th>
                        <th rowspan="2" class="bg-info text-white">Berita Acara</th>
                        <th colspan="2" class="bg-success text-white">Usulan PUPN</th>
                        {{-- <th colspan="2" class="bg-success text-white">Balasan PUPN</th>
                            <th colspan="2" class="bg-success text-white">Pembayaran</th>
                            <th colspan="2" class="bg-success text-white">Keputusan</th> --}}
                    </tr>
                    <tr>
                        <th class="bg-warning text-white">Jenis</th>
                        <th class="bg-warning text-white">Tanggal</th>
                        <th class="bg-warning text-white">Nomor</th>
                        <th class="bg-info text-white">Pokok</th>
                        <th class="bg-info text-white">Denda</th>
                        <th class="bg-info text-white">Total</th>
                        <th class="bg-success text-white">Tanggal</th>
                        <th class="bg-success text-white">Nomor Usulan PUPN : </th>
                        <th class="bg-success text-white">Tanggal Balasan PUPN : </th>
                        <th class="bg-success text-white">Nomor Balasan PUPN : </th>
                        <th class="bg-danger text-white">Tanggal Pembayaran : </th>
                        <th class="bg-danger text-white">Nilai Pembayaran : </th>
                        <th class="bg-primary text-white">Tanggal Keputusan Gubernur : </th>
                        <th class="bg-primary text-white">Nomor Keputusan Gubernur : </th>
                        <th class="bg-primary text-white">Status : </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $piutang)
                        @if($piutang->docs_balasan != null)
                            @php
                                $dueDate = \Carbon\Carbon::parse($piutang->tgl_surat);
                                $currDate = \Carbon\Carbon::now();

                                $year = $currDate->diffInYears($dueDate);
                                $denda = 50000;
                                $total_denda = $year * $denda;
                            @endphp
                            <tr>
                                <td>{{$piutang->nama_peminjam}}</td>
                                <td>{{$piutang->jenis}}</td>
                                <td>{{\Carbon\Carbon::parse($piutang->tgl_surat)->translatedFormat('d-F-Y')}}</td>
                                <td>{{$piutang->no_skrd}}</td>
                                <td>{{number_format($piutang->nilai_rincian,0,'','.')}}</td>
                                <td></td>
                                <td>{{number_format($piutang->total_rincian + $total_denda,0,'','.')}}</td>
                                <td>{{$piutang->judul}}</td>
                                <td>{{\Carbon\Carbon::parse($piutang->tgl_knkpl)->translatedFormat('d-F-Y')}}</td>
                                <td>{{$piutang->nomor_knkpl}}</td>
                                <td>{{\Carbon\Carbon::parse($piutang->tgl_balasan)->translatedFormat('d-F-Y')}}</td>
                                <td>{{$piutang->nomor_balasan}}</td>
                                @if($piutang->tgl_bayar != null)
                                    <td>{{\Carbon\Carbon::parse($piutang->tgl_bayar)->translatedFormat('d-F-Y')}}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{number_format($piutang->nominal_bayar,0,'','.')}}</td>
                                <td>{{\Carbon\Carbon::parse($piutang->tgl_keputusan)->translatedFormat('d-F-Y')}}</td>
                                <td>{{$piutang->nomor_keputusan}}</td>
                                <td>
                                    @if ($piutang->count_sts > 0 && $piutang->count_st > 0 && $piutang->count_dl > 0)
                                        <span class="badge badge-success p-2">Terpenuhi</span>
                                    @else
                                        <span class="badge badge-danger p-2">Tidak Terpenuhi</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#laporan').DataTable();
    });
</script>
@endpush
