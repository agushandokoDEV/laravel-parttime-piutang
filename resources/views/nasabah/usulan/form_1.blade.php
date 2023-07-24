@extends('layouts.app')

@section('title') Surat Permohonan @endsection

@push('css')

@endpush

@section('content')
@if (session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
<div class="card mb-3">
    <div class="card-header">
        <b>Dokumen Yang Harus Di Serahkan {{Auth::user()->name}}</b>
    </div>
    <div class="card-body">
        <form action="{{url('/nasabah/usulan/surat')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" readonly value="{{Auth::user()->id}}" name="users_id">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nomor Surat Permohonan</label>
                        <input type="text" name="nomor_surat" disabled value="{{\App\Models\SuratUsulan::generateNoSurat()}}" class="form-control @error('nomor_surat') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Rincian/Perihal Dokumen</label>
                        <input type="text" name="rincian" value="{{old('rincian')}}" class="form-control @error('rincian') is-invalid @enderror">
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
                        <input type="date" name="tgl_surat" disabled value="{{date('Y-m-d')}}" class="form-control @error('tgl_surat') is-invalid @enderror">
                        @error('tgl_surat')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nilai Rincian</label>
                        <input type="text" name="nilai_rincian" id="nilai_rincian" value="{{old('nilai_rincian')}}" class="form-control @error('nilai_rincian') is-invalid @enderror">
                        @error('nilai_rincian')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Total</label>
                        <input type="text" disabled name="total_rincian" id="total_rincian" value="{{old('nilai_rincian')}}" class="form-control @error('total_rincian') is-invalid @enderror">
                        @error('total_rincian')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <label for="">Surat permohonan usulan penyerahan pengurusan piutang dari SKDP ke BPKD beserta lampiran daftar usulan Piutang Daerah dalam atau daftar usulan pengurusan piutang daerah dalam rangka Penghapusan Piutang Daerah Koperasi Jasa Keuangan(Sesuai format lampiran A,B, dan C Pergub 148 Tahun 2018)</label>
                <input type="file" name="docs_skdp" class="form-control @error('docs_skdp') is-invalid @enderror">
                @error('docs_skdp')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div> -->
            <div class="my-3">
                <button type="submit" class="btn btn-primary float-right">Next</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#nilai_rincian').on('input', function() {
            var rupiah = $(this).val();
            rupiah = rupiah.replace(/\./g, '');
            rupiah = formatRupiah(rupiah);
            $(this).val(rupiah);

            $("#total_rincian").val(rupiah)
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
            return prefix === undefined ? rupiah : rupiah ? 'Rp. ' + rupiah : '';
        }
    });
</script>
@endpush
