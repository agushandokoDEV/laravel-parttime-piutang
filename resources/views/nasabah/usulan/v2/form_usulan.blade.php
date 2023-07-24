@extends('layouts.app')

@section('title') Permohonan Usulan @endsection

@push('css')

@endpush

@section('content')
@if (session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif

<form action="{{url('/nasabah/home/usulan/simpan')}}" method="POST" enctype="multipart/form-data">
@csrf
@method('put')
@php
$i=1;
@endphp
@foreach($list as $item)
<div class="card mb-3">
    <div class="card-header">
        <b>{{$i++}}. Surat Permohoan Yang Harus Di Serahkan {{Auth::user()->name}}</b>
    </div>

    <div class="card-body">
        {{-- <input type="hidden" name="id" value="{{ app('request')->input('id') }}" /> --}}
        <input type="hidden" name="id[]" value="{{ $item->id}}" />
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor Surat Permohonan</label>
                    <input type="text" name="nomor_surat[]"  class="form-control @error('no_skrd') is-invalid @enderror">
                </div>
                @error('no_skrd')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Rincian/Perihal Dokumen</label>
                    <input type="text" name="rincian[]" class="form-control @error('rincian') is-invalid @enderror">
                    @error('rincian')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tanggal Usulan</label>
                    <input type="date" name="tgl_usulan[]" value="{{date('Y-m-d')}}" class="form-control @error('tgl_usulan') is-invalid @enderror">
                    @error('tgl_usulan')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nilai Rincian</label>
                    <input type="text" name="nilai_rincian[]" value="{{number_format($item->nilai_rincian, 0,'','.')}}" class="form-control @error('nilai_rincian') is-invalid @enderror">
                    @error('nilai_rincian')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Total Pengajuan </label>
                    <input type="text" readonly name="total_rincian[]" value="{{number_format($total_rincian, 0,'','.')}}" class="form-control @error('total_rincian') is-invalid @enderror">
                    @error('total_rincian')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <font style="color:blue">*Total merupakan jumlah dari nilai rincian utang yang dipilih</font>
            </div>
            
        </div>
    </div>
</div>

@endforeach


<div style="margin-bottom: 70px;">
    <button type="submit" class="btn btn-primary float-right">Next</button>
</div>
</form>

@endsection

@push('js')
<script>
    // $(document).ready(function() {
    //     $('#nilai_rincian').on('input', function() {
    //         var rupiah = $(this).val();
    //         rupiah = rupiah.replace(/\./g, '');
    //         rupiah = formatRupiah(rupiah);
    //         $(this).val(rupiah);

    //         $("#total_rincian").val(rupiah)
    //     });

    //     function formatRupiah(angka, prefix) {
    //         var number_string = angka.replace(/[^,\d]/g, '').toString(),
    //             split = number_string.split(','),
    //             sisa = split[0].length % 3,
    //             rupiah = split[0].substr(0, sisa),
    //             ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    //         if (ribuan) {
    //             separator = sisa ? '.' : '';
    //             rupiah += separator + ribuan.join('.');
    //         }

    //         rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    //         return prefix === undefined ? rupiah : rupiah ? 'Rp. ' + rupiah : '';
    //     }
    // });
</script>
@endpush
