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
<div class="card mb-3">
    <div class="card-header">
        <b>Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah </b>
    </div>
    <div class="card-body">
        <form action="{{url('/nasabah/surat-usulan/step6')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ app('request')->input('id') }}" />
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nomor Surat Usulan</label>
                        <input type="text" name="nomor_surat" value="{{$data->nomor_surat}}" readonly class="form-control @error('nomor_surat') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Rincian/Perihal Dokumen</label>
                        <input type="text" name="rincian"  class="form-control @error('rincian') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal Usulan</label>
                        <input type="date" name="tgl_usulan" disabled value="{{$data->tgl_usulan}}" class="form-control @error('tgl_usulan') is-invalid @enderror">
                    </div>
                </div>
                {{--<div class="col-md-6">
                    <div class="form-group">
                        <label for="">Total Utang</label>
                        <input type="text" name="nilai_rincian" readonly id="nilai_rincian" value="{{number_format($data->nilai_rincian, 0, '', '.')}}" class="form-control @error('nilai_rincian') is-invalid @enderror">
                    </div>
                </div>--}}
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Total</label>
                        <input type="text" disabled name="total_rincian" id="total_rincian" value="{{number_format($total_rincian, 0, '', '.')}}" class="form-control @error('total_rincian') is-invalid @enderror">
                    </div>
                </div> --}}
            </div>
            <div class="form-group">
                <label for="inputState" class="form-label"></label>
                <select name="select_kriteria[]" id="select_kriteria" multiple class="form-control @error('select_kriteria') is-invalid @enderror">
                    <option>Wajib retribusi/Wajib Bayar Penanggung Utang/Debitur tidak melakukan pelunasan 1(satu) bulan setelah tanggal surat Tagihan Ketiga</option>
                    <option>Wajib Retribusi/Wajib Bayar Penanggung Utang/Debitur meninggal dunia dengan tidak meninggalkan harta warisan dan tidak mempunyai ahli waris dan tidak mempunyai ahli waris yang dibuktikan dengan surat keterangan kematian dari pejabat yang berwenang </option>
                    <option>Wajib Retribusi /Wajib Bayar Penanggung Utang/Debitur tidak mempunyai harta kekayaan lagi yang dinyatakan dalam surat keterangan tidak mampu/miskin dari pejabat yang berwenang</option>
                    <option>Wajib bayar dinyatakan pailit berdasarkan putusan pengadilan dan hasil penjualan harta tidak mencukupi untuk melunasi utang yang dibuktikan dengan surat keputusan pengadilan  </option>
                    <option>Wajib bayar retribusi/wajib bayar Penangung Utang/Debitur terkena bencana alam yang tidak dapat dihindari berdasarkan kejadian nyata dan diperkuat dengan pernyatandan instansi yang berwenang </option>
                    <option>Dokumen sebagai dasar penagihan tidak ditemukan dikarenakan force majeure </option>
                    <option>Hak Negara untuk melakukan penagihan tidak dapat dilaksanakan karena kondisi tertentu sehubungan dengan adanya perubahan kebijakan dan atau berdasarkan pertimbangan yang ditetapkan oleh Gubernur dan atau</option>
                    <option>Wajib retribusi/Wajib Bayar Penangung Utang/Debitur tidak dapat diketemukan lagi karena wajib Retribusi/Wajib Bayar/Penangung Utang /Debitur tidak dapat diketemukan lagi dan/atau Objek dalam keadaan berat atau musnah sehingga sudah tidak bisa dimanfaatkan dan digunakan lagi dan/atau objek hilang yang dibuktikan dengan surat keterangan dari kepolisian </option>
                </select>
                @error('select_kriteria')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="formFileMultiple" class="form-label">Upload Dokumen pendukung lainnya </label>
                <br>
                <button type="button" class="btn btn-success btn-sm plus"><i class="fas fa-plus"></i></button>
                <table style="width: 100%;" id="table">
                    <tr>
                        <th>
                            <input type="file" name="file[]" id="file" accept="application/pdf" multiple class="form-control @error('docs_kriteria_lainnya') is-invalid @enderror my-2" style="width: 100%;">
                            @error('docs_kriteria_lainnya')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </th>
                    </tr>
                </table>
            </div>
            <div class="my-3">
                <a href="{{url('/nasabah/surat-usulan/step4=')}}{{ app('request')->input('id') }}" type="submit" id="back" class="btn btn-secondary float-start"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-arrow-right"></i> Next</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#select_kriteria').select2();

            let baris = 1;
            $(document).on('click', '.plus', function(e) {
                e.preventDefault();
                baris = baris + 1;
                let html = '<tr id="baris' + baris + '">';
                html += `<th>
                                <button type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                                <input type="file" name="file[]" accept="application/pdf" multiple class="form-control @error('docs_ST') is-invalid @enderror my-2" style="width: 100%;">
                            </th>`;
                html += '</tr>';
                $('#table').append(html);
            });

            $(document).on('click', '.minus', function(e) {
                let rows = $(this).data('row');
                $('#' + rows).remove();
            });
        });
    </script>
@endpush
