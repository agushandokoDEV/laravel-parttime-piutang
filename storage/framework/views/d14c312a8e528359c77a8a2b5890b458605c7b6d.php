<?php $__env->startSection('title'); ?> Home <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3">
    <div class="card-header">
        <b>Rekap Data Rincian Piutang Daerah Audited Tahun <?php echo e(\Carbon\Carbon::now()->format('Y')); ?></b>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped text-center nowrap" id="home">
                <thead class="text-white bg-primary">
                    <tr>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">No</th>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">Nama SKPD</th>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">No SKRD / RUPS / Kepgub / STS / SPS / PKS / Surat perjanjian / Surat Perikatan atau Dokumen yang Dipersamakan</th>
                        <th colspan="7">Rincian Piutang</th>
                        <th colspan="4">Pengelolaan Kualitas Piutang</th>
                        <th rowspan="3">Status</th>
                        <th rowspan="3">Action</th>
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
                    <?php if($skpd[0]->users_id != null): ?>
                        <?php $__currentLoopData = $skpd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->user->name); ?></td>
                                <td><?php echo e($item->no_skrd); ?></td>
                                <td><?php echo e($item->tgl_surat); ?></td>
                                <td><?php echo e($item->selisihTahun); ?> Tahun</td>
                                <td><?php echo e($item->jenisPiutang->jenis); ?></td>
                                <td><?php echo e($item->nama_peminjam); ?></td>
                                <td><?php echo e($item->nilai_rincian); ?></td>
                                <td>-</td>
                                <td><?php echo e($item->total_rincian); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo e($item->total_rincian); ?></td>
                                <td>
                                    <?php if($item->status == 'validate'): ?>
                                        <div class="span badge bg-success text-white p-2">Validasi</div>
                                    <?php elseif($item->status == 'proses'): ?>
                                        <div class="span badge bg-warning text-white p-2">Prosess</div>
                                    <?php else: ?>
                                        <div class="span badge bg-danger text-white p-2">Belum Mengusulkan</div>
                                    <?php endif; ?>
                                </td>
                                <?php if($item->status == 'validate' || $item->status == 'proses'): ?>
                                    <td>
                                        <input type="checkbox" disabled name="usulans_id" class="checkbox" data-id="<?php echo e($item->id); ?>" data-name="<?php echo e($item->nama_peminjam); ?>">
                                    </td>
                                <?php else: ?>
                                    <td>
                                        <input type="checkbox" name="usulans_id" class="checkbox" data-id="<?php echo e($item->id); ?>" data-name="<?php echo e($item->nama_peminjam); ?>">
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
                <tfoot class="text-white bg-primary">
                    <tr>
                        <th colspan="9">Jumlah</th>
                        <th colspan="6">Rp.<?php echo e(number_format($sumSkpd)); ?></th>
                        <th>
                            <button class="btn btn-secondary" id="add"><i class="fas fa-plus"></i> Tambah Data Usulan</button>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    $(document).ready(function() {
        $('#home').DataTable({
            searching: false,
            bPaginate: false,
            bInfo: false,
            ordering: false
        });

        $('#add').click(function(e) {
            e.preventDefault();
            var selectedIds = [];
            var selectednames = [];

            $('.checkbox:checked').each(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                selectedIds.push(id);
                selectednames.push(name);
                
            });

            if (selectedIds.length == 0) {
                alert('Silahkan Pilih Salah Satu SKRD')
            } else if(selectedIds.length > 1) {
                //alert('Pilih salah satu SKRD')
                const same_value= selectednames.every( (val, i, arr) => val === arr[0] );
                if(!same_value){
                    alert('Harap pilih nama penanggung harus sama');
                    selectedIds=[];
                    selectednames=[];
                    $('.checkbox').prop('checked',false)
                }else{
                    window.location.href = '/nasabah/home/usulan?id=' + selectedIds.join(',');
                }
            } else {
                //console.log('OK')
                // window.location.href = '/nasabah/home/getUsulan/' + selectedIds;
                window.location.href = '/nasabah/home/usulan?id=' + selectedIds.join(',');
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\Website\upwork\piutang\vinensia-piutang\resources\views/nasabah/index.blade.php ENDPATH**/ ?>