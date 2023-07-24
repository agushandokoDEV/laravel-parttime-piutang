<?php $__env->startSection('title'); ?> Dokumen yang diserahkan <?php echo e(Auth::user()->name); ?>  <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
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
<link rel="stylesheet" href="<?php echo e(asset('vendor/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<form action="<?php echo e(url('/nasabah/surat-usulan/step3')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<?php
$i=1;
?>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" name="id[]" value="<?php echo e($item->id); ?>" />

<div class="card mb-3">
    <div class="card-header">
        <b><?php echo e($i++); ?>.Surat Tagihan/Dokumen yang dipersamakan</b>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor SKRD/Dokumen yang dipersamakan</label>
                    <input type="text" name="nomor_surat[]" value="<?php echo e($item->no_skrd); ?>" readonly class="form-control <?php $__errorArgs = ['nomor_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>
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
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tanggal Dokumen</label>
                    <input type="date" name="tgl_surat[]" readonly value="<?php echo e($item->tgl_surat); ?>" class="form-control <?php $__errorArgs = ['tgl_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nilai Rincian</label>
                    <input type="text" name="nilai_rincian[]" readonly id="nilai_rincian" value="<?php echo e(number_format($item->nilai_rincian,0,'','.')); ?>" class="form-control <?php $__errorArgs = ['nilai_rincian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Total</label>
                    <input type="text" disabled name="total_rincian[]" value="<?php echo e(number_format($item->total_rincian,0,'','.')); ?>" class="form-control <?php $__errorArgs = ['total_rincian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <font style="color:blue">*Total merupakan jumlah dari nilai rincian utang yang dipilih</font>
                </div>
            </div>

            <div class="col-md-12"> 
                <?php $__currentLoopData = $surat_tagihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_tagihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e($item_tagihan->nama); ?> :</label>
                    <div class="col-sm-3">
                        <input type="text" name="tagihan[<?php echo e($item->id); ?>][<?php echo e($item_tagihan->id); ?>][nomor]" class="form-control" placeholder="Nomor">
                    </div>
                    <div class="col-sm-3">
                        <input type="date" name="tagihan[<?php echo e($item->id); ?>][<?php echo e($item_tagihan->id); ?>][tgl]" class="form-control" placeholder="Tanggal">
                    </div>
                    <div class="col-sm-3">
                        <input type="file" name="tagihan[<?php echo e($item->id); ?>][<?php echo e($item_tagihan->id); ?>][dok]" accept="application/pdf" class="form-control">
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <hr/>
        
        

    </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="my-3">
        <a href="<?php echo e(url('nasabah/usulan/surat/next/')); ?>" type="submit" id="back" class="btn btn-secondary float-start"><i class="fas fa-arrow-left"></i> Back</a>
        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-arrow-right"></i> Next</button>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('vendor/select2/dist/js/select2.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('.select_ST').select2();
            let baris = 1;
            $(document).on('click', '.plusx', function(e) {
                e.preventDefault();
                baris = baris + 1;
                let html = '<tr id="baris' + baris + '">';
                html += `<th>
                                <button type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                                <input type="file" name="docs_ST[<?php echo e($item->id); ?>][]" accept="application/pdf" class="form-control <?php $__errorArgs = ['docs_ST'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> my-2" style="width: 100%;">
                            </th>`;
                html += '</tr>';
                $('#table').append(html);
            });

            $(document).on('click', '.minusx', function(e) {
                let rows = $(this).data('row');
                $('#' + rows).remove();
            });
        });


        function addUpload(id){
            let baris = 1;
            baris = baris + 1;
            let html = `<tr id="baris${baris}${id}">`;
            html += `<th>
                            <button onclick="removeUpload('${baris}','${id}')" type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                            <input type="file" name="docs_STS[${id}][]" accept="application/pdf" class="form-control <?php $__errorArgs = ['docs_STS'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> my-2" style="width: 100%;">
                        </th>`;
            html += '</tr>';
            $(`#table-upload-${id}`).append(html);
        }
        function removeUpload(baris,id){
            let rows = $(this).data(`row`);
            console.log(rows)
            console.log(baris,id)
            $('#baris' + baris+id).remove();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\Website\upwork\piutang\master\5\piutang-bpkd\resources\views/nasabah/usulan/v2/form_3.blade.php ENDPATH**/ ?>