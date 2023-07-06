@extends('layouts.app')

@section('title') Home @endsection

@push('css')

@endpush

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <b>Rekap Data Rincian Piutang Daerah Audited Tahun {{\Carbon\Carbon::now()->format('Y')}}</b>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped text-center nowrap" id="home">
                <thead class="text-white bg-primary">
                    <tr>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">No</th>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">Nama SKPD</th>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">No SKRD / RUPS / Kepgub / STS / SPS / PKS / Surat perjanjian / Surat Perikatan atau Dokumen yang Dipersamakan</th>
                        <th colspan="7">Rincian Piutang</th>
                        <th colspan="4">Pengelolaan Kualitas Piutang</th>
                        <th rowspan="3">Status</th>
                        <th rowspan="3">Action</th>
                    </tr>
                    <tr>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Tanggal</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Umur</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Jenis</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Penanggung</th>
                        <th colspan="3">Nilai</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Lancar</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Kurang</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Diragukan</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Macet</th>
                    </tr>
                    <tr>
                        <th>Pokok</th>
                        <th>Denda</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="show-table">
                    @if ($skpd[0]->users_id != null)
                        @foreach ($skpd as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->no_skrd}}</td>
                                <td>{{$item->tgl_surat}}</td>
                                <td>{{$item->selisihTahun}} Tahun</td>
                                <td>{{$item->jenisPiutang->jenis}}</td>
                                <td>{{$item->nama_peminjam}}</td>
                                <td>{{$item->nilai_rincian}}</td>
                                <td>-</td>
                                <td>{{$item->total_rincian}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{$item->total_rincian}}</td>
                                <td>
                                    @if ($item->status == 'validate')
                                        <div class="span badge bg-success text-white p-2">Validasi</div>
                                    @elseif ($item->status == 'proses')
                                        <div class="span badge bg-warning text-white p-2">Prosess</div>
                                    @else
                                        <div class="span badge bg-danger text-white p-2">Belum Mengusulkan</div>
                                    @endif
                                </td>
                                @if ($item->status == 'validate' || $item->status == 'proses')
                                    <td>
                                        <input type="checkbox" disabled name="usulans_id" class="checkbox" data-id="{{$item->id}}" data-name="{{$item->nama_peminjam}}">
                                    </td>
                                @else
                                    <td>
                                        <input type="checkbox" name="usulans_id" class="checkbox" data-id="{{$item->id}}" data-name="{{$item->nama_peminjam}}">
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot class="text-white bg-primary">
                    <tr>
                        <th colspan="9">Jumlah</th>
                        <th colspan="6">Rp.{{number_format($sumSkpd)}}</th>
                        <th>
                            <button class="btn btn-secondary" id="add"><i class="fas fa-plus"></i> Tambah Data Usulan</button>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#home').DataTable({
            searching: false,
            bPaginate: false,
            bInfo: false,
            ordering: false
        });

        $('#add').click(function(e) {
            e.preventDefault();
            var selectedIds = [];
            var selectednames = [];

            $('.checkbox:checked').each(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                selectedIds.push(id);
                selectednames.push(name);
                
            });

            if (selectedIds.length == 0) {
                alert('Silahkan Pilih Salah Satu SKRD')
            } else if(selectedIds.length > 1) {
                //alert('Pilih salah satu SKRD')
                const same_value= selectednames.every( (val, i, arr) => val === arr[0] );
                if(!same_value){
                    alert('Harap pilih nama penanggung harus sama');
                    selectedIds=[];
                    selectednames=[];
                    $('.checkbox').prop('checked',false)
                }else{
                    window.location.href = '/nasabah/home/usulan?id=' + selectedIds.join(',');
                }
            } else {
                //console.log('OK')
                // window.location.href = '/nasabah/home/getUsulan/' + selectedIds;
                window.location.href = '/nasabah/home/usulan?id=' + selectedIds.join(',');
            }
        });
    });
</script>
@endpush
