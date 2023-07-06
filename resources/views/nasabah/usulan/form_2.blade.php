@extends('layouts.app')

@section('title') Surat Permohonan @endsection

@push('css')
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 42px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }
</style>
<link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@endpush

@section('content')
@if(session()->has('message'))
<div class="alert alert-info">
    <b>{{session()->get('message')}}</b>
</div>
@endif
<div class="card mb-3">
    <div class="card-header">
        <b>Dokumen Yang Harus Di Serahkan</b>
    </div>
    <div class="card-body">
        <form action="{{url('/nasabah/usulan/surat/next2/'.$data->id.'/update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">No SKRD</label>
                        <input type="text" disabled name="nomor_surat" class="form-control" value="{{$data->no_skrd}}" id="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Rincian/Perihal Dokumen</label>
                        <input type="text" name="rincian" id="rincian" value="{{$data->rincian}}" readonly class="form-control @error('rincian') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tgl_surat" value="{{$data->tgl_surat}}" id="tgl_surat" disabled class="form-control @error('tgl_surat') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nilai Rincian</label>
                        <input type="text" name="nilai_rincian" value="{{number_format($data->nilai_rincian,0,'','.')}}" readonly id="nilai_rincian" class="form-control @error('nilai_rincian') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Total</label>
                        <input type="text" disabled name="total_rincian" value="{{number_format($data->total_rincian,0,'','.')}}" id="total_rincian" class="form-control @error('total_rincian') is-invalid @enderror">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="mb-3">SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</label>
                <select name="select_STS[]" multiple id="select_STS" class="form-control @error('select_STS') is-invalid @enderror">
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
                <label for="">Upload Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan </label>
                <br>
                <button type="button" class="btn btn-success btn-sm plus"><i class="fas fa-plus"></i></button>
                <table style="width: 100%;" id="table">
                    <tr>
                        <th>
                            <input type="file" name="docs_STS[]" multiple class="form-control @error('docs_STS') is-invalid @enderror my-2" style="width: 100%;">
                            @error('docs_STS')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </th>
                    </tr>
                </table>
            </div>
            <hr>
            <div class="my-3">
                <a href="{{url('/nasabah/usulan')}}" type="submit" id="back" class="btn btn-secondary float-start"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" id="next" class="btn btn-primary float-right">Next <i class="fas fa-arrow-right"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('js/usulan_form_2_user.js')}}"></script>
<script>
    $(document).ready(function() {
        let baris = 1;
        $(document).on('click', '.plus', function(e) {
            e.preventDefault();
            baris = baris + 1;
            let html = '<tr id="baris' + baris + '">';
            html += `<th>
                            <button type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                            <input type="file" name="docs_STS[]" multiple class="form-control @error('docs_STS') is-invalid @enderror my-2" style="width: 100%;">
                        </th>`;
            html += '</tr>';
            $('#table').append(html);
        });

        $(document).on('click', '.minus', function(e) {
            let rows = $(this).data('row');
            $('#' + rows).remove();
        });
    });
</script>
@endpush
