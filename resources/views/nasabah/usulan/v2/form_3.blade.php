@extends('layouts.app')

@section('title') Dokumen yang diserahkan {{Auth::user()->name}}  @endsection

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

<form action="{{url('/nasabah/surat-usulan/step3')}}" method="POST" enctype="multipart/form-data">
@csrf
@php
$i=1;
@endphp
@foreach($data as $item)
<input type="hidden" name="id[]" value="{{ $item->id}}" />

<div class="card mb-3">
    <div class="card-header">
        <b>{{$i++}}.Surat Tagihan/Dokumen yang dipersamakan</b>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor SKRD/Dokumen yang dipersamakan</label>
                    <input type="text" name="nomor_surat[]" value="{{$item->no_skrd}}" readonly class="form-control @error('nomor_surat') is-invalid @enderror">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Rincian/Perihal Dokumen</label>
                    <input type="text" name="rincian[]" class="form-control @error('rincian') is-invalid @enderror">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tanggal Dokumen</label>
                    <input type="date" name="tgl_surat[]" readonly value="{{$item->tgl_surat}}" class="form-control @error('tgl_surat') is-invalid @enderror">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nilai Rincian</label>
                    <input type="text" name="nilai_rincian[]" readonly id="nilai_rincian" value="{{number_format($item->nilai_rincian,0,'','.')}}" class="form-control @error('nilai_rincian') is-invalid @enderror">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Total</label>
                    <input type="text" disabled name="total_rincian[]" value="{{number_format($item->total_rincian,0,'','.')}}" class="form-control @error('total_rincian') is-invalid @enderror">
                    <font style="color:blue">*Total merupakan jumlah dari nilai rincian utang yang dipilih</font>
                </div>
            </div>

            <div class="col-md-12"> 
                @foreach($surat_tagihan as $item_tagihan)
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{$item_tagihan->nama}} :</label>
                    <div class="col-sm-3">
                        <input type="text" name="tagihan[{{$item->id}}][{{$item_tagihan->id}}][nomor]" class="form-control" placeholder="Nomor">
                    </div>
                    <div class="col-sm-3">
                        <input type="date" name="tagihan[{{$item->id}}][{{$item_tagihan->id}}][tgl]" class="form-control" placeholder="Tanggal">
                    </div>
                    <div class="col-sm-3">
                        <input type="file" name="tagihan[{{$item->id}}][{{$item_tagihan->id}}][dok]" accept="application/pdf" class="form-control">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <hr/>
        {{-- <div class="row">
        <div class="col-md-6">
            <label for="inputState">Pilih Surat Tagihan </label>
            <select name="select_ST[{{$item->id}}][]" class="select_ST form-control @error('select_ST') is-invalid @enderror">
                <option>Surat Tagihan ke-1</option>
                <option>Surat Tagihan ke-2</option>
                <option>Surat Tagihan ke-3</option>
            </select>
            @error('select_ST')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-md-6">
        <div class="form-group">
                    <label for="">Tanggal Surat Tagihan</label>
                    <input type="date" name="tgl_surat[]" value="{{date('Y-m-d')}}" class="form-control @error('tgl_surat') is-invalid @enderror">
                    @error('tgl_surat')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div> --}}
        {{-- <div class="form-group">
            <label for="">Upload Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah sebagai berikut</label>
            <br>
            <button type="button"  onclick="addUpload('{{$item->id}}')" class="btn btn-success btn-sm plus"><i class="fas fa-plus"></i></button>
            <table style="width: 100%;" id="table-upload-{{$item->id}}">
                <tr>
                    <th>
                        <input type="file" name="docs_ST[{{$item->id}}][]" accept="application/pdf" class="form-control @error('docs_ST') is-invalid @enderror my-2" style="width: 100%;">
                        @error('docs_ST')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </th>
                </tr>
            </table>
        </div> --}}

    </div>
</div>

@endforeach
<div class="my-3">
        <a href="{{url('nasabah/usulan/surat/next/')}}" type="submit" id="back" class="btn btn-secondary float-start"><i class="fas fa-arrow-left"></i> Back</a>
        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-arrow-right"></i> Next</button>
    </div>
</form>
@endsection

@push('js')
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.select_ST').select2();
            let baris = 1;
            $(document).on('click', '.plusx', function(e) {
                e.preventDefault();
                baris = baris + 1;
                let html = '<tr id="baris' + baris + '">';
                html += `<th>
                                <button type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                                <input type="file" name="docs_ST[{{$item->id}}][]" accept="application/pdf" class="form-control @error('docs_ST') is-invalid @enderror my-2" style="width: 100%;">
                            </th>`;
                html += '</tr>';
                $('#table').append(html);
            });

            $(document).on('click', '.minusx', function(e) {
                let rows = $(this).data('row');
                $('#' + rows).remove();
            });
        });


        function addUpload(id){
            let baris = 1;
            baris = baris + 1;
            let html = `<tr id="baris${baris}${id}">`;
            html += `<th>
                            <button onclick="removeUpload('${baris}','${id}')" type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                            <input type="file" name="docs_STS[${id}][]" accept="application/pdf" class="form-control @error('docs_STS') is-invalid @enderror my-2" style="width: 100%;">
                        </th>`;
            html += '</tr>';
            $(`#table-upload-${id}`).append(html);
        }
        function removeUpload(baris,id){
            let rows = $(this).data(`row`);
            console.log(rows)
            console.log(baris,id)
            $('#baris' + baris+id).remove();
        }
    </script>
@endpush
