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
            <form action="{{url('/admin/usulan/next/'.$data->id.'/update_3')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nomor Surat Usulan</label>
                            <input type="text" name="nomor_surat" value="{{$data->nomor_surat}}" readonly class="form-control @error('nomor_surat') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Rincian/Perihal Dokumen</label>
                            <input type="text" name="rincian" readonly value="{{$data->rincian}}" class="form-control @error('rincian') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Denda</label>
                            <input type="number" name="denda" id="denda" readonly value="{{number_format($data->denda, 0, '', '.')}}" class="form-control @error('denda') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tgl_surat" disabled value="{{$data->tgl_surat}}" class="form-control @error('tgl_surat') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nilai Rincian</label>
                            <input type="number" name="nilai_rincian" readonly id="nilai_rincian" value="{{number_format($data->nilai_rincian, 0, '', '.')}}" class="form-control @error('nilai_rincian') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Total</label>
                            <input type="number" disabled name="total_rincian" id="total_rincian" value="{{number_format($data->total_rincian, 0, '', '.')}}" class="form-control @error('total_rincian') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputState">Surat Tagihan/Dokumen yang dipersamakan</label>
                    <select name="select_ST" class="form-control @error('select_ST') is-invalid @enderror">
                        <option selected></option>
                        <option>Surat Tagiahan ke-1</option>
                        <option>Surat Tagiahan ke-2</option>
                        <option>Surat Tagiahan ke-3</option>
                    </select>
                    @error('select_ST')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Upload Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah sebagai berikut</label>
                    <input type="file" name="docs_ST" class="form-control @error('docs_ST') is-invalid @enderror">
                    @error('docs_ST')
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
