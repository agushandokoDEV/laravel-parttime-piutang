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
<div class="card mb-3">
    <div class="card-header">
        <b>Dokumen Pendukung Lainnya </b>
    </div>
    <div class="card-body">
        <form action="<?php echo e(url('/nasabah/surat-usulan/step4')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="<?php echo e(app('request')->input('id')); ?>" />
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nomor Surat Usulan</label>
                        <input type="text" name="nomor_surat" value="<?php echo e($data->nomor_surat); ?>" readonly class="form-control <?php $__errorArgs = ['nomor_surat'];
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
                        <input type="text" name="rincian"  class="form-control <?php $__errorArgs = ['rincian'];
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
                        <label for="">Tanggal Usulan</label>
                        <input type="date" name="tgl_usulan" disabled value="<?php echo e($data->tgl_usulan); ?>" class="form-control <?php $__errorArgs = ['tgl_usulan'];
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
                        <input type="text" name="nilai_rincian" readonly id="nilai_rincian" value="<?php echo e(number_format($nilai_rincian, 0, '', '.')); ?>" class="form-control <?php $__errorArgs = ['nilai_rincian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    </div>
                </div>
                
            </div>
            <div class="form-group">
                <label for="inputState" class="form-label"></label>
                <select name="select_DL[]" id="select_DL" multiple class="form-control <?php $__errorArgs = ['select_DL'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option>Surat Keputusan Keringanan/Pengurangan/Pembebasan</option>
                    <option>Surat Konfirmasi Piutang ke Penanggung Utang</option>
                    <option>Surat Jawaban Konfirmasi Penangung Utang</option>
                    <option>Nota Dinas/Laporan Kronologi Terjadinya Piutang</option>
                    <option>Foto Dokumentasi</option>
                    <option>Surat Keterangan Lainya</option>
                    <option>Daftar Rincian Dokumen</option>
                    <option>Lainnya</option>
                </select>
                <?php $__errorArgs = ['select_DL'];
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
            <div class="form-group">
                <label for="formFileMultiple" class="form-label">Upload Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah sebagai berikut</label>
                <br>
                <button type="button" class="btn btn-success btn-sm plus"><i class="fas fa-plus"></i></button>
                <table style="width: 100%;" id="table">
                    <tr>
                        <th>
                            <input type="file" name="docs_DL[]" accept="application/pdf" multiple class="form-control <?php $__errorArgs = ['docs_DL'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> my-2" style="width: 100%;">
                            <?php $__errorArgs = ['docs_DL'];
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
            <div class="my-3">
                <a href="<?php echo e(url('/nasabah/surat-usulan/step3=')); ?><?php echo e(app('request')->input('id')); ?>" type="submit" id="back" class="btn btn-secondary float-start"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-arrow-right"></i> Next</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('vendor/select2/dist/js/select2.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#select_DL').select2();

            let baris = 1;
            $(document).on('click', '.plus', function(e) {
                e.preventDefault();
                baris = baris + 1;
                let html = '<tr id="baris' + baris + '">';
                html += `<th>
                                <button type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                                <input type="file" name="docs_DL[]" accept="application/pdf" multiple class="form-control <?php $__errorArgs = ['docs_ST'];
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

            $(document).on('click', '.minus', function(e) {
                let rows = $(this).data('row');
                $('#' + rows).remove();
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\Website\upwork\piutang\master\5\piutang-bpkd\resources\views/nasabah/usulan/v2/form_4.blade.php ENDPATH**/ ?>