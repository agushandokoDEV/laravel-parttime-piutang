@extends('layouts.app')

@section('title') Surat Ke BPKD @endsection

@push('css')

@endpush

@section('content')
@if (session()->has('message'))
<div class="alert alert-success">
    <b>{{session()->get('message')}}</b>
</div>
@endif

<div class="card">
    <div class="card-header">
        <b>Formulir Surat Ke BPKD</b>
    </div>
    <div class="card-body">
        <form action="{{url('/nasabah/surat-bpkd')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="usulans_id" value="{{old('usulans_id', session('data.id'))}}" class="form-control @error('usulans_id') is-invalid @enderror">
            @error('usulans_id')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Pilih No SKRD</label>
                        <input type="text" name="no_skrd" value="{{old('no_skrd', session('data.no_skrd'))}}" class="form-control @error('no_skrd') is-invalid @enderror">
                        @error('no_skrd')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tgl_surat" value="{{old('tgl_surat', session('data.tgl_surat'))}}" class="form-control @error('tgl_surat') is-invalid @enderror">
                        @error('tgl_surat')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Surat permohonan usulan penyerahan pengurusan piutang dari SKDP ke BPKD beserta lampiran daftar usulan Piutang Daerah dalam atau daftar usulan pengurusan piutang daerah dalam rangka Penghapusan Piutang Daerah Koperasi Jasa Keuangan(Sesuai format lampiran A,B, dan C Pergub 148 Tahun 2018)</label>
                <input type="file" class="form-control @error('docs_skdp') is-invalid @enderror" name="docs_skdp">
                @error('docs_skdp')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="btn-send">
                <button class="btn btn-primary float-right">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
