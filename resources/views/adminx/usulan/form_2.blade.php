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
            <form action="{{url('/admin/usulan/next/'.$data->id.'/update_2')}}" method="POST" enctype="multipart/form-data">
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
                    <label for="" class="mb-3">SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</label>
                    <select name="select_STS" class="form-control @error('select_STS') is-invalid @enderror">
                        <option selected></option>
                        <option value="Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan">Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan</option>
                        <option value="Piutang Hasil Pengelolaan Kekayaan Daerah yang dipisahkan lebih dari 5(lima) tahun">Piutang Hasil Pengelolaan Kekayaan Daerah yang dipisahkan lebih dari 5(lima) tahun</option>
                        <option value="Piutang yang berasal dari tagihan investasi non permanen dalam jangka waktu tertentu sesuai dengan perjanjian tidak melakukan pelunasan/ tidak diketahui keberadaannya /bangkrut dan mengalami musibah(force majerure)">Piutang yang berasal dari tagihan investasi non permanen dalam jangka waktu tertentu sesuai dengan perjanjian tidak melakukan pelunasan/ tidak diketahui keberadaannya /bangkrut dan mengalami musibah(force majerure)</option>
                        <option value="Piutang Lainnya yang belum dibayar oleh pihak ketiga selain a-d sesuai ketentuan peraturan perundang-undangan">Piutang Lainnya yang belum dibayar oleh pihak ketiga selain a-d sesuai ketentuan peraturan perundang-undangan</option>
                    </select>
                    @error('select_STS')
                     <div class="invalid-feedback">
                        {{$message}}
                     </div>
                    @enderror
                </div>
                 <div class="form-group mb-3">
                    <label for="" class="mb-3">Upload Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan </label>
                    <input type="file" name="docs_STS" class="form-control @error('docs_STS') is-invalid @enderror">
                    @error('docs_STS')
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
