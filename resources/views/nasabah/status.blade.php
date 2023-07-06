@extends('layouts.app')

@section('title') Daftar Surat Usulan Permohonan @endsection

@push('css')

@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <b>Daftar Surat Usulan Permohonan Milik {{Auth::user()->name}}</b>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-bordered table-hover text-center" id="status" style="width: 100%;">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No</th>
                            <th>No SKRD</th>
                            <th>No Surat Usulan</th>
                            <th>Penanggung Piutang</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($piutang as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->no_skrd}}</td>
                                <td>
                                    @if ($item->nomor_surat != null)
                                        {{$item->nomor_surat}}
                                    @else
                                        <span class="badge badge-info p-2">Belum Memiliki No Surat Usulan</span>
                                    @endif
                                </td>
                                <td>{{$item->nama_peminjam}}</td>
                                <td>{{\Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d-F-Y')}}</td>
                                <td>
                                    @if ($item->status == 'validate')
                                        <span class="badge badge-primary p-2">Tervalidasi</span>
                                    @elseif ($item->status == 'proses')
                                        <span class="badge badge-warning p-2">Prosess</span>
                                    @else
                                        <span class="badge badge-danger p-2">Belum Mengusulkan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/nasabah/status-usulan/dokumen/' . $item->id)}}" class="btn btn-primary btn-sm">Dokumen Yang Di Ajukan</a>
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
    <script>
        $(document).ready(function() {
            $('#status').DataTable();
            $('#not_validate').click(function(e) {
                e.preventDefault();
                alert('Menu tidak bisa di akses, Karna saudara belum mengajukan surat usulan');
            });
        });
    </script>
@endpush
