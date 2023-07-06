@extends('layouts.app')
 
@section('title') Surat Permohonan @endsection

@push('css')
    
@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <b>Dokumen Yang Harus Di Serahkan</b>
        </div>
        <div class="card-body">
            <form action="{{url('/admin/usulan/next/'.$data->id.'/update_1')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nomor Surat Usulan</label>
                            <input type="text" name="nomor_surat" value="{{$data->nomor_surat}}" readonly class="form-control @error('nomor_surat') is-invalid @enderror">
                            @error('nomor_surat') 
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Rincian/Perihal Dokumen</label>
                            <input type="text" name="rincian" readonly value="{{$data->rincian}}" class="form-control @error('rincian') is-invalid @enderror">
                            @error('rincian') 
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Denda</label>
                            <input type="number" name="denda" readonly id="denda" value="{{number_format($data->denda,0,'','.')}}" class="form-control @error('denda') is-invalid @enderror">
                            @error('denda') 
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tgl_surat" readonly value="{{$data->tgl_surat}}" class="form-control @error('tgl_surat') is-invalid @enderror">
                            @error('tgl_surat') 
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nilai Rincian</label>
                            <input type="number" name="nilai_rincian" readonly id="nilai_rincian" value="{{number_format($data->nilai_rincian,0,'','.')}}" class="form-control @error('nilai_rincian') is-invalid @enderror">
                            @error('nilai_rincian') 
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Total</label>
                            <input type="number" readonly name="total_rincian" id="total_rincian" value="{{number_format($data->denda + $data->nilai_rincian,0,'','.')}}" class="form-control @error('total_rincian') is-invalid @enderror">
                            @error('total_rincian') 
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Surat permohonan usulan penyerahan pengurusan piutang dari SKDP ke BPKD beserta lampiran daftar usulan Piutang Daerah dalam atau daftar usulan pengurusan piutang daerah dalam rangka Penghapusan Piutang Daerah Koperasi Jasa Keuangan(Sesuai format lampiran A,B, dan C Pergub 148 Tahun 2018)</label>
                    <input type="file" name="docs_skdp" class="form-control @error('docs_skdp') is-invalid @enderror">
                    @error('docs_skdp') 
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-primary float-right">Next</button>
                </div>
            </form>
        </div>
    </div>
@endsection
