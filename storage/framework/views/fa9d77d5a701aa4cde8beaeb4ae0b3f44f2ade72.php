<?php $__env->startSection('title'); ?> Dokumen Surat Usulan Yang Terpenuhi & Tidak Terpenuhi <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3">
    <div class="card-header">
        <b>Dokumen Surat Usulan Yang Terpenuhi & Tidak Terpenuhi</b>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-bordered table-striped" id="status" style="width: 100%;">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Daftar Dokumen Yang Di Serahkan</th>
                        <th class="text-center">Terpenuhi</th>
                        <th class="text-center">Tidak Terpenuhi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($data->count() > 0): ?>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya</td>
                        <td class="text-center"><input type="checkbox" <?php if($data->file_ID->count() != 0): ?>
                            checked
                            <?php endif; ?>></td>
                        <td class="text-center"><input type="checkbox" <?php if($data->file_ID->count() == 0): ?>
                            checked
                            <?php endif; ?>></td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Surat Permohonan usulan penyerahan pengurusan piutang dari SKPD ke BPKD</td>
                        <td class="text-center"><input type="checkbox" <?php if($data->docs_skdp != null): ?>
                            checked
                            <?php endif; ?>></td>
                        <td class="text-center"><input type="checkbox" <?php if($data->docs_skdp == null): ?>
                            checked
                            <?php endif; ?>></td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                        <td class="text-center"><input type="checkbox" <?php if($data->file->count() != 0): ?>
                            checked
                            <?php endif; ?>></td>
                        <td class="text-center"><input type="checkbox" <?php if($data->file->count() == 0): ?>
                            checked
                            <?php endif; ?>></td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah</td>
                        <td class="text-center"><input type="checkbox" <?php if($data->file_ST->count() != 0): ?>
                            checked
                            <?php endif; ?>></td>
                        <td class="text-center"><input type="checkbox" <?php if($data->file_ST->count() == 0): ?>
                            checked
                            <?php endif; ?>></td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah</td>
                        <td class="text-center"><input type="checkbox" <?php if($data->file_DL->count() != 0): ?>
                            checked
                            <?php endif; ?>></td>
                        <td class="text-center"><input type="checkbox" <?php if($data->file_DL->count() == 0): ?>
                            checked
                            <?php endif; ?>></td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td>Dokumen Lainnya</td>
                        <td class="text-center"><input type="checkbox" <?php if($data->docs_lainnya != null): ?>
                            checked
                            <?php endif; ?>></td>
                        <td class="text-center"><input type="checkbox" <?php if($data->docs_lainnya == null): ?>
                            checked
                            <?php endif; ?>></td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td class="text-center" colspan="5">Bekum Ada Usulan Yang Di Validasi Admin</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya </b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="srksps">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $showFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__empty_1 = true; $__currentLoopData = $item->file_ID; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ID): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya</td>
                                        <td class="text-center">
                                            <a href="<?php echo e(asset('storage/surat/docs_ID/' . $ID->docs_ID)); ?>" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Surat Permohonan usulan penyerahan pengurusan piutang dari SKPD ke BPKD	</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="bpkd">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($showFile[0]->docs_skdp != null): ?>
                                <?php $__currentLoopData = $showFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>Surat Permohonan usulan penyerahan pengurusan piutang dari SKPD ke BPKD	</td>
                                        <td class="text-center">
                                            <a href="<?php echo e(asset('storage/surat/skdp/' . $item->docs_skdp)); ?>" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                           <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan </b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="skrd">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $showFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__empty_1 = true; $__currentLoopData = $item->file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->select_STS); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(asset('storage/surat/STS/' . $file->docs_STS)); ?>" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="usulkan">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $showFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__empty_1 = true; $__currentLoopData = $item->file_ST; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ST): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->select_ST); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(asset('storage/surat/ST/' . $ST->docs_ST)); ?>" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah 2</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="usulkan2">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $showFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__empty_1 = true; $__currentLoopData = $item->file_DL; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $DL): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->select_DL); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(asset('storage/surat/DL/' . $DL->docs_DL)); ?>" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen Lainnya</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover lainnya" style="width:100%;" id="lainnya">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($showFile[0]->docs_lainnya != null): ?>
                                <?php $__currentLoopData = $showFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>Dokumen Lainnya	</td>
                                        <td class="text-center">
                                            <a href="<?php echo e(asset('storage/surat/docs_lainnya/' . $item->docs_lainnya)); ?>" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    $(document).ready(function() {
        $('#srksps').DataTable();
        $('#bpkd').DataTable();
        $('#skrd').DataTable();
        $("#lainnya").DataTable();
        $('#usulkan').DataTable();
        $('#usulkan2').DataTable();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\Website\upwork\piutang\vinensia-piutang\resources\views/admin/usulan/detail.blade.php ENDPATH**/ ?>