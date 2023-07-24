<?php $__env->startSection('title'); ?> Permohonan Usulan <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
<div class="alert alert-success">
    <?php echo e(session()->get('message')); ?>

</div>
<?php endif; ?>

<form action="<?php echo e(url('/nasabah/home/usulan/simpan')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<?php echo method_field('put'); ?>
<?php
$i=1;
?>
<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="card mb-3">
    <div class="card-header">
        <b><?php echo e($i++); ?>. Surat Permohoan Yang Harus Di Serahkan <?php echo e(Auth::user()->name); ?></b>
    </div>

    <div class="card-body">
        
        <input type="hidden" name="id[]" value="<?php echo e($item->id); ?>" />
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor Surat Permohonan</label>
                    <input type="text" name="nomor_surat[]"  class="form-control <?php $__errorArgs = ['no_skrd'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>
                <?php $__errorArgs = ['no_skrd'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">
                    <?php echo e($message); ?>

                </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Rincian/Perihal Dokumen</label>
                    <input type="text" name="rincian[]" class="form-control <?php $__errorArgs = ['rincian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['rincian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tanggal Usulan</label>
                    <input type="date" name="tgl_usulan[]" value="<?php echo e(date('Y-m-d')); ?>" class="form-control <?php $__errorArgs = ['tgl_usulan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['tgl_usulan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nilai Rincian</label>
                    <input type="text" name="nilai_rincian[]" value="<?php echo e(number_format($item->nilai_rincian, 0,'','.')); ?>" class="form-control <?php $__errorArgs = ['nilai_rincian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['nilai_rincian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Total Pengajuan </label>
                    <input type="text" readonly name="total_rincian[]" value="<?php echo e(number_format($total_rincian, 0,'','.')); ?>" class="form-control <?php $__errorArgs = ['total_rincian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['total_rincian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <font style="color:blue">*Total merupakan jumlah dari nilai rincian utang yang dipilih</font>
            </div>
            
        </div>
    </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<div style="margin-bottom: 70px;">
    <button type="submit" class="btn btn-primary float-right">Next</button>
</div>
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\Website\upwork\piutang\master\5\piutang-bpkd\resources\views/nasabah/usulan/v2/form_usulan.blade.php ENDPATH**/ ?>