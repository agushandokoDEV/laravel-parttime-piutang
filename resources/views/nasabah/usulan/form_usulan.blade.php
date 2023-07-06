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
        <b>Dokumen Yang Harus Di Serahkan</b>
    </div>
    <div class="card-body">
        <form action="{{url('/nasabah/home/update/' . $data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nomor Surat Permohonan</label>
                        <input type="text" name="nomor_surat" value="{{\App\Models\SuratUsulan::generateNoSurat()}}" class="form-control @error('no_skrd') is-invalid @enderror">
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
                        <input type="text" name="rincian" value="{{$data->rincian}}" class="form-control @error('rincian') is-invalid @enderror">
                        @error('rincian')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tgl_surat" value="{{date('Y-m-d')}}" class="form-control @error('tgl_surat') is-invalid @enderror">
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
                        <input type="text" name="nilai_rincian" id="nilai_rincian" value="{{number_format($data->nilai_rincian, 0,'','.')}}" class="form-control @error('nilai_rincian') is-invalid @enderror">
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
                        <input type="text" readonly name="total_rincian" id="total_rincian" value="{{number_format($data->nilai_rincian, 0,'','.')}}" class="form-control @error('total_rincian') is-invalid @enderror">
                        @error('total_rincian')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-primary float-right">Next</button>
            </div>
        </form>
    </div>
</div>
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
