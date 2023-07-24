<?php $__env->startSection('title'); ?> Usulan <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
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
    <link rel="stylesheet" href="<?php echo e(asset('vendor/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-success">
            <?php echo e(session()->get('message')); ?>

        </div>
    <?php endif; ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center nowrap" style="width:100%;" id="usulan">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>No SKRD</th>
                            <th>No Usulan</th>
                            <th>Penanggung Hutang</th>
                            <th>Tanggal</th>
                            <th>Jenis Piutang</th>
                            <th>Pokok</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $piutang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->no_skrd); ?></td>
                                <td><?php echo e($item->nomor_surat); ?></td>
                                <td><?php echo e($item->nama_peminjam); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d-F-Y')); ?></td>
                                <td><?php echo e($item->jenisPiutang->jenis); ?></td>
                                <td>Rp.<?php echo e(number_format($item->nilai_rincian, 0,'','.')); ?></td>
                                <td>
                                    <?php if($item->status == 'validate'): ?>
                                        <span class="badge bg-success p-2 text-white">Di Terima</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning p-2 text-white">Pengajuan</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(url('/admin/detail-usulan/'.$item->id)); ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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
    <script src="<?php echo e(asset('vendor/select2/dist/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/usulan.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\Website\upwork\piutang\vinensia-piutang\resources\views/admin/usulan/index.blade.php ENDPATH**/ ?>