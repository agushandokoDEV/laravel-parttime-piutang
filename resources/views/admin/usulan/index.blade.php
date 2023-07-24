@extends('layouts.app')

@section('title') Usulan @endsection

@push('css')
    <style>
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@endpush

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center nowrap" style="width:100%;" id="usulan">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>No SKRD</th>
                            <th>No Usulan</th>
                            <th>Penanggung Hutang</th>
                            <th>Tanggal</th>
                            <th>Jenis Piutang</th>
                            <th>Pokok</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($piutang as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->no_skrd}}</td>
                                <td>{{$item->nomor_surat}}</td>
                                <td>{{$item->nama_peminjam}}</td>
                                <td>{{\Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d-F-Y')}}</td>
                                <td>{{$item->jenisPiutang->jenis}}</td>
                                <td>Rp.{{number_format($item->nilai_rincian, 0,'','.')}}</td>
                                <td>
                                    @if ($item->status == 'validate')
                                        <span class="badge bg-success p-2 text-white">Di Terima</span>
                                    @else
                                        <span class="badge bg-warning p-2 text-white">Pengajuan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/admin/detail-usulan/'.$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('js/usulan.js')}}"></script>
@endpush
