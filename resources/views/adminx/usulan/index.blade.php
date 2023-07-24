@extends('layouts.app')
 
@section('title') Usulan @endsection

@push('css')
    <style>
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <form action="#" class="form-select">
                <div class="form-group">
                    <label for="">Pilih SKPD</label>
                    <select class="form-control" name="users_id" id="users_id">
                        <option value="">Pilih SKPD</option>
                        @foreach ($nasabah as $item)
                            <option value="{{$item->id}}">{{$item->no_skpd}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="width:100%;" id="usulan">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th>No SKPD</th>
                            <th>Nama SKPD</th>
                            <th>Penanggung Hutang</th>
                            <th class="text-center">Tanggal</th>
                            <th>Jenis Piutang</th>
                            <th class="text-center">Umur Piutang</th>
                            <th class="text-center">Pokok</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="piutangs">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('js/usulan.js')}}"></script>
@endpush