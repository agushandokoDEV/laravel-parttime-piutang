@extends('layouts.app')

@section('title') Berita Acara @endsection

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
            <b>Form Berita Acara</b>
        </div>
        <div class="card-body">
            <form action="{{url('/admin/berita-acara')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pilih No Surat Usulan</label>
                            <select name="usulans_id" id="usulans_id" class="form-control @error('usulans_id') is-invalid @enderror">
                                <option value="">Pilih No Surat Usulan</option>
                                @foreach ($skpd as $item)
                                    @if ($item->nomor_surat != null && $item->beritaAcara->count() == 0)
                                        <option value="{{$item->nomor_surat}}">{{$item->nomor_surat}}</option>
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
                            <label for="">Judul Berita Acara</label>
                            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror">
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Upload Dokumen Usulan</label>
                    <input type="file" name="docs_berita" accept="application/pdf" class="form-control @error('docs_berita') is-invalid @enderror">
                    @error('docs_berita')
                     <div class="invalid-feedback">
                        {{$message}}
                     </div>
                    @enderror
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('js/usulan_knkpl.js')}}"></script>

@endpush
