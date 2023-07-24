@extends('layouts.app')

@section('title') Dashboard @endsection

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
        <form action="#">
            <div class="form-group">
                <label for="">Pilih No SKPD</label>
                <select name="users_id" id="users_id" class="form-control">
                    <option value="">Pilih No SKPD</option>
                    @foreach ($skpd as $item)
                    <option value="{{$item->id}}">{{$item->no_skpd}}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <b>Rekap Data Rincian Piutang Daerah Audited Tahun {{\Carbon\Carbon::now()->format('Y')}}</b>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped text-center nowrap" id="table">
                <thead class="text-white bg-secondary">
                    <tr>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">No</th>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">Nama SKPD</th>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">No SKRD / RUPS / Kepgub / STS / SPS / PKS / Surat perjanjian / Surat Perikatan atau Dokumen yang Dipersamakan</th>
                        <th colspan="7">Rincian Piutang</th>
                        <th colspan="4">Pengelolaan Kualitas Piutang</th>
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

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            searching: false,
            bPaginate: false,
            bInfo: false,
            ordering: false
        });

        $('#users_id').select2();

        $('#users_id').change(function(e) {
            e.preventDefault();
            let id = $(this).val();

            $.ajax({
                url: '/admin/dashboard/' + id,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    let html = '';
                    let no = 1;
                    $.each(response.data, function(key, val) {
                        if (val.no_skrd != null) {
                            html += `<tr>
                                    <td>${no++}</td>
                                    <td>${val.name}</td>
                                    <td>${val.no_skrd}</td>
                                    <td>${val.tgl_surat}</td>
                                    <td>${val.selisihTahun} Tahun</td>
                                    <td>${val.jenis}</td>
                                    <td>${val.nama_peminjam}</td>
                                    <td>${val.nilai_rincian}</td>
                                    <td>-</td>
                                    <td>${val.total_rincian}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>${val.total_rincian}</td>
                                </tr>`;
                        }else {
                            html += `<tr>
                                        <td colspan="14">No data available in table</td>
                                    </tr>`;
                        }
                    });
                    $('#show-table').html(html)
                },
                error: function(err) {
                    console.log(err);
                    let html = `<tr>
                                <td colspan="14">No data available in table</td>
                            </tr>`;;
                    $('#show-table').html(html)
                }
            })
        });
    });
</script>
@endpush
