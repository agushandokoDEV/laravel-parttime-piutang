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
<div class="card mb-3">
    <div class="card-header">
        <b>Dokumen Yang Harus Di Serahkan</b>
    </div>
    <div class="card-body">
        <form action="{{url('/nasabah/usulan/surat/next4/'.$data->id.'/update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nomor SKRD</label>
                        <input type="text" name="nomor_surat" value="{{$data->no_skrd}}" readonly class="form-control @error('nomor_surat') is-invalid @enderror">
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
                        <label for="">Tanggal</label>
                        <input type="date" name="tgl_surat" disabled value="{{$data->tgl_surat}}" class="form-control @error('tgl_surat') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nilai Rincian</label>
                        <input type="text" name="nilai_rincian" readonly id="nilai_rincian" value="{{number_format($data->nilai_rincian, 0, '', '.')}}" class="form-control @error('nilai_rincian') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Total</label>
                        <input type="text" disabled name="total_rincian" id="total_rincian" value="{{number_format($data->total_rincian, 0, '', '.')}}" class="form-control @error('total_rincian') is-invalid @enderror">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputState" class="form-label">Dokumen Pendukung Lainnya (tidak menjadi syarat dalam Pergub 148 Tahun 2018)</label>
                <select name="select_DL[]" id="select_DL" multiple class="form-control @error('select_DL') is-invalid @enderror">
                    <option>Surat Permohonan Pengunduran Diri Sewa Lahan ex Pool PPD Depo H Kramat Jati, Jakarta Timur</option>
                    <option>Foto Dokumentasi</option>
                    <option>Surat Keterangan Kronologi Terjadinya Usulan Penghapusan Piutang di Tanda tangani oleh penyerah piutang</option>
                    <option>Daftar Rincian Dokumen yang disampaikan </option>
                    <option>Resume Usulan Penyerahan Penghapusan Piutang Daerah sesuai pasal 10 </option>
                    <option>Kartu Inventaris Barang (KIB A)</option>
                    <option>Dokumen rekomendasi TLHP BPK</option>
                </select>
                @error('select_DL')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="formFileMultiple" class="form-label">Upload Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah sebagai berikut</label>
                <br>
                <button type="button" class="btn btn-success btn-sm plus"><i class="fas fa-plus"></i></button>
                <table style="width: 100%;" id="table">
                    <tr>
                        <th>
                            <input type="file" name="docs_DL[]" multiple class="form-control @error('docs_DL') is-invalid @enderror my-2" style="width: 100%;">
                            @error('docs_DL')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </th>
                    </tr>
                </table>
            </div>
            <div class="my-3">
                <a href="{{url('nasabah/usulan/surat/next3/' . $data->id)}}" type="submit" id="back" class="btn btn-secondary float-start"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-arrow-right"></i> Next</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#select_DL').select2();

            let baris = 1;
            $(document).on('click', '.plus', function(e) {
                e.preventDefault();
                baris = baris + 1;
                let html = '<tr id="baris' + baris + '">';
                html += `<th>
                                <button type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                                <input type="file" name="docs_DL[]" multiple class="form-control @error('docs_ST') is-invalid @enderror my-2" style="width: 100%;">
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
