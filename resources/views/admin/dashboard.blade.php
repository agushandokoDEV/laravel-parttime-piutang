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
<div class="row">
<!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span>Since last month</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>Since last years</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Since last month</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
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
