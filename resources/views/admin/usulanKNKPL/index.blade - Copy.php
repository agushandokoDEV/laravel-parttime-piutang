@extends('layouts.app')

@section('title') Surat ke PUPN @endsection

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
            <b>Form Surat ke PUPN</b>
        </div>
        <div class="card-body">
            <form action="{{url('/admin/usulan-knkpl')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="status" value="validate" id="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pilih Surat Usulan SKPD</label>
                            <select name="usulans_id" id="usulans_id" class="form-control @error('usulans_id') is-invalid @enderror">
                                <option value="">Pilih Surat Usulan</option>
                                @foreach ($skpd as $item)
                                    @if ($item->nomor_surat != null && $item->usulanKnkpl->count() == 0)
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
                            <label for="">Penanggung Piutang</label>
                            <input type="text" name="no_skpd" id="no_skpd" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nomor Surat ke PUPN</label>
                            <input type="text" value="{{\App\Models\SuratUsulanKNKPL::generateKnkpl()}}" name="nomor_knkpl" id="nomor_knkpl" class="form-control @error('nomor_knkpl') is-invalid @enderror">
                            @error('nomor_knkpl')
                             <div class="invalid-feedback">
                                {{$message}}
                             </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Surat Usulan</label>
                            <input type="date" name="tgl_knkpl" id="tgl_knkpl" class="form-control @error('tgl_knkpl') is-invalid @enderror">
                            @error('tgl_knkpl')
                             <div class="invalid-feedback">
                                {{$message}}
                             </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Upload Dokumen Usulan</label>
                    <input type="file" name="docs_knkpl" accept="application/pdf" class="form-control @error('docs_knkpl') is-invalid @enderror">
                    @error('docs_knkpl')
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
