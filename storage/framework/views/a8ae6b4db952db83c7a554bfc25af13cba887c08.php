<?php $__env->startSection('title'); ?> Surat Usulan PUPN <?php $__env->stopSection(); ?>

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
        <div class="alert alert-success">
            <b><?php echo e(session()->get('message')); ?></b>
        </div>
    <?php endif; ?>
    <div class="card mb-3">
        <div class="card-header">
            <b>Form Surat Usulan PUPN</b>
        </div>
        <div class="card-body">
            <form action="<?php echo e(url('/admin/usulan-knkpl')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="status" value="validate" id="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pilih Surat Usulan</label>
                            <select name="usulans_id" id="usulans_id" class="form-control <?php $__errorArgs = ['usulans_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Pilih Surat Usulan</option>
                                <?php $__currentLoopData = $skpd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->nomor_surat != null && $item->usulanKnkpl->count() == 0): ?>
                                        <option value="<?php echo e($item->nomor_surat); ?>"><?php echo e($item->nomor_surat); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['usulans_id'];
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
                            <label for="">Penanggung Piutang</label>
                            <input type="text" name="no_skpd" id="no_skpd" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nomor Surat Usulan ke PUPN</label>
                            <input type="text"  name="nomor_knkpl" id="nomor_knkpl" class="form-control <?php $__errorArgs = ['nomor_knkpl'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['nomor_knkpl'];
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
                            <label for="">Tanggal Surat Usulan</label>
                            <input type="date" name="tgl_knkpl" id="tgl_knkpl" class="form-control <?php $__errorArgs = ['tgl_knkpl'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['tgl_knkpl'];
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
                        <label for="">Perihal Dokumen</label>
                        <textarea name="rincian_usulan_knkpl" class="form-control <?php $__errorArgs = ['rincian_usulan_knkpl'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" cols="30" rows="3"></textarea>
                        <?php $__errorArgs = ['rincian_usulan_knkpl'];
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
                </div>
               
                <div class="form-group">
                    <label for="">Upload Dokumen Usulan</label>
                    <input type="file" name="docs_knkpl" accept="application/pdf" class="form-control <?php $__errorArgs = ['docs_knkpl'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['docs_knkpl'];
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

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('vendor/select2/dist/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/usulan_knkpl.js')); ?>"></script>
    <script>
        $(function(){
            $("#usulans_id").val("<?php echo e(app('request')->input('no_surat')); ?>").trigger('change');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\Website\upwork\piutang\master\5\piutang-bpkd\resources\views/admin/usulanKNKPL/index.blade.php ENDPATH**/ ?>