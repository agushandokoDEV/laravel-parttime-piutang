@extends('layouts.app')

@section('title') Dokumen Surat Usulan Yang Terpenuhi & Tidak Terpenuhi @endsection

@push('css')

@endpush

@section('content')
@if (session()->has('message'))
<div class="alert alert-success">
    <b>{{session()->get('message')}}</b>
</div>
@elseif (session()->has('err'))
<div class="alert alert-danger">
    <b>{{session()->get('err')}}</b>
</div>
@endif
<div class="card mb-3">
    <div class="card-header">
        <b>Dokumen Surat Usulan Yang Terpenuhi & Tidak Terpenuhi</b>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-bordered table-hover" id="status" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Daftar Dokumen Yang Di Serahkan</th>
                        <th class="text-center">Terpenuhi</th>
                        <th class="text-center">Tidak Terpenuhi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count() > 0)
                    <tr>
                        <td class="text-center">1</td>
                        <td>Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya</td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_ID->count() != 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_ID->count() == 0)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Surat Permohonan usulan penyerahan pengurusan piutang dari SKPD ke BPKD</td>
                        <td class="text-center"><input type="checkbox" @if ($data->docs_skdp != null)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->docs_skdp == null)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                        <td class="text-center"><input type="checkbox" @if ($data->file->count() != 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->file->count() == 0)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah</td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_ST->count() != 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_ST->count() == 0)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah</td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_DL->count() != 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_DL->count() == 0)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td>Dokumen Lainnya</td>
                        <td class="text-center"><input type="checkbox" @if ($data->docs_lainnya != null)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->docs_lainnya == null)
                            checked
                            @endif></td>
                    </tr>
                    @else
                    <tr>
                        <td class="text-center" colspan="5">Bekum Ada Usulan Yang Di Validasi Admin</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@if ($data->file_ID->count() == 0 || $data->docs_skdp == null || $data->file->count() == 0 || $data->file_ST->count() == 0 || $data->file_DL->count() == 0 || $data->docs_lainnya == null)
<div class="card mb-3">
    <div class="card-header">
        <b>Form Upload Kekurangan Dokumen Surat Permohonan</b>
    </div>
    <div class="card-body">
        <form action="{{url('/nasabah/status-usulan/dokumen/' . $data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="usulans_id" value="{{$data->id}}">
            <!-- document ID -->
            @if ($data->file_ID->count() == 0)
            <div class="form-group">
                <label for="">Fotocopy KTP/Identitas Perusahaan/Identitas Lainnya</label>
                <input type="file" class="form-control @error('docs_ID') is-invalid @enderror" name="docs_ID">
                @error('docs_ID')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            @endif
            <!-- document ID -->

            <!-- document skdp -->
            @if ($data->docs_skdp == null)
            <div class="form-group">
                <label for="">Surat permohonan usulan penyerahan pengurusan piutang dari SKDP ke BPKD beserta lampiran daftar usulan Piutang Daerah dalam atau daftar usulan pengurusan piutang daerah dalam rangka Penghapusan Piutang Daerah Koperasi Jasa Keuangan(Sesuai format lampiran A,B, dan C Pergub 148 Tahun 2018)</label>
                <input type="file" class="form-control @error('docs_skdp') is-invalid @enderror" name="docs_skdp">
                @error('docs_skdp')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            @endif
            <!-- document skdp -->

            <!-- document STS -->
            @if ($data->file->count() == 0)
            <div class="form-group">
                <label for="">Upload Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</label>
                <input type="file" class="form-control @error('docs_STS') is-invalid @enderror" name="docs_STS">
                @error('docs_STS')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            @endif
            {{-- end document STS --}}

            <!-- document ST -->
            @if ($data->file_ST->count() == 0)
            <div class="form-group">
                <label for="">Upload Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah sebagai berikut</label>
                <input type="file" class="form-control @error('docs_ST') is-invalid @enderror" name="docs_ST">
                @error('docs_ST')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            @endif
            <!-- document ST -->

            <!-- document DL -->
            @if ($data->file_DL->count() == 0)
            <div class="form-group">
                <label for="">Upload Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah sebagai berikut</label>
                <input type="file" class="form-control @error('docs_DL') is-invalid @enderror" name="docs_DL">
                @error('docs_DL')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            @endif
            <!-- document DL -->

            <!-- document lainnya -->
            @if ($data->docs_lainnya == null)
            <div class="form-group">
                <label for="">Upload Dokumen lainnya</label>
                <input type="file" class="form-control @error('docs_lainnya') is-invalid @enderror" name="docs_lainnya">
                @error('docs_lainnya')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            @endif
            <!-- document lainnya -->

            <div class="btn-send my-2">
                <button type="submit" class="btn btn-primary float-right">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // $('#status').DataTable();
    });
</script>
@endpush
