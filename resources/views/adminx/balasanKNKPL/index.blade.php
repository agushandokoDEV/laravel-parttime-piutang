@extends('layouts.app')

@section('title') Surat Balasan KNKPL @endsection

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
@if (session()->has('message'))
<div class="alert alert-success">
    <b>{{session()->get('message')}}</b>
</div>
@endif
<div class="card mb-3">
    <div class="card-header">
        <b>Form Surat Balasan KNKPL</b>
    </div>
    <div class="card-body">
        <form action="{{url('/admin/balasan-knkpl')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="users_id" id="users_id">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Pilih No Surat Usulan</label>
                        <select name="usulans_id" id="usulans_id" class="form-control @error('usulans_id') is-invalid @enderror">
                            <option value="">Pilih No Surat Usulan</option>
                            @foreach ($skpd as $item)
                                @if ($item->nomor_surat != null)
                                    <option value="{{$item->id}}">{{$item->nomor_surat}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('usulans_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Penanggung Piutang</label>
                        <input type="text" name="no_skpd" id="no_skpd" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nomor Surat Balasan</label>
                        <input type="text" value="{{\App\Models\SuratBalasanKNKPL::generateBalasan()}}" name="nomor_balasan" id="nomor_balasan" class="form-control @error('nomor_balasan') is-invalid @enderror">
                        @error('nomor_balasan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Surat Usulan</label>
                        <input type="date" name="tgl_balasan" id="tgl_balasan" class="form-control @error('tgl_balasan') is-invalid @enderror">
                        @error('tgl_balasan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Upload Dokumen Usulan</label>
                <input type="file" name="docs_balasan" class="form-control @error('docs_balasan') is-invalid @enderror">
                @error('docs_balasan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Pesan</label>
                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" cols="20" rows="10"></textarea>
                @error('message')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <hr>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('js/usulan_knkpl.js')}}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#message'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
