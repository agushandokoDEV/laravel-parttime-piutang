@extends('layouts.app')

@section('title') Pembayaran Piutang @endsection

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
@if(session()->has('success'))
<div class="alert alert-success">
    {{session()->get('success')}}
</div>
@endif
<div class="card">
    <div class="card-header">
        <b>Pembayaran Piutang {{Auth::user()->name}}</b>
    </div>
    <div class="card-body">
        <form action="{{url('/nasabah/pembayaran')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Pilih No SKRD</label>
                <select name="usulans_id" id="usulans_id" class="form-control @error('usulans_id') is-invalid @enderror">
                    <option value="">Pilih No SKRD</option>
                    @foreach($skrd as $item)
                        <option value="{{$item->id}}">{{$item->no_skrd}}</option>
                    @endforeach
                </select>
                @error('usulans_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div id="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Penanggung Jawab</label>
                            <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control @error('penanggung_jawab') is-invalid @enderror">
                            @error('penanggung_jawab')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Total Piutang</label>
                            <input type="text" name="total_piutang" id="total_piutang" class="form-control">
                        </div>
                    </div>
                    <!-- pembayaran -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Pembayaran</label>
                            <input type="date" name="tgl_bayar" class="form-control @error('tgl_bayar') is-invalid @enderror">
                            @error('tgl_bayar')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Total Pembayaran</label>
                            <input type="text" name="nominal_bayar" id="nominal_bayar" class="form-control @error('nominal_bayar') is-invalid @enderror">
                            @error('nominal_bayar')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Dokumen Pembayaran</label>
                            <input type="file" name="docs_bayar" class="form-control @error('docs_bayar') is-invalid @enderror">
                            @error('docs_bayar')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" id="bayar" class="btn btn-primary float-right">Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $('#nominal_bayar').on('keyup', function() {
            var rupiah = $(this).val();
            rupiah = formatRupiah(rupiah, 'Rp. ');
            $(this).val(rupiah);
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : rupiah ? rupiah : '';
        }

        $('#hidden').hide();
        $("#usulans_id").select2();
        $('#usulans_id').change(function(e) {
            let id = $(this).val();
            $.ajax({
                url: '/json/usulanById/' + id,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#total_piutang').val(response.total_rincian);
                    $('#penanggung_jawab').val(response.nama_peminjam);
                },
                error: function(err) {
                    $('#hidden').hide();
                }
            })
        });

    });
</script>
@endpush
