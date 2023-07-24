<?php $__env->startSection('title'); ?> Laporan <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3">
    <div class="card-header">
        <a href="<?php echo e(url('/admin/laporan/export')); ?>" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i></a>
        <a href="<?php echo e(url('/admin/laporan/cetak')); ?>" class="btn btn-danger btn-sm" target="__blank"><i class="fas fa-print"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover dt-responsive nowrap" id="laporan" style="width: 100%">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2" class="bg-warning text-white">Nama</th>
                        <th colspan="3" class="bg-warning text-white">Usulan Ke BPKD</th>
                        <th colspan="3" class="bg-info text-white">Rincian Piutang</th>
                        <th rowspan="2" class="bg-info text-white">Berita Acara</th>
                        
                    </tr>
                    <tr>
                        <th class="bg-warning text-white">Jenis</th>
                        <th class="bg-warning text-white">Tanggal</th>
                        <th class="bg-warning text-white">Nomor</th>
                        <th class="bg-info text-white">Pokok</th>
                        <th class="bg-info text-white">Denda</th>
                        <th class="bg-info text-white">Total</th>
                        <th class="bg-success text-white">Pengguna :</th>
                        <th class="bg-success text-white">Tanggal Usulan PUPN :</th>
                        <th class="bg-success text-white">Nomor Usulan PUPN : </th>
                        <th class="bg-success text-white">Tanggal Balasan PUPN : </th>
                        <th class="bg-success text-white">Nomor Balasan PUPN : </th>
                        <th class="bg-danger text-white">Tanggal Pembayaran : </th>
                        <th class="bg-danger text-white">Nilai Pembayaran : </th>
                        <th class="bg-primary text-white">Tanggal Keputusan Gubernur : </th>
                        <th class="bg-primary text-white">Nomor Keputusan Gubernur : </th>
                        <th class="bg-primary text-white">Status : </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piutang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $dueDate = \Carbon\Carbon::parse($piutang->tgl_surat);
                            $currDate = \Carbon\Carbon::now();

                            $year = $currDate->diffInYears($dueDate);
                            $denda = 50000;
                            $total_denda = $year * $denda;
                        ?>
                        <tr>
                            <td><?php echo e($piutang->nama_peminjam); ?></td>
                            <td><?php echo e($piutang->jenis); ?></td>


                            <?php if($piutang->tgl_surat != null): ?>
                                <td><?php echo e(\Carbon\Carbon::parse($piutang->tgl_surat)->translatedFormat('d-F-Y')); ?></td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                            

                            <td><?php echo e($piutang->nomor_surat); ?></td>
                            <td><?php echo e(number_format($piutang->nilai_rincian,0,'','.')); ?></td>
                            <td></td>
                            <td><?php echo e(number_format($piutang->total_rincian,0,'','.')); ?></td>
                            <td><?php echo e($piutang->judul); ?></td>

                            <td><?php echo e($piutang->name); ?></td>
                            <?php if($piutang->tgl_knkpl != null): ?>
                                <td><?php echo e(\Carbon\Carbon::parse($piutang->tgl_knkpl)->translatedFormat('d-F-Y')); ?></td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>

                            <td><?php echo e($piutang->nomor_knkpl); ?></td>

                            
                            <?php if($piutang->tgl_balasan != null): ?>
                                <td><?php echo e(\Carbon\Carbon::parse($piutang->tgl_balasan)->translatedFormat('d-F-Y')); ?></td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>

                            <td><?php echo e($piutang->nomor_balasan); ?></td>
                            
                            <?php if($piutang->tgl_bayar != null): ?>
                                <td><?php echo e(\Carbon\Carbon::parse($piutang->tgl_bayar)->translatedFormat('d-F-Y')); ?></td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                            <td><?php echo e(number_format($piutang->nominal_bayar,0,'','.')); ?></td>

                            
                            <?php if($piutang->tgl_keputusan != null): ?>
                                <td><?php echo e(\Carbon\Carbon::parse($piutang->tgl_keputusan)->translatedFormat('d-F-Y')); ?></td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                            
                            <td><?php echo e($piutang->nomor_keputusan); ?></td>
                            <td>
                                <?php if($piutang->count_sts > 0 && $piutang->count_st > 0 && $piutang->count_dl > 0): ?>
                                    <span class="badge badge-success p-2">Terpenuhi</span>
                                <?php else: ?>
                                    <span class="badge badge-danger p-2">Tidak Terpenuhi</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#laporan').DataTable();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\Website\upwork\piutang\master\5\piutang-bpkd\resources\views/admin/laporan.blade.php ENDPATH**/ ?>