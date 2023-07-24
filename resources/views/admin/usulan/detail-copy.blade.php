@extends('layouts.app')

@section('title') Dokumen Surat Usulan Yang Terpenuhi & Tidak Terpenuhi @endsection

@push('css')

@endpush

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <b>Dokumen Surat Usulan Yang Terpenuhi & Tidak Terpenuhi</b>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-bordered table-striped" id="status" style="width: 100%;">
                <thead class="bg-primary text-white">
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
                        <td>Surat Tagihan / Dokumen yang dipersamakan</td>
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
                        <td>Dokumen Pendukung Lainnya</td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_kriteria->count() != 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_kriteria->count() == 0)
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

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya </b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="srksps">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($showFile as $item)
                                @forelse ($item->file_ID as $ID)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya</td>
                                        <td class="text-center">
                                            <a href="{{ asset('storage/surat/docs_ID/' . $ID->docs_ID) }}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- <tr>
                                        <td colspan="3" class="text-center">Belum Mengumpulkan Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya</td>
                                    </tr> --}}
                                @endforelse
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Surat Permohonan usulan penyerahan pengurusan piutang dari SKPD ke BPKD</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="bpkd">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($showFile[0]->docs_skdp != null)
                                @foreach ($showFile as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                                        <td class="text-center">
                                            <a href="{{asset('storage/surat/skdp/' . $item->docs_skdp)}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            {{-- @else
                                <tr>
                                    <td colspan="3" class="text-center">Belum Mengumpulka Dokumen Surat Permohonan usulan penyerahan pengurusan piutang dari SKPD ke BPKD	</td>
                                </tr> --}}
                           @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan </b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="skrd">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($showFile as $item)
                                @forelse ($item->file as $file)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->select_STS}}</td>
                                        <td class="text-center">
                                            <a href="{{asset('storage/surat/STS/' . $file->docs_STS)}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- <tr>
                                        <td colspan="3" class="text-center">Belum Mengumpulkan Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                                    </tr> --}}
                                @endforelse
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Surat Tagihan / Dokumen yang dipersamakan</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="usulkan">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($showFile as $item)
                                @forelse ($item->file_ST as $ST)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->select_ST}}</td>
                                        <td class="text-center">
                                            <a href="{{asset('storage/surat/ST/' . $ST->docs_ST)}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- <tr>
                                        <td colspan="3" class="text-center">Belum Mengumpulkan Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah</td>
                                    </tr> --}}
                                @endforelse
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="usulkan2">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($showFile as $item)
                                @forelse ($item->file_DL as $DL)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->select_DL}}</td>
                                        <td class="text-center">
                                            <a href="{{asset('storage/surat/DL/' . $DL->docs_DL)}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- <tr>
                                        <td colspan="3" class="text-center">Belum Mengumpulkan Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah 2</td>
                                    </tr> --}}
                                @endforelse
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen Lainnya</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover lainnya" style="width:100%;" id="lainnya">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($showFile[0]->file_kriteria->count() != 0)
                                @foreach ($showFile[0]->file_kriteria as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>Dokumen Pendukung Lainnya	</td>
                                        <td class="text-center">
                                            <a href="{{asset('storage/surat/kriteria_lainnya/' . $item->file)}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                           @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#srksps').DataTable();
        $('#bpkd').DataTable();
        $('#skrd').DataTable();
        $("#lainnya").DataTable();
        $('#usulkan').DataTable();
        $('#usulkan2').DataTable();
    });
</script>
@endpush
