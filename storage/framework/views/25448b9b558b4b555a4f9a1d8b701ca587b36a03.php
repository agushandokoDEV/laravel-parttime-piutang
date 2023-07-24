<?php $__env->startSection('title'); ?> Dokumen yang diserahkan <?php echo e(Auth::user()->name); ?> <?php $__env->stopSection(); ?>

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
<?php if(session()->has('message')): ?>
<div class="alert alert-info">
    <b><?php echo e(session()->get('message')); ?></b>
</div>
<?php endif; ?>

<form action="<?php echo e(url('/nasabah/surat-usulan/step2')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<?php
$i=1;
?>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" name="id[]" value="<?php echo e($item->id); ?>" />
<div class="card mb-3">
    <div class="card-header">
        <b><?php echo e($i++); ?>.SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</b>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">No Dokumen</label>
                    <input type="text" readonly name="nomor_surat[]" class="form-control" value="<?php echo e($item->no_skrd); ?>">
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
                    <label for="">Tanggal Dokumen</label>
                    <input type="date" name="tgl_surat[]" value="<?php echo e($item->tgl_surat); ?>" readonly class="form-control <?php $__errorArgs = ['tgl_surat'];
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
                    <label for="">Nilai Piutang</label>
                    <input type="text" name="nilai_rincian[]" value="<?php echo e(number_format($item->nilai_rincian,0,'','.')); ?>" readonly id="nilai_rincian" class="form-control <?php $__errorArgs = ['nilai_rincian'];
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
                    <label for="">Total Pengajuan</label>
                    <input type="text" readonly name="total_rincian[]" value="<?php echo e(number_format($item->total_rincian,0,'','.')); ?>" id="total_rincian" class="form-control <?php $__errorArgs = ['total_rincian'];
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
        </div>
        <div class="form-group">
            <select name="select_STS[<?php echo e($item->id); ?>][]" multiple class="select_STS form-control <?php $__errorArgs = ['select_STS'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <option value="Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan">Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan</option>
                <option value="Piutang Hasil Pengelolaan Kekayaan Daerah yang dipisahkan lebih dari 5(lima) tahun">Piutang Hasil Pengelolaan Kekayaan Daerah yang dipisahkan lebih dari 5(lima) tahun</option>
                <option value="Piutang Lain-Lain Pendapatan Asli Daerah yang Sah Umur Piutang lebih dari 5(lima)Tahun">Piutang Lain-Lain Pendapatan Asli Daerah yang Sah Umur Piutang lebih dari 5(lima)Tahun</option>
                <option value="Piutang yang berasal dari tagihan investasi non permanen dalam jangka waktu tertentu sesuai dengan perjanjian tidak melakukan pelunasan/ tidak diketahui keberadaannya /bangkrut dan mengalami musibah(force majerure)">Piutang yang berasal dari tagihan investasi non permanen dalam jangka waktu tertentu sesuai dengan perjanjian tidak melakukan pelunasan/ tidak diketahui keberadaannya /bangkrut dan mengalami musibah(force majerure)</option>
                <option value="Piutang Lainnya yang belum dibayar oleh pihak ketiga selain a-d sesuai ketentuan peraturan perundang-undangan">Piutang Lainnya yang belum dibayar oleh pihak ketiga selain a-d sesuai ketentuan peraturan perundang-undangan</option>
            </select>
            <?php $__errorArgs = ['select_STS'];
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
        <div class="form-group mb-3">
            <label for="">Upload Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan </label>
            <br>
            <button type="button" onclick="addUpload('<?php echo e($item->id); ?>')" class="btn btn-success btn-sm plus"><i class="fas fa-plus"></i></button>
            <table style="width: 100%;" id="table-upload-<?php echo e($item->id); ?>">
                <tr>
                    <th>
                        <input type="file" name="docs_STS[<?php echo e($item->id); ?>][]" accept="application/pdf" multiple class="form-control <?php $__errorArgs = ['docs_STS'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> my-2" style="width: 100%;">
                        <?php $__errorArgs = ['docs_STS'];
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
                    </th>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="my-3">
    <a href="<?php echo e(url('/nasabah/home/usulan?id=')); ?><?php echo e(app('request')->input('id')); ?>" type="submit" id="back" class="btn btn-secondary float-start"><i class="fas fa-arrow-left"></i> Back</a>
    <button type="submit" id="next" class="btn btn-primary float-right">Next <i class="fas fa-arrow-right"></i></button>
</div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('vendor/select2/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/usulan_form_2_user.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $(".select_STS").select2();
        let baris = 1;
        $(document).on('click', '.plusx', function(e) {
            e.preventDefault();
            baris = baris + 1;
            let html = '<tr id="baris' + baris + '">';
            html += `<th>
                            <button type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                            <input type="file" name="docs_STS[<?php echo e($item->id); ?>][]" accept="application/pdf" class="form-control <?php $__errorArgs = ['docs_STS'];
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\Website\upwork\piutang\master\5\piutang-bpkd\resources\views/nasabah/usulan/v2/form_2.blade.php ENDPATH**/ ?>