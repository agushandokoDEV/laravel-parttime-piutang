@extends('layouts.app')

@section('title') Surat Keputusan Gubernur @endsection

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
            <b>Form Surat Keputusan Gubernur</b>
        </div>
        <div class="card-body">
            <form action="{{url('/admin/keputusan')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pilih No Surat Usulan</label>
                            <select name="usulans_id" id="usulans_id" class="form-control @error('usulans_id') is-invalid @enderror">
                                <option value="">Pilih No Surat Usulan</option>
                                @foreach ($skpd as $item)
                                    @if ($item->nomor_surat != null && $item->keputusan->count() == 0)
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
                            <label for="">Nama Penanggung Utang</label>
                            <input type="text" name="no_skpd" id="no_skpd" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nomor Surat Keputusan Gubernur</label>
                            <input type="text" name="nomor_keputusan" id="nomor_keputusan" class="form-control @error('nomor_keputusan') is-invalid @enderror">
                            @error('nomor_keputusan')
                             <div class="invalid-feedback">
                                {{$message}}
                             </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Surat Keputusan Gubernur</label>
                            <input type="date" name="tgl_keputusan" id="tgl_keputusan" class="form-control @error('tgl_keputusan') is-invalid @enderror">
                            @error('tgl_keputusan')
                             <div class="invalid-feedback">
                                {{$message}}
                             </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Upload Surat Keputusan Gubernur</label>
                    <input type="file" name="docs_keputusan" accept="application/pdf" class="form-control @error('docs_keputusan') is-invalid @enderror">
                    @error('docs_keputusan')
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
    <script>
        $(function(){
            $("#usulans_id").val("{{ app('request')->input('no_surat') }}").trigger('change');
        })
    </script>
@endpush
